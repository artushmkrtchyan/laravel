<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\DB;

use App\Models\CategoryTaxonomy;

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
      $categories = Categories::orderby('id', 'desc')->paginate(5);
      if(count($categories) > 1){
        return view('admin.category.index', compact('categories'));
      }else{
        return Redirect::to('/admin/category/create');
      }
    }

    public function createForm()
    {
        $categories = Categories::all();

        return view('admin.category.create', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $request = app('request');

        $category = Categories::create([
          'name' => $request->input('name'),
          'slug' => $request->input('slug'),
        ]);

        $category_id = $category->id;

        CategoryTaxonomy::create([
          'category_id' => $category_id,
          'parent' => $request->input('parent'),
          'order' => $request->input('order'),
        ]);

        return Redirect::to('/admin/category/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $category = Categories::find($id);

      $taxonomy = DB::select('select * from category_taxonomy where category_id = ?', [$id]);
      $taxonomy = $taxonomy[0];

      $categories = Categories::all();

      return view('admin.category.edit', array('category' => $category, 'taxonomy' => $taxonomy, 'categories' => $categories));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

      $category = Categories::find($id);

      $category->name = $request->input('name');

      $category->slug = $request->input('slug');

      $category->save();

      $parent = $request->input('parent');

      $order = $request->input('order');

      DB::table('category_taxonomy')->where('category_id', $id)->update(['parent' => $parent, 'order' => $order]);

      return Redirect::to('/admin/category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $categories = Categories::find($id);

      $categories->delete();

      $category_taxonomy = CategoryTaxonomy::where('category_id', $id);
      $category_taxonomy->delete();

      return Redirect::to('/admin/category');
    }
}