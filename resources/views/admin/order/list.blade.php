@extends('admin.layout.master')
@section('title', 'OrderList')
@section('menu', 'Order List')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Order List</h2>
    
                        </div>
                    </div>
                </div>
                @if (session('change'))
                    <div class="col-lg-4 offset-8 ">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-check me-3"></i>{{session('change')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
                @if (session('delete'))
                    <div class="col-lg-8 offset-2 ">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-check me-3"></i>{{session('delete')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
                <div class="row my-5">
                    <div class="col-4">
                        <h1>Totle - {{ count($order) }}</h1>
                    </div>
                    <div class="offset-4 col-4">
                        <form action="{{ route('ajax#sortOrder') }}" method="get">
                            <div class="input-group">
                                <select class="form-select" name="status" id="inputGroupSelect04" aria-label="Example select with button addon">
                                    <option value="" @if (request('status') == '' ) selected @endif> All </option>
                                    <option value="0" @if (request('status') == '0' ) selected @endif> Pending </option>
                                    <option value="1" @if (request('status') == '1' ) selected @endif> Success </option>
                                    <option value="2" @if (request('status') == '2' ) selected @endif> Reject </option>
                                    <option value="3" @if (request('status') == '3') selected @endif> Cancel </option>
                                </select>
                                <button class="btn btn-dark" type="submit">Search</button>
                            </div>
                        </form>
                    </div>
                </div>

                @if (count($order->all()) > 0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User name</th>
                                <th>Order Date</th>
                                <th>Order Code</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="datalist">
                           @foreach ($order as $o)
                               <tr>
                                    <td class="align-middle" id="orderId">{{ $o->id }}</td>
                                    <td class="align-middle">{{ $o->userName }}</td>
                                    <td class="align-middle">{{ $o->created_at->format('j-F-Y') }}</td>
                                    <td class="align-middle">
                                        <a href="{{route('order#detail' , $o->order_code)}}" class="text-danger text-decoration-none">{{ $o->order_code }}</a>
                                    </td>
                                    <td class="align-middle">{{ $o->total_price }}</td>
                                    <td class="align-middle">
                                        @if ($o->status == 3)
                                            Cancel
                                        @else
                                            <select name="status" id="" class="form-control statusChange">
                                                <option value="0" @if ($o->status ==0) selected @endif> Pending </option>
                                                <option value="1" @if ($o->status ==1) selected @endif> Success </option>
                                                <option value="2" @if ($o->status ==2) selected @endif> Reject </option>
                                            </select>
                                        @endif
                                        
                                    </td>
                                    @if (Auth::user()->id !== 1)
                                        <td></td>
                                    @elseif (Auth::user()->id == 1)
                                    <td class="col-2">
                                        <div class="table-data-feature ">
                                            <a href="{{route('order#delete', $o->order_code)}}">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </a>
                                        </div>  
                                    </td>
                                    @endif
                               </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                    <h3 class="text-center mt-5 ">There is no Order here</h3>
                @endif
<!-- END DATA TABLE -->
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        $(document).ready(function(){

            //change status 
            $('.statusChange').change(function(){
                $current = $(this).val();
                $parent = $(this).parents("tr");
                $orderId = $parent.find('#orderId').html();
                
                $data = {
                    'status' : $current,
                    'order' : $orderId
                }
                console.log($data);
                $.ajax({
                    type : 'get',
                    url : '/order/change' ,
                    data : $data,
                    dataType : 'json'
                })
            })
        })
    </script>
@endsection