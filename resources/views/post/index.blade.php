@extends('layouts.main')

@section('title', 'Account page title...')

@section('content')
<div class="index-content">
    <div class="container">
				@foreach ($posts as $post)
	        <a href="{{ route('post.show', $post->id) }}">
	            <div class="col-lg-4">
	                <div class="card">
											<div class="item-img">
		                    <img src="{{ Storage::url('/uploads/posts/'.$post->image) }}" class="media-object">
											</div>
	                    <h4>{{ $post->title }}</h4>
	                    <p>{{  str_limit($post->content, 100) }}</p>
	                    <a href="{{ route('post.show', $post->id) }}" class="blue-button">Read More</a>
	                </div>
	            </div>
	        </a>
				@endforeach
				<div class="text-center">
						{!! $posts->links() !!}
				</div>
    </div>
</div>
@stop
