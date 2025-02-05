@extends('admin.layout.admin')
@section('title', 'Create Categories')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark me-1"><i
                        class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                </div>
                <h4 class="page-title">Create Categories</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form id="CategoriesForm" method="POST" action="{{ route('category.update',$category->id) }}">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="name" class="col-form-label">Categories Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Categories Name"
                                value="{{ old('name',$category->name) }}">
                            @error('name')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark me-1"><i
                            class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                    <button type="submit" class="btn btn-sm btn-primary" form="CategoriesForm"><i
                            class="mdi mdi-database me-1"></i>Update</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
