<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\Shop;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $products = Product::orderby('id', 'desc')->paginate(10);
      if(count($products) >= 1){
        return view('admin.products.index', compact('products'));
      }else{
        return Redirect::to('/admin/products/create');
      }
    }

    public function createForm()
    {
        $shops = Shop::all();

        return view('admin.products.create', compact('shops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      $validator = Validator::make($request->all(), [
          'name' => 'required|string',
          'description' => 'required',
      ]);

      if ($validator->fails()) {
        $shops = Shop::all();
        return view('admin.products.create', compact('shops'))->withErrors($validator);
      }

      $filename = 'no.png';

      if($request->hasfile('image')) {

        $image = $request->file('image');

        $filename = uniqid('img_') . time() . '.' . $image->getClientOriginalExtension();

        $uploadsFolder =  'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'products';

        $path = $request->image->storeAs($uploadsFolder, $filename);
      }

      $product = Product::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'code' => $request->input('code'),
                'image' => $filename,
              ]);

      $shops = $request->input('shop');
      $product->shops()->sync($shops);

      return Redirect::to('/admin/product/create');
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
      $product = Product::find($id);

      return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $product = Product::find($id);

      $shops = Shop::all();

      return view('admin.products.edit', compact('product', 'shops'));
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

      $validator = Validator::make($request->all(), [
          'name' => 'required|string',
          'description' => 'required',
      ]);

      if ($validator->fails()) {
        
        $product = Product::find($id);
        $shops = Shop::all();
        return view('admin.products.edit', compact('product', 'shops'))->withErrors($validator);
      }

      $product = Product::find($id);

      $product->name = $request->input('name');

      $product->description = $request->input('description');

      $product->price = $request->input('price');

      $product->code = $request->input('code');

      if($request->hasfile('image')) {

         $image = $request->file('image');

         $filename = uniqid('img_') . time() . '.' . $image->getClientOriginalExtension();

         $uploadsFolder =  'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'products';

         $path = $request->image->storeAs($uploadsFolder, $filename);

         Storage::delete($uploadsFolder."/".$product->image);

         $product->image = $filename;
     }

      $product->save();

      $shops = $request->input('shop');

      $product->shops()->sync($shops);

      return Redirect::to('/admin/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $product = Product::find($id);

      if($product->image){
        $uploadsFolder =  'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'products';
        Storage::delete($uploadsFolder."/".$product->image);
      }

      $product->delete();

      $product->shops()->sync([]);

      return Redirect::to('/admin/product');
    }
}
