@extends('layouts/admin-content')
<title>Export Data</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link href="{{ asset('assets/css/datatables.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
@section('content')
    @if (session('error'))
        <div class="row d-flex justify-content-center">
            <div class="col">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <b>{{ session('error') }}</b>
                    <button type="button" class="btn-close " data-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif
    @if (session('success'))
        <div class="row d-flex justify-content-center">
            <div class="col">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span>{{ session('success') }}</span>
                    <button type="button" class="btn-close " data-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif
    @if ($errors->any())
        <div id="alertMessage" class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    <div class="container p-0">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Export Volunteer Details</div>
                <form action="{{ route('volunteer.fetchData') }}" method="POST" id="form">
                    @csrf
                    <div class="row mt-3 p-0 px-0">
                        <div class="col-md-5 col-lg-4 mt-lg-0 mt-xl-0 mt-md-0 mt-3">
                            <select name="batch" class="form-select" id="batch" required>
                                <option value="" selected>Select batch from list</option>
                                <option value="*">All</option>
                                @for ($index = 0; $index < $batches->count(); $index++)
                                    <option value="{{ $batches[$index] }}">{{ $batches[$index] }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-5 col-lg-4 mt-lg-0 mt-xl-0 mt-md-0 mt-3">
                            <select name="course" class="form-select" id="course" required>
                                <option value="" selected>Select course from list</option>
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
        @endif
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/jquery-3.6.0.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
@endsection
