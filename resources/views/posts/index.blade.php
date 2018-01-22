@extends('layouts.main')

@section('title', 'Posts page title...')

@section('content')
	<div class="container">
		<div class="row">
			<div class="posts-list">
        @foreach ($posts as $post)
					<div class="media">
						<div class="media-left">
						  <img src="{{ Storage::url('/uploads/posts/'.$post->image) }}" class="media-object" style="width:100px">
						</div>
						<div class="media-body">
						  <h4 class="media-heading">{{ $post->title }}</h4>
						</div>
					</div>
					<div class="posts-list-bottom">

						<form id="delete-form" class="pull-left" action="{{ route('post.delete', $post->id) }}" method="post">
								{{ csrf_field() }}
								<button type="submit" class="btn btn-default btn-sm">Delete</button>
						</form>

						<a href="{{ url('/post/edit/'.$post->id) }}">
							<button type="button" class="btn btn-default btn-sm">Edit</button>
						</a>

						<a href="{{ url('/post/'.$post->id) }}">
							<button type="button" class="btn btn-default btn-sm">Viwe</button>
						</a>

					</div>
					<hr>
				@endforeach
			</div>
		</div>
	</div>
@stop
