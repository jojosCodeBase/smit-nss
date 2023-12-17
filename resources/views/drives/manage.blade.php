@extends('layouts/content')
@section('content')
    <div class="breadcrumb-bar mb-3 px-4">
        <span class="breadcrumb-item">Home</span>
        <span class="breadcrumb-item">NSS Drives</span>
        <span class="breadcrumb-item active">Manage</span>
    </div>
    <div class="container">
        <div class="row search-row text-center" id="search" style="display: block;">
            <div class="col">
                <h2 class="text-center">All Drives</h2>
                <div class="row">
                    <div class="col d-flex justify-content-center">
                        <div class="input-group w-50">
                            <span class="input-group-text">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" placeholder="Search by drive title" class="form-control"
                                value="IBM Flood">
                            <input type="submit" class="btn btn-primary mx-2" value="Search" onclick="execute()">
                        </div>
                    </div>
                </div>

                <div class="row search-row" id="search" style="display: block;">
                    <div class="col text-start">
                        <div class="row p-2 border-bottom border-top title-table bg-light">
                            <div class="col-1">Sl.no</div>
                            <div class="col-1">ID</div>
                            <div class="col-2">Title</div>
                            <div class="col-2">Conducted by</div>
                            <div class="col-3">Area</div>
                            <div class="col-2">Date</div>
                            <div class="col-1">Action</div>
                        </div>

                        <div class="row p-2 border-bottom align-items-start">
                            <div class="col-1">1.</div>
                            <div class="col-1">006</div>
                            <div class="col-2">IBM, Rangpo, Flood Relief</div>
                            <div class="col-2">Miss Jhuma Sunuwar, Dr. S
                                Visalakshi</div>
                            <div class="col-3">IBM, Rangpo, East Sikkim, Sikkim</div>
                            <div class="col-2">25-10-2023</div>
                            <div class="col-1"><button class="btn btn-primary bi-arrows-angle-expand" id="toggleBtn1"
                                    onclick="changeIcon(1)" type="button" data-toggle="collapse"
                                    data-target="#collapseItem1" aria-expanded="false" aria-controls="collapseItem1">
                                </button>
                            </div>
                        </div>

                        <div class="collapse p-2" id="collapseItem1">
                            Item1
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
                                    <div class="col-2">
                                        <span>Drive Conducted by</span>
                                    </div>
                                    <div class="col-2">
                                        <span>Drive Type</span>
                                    </div>
                                    <div class="col-2">
                                        <span>Total Volunteers</span>
                                    </div>
                                    <div class="col">
                                        <span>Description</span>
                                    </div>
                                </div>
                                <div class="row info">
                                    <div class="col-2"><span>Miss Jhuma Sunuwar, Dr. S
                                            Visalakshi</span></div>
                                    <div class="col-2"><span>Off-campus</span></div>
                                    <div class="col-2"><span>20</span></div>
                                    <div class="col">
                                        <span>
                                            Lorem ipsum dolor sit amet consectetur adipisicing
                                            elit. Laboriosam corporis repellat dignissimos a
                                            quis pariatur quibusdam unde nam, recusandae
                                            exercitationem esse nihil minima, cumque, distinctio
                                            sit labore facilis nulla. Magni nihil libero
                                            inventore non officia aperiam id natus quibusdam ut
                                            harum necessitatibus nisi, dolores exercitationem
                                            facilis est deleniti pariatur unde.
                                        </span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <button type="button" class="btn btn-success" data-toggle="modal"
                                            data-target="#editDriveInfo1"><i class="bi-pencil-fill"></i>
                                            Edit</button>
                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                            data-target="#deleteModal"><i class="bi-trash-fill"></i>
                                            Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Edit Modal -->
    <div class="modal fade" id="editDriveInfo1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label">Drive Id</label>
                                    <input type="number" name="id" class="form-control" value="006">
                                </div>
                                <div class="col">
                                    <label class="form-label">Drive Date</label>
                                    <input type="text" name="date" class="form-control" value="25-10-2023">
                                </div>
                                <div class="col">
                                    <label class="form-label">Time</label>
                                    <input type="text" class="form-control" name="time"
                                        value="10:00 AM - 01:00 PM">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label">Drive Title</label>
                                    <input type="text" class="form-control" value="IBM, Rangpo Flood Relief"
                                        name="time">
                                </div>
                                <div class="col">
                                    <label class="form-label">Drive Area</label>
                                    <input type="text" class="form-control" name="area"
                                        value="IBM, Rangpo, East Sikkim, Sikim">
                                </div>
                                <div class="col">
                                    <label class="form-label">Conducted by</label>
                                    <input type="text" class="form-control" name="conductor"
                                        value="Miss Jhuma Sunuwar, Dr. S Visalakshi">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4">
                                    <label class="form-label">Drive Type</label>
                                    <input type="number" class="form-control" name="type" value="Off-campus">
                                </div>
                                <div class="col-4">
                                    <label class="form-label">Total Volunteers</label>
                                    <input type="text" class="form-control" name="total" name="20">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label class="form-label">Description</label>
                                    <textarea name="" id="" cols="30" rows="5" class="form-control">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam corporis repellat dignissimos a quis pariatur quibusdam unde nam, recusandae exercitationem esse nihil minima, cumque, distinctio sit labore facilis nulla. Magni nihil libero inventore non officia aperiam id natus quibusdam ut harum necessitatibus nisi, dolores exercitationem facilis est deleniti pariatur unde.</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    <!-- Edit Modal end-->

    <!-- Delete Modal start -->
    <div id="deleteModal" class="modal fade">
        <div class="modal-dialog modal-message-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Drive</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this drive records?</p>
                        <p class="text-danger f-5"><small>This action cannot be undone.</small></p>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-danger" value="Delete">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Delete Modal end -->
@endsection
