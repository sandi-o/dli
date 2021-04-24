<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;

class TodoController extends Controller
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
        $todos = Todo::selectRaw('count(*) as completed_count, userId')
                    ->where('completed', 1)                    
                    ->groupBy('userId')
                    ->get();        
     
        return response()->json($todos);
    }

     /**
     * search Fault data based on given parameters.
     *
     * @param Int $status
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search($status,Request $request) {
        
        //search parameters
        $keyword = $request->keyword ?? '';
        $field = $request->field ?? 'title'; // title
        $user_id = $request->user_id ?? 0;
        $completed = $request->completed ?? 0;
        
        $todos = Todo::orderBy('id','desc');
      
            
        $todos->when($completed, function ($q) use($completed) {
            return $q->where('completed', $completed);
        })->when($user_id, function ($q) use($user_id) {
            return $q->where('userId',$user_id);
        })->when(($keyword && $field), function ($q) use($keyword,$field) {
            return $q->where($field,'like','%'.$keyword.'%');
        });

        return response()->json($todos->get());
    }
}
