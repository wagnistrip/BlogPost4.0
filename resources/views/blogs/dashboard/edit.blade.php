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
                        <div class="col-sm-6 form-section">
                            <label class="col-form-label" for="heading">Heading <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg" id="heading" name="heading" value="{{ old('heading', $blog->title) }}" autofocus>
                        </div>
                        <div class="col-sm-6 form-section">
                            <label class="col-form-label" for="sub_heading">Sub Heading</label>
                            <input type="text" class="form-control form-control-lg" id="sub_heading" name="sub_heading" value="{{ old('sub_heading', $blog->sub_title) }}">
                        </div>
                     
                        <div class="col-sm-12 form-section">
                            <label class="col-form-label" for="categories">Blog Categories</label>
                            <select class="form-select form-control-lg" name="categories" id="categories">
                                <option value="">Select Category</option> <!-- Default placeholder -->
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $blog->category_id ? 'selected': ' ' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            <span class="error invalid-feedback" style="display: none;">Please select at least one category.</span>
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
                        <div class="preview-container mt-3" id="imagePreviewContainer" style="display: flex; gap: 10px; flex-wrap: wrap;">
                            @foreach ($blog->images as $image)
                                <div class="image-wrapper" style="position: relative; display: inline-block;">
                                    <img src="{{ asset('storage/' . $image->image_path) }}"
                                         class="img-preview" width="100" height="100"
                                         style="object-fit: cover; border: 1px solid #ddd; border-radius: 5px;">

                                    <span class="remove-btn" data-image-id="{{ $image->id }}"
                                          style="position: absolute; top: 5px; right: 5px; background: red; color: white;
                                                 font-weight: bold; width: 20px; height: 20px; text-align: center;
                                                 cursor: pointer; border-radius: 50%;">
                                        ×
                                    </span>
                                </div>
                            @endforeach
                        </div>
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
  document.addEventListener('DOMContentLoaded', function () {
    let previewContainer = document.getElementById('imagePreviewContainer');

    // Handle new image selection
    document.getElementById('images').addEventListener('change', function (event) {
        for (let file of event.target.files) {
            if (file.type.startsWith('image/')) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    let imgWrapper = document.createElement('div');
                    imgWrapper.classList.add('image-wrapper');
                    imgWrapper.style.position = 'relative';
                    imgWrapper.style.display = 'inline-block';

                    let img = document.createElement('img');
                    img.src = e.target.result;
                    img.width = 100;
                    img.height = 100;
                    img.style.objectFit = 'cover';
                    img.style.border = '1px solid #ddd';
                    img.style.borderRadius = '5px';

                    let removeBtn = document.createElement('span');
                    removeBtn.innerHTML = '×';
                    removeBtn.classList.add('remove-btn');
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

                    removeBtn.onclick = function () {
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

    // Handle removal of existing images
    document.querySelectorAll('.remove-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            let imageId = this.getAttribute('data-image-id');
            let imageWrapper = this.parentElement;

                $.ajax({
                    url: "{{ route('deleteImage.blog') }}",
                        type: "post",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id:imageId
                        },
                success: function(response) {
                if (response) {
                    imageWrapper.remove();
                } else {
                    alert('Error deleting image.');
                }
            },
            error: function(xhr, status, error) {
                console.error("Error deleting image:", error);
                alert('Something went wrong. Please try again.');
            }
            });

        });
    });
});

</script>
<script>
    CKEDITOR.replace('short_description');
    CKEDITOR.replace('description');
</script>
@endsection
