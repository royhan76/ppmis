@extends('admin.layout.admin')
@section('title')
    Admin | Article
@endsection
@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Article</h4>
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
                        <a href="#">Article</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Detail Article</a>
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


                            <div class="table" style="word-break: break-all;">
                                <table id="add-row" class="display table table-striped table-hover">

                                    <tbody>
                                        <tr>
                                            <td style="width: 150px;">Image</td>
                                            <td>
                                                <div class="avatar avatar-xl m-2">
                                                    <img src="{{ $article->image_url }}" alt=" ..."
                                                        class="avatar-img rounded">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Title</td>
                                            <td>{{ $article->title }}</td>
                                        </tr>
                                        <tr>
                                            <td>Title</td>
                                            <td>{{ $article->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Title</td>
                                            <td>{{ $article->caption }}</td>
                                        </tr>
                                        <tr>
                                            <td>Content</td>
                                            <td>{!! $article->content !!}</td>
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

