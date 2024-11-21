@extends('layouts.admin_main')

@section('title', 'Profile')
@section('pagename', 'Profile')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab" active>Settings</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                                <div class="tab-pane" id="settings">
                                    <form class="form-horizontal" action="{{ route('profile.update',$user->id) }}" method="POST">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ $user->name }}">
                                            </div>
                                            @error('name')
                                                <div class="text-warning">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="email" name="email"
                                                    value="{{ $user->email }}">
                                            </div>
                                            @error('email')
                                            <div class="text-warning">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        </div>
                                        <div class="form-group row">
                                            <label for="password" class="col-sm-2 col-form-label">Password</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="password" name="password"
                                                    placeholder="New password">
                                            </div>
                                            @error('password')
                                            <div class="text-warning">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        </div>
                                        <div class="form-group row">
                                            <label for="c_password"
                                                class="col-sm-2 col-form-label">Confirm Password</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="c_password" name="c_password"
                                                placeholder="New password">
                                            </div>
                                            @error('c_password')
                                            <div class="text-warning">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10 mt-3">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
