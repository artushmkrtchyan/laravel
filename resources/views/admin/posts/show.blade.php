@extends('admin.layout')

@section('title', 'Post page')

@section('content')

<div class="media">
	<h3 class="post-title">{{ $post->title }}</h3>
	<div class="media-left">
	  <img src="{{ Storage::url('/uploads/posts/'.$post->image) }}" class="media-object" style="width:300px">
	</div>
	<div class="media-body">
    <p>
      <span class ="col-md-3">{{ $post->created_at }}</span>
      <span class ="col-md-9">author: {{ $author->name }}</span>
    </p>
	  <p>{{ $post->content }}</p>
	</div>
</div>

@stop
