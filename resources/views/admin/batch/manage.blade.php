@extends('layouts/admin-content')
@section('content')
    @if (session('success'))
        <div class="row d-flex justify-content-center">
            <div class="col">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <b>{{ session('success') }}</b>
                    <button type="button" class="btn-close " data-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif
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
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
            <button type="button" class="btn-close " data-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="container-fluid p-0">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Create New NSS Batch</div>
                <form action="{{ route('batch.create') }}" method="POST">
                    @csrf
                    <div class="row mt-3 p-0 px-0">
                        <div class="col-md-5 col-lg-4">
                            <input type="text" name="name" class="form-control mb-1" placeholder="Batch Name"
                                id="batchName" required>
                        </div>
                        <div class="col-md-5 col-lg-4 mt-lg-0 mt-xl-0 mt-md-0 mt-3">
                            <input type="text" name="studentCoordinator" class="form-control"
                                placeholder="Student Co-ordinator" required>
                        </div>
                        <div class="col-md-2 col-lg-2 mt-lg-0 mt-xl-0 mt-md-0 mt-3">
                            <input type="submit" class="btn btn-primary w-100" value="Create">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container-fluid p-0">
        <div class="card">
            <div class="card-body table-responsive">
                <div class="card-title">All Batches</div>
                <table class="table">
                    <thead>
                        <th>Name</th>
                        <th>Student Co-ordinator</th>
                        <th>Volunteers</th>
                        <th>Registration</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($batches as $b)
                            <tr>
                                <td>{{ $b['name'] }}</td>
                                <td>{{ $b['studentCoordinator'] }}</td>
                                <td>{{ $b['volunteers'] }}</td>
                                @if ($b['status'] == 0)
                                    @php
                                        $buttonClass = 'btn-success';
                                        $buttonText = 'Open';
                                        $statusText = 'Not Accepting Responses';
                                    @endphp
                                @else
                                    @php
                                        $buttonClass = 'btn-danger';
                                        $buttonText = 'Close';
                                        $statusText = 'Accepting Responses';
                                    @endphp
                                @endif
                                <td>
                                    <button type="button" class="btn {{ $buttonClass }}"
                                        id="status-btn{{ $b['id'] }}"
                                        onclick="changeStatus({{ $b['id'] }}, {{ $b['status'] }})">{{ $buttonText }}</button>
                                </td>
                                <td id="form-status{{ $b['id'] }}">{{ $statusText }}</td>

                                <td>
                                    <div class="more-btn">
                                        <div class="dropdown">
                                            <button type="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="bi bi-three-dots"></i>
                                            </button>
                                            <ul class="dropdown-menu mt-5" aria-labelledby="dropdownMenuButton1">
                                                <li><a class="dropdown-item" href="{{ route('batch.registration-form', $b['name']) }}" target="_blank">View Form</a></li>
                                                <button class="dropdown-item" data-toggle="modal" data-target="#editModal"
                                                    onclick="editModal()">Edit</button>
                                                <button class="dropdown-item" data-toggle="modal" data-target="#deleteModal"
                                                    onclick="deleteModal()">Delete</button>
                                            </ul>
                                        </div>
                                    </div>
                                    {{-- <div class="more-btn">
                                        <button class="dropdown" type="button" id="dropdownMenuButton"
                                            data-toggle="dropdown">
                                            <i class="fa fa-circle" aria-hidden="true"></i>
                                            <i class="fa fa-circle" aria-hidden="true"></i>
                                            <i class="fa fa-circle" aria-hidden="true"></i>
                                            <i class="bi bi-three-dots"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <button class="dropdown-item view-button" data-toggle="modal"
                                                data-target="#viewModal"
                                                onclick="viewModalInit()">View</button>
                                            <button class="dropdown-item" data-toggle="modal" data-target="#editModal"
                                                onclick="editModal()">Edit</button>
                                            <button class="dropdown-item" data-toggle="modal" data-target="#deleteModal"
                                                onclick="deleteModal()">Delete</button>
                                        </div>
                                    </div>
                                    <a href="{{ route('batch.registration-form', $b['name']) }}" target="_blank">View</a> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
