@extends('layouts/admin-content')
@section('content')
    <div class="container-fluid p-0">
        <h2 class="text-center fw-bold">NSS Drives Attendance</h2>
        <div class="row">
            <div class="col-xl-12 col-xxl-5 d-flex">
                <div class="w-100">
                    <div class="row d-flex justify-content-center">
                        <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                            <div class="card p-1">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-10 col-9 mx-lg-0 ps-xl-0 ps-xl-0 ps-0 pe-2">
                                            <input type="search" placeholder="Search by drive title" class="form-control"
                                                name="search_string">
                                        </div>
                                        <div
                                            class="col-lg- col-2 d-flex justify-content-center mt-lg-0 pe-xl-0 ps-xl-0 pe-0 ps-3">
                                            <input type="submit" class="btn btn-primary" value="Search">
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sl.no</th>
                                    <th>Title</th>
                                    <th>Updated by</th>
                                    <th>Area</th>
                                    <th>Date</th>
                                    <th>Present</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($drives as $d)
                                    @php
                                        $slno = $loop->iteration;
                                    @endphp
                                    <tr>
                                        <td class="text-center">{{ $slno }}</td>
                                        <td>{{ $d['title'] }}</td>
                                        <td>{{ $d['attendanceBy'] }}</td>
                                        <td>{{ $d['area'] }}</td>
                                        <td>{{ $d['date'] }}</td>
                                        <td>{{ $d['present'] }}</td>
                                        <td>
                                            <a data-toggle="collapse" data-target="#collapseItemDesktop1"
                                                class="toggleBtnDesktop collapse-a" id="collapseToggleBtnDesktop"
                                                onclick="changeToggleDesktop()">View</a>
                                            <a data-toggle="collapse" data-target="#collapseItemMobile1"
                                                class="toggleBtnMobile collapse-a" id="collapseToggleBtnMobile"
                                                onclick="changeToggleMobile()">View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="8">
                                            <div class="collapse p-2 collapseItemDesktop" id="collapseItemDesktop1">
                                                <div class="col justify-content-start bg-light p-3">
                                                    <div class="row title">
                                                        <div class="col-2">
                                                            <span>Drive Id</span>
                                                        </div>
                                                        <div class="col-2">
                                                            <span>Time</span>
                                                        </div>
                                                        <div class="col-4">
                                                            <span>Drive Conducted by</span>
                                                        </div>
                                                        <div class="col-2">
                                                            <span>Drive Type</span>
                                                        </div>
                                                        <div class="col-2">
                                                            <span>Total Volunteers</span>
                                                        </div>
                                                    </div>
                                                    <div class="row info">
                                                        <div class="col-2">
                                                            <span>{{ $d['id'] }}</span>
                                                        </div>
                                                        <div class="col-2">
                                                            <span>{{ $d['from'] }} - {{ $d['to'] }}</span>
                                                        </div>
                                                        <div class="col-4"><span>{{ $d['conductedBy'] }}</span></div>
                                                        <div class="col-2"><span>{{ $d['type'] }}</span></div>
                                                        <div class="col-2"><span>{{ $d['present'] }}</span></div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col d-flex justify-content-center">
                                                            <button class="btn btn-success" data-toggle="collapse"
                                                                data-target="#allAttendees">Show
                                                                All Attendees</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="collapse p-2 collapseItemMobile" id="collapseItemMobile1">
                                                <div class="col justify-content-start bg-light p-3">
                                                    <h4 class="text-center">Drive Info</h4>
                                                    <div class="row mb-2">
                                                        <div class="col">
                                                            <div class="title">Drive Id</div>
                                                            <div class="info">006</div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="title">Drive Date</div>
                                                            <div class="info">23-10-2023</div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col">
                                                            <div class="title">Time</div>
                                                            <span>10:00 AM - 01:00 PM</span>
                                                        </div>

                                                        <div class="col">
                                                            <div class="title">Drive Title</div>
                                                            <div class="info">IBM, Rangpo, Flood Relief</div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col">
                                                            <div class="title">Drive Area</div>
                                                            <div class="info">IBM, Rangpo, East Sikkim, Sikkim</div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="title">Conducted by</div>
                                                            <div class="info">Miss Jhuma Sunuwar, Dr. S
                                                                Visalakshi</div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col">
                                                            <div class="title">Drive Type</div>
                                                            <div class="info">Regular NSS Activities</div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="title">Total Volunteers</div>
                                                            <div class="info">20</div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col">
                                                            <div class="title">Description</div>
                                                            <div class="info">
                                                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                                                Porro
                                                                pariatur maxime ut suscipit aliquid quisquam.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3 mt-3">
                                                        <div class="col">
                                                            <button class="btn btn-success w-100" data-toggle="collapse"
                                                                data-target="#allAttendees">View All Attendees</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="collapse p-2 allAttendees" id="allAttendees">
                                                <div class="col justify-content-start bg-light p-3">
                                                    <h4 class="text-center">Attendees</h4>
                                                    <div class="row">
                                                        <div class="col d-flex justify-content-end">
                                                            <button class="btn btn-success" data-toggle="modal"
                                                                data-target="#addAttendanceModal"><i
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
                                                                @foreach($volunteers as $v)
                                                                    <tr>
                                                                        <td>{{ $v['id'] }}</td>
                                                                        <td>{{ $v['name'] }}</td>
                                                                        <td>{{ $v['course'] }}</td>
                                                                        <td>{{ $v['batch'] }}</td>
                                                                        <td>
                                                                            <button class="btn btn-danger" data-toggle="modal"
                                                                                data-target="#deleteModal1"><i
                                                                                    class="bi-trash"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Attendance Add Modal start -->
    <div id="addAttendanceModal" class="modal fade">
        <div class="modal-dialog delete-modal-diaglog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Add Attendance</h4>
                        <button type="button" class="btn-close" data-dismiss="modal"
                            aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="" class="form-label">Drive Id</label>
                            <input type="number" class="form-control" name="id"
                                value="006" disabled>
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="form-label">Drive Title</label>
                            <input type="text" class="form-control" name="title"
                                value="IBM, Rangpo, Flood Relief" disabled>
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="form-label">Drive Date</label>
                            <input type="text" class="form-control" name="date"
                                value="25-10-2023" disabled>
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="form-label">Registration
                                no</label>
                            <input type="text" class="form-control" name="regno">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Name</label>
                            <input type="text" class="form-control" name="regno">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default"
                            data-dismiss="modal" value="Cancel">
                        <input type="button" class="btn btn-success" value="Add"
                            onclick="sweetAlert()">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Attendance Add Modal end -->

    <!-- Delete Modal start -->
    <div id="deleteModal1" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Attendance</h4>
                        <button type="button" class="btn-close" data-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete attendance for this volunteer?
                        </p>
                        <p class="text-danger f-5"><small>This action cannot be
                                undone.</small></p>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default"
                            data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-danger" value="Delete">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Delete Modal end -->
@endsection
