@extends('layouts/content')
@section('content')
<div class="breadcrumb-bar mb-3 px-4">
                    <span class="breadcrumb-item">Home</span>
                    <span class="breadcrumb-item">NSS Drives</span>
                    <span class="breadcrumb-item active">Add</span>
                </div>
                <div class="container addForm">
                    <div class="row d-flex justify-content-center bg-light">
                        <div class="col-11 mt-5">
                            <div class="col d-flex justify-content-center mb-5">
                                <div class="underline-heading text-center">
                                    <h3>Add New Drive</h3>
                                </div>
                            </div>
                            <form action="" class="form mb-5">
                                <div class="row mt-3">
                                    <div class="col-md-4 col-lg-4">
                                        <input type="text" name="drive-title" id="drive-title" class="form-control" placeholder="Drive title" required>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <input type="date" name="date" id="date" class="form-control">
                                    </div>
                                    <div class="col-md-3 col-lg-4">
                                        <input type="text" name="conductedby" class="form-control"
                                        placeholder="Conducted by">
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-4 col-lg-4">
                                        <select name="drive-type" id="" class="form-select">
                                            <option value="" selected>Select drive type from list</option>
                                            <option value="on-campus">On-Campus</option>
                                            <option value="off-campus">Off-Campus</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <input type="email" name="area" class="form-control" placeholder="Area">
                                    </div>
                                    <div class="col-md-3 col-lg-2">
                                        <input type="number" name="present" class="form-control" placeholder="Present">
                                    </div>
                                    <div class="col-md-3 col-lg-2">
                                        <input type="number" name="absent" class="form-control" placeholder="Absent">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col">
                                        <label class="form-label">Description</label>
                                        <textarea name="description" id="" cols="30" rows="6"
                                            class="form-control description"></textarea>
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
