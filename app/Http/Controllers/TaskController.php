<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Category;

class TaskController extends Controller
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
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {          
        return response()->json($category->tasks()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Category $category)
    {
        $attributes['name'] = $request->name;   

        $task = $category->addTask($attributes);

        return response()->json(['result' =>$task,'message'=>'Record successfully CREATED with Id #: '. $task->id],200);
    } 
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Task $task, Request $request)
    {
        $attributes['name'] = $request->name;

        $result = $task->update($attributes);

        return response()->json(['result'=> $result, 'message'=>'Record successfully UPDATED with Id #: '.$task->id], 200);
    }

    /**
     * Show the specified resource in storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return response()->json(['result'=> $task, 'message'=>'Record successfully RETRIEVE with Id #: '.$task->id], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $result = $task->delete();
        return response()->json(['result'=> $result, 'message'=>'Record successfully DELETED with Id #: '.$task->id], 200);
    }
}
