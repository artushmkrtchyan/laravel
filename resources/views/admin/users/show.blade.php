@extends('layouts.main')

@section('title', 'Account page title...')

@section('content')
	<div class="container">
		<div class="row">
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
		</div>
	</div>
@stop