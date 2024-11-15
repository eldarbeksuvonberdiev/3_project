@extends('layouts.login_register')

@section('title', 'Login')

@section('content')
    <div class="login-box">
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Verify Your Email</p>
                <form action="{{ route('verify') }}" method="post">
                    @csrf
                    <div class="input-group mb-3 mt-3">
                        <input type="number" class="form-control" name="code" value="{{ old('code') }}"
                            placeholder="Code ...">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    @error('code')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="row">
                        <div class="col-12 mb-3 mt-3">
                            <button type="submit" class="btn btn-primary btn-block">Verify</button>
                        </div>
                    </div>
                </form>
                <p class="mb-0">
                    <a href="{{ route('register.main') }}" class="text-center">Register a new membership</a>
                </p>
            </div>
        </div>
    </div>
@endsection
