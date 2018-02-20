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


class AuthController extends Controller
{


    public $successStatus = 200;


    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }


    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);


        if ($validator->fails()) {
            return response()->apiJson(false, Response::HTTP_UNAUTHORIZED, $validator->errors());
        }


        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['avatar'] = 'default.jpg';
        $user = User::create($input);
        $user->roles()->attach(Role::where('name', 'subscriber')->first());

        // $success['token'] =  $user->createToken('MyApp')->accessToken;
        // $success['name'] =  $user->name;
        // return response()->json(['success'=>$success], $this->successStatus);
        return response()->apiJson(true, Response::HTTP_OK, $user->createToken('MyApp')->accessToken);
    }


    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $user = Auth::user();
        return response()->apiJson(true, Response::HTTP_OK, $user);
    }

    public function logout(Request $request)
    {
      if (!$this->guard()->check()) {

          return response()->apiJson(false, Response::HTTP_NOT_FOUND, "No active user session was found");

      }

      $request->user('api')->token()->revoke();

      Auth::guard()->logout();

      Session::flush();

      Session::regenerate();

      return response()->apiJson(true, Response::HTTP_OK, "User was logged out");
    }

    protected function guard()
    {
        return Auth::guard('api');
    }
}
