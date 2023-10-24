@extends('admin.layout.master')
@section('title', 'Change Password')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            @if (session('create'))
            <div class="col-lg-6 offset-3">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-check me-3"></i>{{session('create')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @endif

            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Password</h3>
                        </div>
                        <hr>
                        <form action="{{route('admin#changePassword')}}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label class="control-label mb-1">Old password</label>
                                <input id="cc-pament" name="oldPassword" type="password" class="form-control @if (session('notMatch')) is-invalid @endif  @error('oldPassword') is-invalid @enderror"  aria-required="true" aria-invalid="false" placeholder="Enter old password">
                                @error('oldPassword')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                                @if (session('notMatch'))
                                <div class="invalid-feedback">
                                        {{session('notMatch')}}
                                    </div>
                                @endif
                            </div>
                            
                            <div class="form-group">
                                <label class="control-label mb-1">New Password</label>
                                <input id="cc-pament" name="newPassword" type="password" class="form-control  @error('newPassword') is-invalid @enderror"  aria-required="true" aria-invalid="false" placeholder="Enter new password">
                                @error('newPassword')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label mb-1">Confirm New Password</label>
                                <input id="cc-pament" name="confirmPassword" type="password" class="form-control  @error('confirmPassword') is-invalid @enderror"  aria-required="true" aria-invalid="false" placeholder="Enter confirm password">
                                @error('confirmPassword')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Change Password</span>
                                    <i class="fa-solid fa-circle-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection