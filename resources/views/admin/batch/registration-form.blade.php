<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NSS {{ $batchName }} Batch | Registration form</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/icons/icon-48x48.png') }}" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: "Inter", "Helvetica Neue", Arial, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            ;
            /* background-color: rgb(245, 247, 251); */
            background-color: #dad7d7;
        }

        .form-control {
            /* border-top: none;
            border-right: none;
            border-left: none;
            border-radius: 0px; */
        }

        .form-label {
            font-weight: bold;
            opacity: 80%;
        }

        .form-control:focus-within {
            box-shadow: none;
        }

        .form-group-text {
            background-color: transparent;
        }

        .underline {
            border-bottom: 3px solid rgb(73, 7, 226);
            width: 30%;
            opacity: 100%;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-6 col-lg-6 col-md-10 col">
                @if (session('error'))
                    <div class="row d-flex justify-content-center">
                        <div class="col">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close " data-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                        <button type="button" class="btn-close " data-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif
                <div class="card p-xl-3">
                    <div class="card-body">
                        <h4 class="fw-bold text-center">NSS Batch {{ $batchName }} Registration Form</h4>
                        <hr class="underline mb-2">
                        @if ($status)
                            @if (session('success'))
                                <h5 class="text-center">Your Response has been recorded. Thank you</h5>
                            @else
                                <form action="{{ route('volunteer-register-form') }}" method="POST">
                                    @csrf
                                    <input type="text" name="batch" value="{{ $batchId }}" hidden>
                                    <div class="form-group mb-2">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="form-label">Registration no</label>
                                        <input type="text" name="regno" class="form-control" maxlength="9"
                                            required>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" required>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="form-label">Select gender</label>
                                        <div class="d-flex">
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="radio" name="gender"
                                                    value="M">
                                                <label class="form-check-label">
                                                    Male
                                                </label>
                                            </div>
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="radio" name="gender"
                                                    value="F">
                                                <label class="form-check-label">
                                                    Female
                                                </label>
                                            </div>
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="radio" name="gender"
                                                    value="O">
                                                <label class="form-check-label">
                                                    Others
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="form-label">Phone number</label>
                                        <input type="text" name="phone" class="form-control" required>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="form-label">Date of birth</label>
                                        <input type="date" name="dob" class="form-control" required>
                                    </div>
                                    <div class="col mb-2">
                                        <label class="form-label">Course</label>
                                        <select name="course" id="" class="form-select" required>
                                            <option value="" disabled selected>Select course from list</option>
                                            @foreach ($courses as $course)
                                                <option value="{{ $course['id'] }}">{{ $course['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-2" id="document-number">
                                        <label class="form-label">Category</label>
                                        <select name="category" id="" class="form-select" required>
                                            <option value="" disabled selected>Select category from list</option>
                                            <option value="General">General</option>
                                            <option value="OBC">OBC</option>
                                            <option value="ST">ST</option>
                                            <option value="SC">SC</option>
                                            <option value="Minority">Minority</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="form-label">Nationality</label>
                                        <select name="nationality" id="nationality" class="form-select" required>
                                            <option value="" disabled selected>Select nationality from list
                                            </option>
                                            <option value="I">Indian</option>
                                            <option value="NI">Non-Indian</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-2">
                                        <label class="form-label" id="aadhar-number-input">Aadhar number</label>
                                        <label class="form-label" id="document-number-input"
                                            style="display: none;">Other document
                                            number</label>
                                        <input type="text" name="document" class="form-control" required>
                                    </div>

                                    <div class="form-group mb-2 d-flex justify-content-center mt-3">
                                        <div class="col-xl-12 col-lg-10 col-md-12 col">
                                            <input type="submit" class="btn btn-primary w-100" value="Submit">
                                        </div>
                                    </div>
                                </form>
                            @endif
                        @else
                            <h5 class="text-center">This form is not accepting responses</h5>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="text-center mt-3 mb-2">
        <span>Designed and Developed by Kunsang Moktan, Department of Computer Applications</span>
    </footer>

    <script>
        document.getElementById('nationality').addEventListener('change', () => {
            // for Non-Indian
            if (document.getElementById('nationality').value == 'I') {
                document.getElementById('aadhar-number-input').style.display = 'block';
                document.getElementById('document-number-input').style.display = 'none';
            } else {
                // for Indian
                if (document.getElementById('nationality').value == 'NI') {
                    document.getElementById('aadhar-number-input').style.display = 'none';
                    document.getElementById('document-number-input').style.display = 'block';
                }
            }
        });
    </script>
</body>

</html>
