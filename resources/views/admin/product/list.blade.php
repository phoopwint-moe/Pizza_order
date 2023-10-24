@extends('admin.layout.master')

@section('title', 'Product List')
@section('menu', 'Product List')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Products List</h2>
    
                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{route('product#createPage')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add products
                            </button>  
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>  
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-4">
                        <h1>Totle -({{$datas->total()}}) </h1>
                    </div>
                    <form class="form-header  offset-3 col-4" action="{{route('product#list')}}" method="get">
                        <input class="au-input au-input--xl" type="text" name="key" placeholder="Search Pizza" value="{{request('key')}}" />
                        <button class="au-btn--submit" type="submit">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                    </form>
                    <span class="my-2">Search Key - <small class="text-danger">{{request('key')}}</small></span>
                </div>

                @if (session('delete'))
                    <div class="col-lg-4 offset-8 ">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-check me-3"></i>{{session('delete')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
                        
                @if (count($datas->all()) > 0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>View Count</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $datas as $data )
                                <tr class="tr-shadow">
                                    <td class="col-2"><img src="{{asset('storage/'.$data->img )}}" alt="" class="img-thumbnail"></td>
                                    <td class="col-3">{{$data->name}}</td>
                                    <td class="col-2">{{$data->price}}</td>
                                    <td class="col-2">{{$data->category_name}}</td>
                                    <td class="col-2"><i class="zmdi zmdi-eye me-2"></i>{{$data->view_count}}</td>
                                    <td class="col-2">
                                    <div class="table-data-feature">
                                        <a href="{{route( 'product#detail', $data->id)}}">
                                            <button class="item me-2" data-toggle="tooltip" data-placement="top" title="View">
                                                <i class="zmdi zmdi-eye"></i>
                                            </button>
                                        </a>
                                        <a href="{{route('product#editPage', $data->id)}}">
                                            <button class="item me-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                        </a>
                                        <a href="{{route('product#delete', $data->id)}}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </a>
                                    </div>  
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
                @else
                    <h3 class="text-center mt-5 ">There is no Product here</h3>
                @endif

                {{$datas->appends(request()->query())->links()}}
        </div>
    </div>
</div>
@endsection