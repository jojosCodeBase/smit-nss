@extends('layouts/user-content')
@section('content')
<div class="container-fluid p-0 mt-0">
    <h1>USER PANEL</h1>
    <div class="row">
        <div class="col-xl-12 col-xxl-5 d-flex">
            <div class="w-100">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Volunteers</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="users"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">120</h1>
                                <div class="mb-0">
                                    <span class="text-muted">2022-24: <span class="text-success"> 30</span> / 2022-25: <span class="text-success"> 42</span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Drives</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="activity"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">14</h1>
                                <div class="mb-0">
                                    <span class="text-muted">Since 2023</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-12 col-xxl-9 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <h5 class="card-title mb-0">Recent Activities</h5>
                </div>
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Description</th>
                            <th class="d-none d-xl-table-cell">Area</th>
                            <th class="d-none d-xl-table-cell">Present</th>
                            <th class="d-none d-md-table-cell">Cordinator</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td class="d-none d-xl-table-cell">IBM, Rangpo, Sikkim</td>
                            <td >Cleanliness drive conducted at Rangpo IBM to help flood effected victims.</td>
                            <td class="d-none d-xl-table-cell">15</td>
                            <td class="d-none d-md-table-cell">Jhuma Sunuwar</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
