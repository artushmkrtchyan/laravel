<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Models\Shop;

class ShopsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = Shop::orderby('id', 'desc')->paginate(10);
        if(count($shops) >= 1){
          return view('admin.shops.index', compact('shops'));
        }else{
          return Redirect::to('/admin/shops/create');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.shops.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $shops = Shop::create([
        'name' => $request->input('name'),
        'description' => $request->input('description'),
      ]);

      return Redirect::to(route('shops.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $shop = Shop::find($id);

      return view('admin.shops.show', compact('shop'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $shop = Shop::find($id);

      return view('admin.shops.edit', compact('shop'));
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
      $shop = Shop::find($id);

      $shop->name = $request->input('name');

      $shop->description = $request->input('description');

      $shop->save();

      return Redirect::to(route('shops.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $shop = Shop::find($id);

      $shop->delete();

      return Redirect::to(route('shops.index'));
    }
}
