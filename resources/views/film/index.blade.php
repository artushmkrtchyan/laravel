@extends('layouts.main')

@section('title', 'Film page title...')

@section('content')
<div class="index-content film">
    <div class="container">
      <div class="row">
        <div class="filter">
          <form action="{{ route('film.filter') }}" method="post">
            {!! csrf_field() !!}
            <div class="col-md-4">
                {{ Form::label('Genre') }}
                {{Form::select("genre", $genres)}}
            </div>
            <div class="col-md-4">
                {{ Form::label('Actor') }}
                {{Form::select("actor", $actors)}}
            </div>
            <div class="col-md-2">
                {{ Form::label('Year') }}
                {{ Form::select('year', ['0' => 'All'] + array_combine(range(1990, date("Y")), range(1990, date("Y")))) }}
            </div>
            <div class="col-md-2">
              <button type="submit" class="btn btn-primary btn-sm">Submit</button>
            </div>
            </form>
        </div>
      </div>
      <div class="row">
				@foreach ($films as $film)
	        <a href="{{ route('views.film.show', $film->id) }}">
	            <div class="col-lg-4">
	                <div class="card">
											<div class="item-img">
		                    <img src="{{ Storage::url('/uploads/films/'.$film->image) }}" class="media-object">
											</div>
	                    <h4>{{ $film->title }}</h4>
	                    <p>{!! str_limit($film->description, 100) !!}</p>
	                    <a href="{{ route('views.film.show', $film->id) }}" class="blue-button">Read More</a>
	                </div>
	            </div>
	        </a>
				@endforeach
      </div>
				<div class="text-center">
						{!! $films->links() !!}
				</div>
    </div>
</div>
@stop
