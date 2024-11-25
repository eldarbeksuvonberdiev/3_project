@extends('layouts.admin_main')

@section('title', 'Statistics by Categories')
@section('pagename', 'Statistics by Categories')

@section('content')
    <section class="content">
        <div class="col-12">
            <div class="container-fluid">
                <div class="row mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Statistics</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Category tasks by status</th>
                                        @foreach ($areas as $area)
                                            <th style="writing-mode:vertical-rl;transform:rotate(180deg);text-align:center;">
                                                {{ $area->name }}</th>
                                        @endforeach
                                        <th>
                                            Overall by Areas
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $category->name }}</td>
                                            <td style="padding: 0;border: 1px solid #ccc;">
                                                <table class="table table-striped table-bordered m-0"
                                                    style="width: 100%;border-collapse: collapse;">
                                                    <tr>
                                                        <td>Given</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Started</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Finished</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Accepted</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Rejected</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            @foreach ($areas as $area)
                                                <td style="padding: 0;border: 1px solid #ccc;">
                                                    <table class="table table-striped table-bordered m-0"
                                                        style="width: 100%;border-collapse: collapse;">
                                                        <tr>
                                                            <td>
                                                                @php
                                                                    $count = $area_task
                                                                        ->where('category_id', $category->id)
                                                                        ->where('area_id', $area->id)
                                                                        ->where('status', 1)
                                                                        ->count();
                                                                @endphp
                                                                @if ($count > 0)
                                                                    <span
                                                                        style="padding: 5px; background-color: blue; border-radius:5px; font-weight: bold;">{{ $count }}</span>
                                                                @else
                                                                    {{ '0' }}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                @php
                                                                    $count = $area_task
                                                                        ->where('category_id', $category->id)
                                                                        ->where('area_id', $area->id)
                                                                        ->where('status', 2)
                                                                        ->count();
                                                                @endphp
                                                                @if ($count > 0)
                                                                    <span
                                                                        style="padding: 5px; background-color: skyblue; border-radius:5px; font-weight: bold;">{{ $count }}</span>
                                                                @else
                                                                    {{ '0' }}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                @php
                                                                    $count = $area_task
                                                                        ->where('category_id', $category->id)
                                                                        ->where('area_id', $area->id)
                                                                        ->where('status', 3)
                                                                        ->count();
                                                                @endphp
                                                                @if ($count > 0)
                                                                    <span
                                                                        style="padding: 5px; background-color: yellow; border-radius:5px; font-weight: bold;">{{ $count }}</span>
                                                                @else
                                                                    {{ '0' }}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                @php
                                                                    $count = $area_task
                                                                        ->where('category_id', $category->id)
                                                                        ->where('area_id', $area->id)
                                                                        ->where('status', 4)
                                                                        ->count();
                                                                @endphp
                                                                @if ($count > 0)
                                                                    <span
                                                                        style="padding: 5px; background-color: green; border-radius:5px; font-weight: bold;">{{ $count }}</span>
                                                                @else
                                                                    {{ '0' }}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                @php
                                                                    $count = $area_task
                                                                        ->where('category_id', $category->id)
                                                                        ->where('area_id', $area->id)
                                                                        ->where('status', 0)
                                                                        ->count();
                                                                @endphp
                                                                @if ($count > 0)
                                                                    <span
                                                                        style="padding: 5px; background-color: red; border-radius:5px; font-weight: bold;">{{ $count }}</span>
                                                                @else
                                                                    {{ '0' }}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            @endforeach
                                            <td style="padding: 0;border: 1px solid #ccc;">
                                                <table class="table table-striped table-bordered m-0"
                                                    style="width: 100%;border-collapse: collapse;">
                                                    <tr>
                                                        <td>
                                                            @php
                                                                $count = $area_task
                                                                    ->where('category_id', $category->id)
                                                                    ->where('status', 1)
                                                                    ->count();
                                                            @endphp
                                                            @if ($count > 0)
                                                                <a style="padding: 5px; background-color: blue; font-weight:bold; border-radius: 5px">{{ $count }}</a>
                                                            @else
                                                                {{ '0' }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            @php
                                                                $count = $area_task
                                                                    ->where('category_id', $category->id)
                                                                    ->where('status', 2)
                                                                    ->count();
                                                            @endphp
                                                            @if ($count > 0)
                                                                <a style="padding: 5px; background-color: skyblue; font-weight:bold; border-radius: 5px">{{ $count }}</a>
                                                            @else
                                                                {{ '0' }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            @php
                                                                $count = $area_task
                                                                    ->where('category_id', $category->id)
                                                                    ->where('status', 3)
                                                                    ->count();
                                                            @endphp
                                                            @if ($count > 0)
                                                                <a style="padding: 5px; background-color: yellow; font-weight:bold; border-radius: 5px">{{ $count }}</a>
                                                            @else
                                                                {{ '0' }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            @php
                                                                $count = $area_task
                                                                    ->where('category_id', $category->id)
                                                                    ->where('status', 4)
                                                                    ->count();
                                                            @endphp
                                                            @if ($count > 0)
                                                                <a style="padding: 5px; background-color: green; font-weight:bold; border-radius: 5px">{{ $count }}</a>
                                                            @else
                                                                {{ '0' }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            @php
                                                                $count = $area_task
                                                                    ->where('category_id', $category->id)
                                                                    ->where('status', 0)
                                                                    ->count();
                                                            @endphp
                                                            @if ($count > 0)
                                                                <a style="padding: 5px; background-color: red; font-weight:bold; border-radius: 5px">{{ $count }}</a>
                                                            @else
                                                                {{ '0' }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </table>
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
