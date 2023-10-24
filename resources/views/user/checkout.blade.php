@extends('user.layout.master')
@section('breadcrumb')
    <a class="breadcrumb-item text-dark" href="{{ route('user#home') }}">Home</a>
@endsection
@section('breadcrumb_one')
    <a class="breadcrumb-item text-dark" href="{{ route('cart#list') }}">Cart</a>
@endsection
@section('breadcrumb_two')
    <span class="breadcrumb-item active">Checkout</span>
@endsection
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid row">
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Your Information</h3>
                        </div>
                        <hr>
                        <form action="{{route('order#update' , $orderCode)}}" method="post" enctype="multipart/form-data" novalidate="novalidate" class="p-3">
                            @csrf
                            <div class="form-group">
                                <label class="control-label mb-1">Phone</label>
                                <input type="number" name="phone" id="" class="form-control  @error('phone') is-invalid @enderror" placeholder="Enter Your Phone" value="{{old('phone')}}">
                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label mb-1">Your Address</label>
                                <textarea name="address" id="" class="form-control @error('address') is-invalid @enderror" cols="30" rows="5" placeholder="Enter Your Address">{{old('address')}}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label mb-1">Note</label>
                                <textarea name="message" id="" class="form-control @error('message') is-invalid @enderror" cols="30" rows="5" placeholder="Eg- Wait me at the lobby">{{old('message')}}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-warning btn-block">
                                    <span id="payment-button-amount">Order</span>
                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                    <i class="fa-solid fa-circle-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection