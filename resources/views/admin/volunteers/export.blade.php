{{-- @extends('layouts/admin-content')
@section('title', 'Export Volunteers')
@section('breadcrumb', 'Export Volunteers')
@section('content')

    @include('include/alerts')

    <div class="container p-0">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Export Volunteer Details</div>
                <form action="{{ route('volunteer.fetchData') }}" method="POST" id="form" class="needs-validation"
                    novalidate>
                    @csrf
                    <div class="row mt-3 p-0 px-0">
                        <div class="col-md-5 col-lg-4 mt-lg-0 mt-xl-0 mt-md-0 mt-3">
                            <select name="batch" class="form-select" id="batch" required>
                                <option value="" selected>Select batch from list</option>
                                <option value="*">All</option>
                                @for ($index = 0; $index < $batches->count(); $index++)
                                    <option value="{{ $batches[$index] }}">{{ $batches[$index] }}</option>
                                @endfor
                            </select>
                            <div class="invalid-feedback">
                                Please select a option.
                            </div>
                        </div>
                        <div class="col-md-5 col-lg-4 mt-lg-0 mt-xl-0 mt-md-0 mt-3">
                            <select name="course" class="form-select" id="course" required>
                                <option value="" selected>Select course from list</option>
                                <option value="*">All</option>
                                @foreach ($courses as $c)
                                    <option value="{{ $c['id'] }}">{{ $c['name'] }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please select a option.
                            </div>
                        </div>
                        <div class="col-md-2 col-lg-2 mt-lg-0 mt-xl-0 mt-md-0 mt-3">
                            <input type="submit" class="btn btn-primary w-100" value="Search">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @if (session('volunteers'))
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-success">Export</button>
                        <button class="btn btn-success">Download</button>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Reg No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>NSS Batch</th>
                                            <th>Course</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (session('volunteers') as $v)
                                            <tr>
                                                <td>{{ $v['id'] }}</td>
                                                <td>{{ $v['name'] }}</td>
                                                <td>{{ $v['email'] }}</td>
                                                <td>{{ $v['phone'] }}</td>
                                                <td id="batch-name-export">{{ $v['batch'] }}</td>
                                                <td>{{ $v['course'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection --}}


@extends('layouts/admin-content')
@section('title', 'Export Volunteers')
@section('breadcrumb', 'Export Volunteers')
@section('content')

    @include('include/alerts')

    <div class="container p-0">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Export Volunteer Details</div>
                <form action="{{ route('volunteer.fetchData') }}" method="POST" id="form" class="needs-validation"
                    novalidate>
                    @csrf
                    <div class="row mt-3 p-0 px-0">
                        <div class="col-md-5 col-lg-4 mt-lg-0 mt-xl-0 mt-md-0 mt-3">
                            <select name="batch" class="form-select" id="batch" required>
                                <option value="" selected>Select batch from list</option>
                                <option value="*">All</option>
                                @foreach ($batches as $batch)
                                    <option value="{{ $batch->id }}">{{ $batch->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please select a option.
                            </div>
                        </div>
                        <div class="col-md-5 col-lg-4 mt-lg-0 mt-xl-0 mt-md-0 mt-3">
                            <select name="course" class="form-select" id="course" required>
                                <option value="" selected>Select course from list</option>
                                <option value="*">All</option>
                                @foreach ($courses as $c)
                                    <option value="{{ $c['id'] }}">{{ $c['name'] }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please select a option.
                            </div>
                        </div>
                        <div class="col-md-2 col-lg-2 mt-lg-0 mt-xl-0 mt-md-0 mt-3">
                            <input type="submit" class="btn btn-primary w-100" value="Search">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @if (session('volunteers'))
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-end mb-3">
                        <form action="{{ route('volunteer.export-post') }}" method="POST">
                            @csrf
                            <input type="hidden" name="batch" value="{{ session('batch') }}">
                            <input type="hidden" name="course" value="{{ session('course') }}">
                            <button type="submit" class="btn btn-success">Export to Excel</button>
                        </form>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Reg No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>NSS Batch</th>
                                            <th>Course</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (session('volunteers') as $v)
                                            <tr>
                                                <td>{{ $v['id'] }}</td>
                                                <td>{{ $v['name'] }}</td>
                                                <td>{{ $v['email'] }}</td>
                                                <td>{{ $v['phone'] }}</td>
                                                <td id="batch-name-export">{{ $v['batch'] }}</td>
                                                <td>{{ $v['course'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
