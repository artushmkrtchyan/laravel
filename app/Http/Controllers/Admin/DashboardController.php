<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
      return view('admin.dashboard.index', array('user' => Auth::user()) );
    }
}
