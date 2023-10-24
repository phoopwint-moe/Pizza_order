@extends('admin.layout.master')
@section('title', 'Edit Profile')
@section('menu', 'Edit Profile')
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
                            <h3 class="text-center title-2">Profile Edit</h3>
                        </div>
                        <hr>
                        <form action="{{ route('acc#update', Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row my-3">
                                <div class="col-4 offset-1">
                                    @if (Auth::user()->img == null)
                                        <img src="{{asset('img/default.webp')}}" alt="John Doe" class=" img-thumbnail" />
                                    @else
                                        <img src="{{asset('storage/' . Auth::user()->img)}}" alt="John Doe" class=" img-thumbnail" />
                                    @endif 
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
                                        <input id="cc-pament" name="name" type="text" value="{{old('name', Auth::user()->name) }}" class="form-control "  aria-required="true" aria-invalid="false" placeholder="Enter old password">
                                        
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-1">Email</label>
                                        <input id="cc-pament" name="email" type="email" value="{{old('email',Auth::user()->email)}}" class="form-control"  aria-required="true" aria-invalid="false" placeholder="Enter old password">
                                        
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-1">Phone</label>
                                        <input id="cc-pament" name="phone" type="number" value="{{old('phone',Auth::user()->phone)}}" class="form-control"  aria-required="true" aria-invalid="false" placeholder="Enter old password">
                                        
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-1">Gender</label>
                                        <select name="gender" id="" class="form-control">
                                            <option value="male" @if(Auth::user()->gender == 'male') selected @endif</option>Male</option>
                                            <option value="female"  @if(Auth::user()->gender == 'female') selected @endif>Female</option>
                                        </select>
                                        
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-1">Role</label>
                                        <input id="cc-pament" name="role" type="text" value="{{old('role', Auth::user()->role)}}" class="form-control"  aria-required="true" aria-invalid="false" placeholder="Enter old password" disabled>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 offset-5">
                                    <button class="btn btn-dark text-white">
                                        <i class="fa-solid fa-circle-arrow-right me-2"></i>
                                        Update Account
                                    </button>
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