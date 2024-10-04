@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Novel</h1>
        <form action="{{ route('novels.update', $novel->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $novel->title) }}" required>
            </div>

            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" name="author" class="form-control" value="{{ old('author', $novel->author) }}" required>
            </div>

            <div class="form-group">
                <label for="synopsis">Synopsis</label>
                <textarea name="synopsis" class="form-control" required>{{ old('synopsis', $novel->synopsis) }}</textarea>
            </div>

            <div class="form-group">
                <label for="published_at">Published At</label>
                <input type="date" name="published_at" class="form-control" value="{{ old('published_at', $novel->published_at->format('Y-m-d')) }}" required>
            </div>

            <button type="submit" class="btn btn-success mt-3">Update</button>
        </form>
    </div>
@endsection


{{-- If the user submitted a form and validation failed, the old('title') will return the value that the user previously entered in the "title" field. --}}