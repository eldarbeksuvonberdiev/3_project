@extends('layouts.admin_main')

@section('title', 'Area')
@section('pagename', 'Area Create')

@section('content')
    <section class="content">

        <div class="row">
            <div class="col-12">
                <a href="{{ route('area.index') }}" class="btn btn-primary mb-3">Back</a>
                <form action="{{ route('area.update', $model->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name"
                            value="{{ $model->name }}">
                        @error('name')
                            <div class="text-warning">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="user_id" class="form-label">User</label>
                        <select class="form-select" name="user_id" id="user_id" aria-label="Default select example">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ $user->id == $model->user_id ? 'selected' : '' }}>
                                    {{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="text-warning">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
