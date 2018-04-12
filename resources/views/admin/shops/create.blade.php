@extends('admin.layout')

@section('title', 'Add Shops')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Add shops</div>

    <div class="panel-body">
        {!! Form::open(['method' => 'post', 'route'=>'shops.store']) !!}
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
              {!! Form::label('Name:') !!}
              {!! Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=>'Enter name']) !!}
              <span class="text-danger">{{ $errors->first('name') }}</span>
            </div>

            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
              {!! Form::label('description:') !!}
              {!! Form::textarea('description', old('description'), ['class'=>'form-control', 'placeholder'=>'Enter description']) !!}
              <span class="text-danger">{{ $errors->first('description') }}</span>
            </div>

            <div class="form-group">
              <button class="btn btn-success">Add shop</button>
            </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection
