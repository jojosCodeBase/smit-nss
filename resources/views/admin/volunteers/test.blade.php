<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

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
		<div id="sidebar" class="collapse">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="{{ route('home') }}">
					<span class="align-middle">NSS SMIT Admin Panel</span>
				</a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Pages
					</li>

					<li class="sidebar-item active">
						<a class="sidebar-link" href="{{ route('home') }}">
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
						<a class="sidebar-link" href="{{ route('volunteer.search') }}">
							<i class="align-middle" data-feather="search"></i> <span class="align-middle">Search</span>
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

					<li class="sidebar-header">Users</li>
					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('users.manage') }}">
							<i class="align-middle" data-feather="users"></i> <span class="align-middle">Manage</span>
						</a>
					</li>
				</ul>
			</div>
		</div>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<button data-target="#sidebar" data-bs-toggle="collapse">
					<i class="hamburger align-self-center"></i>
                </button>

				<div class="breadcrumb-bar px-4">
                    <span class="breadcrumb-item active">Dashboard</span>
                </div>

				<div class="navbar-collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none text-decoration-none" href="#"
								data-bs-toggle="dropdown">
								<i class="align-middle bi-person-circle"></i>
							</a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
								data-bs-toggle="dropdown">
								<img src="{{asset('assets/img/icons/admin-icon.png')}}" class="avatar img-fluid rounded me-1"
									alt="admin_image" /> <span class="text-dark">Admin</span>
							</a>
							<div class="dropdown-menu dropdown-menu-end">
								<span class="dropdown-item text-center">Admin</span>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="{{ route('admin-profile') }}"><i class="align-middle me-1"
										data-feather="user"></i> Profile</a>
								<a class="dropdown-item" href="#"><i class="align-middle me-1"
										data-feather="pie-chart"></i> Analytics</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="dashboard.html"><i class="align-middle me-1"
										data-feather="settings"></i> Settings & Privacy</a>
								<a class="dropdown-item" href="#"><i class="align-middle me-1"
										data-feather="help-circle"></i> Help Center</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="index.html">Log out</a>
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
    {{-- <script src="{{ asset('assets/js/app.js') }}"></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
		integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
		crossorigin="anonymous"></script>
</body>

</html>
