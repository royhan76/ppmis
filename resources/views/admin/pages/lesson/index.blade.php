@extends('admin.layout.admin')
@section('title')
    Admin | Lessons
@endsection
@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Lessons</h4>
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
                        <a href="#">Lessons</a>


                    </li>
                </ul>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <a class="btn btn-primary btn-round ml-auto text-white" href="lesson/create">
                                    <i class="fa fa-plus"></i>
                                    Add lesson
                                </a>
                            </div>
                        </div>
                        <div class="card-body">


                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Grade</th>
                                            <th>Year</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($lessons as $lesson)
                                            <tr>
                                                <td>{{ $lesson->name }}</td>
                                                <td>{{ $lesson->grade->name }}</td>
                                                <td>{{ $lesson->year }}</td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="{{ route('lesson.edit', $lesson->id) }}" type="button"
                                                            data-toggle="tooltip"
                                                            class="btn btn-link btn-primary btn-lg button-edit"
                                                            data-original-title="Edit Task">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <form class="form-delete" method="POST"
                                                            onsubmit="return confirm('Apa kamu yakin?')"
                                                            action="{{ route('lesson.destroy', [$lesson->id]) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" data-toggle="tooltip"
                                                                class="btn btn-link btn-danger"
                                                                data-original-title="Remove">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <p>No lessons</p>
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
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });

                        column.data().unique().sort().each(function(d, j) {
                            select.append('<option value="' + d + '">' + d +
                                '</option>')
                        });
                    });
                }
            });

            $('#add-row').DataTable({
                "pageLength": 5,
            });

        });
    </script>
@endpush
