@extends('layouts/user-content')
@section('content')
    <div class="container-fluid p-0">
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
        <h2 class="text-center fw-bold">Add Drive Attendance</h2>
        <div class="row">
            <div class="col-12 col-lg-12 col-xxl-9 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="mb-0 h4 text-center fw-bold">Today's Drive</h5>
                    </div>
                    @foreach ($drive as $d)
                        <div class="card-body">
                            <div class="row title">
                                <div class="col">Drive Id</div>
                                <div class="col">Drive Title</div>
                                <div class="col">Created by</div>
                            </div>
                            <div class="row info">
                                <div class="col">{{ $d['id'] }}</div>
                                <div class="col">{{ $d['title'] }}</div>
                                <div class="col">jhuma</div>
                            </div>
                            <div class="row title mt-2">
                                <div class="col">Time created</div>
                                <div class="col">Time</div>
                                <div class="col">Area</div>
                            </div>
                            <div class="row info">
                                <div class="col">{{ $d['created_at'] }}</div>
                                <div class="col">{{ $d['from'] }} - {{ $d['to'] }}</div>
                                <div class="col">{{ $d['area'] }}</div>
                            </div>
                        </div>
                    @endforeach

                    <div class="row mb-3 mt-3 d-flex justify-content-center">
                        <div class="col-lg-3 col-md-3 d-flex justify-content-center">
                            <button class="btn btn-success w-75" data-toggle="collapse"
                                data-target="#allAttendees{{ $d['id'] }}">View
                                All Attendees</button>
                        </div>
                    </div>
                    <div class="collapse p-2 allAttendees" id="allAttendees{{ $d['id'] }}">
                        <div class="col justify-content-start bg-light p-3">
                            <h4 class="text-center">Attendees</h4>
                            <div class="row">
                                <div class="col d-flex justify-content-end">
                                    <button class="btn btn-success" data-toggle="modal" data-target="#addAttendanceModal"><i
                                            class="bi-plus-circle"></i> Add</button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Reg.no</th>
                                            <th>Name</th>
                                            <th>Course</th>
                                            <th>Batch</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($attend))
                                            @foreach ($attend as $at)
                                                <tr>
                                                    <td>{{ $at['id'] }}</td>
                                                    <td>{{ $at['name'] }}</td>
                                                    <td>{{ $at['course'] }}</td>
                                                    <td>{{ $at['batch'] }}</td>
                                                    <td>
                                                        <button class="btn btn-danger" data-toggle="modal"
                                                            data-target="#deleteModal"
                                                            onclick=attDelete({{ $at['id'] }})><i
                                                                class="bi-trash"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5">
                                                    <div class="message text-center">
                                                        No results found
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @foreach ($drive as $d)
                        <!-- Attendance Add Modal start -->
                        <div id="addAttendanceModal" class="modal fade">
                            <div class="modal-dialog delete-modal-diaglog">
                                <div class="modal-content">
                                    <form action="{{ route('user.drive.add.attendance') }}" method="POST">
                                        @csrf
                                        <div class="modal-header">
                                            <h4 class="modal-title">Add Attendance</h4>
                                            <button type="button" class="btn-close" data-dismiss="modal"
                                                aria-hidden="true"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Drive
                                                    Id</label>
                                                <input type="number" class="form-control" name="id"
                                                    value="{{ $d['id'] }}" id="addAttDriveId" readonly>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="form-label">Drive
                                                    Title</label>
                                                <input type="text" class="form-control" name="title"
                                                    value="{{ $d['title'] }}" readonly>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="form-label">Drive
                                                    Date</label>
                                                <input type="text" class="form-control" name="date"
                                                    value="{{ $d['date'] }}" readonly>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="form-label">Registration no</label>
                                                <div class="row">
                                                    <div class="col-7">
                                                        <input type="text" class="form-control" name="regno"
                                                            id="fetchRegno">
                                                    </div>
                                                    <div class="col-3">
                                                        <button class="btn btn-primary"
                                                            onclick="getName()">Verify</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="form-label">Name</label>
                                                <input type="text" class="form-control" id="name" readonly>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="button" class="btn btn-default" data-dismiss="modal"
                                                value="Cancel">
                                            <input type="submit" class="btn btn-success" value="Add">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Attendance Add Modal end -->
                    @endforeach
                    <!-- Delete Modal start -->
                    <div id="deleteModal" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Delete Attendance</h4>
                                    <button type="button" class="btn-close" data-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete attendance for this
                                        volunteer?
                                    </p>
                                    <p class="text-danger f-5"><small>This action cannot be
                                            undone.</small></p>
                                </div>
                                <div class="modal-footer">
                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                    <form action="{{ route('user.attendance.delete') }}" method="POST">
                                        @csrf
                                        <input type="hidden" id="regnoInput" name="regno">
                                        <input type="submit" class="btn btn-danger" value="Delete">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Delete Modal end -->
                </div>
            </div>
        </div>
    </div>
    <script>
        function attDelete(regno) {
            document.getElementById('regnoInput').value = regno;
        }
    </script>
@endsection
