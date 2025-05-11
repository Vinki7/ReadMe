@extends('layouts.app')
@section('title', 'Add Author')

@section('content')
<main class="container py-5">
    <h1 class="mb-4">Add Author</h1>

    <form method="POST" action="{{ route('admin.author.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">First Name</label>
            <input name="name" id="name" class="form-control" required>
            @error('name')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Last Name</label>
            <input name="surname" id="surname" class="form-control" required>
            @error('surname')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Birth date</label>
            <input type="date" name="birth_date" id="birth_date" class="form-control" required>
            @error('birth_date')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Biography</label>
            <textarea name="biography" id="biography" class="form-control" required></textarea>
            @error('biography')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Add Author</button>
        <a href="{{ route('admin.listing') }}" class="btn btn-outline-secondary">Cancel</a>
    </form>
</main>
@endsection