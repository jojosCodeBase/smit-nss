@extends('layouts/admin-content')
@section('title', 'Manage Users')
@section('breadcrumb', 'Manage Users')
@section('content')
    <div class="container-fluid">

        @include('include/alerts')

        <div class="row user-role">
            @foreach ($users as $u)
                <div class="col-lg-3 col-md-3">
                    @if ($u->role === 2)
                        <a href="{{ route('moderator-details', ['id' => $u->id]) }}">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        @php
                                            if ($u['role'] == 1) {
                                                $role = 'Admin';
                                                $imageUrl = 'assets/img/icons/admin-icon.png';
                                            } else {
                                                $role = 'Moderator';
                                                $imageUrl = 'assets/img/icons/user-icon.png';
                                            }
                                        @endphp
                                        <div class="col-4 d-flex justify-content-center">
                                            <img src="{{ asset($imageUrl) }}" width="70" height="70" alt="user-image">
                                        </div>
                                        <div class="col card-info">
                                            <div class="name mb-1">
                                                <span>{{ $u['name'] }}</span>
                                            </div>
                                            <div class="role mb-1">
                                                <span>{{ $role }}</span>
                                            </div>
                                            @if ($u['status'] == 1)
                                                <div class="badge bg-success">
                                                    <span><i class="bi-person-fill-check"></i> Active</span>
                                                </div>
                                            @else
                                                <div class="badge bg-danger">
                                                    <span><i class="bi-person-fill-check"></i> In-active</span>
                                                </div>
                                            @endif
                                            <div class="role mt-2">
                                                @if (!is_null($u->batch))
                                                    <span>Batch: {{ $u->batch->name }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @else
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    @php
                                        if ($u['role'] == 1) {
                                            $role = 'Admin';
                                            $imageUrl = 'assets/img/icons/admin-icon.png';
                                        } else {
                                            $role = 'Moderator';
                                            $imageUrl = 'assets/img/icons/user-icon.png';
                                        }
                                    @endphp
                                    <div class="col-4 d-flex justify-content-center">
                                        <img src="{{ asset($imageUrl) }}" width="70" height="70" alt="user-image">
                                    </div>
                                    <div class="col card-info">
                                        <div class="name mb-1">
                                            <span>{{ $u['name'] }}</span>
                                        </div>
                                        <div class="role mb-1">
                                            <span>{{ $role }}</span>
                                        </div>
                                        @if ($u['status'] == 1)
                                            <div class="badge bg-success">
                                                <span><i class="bi-person-fill-check"></i> Active</span>
                                            </div>
                                        @else
                                            <div class="badge bg-danger">
                                                <span><i class="bi-person-fill-check"></i> In-active</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
            {{-- @if ($moderatorCount < 2) --}}
            <div class="col-lg-3 col-md-3">
                <div class="card">
                    <button data-target="#addModeratorModal" data-toggle="modal" class="btn">
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="card-image">
                                    <img src="https://cdn3.iconfinder.com/data/icons/line/36/add-512.png" width="70"
                                        height="70" alt="user-image">
                                </div>
                                <div class="card-text mt-3">
                                    <h5>Add Moderator</h5>
                                </div>
                            </div>
                        </div>
                    </button>
                </div>
            </div>
            {{-- moderator add modal start --}}
            <div id="addModeratorModal" class="modal fade">
                <div class="modal-dialog delete-modal-diaglog">
                    <div class="modal-content">
                        <form action="{{ route('add-moderator') }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div class="modal-header">
                                <h4 class="modal-title">Add Moderator</h4>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-hidden="true"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label class="form-label">Registration no</label>
                                    <div class="row">
                                        <div class="col-9">
                                            <input type="text" class="form-control" name="regno" id="regno"
                                                required>
                                            <div class="invalid-feedback">
                                                Please enter a valid reg. No.
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <button type="button" class="btn btn-primary w-100"
                                                id="getNameByRegnoBtn">Verify</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" id="response-volunteer-name" name="name"
                                        readonly required>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Username</label>
                                    <input type="text" class="form-control" id="response-volunteer-email" value=""
                                        name="email" readonly required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="text" class="form-control" value="Smitnss@1234" name="password" readonly
                                        required>
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
            {{-- moderator add modal end --}}
            {{-- @endif --}}
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        // Button click handler for getting volunteer info
        $('#getNameByRegnoBtn').on('click', function() {
            $.ajax({
                url: '/volunteer/getInfo/' + $('#regno').val(),
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('#response-volunteer-name').val(response.name);
                    $('#response-volunteer-email').val(response.email);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX request failed: ', status, error);
                    alert(xhr.status === 404 ? 'Volunteer not found' : 'An error occurred: ' + error);
                }
            });
        });
    </script>
@endsection
