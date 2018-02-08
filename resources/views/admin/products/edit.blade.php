@extends('admin.layout')

@section('title', 'Edit product')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Edit product</div>

    <div class="panel-body">
        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('product.update', $product->id) }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-2 control-label">Name</label>

                <div class="col-md-9">
                    <input id="title" type="text" class="form-control" name="name" value="{{ $product->name }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

             <div class="form-group">
                <label for="content" class="col-md-2 control-label">description</label>

                <div class="col-md-9">
                    <textarea rows="7" cols="50" class="form-control" name="description">{{ $product->description }}</textarea>
                </div>
            </div>

            <div class="form-group">
                <label for="price" class="col-md-2 control-label">Price</label>

                <div class="col-md-9">
                    <input id="price" type="text" class="form-control" name="price" value="{{ $product->price }}" autofocus>
                </div>
            </div>

            <div class="form-group">
                <label for="code" class="col-md-2 control-label">Code</label>

                <div class="col-md-9">
                    <input id="code" type="text" class="form-control" name="code" value="{{ $product->code }}" autofocus>
                </div>
            </div>

            <div class="form-group">
               <label for="image" class="col-md-2 control-label">Image</label>

               <div class="col-md-9">
                   <input id="image" type="file" name="image">
               </div>
           </div>

           <div class="form-group">
              <label for="shop" class="col-md-2 control-label">Shop</label>

              <div class="col-md-9">
                <select id="shop" name="shop[]" multiple size="4">
                  <?php
                    foreach ($shops as $shop) {
                      $selected = '';
                      foreach ($product->shops as $product_shop) {
                        if($product_shop->id == $shop->id){
                          $selected = 'selected';
                        }
                      }
                  ?>
                    <option {{$selected}} value="{{$shop->id}}">{{$shop->name}}</option>
                  <?php } ?>
               </select>
              </div>
          </div>

            <div class="form-group">
                <div class="col-md-9 col-md-offset-2">
                    <button type="submit" class="btn btn-primary">
                        Edit product
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
