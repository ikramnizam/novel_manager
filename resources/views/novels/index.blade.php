@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Novels</h1>

        <!-- Search Form -->
        <form action="{{ route('novels.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search by title or author" value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </form>

        <a href="{{ route('novels.create') }}" class="btn btn-primary mb-3">Add New Novel</a>
        
        @if ($novels->count())
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>
                            <a href="{{ route('novels.index', ['search' => request('search'), 'sort' => 'title', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}" class="text-dark text-decoration-none">
                                Title
                                @if (request('sort') === 'title')
                                    <span>{{ request('direction') === 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ route('novels.index', ['search' => request('search'), 'sort' => 'author', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}" class="text-dark text-decoration-none">
                                Author
                                @if (request('sort') === 'author')
                                    <span>{{ request('direction') === 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ route('novels.index', ['search' => request('search'), 'sort' => 'published_at', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}" class="text-dark text-decoration-none">
                                Published At
                                @if (request('sort') === 'published_at')
                                    <span>{{ request('direction') === 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </a>
                        </th>
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
