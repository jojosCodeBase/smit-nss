@extends('layouts/admin-content')
@section('breadcrumb', 'Drive Attendance')
@section('content')
    <div class="container-fluid p-0">
        @include('include/alerts')
        <h2 class="text-center fw-bold">NSS Drives Attendance</h2>
        <div class="row">
            <div class="col-xl-8 offset-xl-2 col-md-10 offset-md-2">
                <div class="row">
                    <div class="col-lg-10 col-md-10 col-xl-12">
                        <form action="{{ route('drive.search') }}" method="POST">
                            @csrf
                            <div class="card p-1">
                                <div class="card-body">
                                    <div class="row">
                                        <div
                                            class="col-lg-10 col-md-10 col-12 mx-lg-0 ps-xl-0 ps-xl-0 ps-lg-0 ps-md-0 pe-lg-2 pe-md-2">
                                            <input type="search" placeholder="Search by drive title" class="form-control"
                                                name="search_string" required>
                                        </div>
                                        <div
                                            class="col-lg-2 col-md-2 col-12 d-flex justify-content-center mt-lg-0 mt-lg-0 mt-2 mt-md-0 pe-xl-0 ps-xl-0 pe-lg-0 pe-md-0 ps-lg-3 ps-md-3">
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
        <div class="row">
            <div class="col-12 col-lg-12 col-xl-12 d-flex">
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
                                        {{-- <td>{{ $d['attendanceBy'] }}</td> --}}
                                        <td>{{ $d['area'] }}</td>
                                        <td>{{ $d['date'] }}</td>
                                        <td>{{ $d['present'] }}</td>
                                        <td>
                                            <a data-toggle="collapse" data-target="#collapseItemDesktop{{ $d['id'] }}"
                                                class="toggleBtnDesktop collapse-a" id="collapseToggleBtnDesktop"
                                                onclick="changeToggleDesktop()">View</a>
                                            <a data-toggle="collapse" data-target="#collapseItemMobile1"
                                                class="toggleBtnMobile collapse-a" id="collapseToggleBtnMobile"
                                                onclick="changeToggleMobile()">View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="8">
                                            <div class="collapse p-2 collapseItemDesktop"
                                                id="collapseItemDesktop{{ $d['id'] }}">
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
                                                                data-target="#allAttendees{{ $d['id'] }}"
                                                                onclick="getAttendees({{ $d['id'] }})">Show
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
                                            <div class="collapse p-2 allAttendees" id="allAttendees{{ $d['id'] }}">
                                                <div class="col justify-content-start bg-light p-3">
                                                    <h4 class="text-center">Attendees</h4>
                                                    <div class="row">
                                                        <div class="col d-flex justify-content-end">
                                                            <button class="btn btn-success" data-toggle="modal"
                                                                data-target="#addAttendanceModal"
                                                                onclick="addAttendance({{ $d['id'] }}, {{ json_encode($d['date']) }}, {{ json_encode($d['title']) }})"><i
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
                                                            <tbody id="attendees-table-body{{ $d['id'] }}">
                                                                <tr style="display: none;" id="noRecordFound">
                                                                    <td colspan="5" class="text-center">No results
                                                                        found</td>
                                                                </tr>
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
                <form action="{{ route('drive.attendance.add') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Add Attendance</h4>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label class="form-label">Drive Id</label>
                            <input type="number" class="form-control" name="id" id="driveId" readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Drive Title</label>
                            <input type="text" class="form-control" name="title" id="driveTitle" readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Drive Date</label>
                            <input type="text" class="form-control" name="date" id="driveDate" readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Registration no</label>
                            <div class="row">
                                <div class="col-7">
                                    <input type="text" class="form-control" name="regno" id="fetchRegno">
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-primary" onclick="getName()">Verify</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-success" value="Add">
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
                <div class="modal-header">
                    <h4 class="modal-title">Delete Attendance</h4>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete attendance for this volunteer?
                    </p>
                    <p class="text-danger f-5"><small>This action cannot be
                        undone.</small></p>
                    </div>
                <form action="{{route('drive.attendance.delete')}}" method="POST">
                    @csrf
                    <input type="number" id="attendanceDeleteRegno" name="regno" hidden>
                    <input type="number" id="attendanceDeleteDriveId" name="driveId" hidden>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-danger" value="Delete">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Delete Modal end -->

    <script>
        function getAttendees(driveId) {
            event.preventDefault();
            jQuery.ajax({
                url: '/admin/drive/attendance/' + driveId,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response);

                    var tableBody = document.getElementById('attendees-table-body' + driveId);
                    tableBody.innerHTML = '';

                    if (response && response.length > 0) {
                        response.forEach(function(attendee) {
                            var row = '<tr>' +
                                '<td>' + attendee.id + '</td>' +
                                '<td>' + attendee.name + '</td>' +
                                '<td>' + attendee.course + '</td>' +
                                '<td>' + attendee.batch + '</td>' +
                                '<td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal1" onclick="initRegno(' + attendee.id + ',' + driveId + ')"><i class="bi-trash"></i></button></td>' +
                                '</tr>';
                            tableBody.innerHTML += row;
                        });
                    } else {
                        document.getElementById('noRecordFound').style.display = 'table-row';
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX request failed: ', status, error);
                }
            });
        }

        function addAttendance(driveId, driveDate, driveTitle) {
            document.getElementById('driveId').value = driveId;
            document.getElementById('driveTitle').value = driveTitle;

            // formatting drive date from yyyy-mm-dd to dd-mm-yyyy
            var parts = driveDate.split('-');
            var formattedDateArray = [parts[2], parts[1], parts[0]];

            var formattedDate = formattedDateArray.join('-');

            document.getElementById('driveDate').value = formattedDate;
        }

        function getName() {
            var regno = document.getElementById('fetchRegno').value;
            event.preventDefault();
            jQuery.ajax({
                url: '/admin/drive/attendance/add/' + regno, // if your url is using prefix enter url with prefix
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response && response.name) {
                        document.getElementById('name').value = response.name;
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX request failed: ', status, error);
                }
            });
        }

        function initRegno(id, driveId){
            // alert(driveId);
            document.getElementById('attendanceDeleteRegno').value = id;
            document.getElementById('attendanceDeleteDriveId').value = driveId;
        }
    </script>
@endsection
