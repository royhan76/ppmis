@extends('admin.layout.admin')
@section('title')
    Admin | Student
@endsection
@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Edit Student</h4>
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
                        <a href="#">Student</a>
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
                                    href="{{ route('student.store') }}">
                                    <i class="fa fa-arrow-left"></i>
                                    Back
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('student.update', $student->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">

                                    <div class="col-md-6">

                                        {{-- NAME --}}
                                        <div class="form-group {{ $errors->first('name') ? 'has-error' : '' }}">
                                            <label for="name">Name</label>
                                            <input type="text" name="name"
                                                value="{{ old('name') ?? $student->name }}"
                                                class="form-control input-name" id="name" placeholder="Name">
                                            <small class="form-text text-danger">
                                                {{ $errors->first('name') }}</small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        {{-- NIK --}}
                                        <div
                                            class="form-group {{ $errors->first('nomor_induk_santri') ? 'has-error' : '' }}">
                                            <label for="NIK">NIK</label>
                                            <input type="text" name="nomor_induk_santri"
                                                value="{{ old('nomor_induk_santri') ?? $student->nomor_induk_santri }}"
                                                class="form-control input-name" id="NIK" placeholder="NIK">
                                            <small class="form-text text-danger">
                                                {{ $errors->first('nomor_induk_santri') }}</small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">

                                        {{-- DATE_BIRTH --}}
                                        <div class="form-group {{ $errors->first('date_birth') ? 'has-error' : '' }}">
                                            <label for="date_birth">Tanggal Lahir</label>
                                            <input type="date" name="date_birth"
                                                value="{{ old('date_birth') ?? $student->date_birth }}"
                                                class="form-control input-name" id="date_birth" placeholder="Tanggal">
                                            <small class="form-text text-danger">
                                                {{ $errors->first('date-birth') }}</small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">

                                        {{-- ADDRESS --}}
                                        <div class="form-group {{ $errors->first('address') ? 'has-error' : '' }}">
                                            <label for="address">Alamat</label>
                                            <input type="text" name="address"
                                                value="{{ old('address') ?? $student->address }}"
                                                class="form-control input-name" id="address" placeholder="Alamat">
                                            <small class="form-text text-danger">
                                                {{ $errors->first('address') }}</small>
                                        </div>
                                    </div>

                                    {{-- ARRIVAL --}}
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->first('arrival') ? 'has-error' : '' }}">
                                            <label for="arrival">Baru/Lama</label>
                                            <select class="form-control" id="arrival" name="arrival">
                                                <option value="">--PILIH BARU/LAMA--</option>

                                                <option
                                                    {{ (old('arrival') && old('arrival') == 'BARU') || $student->arrival == 'BARU' ? 'selected' : '' }}
                                                    value="BARU">BARU</option>
                                                <option
                                                    {{ (old('arrival') && old('arrival') == 'LAMA') || $student->arrival == 'LAMA' ? 'selected' : '' }}
                                                    value="LAMA">LAMA</option>


                                            </select>
                                            <small class="form-text text-danger">
                                                {{ $errors->first('arrival') }}</small>
                                        </div>
                                    </div>

                                    {{-- ROOM --}}
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->first('room') ? 'has-error' : '' }}">
                                            <label for="room">Kamar</label>
                                            <select class="form-control" id="room" name="room">
                                                <option value="">--PILIH KAMAR--</option>
                                                @foreach ($rooms as $room)
                                                    <option
                                                        {{ (old('room') && old('room') == $room->id) || $student->room_id == $room->id ? 'selected' : '' }}
                                                        value="{{ $room->id }}">{{ $room->name }}</option>
                                                @endforeach


                                            </select>
                                            <small class="form-text text-danger">
                                                {{ $errors->first('room') }}</small>
                                        </div>
                                    </div>

                                    {{-- ROLE --}}
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->first('role') ? 'has-error' : '' }}">
                                            <label for="role">Status</label>
                                            <select class="form-control" id="role" name="role">
                                                <option value="">--PILIH STATUS--</option>
                                                @foreach ($roles as $role)
                                                    <option
                                                        {{ (old('role') && old('role') == $role->id) || $student->role_id == $role->id ? 'selected' : '' }}
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
                                                        {{ (old('year') && old('year') == $season->year) || $student->year == $season->year ? 'selected' : '' }}
                                                        value="{{ $season->year }}">{{ $season->year }}</option>
                                                @endforeach


                                            </select>
                                            <small class="form-text text-danger">
                                                {{ $errors->first('year') }}</small>
                                        </div>
                                    </div>

                                    {{-- WALI --}}
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->first('user') ? 'has-error' : '' }}">
                                            <label for="user">Wali</label>
                                            <select class="form-control" id="user" name="user">
                                                <option value="">--PILIH WALI--</option>
                                                @foreach ($users as $user)
                                                    <option
                                                        {{ (old('user') && old('user') == $user->id) || $student->user_id == $user->id ? 'selected' : '' }}
                                                        value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach


                                            </select>
                                            <small class="form-text text-danger">
                                                {{ $errors->first('user') }}</small>
                                        </div>
                                    </div>

                                    {{-- KELAS --}}
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->first('grade') ? 'has-error' : '' }}">
                                            <label for="grade">Kelas</label>
                                            <select class="form-control" id="grade" name="grade">
                                                <option value="">--PILIH KELAS--</option>
                                                @foreach ($grades as $grade)
                                                    <option
                                                        {{ (old('grade') && old('grade') == $grade->id) || $student->grade_id == $grade->id ? 'selected' : '' }}
                                                        value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                @endforeach


                                            </select>
                                            <small class="form-text text-danger">
                                                {{ $errors->first('grade') }}</small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        {{-- IMAGE --}}
                                        <div class="form-group {{ $errors->first('image') ? 'has-error' : '' }}">
                                            <label for="image">Image</label>
                                            <input type="file" class="form-control-file" accept="image/*"
                                                name="image" id="image">
                                            <small class="form-text text-danger"> {{ $errors->first('image') }}</small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="avatar avatar-xxl" style="width: 400px; height: 300px;">
                                            <img src="{{ !$student->image || $student->image == '' ? asset('atlantis/img/santri.jpg') : $student->image_url }}"
                                                id="output" style="object-fit: fill;" class="avatar-img rounded">
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
