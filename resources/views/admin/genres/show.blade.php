@extends('admin.layout')

@section('title', 'Genre page')

@section('content')

<div class="media">
	<div class="media-body">
	  <h4 class="media-heading">{{ $genre->name }}</h4>
	  <p>{{ $genre->description }}</p>
	</div>
</div>

@stop
