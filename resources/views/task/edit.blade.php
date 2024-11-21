@extends('layouts.admin_main')

@section('title', 'Task')
@section('pagename', 'Task Edit')

@section('content')
    <section class="content">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <a href="{{ route('task.index') }}" class="btn btn-primary mb-3">Back</a>
                    <form action="{{ route('task.update',$task->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select" name="category_id" id="category_id" aria-label="Default select example">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $task->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="text-warning">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="doer" class="form-label">Doer</label>
                            <input type="text" class="form-control" name="doer" id="doer" value="{{ $task->doer }}">
                            @error('doer')
                                <div class="text-warning">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" id="title" value="{{ $task->title }}">
                            @error('title')
                                <div class="text-warning">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" name="description" id="description" value="{{ $task->description }}">
                            @error('description')
                                <div class="text-warning">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">FILE</label>
                            <input type="file" class="form-control" name="file" id="file">
                            @error('file')
                                <div class="text-warning">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="deadline" class="form-label">Deadline</label>
                            <input type="date" class="form-control" name="deadline" id="deadline">
                            @error('deadline')
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
        </div>
    </section>
@endsection
