<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function createPost(Request $request)
    {
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();
        Post::create($incomingFields);

        return redirect('/');
    }

    // editpost
    public function showEditPage(Post $postid)
    {
        if (auth()->user()->id !== $postid['user_id']) {
            return redirect('/');
        }
        return view('edit-post', ['post' => $postid]);
    }

    public function editPost(Request $request, Post $postid)
    {
        if (auth()->user()->id !== $postid->user_id) {
            return redirect('/');
        }

        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $postid->update($incomingFields);
        return redirect('/');
    }

    // delete post
    public function deletePost(Post $postid)
    {
        if (auth()->user()->id !== $postid->user_id) {
            return redirect('/');
        }

        if ($postid->delete()) {
           return redirect('/');
        }
    }
}
