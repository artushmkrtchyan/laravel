@extends('layouts.main')

@section('title', 'Home')

@section('content')
    <div class="container">
        <div class="flex-center position-ref full-height">


            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="{{ route('post.index') }}">Posts</a>
					          <a href="{{ route('account') }}">Account</a>
                    <a href="{{ route('views.film.index') }}">Films</a>
                </div>
            </div>
        </div>
    </div>
@stop
