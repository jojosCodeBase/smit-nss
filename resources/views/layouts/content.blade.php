<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <span class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline">Admin Dashboard</span>
                    </span>

                    <ul class="nav nav-pills">
                        <li class="nav-item p-0 text-start px-3 w-100 active-page">
                            <a href="{{ route('home') }}" class="nav-link align-middle px-0">
                                <i class="fs-6 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                            </a>
                        </li>
                        <li class="nav-item p-0 text-start px-3 w-100">
                            <span class="nav-link align-middle px-0 text-light">
                                <i class="fs-6 bi-people-fill"></i> <span
                                    class="ms-1 d-none d-sm-inline">Volunteers</span>
                            </span>

                            <ul class="nav nav-pills">
                                <li class="nav-item p-0 text-start px-3 w-100">
                                    <a href="{{ route('volunteer.manage') }}" class="nav-link align-middle px-0">
                                        <i class="fs-6 bi-pencil-square"></i> <span
                                            class="ms-1 d-none d-sm-inline">Manage</span>
                                    </a>
                                </li>
                                <li class="nav-item p-0 text-start px-3 w-100">
                                    <a href="{{ route('volunteer.search') }}" class="nav-link align-middle px-0">
                                        <i class="fs-6 bi-search"></i> <span
                                            class="ms-1 d-none d-sm-inline">Search</span>
                                    </a>
                                </li>
                                <li class="nav-item p-0 text-start px-3 w-100">
                                    <a href="{{ route('volunteer.add') }}" class="nav-link align-middle px-0">
                                        <i class="fs-6 bi-person-fill-add"></i> <span
                                            class="ms-1 d-none d-sm-inline">Add</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item p-0 text-start px-3 w-100">
                            <span class="nav-link align-middle px-0 text-light">
                                <i class="fs-6 bi-card-checklist"></i> <span class="ms-1 d-none d-sm-inline">NSS
                                    Drives</span>
                            </span>

                            <ul class="nav nav-pills">
                                <li class="nav-item p-0 text-start px-3 w-100">
                                    <a href="{{ route('drive.add') }}" class="nav-link align-middle px-0">
                                        <i class="fs-6 bi-card-text"></i> <span
                                            class="ms-1 d-none d-sm-inline">Add</span>
                                    </a>
                                </li>
                                <li class="nav-item p-0 text-start px-3 w-100">
                                    <a href="{{ route('drive.manage') }}" class="nav-link align-middle px-0">
                                        <i class="fs-6 bi-pencil-square"></i> <span
                                            class="ms-1 d-none d-sm-inline">Manage</span>
                                    </a>
                                </li>
                                <li class="nav-item p-0 text-start px-3 w-100">
                                    <a href="{{ route('drive.attendance') }}" class="nav-link align-middle px-0">
                                        <i class="fs-6 bi-calendar2-check"></i> <span
                                            class="ms-1 d-none d-sm-inline">Attendance</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item p-0 text-start px-3 w-100">
                            <span class="nav-link align-middle px-0 text-light">
                                <i class="fs-6 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Users</span>
                            </span>

                            <ul class="nav nav-pills">
                                <li class="nav-item p-0 text-start px-3 w-100">
                                    <a href="{{ route('users.manage') }}" class="nav-link align-middle px-0">
                                        <i class="fs-6 bi-person-fill-gear"></i> <span
                                            class="ms-1 d-none d-sm-inline">Manage</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                    <div class="dropdown pb-4 mt-4">
                        <a href="#"
                            class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                            id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('assets/images/admin-photo.jpg') }}" alt="admin-image" width="30"
                                height="30" class="rounded-circle">
                            <span class="d-none d-sm-inline mx-1">{{Auth::user()->name}}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                            <li><a class="dropdown-item" href="#">New project...</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Sign out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- sidebar content end -->
            <div class="col py-0 px-0">
                @yield('content')
            </div>
        </div>
    </div>
    <footer class="bg-body-tertiary text-center text-lg-start bg-dark">
        <div class="text-center p-3 text-light" style="background-color: rgba(0, 0, 0, 0.05);">
            Designed and developed by
            <a class="text-light" href="" style="text-decoration: none;">Kunsang Moktan</a>
        </div>
    </footer>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>
