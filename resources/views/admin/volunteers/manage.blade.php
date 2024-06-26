@extends('layouts/admin-content')
@section('breadcrumb', 'Manage Volunteers')
@section('title', 'Manage Volunteers')
@section('content')
    <div class="container-fluid p-0">
        <div class="user-role row">
            <div class="col-xl-12 d-flex">
                <div class="w-100">
                    <div class="row">
                        <div class="col-lg-4 col-md-3 col-xl-3">
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
                        <div class="col-lg-4 col-md-3 col-xl-3">
                            <a href="{{ route('volunteer.export') }}">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row text-center">
                                            <div class="card-image">
                                                <img src="{{ asset('assets/img/icons/data-export.png') }}" width="70"
                                                    height="70" alt="user-image">
                                            </div>
                                            <div class="card-text mt-3">
                                                <h5>Download/Print Volunteer Details</h5>
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
