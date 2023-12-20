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
                            <input type="text" placeholder="Search by drive title" class="form-control">
                            <input type="submit" class="btn btn-primary mx-2" value="Search">
                        </div>
                    </div>
                </div>

                <div class="row details-row mt-5  d-flex justify-content-center">
                    <div class="col p-4 mx-4 border mb-4 bg-light">
                        <div class="row">
                            <h4 class="text-center mb-3">Available Records</h4>
                            <div class="col text-start">
                                <div class="row p-2 border-bottom border-top title-table">
                                    <div class="col-1">Sl.no</div>
                                    <div class="col-1">ID</div>
                                    <div class="col-2">Title</div>
                                    <div class="col-2">Conducted by</div>
                                    <div class="col-3">Area</div>
                                    <div class="col-2">Date</div>
                                    <div class="col-1">Action</div>
                                </div>

                                @foreach ($drives as $d)
                                    @php
                                        $slno = $loop->iteration;
                                    @endphp
                                    <div class="row p-2 border-bottom align-items-start">
                                        <div class="col-1">{{ $slno }}</div>
                                        <div class="col-1">{{ $d->id }}</div>
                                        <div class="col-2">{{ $d->title }}</div>
                                        <div class="col-2">{{ $d->conductedBy }}</div>
                                        <div class="col-3">{{ $d->area }}</div>
                                        <div class="col-2">{{ $d->date }}</div>
                                        <div class="col-1"><button class="btn btn-primary bi-arrows-angle-expand"
                                                id="toggleBtn1" onclick="changeIcon(1)" type="button"
                                                data-toggle="collapse" data-target="#collapseItem{{ $d->id }}"
                                                aria-expanded="false" aria-controls="collapseItem">
                                            </button>
                                        </div>
                                    </div>

                                    <div class="collapse p-2 border mt-2 mb-2" id="collapseItem{{ $d->id }}">
                                        <div class="col justify-content-start bg-light">
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
                                            <div class="row info mt-1">
                                                <div class="col-2">
                                                    <span>{{ $d->id }}</span>
                                                </div>
                                                <div class="col-2">
                                                    <span>{{ $d->date }}</span>
                                                </div>
                                                <div class="col-2">
                                                    <span>{{ $d->from }} - {{ $d->to }}</span>
                                                </div>
                                                <div class="col">
                                                    <span>{{ $d->title }}</span>
                                                </div>
                                                <div class="col">
                                                    <span>{{ $d->area }}</span>
                                                </div>
                                            </div>
                                            <div class="row title mt-3">
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
                                            <div class="row info mt-1">
                                                <div class="col-2"><span>{{ $d->conductedBy }}</span></div>
                                                <div class="col-2"><span>{{ $d->type }}</span></div>
                                                <div class="col-2"><span>{{ $d->present }}</span></div>
                                                <div class="col">
                                                    <span>{{ $d->description }}</span>
                                                </div>
                                            </div>
                                            <div class="row mt-2 mb-2">
                                                <div class="col">
                                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                                        data-target="#editDriveInfo{{ $d->id }}"><i
                                                            class="bi-pencil-fill"></i>
                                                        Edit</button>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                                        data-target="#deleteModal{{ $d->id }}"><i
                                                            class="bi-trash-fill"></i>
                                                        Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editDriveInfo{{ $d->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                    <button type="button" class="btn-close" data-dismiss="modal"
                                                        aria-hidden="true"></button>
                                                </div>
                                                <form action="">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <div class="row mb-3">
                                                                <div class="col">
                                                                    <label class="form-label">Drive Id</label>
                                                                    <input type="number" name="id"
                                                                        class="form-control" value="{{ $d->id }}">
                                                                </div>
                                                                <div class="col">
                                                                    <label class="form-label">Drive Date</label>
                                                                    <input type="text" name="date"
                                                                        class="form-control" value="{{ $d->date }}">
                                                                </div>
                                                                <div class="col">
                                                                    <label class="form-label">Time</label>
                                                                    <input type="text" class="form-control"
                                                                        name="time"
                                                                        value="{{ $d->from }} - {{ $d->to }}">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col">
                                                                    <label class="form-label">Drive Title</label>
                                                                    <input type="text" class="form-control"
                                                                        value="{{ $d->title }}" name="title">
                                                                </div>
                                                                <div class="col">
                                                                    <label class="form-label">Drive Area</label>
                                                                    <input type="text" class="form-control"
                                                                        name="area" value="{{ $d->area }}">
                                                                </div>
                                                                <div class="col">
                                                                    <label class="form-label">Conducted by</label>
                                                                    <input type="text" class="form-control"
                                                                        name="conductor" value="{{ $d->conductedBy }}">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-4">
                                                                    <label class="form-label">Drive Type</label>
                                                                    <input type="number" class="form-control"
                                                                        name="type" value="{{ $d->type }}">
                                                                </div>
                                                                <div class="col-4">
                                                                    <label class="form-label">Total Volunteers</label>
                                                                    <input type="text" class="form-control"
                                                                        name="total" value="{{ $d->present }}">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <label class="form-label">Description</label>
                                                                    <textarea name="" id="" cols="30" rows="5" class="form-control">{{ $d->description }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Edit Modal end-->

                                    <!-- Delete Modal start -->
                                    <div id="deleteModal{{ $d->id }}" class="modal fade">
                                        <div class="modal-dialog modal-message-dialog">
                                            <div class="modal-content">
                                                <form>
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Delete Drive</h4>
                                                        <button type="button" class="btn-close" data-dismiss="modal"
                                                            aria-hidden="true"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to delete this drive records?</p>
                                                        <p class="text-danger f-5"><small>This action cannot be
                                                                undone.</small></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="button" class="btn btn-default"
                                                            data-dismiss="modal" value="Cancel">
                                                        <input type="submit" class="btn btn-danger" value="Delete">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Delete Modal end -->
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
