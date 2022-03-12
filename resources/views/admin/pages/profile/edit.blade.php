@extends('admin.layout.admin')
@section('title')
    Admin | Profile
@endsection
@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Edit Profile</h4>
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
                        <a href="#">Profile</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Edit Profile</a>
                    </li>
                </ul>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <a class="btn btn-primary btn-round ml-auto text-white"
                                    href="{{ route('profile.index') }}">
                                    <i class="fa fa-arrow-left"></i>
                                    Back
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('profile.update', $profile->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="oldlogo" value="{{ $profile->logo }}">
                                <input type="hidden" name="oldimage" value="{{ $profile->image }}">
                                <input type="hidden" name="oldregistration" value="{{ $profile->registration }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        {{-- LOGO --}}
                                        <div class="form-group {{ $errors->first('logo') ? 'has-error' : '' }}">
                                            <label for="logo">Logo</label>
                                            <input type="file" class="form-control-file" accept="image/*" name=" logo"
                                                id="logo">
                                            <small class="form-text text-danger"> {{ $errors->first('logo') }}</small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="avatar avatar-xxl">
                                            <img src="{{ $profile->logo_url }}" id="output_logo" style="object-fit: fill;"
                                                class="avatar-img rounded">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        {{-- TITLE --}}
                                        <div class="form-group {{ $errors->first('title') ? 'has-error' : '' }}">
                                            <label for="title">Title</label>
                                            <input type="text" value="{{ old('title') ?? $profile->title }}"
                                                class="form-control " id="title" name="title" placeholder="Enter Title">
                                            <small class="form-text text-danger"> {{ $errors->first('title') }}</small>
                                        </div>
                                    </div>
                                    {{-- BLANK --}}
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6">
                                        {{-- REGISTRATION --}}
                                        <div class="form-group {{ $errors->first('registration') ? 'has-error' : '' }}">
                                            <label for="registration">Registration</label>
                                            <input type="file" class="form-control-file" accept="application/pdf"
                                                name=" registration" id="registration">
                                            <small class="form-text text-danger">
                                                {{ $errors->first('registration') }}</small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="avatar avatar-xxl">
                                            <embed id="output_registration" class="m-2"
                                                src="{{ $profile->registration_url }}" width="450px" height="300px" />
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
                                        <div class="avatar avatar-xxl m-2" style="width: 300px;">
                                            <img src="{{ $profile->image_url }}" id="output_image"
                                                style="object-fit: fill;" class="avatar-img rounded">
                                        </div>
                                    </div>
                                    <div class="col-md-12">

                                        <div class="form-group {{ $errors->first('content') ? 'has-error' : '' }}">
                                            <label for="content">Content</label>
                                            <textarea name="content" id="content" rows="10"
                                                cols="80">{!! $profile->content !!}</textarea>
                                            <small class="form-text text-danger"> {{ $errors->first('content') }}</small>
                                            <div>
                                            </div>
                                            <div class="col-md-12">
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
@push('top-ckeditor')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
@endpush
@push('bottom-ckeditor')
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor 4
        // instance, using default configuration.
        CKEDITOR.replace('content');
    </script>
@endpush
@push('script-push')
    <script>
        $(document).ready(function() {
            // let mainUrl = {{ Illuminate\Support\Js::from(Request::url()) }};
            // let token = {{ Illuminate\Support\Js::from(csrf_token()) }};

            image.onchange = evt => {
                const [file] = image.files
                if (file) {
                    output_image.src = URL.createObjectURL(file)
                }
            }
            logo.onchange = evt => {
                const [file] = logo.files
                if (file) {
                    output_logo.src = URL.createObjectURL(file)
                }
            }

            registration.onchange = evt => {
                const [file] = registration.files
                if (file) {
                    output_registration.src = URL.createObjectURL(file)
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
