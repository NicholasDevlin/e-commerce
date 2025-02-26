@extends('layouts.app')

@section('title', $product->name)
@section('content')
<div class="container">
  <div class="card mb-3 p-3">
    <a href="{{route('product')}}">Back</a>
    <img src="{{ asset('storage/' . $product->image) }}" alt="{{$product->name}}" />
    <p>Name : {{$product->name}}</p>
    <p>Price :  {{$product->price}}</p>
    <p>Stock :  {{$product->stock}}</p>
  </div>
</div>
@endsection
