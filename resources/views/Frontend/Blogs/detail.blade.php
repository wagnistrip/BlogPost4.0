@extends('frontend.layout.master')

@section('content')
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">
                <div class="pb-3">
                    <div class="blog-item">
                        <div class="position-relative">
                            <img class="img-fluid w-100" src="{{ asset('storage/' . ($blog->images->first()->image_path ?? 'default.jpg')) }}" alt="{{ $blog->title }}">
                            <div class="blog-date">
                                <h6 class="font-weight-bold mb-n1">{{ date('d', strtotime($blog->created_at)) }}</h6>
                                <small class="text-white text-uppercase">{{ date('M', strtotime($blog->created_at)) }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white mb-3" style="padding: 30px;">
                        <div class="d-flex mb-3">
                            <a class="text-primary text-uppercase text-decoration-none" href="">{{ $blog->user->name ?? 'Admin' }}</a>
                            <span class="text-primary px-2">|</span>
                            <a class="text-primary text-uppercase text-decoration-none" href="">{{ $blog->category->name ?? 'Uncategorized' }}</a>
                        </div>
                        <h2 class="mb-3">{{ $blog->title }}</h2>

                        @php
                        $paragraphs = explode("\n", $blog->description);
                        $images = $blog->images;
                        $imageIndex = 1;
                        @endphp

                        @foreach($paragraphs as $index => $paragraph)
                        <p>{{ $paragraph }}</p>

                        @if(isset($images[$imageIndex]))
                        <img class="img-fluid w-50 {{ $index % 2 == 0 ? 'float-left mr-4 mb-2' : 'float-right ml-4 mb-2' }}"
                            src="{{ asset('storage/' . $images[$imageIndex]->image_path) }}"
                            alt="Blog Image">
                        @php $imageIndex++; @endphp
                        @endif
                        @endforeach

                    </div>
                </div>
            </div>


            <div class="col-lg-4 mt-5 mt-lg-0">
                <!-- Category List -->
                <div class="mb-5">
                    <h4 class="text-uppercase mb-4" style="letter-spacing: 5px;">Categories</h4>
                    <div class="bg-white" style="padding: 30px;">
                        <ul class="list-inline m-0">
                            @foreach($categories as $category)
                            <li class="mb-2 d-flex justify-content-between align-items-center">
                                <a class="text-dark" href="">
                                    <i class="fa fa-angle-right text-primary mr-2"></i>{{ $category->name }}
                                </a>
                                <span class="badge badge-primary badge-pill">{{ $category->blogs_count }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- Recent Post -->
                <div class="mb-5">
                    <h4 class="text-uppercase mb-4" style="letter-spacing: 5px;">Recent Posts</h4>
                    @foreach($recentPosts as $recent)
                    <a class="d-flex align-items-center text-decoration-none bg-white mb-3"
                        href="{{ route('blog.details', $recent->slug) }}">
                        <img class="img-fluid" src="{{ asset('storage/' . $recent->images->first()->image_path) }}"
                            alt="{{ $recent->title }}" style="width: 100px; height: 100px; object-fit: cover;">
                        <div class="pl-3">
                            <h6 class="m-1">{{ Str::limit($recent->title, 40) }}</h6>
                            <small>{{ date('M d, Y', strtotime($recent->created_at)) }}</small>
                        </div>
                    </a>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>
@endsection