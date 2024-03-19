<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BISJHINTUS Student Listing - Forgot password</title>
    <link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/login-style.css') }}">
</head>

<body>
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center vh-100">
            <div class="col-xl-5 col-lg-8 col-md-8">
                <div class="card shadow-lg">
                    <div class="card-body p-xl-5 p-md-4 p-4">
                        <h2 class="fw-bold text-secondary mt-3">Recover Account</h2>
                        @if (session('status'))
                            <div class="text-success mt-3 mb-3">
                                {{ session('status') }}
                            </div>
                        @else
                            <p class="text-secondary mb-3">We will send an email to recover your account</p>
                        @endif
                        <form action="{{ route('password.email') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" class="form-control mb-3" placeholder="Email" name="email" value="{{ old('email') }}">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="submit" class="btn btn-primary w-100" placeholder="Password"
                                value="Request email">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
