<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BISJHINTUS Student Listing - Admin Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/login-style.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">
</head>

<body>
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center vh-100">
            <div class="col-xl-5 col-lg-8 col-md-8">
                <div class="card shadow-lg">
                    <div class="card-body p-xl-5 p-md-4 p-4">
                        <h2 class="fw-bold text-secondary mt-3 mb-3 text-center">Admin Register</h2>
                        <p class="text-secondary mb-4 text-center">BISJHINTUS Student Listing Admin</p>
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Name" name="name"
                                        aria-label="Username" aria-describedby="basic-addon1" required>
                                </div>
                                @error('name')
                                    <span class="text-danger fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Email" name="email"
                                        aria-label="Username" aria-describedby="basic-addon1" required>
                                </div>
                                @error('email')
                                    <span class="text-danger fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                                </div>
                                @error('password')
                                    <span class="text-danger fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm pasword" required>
                                </div>
                                @error('password_confirmation')
                                    <span class="text-danger fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="submit" class="btn btn-primary w-100 fw-bold" value="Register">
                            </div>
                        </form>
                        <p class="text-danger">Note: This form is only valid for first time, once the admin is registered, another admin cannot be registered and this route will not open.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/script.js') }}"></script>
</body>

</html>

