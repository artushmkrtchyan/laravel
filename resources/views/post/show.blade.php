@extends('layouts.main')

@section('title', 'Post page title...')

@section('content')
	<div class="container">
		<div class="row">
				<div class="col-md-8">
					<div class="item-image">
						<h4>{{ $post->title }}</h4>
							<p>
								<span class ="date">{{ $post->created_at }}</span>
								<span class ="author">author: {{ $author->name }}</span>
							</p>
							<img src="{{ Storage::url('/uploads/posts/'.$post->image) }}" class="media-object">
							<p>{!! $post->content !!}</p>
					</div>
				</div>
		</div>
	</div>
@stop
