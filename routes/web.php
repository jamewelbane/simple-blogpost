<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    $getpost = [];
    if (auth()->check()) {
        $getpost = auth()->user()->usersPost()->latest()->get();
    }
   
    return view('index', ['fetchPost' => $getpost]);

});

// registration
Route::post('/register', [UserController::class, 'register']); 

// logout
Route::post('/logout', [UserController::class,'logout']);

// login
Route::post('/login', [UserController::class,'login']);



// ------------Blog post related route----------------

// create post
Route::post('/blog-post', [PostController::class,'createPost']);

// edit post
Route::get('/edit-post/{postid}', [PostController::class,'showEditPage']);
Route::put('/edit-post/{postid}', [PostController::class,'editPost']);

// delete post
Route::delete('/delete-post/{postid}', [PostController::class,'deletePost']);


// newsfeeed

Route::get('/newsfeed', function () {
    $getAllPost = [];

    if (auth()->check()) {
        // Eager load the user relationship
        $getAllPost = Post::with('user')->latest()->get();
    }

    return view('newsfeed', ['fetchAllPost'=> $getAllPost]);
});