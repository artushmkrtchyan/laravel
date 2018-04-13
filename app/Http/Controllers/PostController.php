<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Auth;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderby('id', 'desc')->paginate(12);

        return view('post.index', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::find($id);

        $author = User::find($post->author_id);

        return view('post.show', compact('post', 'author'));
    }
}
