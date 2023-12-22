@extends('layouts/content')
@section('content')
    <div class="container-fluid p-0">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-10">
                <div class="mb-3">
                    <h1 class="h3 d-inline align-middle">Profile</h1>
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Profile Details</h5>
                    </div>
                    <div class="card-body text-center">
                        <img src="img/icons/admin-icon.png" alt="Jhuma Sunuwar" class="img-fluid rounded-circle mb-2"
                            width="128" height="128" />
                        <h5 class="card-title mb-0">Jhuma Sunuwar</h5>
                        <div class="text-muted mb-2">NSS-SMIT Co-ordinator</div>

                        <div>
                            <a class="btn btn-primary btn-sm" href="#"><span data-feather="upload"></span> Upload new
                                photo</a>
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <h5 class="h6 card-title">About</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-1"><span data-feather="home" class="feather-sm me-1"></span> Lives
                                in <a href="#">Majitar, East Sikkim Sikkim</a></li>

                            <li class="mb-1"><span data-feather="briefcase" class="feather-sm me-1"></span>
                                Works at <a href="#">Assistant Professor, CSE, SMIT</a></li>
                            <li class="mb-1"><span data-feather="map-pin" class="feather-sm me-1"></span>
                                From <a href="#">Darjeeling, West Bengal</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
