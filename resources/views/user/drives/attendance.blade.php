<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@extends('layouts/user-content')
@section('content')
    <div class="container-fluid p-0">
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
                            <button class="btn btn-success w-100" data-toggle="collapse"
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
                                        @if (session('attend'))
                                            @foreach (session('attend') as $at)
                                                <tr>
                                                    <td>{{ $at['id'] }}</td>
                                                    <td>{{ $at['name'] }}</td>
                                                    <td>{{ $at['course'] }}</td>
                                                    <td>{{ $at['batch'] }}</td>
                                                    <td>
                                                        <button class="btn btn-danger" data-toggle="modal"
                                                            data-target="#deleteModal{{ $at['id'] }}"><i
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
                    <form action="{{ url('drive/attendance/add/getName') }}" method="POST" id="getName">
                        @csrf
                        <div class="row">
                            <div class="col-9">
                                <input type="text" class="form-control" name="regno" id="regno">
                            </div>
                            <div class="col-2">
                                <input type="submit" class="btn btn-primary" value="Verify">
                            </div>
                        </div>
                    </form>
                    @foreach ($drive as $d)
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
                                                <label for="" class="form-label">Drive
                                                    Id</label>
                                                <input type="number" class="form-control" name="id"
                                                    value="{{ $d['id'] }}" disabled>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="" class="form-label">Drive
                                                    Title</label>
                                                <input type="text" class="form-control" name="title"
                                                    value="{{ $d['title'] }}" disabled>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="" class="form-label">Drive
                                                    Date</label>
                                                <input type="text" class="form-control" name="date"
                                                    value="{{ $d['date'] }}" disabled>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="" class="form-label">Registration no</label>
                                                {{-- <form action="{{ route('getName') }}" method="POST" id="getName">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-9">
                                                            <input type="text" class="form-control" name="regno" id="regno">
                                                        </div>
                                                        <div class="col-2">
                                                            <input type="submit" class="btn btn-primary" value="Verify">
                                                        </div>
                                                    </div>
                                                </form> --}}
                                            </div>
                                            {{-- @if (session('user'))
                                                <div class="form-group">
                                                    <label for="" class="form-label">Name</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $user[0]['name'] }}" readonly>
                                                </div>
                                            @else --}}
                                                <div class="form-group" id="name"></div>
                                                    {{-- <label for="" class="form-label">Name</label>
                                                    <input type="text" class="form-control" id="name"
                                                        readonly> --}}

                                            {{-- @endif --}}
                                        </div>
                                        <div class="modal-footer">
                                            <input type="button" class="btn btn-default" data-dismiss="modal"
                                                value="Cancel">
                                            <input type="button" class="btn btn-success" value="Add">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Attendance Add Modal end -->
                        <!-- Delete Modal start -->
                        <div id="deleteModal" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form>
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
                                            <input type="button" class="btn btn-default" data-dismiss="modal"
                                                value="Cancel">
                                            <input type="submit" class="btn btn-danger" value="Delete">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Delete Modal end -->
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#getName').on('submit', function(event){
                event.preventDefault();
                jQuery.ajax({
                    url: "{{ url('drive/attendance/add/getName') }}",
                    data: jQuery('#getName').serialize(),
                    type: 'post',

                    success:function(result){
                        $('#name').css('display','block');
                        jQuery('#name').html(result.name);
                        jQuery('#getName')[0].reset();
                    }

                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                        alert('Error: ' + error); // Display a simple alert message
                    }

                })
            });
        });
    </script>
@endsection
