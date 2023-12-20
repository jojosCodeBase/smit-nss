@extends('layouts/content')
@section('content')
    <div class="breadcrumb-bar mb-3 px-4">
        <span class="breadcrumb-item">Home</span>
        <span class="breadcrumb-item">NSS Drives</span>
        <span class="breadcrumb-item active">Add</span>
    </div>
    @if (session('success'))
        <div class="row d-flex justify-content-center">
            <div class="col">
                <div class="alert alert-sucess alert-dismissible fade show" role="alert">
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
    <div class="container addForm">
        <div class="row d-flex justify-content-center bg-light">
            <div class="col-11 mt-4">
                <div class="col d-flex justify-content-center mb-3">
                    <div class="underline-heading text-center">
                        <h3>Add New Drive</h3>
                    </div>
                </div>
                <div class="text-left"><b>Drive ID: </b><span>{{ $id }}</span></div>
                <form action="{{ route('drive.add') }}" class="form mb-5" method="POST">
                    @csrf
                    <input type="number" name="id" value="{{ $id }}" hidden>
                    <div class="row mt-3">
                        <div class="col-md-4 col-lg-4">
                            <input type="text" name="title" id="drive-title" class="form-control"
                                placeholder="Drive title" required>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <input type="date" name="date" class="form-control" required>
                        </div>
                        <div class="col-md-2 col-lg-2">
                            <input type="text" name="time-from" class="form-control" placeholder="Start time">
                        </div>
                        <div class="col-md-2 col-lg-2">
                            <input type="text" name="time-to" class="form-control" placeholder="End time">
                        </div>
                        <div class="col-md-3 col-lg-4">
                            <input type="text" name="conductedBy" class="form-control" placeholder="Conducted by" required>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-4 col-lg-4">
                            <select name="driveType" id="" class="form-select" required>
                                <option value="" selected>Select drive type from list</option>
                                <option value="regular">Regular NSS Activities</option>
                                <option value="cleanliness">Cleanliness Drive</option>
                            </select>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <input type="text" name="area" class="form-control" placeholder="Area" required>
                        </div>
                        <div class="col-md-3 col-lg-2">
                            <input type="number" name="present" class="form-control" placeholder="Present">
                        </div>
                        <div class="col-md-3 col-lg-2">
                            <input type="number" name="absent" class="form-control" placeholder="Absent">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label class="form-label">Description</label>
                            <textarea name="description" id="" cols="30" rows="6" class="form-control description"></textarea>
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
