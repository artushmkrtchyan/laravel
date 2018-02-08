@extends('admin.layout')

@section('title', 'Shop page')

@section('content')

<div class="media">
	<div class="media-body">
	  <h4 class="media-heading">{{ $shop->name }}</h4>
	  <p>{{ $shop->description }}</p>
	</div>
</div>

@stop
