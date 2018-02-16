<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Shop;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderby('id', 'desc')->paginate(10);

        return response($products->jsonSerialize(), Response::HTTP_OK);
    }

    public function show($id)
    {
        $product = Product::find($id);
        return response($product->jsonSerialize(), Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $request = app('request');

        $filename = '';

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
        $product->save();
        return response($products->jsonSerialize(), Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if($request->input('name') && $request->input('name') != ''){
            $product->name = $request->input('name');
        }

        if($request->input('description') && $request->input('description') != ''){
            $product->description = $request->input('description');
        }

        if($request->input('price') && $request->input('price') != ''){
            $product->price = $request->input('price');
        }

        if($request->input('code') && $request->input('code') != ''){
            $product->code = $request->input('code');
        }


        if($request->hasfile('image')) {

           $image = $request->file('image');

           $filename = uniqid('img_') . time() . '.' . $image->getClientOriginalExtension();

           $uploadsFolder =  'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'products';

           $path = $request->image->storeAs($uploadsFolder, $filename);

           Storage::delete($uploadsFolder."/".$product->image);

           $product->image = $filename;
       }

        $product->save();

        if($request->input('shop')){
            $shops = $request->input('shop');
            $product->shops()->sync($shops);
        }

        return response($product->jsonSerialize(), Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if($product->image){
          $uploadsFolder =  'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'products';
          Storage::delete($uploadsFolder."/".$product->image);
        }

        $product->delete();

        $product->shops()->sync([]);
        return response(null, Response::HTTP_OK);
    }
}
