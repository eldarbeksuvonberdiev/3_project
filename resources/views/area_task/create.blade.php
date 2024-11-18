@extends('layouts.admin_main')

@section('title', 'Give Tasks')
@section('pagename', 'Give Tasks by Area')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <a href="{{ route('area.index') }}" class="btn btn-primary mb-3 ml-3">Back</a>
                <form action="{{ route('area_task.store') }}" method="post">
                    @csrf
                    <div class="col-12 mb-3">
                        <label for="task_id" class="form-label">User</label>
                        <select class="form-select" name="task_id" id="task_id" aria-label="Default select example">
                            @foreach ($tasks as $task)
                                <option value="{{ $task->id }}">{{ $task->title }}</option>
                            @endforeach
                        </select>
                        @error('task_id')
                            <div class="text-warning">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Area Select</label>
                                <div class="select2-purple">
                                    <select class="select2" multiple="multiple" data-placeholder="Select a State" name="area_id[]" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                        @foreach ($areas as $area)
                                            <option value="{{ $area->id }}">{{ $area->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @error('area_id')
                            <div class="text-warning">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary ml-3">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
