@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Novels</h1>
        <a href="{{ route('novels.create') }}" class="btn btn-primary mb-3">Add New Novel</a>
        
        @if ($novels->count())
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Published At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($novels as $novel)
                        <tr>
                            <td>{{ $novel->title }}</td>
                            <td>{{ $novel->author }}</td>
                            <td>{{ $novel->published_at->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('novels.show', $novel->id) }}" class="btn btn-info btn-sm">Details</a>
                                <a href="{{ route('novels.edit', $novel->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('novels.destroy', $novel->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
             <!-- Pagination Links -->
             <div class="d-flex justify-content-center">
                {{ $novels->links() }}
            </div>
        @else
            <p>No novels found.</p>
        @endif
    </div>
@endsection
