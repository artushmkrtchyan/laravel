<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;

use App\Models\Post;

use App\Models\Categories;

use App\Models\CategoryPost;

use Auth;

use App\Models\User;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderby('id', 'desc')->where('status', 'publish')->paginate(10);

        return view('admin.posts.index', compact('posts'));
    }

    public function createForm()
    {
        $categories = Categories::all();

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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

        return Redirect::to('/admin/posts/create');
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
        $post = Post::find($id);

        $author = User::find($post->author_id);

        return view('admin.posts.show', compact('post', 'author'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $post = Post::find($id);

      $categories = Categories::all();

     $category_post = DB::select('select * from category_post where post_id = ?', [$id]);

      return view('admin.posts.edit', compact('post', 'categories', 'category_post'));
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
      $author_id = Auth::User()->id;

      $status = $request->input('status') ? $request->input('status') : 'no-publish';

      $post = Post::find($id);

      $post->title = $request->input('title');

      $post->content = $request->input('content');

      $post->status = $status;

      $post->author_id = $author_id;

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

      return Redirect::to('/admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

      return Redirect::to('/admin/posts');
    }
}
