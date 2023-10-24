@extends('user.layout.master')
@section('breadcrumb')
    <a class="breadcrumb-item text-dark" href="{{ route('user#home') }}">Home</a>
@endsection
@section('breadcrumb_two')
    <span class="breadcrumb-item active">Contact</span>
@endsection
@section('content')
<div class="container-fluid">
            @if (session('send'))
            <div class="col-lg-6 offset-3">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-check me-3"></i>{{session('send')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @endif
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-warning pr-3">Contact Us</span></h2>
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form bg-light p-30">
                    <div id="success"></div>
                    <form action="{{ route('contact#message') }}" method="post" novalidate="novalidate">
                        @csrf
                        <div class="control-group mb-3">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Your Name"
                                required="required" />
                            @error('name')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="control-group mb-3">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Your Email"
                                required="required" />
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                        </div>
                        <div class="control-group mb-3">
                            <textarea class="form-control @error('message') is-invalid @enderror" rows="8" name="message" placeholder="Message"
                                required="required"></textarea>
                                @error('message')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                        </div>
                        <div>
                            <button class="btn btn-warning py-2 px-4" type="submit" id="sendMessageButton">Send
                                Message</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 mb-5">
                <div class="bg-light p-30 mb-3">
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-warning mr-3"></i>Yangon, Burma</p>
                    <p class="mb-2"><i class="fa fa-envelope text-warning mr-3"></i>maishuvera@gmail.com</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-warning mr-3"></i>+959 941 479 126</p>
                </div>
            </div>
        </div>
    </div>
@endsection