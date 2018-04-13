@extends('admin.layout')

@section('title', 'Edit Posts')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Edit posts</div>

    <div class="panel-body">
        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('admin.post.update', $post->id) }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                <label for="name" class="col-md-2 control-label">Name</label>

                <div class="col-md-9">
                    <input id="title" type="text" class="form-control" name="title" value="{{ $post->title }}" autofocus>

                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

             <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                <label for="content" class="col-md-2 control-label">content</label>

                <div class="col-md-9">
                    <textarea rows="7" cols="50" class="form-control" name="content">{{ $post->content }}</textarea>

                    @if ($errors->has('content'))
                        <span class="help-block">
                            <strong>{{ $errors->first('content') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

             <div class="form-group">
                <label for="image" class="col-md-2 control-label">Image</label>

                <div class="col-md-9">
                    <input type="file" name="image">
                </div>
            </div>

            <div class="form-group">
               <label for="image" class="col-md-2 control-label">Status</label>
               <?php $checked = $post->status == 'publish' ? 'checked' : '' ?>
               <div class="col-md-9">
                   <input type="checkbox" name="status" value="publish" {{$checked}}>
               </div>
           </div>

           <div class="form-group ">
               <div class="col-md-offset-1">
                 <h2>Category</h2>
                 @foreach ($categories as $category)
                 <?php $check = ''; ?>
                  @foreach ($category_post as $item)
                  <?php
                  if($item->category_id == $category->id){
                    $check = 'checked';
                  }?>
                  @endforeach
                   <div class="form-check">
                     <label>
                       <input type="checkbox" name="catedories[]" value="{{$category->id}}" {{$check}}> <span class="label-text">{{$category->name}}</span>
                     </label>
                   </div>
                 @endforeach
               </div>
            </div>

            <div class="form-group">
                <div class="col-md-9 col-md-offset-2">
                    <button type="submit" class="btn btn-primary">
                        Edit post
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
