@extends('layouts.admin_main')

@section('title', 'Statistics')
@section('pagename', 'Statistics')

@section('content')
    <section class="content">
        <div class="col-12">
            <form action="{{ route('statistics.filter') }}" method="GET">
                @csrf
                <div class="row mt-3">
                    <div class="col-5">
                        <label for="start">Start Date:</label>
                        <input type="date" id="start" class="form-control" name="start" value="{{ old('start') }}">
                        @error('start')
                            <div class="text-warning">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-5">
                        <label for="end">End Date:</label>
                        <input type="date" id="end" class="form-control" name="end" value="{{ old('end') }}">
                        @error('end')
                            <div class="text-warning">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-2" style="margin-top: 31px">
                        <button type="submit" class="btn btn-primary" style="width: 100%">Filter</button>
                    </div>
                </div>
            </form>
            <div class="container-fluid">
                <div class="row mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Statistics</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Name</th>
                                        <th>Given</th>
                                        <th>Started</th>
                                        <th>Finished</th>
                                        <th>Accepted</th>
                                        <th>Rejected</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                {{ $area_task->where('category_id', $category->id)->where('status', 1)->count() }}
                                            </td>
                                            <td>{{ $area_task->where('category_id', $category->id)->where('status', 2)->count() }}
                                            </td>
                                            <td>{{ $area_task->where('category_id', $category->id)->where('status', 3)->count() }}
                                            </td>
                                            <td>{{ $area_task->where('category_id', $category->id)->where('status', 4)->count() }}
                                            </td>
                                            <td>{{ $area_task->where('category_id', $category->id)->where('status', 0)->count() }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
