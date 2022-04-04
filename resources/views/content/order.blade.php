@extends('layouts/contentLayoutMaster')

@section('title', 'Order: ' . $order->OrderId)

@section('content')
<!-- Kick start -->

<div class="card">
  <div class="card-header">
    <h4 class="card-title">Order Prov Detail: {{ $order->OrderId }}</h4>
  </div>
  <div class="card-body">
      <div class="card" style="width: 18rem;">
      
  <div class="card-body">
    <h5 class="card-title">{{ $order->OrderId }}</h5>
    <p class="card-text">{{ $order->SalesOpsNotes }}</p>
    <div><b>IpEngStatus: </b>{{ $order->OrderId }}</div>
    <div><b>StatusCode: </b>{{ $order->StatusCode }}</div>
    <div><b>OrderCreatedDt: </b>{{ $order->OrderCreatedDt }}</div>
    <div><b>CustCutOverDt: </b>{{ $order->CustCutOverDt }}</div>
    <div><b>IPENGNotes: </b>{{ $order->IPENGNotes }}</div>
  </div>
</div>
  </div>
</div>
<!--/ Kick start -->
@endsection
