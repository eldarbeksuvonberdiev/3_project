@extends('layouts.login_register')

@section('title', 'Register')

@section('content')
    <div class="register-box">
        <div class="register-logo">
            <a href="{{ route('register.main') }}"><b>Admin</b>LTE</a>
        </div>
        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Register a new membership</p>
                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                            placeholder="Full name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    @error('name')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    @error('email')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @error('password')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="confirm_password" placeholder="Retype password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @error('confirm_password')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="row">
                        <div class="col-12 mt-3 mb-3">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('login.main') }}" class="text-center">I already have a membership</a>
            </div>
        </div>
    </div>
@endsection
