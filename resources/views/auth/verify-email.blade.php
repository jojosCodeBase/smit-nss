<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BISJHINTUS STUDENT LISTING - Verify Email</title>
    <link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/login-style.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">
</head>

<body>
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center vh-100">
            <div class="col-xl-6 col-lg-8 col-md-8">
                <div class="card shadow-lg">
                    <div class="card-body p-xl-5 p-md-4 p-4">
                        <h2 class="fw-bold text-secondary mt-3">Verify Email</h2>
                        @if (session('status'))
                            <div class="text-success mt-3 mb-3">
                                A new verification link has been sent to the email address you provided during registration.
                            </div>
                        @else
                            <p class="text-success mb-3">Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.</p>
                        @endif
                        <form action="{{ route('verification.send') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="submit" class="btn btn-primary w-100" value="Resent Verification Email">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
