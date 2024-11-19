@extends('layouts.admin_main')

@section('title', 'User Task')
@section('pagename', 'User Task')

@section('content')
    <section class="content">
        <div class="container-fluid">
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
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tasks as $user_task)
                                        <tr>
                                            <td>{{ $user_task->id }}</td>
                                            <td>{{ $user_task->area->name }}</td>
                                            <td>{{ $user_task->task->doer }}</td>
                                            <td>{{ $user_task->task->title }}</td>
                                            <td>{{ $user_task->task->description }}</td>
                                            <td>
                                                <a href="{{ $user_task->task->file }}" download="">FILE</a>
                                            </td>
                                            <td>{{ $user_task->task->deadline }}</td>
                                            <td>
                                                @if ($user_task->status == 0)
                                                    <input class="btn btn-danger" type="button">Returned</button>
                                                @endif

                                                <form action="{{ route('user_task.update', $user_task->id) }}"
                                                    method="post">
                                                    @csrf 
                                                    @method('PUT')
                                                    @if ($user_task->status == 1)
                                                        <input type="hidden" name="status" value="2">
                                                        <button class="btn btn-primary" type="submit">Start</button>
                                                    @endif
                                                </form>
                                                
                                                @if ($user_task->status == 2)
                                                    <input type="hidden" name="status" value="3">
                                                    <button class="btn btn-info" type="submit">End Task</button>
                                                @endif
                                                @if ($user_task->status == 3)
                                                    <button class="btn btn-success" type="button">Finished</button>
                                                @endif

                                                @if ($user_task->status == 4)
                                                    <button class="btn btn-success" type="button">Accepted</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{ $tasks->links() }}
            </div>
        </div>
    </section>
@endsection
