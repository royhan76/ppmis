@extends('admin.layout.admin')
@section('title')
    Admin | Users
@endsection
@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Users</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="#">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Users</a>


                    </li>
                </ul>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Add Row</h4>
                                <button class="btn btn-primary btn-round ml-auto" data-toggle="modal"
                                    data-target="#addUser">
                                    <i class="fa fa-plus"></i>
                                    Add User
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Modal -->
                            <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header no-bd">
                                            <h5 class="modal-title">
                                                <span class="fw-mediumbold">
                                                    New</span>
                                                <span class="fw-light">
                                                    Row
                                                </span>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="user">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div
                                                            class="form-group form-group-default {{ $errors->first('name') ? 'has-error' : '' }}">
                                                            <label>Name</label>
                                                            <input id="name" type="text" class="form-control "
                                                                placeholder="isi dengan nama" name="name"
                                                                value="{{ old('name') }}">
                                                            <small
                                                                class="form-text text-muted">{{ $errors->first('name') }}</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 pr-0">
                                                        <div
                                                            class="form-group form-group-default {{ $errors->first('username') ? 'has-error' : '' }}">
                                                            <label>Username</label>
                                                            <input id="username" type="text" class="form-control"
                                                                placeholder="isi dengan username" name="username"
                                                                value="{{ old('username') }}">
                                                            <small
                                                                class="form-text text-muted">{{ $errors->first('username') }}</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div
                                                            class="form-group form-group-default {{ $errors->first('password') ? 'has-error' : '' }}">
                                                            <label>Password</label>
                                                            <input id="password" type="password" class="form-control"
                                                                placeholder="isi dengan password" name="password"
                                                                value="{{ old('password') }}">
                                                            <small
                                                                class="form-text text-muted">{{ $errors->first('password') }}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer no-bd">
                                                    <button type="submit" id="addRowButton"
                                                        class="btn btn-primary">Add</button>
                                                    <button type="button" class="btn btn-danger"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Role</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @forelse ($users as $user)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->username }}</td>
                                                <td>{{ $user->role }}</td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <button type="button" data-toggle="tooltip" title=""
                                                            class="btn btn-link btn-primary btn-lg"
                                                            data-original-title="Edit Task">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button type="button" data-toggle="tooltip" title=""
                                                            class="btn btn-link btn-danger" data-original-title="Remove">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <p>No users</p>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
@push('script-push')
    <script>
        var isStoreErrror = {{ Illuminate\Support\Js::from($errors->any()) }};

        if (isStoreErrror) {
            $("#addUser").modal()
        }
    </script>
@endpush
