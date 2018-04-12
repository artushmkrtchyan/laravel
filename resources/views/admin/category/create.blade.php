@extends('admin.layout')

@section('title', 'Create Categoryes')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Add category</div>

    <div class="panel-body">
      {!! Form::open(['method' => 'post', 'route'=>'category.store']) !!}
              <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                {!! Form::label('Name:') !!}
                {!! Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=>'name']) !!}
                <span class="text-danger">{{ $errors->first('name') }}</span>
              </div>

              <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                {!! Form::label('Slug:') !!}
                {!! Form::text('slug', old('name'), ['class'=>'form-control', 'placeholder'=>'slug']) !!}
                <span class="text-danger">{{ $errors->first('slug') }}</span>
              </div>

                @if (count($categories) > 1)
                  <div class="form-group {{ $errors->has('parent') ? 'has-error' : '' }}">
                    {!! Form::label('Parent:') !!}
                    <select name="parent">
                      <option value="">No parent</option>
                        @foreach ($categories as $item)

                           <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                   </select>
                    <span class="text-danger">{{ $errors->first('parent') }}</span>
                  </div>
                @endif

              <div class="form-group {{ $errors->has('order') ? 'has-error' : '' }}">
                {!! Form::label('Order:') !!}
                {!! Form::number('order', old('order'), ['class'=>'form-control', 'placeholder'=>'order']) !!}
                <span class="text-danger">{{ $errors->first('order') }}</span>
              </div>

              <div class="form-group">
                <button class="btn btn-success">Add new</button>
              </div>
          {!! Form::close() !!}
        </form>
    </div>
</div>
@endsection
