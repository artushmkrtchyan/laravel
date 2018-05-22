@extends('layouts.main')

@section('title', 'Film page title...')

@section('content')
<div class="index-content">
    <div class="container">
				@foreach ($films as $film)
	        <a href="{{ route('views.film.show', $film->id) }}">
	            <div class="col-lg-4">
	                <div class="card">
											<div class="item-img">
		                    <img src="{{ Storage::url('/uploads/films/'.$film->image) }}" class="media-object">
											</div>
	                    <h4>{{ $film->title }}</h4>
	                    <p>{{  str_limit($film->description, 100) }}</p>
	                    <a href="{{ route('views.film.show', $film->id) }}" class="blue-button">Read More</a>
	                </div>
	            </div>
	        </a>
				@endforeach
				<div class="text-center">
						{!! $films->links() !!}
				</div>
    </div>
</div>
@stop
