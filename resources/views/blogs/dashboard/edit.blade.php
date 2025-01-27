@extends('admin.layout.admin')
@section('title', 'BlogEdit')
@section('head')
    <link href="{{ asset('login/assets/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('login/assets/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark me-1"><i
                                class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                        <button type="submit" class="btn btn-sm btn-success" form="employeeForm"><i
                                class="mdi mdi-database me-1"></i>Update</button>
                    </div>
                    <h4 class="page-title">Edit Blog</h4>
                </div>
            </div>
        </div>
        @include('admin.dashboard.includes.flash-message')
        <!-- end page title -->
    </div> <!-- container -->
    <form class="property"  id="employeeForm" action="{{ route('blog.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 mb-2">
                        <div class="form-group">
                            <label>Heding</label>
                            <input type="text" name="heading" class="form-control" placeholder="Enter Heding"
                                value="@if (!empty($blog->heading)) {{ $blog->heading }} @endif">
                            <input name="id" class="form-control" type="hidden"
                                value="@if (!empty($blog->id)) {{ $blog->id }} @endif">
                            @if ($errors->has('heading'))
                                <span class="text-danger">{{ $errors->first('heading') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6 mb-2">
                        <div class="form-group">
                            <label>Sub Heding</label>
                            <input type="text" name="sub_heading" class="form-control"
                                value="@if (!empty($blog->sub_heading)) {{ $blog->sub_heading }} @endif">
                        </div>
                    </div>
                    <div class="col-sm-6 mb-2">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control"
                                    value="@if (!empty($blog->name)) {{ $blog->name }} @endif">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-2">
                        <div class="form-group">
                            <label><strong>Short Description</strong></label>
                            <textarea class="ckeditor form-control" name="short_description">
                                    @if (!empty($blog->short_description))
        {{ $blog->short_description }}
        @endif
                                    </textarea>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-2">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label" for="address">Description</label>
                                <textarea class="ckeditor form-control" name="description">
                                        @if (!empty($blog->description))
                               {{ $blog->description }}
                          @endif
                                        </textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 mb-2">
                        <div class="form-group">
                            @if ($errors->has('image'))
                                <span class="text-danger">{{ $errors->first('image') }}</span>
                            @endif
                            <label class="col-form-label" for="address">Blog image</label>
                            <div class="image-upload">
                                <input type="file" name="image">
                                <input type="hidden" name="old_image">
                                @if (!empty($blog->image))
                                    <img src="{{ asset('/blog/' . $blog->image) }}" width="100px" height="100px">
                                @endif
                                <div class="image-uploads">
                                    <img src="{{ asset('assets/img/icons/upload.svg') }}" alt="img">
                                    <h4>Drag and drop a file to upload</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 mb-2">
                        <div class="form-group">
                            <label class="col-form-label" for="address">Status</label>
                            <select class="form-control" name="status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                    </div>

                    <div class="card-footer text-end">
                        <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark me-1"><i
                                class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                        <button type="submit" class="btn btn-sm btn-success" form="employeeForm"><i
                                class="mdi mdi-database me-1"></i>Update</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
@endsection
