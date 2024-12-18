@extends('layouts.admin_main')

@section('title', 'Task')
@section('pagename', 'Task Create')

@section('content')
    <section class="content">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <a href="{{ route('task.index') }}" class="btn btn-primary mb-3">Back</a>
                    <form action="{{ route('task.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="doer" class="form-label">Doer</label>
                            <input type="text" class="form-control" name="doer" id="doer"
                                placeholder="Kimdir...">
                            @error('doer')
                                <div class="text-warning">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="Nimadir">
                            @error('title')
                                <div class="text-warning">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" name="description" id="description"
                                placeholder="Nimadir">
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
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select" name="category_id" id="category_id"
                                aria-label="Default select example">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="text-warning">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label>Area Select</label>
                                <div class="select2-purple">
                                    <select class="select2" multiple="multiple" data-placeholder="Select a State"
                                        name="area_id[]" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                        @foreach ($areas as $area)
                                            <option value="{{ $area->id }}">{{ $area->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @error('area_id')
                                <div class="text-warning">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
