@extends('layouts/admin-content')
@section('content')
    @include('include/alerts')
    <div class="container-fluid p-0">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Create New NSS Batch</div>
                <form action="{{ route('batch.create') }}" method="POST">
                    @csrf
                    <div class="row mt-3 p-0 px-0">
                        <div class="col-md-5 col-lg-4">
                            <input type="text" name="name" class="form-control mb-1" placeholder="Batch Name"
                                id="batchName" required>
                            <p id="message"></p>
                        </div>
                        <div class="col-md-5 col-lg-4 mt-lg-0 mt-xl-0 mt-md-0 mt-3">
                            <input type="text" name="studentCoordinator" class="form-control"
                                placeholder="Student Co-ordinator" required>
                        </div>
                        <div class="col-md-2 col-lg-2 mt-lg-0 mt-xl-0 mt-md-0 mt-3">
                            <input type="submit" class="btn btn-primary w-100" value="Create">
                        </div>
                    </div>
                </form>
                <p class="text-danger mt-3">Note: The batch name should be in format (Batch Starting Year Full - Batch End
                    Year Last Two Digits), E.g. 2022-24</p>
            </div>
        </div>
    </div>
    <div class="container-fluid p-0">
        <div class="card">
            <div class="card-body table-responsive">
                <div class="card-title">All Batches</div>
                <table class="table">
                    <thead>
                        <th>Name</th>
                        <th>Student Co-ordinator</th>
                        <th>Volunteers</th>
                        <th>Registration</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($batches as $b)
                            <tr>
                                <td>{{ $b['name'] }}</td>
                                <td>{{ $b['studentCoordinator'] }}</td>
                                <td>{{ $b['volunteers'] }}</td>
                                @if ($b['status'] == 0)
                                    @php
                                        $buttonClass = 'btn-success';
                                        $buttonText = 'Open';
                                        $statusText = 'Not Accepting Responses';
                                    @endphp
                                @else
                                    @php
                                        $buttonClass = 'btn-danger';
                                        $buttonText = 'Close';
                                        $statusText = 'Accepting Responses';
                                    @endphp
                                @endif
                                <td>
                                    <button type="button" class="btn {{ $buttonClass }}"
                                        id="status-btn{{ $b['id'] }}"
                                        onclick="changeStatus({{ $b['id'] }}, {{ $b['status'] }})">{{ $buttonText }}</button>
                                </td>
                                <td id="form-status{{ $b['id'] }}">{{ $statusText }}</td>

                                <td>
                                    <div class="more-btn">
                                        <div class="dropdown">
                                            <button type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots"></i>
                                            </button>
                                            <ul class="dropdown-menu mt-5" aria-labelledby="dropdownMenuButton1">
                                                <li><a class="dropdown-item"
                                                        href="{{ route('batch.registration-form', $b['name']) }}"
                                                        target="_blank">View Form</a></li>
                                                <button class="dropdown-item batchEditBtn" data-toggle="modal"
                                                    data-target="#editBatchModal"
                                                    data-batch-Id="{{ $b['id'] }}">Edit</button>
                                                <button class="dropdown-item batchDeleteBtn" data-toggle="modal"
                                                    data-target="#deleteModal"
                                                    data-batch-Id="{{ $b['id'] }}">Delete</button>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="editBatchModal" class="modal fade">
        <div class="modal-dialog edit-modal-diaglog">
            <div class="modal-content">
                <form action="{{ route('batch.update') }}" method="POST">
                    @csrf
                    <input type="text" name="id" id="id" hidden>
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Batch</h4>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label class="form-label">Batch Name</label>
                            <input type="text" class="form-control" id="response-batch-name" name="batchName" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Student Co-ordinator</label>
                            <input type="text" class="form-control" id="response-batch-student-coordinator" name="studentCoordinator" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <button type="submit" class="btn btn-success" id="updateBatchInfoBtn">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
{{-- @section('scripts')
    <script>
        // ajax function to get batch info

    </script>
@endsection --}}
