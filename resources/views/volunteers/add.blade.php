@extends('layouts/content')
@section('content')
    <div class="breadcrumb-bar mb-3 px-4">
        <span class="breadcrumb-item">Home</span>
        <span class="breadcrumb-item">Volunteers</span>
        <span class="breadcrumb-item active">Add</span>
    </div>
    <div class="container addForm">
        <div class="row d-flex justify-content-center mt-5 bg-light">
            <div class="col-11 mt-5 px-0 mb-5">
                <div class="col d-flex justify-content-center mb-5">
                    <div class="underline-heading text-center">
                        <h3>Add New Volunteer</h3>
                    </div>
                </div>
                <form action="" class="form mb-0">
                    <div class="row mt-3 p-0 px-0">
                        <div class="col-md-4 col-lg-4">
                            <!-- <label class="form-label">Name</label> -->
                            <input type="text" name="name" class="form-control" placeholder="Name*">
                        </div>
                        <div class="col-md-3 col-lg-4">
                            <!-- <label class="form-label">Registration no</label> -->
                            <input type="text" name="regno" class="form-control" maxlength="9" pattern="[0-9]+"
                                placeholder="Registration no*">
                        </div>
                        <div class="col-md-3 col-lg-4">
                            <!-- <label class="form-label">Email</label> -->
                            <input type="email" name="email" class="form-control" placeholder="Email*">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4 col-lg-4">
                            <!-- <label class="form-label">Phone</label> -->
                            <input type="number" name="phone" class="form-control" placeholder="Phone*">
                        </div>
                        <div class="col-md-3 col-lg-4">
                            <!-- <label class="form-label">Department</label> -->
                            <select name="department" id="" class="form-select">
                                <option value="" selected>Select department from list</option>
                                <option value="">Department of Computer Applications</option>
                                <option value="">Department of Civil Enginieering</option>
                                <option value="">Department of Computer Science Enginieering</option>
                                <option value="">Department of Mechnical Engineering</option>
                                <option value="">Department of Information Technology</option>
                                <option value="">Department of Electrical and Electronics Engineering
                                </option>
                                <option value="">Department of Electronics and Communication Engineering
                                </option>
                                <option value="">Department of Artificial Intelligence and Data Science
                                </option>
                                <option value="">Department of Management Studies</option>
                                <option value="">Department of Mathematics</option>
                                <option value="">Department of Chemistry</option>
                                <option value="">Department of Physics</option>
                                <option value="">Department of Physical Education</option>
                            </select>
                        </div>
                        <div class="col-md-3 col-lg-4">
                            <!-- <label class="form-label">Course</label> -->
                            <select name="course" id="" class="form-select">
                                <option value="" selected>Select course from list</option>
                                <option value="">MBA</option>
                                <option value="">MCA</option>
                                <option value="">M.Sc</option>
                                <option value="">BTech</option>
                                <option value="">BCA</option>
                                <option value="">BBA</option>
                                <option value="">B.Sc</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4 col-lg-4">
                            <!-- <label class="form-label">Batch</label> -->
                            <select name="batch" id="" class="form-select">
                                <option value="" selected>Select batch from list</option>
                                <option value="">2022-24</option>
                                <option value="">2023-25</option>
                            </select>
                        </div>
                    </div>
                    <div class="col text-center mt-4">
                        <input type="submit" class="btn btn-primary w-25" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
