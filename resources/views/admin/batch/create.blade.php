@extends('layouts/admin-content')
@section('content')
    @if (session('success'))
        <div class="row d-flex justify-content-center">
            <div class="col">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <b>{{ session('success') }}</b>
                    <button type="button" class="btn-close " data-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif
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
    <div class="container-fluid p-0">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Create New NSS Batch</div>
                <form action="{{ route('batch.create') }}" method="POST">
                    @csrf
                    <div class="row mt-3 p-0 px-0">
                        <div class="col-md-4 col-lg-4">
                            <input type="text" name="name" class="form-control mb-1" placeholder="Batch Name"
                                id="batchName">
                            <span id="message"></span>
                        </div>
                        <div class="col-md-3 col-lg-4">
                            <input type="text" name="studentCoordinator" class="form-control" placeholder="Student Co-ordinator">
                        </div>
                        <div class="col-lg-3 text-center">
                            <input type="submit" class="btn btn-primary w-75" value="Create">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('batchName').addEventListener('keyup', function() {
            var batchName = document.getElementById('batchName');
            var message = document.getElementById('message');
            var regex = /^\d{4}-\d{2}$/;

            if (regex.test(batchName.value)) {
                message.className = "text-success";
                batchName.className = "form-control mb-1 border-success";
                message.innerHTML = "Valid batch name";
            } else {
                message.className = "text-danger";
                batchName.className = "form-control mb-1 border-danger";
                message.innerHTML = "Invalid batch name. Format should be yyyy-yy";
            }
        });
    </script>
@endsection
