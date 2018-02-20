<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
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

    public function destroy($id)
    {
        $user = User::find($id);
        if($user->avatar && $user->avatar != 'default.jpg'){
          $uploadsFolder =  'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'avatars';

          Storage::delete($uploadsFolder."/".$user->avatar);
        }

        $user->roles()->sync([]);

        $user->delete();

        return response()->apiJson(true, Response::HTTP_OK, $user);
    }
}
