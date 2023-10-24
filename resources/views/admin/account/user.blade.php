@extends('admin.layout.master')

@section('title', 'User List')
@section('menu', 'User List')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Admin List</h2>
    
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-4">
                        <h1>Totle - </h1>
                    </div>
                    <form class="form-header  offset-3 col-4" action="{{route('admin#list')}}" method="get">
                        <input class="au-input au-input--xl" type="text" name="key" placeholder="Search Admin" value="{{request('key')}}" />
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
                @if (session('change'))
                    <div class="col-lg-4 offset-8 ">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-check me-3"></i>{{session('change')}}
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Gender</th>
                                <th>Role</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody> 
                             @foreach ($datas as $data)
                             <tr class="tr-shadow">
                                    <input type="hidden" name="" id="id" value="{{ $data->id }}">
                                    <td class="col-2">
                                    @if ($data->img == null)
                                        <img src="{{asset('img/default.webp')}}" alt="John Doe" class=" img-thumbnail" />
                                    @else
                                        <img src="{{asset('storage/' . $data->img)}}" alt="John Doe" class=" img-thumbnail" />
                                    @endif  </td>
                                    <td class="col-2">{{$data->name}}</td>
                                    <td class="col-2">{{$data->email}}</td>
                                    <td class="col-2">{{$data->phone}}</td>
                                    <td class="col-2">{{$data->gender}}</td>
                                    <td class="col-2">
                                        <select name="role" id="" class="form-control roleChange">
                                            <option value="admin" > Admin </option>
                                            <option value="user" selected> User </option>
                                        </select>
                                    </td>
                                   
                                    <td class="col-2">
                                        <div class="table-data-feature ">
                                            <a href="{{route('user#delete', $data->id)}}">
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
                    <h3 class="text-center mt-5 ">There is no User Account here</h3>
                @endif

                {{$datas->appends(request()->query())->links()}}
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        $(document).ready(function(){

            //change status 
            $('.roleChange').change(function(){
                $current = $(this).val();
                $parent = $(this).parents("tr");
                $id = $parent.find('#id').val();
                $data = {
                    'status' : $current,
                    'id' : $id
                }
                $.ajax({
                    type : 'get',
                    url : '/user/changerole' ,
                    data : $data,
                    dataType : 'json'
                })
            })
        })
    </script>
@endsection