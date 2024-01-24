@extends('layouts/admin-content')
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
    <div class="container-fluid p-0">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Add New Volunteer</div>
                <form action="">
                    <div class="row mt-3 p-0 px-0">
                        <div class="col-md-4 col-lg-4 mb-lg-0 mg-md-0 mb-2">
                            <input type="text" name="name" class="form-control" placeholder="Name*">
                        </div>
                        <div class="col-md-3 col-lg-4 mg-md-0 mb-2">
                            <input type="text" name="regno" class="form-control" maxlength="9" pattern="[0-9]+"
                                placeholder="Registration no*">
                        </div>
                        <div class="col-md-3 col-lg-4 mg-md-0 mb-2">
                            <input type="email" name="email" class="form-control" placeholder="Email*">
                        </div>
                    </div>
                    <div class="row mt-lg-3">
                        <div class="col-md-4 col-lg-4 mg-md-0 mb-2">
                            <input type="number" name="phone" class="form-control" placeholder="Phone*">
                        </div>
                        <div class="col-md-3 col-lg-4 mg-md-0 mb-2">
                            <select name="course" id="" class="form-select">
                                <option value="" selected>Select course from list</option>
                                <option value="">MBA</option>
                                <option value="">MCA</option>
                                <option value="">M.Sc</option>
                                <option value="">BTech</option>
                                <option value="">BCA</option>
                                <option value="">BBA</option>
                                <option value="">B.Sc</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-lg-3">
                        <div class="col-md-4 col-lg-4">
                            <select name="batch" id="" class="form-select">
                                <option value="" selected>Select batch from list</option>
                                <option value="">2022-24</option>
                                <option value="">2023-25</option>
                            </select>
                        </div>
                    </div>
                    <div class="col text-center mt-3">
                        <input type="submit" class="btn btn-primary w-25" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
