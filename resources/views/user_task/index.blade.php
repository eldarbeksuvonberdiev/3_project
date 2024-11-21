@extends('layouts.admin_main')

@section('title', 'User Task')
@section('pagename', 'User Task')

@section('content')
    <section class="content">
        <div class="container-fluid">
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
                                <a href="{{ route('user_task.index') }}" class="small-box-footer">Show <i
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
                                <a href="{{ route('user_task.sort', 2) }}" class="small-box-footer">Show <i
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
                                <a href="{{ route('user_task.sort', 1) }}" class="small-box-footer">Show <i
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
                                <a href="{{ route('user_task.sort', 0) }}" class="small-box-footer">Show <i
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
                                <a href="{{ route('user_task.sort', -1) }}" class="small-box-footer">Show <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="row mt-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">User tasks</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Task Doer</th>
                                        <th>Task Title</th>
                                        <th>Task Description</th>
                                        <th>Task FILE</th>
                                        <th>Task Given Time</th>
                                        <th>Task deadline</th>
                                        <th>Current Status</th>
                                        <th>Next Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($tasks->isNotEmpty())
                                        @foreach ($tasks as $user_task)
                                            <tr>
                                                <td>{{ $user_task->id }}</td>
                                                <td>{{ $user_task->task->doer }}</td>
                                                <td>{{ $user_task->task->title }}</td>
                                                <td>{{ $user_task->task->description }}</td>
                                                <td>
                                                    <a href="{{ $user_task->task->file }}" class="btn btn-info"
                                                        download="">FILE</a>
                                                </td>
                                                <td>
                                                    {{ $user_task->created_at }}
                                                </td>
                                                <td>{{ $user_task->task->deadline }}</td>
                                                <td>
                                                    @if ($user_task->status == 0)
                                                        <input class="btn btn-danger" type="button">Returned</button>
                                                    @endif
                                                    @if ($user_task->status == 1)
                                                        <input type="hidden" name="status" value="2">
                                                        <button class="btn btn-primary" type="submit">Given</button>
                                                    @endif

                                                    @if ($user_task->status == 2)
                                                        <button class="btn btn-warning" type="button">Started</button>
                                                    @endif

                                                    @if ($user_task->status == 3)
                                                        <button class="btn btn-info" type="button">Finished</button>
                                                    @endif

                                                    @if ($user_task->status == 4)
                                                        <button class="btn btn-success" type="button">Accepted</button>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($user_task->status == 0)
                                                        <input class="btn btn-danger" type="button">Returned</button>
                                                    @endif

                                                    @if ($user_task->status == 1)
                                                        <form action="#" method="post">
                                                            @csrf
                                                            <input type="hidden" name="status" value="2">
                                                            <button class="btn btn-primary" type="button">Start</button>
                                                        </form>
                                                    @endif

                                                    @if ($user_task->status == 2)
                                                        <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                            data-bs-target="#inprogress{{ $user_task->id }}">
                                                            Finish
                                                        </button>

                                                        <div class="modal fade" id="inprogress{{ $user_task->id }}"
                                                            data-bs-backdrop="static" data-bs-keyboard="false"
                                                            tabindex="-1" aria-labelledby="staticBackdropLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5"
                                                                            id="staticBackdropLabel">
                                                                            Modal title</h1>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form
                                                                            action="{{ route('user_task.update', $user_task->id) }}"
                                                                            method="POST" enctype="multipart/form-data">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <div class="mb-3">
                                                                                <label for="title"
                                                                                    class="form-label">Title
                                                                                    of answer</label>
                                                                                <input type="text" name="title"
                                                                                    class="form-control" id="title"
                                                                                    placeholder="Title">
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="file"
                                                                                    class="form-label">FILE</label>
                                                                                <input type="file" class="form-control"
                                                                                    name="file" id="file">
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">Close</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">Submit</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if ($user_task->status == 3)
                                                        <button class="btn btn-success" type="button">Waiting</button>
                                                    @endif

                                                    @if ($user_task->status == 4)
                                                        <button class="btn btn-success" type="button">Accepted</button>
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
                </div>
                {{ $tasks->links() }}
            </div>
        </div>
    </section>
@endsection
