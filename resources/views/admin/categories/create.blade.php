@extends('layouts.admin')
@section('title', 'Add Category')
@section('page-title', 'Add New Category')

@section('content')
<div class="card" style="max-width:650px">
    <form method="POST" action="{{ route('admin.categories.store') }}">
        @csrf

        <div class="form-group">
            <label class="form-label">Category Name *</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="e.g. Pop, English, 2024, Michael Jackson" required>
            @error('name')<span style="color:#ef4444; font-size:12px;">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Type *</label>
            <select name="type" class="form-control" required>
                <option value="">-- Select Type --</option>
                <option value="genre" {{ old('type') == 'genre' ? 'selected' : '' }}>Genre</option>
                <option value="artist" {{ old('type') == 'artist' ? 'selected' : '' }}>Artist</option>
                <option value="album" {{ old('type') == 'album' ? 'selected' : '' }}>Album</option>
                <option value="language" {{ old('type') == 'language' ? 'selected' : '' }}>Language</option>
                <option value="year" {{ old('type') == 'year' ? 'selected' : '' }}>Year</option>
            </select>
            @error('type')<span style="color:#ef4444; font-size:12px;">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Description (Optional)</label>
            <textarea name="description" class="form-control" rows="4" placeholder="Brief details about category">{{ old('description') }}</textarea>
        </div>

        <div style="display:flex; gap:12px; margin-top:24px;">
            <button type="submit" class="btn btn-primary">Save Category</button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
