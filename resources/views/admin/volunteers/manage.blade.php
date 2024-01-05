@extends('layouts/admin-content')
@section('content')
    <div class="container-fluid p-0">
        <div class="user-role row">
            <div class="col-xl-12 col-xxl-5 d-flex">
                <div class="w-100">
                    <div class="row">
                        <div class="col-lg-3 col-md-3">
                            <a href="{{ route('volunteer.view-edit') }}">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row text-center">
                                            <div class="card-image">
                                                <img src="{{ asset('assets/img/icons/user-icon.png') }}" width="70"
                                                    height="70" alt="user-image">
                                            </div>
                                            <div class="card-text mt-3">
                                                <h5>View / Edit Volunteer Details</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3">
                            <a href="{{ route('batch.create') }}">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row text-center">
                                            <div class="card-image">
                                                <img src="{{ asset('assets/img/icons/add-icon.png') }}" width="70"
                                                    height="70" alt="user-image">
                                            </div>
                                            <div class="card-text mt-3">
                                                <h5>Create New Batch</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <a href="{{ route('batch.view-edit') }}">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row text-center">
                                            <div class="card-image">
                                                <img src="{{ asset('assets/img/icons/edit-icon.png') }}" width="70"
                                                    height="70" alt="user-image">
                                            </div>
                                            <div class="card-text mt-3">
                                                <h5>View/Edit Batch Details</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
