@extends('admin.layout.admin')
@section('title')
    Admin | Profile
@endsection
@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Profile</h4>
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
                </ul>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <a class="btn btn-primary btn-round ml-auto text-white"
                                    href="{{ route('profile.edit', $profile->id) }}">
                                    <i class="fa fa-edit"></i>
                                    Edit Profile
                                </a>
                            </div>
                        </div>
                        <div class="card-body">


                            <div class="table" style="word-break: break-all;">
                                <table id="add-row" class="display table table-striped table-hover">

                                    <tbody>
                                        <tr>
                                            <td style="width: 150px;">Logo</td>
                                            <td>
                                                <div class="avatar avatar-xl m-2">
                                                    <img src="{{ $profile->logo_url }}" alt=" ..."
                                                        class="avatar-img rounded">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Registration</td>
                                            <td>
                                                <embed class="m-2" src="{{ $profile->registration_url }}"
                                                    width="500px" height="300px" />

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Title</td>
                                            <td>{{ $profile->title }}</td>
                                        </tr>
                                        <tr>
                                            <td>Image</td>
                                            <td>
                                                <div class="avatar avatar-xl m-2">
                                                    <img src="{{ $profile->image_url }}" alt=" ..."
                                                        class="avatar-img rounded">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Content</td>
                                            <td>{!! $profile->content !!}</td>
                                        </tr>

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
    {{-- <script>
        $(document).ready(function() {
                    // let mainUrl = {{ Illuminate\Support\Js::from(Request::url()) }};
                    // let token = {{ Illuminate\Support\Js::from(csrf_token()) }};

                    // var isStoreErrror = {{ Illuminate\Support\Js::from($errors->any()) }};

                    // if (isStoreErrror) {
                    //     showAlert("Berhasil!", status, "danger");
                    // }

                    var status = {{ Illuminate\Support\Js::from(session('status')) }};
                    if (status) {
                        showAlert("Success!", status, "success");
                    }

                    function showAlert(status, message, type) {
                        swal(status, message, {
                            icon: type,
                            buttons: {
                                confirm: {
                                    className: 'btn btn-' + type
                                }
                            },
                        });
                    }

                    // function onUpdate(id){
                    //     console.log("UPDATE " +  id)
                    // }


                    //$(".form-delete").submit();
                    //});

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

                    $('#basic-datatables').DataTable({});

                    $('#multi-filter-select').DataTable({
                            "pageLength": 5,
                            initComplete: function() {
                                this.api().columns().every(function() {
                                        var column = this;
                                        var select = $(
                                                '<select class="form-control"><option value=""></option></select>'
                                                )
                                            .appendTo($(column.footer()).empty())
                                            .on('change', function() {
                                                    var val = $.fn.dataTable.util.escapeRegex(
                                                        $(this).val()
                                                    );

                                                    column
                                                        .search(val ? '^' + val + '@endpush : '
                                                            ', true, false )
                                                            .draw();
                                                        });

                                                column.data().unique().sort().each(function(d, j) {
                                                    select.append('<option value="' + d + '">' + d +
                                                        '</option>')
                                                });
                                            });
                                }
                            });

                        // Add Row
                        $('#add-row').DataTable({
                            "pageLength": 5,
                        });
                    });
    </script> --}}
@endpush
