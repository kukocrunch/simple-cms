<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
    	$inputs = $request->validate([
            'body'=>'required',
        ]);
   

        $inputs['user_id'] = Auth::user()->id;
        $inputs['post_id'] = $post->id;
        $post->comments()->create($inputs);
        Session::flash('success-message', 'Comment has been posted!');
        return back();
    }


    public function storeReply(Request $request)
    {

        $inputs = $request->validate([
            'body' => 'required',
            'post_id' => 'required',
            'parent_id' => 'required'
        ]);

        $inputs['user_id'] = Auth::user()->id;

        Comment::create($inputs);
        Session::flash('success-message', 'Comment has been posted!');
        return back();
        
    }
}
