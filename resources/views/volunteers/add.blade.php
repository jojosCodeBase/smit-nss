@extends('layouts/content')
@section('content')
    <div class="breadcrumb-bar mb-3 px-4">
        <span class="breadcrumb-item">Home</span>
        <span class="breadcrumb-item">Volunteers</span>
        <span class="breadcrumb-item active">Add</span>
    </div>
    <div class="container addForm">
        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span>New Volunteer Added Successfully !</span>
                <button type="button" class="btn-close " data-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span>{{ session('error') }}</span>
                <button type="button" class="btn-close " data-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row d-flex justify-content-center mt-4 bg-light">
            <div class="col-11 mt-5 px-0 mb-5">
                <div class="col d-flex justify-content-center mb-5">
                    <div class="underline-heading text-center">
                        <h3>Add New Volunteer</h3>
                    </div>
                </div>
                <form action="{{ route('volunteer.add-new') }}" class="form mb-0" method="POST">
                    @csrf
                    <div class="row mt-3 p-0 px-0">
                        <div class="col-md-4 col-lg-4">
                            <input type="text" name="name" class="form-control" placeholder="Name*">
                        </div>
                        <div class="col-md-3 col-lg-4">
                            <input type="text" name="regno" class="form-control" maxlength="9" pattern="[0-9]+"
                                placeholder="Registration no*">
                        </div>
                        <div class="col-md-3 col-lg-4">
                            <input type="email" name="email" class="form-control" placeholder="Email*">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4 col-lg-4">
                            <input type="number" name="phone" class="form-control" placeholder="Phone*">
                        </div>
                        <div class="col-md-3 col-lg-4">
                            <select name="department" id="" class="form-select">
                                <option value="not selected" selected>Select department from list</option>
                                <option value="Dept CA">Department of Computer Applications</option>
                                <option value="Dept CE">Department of Civil Enginieering</option>
                                <option value="Dept CSE">Department of Computer Science Enginieering</option>
                                <option value="Dept ME">Department of Mechnical Engineering</option>
                                <option value="Dept IT">Department of Information Technology</option>
                                <option value="Dept EEE">Department of Electrical and Electronics Engineering
                                </option>
                                <option value="Dept ECE">Department of Electronics and Communication Engineering
                                </option>
                                <option value="Dept AI&DS">Department of Artificial Intelligence and Data Science
                                </option>
                                <option value="Dept Mgmt">Department of Management Studies</option>
                                <option value="Dept Mathemetics">Department of Mathematics</option>
                                <option value="Dept Chemistry">Department of Chemistry</option>
                                <option value="Dept Physics">Department of Physics</option>
                                <option value="Dept P.Ed">Department of Physical Education</option>
                            </select>
                        </div>
                        <div class="col-md-3 col-lg-4">
                            <select name="course" id="" class="form-select">
                                <option value="not selected" selected>Select course from list</option>
                                <option value="MBA">MBA</option>
                                <option value="MCA">MCA</option>
                                <option value="M.Sc">M.Sc</option>
                                <option value="BTech">BTech</option>
                                <option value="BCA">BCA</option>
                                <option value="BBA">BBA</option>
                                <option value="B.Sc">B.Sc</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4 col-lg-4">
                            <select name="batch" id="" class="form-select">
                                <option value="not selected" selected>Select batch from list</option>
                                <option value="2022-24">2022-24</option>
                                <option value="2023-25">2023-25</option>
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
