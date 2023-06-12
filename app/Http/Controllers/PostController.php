<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{


    public function deletePost(Post $post){
        if(auth()->user()->id === $post['user_id']){
            $post->delete();
        }
        return redirect('/');
    }
    public function updatePost(Post $post, Request $request){

        if(auth()->user()->id !== $post->user_id){
            return redirect ('/');
        }

        $incomingFields = $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['description'] = strip_tags($incomingFields['description']);

        $post->title = $incomingFields['title'];
        $post->description = $incomingFields['description'];
        
        $post -> update();
        return redirect('/');
    }
    public function editPost(Post $post){
        if(auth()->user()->id !== $post->user_id){
            return redirect ('/');
        }

        return view('products.edit-post', ['post' => $post]);
    }
    public function createPost(Request $request){
        $incomingFields = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['description'] = strip_tags($incomingFields['description']);
        $incomingFields['user_id'] = auth()->id();
        Post::create($incomingFields);
        return redirect('/');
    }
}
