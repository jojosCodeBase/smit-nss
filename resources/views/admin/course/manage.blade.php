@extends('layouts/admin-content')
@section('title', 'Manage Courses')
@section('breadcrumb', 'Manage Courses')
@section('content')

@section('content')
    <div class="container-fluid mb-2">
        @include('include/alerts')
    </div>

    <div class="container-fluid p-lx-3 p-lg-3 p-md-3 pt-0">
        {{-- <h3 class="text-muted mb-4 mt-1">All Subjects</h3> --}}
        <div class="card" style="margin-bottom: 120px">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-3 col-6 ">
                        <h4 class="text-custom">All Courses</h4>
                    </div>
                    <div class="col-xl-7 col-md-12 col-12 order-3 order-xl-0 mt-3 mt-xl-0">
                        <div class="row d-flex justify-content-xl-end">
                            <div class="col-xl-8 col-12">
                                <div class="input-group">
                                    <input type="search" name="" id="searchInput"
                                        placeholder="Search by Course Name" class="form-control">
                                    <span class="input-group-text bg-transparent"><i class="bi bi-search"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-6 d-flex justify-content-end justify-content-xl-start">
                        <button class="btn btn-primary"data-bs-toggle="modal" data-bs-target="#addSubjectModal"></i>Add
                            Course
                        </button>
                    </div>
                </div>
                <div class="mt-4 table-responsive" id="table">
                    <table class="table table-hover">
                        <thead>
                            <th>Sl.no</th>
                            <th>Course</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($courses as $index => $course)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $course->name }}</td>
                                    <td>
                                        <div class="more-btn">
                                            <button class="dropdown" type="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="bi bi-three-dots fs-4"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <button class="dropdown-item editButton" type="button"
                                                        data-bs-toggle="modal" data-bs-target="#editCourseModal"
                                                        data-course-id="{{ $course->id }}"
                                                        data-course-name="{{ $course->name }}">Edit</button>
                                                </li>
                                                <li>
                                                    <button class="dropdown-item deleteBtn" type="button"
                                                        data-bs-toggle="modal" data-bs-target="#deleteSubjectModal"
                                                        data-course-id="{{ $course->id }}">Delete</button>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $courses->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- Add-course modal start --}}
    <div class="modal fade" id="addSubjectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-custom" id="exampleModalLabel">Add Course</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.add-course') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="col-12 mb-3">
                            <label class="form-label">Course Name</label>
                            <input type="text" name="course" class="form-control" required>
                            <div class="invalid-feedback">
                                Please enter course
                            </div>
                        </div>
                        <div class="modal-footer Custom_Footer my-1 d-flex justify-content-end pe-2 mb-0">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Add-Course modal end --}}

    {{-- Edit-Course modal start --}}
    <div class="modal fade" id="editCourseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-custom" id="exampleModalLabel">Edit Course Info</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.update-course') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label">Course Name</label>
                            <input type="text" name="course_id" id="edit-course_id" hidden>
                            <input type="text" name="course" class="form-control" id="edit-course">
                            <div class="invalid-feedback">
                                Please enter course
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer  my-1 d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Edit-Course modal end --}}

    {{-- Delete-Course modal start --}}
    <div class="modal fade" id="deleteSubjectModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row d-flex justify-content-center">
                        <div class="col-6 d-flex justify-content-center">
                            <i class="rounded-circle bi bi-exclamation-triangle-fill text-warning fs-1"></i>
                        </div>
                    </div>

                    <h4 class="text-center text-custom">Delete Course</h4>

                    <p class="text-danger fs-6 text-center">Are you sure you want to delete this Course? <br>This
                        action cannot be undone</p>

                    <form action="{{ route('admin.delete-course') }}" method="POST">
                        @csrf
                        @method('delete')
                        <input type="text" id="cid" name="cid" hidden>
                        <div class="row d-flex justify-content-center">
                            <div class="col-8 d-flex justify-content-center mb-3">
                                <button type="button" class="btn btn-secondary me-4"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button class="btn btn-danger">Yes, Delete !</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Delete-Course modal end --}}
@endsection
@section('scripts')
    <script>
        $('.editButton').on('click', function() {
            $('#edit-course').val($(this).data('course-name'));
            $('#edit-course_id').val($(this).data('course-id'));
        });


        $('.deleteBtn').on('click', function() {
            $('#cid').val($(this).data('course-id'));
        });
    </script>
@endsection
