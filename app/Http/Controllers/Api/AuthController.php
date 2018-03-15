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
    public function login(Request $request){

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
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
            return response(['success' => false, 'statusCode' => Response::HTTP_UNAUTHORIZED, 'error' => $validator->errors()], Response::HTTP_UNAUTHORIZED);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['avatar'] = 'default.jpg';

        if($request->hasfile('avatar')) {
    			$avatar = $request->file('avatar');
    			$filename = time() . '-' . $request->input('name') . '.' . $avatar->getClientOriginalExtension();

    			$uploadsFolder =  'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'avatars';

    			$path = $request->avatar->storeAs($uploadsFolder, $filename);
          $input['avatar'] = $filename;
    		}


        $user = User::create($input);
        $user->roles()->attach(Role::where('name', 'subscriber')->first());

        return response(['success' => true, 'statusCode' => Response::HTTP_OK, 'token' => $user->createToken('MyApp')->accessToken], Response::HTTP_OK);
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
      $request->user('api')->token()->delete();

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
