<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Post;
use App\User;
use Illuminate\Auth\Access\AuthorizationException;

class PostController extends Controller
{
    //


    public function index()
    {
        $posts = auth()->user()->posts;
        return view('admin.posts.index', ['posts' => $posts]);
    }

    public function show(Post $post)
    {
        $comments = $post->comments()->orderBy('created_at', 'desc')->get();
        return view('blog-post', ['post' => $post, 'comments' => $comments]); 
    }

    public function create(Post $post)
    {
        return view('admin.posts.create', ['post' => $post]); 
    }

    public function store(Request $request)
    {
        $this->authorize('create', Post::class);

        $inputs = $request->validate([
            'title' => 'required|min:8|max:255',
            'body'  => 'required',
            'post_image' => 'mimes:jpeg,png,jpg|max:2048|dimensions:min_width=100,min_height=100'
        ]);

        if($request->post_image){
            $inputs['post_image'] = $request->post_image->store('images');
        }

        auth()->user()->posts()->create($inputs);

        Session::flash('created-message', "Post was created! ".$inputs['title']);

        return redirect()->route('admin.post.index');
    }

    public function edit(Post $post)
    {
        $this->authorize('view', $post);
        return view('admin.posts.edit', ['post' => $post]);
    }

    public function update(Post $post, Request $request)
    {

        $inputs = $request->validate([
            'title' => 'required|min:8|max:255',
            'body'  => 'required',
            'post_image' => 'mimes:jpeg,png,jpg|max:2048|dimensions:min_width=100,min_height=100'
        ]);

        if($request->post_image){
            $inputs['post_image'] = $request->post_image->store('images');
            $post->post_image = $inputs['post_image'];
        }
        
        $post->title = $inputs['title'];
        $post->body = $inputs['body'];
       
        $this->authorize('update', $post);

        $post->save();
        Session::flash('created-message', "Post ".$inputs['title']." was updated.");
        
        // dd($post);
        return redirect()->route('admin.post.index');

    }


    public function destroy(Post $post)
    {

        $this->authorize('delete', $post);
        $post->delete();

        Session::flash('message', "Post was removed");

        return back();
    }
}
