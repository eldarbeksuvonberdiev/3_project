@extends('layouts.admin_main')

@section('title', 'Control')
@section('pagename', 'Control')

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
                                <a href="{{ route('control.index') }}" class="small-box-footer">Show <i
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
                                <a href="{{ route('control.sort', 2) }}" class="small-box-footer">Show <i
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
                                <a href="{{ route('control.sort', 1) }}" class="small-box-footer">Show <i
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
                                <a href="{{ route('control.sort', 0) }}" class="small-box-footer">Show <i
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
                                <a href="{{ route('control.sort', -1) }}" class="small-box-footer">Show <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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
                                        <th>Hudud</th>
                                        @foreach ($categories as $category)
                                            <th>{{ $category->name }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($areas as $area)
                                        <tr>
                                            <td>{{ $area->name }}</td>
                                            @foreach ($categories as $category)
                                                <td>
                                                    <a href="{{ route('control.task', [$area->id, $category->id, $status]) }}"
                                                        type="submit" target="_blank"
                                                        class="btn btn-{{ $button }}">{{ $area_task->where('category_id', '=', $category->id)->where('area_id', '=', $area->id)->count() }}</a>
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{ $areas->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
