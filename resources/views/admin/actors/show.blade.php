@extends('admin.layout')

@section('title', 'Genre page')

@section('content')

<div class="media">
	<h3 class="post-title">{{ $actor->name }}</h3>
	<div class="media-left">
	  <img src="{{ Storage::url('/uploads/actors/'.$actor->image) }}" class="media-object" style="width:300px">
	</div>
	<div class="media-body">
    <p>
      <span class ="col-md-12">{{ $actor->birthdate }}</span>
    </p>
	  <p>{{ $actor->biography }}</p>
	</div>
</div>

@stop
