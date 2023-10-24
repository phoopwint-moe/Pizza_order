@extends('admin.layout.master')

@section('title', 'Product Create')
@section('menu', 'Product Create')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                     <a href="{{route('product#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div>
            @if (session('created'))
            <div class="col-lg-6 offset-3">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-check me-3"></i>{{session('created')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @endif

            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Product Add Form</h3>
                        </div>
                        <hr>
                        <form action="{{route('product#create')}}" method="post" enctype="multipart/form-data" novalidate="novalidate" class="p-3">
                            @csrf
                            <div class="form-group">
                                <label class="control-label mb-1">Name</label>
                                <input id="cc-pament" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" aria-required="true" aria-invalid="false" placeholder="Enter Product Name...">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label mb-1">Category</label>
                                <select name="categoryId" id="" class="form-control @error('categoryId') is-invalid @enderror" value="{{old('categoryId')}}">
                                    <option value="">Choose Category</option>
                                    @foreach ($categories as $c)
                                        <option value="{{$c->id}}">{{$c->name}}</option>
                                    @endforeach
                                </select>
                                @error('categoryId')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label mb-1">Description</label>
                                <textarea name="des" id="" class="form-control @error('des') is-invalid @enderror" cols="30" rows="5" placeholder="Enter Description">{{old('des')}}</textarea>
                                @error('des')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label mb-1">Image</label>
                                <input type="file" name="img" id="" class="form-control @error('img') is-invalid @enderror" value="{{old('img')}}">
                                @error('img')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label mb-1">Price</label>
                                <input id="cc-pament" name="price" type="number" class="form-control @error('price') is-invalid @enderror" value="{{old('price')}}"  aria-required="true" aria-invalid="false" placeholder="Enter Price...">
                                @error('price')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                                
                            <div class="form-group">
                                <label class="control-label mb-1">Waiting time</label>
                                <input id="cc-pament" name="waitingTime" type="number" class="form-control @error('price') is-invalid @enderror" value="{{old('waitingTime')}}"  aria-required="true" aria-invalid="false" placeholder="Enter Waiting Time...">
                                @error('waitingTime')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Create</span>
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