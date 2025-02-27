@extends('layouts.app')

@section('content')

<div class="container">
  @if(Auth::user()->is_admin == true)
  <div class="row">
    <a class="mb-3" href="{{route('create_product')}}"><button type="submit" class="btn btn-primary">Add New Product</button></a>
  </div>  
  @endif
  @foreach($products as $product)
      <div class="card mb-3 p-3">
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{$product->name}}" />
        <p>Name : {{$product->name}}</p>
        <p>Price :  {{$product->price}}</p>
        <p>Stock :  {{$product->stock}}</p>
        <div class="d-flex mb-3">
          <form method="get" action="{{route('show_product', $product)}}">
            @csrf
            <button type="submit" class="btn btn-primary me-3">Show Detail</button>
          </form>
          <form method="get" action="{{route('edit_product', $product)}}">
            @csrf
            <button type="submit" class="btn btn-primary me-3">Edit</button>
          </form>
          <form method="post" action="{{route('delete_product', $product)}}">
            @method('delete')
            @csrf
            <button type="submit" class="btn btn-primary me-3">Delete</button>
          </form>
        </div>
        <form method="post" action="{{route('add_to_cart', $product)}}">
          @csrf
          <input type="number" name="amount" value=1 />
          <button type="submit" class="btn btn-primary">Add To Cart</button>
          @if($errors->any())
            @foreach($errors->all() as $error)
              <p>{{$error}}</p>
            @endforeach
          @endif
        </form>
      </div>
    @endforeach
</div>
@endsection
