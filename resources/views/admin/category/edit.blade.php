@extends('admin.layout.master')
@section('title','Edit page')
@section('menu', 'Category Edit')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                     <a href="{{route('cat#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div>
            @if (session('create'))
            <div class="col-lg-6 offset-3">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-check me-3"></i>{{session('create')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @endif

            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Category Edit Form</h3>
                        </div>
                        <hr>
                        <form action="{{route('cat#update', $data->id)}}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="id" value="{{$data->id}}">
                                <label class="control-label mb-1">Name</label>
                                <input id="cc-pament" name="categoryName" type="text" class="form-control  @error('categoryName') is-invalid @enderror" value="{{old('categoryName', $data->name)}}" aria-required="true" aria-invalid="false" placeholder="Seafood...">
                                @error('categoryName')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                                        
                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Update</span>
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