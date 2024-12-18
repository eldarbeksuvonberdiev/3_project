@extends('layouts.admin_main')

@section('title', 'Tasks')
@section('pagename', 'Tasks')

@section('content')
    <section class="content">
        <div class="col-12">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-2 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $deadlines->total_tasks }}</h3>

                                    <p>All tasks</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="{{ route('task.index') }}" class="small-box-footer">Show <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $deadlines->two_days_left }}</h3>

                                    <p>2 days left</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="{{ route('task.sort', 2) }}" class="small-box-footer">Show <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{ $deadlines->one_day_left }}</h3>

                                    <p>Day left</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="{{ route('task.sort', 1) }}" class="small-box-footer">Show <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{ $deadlines->deadline_today }}</h3>

                                    <p>Today</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="{{ route('task.sort', 0) }}" class="small-box-footer">Show <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{ $deadlines->deadline_passed }}</h3>

                                    <p>Deadline passed</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="{{ route('task.sort', -1) }}" class="small-box-footer">Show <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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
                    <div class="col-1" style="margin-top: 31px">
                        <button type="submit" class="btn btn-primary" style="width: 100%">Filter</button>
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
                                        <th>Given time</th>
                                        <th>Deadline</th>
                                        <th>Delete</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($tasks->isNotEmpty())
                                        @foreach ($tasks as $task)
                                            <tr>
                                                <td>{{ $task->id }}</td>
                                                <td>
                                                    {{ $task->category->name }}
                                                </td>
                                                <td>{{ $task->task->doer }}</td>
                                                <td>{{ $task->task->title }}</td>
                                                <td>{{ $task->task->description }}</td>
                                                <td>
                                                    <a href="{{ $task->task->file }}" download=""
                                                        class="btn btn-info">FILE</a>
                                                </td>
                                                <td>{{ $task->created_at }}</td>
                                                <td>{{ $task->areaTask_deadline }}</td>
                                                <td>
                                                    <div>
                                                        <form action="{{ route('task.destroy', $task->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger" type="submit">Delete</button>
                                                        </form>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if (!empty($task->answer))
                                                        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" 
                                                        data-bs-target="#exampleModal{{ $task->id }}">Accept/Reject</button>

                                                        <div class="modal fade" id="exampleModal{{ $task->id }}" tabindex="-1"
                                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="mb-3">
                                                                            <label for="title" class="form-label">Title</label>
                                                                            <input type="text" class="form-control" id="title" value="{{ $task->answer->title }}" readonly>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <a href="{{ $task->answer->file }}" download="{{ $task->answer->file }}" class="btn btn-info" style="width: 100%">FILE</a>
                                                                        </div>
                                                                        <hr style="2px solid red">
                                                                        <form action="{{ route('answer.action',$task->answer->id) }}" method="POST">
                                                                            @csrf
                                                                            <div class="mb-3">
                                                                                <label for="comment" class="form-label">Comment</label>
                                                                                <input type="text" class="form-control" id="comment" name="comment" style="height: 10vh" required>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="submit" class="btn btn-success" name="action" value="accept">Accept</button>
                                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                                <button type="submit" class="btn btn-danger" name="action" value="reject">Reject</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        {{ 'No answer recorded yet' }}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="10" class="text-center">No tasks available.</td>
                                        </tr>
                                    @endif
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
