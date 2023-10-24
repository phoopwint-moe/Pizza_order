@extends('layout.main')
@section('content')
    @if (session('changeSuccess'))
        <div class="">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('changeSuccess')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @endif
    <div class="login-form">
        <form action="{{route('login')}}" method="post">
            @csrf
            <div class="form-group">
                <label>Email Address</label>
                <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
                @error('email')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label>Password</label>
                <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                @error('password')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
                                    
            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>
                                
        </form>
        <div class="register-link">
            <p>
                Don't you have account?
                <a href="{{route('auth#registerPage')}}">Sign Up Here</a>
            </p>
        </div>
    </div>
@endsection