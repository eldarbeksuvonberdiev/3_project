@extends('layouts.login_register')

@section('title', 'Login')

@section('content')
    @if (session('success') && session('status'))
        <div class="alert alert-{{ session('status') }} alert-dismissible fade show mt-3" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ route('login.main') }}"><b>Admin</b>LTE</a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3 mt-3">
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                            placeholder="Email">
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
                    <div class="input-group mb-3 mt-3">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @error('password')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="row">
                        <div class="col-12 mb-3 mt-3">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>
                {{-- <p class="mb-0">
                    <a href="{{ route('register.main') }}" class="text-center">Register a new membership</a>
                </p> --}}
                <p class="mb-0">
                    <a href="{{ route('forgot_password') }}" class="text-center">Fogot Password</a>
                </p>
            </div>
        </div>
    </div>
@endsection
