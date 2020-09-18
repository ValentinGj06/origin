<?php

namespace App\Http\Controllers;

use App\Category;
use App\Client;
use App\ClientInfo;
use App\ClientDetail;

use App\Tag;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $city = ClientInfo::distinct()->get(['city']);

        $max_pay_in = ClientDetail::max('pay_in');

        $max_win = ClientDetail::max('win');

        $existing_tag = Tag::all('id', 'name');
        $existing_tags = [];
        foreach ($existing_tag as $tag) {

            $existing_tags[] = ['key' => $tag->id, 'value' => $tag->name];
        }

        $existing_categories = Category::all('id', 'name');

        return view('backend/auth/client/index', [
            'city' => $city,
            'max_pay_in' => $max_pay_in,
            'max_win' => $max_win,
            'existing_tags' => $existing_tags,
            'existing_categories' => $existing_categories,
        ]);
    }

    public function management()
    {
        $city = ClientInfo::distinct()->get(['city']);

        $max_pay_in = ClientDetail::max('pay_in');

        $max_win = ClientDetail::max('win');

        $existing_tag = Tag::all('id', 'name');
        $existing_tags = [];
        foreach ($existing_tag as $tag) {

            $existing_tags[] = ['key' => $tag->id, 'value' => $tag->name];
        }

        $existing_categories = Category::all('id', 'name');

        return view('backend/auth/client/management', [
            'city' => $city,
            'max_pay_in' => $max_pay_in,
            'max_win' => $max_win,
            'existing_tags' => $existing_tags,
            'existing_categories' => $existing_categories,
        ]);
    }

    public function filterClients(Client $client)
    {
        if (request()->datefilter || request()->from_city || request()->pay_in || request()->win || request()->filter_by_birth_date || request()->is_valid_phone_number || request()->categories || request()->tags || request()->age) {

//            $datefilter = '';
//            $date_from = '';
//            $date_to = '';
//            $pay_in = '';
//            $win = '';

            $query = $client->with('clientInfo', 'clientDetail', 'tags', 'categories');

            if (request()->has('datefilter') && request()->datefilter) {

                $datefilter = explode(' - ', request()->datefilter);

                $date_from = date_create($datefilter[0]);
                $date_from = date_format($date_from, 'Y-m-d');

                $date_to = date_create($datefilter[1]);
                $date_to = date_format($date_to, 'Y-m-d');

                $query = $query->whereBetween('registration_date', array($date_from, $date_to));
            }

            if (request()->has('from_city') && request()->from_city) {

                $query = $query->whereHas('clientInfo', function ($query) {

                    $query->whereIn('city', request()->from_city);

                });
            }

            if (request()->has('pay_in') && request()->pay_in) {

                $query = $query->whereHas('clientDetail', function ($query) {

                    $pay_in = explode(';', request()->pay_in);

                    $query->whereBetween('pay_in', $pay_in);
                });
            }

            if (request()->has('win') && request()->win) {

                $query = $query->whereHas('clientDetail', function ($query) {

                    $win = explode(';', request()->win);

                    $query->whereBetween('win', $win);
                });
            }

            if (request()->has('is_valid_phone_number') && request()->is_valid_phone_number) {

                $query = $query->whereHas('clientInfo', function ($query) {

                    $query->where('is_valid_phone_number', 1);

                });
            }

            if (request()->has('filter_by_birth_date') && request()->filter_by_birth_date) {

                $query = $query->whereHas('clientInfo', function ($query) {

                    $query->where('birth_date', 'like', '%' . date('m-d') . '%');

                });

            }

            if (request()->has('categories') && request()->categories) {

                $query = $query->whereHas('categories', function ($query) {

                    $query->whereIn('name', request()->categories);

                });
            }

            if (request()->has('tags') && request()->tags) {

                $query = $query->whereHas('tags', function ($query) {

                    $query->whereIn('name', request()->tags);

                });
            }

            if (request()->has('age') && request()->age) {
            
                $query = $query->whereHas('clientInfo', function($query) {
                    $age = explode(';', request()->age);
                    
                    $query->whereBetween(DB::raw("TIMESTAMPDIFF(YEAR, birth_date, CURDATE())"), $age);
                });
            }

            $clients = $query->paginate($client->all()->count());

        } else {

            $query = $client->with('clientInfo', 'clientDetail', 'tags', 'categories');
            $clients = $query->paginate($client->all()->count());

        }

        foreach ($clients as $client) {

            if (!preg_match('/^[0][0-9]{8,12}$/', $client->clientInfo->phone_number)) {
                $client->status = 'Invalid Number';
            } else {
                $client->status = 'Valid Number';
            }

            foreach ($client->tags as $tag) {
                $tag->key = $tag->id;
                unset($tag->id);
                $tag->value = $tag->name;
                unset($tag->name);
                unset($tag->created_at);
                unset($tag->updated_at);
            }
        }
        return response()->json($clients);
    }

    public function categoryTag()
    {
        $categoryTag = new \stdClass();
        $existing_tag = Tag::all('id', 'name');
        foreach ($existing_tag as $tag) {

            $categoryTag->existing_tags[] = ['key' => $tag->id, 'value' => $tag->name];
        }

        $categoryTag->existing_categories = Category::all('id', 'name');

        return response()->json($categoryTag);
    }

    public function update(Request $request, Client $client, Tag $tags, Category $categories)
    {

        $this->validateClient($request);

        $client->update(['username' => $request['email']], request(['registration_date', 'registered_on_location']));
        $client->clientInfo()->update(request(['first_name', 'last_name', 'email', 'birth_date',
            'phone_number', 'is_valid_phone_number', 'gender', 'street', 'street_number', 'city']));
        $client->clientDetail()->update(request(['code', 'card_number']));

        /** Update Tags and Categories if new added **/
        $tagsIds = [];
        if (json_decode($request['tags'])) {
            foreach (json_decode($request['tags']) as $tag) {
                $tagsModel = $tags->firstOrCreate(['name' => $tag->value]);
                $tagsIds[] = $tagsModel->id;
            }
        }
        $categoriesIds = [];
        if($request['categories']) {
            foreach ($request['categories'] as $category) {
                $categoriesModel = $categories->firstOrCreate(['name' => $category]);
                $categoriesIds[] = $categoriesModel->id;
            }
        }
        /** Update Tags and Categories for client**/
        $client->tags()->sync($tagsIds);
        $client->categories()->sync($categoriesIds);

//        return redirect('admin/auth/user')->with('success', 'Client updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Client $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }

    protected function validateClient(Request $request)
    {
        return $request->validate([
            'registration_date' => ['required'],
            'registered_on_location' => ['required'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email'],
            'birth_date' => ['required'],
            'phone_number' => ['required', 'string'],
            'is_valid_phone_number' => ['required'],
            'gender' => ['required'],
            'street' => ['required'],
            'street_number' => ['required'],
            'city' => ['required'],
            'code' => ['required'],
            'card_number' => ['required'],
            'tags' => ['nullable'],
            'categories' => ['nullable'],
        ]);
    }

}
