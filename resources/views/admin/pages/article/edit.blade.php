@extends('admin.layout.admin')
@section('title')
    Admin | Users
@endsection
@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Add Users</h4>
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
                        <a href="#">Users</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Add User</a>
                    </li>
                </ul>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <a class="btn btn-primary btn-round ml-auto text-white"
                                    href="{{ route('article.index') }}">
                                    <i class="fa fa-arrow-left"></i>
                                    Back
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('article.update', $article->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="oldimage" value="{{ $article->image }}">
                                <div class="row">
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
                                        <div class="avatar avatar-xxl" style="width: 400px; height: 300px;">
                                            <img src="{{ $article->image_url }}" id="output" style="object-fit: fill;"
                                                class="avatar-img rounded">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        {{-- TITLE --}}
                                        <div class="form-group {{ $errors->first('title') ? 'has-error' : '' }}">
                                            <label for="title">Title</label>
                                            <input type="text" value="{{ old('title') ?? $article->title }}" name="title"
                                                class="form-control" id="title" placeholder="Enter title">
                                            <small class="form-text text-danger"> {{ $errors->first('title') }}</small>
                                        </div>
                                    </div>
                                    {{-- CATEGORY --}}
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->first('category') ? 'has-error' : '' }}">
                                            <label for="category_id">Category</label>
                                            <select class="form-control" id="category" name="category">
                                                <option value="">SELECT CATEGORY</option>
                                                @foreach ($categories as $category)
                                                    <option
                                                        {{ (old('category') && old('category') == $category->id? 'selected': $article->category_id == $category->id)? 'selected': '' }}
                                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach


                                            </select>
                                            <small class="form-text text-danger">
                                                {{ $errors->first('category') }}</small>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        {{-- CAPTION --}}
                                        <div class="form-group {{ $errors->first('caption') ? 'has-error' : '' }}">
                                            <label for="caption">Image Caption</label>
                                            <input type="text" value="{{ old('caption') ?? $article->caption }}"
                                                name="caption" class="form-control" id="caption"
                                                placeholder="Enter Caption">
                                            <small class="form-text text-danger">
                                                {{ $errors->first('caption') }}</small>
                                        </div>
                                    </div>





                                    <div class="col-md-12">
                                        <div class="form-group {{ $errors->first('content') ? 'has-error' : '' }}">
                                            <label for="content">Content</label>
                                            <textarea name="content" id="content" rows="10"
                                                cols="80">{!! old('content') ?? $article->content !!}</textarea>
                                            <small class="form-text text-danger"> {{ $errors->first('content') }}</small>
                                            <div>
                                            </div>
                                        </div>
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
