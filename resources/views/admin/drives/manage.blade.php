@extends('layouts/admin-content')
@section('breadcrumb', 'Manage Drive')
@section('content')
@include('include/alerts')
    <div class="container-fluid p-0">
        <h2 class="text-center fw-bold">All Drives</h2>
        <div class="row">
            <div class="col-xl-8 offset-xl-2 col-md-10 offset-md-2">
                <div class="row">
                    <div class="col-lg-10 col-md-10 col-xl-12">
                        <form action="{{ route('drive.search') }}" method="POST">
                            @csrf
                            <div class="card p-1">
                                <div class="card-body">
                                    <div class="row">
                                        <div
                                            class="col-lg-10 col-md-10 col-12 mx-lg-0 ps-xl-0 ps-xl-0 ps-lg-0 ps-md-0 pe-lg-2 pe-md-2">
                                            <input type="search" placeholder="Search by drive title" class="form-control"
                                                name="search_string" required>
                                        </div>
                                        <div
                                            class="col-lg-2 col-md-2 col-12 d-flex justify-content-center mt-lg-0 mt-lg-0 mt-2 mt-md-0 pe-xl-0 ps-xl-0 pe-lg-0 pe-md-0 ps-lg-3 ps-md-3">
                                            <input type="submit" class="btn btn-primary w-100" value="Search">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12 col-xl-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="mb-0 h4 text-center fw-bold">Available Records</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>Sl.no</th>
                                    <th>Title</th>
                                    <th>Conducted by</th>
                                    <th>Area</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($drives as $d)
                                    @php
                                        $slno = $loop->iteration;
                                    @endphp
                                    <tr>
                                        <td class="text-center">{{ $slno }}</td>
                                        <td>{{ $d['title'] }}</td>
                                        <td>{{ $d['conductedBy'] }}</td>
                                        <td>{{ $d['area'] }}</td>
                                        <td>{{ $d['date'] }}</td>
                                        <td>
                                            <a data-toggle="collapse" data-target="#collapseItemDesktop{{ $d['id'] }}"
                                                class="toggleBtnDesktop collapse-a"
                                                id="collapseToggleBtnDesktop{{ $d['id'] }}"
                                                onclick="changeToggleDesktop({{ $d['id'] }})">View</a>
                                            <a data-toggle="collapse" data-target="#collapseItemMobile{{ $d['id'] }}"
                                                class="toggleBtnMobile collapse-a"
                                                id="collapseToggleBtnMobile{{ $d['id'] }}"
                                                onclick="changeToggleMobile()">View</a>
                                        </td>
                                    </tr>
                                    <tr id="trCollapse{{ $d['id'] }}" style="display: none">
                                        <td colspan="7">
                                            <div class="collapse p-2 collapseItemDesktop"
                                                id="collapseItemDesktop{{ $d['id'] }}">
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
                                                            <span>{{ $d['id'] }}</span>
                                                        </div>
                                                        <div class="col-2">
                                                            <span>{{ $d['date'] }}</span>
                                                        </div>
                                                        <div class="col-2">
                                                            <span>{{ $d['from'] }} - {{ $d['to'] }}</span>
                                                        </div>
                                                        <div class="col">
                                                            <span>{{ $d['title'] }}</span>
                                                        </div>
                                                        <div class="col">
                                                            <span>{{ $d['area'] }}</span>
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
                                                        <div class="col-2"><span>{{ $d['conductedBy'] }}</span></div>
                                                        <div class="col-2"><span>{{ $d['type'] }}</span></div>
                                                        <div class="col-2"><span>{{ $d['present'] }}</span></div>
                                                        <div class="col">
                                                            <span>{{ $d['description'] }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col">
                                                            <button type="button" class="btn btn-success"
                                                                data-toggle="modal" data-target="#editDriveInfoDesktop"
                                                                onclick="driveEditModalInit({{ $d['id'] }})"><i
                                                                    class="bi-pencil-fill"></i>
                                                                Edit</button>
                                                            <button type="button" class="btn btn-danger"
                                                                data-toggle="modal" data-target="#deleteModal" onclick="driveDeleteModalInit({{ $d['id'] }})"><i
                                                                    class="bi-trash-fill"></i>
                                                                Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="collapse p-2 collapseItemMobile"
                                                id="collapseItemMobile{{ $d['id'] }}">
                                                <div class="col justify-content-start bg-light p-3">
                                                    <h4 class="text-center">Drive Info</h4>
                                                    <div class="row mb-2">
                                                        <div class="col">
                                                            <div class="title">Drive Id</div>
                                                            <div class="info">{{ $d['id'] }}</div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="title">Drive Date</div>
                                                            <div class="info">{{ $d['date'] }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col">
                                                            <div class="title">Time</div>
                                                            <span>{{ $d['from'] }} - {{ $d['to'] }}</span>
                                                        </div>

                                                        <div class="col">
                                                            <div class="title">Drive Title</div>
                                                            <div class="info">{{ $d['title'] }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col">
                                                            <div class="title">Drive Area</div>
                                                            <div class="info">{{ $d['area'] }}</div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="title">Conducted by</div>
                                                            <div class="info">{{ $d['conductedBy'] }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col">
                                                            <div class="title">Drive Type</div>
                                                            <div class="info">{{ $d['type'] }}</div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="title">Total Volunteers</div>
                                                            <div class="info">{{ $d['present'] }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col">
                                                            <div class="title">Description</div>
                                                            <div class="info">{{ $d['description'] }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col">
                                                            <button type="button" class="btn btn-success"
                                                                data-toggle="modal"
                                                                data-target="#editDriveInfoMobile{{ $d['id'] }}"><i
                                                                    class="bi-pencil-fill"></i>
                                                                Edit</button>
                                                            <button type="button" class="btn btn-danger"
                                                                data-toggle="modal" data-target="#{{ $d['id'] }}"><i
                                                                    class="bi-trash-fill"></i>
                                                                Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Modal Desktop -->
    <div class="modal fade" id="editDriveInfoDesktop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Drive Info</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('drive.updateDetails') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label">Drive Id</label>
                                    <input type="number" name="id" id="drive-id" class="form-control"
                                        value="" readonly>
                                </div>
                                <div class="col">
                                    <label class="form-label">Drive Date</label>
                                    <input type="text" name="date" id="drive-date" class="form-control"
                                        value="" required>
                                </div>
                                <div class="col">
                                    <label class="form-label">From</label>
                                    <input type="time" class="form-control" id="drive-from" name="from"
                                        value="" required>
                                </div>
                                <div class="col">
                                    <label class="form-label">To</label>
                                    <input type="time" class="form-control" name="to" id="drive-to"
                                        value="" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label">Drive Title</label>
                                    <input type="text" class="form-control" value="" name="title"
                                        id="drive-title" required>
                                </div>
                                <div class="col">
                                    <label class="form-label">Drive Area</label>
                                    <input type="text" class="form-control" name="area" value=""
                                        id="drive-area" required>
                                </div>
                                <div class="col">
                                    <label class="form-label">Conducted by</label>
                                    <input type="text" class="form-control" name="conductedBy"
                                        id="drive-conducted-by" value="" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4">
                                    <label class="form-label">Drive Type</label>
                                    <input type="text" class="form-control" name="driveType" id="drive-type"
                                        value="" required>
                                </div>
                                <div class="col-4">
                                    <label class="form-label">Total Volunteers</label>
                                    <input type="text" class="form-control" name="present" id="drive-attended-by"
                                        value="" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" cols="30" rows="5" class="form-control"
                                        id="drive-description" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Modal Desktop end-->

    <!-- Delete Modal Desktop start -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('drive.delete') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        @method('delete')
                        <div class="form-row mb-2">
                            <div class="col">
                                <div class="d-flex justify-content-center">
                                    <i class="rounded-circle bi bi-exclamation-triangle-fill text-warning"
                                        style="font-size: 50px;"></i>
                                </div>
                                <h4 class="text-center text-dark">Delete Drive</h6>
                                    <p class="text-danger text-center">Are you sure you want to delete this drive ?
                                        This
                                        action cannot be undone.</p>
                                    <input type="number" id="volunteer-regno" name="regno" hidden>
                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-secondary w-25 me-5"
                                            data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger w-25">Yes, delete !</button>
                                    </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Delete Modal Desktop end -->

    <!-- Edit Modal Mobile -->
    {{-- <div class="modal fade" id="editDriveInfoMobile" tabindex="-1"
        role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Drive Info</h5>
                    <button type="button" class="btn-close" data-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action="{{ route('drive.updateDetails') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label">Drive Id</label>
                                    <input type="number" name="id"
                                        class="form-control" value="006">
                                </div>
                                <div class="col">
                                    <label class="form-label">Drive Date</label>
                                    <input type="text" name="date"
                                        class="form-control" value="25-10-2023">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label">Time</label>
                                    <input type="text" class="form-control"
                                        name="time" value="10:00 AM - 01:00 PM">
                                </div>
                                <div class="col">
                                    <label class="form-label">Total Volunteers</label>
                                    <input type="text" class="form-control"
                                        name="total" name="20">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label">Drive Title</label>
                                    <input type="text" class="form-control"
                                        value="IBM, Rangpo Flood Relief" name="time">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label">Drive Area</label>
                                    <input type="text" class="form-control"
                                        name="area"
                                        value="IBM, Rangpo, East Sikkim, Sikim">
                                </div>
                                <div class="col">
                                    <label class="form-label">Conducted by</label>
                                    <input type="text" class="form-control"
                                        name="conductor"
                                        value="Miss Jhuma Sunuwar, Dr. S Visalakshi">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label">Drive Type</label>
                                    <input type="number" class="form-control"
                                        name="type" value="Off-campus">
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
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
    <!-- Edit Modal Mobile end-->
@endsection
