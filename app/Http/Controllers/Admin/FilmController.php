<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Film;
use App\Models\Genre;
use App\Models\Actor;
use App\Models\User;
use Auth;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $films = Film::orderby('id', 'desc')->paginate(10);

      if(count($films) >= 1){
        return view('admin.films.index', compact('films'));
      }else{
        return Redirect::to(route('film.create'));
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genres = Genre::all();

        $actors = Actor::all();

        return view('admin.films.create', compact('genres', 'actors'));
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
          'title' => 'required|string',
          'description' => 'required',
          'year' => 'required',
          'genres' => 'required',
      ]);

      if ($validator->fails()) {

        $genres = Genre::all();
        return view('admin.films.create', compact('genres'))->withErrors($validator);
      }

      $filename = 'no.png';
      $status = $request->input('status') ? $request->input('status') : 'no-publish';
      $author_id = Auth::User()->id;

      if($request->hasfile('image')) {

        $image = $request->file('image');

        $filename = uniqid('img_') . time() . '.' . $image->getClientOriginalExtension();

        $uploadsFolder =  'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'films';

        $path = $request->image->storeAs($uploadsFolder, $filename);
      }

      $film = Film::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'year' => $request->input('year'),
                'youtube_id' => $request->input('youtube_id'),
                'vidio_embed' => $request->input('vidio_embed'),
                'status' => $status,
                'author_id' => $author_id,
                'image' => $filename,
              ]);

      $film->genres()->sync($request->input('genres'));
      $film->actors()->sync($request->input('actors'));

      return Redirect::to(route('film.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $film = Film::findOrFail($id);
      $author = User::findOrFail($film->author_id);
      return view('admin.films.show', compact('film', 'author'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $genres = Genre::all();
        $film = Film::findOrFail($id);
        $actors = Actor::all();

        return view('admin.films.edit', compact('genres', 'film', 'actors'));
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
            'title' => 'required',
            'description' => 'required',
            'year' => 'required',
            'genres' => 'required',
        ]);

        if ($validator->fails()) {
            $film = Film::findOrFail($id);
            $genres = Genre::all();
            return view('admin.films.edit', compact('genres', 'film'));
        }

        $filename = 'no.png';
        $status = $request->input('status') ? $request->input('status') : 'no-publish';
        $author_id = Auth::User()->id;

        $film = Film::find($id);

        $film->title = $request->input('title');
        $film->description = $request->input('description');
        $film->year = $request->input('year');
        $film->youtube_id = $request->input('youtube_id');
        $film->vidio_embed = $request->input('vidio_embed');
        $film->status = $status;
        $film->author_id = $author_id;

        if($request->hasfile('image')) {
           $image = $request->file('image');
           $filename = uniqid('img_') . time() . '.' . $image->getClientOriginalExtension();
           $uploadsFolder =  'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'films';
           $path = $request->image->storeAs($uploadsFolder, $filename);
           Storage::delete($uploadsFolder."/".$film->image);

           $film->image = $filename;
       }

       $film->save();

       $genres = $request->input('genres');
       $actors = $request->input('actors');
       $film->genres()->sync($genres);
       $film->actors()->sync($actors);

       return Redirect::to(route('film.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $film = Film::find($id);

      if($film->image){
        $uploadsFolder =  'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'films';
        Storage::delete($uploadsFolder."/".$film->image);
      }

      $film->delete();

      $film->genres()->sync([]);
      $film->actors()->sync([]);

      return Redirect::to(route('film.index'));
    }
}
