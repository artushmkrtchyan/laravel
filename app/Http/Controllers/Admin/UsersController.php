<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Storage;

use Auth;

use App\Models\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $users = User::orderby('id', 'desc')->paginate(5);
    	return view('admin.users.index', array('users' => $users) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
      $user = User::findOrNew($id);

      return view('admin.users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $user = User::findOrNew($id);

      return view('admin.users.edit', ['user' => $user]);
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

            Storage::delete($uploadsFolder."/".$user->avatar);

            $user->avatar = $filename;
     		}

         $user->save();

         return Redirect::to('/admin/users');
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $user = User::find($id);
      if($user->avatar && $user->avatar != 'default.jpg'){
        $uploadsFolder =  'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'avatars';

        Storage::delete($uploadsFolder."/".$user->avatar);
      }

      $user->delete();

      return Redirect::to('/admin/users');
    }
}
