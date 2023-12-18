@extends('layouts/content')
@section('content')
    <div class="breadcrumb-bar mb-3 px-4">
        <span class="breadcrumb-item">Home</span>
        <span class="breadcrumb-item">NSS Drives</span>
        <span class="breadcrumb-item active">Attendance</span>
    </div>
    <div class="container mb-5">
        <h2 class="text-center">NSS Drive Attendance</h2>
        <div class="row search-row mb-5">
            <div class="col d-flex justify-content-center">
                <div class="input-group w-50">
                    <span class="input-group-text">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" placeholder="Search by drive title" class="form-control" value="IBM Flood">
                    <input type="submit" class="btn btn-primary mx-2" value="Search">
                </div>
            </div>
        </div>

        <!-- search result show section start -->
        <div class="row" id="search" style="display: block;">
            <div class="col text-start">
                <div class="row p-2 border-bottom border-top title-table bg-light">
                    <div class="col-1">Sl.no</div>
                    <div class="col-1">ID</div>
                    <div class="col-2">Title</div>
                    <div class="col-2">Updated by</div>
                    <div class="col-2">Area</div>
                    <div class="col-2">Date</div>
                    <div class="col-1">Present</div>
                    <div class="col-1">Action</div>
                </div>

                <div class="row p-2 border-bottom align-items-start">
                    <div class="col-1">1.</div>
                    <div class="col-1">006</div>
                    <div class="col-2">IBM, Rangpo, Flood Relief</div>
                    <div class="col-2">Swayam Singh</div>
                    <div class="col-2">IBM, Rangpo, East Sikkim, Sikkim</div>
                    <div class="col-2">25-10-2023</div>
                    <div class="col-1">25</div>
                    <div class="col-1"><button class="btn btn-primary bi-arrows-angle-expand" id="toggleBtn1"
                            onclick="changeIcon(1)" type="button" data-toggle="collapse" data-target="#collapseItem1"
                            aria-expanded="false" aria-controls="collapseItem1">
                        </button>
                    </div>
                </div>
                <div class="collapse p-2" id="collapseItem1">
                    <div class="col justify-content-start bg-light p-3">
                        <div class="row title">
                            <div class="col-2">
                                <span>Drive Id</span>
                            </div>
                            <div class="col-2">
                                <span>Drive Date</span>
                            </div>
                            <div class="col-2">
                                <span>Time</span>
                            </div>
                            <div class="col">
                                <span>Drive Title</span>
                            </div>
                            <div class="col">
                                <span>Drive Area</span>
                            </div>
                        </div>
                        <div class="row info">
                            <div class="col-2">
                                <span>006</span>
                            </div>
                            <div class="col-2">
                                <span>23-10-2023</span>
                            </div>
                            <div class="col-2">
                                <span>10:00 AM - 01:00 PM</span>
                            </div>
                            <div class="col">
                                <span>IBM, Rangpo, Flood Relief</span>
                            </div>
                            <div class="col">
                                <span>IBM, Rangpo, East Sikkim, Sikkim</span>
                            </div>
                        </div>
                        <div class="row title">
                            <div class="col">
                                <span>Drive Conducted by</span>
                            </div>
                            <div class="col-3">
                                <span>Drive Type</span>
                            </div>
                            <div class="col-3">
                                <span>Total Volunteers</span>
                            </div>
                        </div>
                        <div class="row info mb-4">
                            <div class="col"><span>Miss Jhuma Sunuwar, Dr. S
                                    Visalakshi</span></div>
                            <div class="col-3"><span>Off-campus</span></div>
                            <div class="col-3"><span>20</span></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <h6>Volunteers Present</h6>
                            </div>
                            <div class="col d-flex justify-content-end">
                                <button class="btn btn-success mx-2" data-toggle="modal"
                                    data-target="#addAttendanceModal"><i class="bi-plus-circle"></i> Add
                                    Attendance</button>
                                <button class="btn btn-danger"><i class="bi-dash-circle"></i> Delete</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <table class="table table-striped" id="myTable">
                                    <thead>
                                        <th><span><input type="checkbox" id="selectAll"></span></th>
                                        <th>Sl.no</th>
                                        <th>Reg.no</th>
                                        <th>Name</th>
                                        <th>Department</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><span><input type="checkbox"></span></td>
                                            <td>1.</td>
                                            <td>202116033</td>
                                            <td>Kunsang Moktan</td>
                                            <td>Computer Applications</td>
                                        </tr>
                                        <tr>
                                            <td><span><input type="checkbox"></span></td>
                                            <td>1.</td>
                                            <td>202116033</td>
                                            <td>Kunsang Moktan</td>
                                            <td>Computer Applications</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- search result show section end -->
    </div>
    <!-- Attendance Add Modal start -->
    <div id="addAttendanceModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Add Attendance</h4>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="" class="form-label">Drive Id</label>
                            <input type="number" class="form-control" name="id" value="006" disabled>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Drive Title</label>
                            <input type="text" class="form-control" name="title" value="IBM, Rangpo, Flood Relief"
                                disabled>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Drive Date</label>
                            <input type="text" class="form-control" name="date" value="25-10-2023" disabled>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Registration no</label>
                            <input type="text" class="form-control" name="regno">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Name</label>
                            <input type="text" class="form-control" name="regno">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="button" class="btn btn-success" value="Add" onclick="sweetAlert()">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Attendance Add Modal end -->
@endsection
