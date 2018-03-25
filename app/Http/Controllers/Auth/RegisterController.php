<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $request
     * @return \App\User
     */

	protected function create(Request $request)
	{

    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
    ]);

    if ($validator->fails()) {
      return view('auth.register')->withErrors($validator);
    }

		$filename = 'default.jpg';

		if($request->hasfile('avatar')) {
			$avatar = $request->file('avatar');
			$filename = time() . '-' . $request->input('name') . '.' . $avatar->getClientOriginalExtension();

			$uploadsFolder =  'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'avatars';

			$path = $request->avatar->storeAs($uploadsFolder, $filename);
		}

		$user = User::create([
			'name' => $request->input('name'),
      'email' => $request->input('email'),
      'password' => bcrypt($request->input('password')),
      'description' => $request->input('description'),
			'avatar' => $filename,
		]);

    $user->roles()->attach(Role::where('name', 'subscriber')->first());

    Auth::login($user);

    return Redirect::to('/account');
	}

}
