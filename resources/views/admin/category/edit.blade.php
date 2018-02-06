@extends('admin.layout')

@section('title', 'Edit Categoryes')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Edit category</div>

    <div class="panel-body">
        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('category.update', $category->id) }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-2 control-label">Name</label>

                <div class="col-md-9">
                    <input id="name" type="text" class="form-control" name="name" value="{{$category->name}}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

             <div class="form-group">
               <label for="name" class="col-md-2 control-label">Slug</label>

               <div class="col-md-9">
                   <input id="slug" type="text" class="form-control" name="slug" value="{{$category->slug}}" required autofocus>

                   @if ($errors->has('slug'))
                       <span class="help-block">
                           <strong>{{ $errors->first('slug') }}</strong>
                       </span>
                   @endif
               </div>
             </div>

               @if (count($categories) > 1)

                 <div class="form-group">
                   <label for="parent" class="col-md-2 control-label">Parent</label>

                   <div class="col-md-9">
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
                   </div>
                 </div>

               @endif

               <div class="form-group">
                 <label for="order" class="col-md-2 control-label">Order</label>

                 <div class="col-md-9">
                     <input id="order" type="number" class="form-control" name="order" value="{{$taxonomy->order}}">
                 </div>
               </div>

            <div class="form-group">
                <div class="col-md-9 col-md-offset-2">
                    <button type="submit" class="btn btn-primary">
                        Edit category
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
