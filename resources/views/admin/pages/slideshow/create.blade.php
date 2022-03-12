@extends('admin.layout.admin')
@section('title')
    Admin | Slideshow
@endsection
@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Add Slideshows</h4>
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
                        <a href="#">Slideshow</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Add Slideshow</a>
                    </li>
                </ul>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <a class="btn btn-primary btn-round ml-auto text-white"
                                    href="{{ route('slideshow.create') }}">
                                    <i class="fa fa-arrow-left"></i>
                                    Back
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('slideshow.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="avatar avatar-xxl" style="width: 500px; height: 200px">
                                            <img src="{{ asset('atlantis/img/image.png') }}" id="output"
                                                style="object-fit: fill;" class="avatar-img rounded">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        {{-- IMAGE --}}
                                        <div class="form-group {{ $errors->first('image') ? 'has-error' : '' }}">
                                            <label for="exampleFormControlFile1">Image</label>
                                            <input type="file" class="form-control-file" accept="image/*" name=" image"
                                                id="image">
                                            <small class="form-text text-danger"> {{ $errors->first('image') }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        {{-- ORDER --}}
                                        <div class="form-group {{ $errors->first('order') ? 'has-error' : '' }}">
                                            <label for="order">Order</label>
                                            <input type="number" name="order" class="form-control" id="order"
                                                placeholder="Enter Order Number" value="{{ old('order') }}">
                                            <small class="form-text text-danger"> {{ $errors->first('order') }}</small>
                                        </div>
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
