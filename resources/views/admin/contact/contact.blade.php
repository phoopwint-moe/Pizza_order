@extends('admin.layout.master')

@section('title', 'Contact')
@section('menu', 'Contact')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="col-lg-8 offset-2 ">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-check me-3"></i>{{session('success')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif

                @if (count($datas) == 0)
                    <h3 class="text-center mt-5 ">There is no Message here</h3>
                @else
                <div class="row  d-flex justify-content-evenly ">
                    @foreach ($datas as $data)
                    <div class="card col-5 p-4 m-3">
                        <div class="card-body">
                            <h3><i class="fa-solid fa-envelope me-2 mb-2"></i>Customer's Contact</h3>
                        </div>
                        <hr>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-4"><i class="fa-solid fa-user me-2"></i>Name</div>
                                <div class="col">: {{ $data->name }} </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4"><i class="fa-solid fa-location me-2"></i> Address</div>
                                <div class="col">: {{ $data->email }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4"><i class="fa-solid fa-phone me-2"></i>Phone</div>
                                : <div class="col border border-dark p-2 rounded m-2">{{ $data->message }}</div>
                            </div>
                            
                        </div>
                        <a href="{{ route('admin#contactDelete', $data->id) }}" class="text-danger text-end">Delete</a>
                    </div>
                    @endforeach
                    
                </div>  
                @endif
                
        </div>
    </div>
</div>
@endsection