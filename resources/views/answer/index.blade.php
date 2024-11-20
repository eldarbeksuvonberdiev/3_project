@extends('layouts.admin_main')

@section('title', 'Result')
@section('pagename', 'Result')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Results</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Task</th>
                                        <th></th>
                                        <th>Task Title</th>
                                        <th>Task Description</th>
                                        <th>Task FILE</th>
                                        <th>Task deadline</th>
                                        <th>Status</th>
                                        {{-- <th>Edit</th> --}}
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($answers as $area_task)
                                        <tr>
                                            {{-- <td>{{ $area_task->id }}</td>
                                            <td>{{ $area_task->area->name }}</td>
                                            <td>{{ $area_task->task->doer }}</td>
                                            <td>{{ $area_task->task->title }}</td>
                                            <td>{{ $area_task->task->description }}</td> --}}
                                            <td>
                                                {{-- <a href="{{ $area_task->task->file }}">FILE</a> --}}
                                            </td>
                                            {{-- <td>{{ $area_task->task->deadline }}</td> --}}
                                            <td>
                                                @if ( $area_task->status == 0 )
                                                    <button class="btn btn-danger" type="button">Returned</button>
                                                @endif
                                                @if ($area_task->status == 1 )
                                                    <button class="btn btn-primary" type="button">Given</button>
                                                @endif
                                                @if ( $area_task->status == 2 )
                                                    <button class="btn btn-info" type="button">Doing</button>
                                                @endif
                                                @if ( $area_task->status == 3 )
                                                    <button class="btn btn-success" type="button">Accepted</button>
                                                @endif
                                            </td>
                                            {{-- <td>
                                                <a href="{{ route('area_task.edit', $area_task->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                            </td> --}}
                                            <td>
                                                <div>
                                                    <form action="{{ route('area_task.destroy', $area_task->id) }}" method="POST">
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
                {{ $answers->links() }}
            </div>
        </div>
    </section>
@endsection
