@extends('admin.layout')

@section('title', 'User')

@section('content')

<div class="media">
	<div class="media-left">
	  <img src="{{ Storage::url('/uploads/avatars/'.$user->avatar) }}" class="media-object" style="width:60px">
	</div>
	<div class="media-body">
	  <h4 class="media-heading">{{ $user->name }}</h4>
	  <p>{{ $user->description }}</p>
	</div>
</div>
<hr>

@stop
