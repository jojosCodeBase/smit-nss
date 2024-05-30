@extends('layouts/admin-content')
@section('title', 'Dashboard')
@section('breadcrumb', 'Dashboard')
@section('content')
    <div class="container-fluid p-0 mt-0">
        <div class="row">
            <div class="col-12 d-flex">
                <div class="w-100">
                    <div class="row">
                        {{-- <div class="col-lg-6 col-xl-4 col-md-6 col-xxl-3"> --}}
                        <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Volunteers</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="bi bi-people fs-4"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{ $totalVolunteers }}</h1>
                                    {{-- <div class="mb-0">
                                    @if ($batchInfo != 0)
                                        <span class="text-muted">{{ $batchInfo['batch1']->name }}: <span class="text-success"> {{ $batchInfo['batch1']->volunteers }}</span> / {{ $batchInfo['batch2']->name }}: <span class="text-success"> {{ $batchInfo['batch2']->volunteers }}</span></span>
                                    @endif
                                </div> --}}
                                    <div id="">
                                        Since: <span class="current-year text-success"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Drives</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="bi bi-activity fs-3"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{ $totalDrives }}</h1>
                                    <div id="">
                                        Since: <span class="current-year text-success"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-12 col-xl-12 col-xxl-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Recent Activities</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover my-0">
                            <thead>
                                <tr>
                                    <th style="width: 105px">Date</th>
                                    <th>Title</th>
                                    <th class="d-none d-xl-table-cell">Area</th>
                                    <th class="d-none d-xl-table-cell">Present</th>
                                    <th class="d-none d-md-table-cell">Cordinator</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($drives as $d)
                                    <tr>
                                        <td>{{ $d['date'] }}</td>
                                        <td>{{ $d['title'] }}</td>
                                        <td class="d-none d-xl-table-cell">{{ $d['area'] }}</td>
                                        <td class="d-none d-xl-table-cell">{{ $d['present'] }}</td>
                                        <td class="d-none d-md-table-cell">{{ $d['conductedBy'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            var elements = document.getElementsByClassName('current-year');
            for (var i = 0; i < elements.length; i++) {
                elements[i].textContent = new Date().getFullYear();
            }
        });
    </script>
@endsection
