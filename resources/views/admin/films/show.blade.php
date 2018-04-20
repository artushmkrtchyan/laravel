@extends('admin.layout')

@section('title', 'Film page')

@section('content')

<div class="media">
	<h3 class="post-title">{{ $film->title }}</h3>
	<div class="media-left">
	  <img src="{{ Storage::url('/uploads/films/'.$film->image) }}" class="media-object" style="width:300px">
	</div>
	<div class="media-body">
    <p>
      <span class ="col-md-3">{{ $film->created_at }}</span>
      <span class ="col-md-9">author: {{ $author->name }}</span>
    </p>
	  <p>{{ $film->description }}</p>
	</div>
</div>

@stop
