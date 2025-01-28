@extends('admin.layout.admin')
@section('title', 'Edit Blog')
@section('head')
<link href="{{ asset('login/assets/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('login/assets/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
<style>
    .form-control-lg {
        height: calc(1.5em + 1rem + 2px);
        font-size: 1.25rem;
        border-radius: 0.5rem;
    }
    .card {
        border-radius: 1rem;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-footer {
        background-color: #f8f9fa;
        border-top: 1px solid #e9ecef;
    }

    .btn {
        border-radius: 0.5rem;
    }
</style>>
@endsection
@section('content')
<div class="container-fluid">
    <!-- Start Page Title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark me-1">
                        <i class="mdi mdi-chevron-double-left me-1"></i>Back
                    </a>
                    <button type="submit" class="btn btn-sm btn-success" form="blogForm">
                        <i class="mdi mdi-database me-1"></i>Update
                    </button>
                </div>
                <h4 class="page-title">Edit Blog</h4>
            </div>
        </div>
    </div>
    @include('admin.dashboard.includes.flash-message')
    <!-- End Page Title -->

    <form id="blogForm" action="{{ route('blog.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <!-- Heading -->
                    <div class="col-sm-12 form-section">
                        <label for="heading">Heading</label>
                        <input type="text" name="heading" class="form-control" placeholder="Enter Heading"
                            value="{{ old('heading', $blog->heading ?? '') }}">
                        <input type="hidden" name="id" value="{{ $blog->id ?? '' }}">
                        @error('heading')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Sub Heading -->
                    <div class="col-sm-12 form-section">
                        <label for="sub_heading">Sub Heading</label>
                        <input type="text" name="sub_heading" class="form-control"
                            value="{{ old('sub_heading', $blog->sub_heading ?? '') }}">
                    </div>

                    <!-- Name -->
                    <div class="col-sm-6 form-section">
                        <label for="name">Author Name</label>
                        <input type="text" name="name" class="form-control"
                            value="{{ old('name', $blog->name ?? '') }}">
                    </div>

                    <div class="col-sm-6 form-section">
                            <label class="col-form-label" for="categories">Blog Categories</label>
                            <select class="form-select form-control-lg" name="categories[]" id="categories" >
                                <option value="1">Technology</option>
                                <option value="2">Health</option>
                                <option value="3">Travel</option>
                                <option value="4">Lifestyle</option>
                            </select>
                            <span class="error invalid-feedback" style="display: none;">Please select at least one category.</span>
                        </div>


                 <!-- Short Description -->
                    <div class="col-sm-12 form-section">
                        <label for="short_description">Short Description</label>
                        <textarea class="form-control" name="short_description">{{ old('short_description', $blog->short_description ?? '') }}</textarea>
                    </div>

                    <!-- Description -->
                    <div class="col-sm-12 form-section">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description">{{ old('description', $blog->description ?? '') }}</textarea>
                    </div>

                    <!-- Blog Images -->
                    <div class="col-sm-6 form-section">
                        <label for="images">Blog Images</label>
                        <input type="file" name="images[]" class="form-control" multiple>
                        <input type="hidden" name="old_images" value="{{ $blog->image ?? '' }}">
                        @if (!empty($blog->image))
                        <div class="mt-2">
                            <strong>Existing Images:</strong>
                            @foreach (explode(',', $blog->image) as $img)
                            <img src="{{ asset('/blog/' . $img) }}" width="100px" height="100px"
                                class="me-2 mb-2">
                            @endforeach
                        </div>
                        @endif
                    </div>

                    <!-- Status -->
                    <div class="col-sm-6 form-section">
                        <label for="status">Status</label>
                        <select class="form-control" name="status">
                            <option value="1" {{ $blog->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $blog->status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="card-footer text-end">
                <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark me-1">
                    <i class="mdi mdi-chevron-double-left me-1"></i>Back
                </a>
                <button type="submit" class="btn btn-sm btn-success">
                    <i class="mdi mdi-database me-1"></i>Update
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    // Initialize CKEditor
    CKEDITOR.replace('short_description');
    CKEDITOR.replace('description');
</script>
@endsection