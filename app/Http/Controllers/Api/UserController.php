<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;


class UserController extends Controller
{
    public function index()
    {
      $users = User::orderby('id', 'desc')->paginate(10);

      return response()->apiJson(true, Response::HTTP_OK, $users);
    }

    public function show($id)
    {
      $user = User::findOrFail($id);

      return response()->apiJson(true, Response::HTTP_OK, $user);
    }

    public function userposts(Post $post)
    {
      $posts = Post::orderby('id', 'desc')->where('author_id', '=', Auth::User()->id)->get();

      return response()->apiJson(true, Response::HTTP_OK, $posts);
    }

    public function update(Request $request, $id)
    {

        $user = User::find($id);

        $user->name = $request->input('name');

        if($user->email !== $request->input('email'))
        {
            $user->email = $request->input('email');
        }

        if($request->input('description') && $request->input('description') != '')
        {
            $user->description = $request->input('description');
        }

        if($request->hasfile('avatar')) {

           $avatar = $request->file('avatar');

           $filename = time() . '-' . $request->input('name') . '.' . $avatar->getClientOriginalExtension();
           //Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename) );

           $uploadsFolder =  'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'avatars';

           $path = $request->avatar->storeAs($uploadsFolder, $filename);
           if($user->avatar){
             Storage::delete($uploadsFolder."/".$user->avatar);
           }

           $user->avatar = $filename;
       }

        $user->save();

        return response()->apiJson(true, Response::HTTP_OK, $user);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if($user->avatar && $user->avatar != 'default.jpg'){
          $uploadsFolder =  'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'avatars';

          Storage::delete($uploadsFolder."/".$user->avatar);
        }

        $user->delete();

        return response()->apiJson(true, Response::HTTP_OK, $user);
    }
}
