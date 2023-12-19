@extends('layouts/content')
@section('content')
    <div class="breadcrumb-bar mb-3 px-4">
        <span class="breadcrumb-item">Home</span>
        <span class="breadcrumb-item">Volunteers</span>
        <span class="breadcrumb-item">Manage</span>
        <span class="breadcrumb-item active">View/Edit Volunteer Details</span>
    </div>
    <div class="container">
        <h3 class="text-center">List All Volunteers</h3>
        <div class="container">
            <form action="{{ route('volunteer.list-all') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-3 offset-2 px-0">
                        <select name="" id="" class="form-select">
                            <option value="">Select from list</option>
                            <option value="">All</option>
                            <option value="">2022-24</option>
                            <option value="">2023-25</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <select name="" id="" class="form-select">
                            <option value="">Select from list</option>
                            <option value="">All</option>
                            <option value="">1st Year</option>
                            <option value="">2nd Year</option>
                            <option value="">3rd Year</option>
                            <option value="">4th Year</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <input type="submit" class="btn btn-primary" value="Search">
                    </div>
                </div>
            </form>
        </div>

        @if(session('volunteers'))
            <div class="row details-row mt-5 p-0 d-flex justify-content-center">
                <div class="col bg- p-4 mx-4 border mb-4 bg-light">
                    <div class="row">
                        <h4 class="text-center mb-0">All Volunteers</h4>
                        <table class="table table-light table-striped">
                            <thead>
                                {{-- <th>Sl.no</th> --}}
                                <th>Reg.no</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Batch</th>
                                <th>Course</th>
                                <th>Department</th>
                            </thead>
                            <tbody>
                                @foreach((session('volunteers')) as $v)
                                    <tr>
                                        {{-- <td>{{ $slno }}</td> --}}
                                        <td>{{ $v->id }}</td>
                                        <td>{{ $v->name }}</td>
                                        <td>{{ $v->email }}</td>
                                        <td>{{ $v->phone }}</td>
                                        <td>{{ $v->batch }}</td>
                                        <td>{{ $v->course }}</td>
                                        <td>{{ $v->department }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
        @if(session('fail'))
            <div class="row d-flex justify-content-center">
                <div class="col">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <b>{{ session('fail') }}</b>
                        <button type="button" class="btn-close " data-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
