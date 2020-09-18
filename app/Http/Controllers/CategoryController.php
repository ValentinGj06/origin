<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $existing_categories = Category::all();

        return response()->json($existing_categories);
    }

    public function store(Request $request, Category $category)
    {
        $categoriesId = '';
        if($request['category']) {
            $categoriesModel = $category->firstOrCreate(['name' => $request['category']]);
            $categoriesId = $categoriesModel->id;
        }
        return response()->json(['response_categories' => ['id' => $categoriesId, 'name' => $request['category']]], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $categoriesId = '';
        if($request['category']) {
            $categoriesModel = $category->updateOrCreate(['id' => $request['id']],['name' => $request['category']]);
            $categoriesId = $categoriesModel->id;
            $categoriesName = $categoriesModel->name;
        }
        return response()->json(['updated_categories' => ['id' => $categoriesId, 'name' => $categoriesName]], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $categoryModel = $category->delete();
        $categoryName = $category->name;

        return response()->json(['deleted_category' => $categoryName], 200);
    }
}
