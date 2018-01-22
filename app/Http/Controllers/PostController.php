<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Storage;

use App\Post;

use Auth;

use App\User;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index', array('posts' => Post::all()));
    }

    public function createForm()
    {
        return view('posts.create', array('posts' => 'add' ));
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

        Post::create([
          'title' => $request->input('title'),
          'content' => $request->input('content'),
          'status' => $status,
          'author_id' => $author_id,
          'image' => $filename,
        ]);

        return Redirect::to('/posts/create');
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
        $user = User::find($post->author_id);
        return view('posts.show', array('post' => $post, 'user' => $user));
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
      return view('posts.edit', array('post' => $post));
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

      return Redirect::to('/posts');
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

      return Redirect::to('/posts');
    }
}
