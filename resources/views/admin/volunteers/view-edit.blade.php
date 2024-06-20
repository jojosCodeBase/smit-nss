@extends('layouts/admin-content')
@section('title', 'View Volunteers')
@section('breadcrumb', 'View Volunteers')
@section('content')
    @include('include/alerts')
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
                                                name="search_string" required>
                                        </div>
                                        <div
                                            class="col-lg-2 col-md-2 col-12 d-flex justify-content-center mt-lg-0 mt-lg-0 mt-2 mt-md-0 pe-xl-0 ps-xl-0 pe-lg-0 pe-md-0 ps-lg-3 ps-md-3">
                                            <input type="submit" class="btn btn-primary w-100" value="Search">
                                        </div>
                                    </div>
                                    <div class="row">
                                        @if ($errors->has('search_string'))
                                            <div class="mt-2">
                                                <span class="text-danger">Student name or registration number
                                                    required</span>
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
                    <div class="card-body">
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
                                            <td>{{ $v['regno'] }}</td>
                                            <td>{{ $v['name'] }}</td>
                                            <td>{{ $v['email'] }}</td>
                                            <td>{{ $v['phone'] }}</td>
                                            <td>{{ $v['course'] }}</td>
                                            <td>{{ $v['batch'] }}</td>
                                            <td>
                                                <a data-toggle="modal" data-target="#viewDetailsModal" class="collapse-a"
                                                    onclick="viewInfoModalInit({{ $v['id'] }})">View</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="p-2">
                            {{ $volunteers->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="viewDetailsModal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Volunteer Details</h4>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('volunteer.update') }}" method="POST">
                    <div class="modal-body">
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
                                        <input class="form-control" type="number" name="regno" id="regno" readonly>
                                    </div>
                                    <div class="col-4">
                                        <input class="form-control" type="text" name="name" id="name" readonly
                                            required>
                                    </div>
                                    <div class="col">
                                        <input class="form-control" type="email" name="email" id="email" readonly
                                            required>
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
                                        <input class="form-control" type="number" name="phone" id="phone" readonly
                                            required>
                                    </div>
                                    <div class="col-3">
                                        <select name="course" id="course" class="form-select" required disabled>
                                            @foreach ($courses as $c)
                                                <option value="{{ $c['id'] }}">
                                                    {{ $c['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <select name="batch" id="batch" class="form-select" required disabled>
                                            @foreach ($batches as $b)
                                                <option value="{{ $b['id'] }}">
                                                    {{ $b['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <input class="form-control" type="number" name="attended" id="attended" readonly>
                                    </div>
                                </div>

                                <div class="row title mt-2">
                                    <div class="col-3">
                                        <span>Gender</span>
                                    </div>
                                    <div class="col-3">
                                        <span>Date of birth</span>
                                    </div>
                                    <div class="col-3">
                                        <span>Category</span>
                                    </div>
                                    <div class="col-3">
                                        <span>Nationality</span>
                                    </div>
                                </div>
                                <div class="row info mt-1">
                                    <div class="col-3">
                                        <select name="gender" id="gender" class="form-select" required disabled>
                                            <option value="M">Male</option>
                                            <option value="F">Female</option>
                                            <option value="O">Others</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <input class="form-control" type="date" name="dob" id="dob"
                                            disabled required>
                                    </div>
                                    <div class="col-3">
                                        <select name="category" id="category" class="form-select" required disabled>
                                            <option value="GENERAL">General</option>
                                            <option value="OBC">OBC</option>
                                            <option value="ST">ST</option>
                                            <option value="SC">SC</option>
                                            <option value="Minority">Minority</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <select name="nationality" id="nationality" class="form-select" required
                                            disabled>
                                            <option value="I">Indian</option>
                                            <option value="NI">Non-Indian</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row title mt-2">
                                    <div class="col-3">
                                        <span>Document number</span>
                                    </div>
                                </div>

                                <div class="row info mt-1">
                                    <div class="col-3">
                                        <input class="form-control" type="number" name="document_number"
                                            id="document_number" required disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" onclick="editDetails()"><i class="bi-pencil-fill"
                                id="editBtn"></i>
                            Edit</button>
                        <button type="submit" id="updateBtn" class="btn btn-primary"
                            style="display: none;">Update</button>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"
                            onclick="deleteVolunteer()"><i class="bi-trash-fill"></i>
                            Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('volunteer.delete') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        @method('delete')
                        <div class="form-row mb-2">
                            <div class="col">
                                <div class="d-flex justify-content-center">
                                    <i class="rounded-circle bi bi-exclamation-triangle-fill text-warning"
                                        style="font-size: 50px;"></i>
                                </div>
                                <h4 class="text-center text-dark">Delete Volunteer Details</h6>
                                    <p class="text-danger text-center">Are you sure you want to delete this volunteer ?
                                        This
                                        action cannot be undone.</p>
                                    <input type="number" id="volunteer-regno" name="regno" hidden>
                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-secondary w-25 me-5"
                                            data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger w-25">Yes, delete !</button>
                                    </div>
                            </div>
                        </div>
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
        var gender = document.getElementById('gender');
        var nationality = document.getElementById('nationality');
        var dob = document.getElementById('dob');
        var category = document.getElementById('category');
        var document_number = document.getElementById('document_number');

        function editDetails() {
            volName.readOnly = false;
            email.readOnly = false;
            phone.readOnly = false;
            course.disabled = false;
            batch.disabled = false;
            batch.disabled = false;
            gender.disabled = false;
            nationality.disabled = false;
            dob.disabled = false;
            category.disabled = false;
            document_number.disabled = false;

            document.getElementById('updateBtn').style.display = "table-row";
        }
    </script>
@endsection
@section('scripts')
    <script>
        $('#search_string').on('input', function() {
            var searchString = $('#search_string').val();
            $.ajax({
                url: '/admin/volunteer/manage/search-details/' + searchString,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('#tableFilter').html(response);
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX request failed: ', status, error);
                }
            });
        });
    </script>
@endsection
