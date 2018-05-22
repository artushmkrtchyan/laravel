<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;

class FilmController extends Controller
{
    public function index()
    {
      $films = Film::orderby('id', 'desc')->paginate(12);

      return view('film.index', compact('films'));
    }

    public function show($id)
    {
      $film = Film::findOrFail($id);

      return view('film.show', compact('film'));
    }
}
