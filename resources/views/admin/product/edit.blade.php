@extends('admin.layout.master')
@section('title', 'Edit Pizza')
@section('menu', 'Edit Pizza')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body p-3">
                        <div>
                            <i class="fa-solid fa-arrow-left" onclick="history.back()"></i>
                        </div>
                        <div class="card-title">
                            <h3 class="text-center title-2">Pizza Edit</h3>
                        </div>
                        <hr>
                        <form action="{{ route('product#update', $data->id) }}" method="post" enctype="multipart/form-data" class="p-3">
                            @csrf
                            <div class="row my-3">
                                <div class="col-4 offset-1">
                                    <img src="{{asset('storage/' . $data->img)}}" alt="Pizza" class=" img-thumbnail" />
                                    <div class="mt-2">
                                        <input type="file" name="img" id="" class="form-control  @error('img') is-invalid @enderror">
                                        @error('img')
                                            <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                                    </div>
                                </div>
                                <div class="row col-6">
                                    <div class="form-group">
                                        <label class="control-label mb-1">Name</label>
                                        <input id="cc-pament" name="name" type="text" value="{{old('name', $data->name) }}" class="form-control  @error('name') is-invalid @enderror"  aria-required="true" aria-invalid="false">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-1">Description</label>
                                        <textarea name="des" class="form-control" id="" cols="30" rows="5">{{old('des' , $data->description)}}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-1">Price</label>
                                        <input id="cc-pament" name="price" type="number" value="{{old('price',$data->price)}}" class="form-control "  aria-required="true" aria-invalid="false" >
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label mb-1">Category</label>
                                        <select name="categoryId" id="" class="form-control">
                                            @foreach ($categories as $c)
                                                <option value="{{$c->id}}" @if($data->category_id == $c->id) selected @endif>{{$c->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Waiting time /mins</label>
                                        <input id="cc-pament" name="waitingTime" type="number" value="{{old('waitingTime',$data->waiting_time)}}" class="form-control "  aria-required="true" aria-invalid="false" >
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-1">View Count</label>
                                        <input id="cc-pament" name="viewCount" type="number" value="{{old('viewCount',$data->view_count)}}" class="form-control "  aria-required="true" aria-invalid="false" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 offset-5">
                                    <a href="{{route('product#update' , $data->id)}}">
                                    <button class="btn btn-dark text-white">
                                        <i class="fa-solid fa-circle-arrow-right me-2"></i>
                                        Update Pizza
                                    </button>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection