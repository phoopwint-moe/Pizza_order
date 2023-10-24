@extends('user.layout.master')
@section('breadcrumb')
    <a class="breadcrumb-item text-dark" href="{{ route('user#home') }}">Home</a>
@endsection
@section('breadcrumb_one')
    <a class="breadcrumb-item text-dark" href="{{ route('cart#list') }}">Cart</a>
@endsection

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
        @if (count($datas) == 0)
            <h3 class="text-center mt-5 ">There is no Product in Cart</h3>
        @else
            <div class="col-lg-8 table-responsive mb-5">
                    <table class="table table-light table-borderless table-hover text-center mb-0" id="table_data">
                        <thead class="thead-dark">
                            <tr>
                                <th>Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            @foreach ($datas as $data)
                            <tr>
                                <td class="align-middle"><img src="{{asset('storage/' . $data->img)}}" alt="" class="me-3" style="width: 100px;">{{ $data->pizza_name }}
                                <input type="hidden" class="userId" value="{{$data->user_id}}">
                                <input type="hidden" class="productId" value="{{$data->product_id}}">
                                </td>
                                <td class="align-middle" id="price">{{ $data->pizza_price }} kyats</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-warning btn-minus" >
                                            <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm  border-0 text-center" value="{{ $data->qty }}" id="qty">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-warning btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle" id="total">{{ $data->pizza_price * $data->qty }} kyats</td>
                                <td class="align-middle"><a href="{{route('cart#delete', $data->id)}}"><button class="btn btn-sm btn-danger btnRemove"><i class="fa fa-times"></i></button></a></td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                
                
                <a href="{{route('user#home')}}">
                <button class="btn btn-block btn-warning font-weight-bold mt-5 py-3">Continue Shopping</button>
                </a>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subtotal">{{ $total_price }} kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6>Delivery</h6>
                            <h6 class="font-weight-medium">3000</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="totalPrice">{{ $total_price + 3000 }} kyats</h5>
                        </div>
                        <button class="btn btn-block btn-warning font-weight-bold my-3 py-3" id="orderBtn">Proceed To Checkout</button>
                        <a href="{{ route('cart#deleteAll') }}">
                            <button class="btn btn-block btn-danger font-weight-bold my-3 py-3" id="clearCart" >Clear cart</button>
                        </a>
                        
                    </div>
                </div>
            </div>
        @endif
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $('.btn-plus').click(function(){
                $parent = $(this).parents("tr");
                $qty = Number($parent.find('#qty').val());
                $price = Number($parent.find('#price').text().replace("kyats", ""));
                $total = $price*$qty;

                $parent.find('#total').html($total + " kyats");

                summaryCal();
            });

            $('.btn-minus').click(function(){
                $parent = $(this).parents("tr");
                $qty = Number($parent.find('#qty').val());
                $price = Number($parent.find('#price').text().replace("kyats", ""));
                $total = $price*$qty;

                $parent.find('#total').html($total + " kyats");

                summaryCal();
            });

            $('.btnRemove').click(function(){
                $parent = $(this).parents("tr");
                $parent.remove();
            });

            $('#orderBtn').click(function(){
                $orderList = [];
                $random = Math.floor(Math.random() * 1000000001);

                $('#table_data tbody tr').each(function(index,row){
                    $orderList.push({
                        'user_id' : $(row).find('.userId').val(),
                        'product_id' : $(row).find('.productId').val(),
                        'qty' : $(row).find('#qty').val(),
                        'total_price' : $(row).find('#total').text().replace('kyats','')*1,
                        'order_code' : 'POS'+$random
                    })
                })
                $orderList.push({'shipping' : $('#shipping').val()})

                $orderCode = $orderList[0].order_code;

                $.ajax({
                        type : 'get',
                        url : '/user/ajax/order' ,
                        data : Object.assign({}, $orderList),
                        dataType : 'json',
                        success : function (response){
                            if(response.status == 'true'){
                                window.location.href = "/user/checkout/" + $orderCode
                            }
                        }
                    })
            });


            function summaryCal(){
                $totalPrice = 0;
                $('#table_data tbody tr').each(function(index,row){
                    $totalPrice += Number($(row).find("#total").text().replace("kyats", ""));
                });

                $('#subtotal').html($totalPrice + " kyats");
                $('#totalPrice').html($totalPrice + 3000 + " kyats");
            }
        })
    </script>
@endsection