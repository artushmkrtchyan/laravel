@extends('admin.layout')

@section('title', 'Add Shops')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Add genre</div>

    <div class="panel-body">
        {!! Form::open(['method' => 'post', 'files' => true, 'route'=>'actor.store']) !!}
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
              {!! Form::label('Name:') !!}
              {!! Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=>'Enter name']) !!}
              <span class="text-danger">{{ $errors->first('name') }}</span>
            </div>
            <div class="form-group">
              {{ Form::label('Biography:') }}
              {{ Form::textarea('biography', old('biography'), ['class'=>'form-control', 'placeholder'=>'Enter biography']) }}
            </div>

            <div class="form-group">
              {{ Form::label('Birthdate:') }}
              {!! Form::text('birthdate', '', ['id' => 'datepicker', 'data-provide' => 'datepicker']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('Image') !!}
                {!! Form::file('image', null) !!}
            </div>

            <div class="form-group">
              <button class="btn btn-success">Add actor</button>
            </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection
