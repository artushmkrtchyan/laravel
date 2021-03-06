<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Categories;
use App\Models\CategoryPost;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use App\Models\Role;

class PostController extends Controller
{
    public function index()
    {
        $users = User::whereHas('roles', function($q){
            $q->where('name', 'subscriber');
        })->get();
        $users_ids = [];

        foreach ($users as $user) {
          $users_ids[] = $user->id;
        }
        if(isset($_GET["count"]) && $_GET["count"]>0){
          $posts = Post::orderby('id', 'desc')->where('status', 'publish')->whereNotIn('author_id', $users_ids)->limit($_GET["count"])->get();
        }else{
          $posts = Post::orderby('id', 'desc')->where('status', 'publish')->whereNotIn('author_id', $users_ids)->paginate(10);
        }
        // return response($posts->jsonSerialize(), Response::HTTP_OK);
        return response()->apiJson(true, Response::HTTP_OK, $posts);

    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        //return response($post->jsonSerialize(), Response::HTTP_OK);
        // return response()->json(['success' => true,'status' => Response::HTTP_OK,'data' => [$post]], Response::HTTP_OK);
        return response()->apiJson(true, Response::HTTP_OK, $post);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'content' => 'required',
        ]);

        if ($validator->fails()) {
          return response(['success' => false, 'statusCode' => Response::HTTP_OK, 'error' => $validator->errors()], Response::HTTP_OK);
        }


        $filename = 'no.png';
        $status = $request->input('status') ? 'publish' : 'no-publish';
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
                  'author_id' => $author_id,
                  'status' => $status,
                  'image' => $filename,
                ]);

        if($categories = $request->input('categories')){
          $categories = explode(",",$categories);
          foreach ($categories as $item) {
            CategoryPost::create([
              'post_id' => $post->id,
              'category_id' => $item,
            ]);
          }
        }
        // return response($post->jsonSerialize(), Response::HTTP_CREATED);
        return response()->apiJson(true, Response::HTTP_CREATED, $post);

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'content' => 'required',
        ]);

        if ($validator->fails()) {
          return response(['success' => false, 'statusCode' => Response::HTTP_OK, 'error' => $validator->errors()], Response::HTTP_OK);
        }

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

        if(Auth::User()->id){
            $post->author_id = Auth::User()->id;
        }

        if($request->hasfile('image')) {

           $image = $request->file('image');

           $filename = uniqid('img_') . time() . '.' . $image->getClientOriginalExtension();

           $uploadsFolder =  'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'posts';

           $path = $request->image->storeAs($uploadsFolder, $filename);

           Storage::delete($uploadsFolder."/".$post->image);

           $post->image = $filename;
       }

        $post->save();

        if($categories = $request->input('categories')){

          $delete = CategoryPost::where('post_id', $id);
          $delete->delete();

          foreach ($categories as $item) {
            CategoryPost::create([
              'post_id' => $post->id,
              'category_id' => $item,
            ]);
          }
        }
        // return response($post->jsonSerialize(), Response::HTTP_OK);
        return response()->apiJson(true, Response::HTTP_OK, $post);
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
        // return response()->json(['success' => true, 'status'=>Response::HTTP_OK,'message'=>$post->title.'. deleted'],  Response::HTTP_OK );
        return response()->apiJson(true, Response::HTTP_OK, $post);
    }
}
