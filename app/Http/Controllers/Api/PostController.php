<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\Categories;
use App\Models\CategoryPost;
use App\Models\User;
use Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderby('id', 'desc')->where('status', 'publish')->paginate(10);

        return response($posts->jsonSerialize(), Response::HTTP_OK);
    }

    public function show($id)
    {
        $post = Post::find($id);
        return response($post->jsonSerialize(), Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $request = app('request');

        $filename = '';
        $status = $request->input('status') ? $request->input('status') : 'no-publish';
        $author_id = Auth::User()->id;

        if($request->hasfile('image')) {

          $image = $request->file('image');

          $filename = uniqid('img_') . time() . '.' . $image->getClientOriginalExtension();

          $uploadsFolder =  'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'posts';

          $path = $request->image->storeAs($uploadsFolder, $filename);
        }

        $post = Post::create([
                  'title' => $request->input('title'),
                  'content' => $request->input('content'),
                  'status' => $status,
                  'author_id' => $author_id,
                  'image' => $filename,
                ]);

        if($categories = $request->input('catedories')){
          foreach ($categories as $item) {
            CategoryPost::create([
              'post_id' => $post->id,
              'category_id' => $item,
            ]);
          }
        }
        return response($post->jsonSerialize(), Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        if($request->input('title') && $request->input('title') != ''){
            $post->title = $request->input('title');
        }

        if($request->input('content') && $request->input('content') != ''){
            $post->content = $request->input('content');
        }

        if($request->input('status') && $request->input('status') != ''){
            $post->status = $request->input('status');
        }else{
            $post->status = 'no-publish';
        }

        // if(Auth::User()->id){
        //     $post->author_id = Auth::User()->id;
        // }

        if($request->hasfile('image')) {

           $image = $request->file('image');

           $filename = uniqid('img_') . time() . '.' . $image->getClientOriginalExtension();

           $uploadsFolder =  'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'posts';

           $path = $request->image->storeAs($uploadsFolder, $filename);

           Storage::delete($uploadsFolder."/".$post->image);

           $post->image = $filename;
       }

        $post->save();

        if($categories = $request->input('catedories')){

          $delete = CategoryPost::where('post_id', $id);
          $delete->delete();

          foreach ($categories as $item) {
            CategoryPost::create([
              'post_id' => $post->id,
              'category_id' => $item,
            ]);
          }
        }
        return response($post->jsonSerialize(), Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        if($post->image){
          $uploadsFolder =  'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'posts';

          Storage::delete($uploadsFolder."/".$post->image);
        }

        $post->delete();

        $delete = CategoryPost::where('post_id', $id);
        $delete->delete();
        return response(null, Response::HTTP_OK);
    }
}
