@extends('user.layout.master')
@section('breadcrumb')
    <a class="breadcrumb-item text-dark" href="{{ route('user#home') }}">Home</a>
@endsection
@section('breadcrumb_one')
    <a class="breadcrumb-item text-dark" href="{{ route('user#order') }}">Orderlist</a>
@endsection
@section('breadcrumb_two')
    <span class="breadcrumb-item active">detail</span>
@endsection
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-10 offset-1">
                <div class="my-3 text-dark" onclick="history.back()">
                    <i class="fa-solid fa-arrow-left me-3" ></i>Back
                </div>
                <div class="row col-6">
                    
                    <div class="card p-4 my-5">
                        <div class="card-body">
                            <h3><i class="fa-solid fa-clipboard me-2 mb-2"></i>Order Info</h3>
                            <small class="text-warning">Include Delivery charge</small>
                        </div>
                        <hr>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col"><i class="fa-solid fa-user me-2"></i>Name</div>
                                <div class="col">: {{ $order[0]->userName }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col"><i class="fa-solid fa-location me-2"></i> Address</div>
                                <div class="col">: {{ $orderInfo->address }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col"><i class="fa-solid fa-phone me-2"></i>Phone</div>
                                <div class="col">: {{ $orderInfo->phone }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col"><i class="fa-solid fa-message me-2"></i>Note</div>
                                <div class="col">: {{ $orderInfo->message }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col"><i class="fa-solid fa-money-bill-wave me-2"></i>Total</div>
                                <div class="col">: {{ $orderInfo->total_price }} MMK</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col"><i class="fa-solid fa-clock me-2"></i> Date</div>
                                <div class="col">: {{ $orderInfo->created_at->format('F-j-Y') }}</div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Total price</th>
                                <th>Order Date</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($order as $o)
                                <tr>
                                    <td class="align-middle col-2">
                                        <img src="{{asset('storage/'.$o->productImg )}}" alt="" class="img-thumbnail">
                                    </td>
                                    <td class="align-middle col-2">{{ $o->productName }}</td>
                                    <td class="align-middle col-2">{{ $o->productPrice }}</td>
                                    <td class="align-middle col-1">{{ $o->qty }}</td>
                                    <td class="align-middle col-2">{{ $o->total_price }}</td>
                                    <td class="align-middle col-3">{{ $o->created_at->format('F-j-Y') }}</td>
                               </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
              
                @if ($orderInfo->status == 0)
                        <a href="{{ route('order#cancel', $orderInfo->id) }}">
                            <button class="btn btn-block btn-danger font-weight-bold my-3 py-3" id="clearCart" >Order Cancel</button>
                        </a>
                @endif
        </div>
    </div>
</div>
@endsection