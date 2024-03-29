@extends('layouts/user-content')
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
        <div class="card">
            <div class="card-body">
                <div class="card-title">Add New Drive</div>
                <span class="fw-bold">Drive id: {{ $id }}</span>
                <form action="{{ route('user.drive.add') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <input type="hidden" name="id" value={{ $id }}>
                    <div class="row mt-3 p-0 px-0">
                        <div class="col-md-4 col-lg-4 mb-lg-0 mg-md-0 mb-2">
                         <input type="text" name="title" class="form-control" placeholder="Drive title" required>
                         <div id="validationServer03Feedback" class="invalid-feedback">
                            Required!
                          </div>
                        </div>
                        <div class="col-md-4 col-lg-4 mb-md-0 mb-2">
                            <input type="date" name="date" id="date" class="form-control" required>
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                Required!
                              </div>
                        </div>
                        <div class="col-md-4 col-lg-4 mb-md-0 mb-2">
                            <input type="text" name="conductedBy" class="form-control" placeholder="Conducted by" required>
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                Required!
                              </div>
                        </div>
                    </div>
                    <div class="row mt-lg-3">
                        <div class="col-md-4 col-lg-4 mb-md-0 mb-2">
                            <select name="driveType" id="" class="form-select" required>
                                <option value="" selected>Select drive type from list</option>
                                <option value="regular">Regular NSS Activities</option>
                                <option value="cleanliness">Cleanliness Drive</option>
                            </select>
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                Required!
                              </div>
                        </div>
                        <div class="col-md-4 col-lg-4 mb-md-0 mb-2">
                            <input type="text" name="area" class="form-control" placeholder="Area" required>
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                Required!
                              </div>
                        </div>
                        <div class="col-md-4 col-lg-4 mb-md-0 mb-2">
                            <input type="number" name="present" class="form-control" placeholder="Present" required>
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                Required!
                              </div>
                        </div>
                    </div>
                    <div class="row mt-lg-3 mt-md-3">
                        <div class="col-md-5 col-lg-5 mb-2">
                            <input type="text" name="from" class="form-control" placeholder="From" required>
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                Required!
                              </div>
                        </div>
                        <div class="col-md-5 col-lg-5 mb-2">
                            <input type="text" name="to" class="form-control" placeholder="To" required>
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                Required!
                              </div>
                        </div>
                    </div>
                    <div class="row mt-lg-3">
                        <div class="col mb-2">
                            <textarea name="description" id="" cols="30" rows="6" class="form-control description"
                                placeholder="Add description about the drive" required></textarea>
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    Required!
                                  </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-3 col-lg-3  text-center mt-3">
                            <input type="submit" class="btn btn-primary w-100" value="Add" id="myButton">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
