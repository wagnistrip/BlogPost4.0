@extends('admin.layout.admin')
@section('title', 'Edit Blog')
@section('head')
<link href="{{ asset('login/assets/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('login/assets/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
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
</style>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark me-1"><i class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                </div>
                <h4 class="page-title">Edit Blog</h4>
            </div>
        </div>
    </div>
    @include('admin.dashboard.includes.flash-message')
</div>

<div class="row">
    <div class="col-sm-12">
        <form id="blogEdit" method="POST" action="{{ route('blog.update', $blog->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 form-section">
                            <label class="col-form-label" for="heading">Heading <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg" id="heading" name="heading" value="{{ old('heading', $blog->heading) }}" autofocus>
                        </div>
                        <div class="col-sm-12 form-section">
                            <label class="col-form-label" for="sub_heading">Sub Heading</label>
                            <input type="text" class="form-control form-control-lg" id="sub_heading" name="sub_heading" value="{{ old('sub_heading', $blog->sub_heading) }}">
                        </div>
                        <div class="col-sm-6 form-section">
                            <label class="col-form-label" for="name">Author Name</label>
                            <input type="text" class="form-control form-control-lg" id="name" name="name" value="{{ old('name', $blog->name) }}">
                        </div>
                        <div class="col-sm-6 form-section">
                            <label class="col-form-label" for="categories">Blog Categories</label>
                            <select class="form-select form-control-lg" name="categories[]" id="categories">
                                <option value="1" {{ in_array(1, $blog->categories ?? []) ? 'selected' : '' }}>Technology</option>
                                <option value="2" {{ in_array(2, $blog->categories ?? []) ? 'selected' : '' }}>Health</option>
                                <option value="3" {{ in_array(3, $blog->categories ?? []) ? 'selected' : '' }}>Travel</option>
                                <option value="4" {{ in_array(4, $blog->categories ?? []) ? 'selected' : '' }}>Lifestyle</option>
                            </select>
                        </div>
                        <div class="col-sm-12 form-section">
                            <label class="col-form-label" for="short_description">Short Description</label>
                            <textarea id="short_description" class="form-control" name="short_description" rows="6">{{ old('short_description', $blog->short_description) }}</textarea>
                        </div>
                        <div class="col-sm-12 form-section">
                            <label class="col-form-label" for="description">Description</label>
                            <textarea id="description" class="form-control" name="description" rows="8">{{ old('description', $blog->description) }}</textarea>
                        </div>
                        <div class="col-sm-6 form-section">
                            <label class="col-form-label" for="images">Blog Images</label>
                            <input type="file" class="form-control form-control-lg" id="images" name="images[]" multiple accept="image/*">
                        </div>
                        <div class="col-sm-6 form-section">
                            <label class="col-form-label" for="status">Status</label>
                            <select class="form-select form-control-lg" name="status">
                                <option value="1" {{ $blog->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $blog->status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="preview-container mt-3" id="imagePreviewContainer" style="display: flex; gap: 10px; flex-wrap: wrap;"></div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ url()->previous() }}" class="btn btn-dark me-1"><i class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                    <button type="submit" class="btn btn-primary"><i class="mdi mdi-database me-1"></i>Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    document.getElementById('images').addEventListener('change', function(event) {
        let previewContainer = document.getElementById('imagePreviewContainer');
        previewContainer.innerHTML = ""; 

        for (let file of event.target.files) {
            if (file.type.startsWith('image/')) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    let imgWrapper = document.createElement('div');
                    imgWrapper.style.position = 'relative';
                    imgWrapper.style.display = 'inline-block';
                    
                    let img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = '100px';
                    img.style.height = '100px';
                    img.style.objectFit = 'cover';
                    img.style.border = '1px solid #ddd';
                    img.style.borderRadius = '5px';
                    
                    let removeBtn = document.createElement('span');
                    removeBtn.innerHTML = '×';
                    removeBtn.style.position = 'absolute';
                    removeBtn.style.top = '5px';
                    removeBtn.style.right = '5px';
                    removeBtn.style.background = 'red';
                    removeBtn.style.color = 'white';
                    removeBtn.style.fontWeight = 'bold';
                    removeBtn.style.width = '20px';
                    removeBtn.style.height = '20px';
                    removeBtn.style.textAlign = 'center';
                    removeBtn.style.cursor = 'pointer';
                    removeBtn.style.borderRadius = '50%';

                    removeBtn.onclick = function() {
                        imgWrapper.remove();
                    };

                    imgWrapper.appendChild(img);
                    imgWrapper.appendChild(removeBtn);
                    previewContainer.appendChild(imgWrapper);
                };
                reader.readAsDataURL(file);
            }
        }
    });
</script>
<script>
    CKEDITOR.replace('short_description');
    CKEDITOR.replace('description');
</script>
@endsection
