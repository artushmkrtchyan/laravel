<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Models\Genre;
use App\Models\Actor;

class FilmController extends Controller
{
    private $actor_id;
    private $genre_id;

    public function index()
    {
      $films = Film::orderby('id', 'desc')->paginate(12);

      $genres = Genre::all();
      $actors = Actor::all();

      return view('film.index', compact('films', 'genres', 'actors'));
    }

    public function show($id)
    {
      $film = Film::findOrFail($id);

      return view('film.show', compact('film'));
    }

    public function filter(Request $request){
      $this->actor_id = $request->input('actor');
      $this->genre_id = $request->input('genre');
      $year = $request->input('year');

      $films = Film::whereHas('actors', function($a) {
          $a->where('actor_id', $this->actor_id);
      })->whereHas('genres', function($g) {
          $g->where('genre_id', $this->genre_id);
      })->where('year', $year)->paginate(12);

      // foreach ($films as $film) {
      //   echo '<pre>';
      //    print_r($film->title);
      //    echo '</pre>';
      // }
      //
      // dd($films);

      $genres = Genre::all();
      $actors = Actor::all();

      return view('film.index', compact('films', 'genres', 'actors'));
    }
}
