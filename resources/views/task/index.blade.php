@extends('layouts.admin_main')

@section('title', 'Tasks')
@section('pagename', 'Tasks')

@section('content')
    <section class="content">
        <div class="col-12">
            <a href="{{ route('task.create') }}" class="btn btn-primary">Create</a>
            @if (session('success') && session('status'))
                <div class="alert alert-{{ session('status') }} alert-dismissible fade show mt-3" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form method="GET" action="{{ route('task.index') }}">
                @csrf
                <div class="row mt-3">
                    <div class="col-5">
                        <label for="start_date">Start Date:</label>
                        <input type="date" id="start_date" class="form-control" name="start_date">
                    </div>
                    <div class="col-5">
                        <label for="end_date">End Date:</label>
                        <input type="date" id="end_date" class="form-control" name="end_date">
                    </div>
                    <div class="col-1 mt-4">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
            <div class="container-fluid">
                <div class="row mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tasks</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category</th>
                                        <th>Doer</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>File</th>
                                        <th>Deadline</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tasks as $task)
                                        <tr>
                                            <td>{{ $task->id }}</td>
                                            <td>{{ $task->category->name }}</td>
                                            <td>{{ $task->doer }}</td>
                                            <td>{{ $task->title }}</td>
                                            <td>{{ $task->description }}</td>
                                            <td>
                                                <a href="{{ $task->file }}" download>FILE</a>
                                            </td>
                                            <td>{{ $task->deadline }}</td>
                                            <td>
                                                <a href="{{ route('task.edit', $task->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                            </td>
                                            <td>
                                                <div>
                                                    <form action="{{ route('task.destroy', $task->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger" type="submit">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{ $tasks->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
