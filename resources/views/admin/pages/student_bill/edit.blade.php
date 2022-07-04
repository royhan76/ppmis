@extends('admin.layout.admin')
@section('title')
    Admin | Dormitory
@endsection
@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Edit Tagihan Santri</h4>
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
                        <a href="#">Tagihan Santri</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Add Catagory</a>
                    </li>
                </ul>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <a class="btn btn-primary btn-round ml-auto text-white"
                                    href="{{ route('student-bill.store') }}">
                                    <i class="fa fa-arrow-left"></i>
                                    Back
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('student-bill.update', $student_bill->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="row">

                                    {{-- STUDENT --}}
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->first('student') ? 'has-error' : '' }}">
                                            <label for="student">Nama Santri</label>
                                            <select class="form-control" id="student" name="student">
                                                <option value="">--PILIH NAMA SANTRI--</option>
                                                @foreach ($students as $student)
                                                    <option
                                                        {{ (old('student') && old('student') == $student->id) || $student_bill->student_id == $student->id ? 'selected' : '' }}
                                                        value="{{ $student->id }}">{{ $student->name }}</option>
                                                @endforeach


                                            </select>
                                            <small class="form-text text-danger">
                                                {{ $errors->first('student') }}</small>
                                        </div>
                                    </div>

                                    {{-- BILL --}}
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->first('bill') ? 'has-error' : '' }}">
                                            <label for="bill">Tagihan</label>
                                            <select class="form-control" id="bill" name="bill">
                                                <option value="">--PILIH TAGIHAN--</option>
                                                @foreach ($bills as $bill)
                                                    <option
                                                        {{ (old('bill') && old('bill') == $bill->id) || $student_bill->bill_id == $bill->id ? 'selected' : '' }}
                                                        value="{{ $bill->id }}">
                                                        {{ $bill->name . '-' . $bill->nominal . '-' . $bill->year }}
                                                    </option>
                                                @endforeach


                                            </select>
                                            <small class="form-text text-danger">
                                                {{ $errors->first('bill') }}</small>
                                        </div>
                                    </div>

                                    {{-- STATUS --}}
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->first('status') ? 'has-error' : '' }}">
                                            <label for="status">Status</label>
                                            <select class="form-control" id="status" name="status">
                                                <option value="">--PILIH STATUS--</option>

                                                <option
                                                    {{ (old('status') && old('status') == 0) || $student_bill->status == 0 ? 'selected' : '' }}
                                                    value="0">Belum Lunas</option>
                                                <option {{ old('status') && old('status') == 1 ? 'selected' : '' }}
                                                    value="1">Lunas</option>


                                            </select>
                                            <small class="form-text text-danger">
                                                {{ $errors->first('status') }}</small>
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
