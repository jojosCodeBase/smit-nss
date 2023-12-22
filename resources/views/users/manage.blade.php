@extends('layouts/content')
@section('content')
    <div class="container-fluid">
        <div class="row user-role">
            <div class="col-lg-3 col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 d-flex justify-content-center">
                                <img src="{{ asset('assets/img/icons/admin-icon.png') }}" width="70" height="70" alt="user-image">
                            </div>
                            <div class="col card-info">
                                <div class="name mb-1">
                                    <span>Jhuma Sunuwar</span>
                                </div>
                                <div class="role mb-1">
                                    <span>Admin</span>
                                </div>
                                <div class="badge bg-success">
                                    <span<i class="bi-person-fill-check"></i> Active</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 d-flex justify-content-center">
                                <img src="{{ asset('assets/img/icons/user-icon.png') }}" width="70" height="70" alt="user-image">
                            </div>
                            <div class="col card-info">
                                <div class="name mb-1">
                                    <span>Kunsang Moktan</span>
                                </div>
                                <div class="role mb-1">
                                    <span>Moderator</span>
                                </div>
                                <div class="badge bg-success">
                                    <span<i class="bi-person-fill-check"></i> Active</span>
                                </div>
                            </div>
                            <div class="col-1 d-flex justify-content-end">
                                <i class="bi-three-dots-vertical fs-4" data-bs-toggle="dropdown"></i>
                                <ul class="dropdown-menu dropdown-menu-light text-small shadow">
                                    <li><button class="dropdown-item" data-toggle="modal"
                                            data-target="#changePasswordModal1">Change
                                            Password</button></li>
                                    <li><button class="dropdown-item">Mark as In-active</button></li>
                                    <li><button class="dropdown-item" data-toggle="modal"
                                            data-target="#profileModal1">Profile</button></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><button class="dropdown-item" data-toggle="modal"
                                            data-target="#deleteModal1">Delete</button></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 d-flex justify-content-center">
                                <img src="{{ asset('assets/img/icons/user-icon.png') }}" width="70" height="70" alt="user-image">
                            </div>
                            <div class="col card-info">
                                <div class="name mb-1">
                                    <span>Sujal Adhikari</span>
                                </div>
                                <div class="role mb-1">
                                    <span>Moderator</span>
                                </div>
                                <div class="badge bg-success">
                                    <span<i class="bi-person-fill-check"></i> Active</span>
                                </div>
                            </div>
                            <div class="col-1 d-flex justify-content-end">
                                <i class="bi-three-dots-vertical fs-4" data-bs-toggle="dropdown"></i>
                                <ul class="dropdown-menu dropdown-menu-light text-small shadow">
                                    <li><button class="dropdown-item" data-toggle="modal"
                                            data-target="#changePasswordModal1">Change
                                            Password</button></li>
                                    <li><button class="dropdown-item">Mark as In-active</button></li>
                                    <li><button class="dropdown-item" data-toggle="modal"
                                            data-target="#profileModal1">Profile</button></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><button class="dropdown-item" data-toggle="modal"
                                            data-target="#deleteModal1">Delete</button></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 d-flex justify-content-center">
                                <img src="{{ asset('assets/img/icons/user-icon.png') }}" width="70" height="70" alt="user-image">
                            </div>
                            <div class="col card-info">
                                <div class="name mb-1">
                                    <span>Moyuk Rudra</span>
                                </div>
                                <div class="role mb-1">
                                    <span>Moderator</span>
                                </div>
                                <div class="badge bg-danger">
                                    <span<i class="bi-person-slash"></i> In-Active</span>
                                </div>
                            </div>
                            <div class="col-1 d-flex justify-content-end">
                                <i class="bi-three-dots-vertical fs-4" data-bs-toggle="dropdown"></i>
                                <ul class="dropdown-menu dropdown-menu-light text-small shadow">
                                    <li><button class="dropdown-item" data-toggle="modal"
                                            data-target="#changePasswordModal1">Change
                                            Password</button></li>
                                    <li><button class="dropdown-item">Mark as Active</button></li>
                                    <li><button class="dropdown-item" data-toggle="modal"
                                            data-target="#profileModal1">Profile</button></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><button class="dropdown-item" data-toggle="modal"
                                            data-target="#deleteModal1">Delete</button></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
