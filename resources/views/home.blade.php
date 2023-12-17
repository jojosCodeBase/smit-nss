@extends('layouts/content')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <div class="card text-center bg-primary">
                    <div class="card-body text-light text-start">
                        <ul class="p-0 m-0" style="list-style: none;">
                            <li class="card-text">Total volunteers: <b>120</b></li>
                            <li class="card-text">Total male: <b>100</b></li>
                            <li class="card-text">Total female: <b>20</b></li>
                        </ul>
                    </div>
                    <div class="card-footer text-light">
                        View all ->
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="card text-center bg-primary">
                    <div class="card-body text-light text-start">
                        <ul class="p-0 m-0" style="list-style: none;">
                            <li class="card-text">Total drives: <b>20</b></li>
                            <li class="card-text">On-campus : <b>8</b></li>
                            <li class="card-text">Off-campus: <b>12</b></li>
                        </ul>
                    </div>
                    <div class="card-footer text-light">
                        View all ->
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="card text-center bg-primary">
                    <div class="card-body text-light text-start">
                        <ul class="p-0 m-0" style="list-style: none;">
                            <li class="card-text">Total volunteers: <b>120</b></li>
                            <li class="card-text">Total male: <b>100</b></li>
                            <li class="card-text">Total female: <b>20</b></li>
                        </ul>
                    </div>
                    <div class="card-footer text-light">
                        View all ->
                    </div>
                </div>
            </div>
        </div>
        <div class="table-row">
            <div class="row mt-5">
                <div class="heading">
                    <h4 class="p-0">Recent Activities</h4>
                </div>
                <table class="table table-striped table-bordered">
                    <thead>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Area</th>
                        <th>Present</th>
                        <th>Absent</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>22-10-23</td>
                            <td>Cleanliness drive conducted at
                                Rangpo IBM to help flood relief.</td>
                            <td>IBM, Rangpo, Sikkim</td>
                            <td>15</td>
                            <td>5</td>
                        </tr>
                        <tr>
                            <td>12-09-23</td>
                            <td>Cleanliness drive conducted at
                                Upper Majitar near SBI Bank.</td>
                            <td>Majitar, Sikkim</td>
                            <td>20</td>
                            <td>3</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
