@extends('layouts.admin')
@section('title', 'Edit Video')
@section('page-title', 'Edit Video')

@section('content')
<div class="card" style="max-width:760px">
    <form method="POST" action="{{ route('admin.video.update', $video->id) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="form-grid-2">
            <div class="form-group">
                <label>Video Title *</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $video->title) }}" required>
            </div>
            <div class="form-group">
                <label>Artist Name *</label>
                <input type="text" name="artist" class="form-control" value="{{ old('artist', $video->artist) }}" required>
            </div>
            <div class="form-group">
                <label>Album</label>
                <input type="text" name="album" class="form-control" value="{{ old('album', $video->album) }}">
            </div>
            <div class="form-group">
                <label>Release Year *</label>
                <input type="number" name="year" class="form-control" value="{{ old('year', $video->year) }}" required>
            </div>
            <div class="form-group">
                <label>Genre *</label>
                <select name="genre" class="form-control" required>
                    @foreach(['Pop','Classical Fusion','Rock','Folk','Hip-Hop','Indie','Electronic','Ambient','Retro'] as $g)
                    <option value="{{ $g }}" {{ old('genre', $video->genre) === $g ? 'selected' : '' }}>{{ $g }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Language *</label>
                <select name="language" class="form-control" required>
                    <option value="Regional" {{ old('language', $video->language) === 'Regional' ? 'selected' : '' }}>Regional</option>
                    <option value="English"  {{ old('language', $video->language) === 'English'  ? 'selected' : '' }}>English</option>
                </select>
            </div>
            <div class="form-group">
                <label>Duration</label>
                <input type="text" name="duration" class="form-control" value="{{ old('duration', $video->duration) }}">
            </div>
            <div class="form-group">
                <label>Mark as NEW</label>
                <select name="is_new" class="form-control">
                    <option value="1" {{ $video->is_new ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ !$video->is_new ? 'selected' : '' }}>No</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description', $video->description) }}</textarea>
        </div>
        <div class="form-grid-2">
            <div class="form-group">
                <label>Video URL</label>
                <input type="text" name="video_url" class="form-control" value="{{ old('video_url', $video->video_url) }}">
            </div>
            <div class="form-group">
                <label>Replace Thumbnail</label>
                @if($video->thumbnail)
                    <img src="/images/{{ $video->thumbnail }}" style="width:80px;height:80px;object-fit:cover;border-radius:8px;margin-bottom:8px;display:block">
                @endif
                <input type="file" name="thumbnail_file" class="form-control" accept="image/*">
            </div>
        </div>
        <div style="display:flex; gap:10px; margin-top:8px">
            <button type="submit" class="btn btn-primary">💾 Save Changes</button>
            <a href="{{ route('admin.video.index') }}" class="btn btn-outline">Cancel</a>
        </div>
    </form>
</div>
@endsection
