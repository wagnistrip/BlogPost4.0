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
                        <button type="submit" class="btn btn-sm btn-success" form="blogCreate"><i
                                class="mdi mdi-database me-1"></i>Save</button>
                    </div>
                    <h4 class="page-title">Add Blog</h4>
                </div>
            </div>
        </div>
        @include('admin.dashboard.includes.flash-message')
        <!-- end page title -->
    </div>

    <div class="row">
        <div class="col-sm-12">
            <form id="blogCreate" method="POST" action="{{ route('blog.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 {{ $errors->has('heading') ? 'has-error' : '' }}">
                                <label class="col-form-label" for="heading">Heding <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="heading" name="heading"
                                    placeholder="Enter Heading " value="{{ old('heading') }}" autofocus>

                                @error('heading')
                                    <span id="agency-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-6 {{ $errors->has('sub_heading') ? 'has-error' : '' }}">
                                <label class="col-form-label" for="sub_heading">Sub Heading </label>
                                <input type="text" class="form-control" id="sub_heading" name="sub_heading"
                                    placeholder="Enter Subheading " value="{{ old('sub_heading') }}" autofocus>
                                @error('sub_heading')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-sm-6 {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label class="col-form-label" for="name">Name </label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Name " value="{{ old('name') }}" autofocus>
                                @error('name')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-sm-6 {{ $errors->has('short_description') ? 'has-error' : '' }}">
                                <label class="col-form-label" for="short_description">Short Description </label>
                                <textarea id="short_description" class="form-control @error('short_description') is-invalid @enderror"
                                    name="short_description" placeholder="Enter short Description">{{ old('short_description') }}</textarea>
                                @error('short_description')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-sm-6 {{ $errors->has('description') ? 'has-error' : '' }}">
                                <label class="col-form-label" for="description"> Description </label>
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description"
                                    placeholder="Enter short Description">{{ old('description') }}</textarea>
                                @error('description')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-sm-6 {{ $errors->has('image') ? 'has-error' : '' }}">
                                <label class="col-form-label" for="image"> Blog image </label>
                                <input type="file" class="form-control" id="name" name="image" value="">
                                @error('image')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-sm-6 {{ $errors->has('Status') ? 'has-error' : '' }}">
                                <label class="col-form-label" for="Status"> Status </label>
                                <select class="form-select" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                @error('Status')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark me-1"><i
                                class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                        <button type="submit" class="btn btn-sm btn-primary" form="blogCreate"><i
                                class="mdi mdi-database me-1"></i>Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div> <!-- container -->
@endsection
