@extends('layouts.admin')
@section('title', 'Add Music')
@section('page-title', 'Add New Music Track')

@section('content')
<div class="card" style="max-width:760px">
    <form method="POST" action="{{ route('admin.music.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-grid-2">
            <div class="form-group">
                <label>Song Title *</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="Enter song title" required>
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
                    <option value="Regional" {{ old('language') === 'Regional' ? 'selected' : '' }}>Regional</option>
                    <option value="English"  {{ old('language') === 'English'  ? 'selected' : '' }}>English</option>
                </select>
            </div>
            <div class="form-group">
                <label>Duration (e.g. 3:45)</label>
                <input type="text" name="duration" class="form-control" value="{{ old('duration','3:45') }}" placeholder="3:45">
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
            <textarea name="description" class="form-control" rows="3" placeholder="Brief description of the song">{{ old('description') }}</textarea>
        </div>
        <div class="form-grid-2">
            <div class="form-group">
                <label>Cover Image (JPG/PNG)</label>
                <input type="file" name="cover_image_file" class="form-control" accept="image/*">
            </div>
            <div class="form-group">
                <label>Audio File (MP3)</label>
                <input type="file" name="audio_file" class="form-control" accept="audio/*">
            </div>
        </div>

        <div style="display:flex; gap:10px; margin-top:8px">
            <button type="submit" class="btn btn-primary">✓ Add Music Track</button>
            <a href="{{ route('admin.music.index') }}" class="btn btn-outline">Cancel</a>
        </div>
    </form>
</div>
@endsection
