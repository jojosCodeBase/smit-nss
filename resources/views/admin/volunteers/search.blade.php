<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
@extends('layouts/admin-content')
@section('content')
    @if (session('error'))
        <div class="row d-flex justify-content-center">
            <div class="col">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <b>{{ session('error') }}</b>
                    <button type="button" class="btn-close " data-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-xl-12 col-xxl-5 d-flex">
                <div class="w-100">
                    <div class="row d-flex justify-content-center">
                        <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                            <form action="{{ route('volunteer.search-details') }}" method="POST">
                                @csrf
                                <div class="card p-1">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-10 col-md-10 col-12 mx-lg-0 ps-xl-0 ps-xl-0 ps-lg-0 ps-md-0 pe-lg-2 pe-md-2">
                                                <input type="search" placeholder="Search by name or regno"
                                                    class="form-control" name="search_string">
                                            </div>
                                            <div
                                                class="col-lg-2 col-md-2 col-12 d-flex justify-content-center mt-lg-0 mt-2 pe-xl-0 ps-xl-0 pe-lg-0 pe-md-0 ps-lg-3 ps-md-3">
                                                <input type="submit" class="btn btn-primary w-100" value="Search">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (session('volunteer'))
            <div class="row">
                <div class="col-12 col-lg-12 col-xxl-9 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header">
                            <h5 class="mb-0 h4 text-center fw-bold">Available Records</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-responsive">
                                <thead>
                                    <tr>
                                        <th>Reg.no</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Course</th>
                                        <th>Batch</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (session('volunteer') as $v)
                                        <tr>
                                            <td>{{ $v['id'] }}</td>
                                            <td>{{ $v['name'] }}</td>
                                            <td>{{ $v['email'] }}</td>
                                            <td>{{ $v['phone'] }}</td>
                                            <td>{{ $v['course'] }}</td>
                                            <td>{{ $v['batch'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
