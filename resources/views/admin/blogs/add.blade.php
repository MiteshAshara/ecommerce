@extends('admin.includes.master')

@section('admin.content')
<main class="main">
    <div class="container">
        <h1 class="my-4">Add Blogs</h1>
        <form method="POST" action="{{route('blog.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="blog_title" class="form-label">Blog Title</label>
                <input type="text" class="form-control @error('blog_title') is-invalid @enderror" id="blog_title" name="blog_title" value="{{ old('blog_title') }}" required>
                @error('blog_title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="blog_name" class="form-label">Blog Name</label>
                <input type="text" class="form-control @error('blog_name') is-invalid @enderror" id="blog_name" name="blog_name" value="{{ old('blog_name') }}" required>
                @error('blog_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="blog_description" class="form-label">Blog Description</label>
                <textarea class="form-control @error('blog_description') is-invalid @enderror" id="blog_description" name="blog_description" rows="3" required>{{ old('blog_description') }}</textarea>
                @error('blog_description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="blog_image" class="form-label">Blog Image</label>
                <input type="file" class="form-control @error('blog_image') is-invalid @enderror" id="blog_image" name="blog_image" required>
                @error('blog_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-dark">Add Blog</button>
        </form>
    </div>
</main>
@endsection
