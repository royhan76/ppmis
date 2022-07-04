@extends('admin.layout.admin')
@section('title')
    Admin | Foul
@endsection
@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Edit Foul</h4>
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
                        <a href="#">Foul</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Add Foul</a>
                    </li>
                </ul>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <a class="btn btn-primary btn-round ml-auto text-white" href="{{ route('foul.store') }}">
                                    <i class="fa fa-arrow-left"></i>
                                    Back
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('foul.update', $foul->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="row">

                                    <div class="col-md-6">

                                        {{-- NAME --}}
                                        <div class="form-group {{ $errors->first('name') ? 'has-error' : '' }}">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" value="{{ old('name') ?? $foul->name }}"
                                                class="form-control input-name" id="name" placeholder="Name">
                                            <small class="form-text text-danger">
                                                {{ $errors->first('name') }}</small>
                                        </div>



                                    </div>

                                    <div class="col-md-6">

                                        {{-- DATE_BIRTH --}}
                                        <div class="form-group {{ $errors->first('date') ? 'has-error' : '' }}">
                                            <label for="date">Tanggal Lahir</label>
                                            <input type="date" name="date" value="{{ old('date') ?? $foul->date }}"
                                                class="form-control input-name" id="date" placeholder="Tanggal">
                                            <small class="form-text text-danger">
                                                {{ $errors->first('date-date') }}</small>
                                        </div>
                                    </div>

                                    {{-- STUDENT --}}
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->first('student') ? 'has-error' : '' }}">
                                            <label for="student">Nama Santri</label>
                                            <select class="form-control" id="student" name="student">
                                                <option value="">--PILIH NAMA SANTRI--</option>
                                                @foreach ($students as $student)
                                                    <option
                                                        {{ (old('student') && old('student') == $student->id) || $foul->student_id == $student->id ? 'selected' : '' }}
                                                        value="{{ $student->id }}">{{ $student->name }}</option>
                                                @endforeach


                                            </select>
                                            <small class="form-text text-danger">
                                                {{ $errors->first('student') }}</small>
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
