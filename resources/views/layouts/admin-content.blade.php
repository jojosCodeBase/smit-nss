<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ asset('assets/img/icons/icon-48x48.png') }}" />

    <title>NSS-SMIT Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="{{ route('admin.home') }}">
                    <span class="align-middle">NSS SMIT Admin Panel</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Menu
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.home') }}">
                            <i class="align-middle" data-feather="sliders"></i> <span
                                class="align-middle">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-header">Volunteers</li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('volunteer.manage') }}">
                            <i class="align-middle" data-feather="users"></i> <span class="align-middle">Manage</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('volunteer.add') }}">
                            <i class="align-middle" data-feather="file-plus"></i> <span class="align-middle">Add</span>
                        </a>
                    </li>

                    <li class="sidebar-header">Drive</li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('drive.list') }}">
                            <i class="align-middle" data-feather="file"></i> <span class="align-middle">Manage</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('drive.attendance') }}">
                            <i class="align-middle" data-feather="calendar"></i> <span
                                class="align-middle">Attendance</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('drive.add') }}">
                            <i class="align-middle" data-feather="file-plus"></i> <span class="align-middle">Add</span>
                        </a>
                    </li>

                    <li class="sidebar-header">Batch</li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('batch.manage') }}">
                            <i class="align-middle" data-feather="users"></i> <span class="align-middle">Manage
                                Batches</span>
                        </a>
                    </li>

                    <li class="sidebar-header">Users</li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('users.manage') }}">
                            <i class="align-middle" data-feather="users"></i> <span class="align-middle">Manage</span>
                        </a>
                    </li>

                </ul>
            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="breadcrumb-bar px-4">
                    <span class="breadcrumb-item active">Dashboard</span>
                </div>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none text-decoration-none"
                                href="#" data-bs-toggle="dropdown">
                                <i class="align-middle bi-person-circle"></i>
                            </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
                                data-bs-toggle="dropdown">
                                <img src="{{ asset('assets/img/icons/admin-icon.png') }}"
                                    class="avatar img-fluid rounded me-1" alt="admin_image" /> <span
                                    class="text-dark">{{ Auth::user()->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('admin.profile.edit') }}"><i
                                        class="align-middle me-1" data-feather="user"></i> Profile</a>
                                <div class="dropdown-divider"></div>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="align-middle me-1"
                                            data-feather="logout"></i> Logout</button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="content p-4">
                @yield('content')
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-12 text-center">
                            <p class="mb-0">
                                <a class="text-muted" href="https://coderjojo.tech" target="_blank">&copy;
                                    <strong>Designed and Developed By Kunsang Moktan</strong></a>
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>

    @yield('scripts')
</body>

</html>
