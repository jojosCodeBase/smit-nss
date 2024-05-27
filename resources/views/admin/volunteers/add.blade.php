@extends('layouts/admin-content')
@section('title', 'Add Volunteers')
@section('breadcrumb', 'Add Volunteers')
@section('content')
   @include('include/alerts')
    <div class="container-fluid p-0">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Add New Volunteer</div>
                <form action="{{ route('volunteer.add-new') }}" method="POST">
                    @csrf
                    <div class="row mt-3 p-0 px-0">
                        <div class="col-md-4 col-lg-4 mb-lg-0 mg-md-0 mb-2">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-3 col-lg-4 mg-md-0 mb-2">
                            <label class="form-label">Registration no</label>
                            <input type="text" name="regno" class="form-control" maxlength="9" required>
                        </div>
                        <div class="col-md-3 col-lg-4 mg-md-0 mb-2">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mt-lg-3">
                        <div class="col-md-4 col-lg-4 mg-md-0 mb-2">
                            <label class="form-label">Select gender</label>
                            <div class="d-flex">
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" name="gender" value="M">
                                    <label class="form-check-label">
                                        Male
                                    </label>
                                </div>
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" name="gender" value="F">
                                    <label class="form-check-label">
                                        Female
                                    </label>
                                </div>
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" name="gender" value="O">
                                    <label class="form-check-label">
                                        Others
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 mg-md-0 mb-2">
                            <label class="form-label">Phone number</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>
                        <div class="col-md-4 col-lg-4 mg-md-0 mb-2">
                            <label class="form-label">Date of birth</label>
                            <input type="date" name="dob" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mt-lg-3">
                        <div class="col-md-4 col-lg-4">
                            <label class="form-label">NSS Batch</label>
                            <select name="batch" class="form-select" required>
                                <option value="" disabled selected>Select batch from list</option>
                                @foreach($batches as $batch)
                                    <option value="{{ $batch['id'] }}">{{ $batch['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 col-lg-4 mg-md-0 mb-2">
                            <label class="form-label">Course</label>
                            <select name="course" id="" class="form-select" required>
                                <option value="" disabled selected>Select course from list</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course['id'] }}">{{ $course['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 col-lg-4 mg-md-0 mb-2">
                            <label class="form-label">Category</label>
                            <select name="category" id="" class="form-select" required>
                                <option value="" disabled selected>Select category from list</option>
                                <option value="General">General</option>
                                <option value="OBC">OBC</option>
                                <option value="ST">ST</option>
                                <option value="SC">SC</option>
                                <option value="Minority">Minority</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4 col-lg-4 mg-md-0 mb-2">
                            <label class="form-label">Nationality</label>
                            <select name="nationality" id="nationality" class="form-select" required>
                                <option value="" disabled selected>Select nationality from list</option>
                                <option value="I">Indian</option>
                                <option value="NI">Non-Indian</option>
                            </select>
                        </div>
                        <div class="col-md-4 col-lg-4 mg-md-0 mb-2">
                            <label class="form-label" id="aadhar-number-input">Aadhar number</label>
                            <label class="form-label" id="document-number-input" style="display: none;">Other document
                                number</label>
                            <input type="text" name="document" class="form-control" required>
                        </div>
                    </div>
                    <div class="col text-center mt-3">
                        <input type="submit" class="btn btn-primary w-25" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('#nationality').on('change', function() {
            if ($('#nationality').val() == 1) {
                $('#aadhar-number-input').css('display', 'none');
                $('#document-number-input').css('display', 'block');
            } else {
                $('#aadhar-number-input').css('display', 'block');
                $('#document-number-input').css('display', 'none');
            }
        });
    </script>
@endsection
