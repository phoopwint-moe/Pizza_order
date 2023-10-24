@extends('user.layout.master')
@section('breadcrumb')
    <a class="breadcrumb-item text-dark" href="{{ route('user#home') }}">Home</a>
@endsection
@section('breadcrumb_two')
    <span class="breadcrumb-item active">detail</span>
@endsection
@section('content')
    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">   
        <div class="row px-xl-5">
            <div class="mb-3">
                <a href="{{ route('user#home') }}" class="text-decoration-none text-dark">
                    <i class="fa-solid fa-arrow-left me-3""></i>back
                </a>
            </div>
            <div class="col-lg-5  mb-30">
                <img src="{{asset('storage/' . $pizza->img)}}" alt="" class="w-100">
            </div>

            <div class=" col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <input type="hidden" name="" value="{{Auth::user()->id}}" id="userId">
                    <input type="hidden" name="" value="{{$pizza->id}}" id="pizzaId">
                    <h2>{{$pizza->name}}</h2>
                    <div class=" my-3">
                        <i class="fa-solid fa-eye me-3"></i>{{$pizza->view_count + 1}} view
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">{{$pizza->price}} /Kyats</h3>
                    <p class="mb-4">{{$pizza->description}}</p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-warning btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control bg-white border-0 text-center" value="1" id="qty">
                            <div class="input-group-btn">
                                <button class="btn btn-warning btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button class="btn btn-warning px-3" id="addBtn"><i class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->

    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-white pr-3">You May Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel ">
                    @foreach ($pizzaAll as $p)
                        <div class="product-item bg-light ">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{asset('storage/' . $p->img)}}" alt="" >
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href="{{route('user#pizzaDetail' , $p->id)}}"><i class="fa fa-info"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{$p->name}}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{$p->price}} /Kyats</h5>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-warning mr-1"></small>
                                    <small class="fa fa-star text-warning mr-1"></small>
                                    <small class="fa fa-star text-warning mr-1"></small>
                                    <small class="fa fa-star text-warning mr-1"></small>
                                    <small class="fa fa-star text-warning mr-1"></small>
                                    <small>(99)</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->
@endsection

@section('js')
    <script>
        //increase view count
        $.ajax({
                type : 'get',
                url : 'http://127.0.0.1:8000/user/ajax/increase/viewCount' ,
                data : { 'productId' : $('#pizzaId').val() } ,
                dataType : 'json' ,
                
            }) 

        //click add to cart
        $(document).ready(function(){
            $('#addBtn').click(function(){
                $data = {
                    'userId' : $('#userId').val(),
                    'pizzaId' : $('#pizzaId').val(),
                    'qty' : $('#qty').val()
                };

                $.ajax({
                        type : 'get',
                        url : '/user/ajax/cart' ,
                        data : $data ,
                        dataType : 'json' ,
                        success : function(response){
                                    if(response.status == 'success'){
                                        window.location.href = '/user/home';
                                    }
                                 }
                    }) 
            })
        })
    </script>
@endsection