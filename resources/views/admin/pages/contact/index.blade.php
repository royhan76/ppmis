@extends('admin.layout.admin')
@section('title')
    Admin | Users
@endsection
@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Contact</h4>
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
                        <a href="#">Contact</a>


                    </li>
                </ul>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">

                        </div>
                        <div class="card-body">


                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Label</th>
                                            <th>URL</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($contacts as $contact)
                                            <tr>
                                                <td>{{ $contact->name }}</td>
                                                <td>{{ $contact->label }}</td>
                                                <td>{{ $contact->url }}</td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="{{ route('contact.edit', $contact->name) }}" type="button"
                                                            data-toggle="tooltip"
                                                            class="btn btn-link btn-primary btn-lg button-edit"
                                                            data-original-title="Edit Task">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <p>No contacts</p>
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

            $('#basic-datatables').DataTable({
			});

           $('#multi-filter-select').DataTable( {
				"pageLength": 5,
				initComplete: function () {
					this.api().columns().every( function () {
						var column = this;
						var select = $('<select class="form-control"><option value=""></option></select>')
						.appendTo( $(column.footer()).empty() )
						.on( 'change', function () {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
								);

							column
							.search( val ? '^'+val+'$' : '', true, false )
							.draw();
						} );

						column.data().unique().sort().each( function ( d, j ) {
							select.append( '<option value="'+d+'">'+d+'</option>' )
						} );
					} );
				}
			});

            // Add Row
			$('#add-row').DataTable({
				"pageLength": 5,
			});
        });
    </script>
@endpush
