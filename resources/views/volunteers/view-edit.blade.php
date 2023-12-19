@extends('layouts/content')
@section('content')
    <div class="breadcrumb-bar mb-3 px-4">
        <span class="breadcrumb-item">Home</span>
        <span class="breadcrumb-item">Volunteers</span>
        <span class="breadcrumb-item">Manage</span>
        <span class="breadcrumb-item active">View/Edit Volunteer Details</span>
    </div>
    @if (session('fail'))
        <div class="row d-flex justify-content-center">
            <div class="col">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <b>{{ session('fail') }}</b>
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
    <div class="container">
        <div class="row search-row" id="search" style="display: block;">
            <div class="col">
                <h2 class="text-center">Search Volunteer View-edit</h2>
                <div class="row">
                    <div class="col d-flex justify-content-center">
                        <form action="{{ route('volunteer.view-details') }}" method="POST" class="input-group w-50">
                            @csrf
                            <span class="input-group-text">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" name="search_string" placeholder="Search by name or registration number"
                                class="form-control" required>
                            <input type="submit" class="btn btn-primary mx-2" value="Search">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
