@extends('layouts.app')

@section('title', 'Order')
@section('content')
<div class="container">
   <table class="table">
    <tr>
      <th>Name</th>
      <th>Amount</th>
      <th>Price</th>
    </tr>
    @foreach($order->transactions as $detail)
      <tr>
        <td>{{$detail->product->name}}</td>
        <td>{{$detail->amount}}</td>
        <td>{{$detail->product->price}}</td>
      </tr>
    @endforeach

  </table>
  @if(!$order->is_paid && $order->payment_receipt == null)
  <form action="{{route('submit_payment_receipt', $order)}}" method="post" enctype="multipart/form-data">
    @csrf
    <label class="mb-1">Upload payment receipt</label>
    <input type="file" class="form-control mb-3" name="payment_receipt" />
    <button type="submit" class="btn btn-primary">Submit Payment Receipt</button>
  </form>
  @endif
</div>
@endsection
