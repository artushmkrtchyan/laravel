@extends('admin.layout')

@section('title', 'Post page')

@section('content')

<div class="media">
	<div class="media-left">
	  <img src="{{ Storage::url('/uploads/posts/'.$post->image) }}" class="media-object" style="width:300px">
	</div>
	<div class="media-body">
	  <h4 class="media-heading">{{ $post->getClientOriginalExtension }}</h4>
    <p>
      <span class ="col-md-3">{{ $post->created_at }}</span>
      <span class ="col-md-9">author: {{ $author->name }}</span>
    </p>
	  <p>{{ $post->content }}</p>
	</div>
</div>

@stop
