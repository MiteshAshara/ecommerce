@extends('admin.includes.master')

@section('admin.content')
<main class="main">
    <div class="container">
        <h1 class="my-4">Blogs</h1>

        <!-- Products Table -->
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th>Title</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Image</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($blogs as $blog)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{$blog->blog_title}}</td>
                    <td>{{ $blog->blog_name }}</td>
                    <td>{{ $blog->blog_description }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $blog->blog_image) }}" alt="{{ $blog->blog_name }}" width="100" height="auto">
                    </td>
                    <td>{{ $blog->created_at->format('d-m-Y') }}</td>
                    <td>    
                        <a href="{{ route('blog.edit', $blog->id) }}" class="btn btn-dark btn-sm" style="display:inline;">Edit</a>
                        <form action="{{ route('blog.destroy', $blog->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-dark btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>
@endsection
