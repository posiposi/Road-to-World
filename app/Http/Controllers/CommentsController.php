<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Bike;
use App\Comments;

class CommentsController extends Controller
{
    public function index($id)
    {
        $bike = \App\Bike::where('id', $id)->get();
        //$user_comment = \App\Comment::get();
        return view('comments.index', ['bikes' => $bike,]);
    }
    
    public function store(Request $request, $id)
    {
        $comments = $request->user()->comments()->create([
            'bike_id' => $id,
            'body' => $request->body,
        ]);
        $comments->save();
        
        return back();
    }
}
