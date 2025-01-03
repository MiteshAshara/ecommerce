@extends('admin.includes.master')

@section('admin.content')
<main class="main">
    <div class="container">
        <h1 class="my-4">Edit Blog</h1>

        <form action="{{ route('blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="blog_title" class="form-label">Blog title</label>
                <input type="text" class="form-control @error('blog_title') is-invalid @enderror" id="blog_title" name="blog_title" value="{{ old('blog_title', $blog->blog_title) }}" required>
                @error('blog_title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="blog_name" class="form-label">Blog Name</label>
                <input type="text" class="form-control @error('blog_name') is-invalid @enderror" id="blog_name" name="blog_name" value="{{ old('blog_name', $blog->blog_name) }}" required>
                @error('blog_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="blog_description" class="form-label">Blog Description</label>
                <textarea class="form-control @error('blog_description') is-invalid @enderror" id="blog_description" name="blog_description" rows="4" required>{{ old('blog_description', $blog->blog_description) }}</textarea>
                @error('blog_description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="blog_image" class="form-label">Product Image</label>
                <input type="file" class="form-control @error('blog_image') is-invalid @enderror" id="blog_image" name="blog_image">
                @if($blog->blog_image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $blog->blog_image) }}" alt="Blog Image" width="100" height="auto">
                    </div>
                @endif
                @error('blog_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-dark">Update Blog</button>
            </div>
        </form>
    </div>
</main>
@endsection
