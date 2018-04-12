@extends('admin.layout')

@section('title', 'Edit Categoryes')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Edit category</div>

    <div class="panel-body">
        {!! Form::open(['method' => 'PUT', 'route'=>['category.update', $category->id]]) !!}
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
              {!! Form::label('Name:') !!}
              {!! Form::text('name', old('name', $category->name), ['class'=>'form-control', 'placeholder'=>'name']) !!}
              <span class="text-danger">{{ $errors->first('name') }}</span>
            </div>

            <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
              {!! Form::label('Slug:') !!}
              {!! Form::text('slug', old('name', $category->slug), ['class'=>'form-control', 'placeholder'=>'slug']) !!}
              <span class="text-danger">{{ $errors->first('slug') }}</span>
            </div>

            @if (count($categories) > 1)
              <div class="form-group {{ $errors->has('parent') ? 'has-error' : '' }}">
                {!! Form::label('Parent:') !!}
                <select name="parent">
                  <option value="">No parent</option>
                    @foreach ($categories as $item)
                    <?php if($item->id == $taxonomy->parent){
                       $selected = 'selected';
                     }else{
                        $selected = '';
                      }
                     ?>
                     @if ($item->id != $category->id)
                       <option value="{{$item->id}}" {{$selected}}>{{$item->name}}</option>
                     @endif
                    @endforeach
               </select>
                <span class="text-danger">{{ $errors->first('parent') }}</span>
              </div>
            @endif

            <div class="form-group {{ $errors->has('order') ? 'has-error' : '' }}">
              {!! Form::label('Order:') !!}
              {!! Form::number('order', old('order', $taxonomy->order), ['class'=>'form-control', 'placeholder'=>'order']) !!}
              <span class="text-danger">{{ $errors->first('order') }}</span>
            </div>

            <div class="form-group">
              <button class="btn btn-success">Edit category</button>
            </div>
        {!! Form::close() !!}


    </div>
</div>
@endsection
