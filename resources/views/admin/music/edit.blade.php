@extends('layouts.admin')
@section('title', 'Edit Music')
@section('page-title', 'Edit Music Track')

@section('content')
<div class="card" style="max-width:760px">
    <form method="POST" action="{{ route('admin.music.update', $music->id) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="form-grid-2">
            <div class="form-group">
                <label>Song Title *</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $music->title) }}" required>
            </div>
            <div class="form-group">
                <label>Artist Name *</label>
                <input type="text" name="artist" class="form-control" value="{{ old('artist', $music->artist) }}" required>
            </div>
            <div class="form-group">
                <label>Album</label>
                <input type="text" name="album" class="form-control" value="{{ old('album', $music->album) }}">
            </div>
            <div class="form-group">
                <label>Release Year *</label>
                <input type="number" name="year" class="form-control" value="{{ old('year', $music->year) }}" required>
            </div>
            <div class="form-group">
                <label>Genre *</label>
                <select name="genre" class="form-control" required>
                    @foreach(['Pop','Classical Fusion','Rock','Folk','Hip-Hop','Indie','Electronic','Ambient','Retro'] as $g)
                    <option value="{{ $g }}" {{ old('genre', $music->genre) === $g ? 'selected' : '' }}>{{ $g }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Language *</label>
                <select name="language" class="form-control" required>
                    <option value="Regional" {{ old('language', $music->language) === 'Regional' ? 'selected' : '' }}>Regional</option>
                    <option value="English"  {{ old('language', $music->language) === 'English'  ? 'selected' : '' }}>English</option>
                </select>
            </div>
            <div class="form-group">
                <label>Duration</label>
                <input type="text" name="duration" class="form-control" value="{{ old('duration', $music->duration) }}">
            </div>
            <div class="form-group">
                <label>Mark as NEW</label>
                <select name="is_new" class="form-control">
                    <option value="1" {{ $music->is_new ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ !$music->is_new ? 'selected' : '' }}>No</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description', $music->description) }}</textarea>
        </div>
        <div class="form-grid-2">
            <div class="form-group">
                <label>Replace Cover Image</label>
                @if($music->cover_image)
                    <img src="/images/{{ $music->cover_image }}" style="width:80px;height:80px;object-fit:cover;border-radius:8px;margin-bottom:8px;display:block">
                @endif
                <input type="file" name="cover_image_file" class="form-control" accept="image/*">
            </div>
            <div class="form-group">
                <label>Replace Audio File</label>
                <input type="file" name="audio_file" class="form-control" accept="audio/*">
                @if($music->audio_url)<small style="color:var(--text-muted)">Current: {{ $music->audio_url }}</small>@endif
            </div>
        </div>
        <div style="display:flex; gap:10px; margin-top:8px">
            <button type="submit" class="btn btn-primary">💾 Save Changes</button>
            <a href="{{ route('admin.music.index') }}" class="btn btn-outline">Cancel</a>
        </div>
    </form>
</div>
@endsection
