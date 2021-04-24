<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {     
        $perPage = request()->per_page ??10;
        $sortBy = request()->sort_by ?? 'created_at';
        $sortDesc = request()->sort_desc =='true' ? 'desc':'asc';

        $categories = Category::orderBy($sortBy,$sortDesc)->paginate($perPage);
     
        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes['name'] = $request->name;   

        $category = Category::create($attributes);

        return response()->json(['result' =>$category,'message'=>'Record successfully CREATED with Id #: '. $category->id],200);
    } 
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Category $category, Request $request)
    {
        $attributes['name'] = $request->name;

        $result = $category->update($attributes);

        return response()->json(['result'=> $result, 'message'=>'Record successfully UPDATED with Id #: '.$category->id], 200);
    }

    /**
     * Show the specified resource in storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return response()->json(['result'=> $category, 'message'=>'Record successfully RETRIEVE with Id #: '.$category->id], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $result = $category->delete();
        return response()->json(['result'=> $result, 'message'=>'Record successfully DELETED with Id #: '.$category->id], 200);
    }
}
