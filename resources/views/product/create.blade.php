@extends('layouts.app')

@section('content')
<div class="container">
  <form action="{{ route('store_product') }}" method="post" class="row justify-content-center" enctype="multipart/form-data">
    @csrf
    <div class="mb-3 row">
      <label class="col-sm-2 col-form-label" for="name">{{__('Name')}}</label>
      <div class="col-sm-10">
        <input autocomplete="off" class="form-control" type="text" id="name" name="name" />
      </div>
    </div>
    <div class="mb-3 row">
      <label class="col-sm-2 col-form-label" for="price">{{__('Price')}}</label>
      <div class="col-sm-10">
        <input autocomplete="off" class="form-control" id="price" type="number" name="price" />
      </div>
    </div> 
    <div class="mb-3 row">
      <label class="col-sm-2 col-form-label" for="description">{{__('Description')}}</label>
      <div class="col-sm-10">
        <textarea autocomplete="off" class="form-control" id="description" name="description"></textarea>
      </div>
    </div>
    <div class="mb-3 row">  
      <label class="col-sm-2 col-form-label" for="stock">{{__('Stock')}}</label>
      <div class="col-sm-10">
        <input autocomplete="off" name="stock" class="form-control" id="stock" type="number" />
      </div>
    </div>
    <div class="mb-3 row">  
      <label class="col-sm-2 col-form-label" for="image">{{__('Image')}}</label>
      <div class="col-sm-10">
        <input class="form-control" name="image" id="image" type="file" />
      </div>
    </div>
    <div>
      <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
    </div>
  </form>
</div>
@endsection
