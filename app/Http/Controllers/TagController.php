<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $existing_tags = Tag::all();

        return response()->json($existing_tags);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Tag $tag)
    {
        $tagsId = '';
        if($request['tag']) {
            $tagsModel = $tag->firstOrCreate(['name' => $request['tag']]);
            $tagsId = $tagsModel->id;
        }
        return response()->json(['response_tags' => ['id' => $tagsId, 'name' => $request['tag']]], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $tagsId = '';
        if($request['tag']) {
            $tagsModel = $tag->updateOrCreate(['id' => $request['id']],['name' => $request['tag']]);
            $tagsId = $tagsModel->id;
            $tagsName = $tagsModel->name;
        }
        return response()->json(['updated_tags' => ['id' => $tagsId, 'name' => $tagsName]], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tagModel = $tag->delete();
        $tagName = $tag->name;

        return response()->json(['deleted_tag' => $tagName], 200);
    }
}
