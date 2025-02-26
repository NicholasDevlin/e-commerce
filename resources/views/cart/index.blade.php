@extends('layouts.app')

@section('content')
<div class="container">
  @foreach($carts as $cart)
      <div class="card mb-3 p-3">
        <img src="{{ asset('storage/' . $cart->product->image) }}" alt="{{$cart->product->name}}" />
        <p>Name : {{$cart->product->name}}</p>
        <p>Price :  {{$cart->product->price}}</p>
        <form method="post" action="{{route('update_cart', $cart)}}">
          @method('patch')
          @csrf
          <label>Amount : </label>
          <input type="number" name="amount" value="{{$cart->amount}}" />
          <button type="submit" class="btn btn-primary">Update</button>
        </form>
        <form method="post" action="{{route('delete_cart', $cart)}}">
          @method('delete')
          @csrf
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        @if($errors->any())
          @foreach($errors->all() as $error)
            <p>{{$error}}</p>
          @endforeach
        @endif
      </div>
    @endforeach
    <form method="post" action="{{route('checkout')}}">
      @csrf
      <button type="submit" class="btn btn-primary">Checkout</button>
    </form>
</div>
@endsection
