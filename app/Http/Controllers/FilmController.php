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

      $genres_res = Genre::all('name', 'id');
      $genres[0] = "All";
      foreach ($genres_res as  $genre) {
        $genres[$genre->id] = $genre->name;
      }

      $actors_res = Actor::all('name', 'id');
      $actors[0] = "All";
      foreach ($actors_res as  $actor) {
        $actors[$actor->id] = $actor->name;
      }

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

      if($this->actor_id && $this->genre_id && $year){
        $films = Film::whereHas('actors', function($a) {
            $a->where('actor_id', $this->actor_id);
        })->whereHas('genres', function($g) {
            $g->where('genre_id', $this->genre_id);
        })->where('year', $year)->orderby('id', 'desc')->paginate(12);
      }elseif ($this->actor_id && $this->genre_id && !$year) {
        $films = Film::whereHas('actors', function($a) {
            $a->where('actor_id', $this->actor_id);
        })->whereHas('genres', function($g) {
            $g->where('genre_id', $this->genre_id);
        })->orderby('id', 'desc')->paginate(12);
      }elseif ($this->actor_id && !$this->genre_id && !$year) {
        $films = Film::whereHas('actors', function($a) {
            $a->where('actor_id', $this->actor_id);
        })->orderby('id', 'desc')->paginate(12);
      }elseif (!$this->actor_id && $this->genre_id && !$year) {
        $films = Film::whereHas('genres', function($g) {
            $g->where('genre_id', $this->genre_id);
        })->orderby('id', 'desc')->paginate(12);
      }elseif (!$this->actor_id && $this->genre_id && $year) {
        $films = Film::whereHas('genres', function($g) {
            $g->where('genre_id', $this->genre_id);
        })->where('year', $year)->orderby('id', 'desc')->paginate(12);
      }elseif ($this->actor_id && !$this->genre_id && $year) {
        $films = Film::whereHas('actors', function($a) {
            $a->where('actor_id', $this->actor_id);
        })->where('year', $year)->orderby('id', 'desc')->paginate(12);
      }elseif (!$this->actor_id && !$this->genre_id && $year) {
        $films = Film::where('year', $year)->orderby('id', 'desc')->paginate(12);
      }else{
        $films = Film::orderby('id', 'desc')->paginate(12);
      }

      $genres_res = Genre::all('name', 'id');
      $genres[0] = "All";
      foreach ($genres_res as  $genre) {
        $genres[$genre->id] = $genre->name;
      }

      $actors_res = Actor::all('name', 'id');
      $actors[0] = "All";
      foreach ($actors_res as  $actor) {
        $actors[$actor->id] = $actor->name;
      }

      return view('film.index', compact('films', 'genres', 'actors'));
    }
}
