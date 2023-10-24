@extends('user.layout.master')
@section('breadcrumb')
    <a class="breadcrumb-item text-dark" href="{{ route('user#home') }}">Home</a>
@endsection
@section('breadcrumb_one')
    <a class="breadcrumb-item text-dark" href="{{ route('user#order') }}">Orderlist</a>
@endsection
@section('content')
<div class="container-fluid" style="height: 400px;">
        <div class="row px-xl-5">
            <div class="col-lg-8 offset-2 table-responsive mb-5">
                <div class="mb-3">
                    <a href="{{ route('user#home') }}" class="text-decoration-none text-dark">
                        <i class="fa-solid fa-arrow-left me-3""></i>back
                    </a>
                </div>
                @if (session('cancel'))
                    <div class="col-lg-4 offset-8 ">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-check me-3"></i>{{session('cancel')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
                @if (count($datas) == 0)
                    <h3 class="text-center mt-5 ">There is no Order here </h3>
                @else
                    <table class="table table-light table-borderless table-hover text-center mb-0" id="table_data">
                        <thead class="thead-dark">
                            <tr>
                                <th>Date</th>
                                <th>Order ID</th>
                                <th>Total price</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                           @foreach ($datas as $data)
                                @if ($data->status !== 3)
                                <tr>
                                    <td class="align-middle">{{ $data->created_at->format('F-j-Y') }}</td>
                                    <td class="align-middle">
                                        <a href="{{ route('user#orderdetail', $data->order_code) }}" class="text-decoration-none text-danger">{{ $data->order_code }}</a>
                                    </td>
                                    <td class="align-middle">{{ $data->total_price }} MMK</td>
                                    <td class="align-middle">
                                        @if ($data->status == 0)
                                            <span class="text-warning"><i class="fa-solid fa-clock-rotate-left me-3"></i>Pending</span>
                                        @elseif ($data->status == 1)
                                            <span class="text-success"><i class="fa-solid fa-check me-3"></i>Success</span>
                                        @elseif ($data->status == 2)
                                            <span class="text-danger"><i class="fa-solid fa-triangle-exclamation me-3"></i>Reject</span>
                                        @endif
                                    </td>
                               </tr>
                                @endif
                               
                           @endforeach
                            
                        </tbody>
                    </table>
                @endif
               
                {{$datas->appends(request()->query())->links()}}
            </div>
        </div>
    </div>
@endsection