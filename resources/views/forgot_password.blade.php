@extends('layouts.login_register')

@section('title', 'Forgot a Password')

@section('content')
    <div class="login-box">
        @if (session('success') && session('status'))
            <div class="alert alert-{{ session('status') }} alert-dismissible fade show mt-3" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="login-logo">
            <a href="#"><b>Admin</b>LTE</a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Insert your email to get a new password</p>
                <form action="{{ route('forgot_password') }}" method="post">
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
                    <div class="row">
                        <div class="col-12 mb-3 mt-3">
                            <button type="submit" class="btn btn-primary btn-block">Send</button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('login.main') }}" style="text-decoration:none;">Back</a>
            </div>
        </div>
    </div>
@endsection
