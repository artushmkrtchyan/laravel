<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Categories;

class CategoryController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $categories = Categories::orderby('id', 'desc')->paginate(10);

    return response()->apiJson(true, Response::HTTP_OK, $categories);
  }
}
