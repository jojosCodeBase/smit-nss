@extends('layouts/admin-content')
@section('breadcrumb', 'Moderator Details')
@section('content')
    <div class="container-fluid">
        @include('include/alerts')
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2 d-flex justify-content-center">
                                <img src="{{ asset('assets/img/icons/user-icon.png') }}" width="70" height="70"
                                    alt="user-image">
                            </div>
                            <div class="col">
                                <div class="name mb-1">
                                    <span>Name: </span>
                                    <span>{{ $details['name'] }}</span>
                                </div>
                                @if ($details['status'] == 1)
                                <span>Status: </span>
                                <div class="badge bg-success">
                                    <span><i class="bi-person-fill-check"></i> Active</span>
                                </div>
                                @else
                                <span>Status: </span>
                                <div class="badge bg-danger">
                                    <span><i class="bi-person-fill-check"></i> In-active</span>
                                </div>
                                @endif
                                <div class="name mb-1">
                                    <span>Email: </span>
                                    <span>{{ $details['email'] }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col d-flex justify-content-between">
                                <button type="button" class="btn btn-info"><i class="bi bi-ban"></i> Block</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
