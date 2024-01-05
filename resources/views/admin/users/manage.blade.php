@extends('layouts/admin-content')
@section('content')
    <div class="container-fluid">
        <div class="row user-role">
            @foreach ($users as $u)
                <div class="col-lg-3 col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                @php
                                    // fetching role from server and converting it in the frontend
                                    if ($u['role'] == 1) {
                                        $role = 'Admin';
                                        $imageUrl = 'assets/img/icons/admin-icon.png';
                                    } else {
                                        $role = 'Moderator';
                                        $imageUrl = 'assets/img/icons/user-icon.png';
                                    }
                                @endphp
                                <div class="col-4 d-flex justify-content-center">
                                    <img src="{{ asset($imageUrl) }}" width="70" height="70"
                                        alt="user-image">
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
                </div>
            @endforeach
            <div class="col-lg-3 col-md-3">
                <a href="">
                    <div class="card">
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
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
