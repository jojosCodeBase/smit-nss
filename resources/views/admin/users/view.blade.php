@extends('layouts/admin-content')
@section('title', 'Moderator Details')
@section('breadcrumb', 'Moderator Details')
@section('content')
    <div class="container-fluid">
        @include('include/alerts')
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2 d-flex justify-content-center">
                                <img src="{{ asset('assets/img/icons/user-icon.png') }}" width="70" height="70"
                                    alt="user-image">
                            </div>
                            <div class="col">
                                <div class="name mb-1">
                                    <span>Name: </span>
                                    <span>{{ $details['name'] }}</span>
                                </div>
                                @if ($details['status'] == 1)
                                    <span>Status: </span>
                                    <div class="badge bg-success">
                                        <span><i class="bi-person-fill-check"></i> Active</span>
                                    </div>
                                @else
                                    <span>Status: </span>
                                    <div class="badge bg-danger">
                                        <span><i class="bi-person-fill-check"></i> In-active</span>
                                    </div>
                                @endif
                                <div class="name mb-1">
                                    <span>Email: </span>
                                    <span>{{ $details['email'] }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col d-flex justify-content-center">
                                <button type="button" class="btn btn-info blockUserBtn" data-toggle="modal"
                                    data-target="#blockUserModal" data-user-id="{{ $details['id'] }}"><i
                                        class="bi bi-ban"></i>
                                    {{ $details['status'] == 1 ? 'Block' : 'Unblock' }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal Desktop start -->
    <div class="modal fade" id="blockUserModal" tabindex="-1" role="dialog" aria-labelledby="blockUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route($details['status'] == 1 ? 'user.block' : 'user.unblock') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        @method('patch')
                        <div class="form-row mb-2">
                            <div class="col">
                                <div class="d-flex justify-content-center">
                                    <i class="rounded-circle bi bi-exclamation-triangle-fill text-warning"
                                        style="font-size: 50px;"></i>
                                </div>
                                <h4 class="text-center text-dark">{{ $details['status'] == 1 ? 'Block' : 'Unblock' }} User</h6>
                                    <p class="text-danger text-center">Are you sure you want to {{ $details['status'] == 1 ? 'block' : 'unblock' }} this user ?</p>
                                    <input type="number" id="user_id" name="user_id" hidden>
                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-secondary w-25 me-5"
                                            data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-info w-25">Yes</button>
                                    </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.blockUserBtn').on('click', function() {
                $('#user_id').val($(this).data('user-id'));
            });
        });
    </script>
@endsection
