@extends('layouts.admin')
@section('title', 'Add Video')
@section('page-title', 'Add New Video')

@section('content')
<div class="card" style="max-width:760px">
    <form method="POST" action="{{ route('admin.video.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-grid-2">
            <div class="form-group">
                <label>Video Title *</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="Enter video title" required>
            </div>
            <div class="form-group">
                <label>Artist Name *</label>
                <input type="text" name="artist" class="form-control" value="{{ old('artist') }}" placeholder="Artist name" required>
            </div>
            <div class="form-group">
                <label>Album</label>
                <input type="text" name="album" class="form-control" value="{{ old('album') }}" placeholder="Album name">
            </div>
            <div class="form-group">
                <label>Release Year *</label>
                <input type="number" name="year" class="form-control" value="{{ old('year', date('Y')) }}" min="1900" max="2030" required>
            </div>
            <div class="form-group">
                <label>Genre *</label>
                <select name="genre" class="form-control" required>
                    @foreach(['Pop','Classical Fusion','Rock','Folk','Hip-Hop','Indie','Electronic','Ambient','Retro'] as $g)
                    <option value="{{ $g }}" {{ old('genre') === $g ? 'selected' : '' }}>{{ $g }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Language *</label>
                <select name="language" class="form-control" required>
                    <option value="Regional">Regional</option>
                    <option value="English">English</option>
                </select>
            </div>
            <div class="form-group">
                <label>Duration (e.g. 4:30)</label>
                <input type="text" name="duration" class="form-control" value="{{ old('duration','4:30') }}">
            </div>
            <div class="form-group">
                <label>Mark as NEW</label>
                <select name="is_new" class="form-control">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="3" placeholder="Brief description">{{ old('description') }}</textarea>
        </div>
        <div class="form-grid-2">
            <div class="form-group">
                <label>Video URL (YouTube embed or direct)</label>
                <input type="text" name="video_url" class="form-control" value="{{ old('video_url') }}"
                    placeholder="https://www.youtube.com/embed/...">
            </div>
            <div class="form-group">
                <label>Thumbnail Image (JPG/PNG)</label>
                <input type="file" name="thumbnail_file" class="form-control" accept="image/*">
            </div>
        </div>
        <div style="display:flex; gap:10px; margin-top:8px">
            <button type="submit" class="btn btn-primary">✓ Add Video</button>
            <a href="{{ route('admin.video.index') }}" class="btn btn-outline">Cancel</a>
        </div>
    </form>
</div>
@endsection
