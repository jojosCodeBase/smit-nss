<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NSS Batch {{ $batchName }} | Registration form</title>
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
            background-color: rgb(73, 7, 226);
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

        .input-group-text {
            /* border-top: none;
            border-right: none;
            border-left: none;
            border-radius: 0px; */
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
            <div class="col-lg-6 col-md-6">
                <div class="card p-3">
                    <div class="card-body">
                        <h4 class="fw-bold text-center">NSS Batch {{ $batchName }} Registration Form</h4>
                        <hr class="underline mb-4">
                        @if(session('success'))
                            <h5 class="text-center">{{ session('success') }}</h5>
                        @elseif(session('error'))
                            <h5 class="text-center">{{ session('error') }}</h5>
                        @elseif($status)
                            <form action="{{ route('register') }}" method="POST">
                                @csrf
                                <div class="input-group mb-4">
                                    <input type="number" class="form-control" name="regno" placeholder="Registration number"
                                        required>
                                </div>
                                <div class="input-group mb-4">
                                    <input type="text" class="form-control" name="name" placeholder="Name"
                                        required>
                                    <i class="input-group-text bi-person-fill"></i>
                                </div>
                                <div class="input-group mb-4">
                                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                                    <i class="input-group-text bi-envelope-fill"></i>
                                </div>
                                <div class="input-group mb-4">
                                    <input type="phone" class="form-control" name="phone" placeholder="Phone" required>
                                    <i class="input-group-text bi-telephone-fill"></i>
                                </div>
                                <div class="input-group mb-4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="male" value="M">
                                        <label class="form-check-label">Male</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="female" value="F">
                                        <label class="form-check-label">Female</label>
                                    </div>
                                </div>
                                <label class="form-label">Date of birth</label>
                                <div class="input-group mb-4">
                                    <input type="date" name="dob" class="form-control">
                                </div>
                                <div class="input-group mb-4">
                                    <select name="category" class="form-select">
                                        <option value="-1" selected>Select category from list</option>
                                        <option value="st">ST</option>
                                        <option value="sc">SC</option>
                                        <option value="general">General</option>
                                        <option value="obc">OBC</option>
                                    </select>
                                </div>
                                <label class="form-label">Nationality</label>
                                <div class="input-group mb-4">
                                    <select name="nationality" id="nationality" class="form-select">
                                        <option value="0">Indian</option>
                                        <option value="1">Non-Indian</option>
                                    </select>
                                </div>
                                <div class="input-group mb-4" id="document-number">
                                    <input type="text" name="document-number" id="aadhar" class="form-control"
                                        placeholder="Aadhar number">
                                    <input type="text" name="document_number" id="other-document" class="form-control"
                                        placeholder="Other document number" style="display: none;" disabled>
                                </div>
                                <div class="input-group mb-4">
                                    <select name="course" id="course" class="form-select" required>
                                        <option value="-1" selected>Select course from list</option>
                                        @foreach ($courses as $c)
                                            <option value="{{ $c['cid'] }}">{{ $c['cname'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="text" name="batch" class="form-control" value="{{ $batchName }}" hidden>
                                {{-- <div class="input-group mb-4">
                                    <input type="semester" name="semester" class="form-control" placeholder="Semester" required>
                                </div> --}}
                                <div class="input-group mb-4 d-flex justify-content-center">
                                    <input type="submit" class="btn btn-primary w-25" value="Submit">
                                </div>
                            </form>
                        @else
                            <h5 class="text-center">This form is not accepting responses</h5>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="text-center mt-3 mb-2">
        <span class="text-light">Designed and developed by <a href="" class="text-light">Kunsang
                Moktan</a>
        </span>
    </footer>

    <script>
        document.getElementById('nationality').addEventListener('change', () => {
            // for Non-Indian
            if (document.getElementById('nationality').value == 1) {
                document.getElementById('aadhar').style.display = 'none';
                document.getElementById('other-document').style.display = 'block';
                document.getElementById('other-document').disabled = false;
            } else {
                // for Indian
                if (document.getElementById('nationality').value == 0) {
                    document.getElementById('aadhar').style.display = 'block';
                    document.getElementById('other-document').style.display = 'none';
                    document.getElementById('other-document').disabled = true;
                }
            }
        });
    </script>
</body>

</html>
