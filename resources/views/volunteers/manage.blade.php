@extends('layouts/content')
@section('content')
    <div class="breadcrumb-bar mb-3 px-4">
        <span class="breadcrumb-item">Home</span>
        <span class="breadcrumb-item">Volunteers</span>
        <span class="breadcrumb-item active">Manage</span>
    </div>
    <div class="container">
        <div class="row user mb-5">
            <div class="col-md-3 col-lg-3">
                <a href="view-edit.html">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="card-title">
                                <img src="{{ asset('assets/images/user.png') }}" width="70" height="70" alt="user-image">
                            </div>
                            <div class="card-text mt-3">
                                <h5>View / Edit <br> Volunteer Details</h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 col-lg-3">
                <a href="">
                    <div class="card text-center p-3">
                        <div class="card-title mt-2">
                            <img src="{{ asset('assets/images/delete-icon.jpg') }}" width="70" height="70" alt="user-image">
                        </div>
                        <div class="card-text mt-2">
                            <h5>Delete Volunteer</h5>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 col-lg-3">
                <a href="">
                    <div class="card text-center p-3">
                        <div class="card-title mt-2">
                            <img src="{{ asset('assets/images/edit-icon.png') }}" width="70" height="70" alt="user-image">
                        </div>
                        <div class="card-text mt-2">
                            <h5>Edit Batch Details</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-lg-3">
                <a href="">
                    <div class="card text-center p-3">
                        <div class="card-title mt-2">
                            <img src="{{ asset('assets/images/delete-icon.jpg') }}" width="70" height="70" alt="user-image">
                        </div>
                        <div class="card-text mt-2">
                            <h5>Delete Batch</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
