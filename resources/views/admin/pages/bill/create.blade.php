@extends('admin.layout.admin')
@section('title')
    Admin | Bill
@endsection
@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Add Bill</h4>
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
                        <a href="#">Bill</a>
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
                                    href="{{ route('bill.store') }}">
                                    <i class="fa fa-arrow-left"></i>
                                    Back
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('bill.store') }}">
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
                                    </div>

                                    {{-- ARRIVAL --}}
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->first('arrival') ? 'has-error' : '' }}">
                                            <label for="arrival">Baru/Lama</label>
                                            <select class="form-control" id="arrival" name="arrival">
                                                <option value="">--PILIH BARU/LAMA--</option>

                                                <option {{ old('arrival') && old('arrival') == 'BARU' ? 'selected' : '' }}
                                                    value="BARU">BARU</option>
                                                <option {{ old('arrival') && old('arrival') == 'LAMA' ? 'selected' : '' }}
                                                    value="LAMA">LAMA</option>


                                            </select>
                                            <small class="form-text text-danger">
                                                {{ $errors->first('arrival') }}</small>
                                        </div>
                                    </div>

                                    {{-- ROLE --}}
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->first('role') ? 'has-error' : '' }}">
                                            <label for="role">Role</label>
                                            <select class="form-control" id="role" name="role">
                                                <option value="">--PILIH STATUS--</option>
                                                @foreach ($roles as $role)
                                                    <option
                                                        {{ old('role') && old('role') == $role->id ? 'selected' : '' }}
                                                        value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach


                                            </select>
                                            <small class="form-text text-danger">
                                                {{ $errors->first('role') }}</small>
                                        </div>
                                    </div>

                                    {{-- YEAR --}}
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->first('year') ? 'has-error' : '' }}">
                                            <label for="year">Tahun Ajaran</label>
                                            <select class="form-control" id="year" name="year">
                                                <option value="">--PILIH TAHUN AJARAN--</option>
                                                @foreach ($seasons as $season)
                                                    <option
                                                        {{ old('year') && old('year') == $season->year ? 'selected' : '' }}
                                                        value="{{ $season->year }}">{{ $season->year }}</option>
                                                @endforeach


                                            </select>
                                            <small class="form-text text-danger">
                                                {{ $errors->first('year') }}</small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">

                                        {{-- NOMINAL --}}
                                        <div class="form-group {{ $errors->first('nominal') ? 'has-error' : '' }}">
                                            <label for="name">Nominal</label>
                                            <input type="number" name="nominal" value="{{ old('nominal') }}"
                                                class="form-control input-name" id="nominal" placeholder="Nominal">
                                            <small class="form-text text-danger">
                                                {{ $errors->first('nominal') }}</small>
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
