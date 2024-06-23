<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ asset('assets/img/icons/icon-48x48.png') }}" />

    <title>SMIT-NSS | New Password</title>

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
                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-4">
                                    <h2 class="fw-bold text-secondary mt-3 mb-2">New Password</h2>
                                    <form action="{{ route('password.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="token" value="{{ $token }}">
                                        <div class="mb-3">
                                            <div class="input-group">
                                                <input type="text" class="form-control"
                                                    value="{{ old('email', $email) }}" name="email" required readonly>
                                            </div>
                                            @error('email')
                                                <span class="text-danger fs-6">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <div class="input-group">
                                                <input type="password" class="form-control" name="password"
                                                    id="password" placeholder="Password" required>
                                            </div>
                                            @error('password')
                                                <span class="text-danger fs-6">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <div class="input-group">
                                                <input type="password" class="form-control"
                                                    name="password_confirmation" id="password_confirmation"
                                                    placeholder="Confirm pasword" required>
                                            </div>
                                            @error('password_confirmation')
                                                <span class="text-danger fs-6">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <input type="submit" class="btn btn-primary w-100 fw-bold"
                                                value="Reset password">
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
</body>

</html>
