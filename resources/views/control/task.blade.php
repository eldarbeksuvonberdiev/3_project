@extends('layouts.admin_main')

@section('title', "$area_name Tasks")
@section('pagename', "$area_name Tasks")

@section('content')
    <section class="content">
        <div class="col-12">
            <div class="container-fluid">
                <div class="row mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Users</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Area</th>
                                        <th>Doer</th>
                                        <th>Title</th>
                                        <th>FILE</th>
                                        <th>Given Time</th>
                                        <th>Deadline</th>
                                        <th>Status</th>
                                        <th>Answer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($tasks->isNotEmpty())
                                        @foreach ($tasks as $task)
                                            <tr>
                                                <td>{{ $task->id }}</td>
                                                <td>{{ $area_name }}</td>
                                                <td>{{ $task->task->doer }}</td>
                                                <td>{{ $task->task->title }}</td>
                                                <td>{{ $task->task->file }}</td>
                                                <td>{{ $task->created_at }}</td>
                                                <td>{{ $task->areaTask_deadline }}</td>
                                                <td>
                                                    @if ($task->status == 0)
                                                        <button class="btn btn-danger">Rejected</button>
                                                    @elseif($task->status == 1)
                                                        <button class="btn btn-primary">Given</button>
                                                    @elseif($task->status == 2)
                                                        <button class="btn btn-warning">Started</button>
                                                    @elseif($task->status == 3)
                                                        <button class="btn btn-success">Finished</button>
                                                    @else
                                                        <button class="btn btn-success">Accepted</button>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($task->answer)
                                                        <button class="btn btn-success">Answered</button>
                                                    @else
                                                        <button class="btn btn-danger">Not Answered</button>
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
            </div>
        </div>
    </section>
@endsection
