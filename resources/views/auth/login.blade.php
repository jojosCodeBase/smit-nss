<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ asset('assets/img/icons/icon-48x48.png') }}" />

    <title>SMIT-NSS | Login</title>

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body style="background-color: #e0f1f3">
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-5 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">

                        <div class="text-center mt-4">
                            <h1 class="h2">Welcome to SMIT-NSS Portal</h1>
                            <p class="lead">
                                Sign in to your account to continue
                            </p>
                        </div>

                        @if (session('success'))
                            <div id="alertMessage" class="alert alert-warning">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-4">
                                    <div class="text-center">
                                        <img src="{{ asset('assets/img/icons/admin-icon.png') }}" alt="admin_image"
                                            class="img-fluid rounded-circle" width="132" height="132" />
                                    </div>
                                    @if ($errors->has('invalid'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('invalid') }}
                                        </div>
                                    @endif
                                    <form action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input class="form-control form-control-lg" type="email" name="email"
                                                id="email" placeholder="Enter your email" required>
                                            <span class="text-danger" id="email-error"></span>
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input class="form-control form-control-lg" type="password" name="password"
                                                id="password" placeholder="Enter your password" required>
                                            <span class="text-danger" id="password-error"></span>
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div>
                                            <input type="checkbox" id="showPassword" class="form-check-input me-2">
                                            <label for="showPassword" class="form-label user-select-none">Show
                                                password</label>
                                        </div>
                                        <div class="text-center mt-3">
                                            <input type="submit" class="btn btn-lg btn-primary w-100 fw-bold fs-4"
                                                value="Login">
                                        </div>
                                        <div class="form-group text-center forgot-password mt-3">
                                            <a href="{{ route('forgot-password') }}">Forgot password?</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        document.getElementById('showPassword').addEventListener('change', function() {
            const passwordField = document.getElementById('password');
            passwordField.type = this.checked ? 'text' : 'password';
        });
    </script>
</body>

</html>
