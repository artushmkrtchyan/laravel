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
                <label for="genre">Genre</label>
                <select id="genre" name="genre">
                    <option value="">All</option>
                    @foreach ($genres as $genre)
                        <option value="{!! $genre->id !!}">{!! $genre->name !!}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="actor">Actor</label>
                <select id="actor" name="actor">
                    <option value="">All</option>
                    @foreach ($actors as $actor)
                        <option value="{!! $actor->id !!}">{!! $actor->name !!}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                {{ Form::label('year') }}
                {{ Form::selectYear('year', 1950, date("Y"), ['class' => 'form-control']) }}
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
	                    <p>{{  str_limit($film->description, 100) }}</p>
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
