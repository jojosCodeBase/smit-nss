@extends('layouts/admin-content')
@section('title', 'Add Drives')
@section('breadcrumb', 'Add Drives')
@section('content')
    @include('include/alerts')
    <div class="container-fluid p-0">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Add New Drive</div>
                <span class="fw-bold">Drive id: {{ $id }}</span>
                <form action="{{ route('drive.add') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <input type="hidden" name="id" value={{ $id }}>
                    <div class="row mt-3 p-0 px-0">
                        <div class="col-md-4 col-lg-4 mb-lg-0 mg-md-0 mb-2">
                            <input type="text" name="title" class="form-control invalid" placeholder="Drive title"
                                id="validationServerUsername"
                                aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" required>
                            <div class="invalid-feedback">
                                Please write Drive title.
                            </div>
                        </div>

                        <div class="col-md-3 col-lg-4 mb-md-0 mb-2">
                            <input type="date" name="date" id="date" class="form-control invalid"
                                id="validationServerUsername"
                                aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" required>
                            <div class="invalid-feedback">
                                Please select s valid date.
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-4 mb-md-0 mb-2">
                            <input type="text" name="conductedBy" class="form-control invalid" placeholder="Conducted by"
                                id="validationServerUsername"
                                aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" required>
                            <div class="invalid-feedback">
                                Please enter a valid input.
                            </div>
                        </div>
                    </div>
                    <div class="row mt-lg-3">
                        <div class="col-md-3 col-lg-4 mb-md-0 mb-2">
                            <input type="text" name="driveType" class="form-control invalid" id="validationServerUsername" placeholder="Drive type" required>
                            <div class="invalid-feedback">
                                Please enter a valid input.
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-4 mb-md-0 mb-2">
                            <input type="text" name="area" class="form-control invalid" placeholder="Area"
                                id="validationServerUsername"
                                aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" required>
                            <div class="invalid-feedback">
                                Please enter a valid input.
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 mb-2">
                            <input type="time" name="from" class="form-control invalid" placeholder="From"
                                id="validationServerUsername"
                                aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" required>
                            <div class="invalid-feedback">
                                Please choose a valid time.
                            </div>
                        </div>
                    </div>
                    <div class="row mt-lg-3">
                        <div class="col-md-4 col-lg-4 mb-2">
                            <input type="time" name="to" class="form-control invalid" placeholder="To"
                                id="validationServerUsername"
                                aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" required>
                            <div class="invalid-feedback">
                                Please choose a valid time.
                            </div>
                        </div>
                        <div class="col mb-2">
                            <textarea name="description" id="" cols="30" rows="6" class="form-control description invalid"
                                placeholder="Add description about the drive" id="validationServerUsername"
                                aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" required></textarea>
                                <div class="invalid-feedback">
                                    Please write a descreibtion.
                                </div>
                        </div>
                    </div>
                    <div class="row mt-lg-3">
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-3 text-center mt-3">
                            <input type="submit" class="btn btn-primary w-100" value="Add">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
