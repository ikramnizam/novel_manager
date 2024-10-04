@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $novel->title }}</h1>
        <p><strong>Author:</strong> {{ $novel->author }}</p>
        <p><strong>Published At:</strong> {{ $novel->published_at->format('Y-m-d') }}</p>
        <p><strong>Synopsis:</strong> {{ $novel->synopsis }}</p>

        <a href="{{ route('novels.index') }}" class="btn btn-secondary">Back</a>
        <a href="{{ route('novels.edit', $novel->id) }}" class="btn btn-warning">Edit</a>
        
        <form action="{{ route('novels.destroy', $novel->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
@endsection
