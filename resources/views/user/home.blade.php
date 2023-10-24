@extends('user.layout.master')
@section('breadcrumb')
    <a class="breadcrumb-item text-dark" href="{{ route('user#home') }}">Home</a>
@endsection
@section('content')
<div class="container-fluid">
        @if (session('success'))
            <div class="col-lg-6 offset-3">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-check me-3"></i>{{session('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @endif
    <div class="row px-xl-5">
        <div class="col-lg-3 col-md-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class=" pr-3">Filter by Category</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class=" align-items-center mb-3">
                            <a href="{{route('user#home')}}" class="text-decoration-none text-dark  d-flex justify-content-between">
                                <label class="" for="price-all">All Category</label>
                                <span class=" ">{{count($categories)}}</span>
                            </a>
                        </div>
                        <hr>
                        @foreach ($categories as $c)
                        <a href="{{route('cat#filter' , $c->id)}}" class="text-decoration-none text-dark">
                            <div class=" d-flex align-items-center justify-content-between mb-3">
                                <label class="" for="price-1">{{$c->name}}</label>
                            </div>
                        </a>
                        @endforeach
                        
                    </form>
                </div>
        </div>   

        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <a href="{{route('cart#list')}}">
                                <button type="button" class="btn btn-dark text-white position-relative px-3 me-3">
                                <i class="fa-solid fa-cart-shopping"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ count($cart) }}
                                </span>
                                </button>
                            </a>
                        </div>
                        <div class="ml-2">
                            <select name="sort" id="sort" class="form-control ">
                                <option value="">Sort Date</option>
                                <option value="asc">Oldest - Newest</option>
                                <option value="desc">Newest - Oldest</option>
                            </select>
                        </div>
                    </div>
                </div>
                <span class="row" id="datalist">
                    @if (count($pizzas) == 0)
                        <h3 class="text-center mt-5 ">There is no Pizza here in this category</h3>
                    @else
                        @foreach ($pizzas as $p)
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" style="height: 300px;" src="{{asset('storage/' .$p->img)}}" alt="">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href="{{route('user#pizzaDetail', $p->id)}}"><i class="fa-solid fa-circle-info"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate" href="">{{$p->name}}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>{{$p->price}} kyats</h5>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center mb-1">
                                            <small class="fa fa-star text-warning mr-1"></small>
                                            <small class="fa fa-star text-warning mr-1"></small>
                                            <small class="fa fa-star text-warning mr-1"></small>
                                            <small class="fa fa-star text-warning mr-1"></small>
                                            <small class="fa fa-star text-warning mr-1"></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    
                </span>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $('#sort').change(function(){
                $option = $('#sort').val();

                if($option == 'asc'){
                    $.ajax({
                        type : 'get',
                        url : '/user/ajax/pizza' ,
                        data : { 'status' : 'asc' } ,
                        dataType : 'json' ,
                        success : function(response){
                            $list = '';
                            for($i=0; $i<response.length; $i++){
                                $list += `
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" style="height: 300px;" src="{{asset('storage/${response[$i].img}')}}" alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>${response[$i].price}kyats</h5>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-warning mr-1"></small>
                                                <small class="fa fa-star text-warning mr-1"></small>
                                                <small class="fa fa-star text-warning mr-1"></small>
                                                <small class="fa fa-star text-warning mr-1"></small>
                                                <small class="fa fa-star text-warning mr-1"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                `;
                            }
                            console.log($list);
                            $('#datalist').html($list);
                        }
                    })
                }else if($option == 'desc'){
                    $.ajax({
                        type : 'get',
                        url : '/user/ajax/pizza' ,
                        data : { 'status' : 'desc' } ,
                        dataType : 'json' ,
                        success : function(response){
                            $list = '';
                            for($i=0; $i<response.length; $i++){
                                $list += `
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" style="height: 300px;" src="{{asset('storage/${response[$i].img}')}}" alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>${response[$i].price}kyats</h5>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-warning mr-1"></small>
                                                <small class="fa fa-star text-warning mr-1"></small>
                                                <small class="fa fa-star text-warning mr-1"></small>
                                                <small class="fa fa-star text-warning mr-1"></small>
                                                <small class="fa fa-star text-warning mr-1"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                `;
                            }
                            $('#datalist').html($list);
                        }
                    })
                        
                }
            })
        });
    </script>
@endsection