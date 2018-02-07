<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

use App\Models\User;

use App\Models\Post;

class DashboardController extends Controller
{
    public function index()
    {

      $posts = Post::orderby('id', 'desc')->where('status', 'publish')->paginate(10);

      return view('admin.dashboard.index', compact('posts'));
    }
}
