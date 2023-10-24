@extends('admin.layout.master')
@section('title', 'Pizza Detail')
@section('menu', 'Pizza Detail')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-10">
                     <a href="{{route('product#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div>
            @if (session('update'))
                <div class="col-lg-6 offset-3">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-check me-3"></i>{{session('update')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body p-3">
                        <div>
                            <i class="fa-solid fa-arrow-left" onclick="history.back()"></i>
                        </div>
                        <div class="card-title">
                            <h3 class="text-center title-2">Pizza Detail</h3>
                        </div>
                        <hr>

                        <div class="row ">
                            <div class="col-3 offset-1">
                                <img src="{{asset('storage/' . $data->img)}}" alt="pizza" class=" img-thumbnail" />             
                            </div>
                            <div class="col-6 offset-1">
                                <div class="mb-3"><b class="me-3 fs-5 ">Name:</b> <span class="text-danger">{{$data->name}}</span></div> 
                                <div class="mb-3"><b class="me-3 fs-5 ">Category:</b> <span class="text-danger">{{$data->category_name}}</span></div> 
                                <div class="mb-3"><b class="me-3 fs-5">Description:</b> <span class="text-danger">{{$data->description}}</span> </div>
                                <div class="d-flex flex-wrap">
                                    <div class=" border border-secondary rounded p-2 bg-secondary text-white me-3"><i class="fa-solid fa-money-bill fs-5 me-3"></i>{{$data->price}} /Ks</div>
                                    <div class=" border border-secondary rounded p-2 bg-secondary text-white me-3"><i class="fa-regular fa-clock fs-5 me-3"></i>{{$data->waiting_time}} /mins</div>
                                    <div class=" border border-secondary rounded p-2 bg-secondary text-white me-3"><i class="fa-solid fa-eye fs-5 me-3"></i>{{$data->view_count}}</div>
                                    <div class=" border border-secondary rounded p-2 bg-secondary text-white me-3 mt-3"><i class="fa-solid fa-calendar-days fs-5 me-3"></i>{{$data->created_at->format('j-F-Y')}}</div>
                                </div>
                            </div>
                        </div>  

                        <div class="row my-5">
                            <div class="col-4 offset-5">
                                <a href="{{route('product#editPage', $data->id)}}">
                                <button class="btn btn-dark text-white px-5">
                                    <i class="fa-solid fa-pen me-2"></i>
                                    Edit Pizza
                                </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection