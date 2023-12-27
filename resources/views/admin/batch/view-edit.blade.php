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
        <div class="card">
            <div class="card-body">
                <div class="card-title">All Batches</div>
                <table class="table">
                    <thead>
                        <th>Name</th>
                        <th>Student Co-ordinator</th>
                        <th>Volunteers</th>
                        <th>Registration</th>
                        <th>Status</th>
                        <th>Registration From</th>
                    </thead>
                    <tbody>
                        @foreach ($batches as $b)
                            <tr>
                                <td>{{ $b['name'] }}</td>
                                <td>{{ $b['studentCoordinator'] }}</td>
                                <td>{{ $b['volunteers'] }}</td>
                                @if ($b['status'] == 0)
                                    @php
                                        $buttonClass = 'btn-success';
                                        $buttonText = 'Open';
                                        $statusText = 'Not Accepting Responses';
                                    @endphp
                                @else
                                    @php
                                        $buttonClass = 'btn-danger';
                                        $buttonText = 'Close';
                                        $statusText = 'Accepting Responses';
                                    @endphp
                                @endif

                                <td>
                                    <button type="button" class="btn {{ $buttonClass }}"
                                        id="status-btn{{ $b['id'] }}"
                                        onclick="toggle({{ $b['id'] }}, {{ $b['status'] }})">{{ $buttonText }}</button>
                                </td>
                                <td id="form-status{{ $b['id'] }}">{{ $statusText }}</td>

                                <td><a href="{{ route('batch.registration-form', $b['name']) }}" target="_blank">View</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function toggle(id, status) {
            var status_btn = document.getElementById('status-btn' + id);
            var form_status = document.getElementById('form-status' + id);

            if(status == 0 && status_btn.innerHTML === "Open"){
                status = 1;
            }else{
                status = 0;
            }

            event.preventDefault();
            jQuery.ajax({
                url: '{{ route('batch.view-edit.updateStatus') }}', // if your url is using prefix enter url with prefix
                type: 'GET',
                dataType: 'json',
                data: {
                    id: id,
                    status: status
                },
                success: function(response) {
                    console.log(response);
                    if (response.message === "success") {
                        if (status_btn.innerHTML === "Close" && form_status.innerHTML ===
                            "Accepting Responses") {
                            status_btn.className = "btn btn-success";
                            status_btn.innerHTML = "Open";
                            form_status.innerHTML = "Not accepting responses";
                        } else {
                            status_btn.className = "btn btn-danger";
                            status_btn.innerHTML = "Close";
                            form_status.innerHTML = "Accepting Responses";
                        }
                    } else {
                        alert('Some error occured in opening/closing form !');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX request failed: ', status, error);
                }
            });
        }
    </script>
@endsection
