<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Actor;

class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $actors = Actor::orderby('id', 'desc')->paginate(10);

      if(count($actors) >= 1){
        return view('admin.actors.index', compact('actors'));
      }else{
        return Redirect::to(route('actor.create'));
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.actors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
          'name' => 'required',
      ]);

      if ($validator->fails()) {
        return view('admin.actors.create')->withErrors($validator);
      }

      $filename = 'no.png';

      if($request->hasfile('image')) {

        $image = $request->file('image');

        $filename = uniqid('img_') . time() . '.' . $image->getClientOriginalExtension();

        $uploadsFolder =  'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'actors';

        $path = $request->image->storeAs($uploadsFolder, $filename);
      }

      $actor = Actor::create([
                'name' => $request->input('name'),
                'biography' => $request->input('biography'),
                'birthdate' => $request->input('birthdate'),
                'image' => $filename,
              ]);

      return Redirect::to(route('actor.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $actor = Actor::findOrFail($id);
      return view('admin.actors.show', compact('actor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $actor = Actor::findOrFail($id);
      return view('admin.actors.edit', compact('actor'));
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
      $validator = Validator::make($request->all(), [
          'name' => 'required',
      ]);

      if ($validator->fails()) {
          $actor = Actor::findOrFail($id);
          return view('admin.actors.edit', compact('actor'));
      }

      $filename = 'no.png';

      $actor = Actor::findOrFail($id);

      $actor->name = $request->input('name');
      $actor->biography = $request->input('biography');
      $actor->birthdate = $request->input('birthdate');

      if($request->hasfile('image')) {
         $image = $request->file('image');
         $filename = uniqid('img_') . time() . '.' . $image->getClientOriginalExtension();
         $uploadsFolder =  'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'actors';
         $path = $request->image->storeAs($uploadsFolder, $filename);
         Storage::delete($uploadsFolder."/".$actor->image);

         $actor->image = $filename;
     }

     $actor->save();

     return Redirect::to(route('actor.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $actor = Actor::findOrFail($id);

      if($actor->image){
        $uploadsFolder =  'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'actors';
        Storage::delete($uploadsFolder."/".$actor->image);
      }

      $actor->delete();

      return Redirect::to(route('actor.index'));
    }
}
