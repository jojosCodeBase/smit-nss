@extends('layouts/content')
@section('content')
    <div class="breadcrumb-bar mb-3 px-4">
        <span class="breadcrumb-item">Home</span>
        <span class="breadcrumb-item">Users</span>
        <span class="breadcrumb-item active">Manage</span>
    </div>

    <div class="container">
        <div class="row">
            <div class="col">
                <h3 class="text-primary mb-3">User Management</h3>
            </div>
            <div class="col-2">
                <button class="btn add-user-btn">Add User <i class="bi-person-plus fs-5"></i></button>
            </div>
        </div>
        <div class="row user-role">
            <div class="col-lg-3 p-3 card">
                <div class="row">
                    <div class="col-4 d-flex justify-content-center">
                        <img src="{{ asset('assets/images/admin-icon.png') }}" width="70" height="70"
                            alt="user-image">
                    </div>
                    <div class="col">
                        <div class="name mb-1">
                            <span class="title">Jhuma Sunuwar</span>
                        </div>
                        <div class="role mb-1">
                            <h6>ADMIN</h6>
                        </div>
                        <div class="status-active">
                            <span><i class="bi-person-fill-check"></i> Active</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 p-3 card">
                <div class="row">
                    <div class="col-4 d-flex justify-content-center">
                        <img src="{{ asset('assets/images/user-icon.png') }}" width="70" height="70"
                            alt="user-image">
                    </div>
                    <div class="col">
                        <div class="name mb-1">
                            <span class="title">Kunsang Moktan</span>
                        </div>
                        <div class="role mb-1">
                            <h6>Moderator</h6>
                        </div>
                        <div class="status-active">
                            <span><i class="bi-person-fill-check"></i> Active</span>
                        </div>
                    </div>
                    <div class="col-1 d-flex justify-content-end">
                        <i class="bi-three-dots-vertical fs-5" data-bs-toggle="dropdown"></i>
                        <ul class="dropdown-menu dropdown-menu-light text-small shadow">
                            <li><button class="dropdown-item" data-toggle="modal" data-target="#changePasswordModal1">Change
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

            <div class="col-lg-3 p-3 card">
                <div class="row">
                    <div class="col-4 d-flex justify-content-center">
                        <img src="{{ asset('assets/images/user-icon.png') }}" width="70" height="70"
                            alt="user-image">
                    </div>
                    <div class="col">
                        <div class="name mb-1">
                            <span class="title">Sujal Adhikari</span>
                        </div>
                        <div class="role mb-1">
                            <h6>Moderator</h6>
                        </div>
                        <div class="status-active">
                            <span><i class="bi-person-fill-check"></i> Active</span>
                        </div>
                    </div>
                    <div class="col-1 d-flex justify-content-end">
                        <i class="bi-three-dots-vertical fs-5" data-bs-toggle="dropdown"></i>
                        <ul class="dropdown-menu dropdown-menu-light text-small shadow">
                            <li><button class="dropdown-item">Change Role</button></li>
                            <li><button class="dropdown-item">Mark as In-active</button></li>
                            <li><button class="dropdown-item">Profile</button></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><button class="dropdown-item">Delete</button></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 p-3 card">
                <div class="row">
                    <div class="col-4 d-flex justify-content-center">
                        <img src="{{ asset('assets/images/user-icon.png') }}" width="70" height="70"
                            alt="user-image">
                    </div>
                    <div class="col">
                        <div class="name mb-1">
                            <span class="title">Sujal Adhikari</span>
                        </div>
                        <div class="role mb-1">
                            <h6>Moderator</h6>
                        </div>
                        <div class="status-inactive">
                            <span><i class="bi-person-fill-slash"></i> Not Active</span>
                        </div>
                    </div>
                    <div class="col-1 d-flex justify-content-end">
                        <i class="bi-three-dots-vertical fs-5" data-bs-toggle="dropdown"></i>
                        <ul class="dropdown-menu dropdown-menu-light text-small shadow">
                            <li><button class="dropdown-item">Change Role</button></li>
                            <li><button class="dropdown-item">Mark as Active</button></li>
                            <li><button class="dropdown-item">Profile</button></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><button class="dropdown-item">Delete</button></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center mt-5">
            <div class="col-lg-12 alert-danger p-3">
                <i>Note: Only one Admin and two Moderator can be there at a
                    time. If you want to add a new moderator, disable or delete the existing one and then
                    add new user.</i>
            </div>
        </div>
    </div>
    <!-- Profile Modal start -->
    <div id="profileModal1" class="modal fade">
        <div class="modal-dialog delete-modal-diaglog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">User Profile</h4>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label for="" class="form-label">User ID</label>
                            <input type="text" name="id" value="M-01" class="form-control" disabled>
                        </div>
                        <div class="form-group mb-2">
                            <label for="" class="form-label">Role</label>
                            <input type="text" name="role" value="Moderator" class="form-control" disabled>
                        </div>
                        <div class="form-group mb-2">
                            <label for="" class="form-label">Username</label>
                            <input type="text" name="username" value="Kunsang Moktan" class="form-control" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="" class="form-label">Email</label>
                            <input type="email" name="email" value="kunsang_202116033@smit.smu.edu.in"
                                class="form-control" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="" class="form-label">Password</label>
                            <input type="password" name="password" value="12345678" id="passwordInput"
                                class="form-control" disabled>
                        </div>
                        <div class="form-group mb-2">
                            <input type="checkbox" id="showPasswordCheckbox">
                            <label for="">Show password</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-success" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Profile Modal end -->

    <!-- Change Password Modal start -->
    <div id="changePasswordModal1" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Change Password</h4>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group mb-2">
                            <label for="" class="form-label">Current Password</label>
                            <input type="text" name="currentPassword" value="12345678" id="passwordInput"
                                class="form-control" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="" class="form-label">New Password</label>
                            <input type="password" name="password" id="passwordInput" class="form-control" reuired>
                        </div>
                        <div class="form-group mb-2">
                            <label for="" class="form-label">Confirm New Password</label>
                            <input type="password" name="password" id="passwordInput" class="form-control" reuired>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Change</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Change Password Modal end -->

    <!-- Delete Modal start -->
    <div id="profileModal1" class="modal fade">
        <div class="modal-dialog delete-modal-diaglog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">User Profile</h4>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label for="" class="form-label">User ID</label>
                            <input type="text" name="currentRole" value="M-01" class="form-control" disabled>
                        </div>
                        <div class="form-group mb-2">
                            <label for="" class="form-label">Username</label>
                            <input type="text" name="currentRole" value="Kunsang Moktan" class="form-control"
                                required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="" class="form-label">Email</label>
                            <input type="email" name="currentRole" value="kunsang_202116033@smit.smu.edu.in"
                                class="form-control" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="" class="form-label">Password</label>
                            <input type="password" name="password" value="12345678" id="passwordInput"
                                class="form-control" disabled>
                        </div>
                        <div class="form-group mb-2">
                            <input type="checkbox" id="showPasswordCheckbox">
                            <label for="">Show password</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-success" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Delete Modal end -->
@endsection
