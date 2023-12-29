@extends('layouts/admin-content')
@section('content')
    @if (session('fail'))
        <div class="row d-flex justify-content-center">
            <div class="col">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <b>{{ session('fail') }}</b>
                    <button type="button" class="btn-close " data-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif
    @if (session('success'))
        <div class="row d-flex justify-content-center">
            <div class="col">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span>{{ session('success') }}</span>
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
                            <form action="{{ route('volunteer.view-details') }}" method="POST">
                                @csrf
                                <div class="card p-1">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-10 col-9 mx-lg-0 ps-xl-0 ps-xl-0 ps-0 pe-2">
                                                <input type="search" placeholder="Search by name or regno"
                                                    class="form-control" name="search_string">
                                            </div>
                                            <div
                                                class="col-lg- col-2 d-flex justify-content-center mt-lg-0 pe-xl-0 ps-xl-0 pe-0 ps-3">
                                                <input type="submit" class="btn btn-primary" value="Search">
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($volunteers as $v)
                                    <tr>
                                        <td>{{ $v['id'] }}</td>
                                        <td>{{ $v['name'] }}</td>
                                        <td>{{ $v['email'] }}</td>
                                        <td>{{ $v['phone'] }}</td>
                                        <td>{{ $v['course'] }}</td>
                                        <td>{{ $v['batch'] }}</td>
                                        <td>
                                            <a data-toggle="collapse" data-target="#viewDetails" class="collapse-a"
                                                id="collapseToggleBtnMobile{{ $v['id'] }}"
                                                onclick="showDetails({{ $v['id'] }}, {{ json_encode($v['name']) }}, {{ json_encode($v['email']) }}, {{ json_encode($v['phone']) }}, {{ json_encode($v['course']) }}, {{ json_encode($v['batch']) }}, {{ $v['drives_participated'] }})">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $volunteers->links() }}
                    <div>
                        Showing {{ $volunteers->firstItem() }} to {{ $volunteers->lastItem() }} of
                        {{ $volunteers->total() }} entries
                    </div>
                </div>
            </div>
        </div>
        {{-- @if (session('volunteer'))
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
        @endif --}}

        <div class="collapse-1 p-2" id="viewDetails">
            <div class="row">
                <div class="col justify-content-start p-3">
                    <div class="row title">
                        <div class="col-3">
                            <span>Registration number</span>
                        </div>
                        <div class="col-4">
                            <span>Name</span>
                        </div>
                        <div class="col">
                            <span>Email</span>
                        </div>
                    </div>
                    <div class="row info">
                        <div class="col-3">
                            <input class="form-control" type="number" name="regno" id="regno" readonly>
                        </div>
                        <div class="col-4">
                            <input class="form-control" type="text" name="name" id="name" readonly>
                        </div>
                        <div class="col">
                            <input class="form-control" type="email" name="email" id="email" readonly>
                        </div>
                    </div>
                    <div class="row title">
                        <div class="col-3">
                            <span>Phone</span>
                        </div>
                        <div class="col-3">
                            <span>Course</span>
                        </div>
                        <div class="col-3">
                            <span>NSS Batch</span>
                        </div>
                        <div class="col-3">
                            <span>Drives Attended</span>
                        </div>
                    </div>
                    <div class="row info">
                        <div class="col-3">
                            <input class="form-control" type="number" name="phone" id="phone" readonly>
                        </div>
                        <div class="col-3">
                            <input class="form-control" type="text" name="course" id="course" readonly>
                        </div>
                        <div class="col-3">
                            <input class="form-control" type="text" name="batch" id="batch" readonly>
                        </div>
                        <div class="col-3">
                            <input class="form-control" type="number" name="attended" id="attended" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <button type="button" class="btn btn-success" data-toggle="modal"
                        data-target="#editDriveInfoDesktop"><i class="bi-pencil-fill" id="editBtn"></i>
                        Edit</button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"><i
                            class="bi-trash-fill"></i>
                        Delete</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        var regno = document.getElementById('regno');
            var name = document.getElementById('name');
            var email = document.getElementById('email');
            var phone = document.getElementById('phone');
            var course = document.getElementById('course');
            var batch = document.getElementById('batch');
            var attended = document.getElementById('attended');
        function showDetails(id, nameVal, emailVal, phoneVal, courseVal, batchVal, attendedVal) {
            regno.value = id;
            name.value = nameVal;
            email.value = emailVal;
            phone.value = phoneVal;
            course.value = courseVal;
            batch.value = batchVal;
            attended.value = attendedVal;

            var x = regno.value;
            alert(x);
        }

        document.getElementById('editBtn').addEventListener('click', function() {
            // var regno = document.getElementById('regno');
            // var name = document.getElementById('name');
            // var email = document.getElementById('email');
            // var phone = document.getElementById('phone');
            // var course = document.getElementById('course');
            // var batch = document.getElementById('batch');
            // var attended = document.getElementById('attended');
            alert();

            regno.readOnly = false;
            name.readOnly = false;
            email.readOnly = false;
            phone.readOnly = false;
            course.readOnly = false;
            batch.readOnly = false;
            attended.readOnly = false;
        });
    </script>
@endsection
