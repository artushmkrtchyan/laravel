@extends('layouts.main')

@section('title', 'Film page title...')

@section('content')
	<div class="container">
		<div class="row">
				<div class="col-md-3">
					<div class="item-image">
							<img src="{{ Storage::url('/uploads/films/'.$film->image) }}" class="media-object">
					</div>
				</div>
				<div class="col-md-9">
					<h4>{{ $film->title }}</h4>
						<p>
							<span class ="date">Year: {{ $film->year }}</span>
						</p>
						<p>{{  $film->description }}</p>
				</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				@if (!is_null($film->youtube_id))
					<div class="videoWrapper">
						<iframe width="100%" height="auto" src="https://www.youtube.com/embed/{{$film->youtube_id}}" frameborder="0" allowfullscreen></iframe>
					</div>
				@endif
				@if (!is_null($film->vidio_embed))
					<div class="videoWrapper">
					    {!!$film->vidio_embed!!}
					</div>
				@endif
			</div>
		</div>
	</div>
@stop
