@extends('admin.layout.admin')
@section('title')
    Admin | Users
@endsection
@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Add Users</h4>
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
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Add User</a>
                    </li>
                </ul>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <a class="btn btn-primary btn-round ml-auto text-white" href="{{ route('user.store') }}">
                                    <i class="fa fa-arrow-left"></i>
                                    Back
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        {{-- USERNAME --}}
                                        <div class="form-group {{ $errors->first('username') ? 'has-error' : '' }}">
                                            <label for="username">Username</label>
                                            <input type="text" value="{{ old('username') }}" class="form-control "
                                                id="username" name="username" placeholder="Enter Username">
                                            <small class="form-text text-danger"> {{ $errors->first('username') }}</small>
                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        {{-- NAME --}}
                                        <div class="form-group {{ $errors->first('name') ? 'has-error' : '' }}">
                                            <label for="name">Name</label>
                                            <input type="text" value="{{ old('name') }}" name="name"
                                                class="form-control" id="name" placeholder="Enter Name">
                                            <small class="form-text text-danger"> {{ $errors->first('name') }}</small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        {{-- EMAIL --}}
                                        <div class="form-group {{ $errors->first('email') ? 'has-error' : '' }}">
                                            <label for="email">Email</label>
                                            <input type="email" value="{{ old('email') }}" name="email"
                                                class="form-control" id="email" placeholder="Enter Email">
                                            <small class="form-text text-danger"> {{ $errors->first('email') }}</small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        {{-- PHONE --}}
                                        <div class="form-group {{ $errors->first('phone') ? 'has-error' : '' }}">
                                            <label for="phone">Phone</label>
                                            <input type="number" value="{{ old('phone') }}" name="phone"
                                                class="form-control" id="phone" placeholder="Enter phone">
                                            <small class="form-text text-danger"> {{ $errors->first('phone') }}</small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        {{-- PASSWORD --}}
                                        <div class="form-group {{ $errors->first('password') ? 'has-error' : '' }}">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" class="form-control" id="password"
                                                placeholder="Enter Password">
                                            <small class="form-text text-danger"> {{ $errors->first('password') }}</small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        {{-- RE-PASSWORD --}}
                                        <div class="form-group {{ $errors->first('repassword') ? 'has-error' : '' }}">
                                            <label for="repassword">Ulangi Password</label>
                                            <input type="password" name="repassword" class="form-control" id="repassword"
                                                placeholder="Ulangi Password">
                                            <small class="form-text text-danger">
                                                {{ $errors->first('repassword') }}</small>
                                        </div>
                                    </div>



                                    <div class="col-md-6">
                                        {{-- IMAGE --}}
                                        <div class="form-group {{ $errors->first('image') ? 'has-error' : '' }}">
                                            <label for="image">Image</label>
                                            <input type="file" class="form-control-file" accept="image/*" name="image"
                                                id="image">
                                            <small class="form-text text-danger"> {{ $errors->first('image') }}</small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="avatar avatar-xxl" style="width: 400px; height: 300px;">
                                            <img src="{{ asset('atlantis/img/image.png') }}" id="output"
                                                style="object-fit: fill;" class="avatar-img rounded">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card-action d-flex justify-content-end">
                                            <button class="btn btn-success">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
@push('script-push')
    <script>
        $(document).ready(function() {
            // let mainUrl = {{ Illuminate\Support\Js::from(Request::url()) }};
            // let token = {{ Illuminate\Support\Js::from(csrf_token()) }};


            image.onchange = evt => {
                const [file] = image.files
                if (file) {
                    output.src = URL.createObjectURL(file)
                }
            }

            var isStoreErrror = {{ Illuminate\Support\Js::from($errors->any()) }};

            if (isStoreErrror) {
                swal("Error!", "Gagal menyimpan data!", {
                    icon: "error",
                    buttons: {
                        confirm: {
                            className: 'btn btn-danger'
                        }
                    },
                });
            }




            // function onUpdate(id){
            //     console.log("UPDATE " +  id)
            // }

            // function onDelete(id){
            //     console.log("DELETE " +  id)
            // }

            // function getById(id){
            //     console.log("GET BY ID " +  id)
            // }

            // $( ".button-edit" ).click(function() {
            //         var id = $(this).data("id");
            //         });


            //         $.ajax({
            //         method: "PUT",
            //         url:  mainUrl + "/1",
            //         data: null,
            //         headers : {'X-CSRF-TOKEN': token},
            //         success: function(data){
            //             console.log(data);
            //         },

            //         });
        });
    </script>
@endpush
