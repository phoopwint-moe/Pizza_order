@extends('admin.layout.master')
@section('title', 'Account Info')
@section('menu', 'Account Info')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            @if (session('update'))
                <div class="col-lg-6 offset-3">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-check me-3"></i>{{session('update')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
            <div class="col-lg-8 offset-2">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="card-title">
                            <h3 class="text-center title-2">Account Info</h3>
                        </div>
                        <hr>

                        <div class="row ">
                            <div class="col-3 offset-1">
                                @if (Auth::user()->img == null)
                                    <img src="{{asset('img/default.webp')}}" alt="John Doe" class=" img-thumbnail" />
                                @else
                                    <img src="{{asset('storage/' . Auth::user()->img)}}" alt="John Doe" class=" img-thumbnail" />
                                @endif                
                            </div>
                            <div class="col-6 offset-1">
                                <h4 class="my-3"><i class="fa-solid fa-user me-3"></i> : {{Auth::user()->name}}</h4>
                                <h4 class="my-3"><i class="fa-solid fa-envelope me-3"></i> : {{Auth::user()->email}}</h4>
                                <h4 class="my-3"><i class="fa-solid fa-phone me-3"></i> : {{Auth::user()->phone}}</h4>
                                <h4 class="my-3"><i class="fa-solid fa-mars-and-venus me-3"></i> : {{Auth::user()->gender}}</h4>
                                <div class="my-3" >
                                    <a href="{{route('admin#changePasswordPage')}}">
                                        <button class="btn btn-outline-dark ">
                                            <i class="fa-solid fa-key me-2"></i>
                                            Change Password
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4 offset-5">
                                <a href="{{route('acc#edit')}}">
                                <button class="btn btn-dark text-white">
                                    <i class="fa-solid fa-pen me-2"></i>
                                    Edit Account
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