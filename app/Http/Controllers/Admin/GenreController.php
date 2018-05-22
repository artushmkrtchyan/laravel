<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Models\Genre;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $genres = Genre::orderby('id', 'desc')->paginate(10);
      if(count($genres) >= 1){
        return view('admin.genres.index', compact('genres'));
      }else{
        return Redirect::to('/admin/genre/create');
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.genres.create');
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
          'description' => 'required',
      ]);

      if ($validator->fails()) {

        return view('admin.genres.create')->withErrors($validator);
      }

      $genre = Genre::create([
        'name' => $request->input('name'),
        'description' => $request->input('description'),
      ]);

      return Redirect::to(route('genre.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $genre = Genre::findOrFail($id);

      return view('admin.genres.show', compact('genre'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $genre = Genre::find($id);

      return view('admin.genres.edit', compact('genre'));
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

      $genre = Genre::find($id);

      $validator = Validator::make($request->all(), [
          'name' => 'required',
          'description' => 'required',
      ]);

      if ($validator->fails()) {
        return view('admin.genres.edit', compact('genre'))->withErrors($validator);
      }

      $genre->name = $request->input('name');

      $genre->description = $request->input('description');

      $genre->save();

      return Redirect::to(route('genre.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $genre = Genre::find($id);

      $genre->delete();

      return Redirect::to(route('genre.index'));
    }
}
