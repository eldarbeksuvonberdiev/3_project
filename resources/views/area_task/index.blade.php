@extends('layouts.admin_main')

@section('title', 'Area Task')
@section('pagename', 'AreaTask')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <a href="{{ route('area_task.create') }}" class="btn btn-primary">Create</a>
            @if (session('success') && session('status'))
                <div class="alert alert-{{ session('status') }} alert-dismissible fade show mt-3" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row mt-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Area Tasks</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Area</th>
                                        <th>Task Doer</th>
                                        <th>Task Title</th>
                                        <th>Task Description</th>
                                        <th>Task FILE</th>
                                        <th>Task deadline</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($area_tasks as $model)
                                        <tr>
                                            <td>{{ $model->id }}</td>
                                            <td>{{ $model->area->name }}</td>
                                            <td>{{ $model->task->doer }}</td>
                                            <td>{{ $model->task->title }}</td>
                                            <td>{{ $model->task->description }}</td>
                                            <td>
                                                <a href="{{ $model->task->file }}">FILE</a>
                                            </td>
                                            <td>{{ $model->task->deadline }}</td>
                                            <td>
                                                <a href="{{ route('area_task.edit', $model->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                            </td>
                                            <td>
                                                <div>
                                                    <form action="{{ route('area_task.destroy', $model->id) }}" method="POST">
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
                </div>
                {{ $area_tasks->links() }}
            </div>
        </div>
    </section>
@endsection
