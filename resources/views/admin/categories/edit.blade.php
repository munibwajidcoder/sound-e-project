@extends('layouts.admin')
@section('title', 'Edit Category')
@section('page-title', 'Edit Category: ' . $category->name)

@section('content')
<div class="card" style="max-width:650px">
    <form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label class="form-label">Category Name *</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
            @error('name')<span style="color:#ef4444; font-size:12px;">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Type *</label>
            <select name="type" class="form-control" required>
                <option value="genre" {{ old('type', $category->type) == 'genre' ? 'selected' : '' }}>Genre</option>
                <option value="artist" {{ old('type', $category->type) == 'artist' ? 'selected' : '' }}>Artist</option>
                <option value="album" {{ old('type', $category->type) == 'album' ? 'selected' : '' }}>Album</option>
                <option value="language" {{ old('type', $category->type) == 'language' ? 'selected' : '' }}>Language</option>
                <option value="year" {{ old('type', $category->type) == 'year' ? 'selected' : '' }}>Year</option>
            </select>
            @error('type')<span style="color:#ef4444; font-size:12px;">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Description (Optional)</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description', $category->description) }}</textarea>
        </div>

        <div style="display:flex; gap:12px; margin-top:24px;">
            <button type="submit" class="btn btn-primary">Update Category</button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
