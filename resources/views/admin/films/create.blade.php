@extends('admin.layout')

@section('title', 'Add Film')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Add film</div>

    <div class="panel-body">
        {{ Form::open(['method' => 'post', 'files' => true, 'route'=>'film.store']) }}
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
              {{ Form::label('Title:') }}
              {{ Form::text('title', old('title'), ['class'=>'form-control', 'placeholder'=>'Enter title']) }}
              <span class="text-danger">{{ $errors->first('title') }}</span>
            </div>

            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
              {{ Form::label('description:') }}
              {{ Form::textarea('description', old('description'), ['class'=>'form-control', 'placeholder'=>'Enter description']) }}
              <span class="text-danger">{{ $errors->first('description') }}</span>
            </div>

            <div class="form-group {{ $errors->has('year') ? 'has-error' : '' }}">
              {{ Form::label('year:') }}
              {{ Form::selectYear('year', 1950, date("Y"), ['class' => 'form-control']) }}
              <span class="text-danger">{{ $errors->first('year') }}</span>
            </div>

            <div class="form-group">
              {{ Form::label('Youtube id:') }}
              {{ Form::text('youtube_id', old('youtube_id'), ['class'=>'form-control', 'placeholder'=>'Enter youtube id']) }}
            </div>

            <div class="form-group">
              {{ Form::label('Vidio embed:') }}
              {{ Form::text('vidio_embed', old('vidio_embed'), ['class'=>'form-control', 'placeholder'=>'Enter Vidio embed']) }}
            </div>

            <div class="form-group ">
              {{ Form::label('Status:') }}
              {{ Form::checkbox('status', 'publish') }}
            </div>

            <div class="form-group">
                {!! Form::label('Image') !!}
                {!! Form::file('image', null) !!}
            </div>

            <div class='form-group'>
                @foreach ($genres as $genre)
                  {{ Form::label('Genres', $genre->name) }}
                  {{ Form::checkbox('genres[]', $genre->id) }}
                @endforeach
            </div>

            <div class='form-group'>
                @foreach ($actors as $actor)
                  {{ Form::label('Actor', $actor->name) }}
                  {{ Form::checkbox('actors[]', $actor->id) }}
                @endforeach
            </div>

            <div class="form-group">
              <button class="btn btn-success">Add film</button>
            </div>
        {{ Form::close() }}
    </div>
</div>
@endsection
