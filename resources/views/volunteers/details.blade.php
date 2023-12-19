@extends('layouts/content')
@section('content')
    <div class="breadcrumb-bar mb-3 px-4">
        <span class="breadcrumb-item">Home</span>
        <span class="breadcrumb-item">Volunteers</span>
        <span class="breadcrumb-item">Manage</span>
        <span class="breadcrumb-item active">View/Edit Volunteer Details</span>
    </div>
    <div class="container">
        <div class="row search-row" id="search" style="display: block;">
            <div class="col">
                <h2 class="text-center">Search Volunteer Details-blade</h2>
                <div class="row">
                    <div class="col d-flex justify-content-center">
                        <form action="{{ route('volunteer.view-details') }}" method="POST" class="input-group w-50">
                            @csrf
                            <span class="input-group-text">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" name="search_string" placeholder="Search by name or registration number"
                                class="form-control" required>
                            <input type="submit" class="btn btn-primary mx-2" value="Search">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @if (session('fail'))
            <div class="row d-flex justify-content-center mt-5">
                <div class="col-10">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <b>{{ session('fail') }}</b>
                        <button type="button" class="btn-close " data-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif
        @if (session('success'))
            <div class="row d-flex justify-content-center mt-5">
                <div class="col-4">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span>{{ session('success') }}</span>
                        <button type="button" class="btn-close " data-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif
        <div class="row details-row mt-5 p-0 d-flex justify-content-center">
            <div class="col bg- p-4 mx-4 border mb-4 bg-light">
                <div class="row">
                    <h4 class="text-center mb-0">Available Records</h4>
                    <table class="table table-light">
                        <thead>
                            <th>Sl.no</th>
                            <th>Reg.no</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Batch</th>
                            <th>Course</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($volunteer as $v)
                                @php
                                    $slno = $loop->iteration;
                                @endphp
                                <tr>
                                    <td>{{ $slno }}.</td>
                                    <td>{{ $v->id }}</td>
                                    <td>{{ $v->name }}</td>
                                    <td>{{ $v->email }}</td>
                                    <td>{{ $v->phone }}</td>
                                    <td>{{ $v->batch }}</td>
                                    <td>{{ $v->course }}</td>
                                    {{-- <td><button type="button" data-toggle="collapse" data-target="#collapseItem"><u>View</u></button></td> --}}
                                    <td><a data-toggle="collapse" data-target="#collapseItem{{ $slno }}"
                                            class="collapse-a">View</a>
                                    </td>
                                </tr>
                                <tr colspan="8" class="collapse p-2" id="collapseItem{{ $slno }}">
                                    <td colspan="8">
                                        <div class="row mt-0 p-0 d-flex justify-content-center">
                                            <div class="col bg- p-4 mx-4 border mb-4 bg-light">
                                                {{-- <h2 class="text-center mb-4">Volunteer Details</h2> --}}
                                                <!-- View details section -->
                                                <div class="row details-row">
                                                    <div class="col-5 personal-info">
                                                        <h6>Personal Info</h6>
                                                        <div class="row mb-2">
                                                            <div class="col-3 title">Name</div>
                                                            <div class="col text-start details">{{ $v->name }}</div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class="col-3 title">Reg.no</div>
                                                            <div class="col text-start details">{{ $v->id }}</div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class="col-3 title">Email</div>
                                                            <div class="col text-start details">{{ $v->email }}</div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class="col-3 title">Phone</div>
                                                            <div class="col text-start details">{{ $v->phone }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col other-info">
                                                        <h6>Other Info</h6>
                                                        <div class="row mb-2">
                                                            <div class="col-5 title">Department</div>
                                                            <div class="col text-start details">{{ $v->department }}</div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class="col-5 title">Course</div>
                                                            <div class="col text-start details">{{ $v->course }}</div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class="col-5 title">NSS Batch</div>
                                                            <div class="col text-start details">{{ $v->batch }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col nss-info">
                                                        <h6>NSS Activities Info</h6>
                                                        <div class="row mb-2">
                                                            <div class="col-8 title">Drives Conducted</div>
                                                            <div class="col text-start details">0</div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class="col-8 title">Drives participated</div>
                                                            <div class="col text-start details">
                                                                {{ $v->drives_participated }}
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class="col-8 title">Absent</div>
                                                            <div class="col text-start details">{{ $v->absent }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-4 mb-4">
                                                    <div class="col d-flex justify-content-center">
                                                        <button type="button" class="btn btn-success p-1"
                                                            data-target="#editInfoModal{{ $slno }}"
                                                            data-toggle="modal"><i class="bi-pencil-fill"></i> Edit
                                                            details</button>
                                                    </div>
                                                </div>

                                                <!-- Start Edit/Update Details Section -->
                                                <div class="modal fade" id="editInfoModal{{ $slno }}">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit Info</h4>
                                                                <button type="button" class="btn-close"
                                                                    data-dismiss="modal" aria-hidden="true"></button>
                                                            </div>
                                                            <form action="{{ route('volunteer.update') }}"
                                                                method="POST">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <div class="row mb-3">
                                                                        <div class="col">
                                                                            <input type="text" name="regno"
                                                                                class="form-control"
                                                                                placeholder="Registration no*"
                                                                                value="{{ $v->id }}" readonly>
                                                                        </div>
                                                                        <div class="col">
                                                                            <input type="text" name="name"
                                                                                class="form-control" placeholder="Name*"
                                                                                value="{{ $v->name }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col">
                                                                            <input type="email" name="email"
                                                                                class="form-control" placeholder="Email*"
                                                                                value="{{ $v->email }}">
                                                                        </div>
                                                                        <div class="col">
                                                                            <input type="number" name="phone"
                                                                                class="form-control" placeholder="Phone*"
                                                                                value="{{ $v->phone }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col">
                                                                            <select name="department" id=""
                                                                                class="form-select">
                                                                                <option value="{{ $v->department }}"
                                                                                    selected>
                                                                                    Department of Computer
                                                                                    Applications
                                                                                </option>
                                                                                <option value="">Department of Civil
                                                                                    Enginieering</option>
                                                                                <option value="">Department of
                                                                                    Computer
                                                                                    Science Enginieering
                                                                                </option>
                                                                                <option value="">Department of
                                                                                    Mechnical
                                                                                    Engineering</option>
                                                                                <option value="">Department of
                                                                                    Information Technology</option>
                                                                                <option value="">Department of
                                                                                    Electrical
                                                                                    and Electronics
                                                                                    Engineering
                                                                                </option>
                                                                                <option value="">Department of
                                                                                    Electronics and Communication
                                                                                    Engineering
                                                                                </option>
                                                                                <option value="">Department of
                                                                                    Artificial
                                                                                    Intelligence and Data
                                                                                    Science
                                                                                </option>
                                                                                <option value="">Department of
                                                                                    Management
                                                                                    Studies</option>
                                                                                <option value="">Department of
                                                                                    Mathematics</option>
                                                                                <option value="">Department of
                                                                                    Chemistry
                                                                                </option>
                                                                                <option value="">Department of
                                                                                    Physics
                                                                                </option>
                                                                                <option value="">Department of
                                                                                    Physical
                                                                                    Education</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col">
                                                                            <select name="course" id=""
                                                                                class="form-select">
                                                                                <option value="{{ $v->course }}"
                                                                                    selected>
                                                                                    {{ $v->course }}</option>
                                                                                <option value="">MCA</option>
                                                                                <option value="">M.Sc</option>
                                                                                <option value="">BTech</option>
                                                                                <option value="">BCA</option>
                                                                                <option value="">BBA</option>
                                                                                <option value="">B.Sc</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col">
                                                                            <select name="batch" id=""
                                                                                class="form-select">
                                                                                <option value="2022-24" selected>2022-24
                                                                                </option>
                                                                                <option value="2023-25">2023-25</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer"
                                                                    style="background-color: #f1f1f1;">
                                                                    <div class="col">
                                                                        <span class="text-danger">Note: Contact System
                                                                            Administrator to change
                                                                            Registration Number</span>
                                                                    </div>

                                                                    <div class="col-lg-4 d-flex justify-content-end">
                                                                        <input type="button" class="btn btn-default"
                                                                            data-dismiss="modal" value="Cancel">
                                                                        <input type="submit" class="btn btn-primary"
                                                                            value="Update">
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Edit/Update Details Section -->
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- end view details section -->
            </div>
        </div>


    </div>
@endsection
