@extends('layouts.app')

@section('title', 'Order')
@section('content')
<div class="container">
  <form method="GET" action="{{ route('order') }}">
      <div class="input-group mb-3">
          <input autocomplete="off" type="text" name="search" class="form-control" placeholder="Search by Buyer Name" value="{{ request('search') }}">
          <button type="submit" class="btn btn-primary">Search</button>
      </div>
  </form>
   <table class="table">
    <tr>
      <th>Status</th>
      <th>Buyer</th>
      <th>Payment Receipt</td>
      <th>Action</th>
    </tr>
    @foreach($orders as $order)
      <tr>
        <td>
          @if($order->is_paid)
          <span class="badge text-bg-success">Paid</span>
          @else
          <span class="badge text-bg-danger">Not Paid</span>
          @endif
        </td>
        <td>{{$order->user->name}}</td>
        <td><a href="{{asset('storage/' . $order->payment_receipt) }}">{{$order->payment_receipt != null ? 'Show Payment Receipt' : ''}}</a></td>
        <td>
          <form action="{{route('order_detail', $order)}}" method="get">
            @csrf
            <button type="submit" class="btn btn-primary">Detail</button>
          </form>
          <form action="{{route('confirm_payment', $order)}}" method="post">
            @csrf
            <button type="submit" class="btn btn-primary" {{ $order->is_paid == 1 ? 'disabled' : '' }}>Confirm</button>
          </form>
        </td>
      </tr>
    @endforeach
  </table>
  <div>{{$orders->appends($_GET)->links('vendor.pagination.custom')}}</div>
</div>
@endsection
