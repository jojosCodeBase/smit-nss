@extends('layouts/admin-content')
@section('breadcrumb', 'Add Drives')
@section('content')
    @include('include/alerts')
    <div class="container-fluid p-0">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Add New Drive</div>
                <span class="fw-bold">Drive id: {{ $id }}</span>
                <form action="{{ route('drive.add') }}" method="POST">
                    @csrf
                    {{-- <div class="input-group has-validation"> --}}
                    <input type="hidden" name="id" value={{ $id }}>
                    <div class="row mt-3 p-0 px-0">
                        <div class="col-md-4 col-lg-4 mb-lg-0 mg-md-0 mb-2">
                                <input type="text" name="title" class="form-control invalid" placeholder="Drive title"
                                    id="validationServerUsername"
                                    aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" required>
                            </div>

                        <div class="col-md-3 col-lg-4 mb-md-0 mb-2">
                            <input type="date" name="date" id="date" class="form-control invalid" id="validationServerUsername"
                            aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" required>
                        </div>
                        <div class="col-md-3 col-lg-4 mb-md-0 mb-2">
                            <input type="text" name="conductedBy" class="form-control invalid" placeholder="Conducted by" id="validationServerUsername"
                            aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" required>
                        </div>
                    </div>
                    <div class="row mt-lg-3">
                        <div class="col-md-3 col-lg-4 mb-md-0 mb-2">
                            <select name="driveType" class="form-select invalid" id="validationServerUsername"
                            aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" required>
                                <option value="not selected" selected>Select drive type from list</option>
                                <option value="regular">Regular NSS Activities</option>
                                <option value="cleanliness">Cleanliness Drive</option>
                            </select>
                        </div>
                        <div class="col-md-3 col-lg-4 mb-md-0 mb-2">
                            <input type="text" name="area" class="form-control invalid" placeholder="Area" id="validationServerUsername"
                            aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" required>
                        </div>
                        <div class="col-md-4 col-lg-4 mb-2">
                            <input type="time" name="from" class="form-control invalid" placeholder="From" id="validationServerUsername"
                            aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" required>
                        </div>
                    </div>
                    <div class="row mt-lg-3">
                        <div class="col-md-4 col-lg-4 mb-2">
                            <input type="time" name="to" class="form-control invalid" placeholder="To" id="validationServerUsername"
                            aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" required>
                        </div>
                        <div class="col mb-2">
                            <textarea name="description" id="" cols="30" rows="6" class="form-control description invalid"
                                placeholder="Add description about the drive" id="validationServerUsername"
                                aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" required></textarea>
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
