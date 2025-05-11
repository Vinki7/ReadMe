@extends('layouts.app')
@section('title', 'Add Author')

@section('content')
<main class="container py-5">
    <h1 class="mb-4">Add Author</h1>

    <form method="POST" action="{{ route('admin.author.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">First Name</label>
            <input name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Last Name</label>
            <input name="surname" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Birth date</label>
            <input type="date" name="birth_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Biography</label>
            <textarea name="biography" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Add Author</button>
        <a href="{{ route('admin.listing') }}" class="btn btn-outline-secondary">Cancel</a>
    </form>
</main>
@endsection