@extends('layouts.app')

@section('content')
<div class="container">
  @foreach($products as $product)
      <div class="card mb-3 p-3">
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{$product->name}}" />
        <p>Name : {{$product->name}}</p>
        <p>Price :  {{$product->price}}</p>
        <p>Stock :  {{$product->stock}}</p>
        <form method="get" action="{{route('show_product', $product)}}">
          @csrf
          <button type="submit" class="btn btn-primary mb-3">Show Detail</button>
        </form>
        <form method="get" action="{{route('edit_product', $product)}}">
          @csrf
          <button type="submit" class="btn btn-primary">Edit</button>
        </form>
        <form method="post" action="{{route('delete_product', $product)}}">
          @method('delete')
          @csrf
          <button type="submit" class="btn btn-primary">Delete</button>
        </form>
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
