@extends('layouts/admin-content')
@section('title', 'Drive Attendance')
@section('breadcrumb', 'Drive Attendance')
@section('content')
    <div class="container-fluid p-0">
        @include('include/alerts')
        <div class="row">
            <div class="col-12 col-lg-12 col-xl-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="mb-0 h4 text-center fw-bold">Drive Details</h5>
                    </div>
                    <div class="p-2">
                        <div class="col justify-content-start p-3">
                            <div class="row">
                                <div class="col-xl-3 col-lg-1 col-12 mb-3">
                                    <label class="form-label title">Drive Id</label>
                                    <div>{{ $drive->id }}</div>
                                </div>
                                <div class="col-xl-3 col-lg-1 col-12 mb-3">
                                    <label class="form-label title">Drive Title</label>
                                    <div>{{ $drive->title }}</div>
                                </div>
                                <div class="col-xl-3 col-lg-1 col-12 mb-3">
                                    <label class="form-label title">Time</label>
                                    <div>{{ $drive->from }} - {{ $drive['to'] }}</div>
                                </div>
                                <div class="col-xl-3 col-lg-1 col-12 mb-3">
                                    <label class="form-label title">Conducted by</label>
                                    <div>{{ $drive['conductedBy'] }}</div>
                                </div>
                                <div class="col-xl-3 col-lg-1 col-12 mb-3">
                                    <label class="form-label title">Drive Type</label>
                                    <div>{{ $drive['type'] }}</div>
                                </div>
                                <div class="col-xl-3 col-lg-1 col-12 mb-3">
                                    <label class="form-label title">Drive Area</label>
                                    <div>{{ $drive['area'] }}</div>
                                </div>
                                <div class="col-xl-3 col-lg-1 col-12 mb-3">
                                    <label class="form-label title">Volunteers Present</label>
                                    <div>{{ $drive['present'] }}</div>
                                </div>
                                <div class="col-xl-3 col-lg-1 col-12 mb-3">
                                    <label class="form-label title">Description</label>
                                    <div>{{ $drive['description'] }}</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <button type="button" class="btn btn-success edit-drive" data-toggle="modal"
                                        data-target="#editDriveInfoDesktop"
                                        data-drive-id="{{ $drive->id }}">Edit</button>
                                    <button type="button" class="btn btn-danger delete-drive" data-toggle="modal"
                                        data-target="#editDriveInfoDesktop">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-12 col-xl-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="mb-0 h4 text-center fw-bold">Volunteers Present</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-end">
                            {{-- <input type="search" class="form-control" placeholder="Search by regno or name"> --}}
                            <div class="search-container">
                                <div class="search-wrapper">
                                    <button id="toggle-button" class="search-button">
                                        <span class="button-text"><i class="bi bi-search"></i></span>
                                        <input type="text" id="search-input" class="search-input"
                                            placeholder="Type to search...">
                                    </button>
                                </div>
                            </div>
                            <div class="ms-3 mt-1">
                                <button type="button" class="btn btn-info" data-toggle="modal"
                                    data-target="#addAttendanceModal">Add <i class="bi bi-person-plus-fill"></i></button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <th>Sl.no</th>
                                    <th>Regno</th>
                                    <th>Name</th>
                                    <th>Course</th>
                                    <th>Batch</th>
                                </thead>
                                <tbody>
                                    @foreach ($attendees as $attendee)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $attendee->volunteer->regno }}</td>
                                            <td>{{ $attendee->volunteer->name }}</td>
                                            <td>{{ $attendee->volunteer->courses->name }}</td>
                                            <td>{{ $attendee->volunteer->batches->name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- drive edit modal --}}
    <div class="modal fade" id="editDriveInfoDesktop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Drive Info</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('drive.updateDetails') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label">Drive Id</label>
                                    <input type="number" name="id" id="drive-id" class="form-control" value=""
                                        readonly>
                                </div>
                                <div class="col">
                                    <label class="form-label">Drive Date</label>
                                    <input type="text" name="date" id="drive-date" class="form-control" value=""
                                        required>
                                </div>
                                <div class="col">
                                    <label class="form-label">From</label>
                                    <input type="time" class="form-control" id="drive-from" name="from"
                                        value="" required>
                                </div>
                                <div class="col">
                                    <label class="form-label">To</label>
                                    <input type="time" class="form-control" name="to" id="drive-to"
                                        value="" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label">Drive Title</label>
                                    <input type="text" class="form-control" value="" name="title"
                                        id="drive-title" required>
                                </div>
                                <div class="col">
                                    <label class="form-label">Drive Area</label>
                                    <input type="text" class="form-control" name="area" value=""
                                        id="drive-area" required>
                                </div>
                                <div class="col">
                                    <label class="form-label">Conducted by</label>
                                    <input type="text" class="form-control" name="conductedBy"
                                        id="drive-conducted-by" value="" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4">
                                    <label class="form-label">Drive Type</label>
                                    <input type="text" class="form-control" name="driveType" id="drive-type"
                                        value="" required>
                                </div>
                                <div class="col-4">
                                    <label class="form-label">Total Volunteers</label>
                                    <input type="text" class="form-control" name="present" id="drive-attended-by"
                                        value="" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" cols="30" rows="5" class="form-control" id="drive-description" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- add attendance modal --}}
    <div id="addAttendanceModal" class="modal fade">
        <div class="modal-dialog delete-modal-diaglog">
            <div class="modal-content">
                <form action="{{ route('drive.add-attendance') }}" method="POST">
                    @csrf
                    <input type="text" name="drive_id" value="{{ $drive->id }}" hidden>
                    <div class="modal-header">
                        <h4 class="modal-title">Add Attendance</h4>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label class="form-label">Registration no</label>
                            <div class="row">
                                <div class="col-9">
                                    <input type="text" class="form-control" name="regno" id="regno" required>
                                </div>
                                <div class="col-3">
                                    <button type="button" class="btn btn-primary w-100"
                                        id="getNameByRegnoBtn">Verify</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Volunteer Name</label>
                            <input type="text" class="form-control" id="response-volunteer-name" name="name"
                                readonly required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <button type="submit" class="btn btn-success" id="addModeratorBtn">ADD</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('.edit-drive').on('click', function() {
            $.ajax({
                url: '/admin/drive/getInfo/' + $(this).data('drive-id'),
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    var driveInfo = response;
                    $('#drive-id').val(driveInfo.id);
                    $('#drive-date').val(driveInfo.date);
                    $('#drive-from').val(driveInfo.from);
                    $('#drive-to').val(driveInfo.to);
                    $('#drive-type').val(driveInfo.type);
                    $('#drive-title').val(driveInfo.title);
                    $('#drive-area').val(driveInfo.area);
                    $('#drive-conducted-by').val(driveInfo.conductedBy);
                    $('#drive-attended-by').val(driveInfo.present);
                    $('#drive-description').val(driveInfo.description);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX request failed: ', status, error);
                }
            });
        });
    </script>
@endsection
