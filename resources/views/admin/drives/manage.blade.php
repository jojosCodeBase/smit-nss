@extends('layouts/admin-content')
@section('content')
    @if (session('success'))
        <div class="row d-flex justify-content-center">
            <div class="col">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
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
    <div class="container-fluid p-0">
        <h2 class="text-center fw-bold">All Drives</h2>
        <div class="row">
            <div class="col-xl-12 col-xxl-5 d-flex">
                <div class="w-100">
                    <form action="{{ route('drive.search') }}" method="POST">
                        @csrf
                        <div class="row d-flex justify-content-center">
                            <div class="col-12 col-lg-6 col-md-6 col-xl-6">
                                <div class="card p-1">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-10 col-9 mx-lg-0 ps-xl-0 ps-xl-0 ps-0 pe-2">
                                                <input type="search" placeholder="Search by drive title"
                                                    class="form-control" name="search_string">
                                            </div>
                                            <div
                                                class="col-lg- col-2 d-flex justify-content-center mt-lg-0 pe-xl-0 ps-xl-0 pe-0 ps-3">
                                                <input type="submit" class="btn btn-primary" value="Search">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12 col-xxl-9 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="mb-0 h4 text-center fw-bold">Available Records</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>Sl.no</th>
                                    {{-- <th>ID</th> --}}
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
                                        {{-- <td>{{ $d['id'] }}</td> --}}
                                        <td>{{ $d['title'] }}</td>
                                        <td>{{ $d['conductedBy'] }}</td>
                                        <td>{{ $d['area'] }}</td>
                                        <td>{{ $d['date'] }}</td>
                                        <td>
                                            <a data-toggle="collapse" data-target="#collapseItemDesktop{{ $d['id'] }}"
                                                class="toggleBtnDesktop collapse-a" id="collapseToggleBtnDesktop{{ $d['id'] }}" onclick="changeToggleDesktop({{ $d['id'] }})">View</a>
                                            <a data-toggle="collapse" data-target="#collapseItemMobile{{ $d['id'] }}"
                                                class="toggleBtnMobile collapse-a" id="collapseToggleBtnMobile{{ $d['id'] }}" onclick="changeToggleMobile()">View</a>
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
                                                                data-toggle="modal"
                                                                data-target="#editDriveInfoDesktop{{ $d['id'] }}"><i
                                                                    class="bi-pencil-fill"></i>
                                                                Edit</button>
                                                            <button type="button" class="btn btn-danger"
                                                                data-toggle="modal"
                                                                data-target="#deleteModal{{ $d['id'] }}"><i
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
                                    <!-- Edit Modal Desktop -->
                                    <div class="modal fade" id="editDriveInfoDesktop{{ $d['id'] }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                        class="form-control" value="{{ $d['id'] }}"
                                                                        readonly>
                                                                </div>
                                                                <div class="col">
                                                                    <label class="form-label">Drive Date</label>
                                                                    <input type="text" name="date"
                                                                        class="form-control" value="{{ $d['date'] }}">
                                                                </div>
                                                                <div class="col">
                                                                    <label class="form-label">From</label>
                                                                    <input type="text" class="form-control"
                                                                        name="from"
                                                                        value="{{ $d['from'] }}">
                                                                </div>
                                                                <div class="col">
                                                                    <label class="form-label">To</label>
                                                                    <input type="text" class="form-control"
                                                                        name="to"
                                                                        value="{{ $d['to'] }}">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col">
                                                                    <label class="form-label">Drive Title</label>
                                                                    <input type="text" class="form-control"
                                                                        value="{{ $d['title'] }}" name="title">
                                                                </div>
                                                                <div class="col">
                                                                    <label class="form-label">Drive Area</label>
                                                                    <input type="text" class="form-control"
                                                                        name="area" value="{{ $d['area'] }}">
                                                                </div>
                                                                <div class="col">
                                                                    <label class="form-label">Conducted by</label>
                                                                    <input type="text" class="form-control"
                                                                        name="conductedBy" value="{{ $d['conductedBy'] }}">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-4">
                                                                    <label class="form-label">Drive Type</label>
                                                                    <input type="text" class="form-control"
                                                                        name="driveType" value="{{ $d['type'] }}">
                                                                </div>
                                                                <div class="col-4">
                                                                    <label class="form-label">Total Volunteers</label>
                                                                    <input type="number" class="form-control"
                                                                        name="present" value="{{ $d['present'] }}">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <label class="form-label">Description</label>
                                                                    <textarea name="description" id="" cols="30" rows="5" class="form-control">{{ $d['description'] }}</textarea>
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
                                    <!-- Edit Modal Desktop end-->

                                    <!-- Delete Modal Desktop start -->
                                    <div id="deleteModal{{ $d['id'] }}" class="modal fade">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('drive.deleteDetails') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $d['id'] }}">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Delete Drive</h4>
                                                        <button type="button" class="btn-close" data-dismiss="modal"
                                                            aria-label="Close"></button>
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
                                    <!-- Delete Modal Desktop end -->

                                    <!-- Edit Modal Mobile -->
                                    <div class="modal fade" id="editDriveInfoMobile{{ $d['id'] }}" tabindex="-1"
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
                                    </div>
                                    <!-- Edit Modal Mobile end-->
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
