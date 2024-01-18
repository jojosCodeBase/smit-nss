<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ asset('assets/img/icons/icon-48x48.png') }}" />

    <title>Export Data</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link href="{{ asset('assets/css/datatables.min.css') }}" rel="stylesheet">
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
                        Pages
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
                        <a class="sidebar-link" href="{{ route('users.manage') }}">
                            <i class="align-middle" data-feather="users"></i> <span class="align-middle">Create</span>
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
                                <a class="dropdown-item" href="#"><i class="align-middle me-1"
                                        data-feather="pie-chart"></i> Analytics</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="dashboard.html"><i class="align-middle me-1"
                                        data-feather="settings"></i> Settings & Privacy</a>
                                <a class="dropdown-item" href="#"><i class="align-middle me-1"
                                        data-feather="help-circle"></i> Help Center</a>
                                <div class="dropdown-divider"></div>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <input type="submit" class="dropdown-item" value="Log out">
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="content p-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Export Volunteer Details</div>
                        <form action="{{ route('volunteer.fetchData') }}" method="POST" id="form">
                            @csrf
                            <div class="row mt-3 p-0 px-0">
                                <div class="col-md-5 col-lg-4 mt-lg-0 mt-xl-0 mt-md-0 mt-3">
                                    <select name="batch" class="form-select" id="batch" required>
                                        <option value="-1" selected>Select batch from list</option>
                                        <option value="*">All</option>
                                        @for ($index = 0; $index < $batches->count(); $index++)
                                            <option value="{{ $batches[$index] }}">{{ $batches[$index] }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-5 col-lg-4 mt-lg-0 mt-xl-0 mt-md-0 mt-3">
                                    <select name="course" class="form-select" id="course" required>
                                        <option value="-1" selected>Select course from list</option>
                                        <option value="*">All</option>
                                        @foreach ($courses as $c)
                                            <option value="{{ $c['cid'] }}">{{ $c['cname'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 col-lg-2 mt-lg-0 mt-xl-0 mt-md-0 mt-3">
                                    <input type="submit" class="btn btn-primary w-100" value="Search">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @if (session('volunteers'))
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="data-table">
                                    <div class="buttons"></div>
                                    <table id="myTable" class="table table-striped" style="width:100%">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Reg No</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>NSS Batch</th>
                                                <th>Course</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (session('volunteers') as $v)
                                                <tr>
                                                    <td>{{ $v['id'] }}</td>
                                                    <td>{{ $v['name'] }}</td>
                                                    <td>{{ $v['email'] }}</td>
                                                    <td>{{ $v['phone'] }}</td>
                                                    <td id="batch-name-export">{{ $v['batch'] }}</td>
                                                    <td>{{ $v['course'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif(session('error'))
                    <div class="row d-flex justify-content-center">
                        <div class="col">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <b>{{ session('error') }}</b>
                                <button type="button" class="btn-close " data-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                @endif
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
    <script src="{{ asset('assets/js/jquery-3.6.0.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>
</html>
