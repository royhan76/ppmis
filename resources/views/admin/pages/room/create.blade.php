@extends('admin.layout.admin')
@section('title')
    Admin | Room
@endsection
@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Add Room</h4>
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
                        <a href="#">Room</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Add Room</a>
                    </li>
                </ul>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <a class="btn btn-primary btn-round ml-auto text-white"
                                    href="{{ route('room.store') }}">
                                    <i class="fa fa-arrow-left"></i>
                                    Back
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('room.store') }}">
                                @csrf
                                <div class="row">

                                    <div class="col-md-6">

                                        {{-- NAME --}}
                                        <div class="form-group {{ $errors->first('name') ? 'has-error' : '' }}">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" value="{{ old('name') }}"
                                                class="form-control input-name" id="name" placeholder="Name">
                                            <small class="form-text text-danger">
                                                {{ $errors->first('name') }}</small>
                                        </div>
                                        <div class="card-action d-flex justify-content-end">
                                            <button class="btn btn-success">Save</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->first('dormitory') ? 'has-error' : '' }}">
                                            <label for="dormitory_id">Dormitory</label>
                                            <select class="form-control" id="dormitory" name="dormitory">
                                                <option value="">SELECT DORMITORY</option>
                                                @foreach ($dormitories as $dormitory)
                                                    <option
                                                        {{ old('dormitory') && old('dormitory') == $dormitory->id ? 'selected' : '' }}
                                                        value="{{ $dormitory->id }}">{{ $dormitory->name }}</option>
                                                @endforeach


                                            </select>
                                            <small class="form-text text-danger">
                                                {{ $errors->first('dormitory') }}</small>
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
