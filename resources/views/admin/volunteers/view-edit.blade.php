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
        <h2 class="text-center fw-bold">Search Volunteers</h2>
        <div class="row">
            <div class="col-xl-8 offset-xl-2 col-md-10 offset-md-2">
                <div class="row">
                    <div class="col-lg-10 col-md-10 col-xl-12">
                        <form action="{{ route('volunteer.search-details') }}" method="POST">
                            @csrf
                            <div class="card p-1">
                                <div class="card-body">
                                    <div class="row">
                                        <div
                                            class="col-lg-10 col-md-10 col-12 mx-lg-0 ps-xl-0 ps-xl-0 ps-lg-0 ps-md-0 pe-lg-2 pe-md-2">
                                            <input type="search" placeholder="Search by name or regno" class="form-control"
                                                name="search_string">
                                        </div>
                                        <div
                                            class="col-lg-2 col-md-2 col-12 d-flex justify-content-center mt-lg-0 mt-lg-0 mt-2 mt-md-0 pe-xl-0 ps-xl-0 pe-lg-0 pe-md-0 ps-lg-3 ps-md-3">
                                            <input type="submit" class="btn btn-primary w-100" value="Search">
                                        </div>
                                    </div>
                                    <div class="row">
                                        @if ($errors->has('search_string'))
                                            <div class="mt-2">
                                                <span class="text-danger">Student name or registration number required</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12 col-xl-12 d-flex">
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
                                    <tr style="display: none;" id="volunteerDetails">
                                        <td colspan="7">
                                            <div class="collapse p-2" id="viewDetails">
                                                <form action="{{ route('volunteer.update') }}" method="POST">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col justify-content-start p-3">
                                                            <div class="row title mb-2">
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
                                                                    <input class="form-control" type="number"
                                                                        name="regno" id="regno" readonly>
                                                                </div>
                                                                <div class="col-4">
                                                                    <input class="form-control" type="text"
                                                                        name="name" id="name" readonly>
                                                                </div>
                                                                <div class="col">
                                                                    <input class="form-control" type="email"
                                                                        name="email" id="email" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="row title mt-2">
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
                                                            <div class="row info mt-1">
                                                                <div class="col-3">
                                                                    <input class="form-control" type="number"
                                                                        name="phone" id="phone" readonly>
                                                                </div>
                                                                <div class="col-3">
                                                                    <select name="course" id="course"
                                                                        class="form-select" disabled>
                                                                        @foreach ($courses as $c)
                                                                            <option value="{{ $c['cid'] }}">
                                                                                {{ $c['cname'] }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-3">
                                                                    <input class="form-control" type="text"
                                                                        name="batch" id="batch" readonly>
                                                                </div>
                                                                <div class="col-3">
                                                                    <input class="form-control" type="number"
                                                                        name="attended" id="attended" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col">
                                                            <button type="button" class="btn btn-success"
                                                                onclick="editDetails()"><i class="bi-pencil-fill"
                                                                    id="editBtn"></i>
                                                                Edit</button>
                                                            <button type="submit" id="updateBtn" class="btn btn-primary"
                                                                style="display: none;">Update</button>
                                                            <button type="button" class="btn btn-danger"
                                                                data-toggle="modal" data-target="#deleteModal"
                                                                onclick="deleteVolunteer({{ $v['id'] }})"><i
                                                                    class="bi-trash-fill"></i>
                                                                Delete</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col px-4 mb-3">
                            Showing {{ $volunteers->firstItem() }} to {{ $volunteers->lastItem() }} of
                            {{ $volunteers->total() }} entries
                        </div>
                        <div class="col d-flex justify-content-end">
                            <span class="mx-2">{{ $volunteers->links() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="deleteModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Volunteer</h4>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this volunteer?
                    </p>
                    <p class="text-danger f-5"><small>This action cannot be
                            undone.</small></p>
                </div>
                <form action="{{ route('volunteer.delete') }}" method="POST">
                    @csrf
                    <input type="number" id="volunteer-regno" name="regno" hidden>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-danger" value="Delete">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        var regno = document.getElementById('regno');
        var volName = document.getElementById('name');
        var email = document.getElementById('email');
        var phone = document.getElementById('phone');
        var course = document.getElementById('course');
        var batch = document.getElementById('batch');
        var attended = document.getElementById('attended');

        function showDetails(id, nameVal, emailVal, phoneVal, courseVal, batchVal, attendedVal) {
            var x = document.getElementById('volunteerDetails');
            x.style.display = "table-row";
            regno.value = id;
            volName.value = nameVal;
            email.value = emailVal;
            phone.value = phoneVal;

            course.value = courseMapping(courseVal);

            batch.value = batchVal;
            attended.value = attendedVal;

        }

        function editDetails() {
            volName.readOnly = false;
            email.readOnly = false;
            phone.readOnly = false;
            course.disabled = false;
            batch.readOnly = false;

            document.getElementById('updateBtn').style.display = "table-row";
        }

        function courseMapping(cname) {
            var courseMapping = {
                "MCA": 0,
                "BCA": 1,
                "MBA": 2,
                "BBA": 3,
                "MSc Chemistry": 4,
                "BSc Chemistry": 5,
                "MSc Mathematics": 6,
                "BSc Mathematics": 7,
                "MSc Physics": 8,
                "BSc Physics": 9,
                "BTech CSE": 10,
                "BTech CE": 11,
                "BTech ME": 12,
                "BTech AI&DS": 13,
                "BTech IT": 14,
                "BTech EEE": 15,
                "BTech ECE": 16
            };

            return courseMapping[cname];
        }

        function deleteVolunteer(id) {
            document.getElementById('volunteer-regno').value = id;
        }
    </script>
@endsection
