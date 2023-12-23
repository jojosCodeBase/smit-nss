@extends('layouts/admin-content')
@section('content')
    <div class="container-fluid">
        <div class="row user-role">
            <div class="col-lg-3 col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 d-flex justify-content-center">
                                <img src="{{ asset('assets/img/icons/admin-icon.png') }}" width="70" height="70"
                                    alt="user-image">
                            </div>
                            @php
                                // fetching role from server and converting it in the frontend
                                if (Auth::user()->role == 1) {
                                    $role = 'Admin';
                                } else {
                                    $role = 'Moderator';
                                }

                                // fetching status from server and converting it in the frontend
                                // if (Auth::user()->status == 1)
                                //     $status = "Active";
                                // else
                                //     $status = "In-active";

                            @endphp
                            <div class="col card-info">
                                <div class="name mb-1">
                                    <span>{{ Auth::user()->name }}</span>
                                </div>
                                <div class="role mb-1">
                                    <span>{{ $role }}</span>
                                </div>
                                @if (Auth::user()->status == 1)
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
            </div>
        </div>
    </div>
@endsection
