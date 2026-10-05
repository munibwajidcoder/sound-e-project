@extends('layouts.app')

@section('title', 'Videos - Browse All 4K Concerts & Music Videos')
@section('meta_description', 'Browse all Regional and English videos by Album, Artist, Year, Genre.')

@push('styles')
<style>
.video-card-container {
    background: rgba(18, 24, 43, 0.8);
    border-radius: 18px;
    overflow: hidden;
    border: 1px solid rgba(255, 255, 255, 0.08);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    position: relative;
}
.video-card-container:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 20px 40px rgba(99, 102, 241, 0.4);
    border-color: rgba(99, 102, 241, 0.6);
}

/* Strict 16:9 Aspect Ratio for YouTube Video Containers */
.video-aspect-wrap {
    position: relative;
    width: 100%;
    aspect-ratio: 16 / 9;
    overflow: hidden;
    background: #0f172a;
}
.video-aspect-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}
.video-card-container:hover .video-aspect-wrap img {
    transform: scale(1.08);
}

.play-video-overlay {
    position: absolute;
    inset: 0;
    background: rgba(10, 13, 24, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
    backdrop-filter: blur(3px);
}
.video-card-container:hover .play-video-overlay {
    opacity: 1;
}
.play-video-btn {
    width: 52px; height: 52px;
    border-radius: 50%;
    background: linear-gradient(135deg, #ec4899, #f59e0b);
    color: #fff;
    display: flex; align-items: center; justify-content: center;
    font-size: 20px;
    box-shadow: 0 8px 20px rgba(236, 72, 153, 0.6);
}

.video-grid-4col {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(270px, 1fr));
    gap: 24px;
    padding: 24px 0;
}
</style>
@endpush

@section('content')
<div style="padding:40px 0 20px; background:radial-gradient(circle at 50% 20%, rgba(99,102,241,0.15) 0%, transparent 70%);">
    <div class="container">
        <span class="badge badge-info" style="margin-bottom:8px; padding:6px 16px; border-radius:30px;">🎬 4K CONCERTS & OFFICIAL VIDEOS</span>
        <h1 style="font-size:2.4rem; font-weight:900; color:#fff;">Video Catalog</h1>
        <p style="color:#94a3b8; font-size:1rem;">Browse 4K live concerts and official music videos by Artist, Album, Year, and Language.</p>
    </div>
</div>

<div class="container">
    <!-- Filters -->
    <form method="GET" action="{{ route('video.index') }}" style="margin-bottom:20px;">
        <div style="display:flex; flex-wrap:wrap; gap:12px; align-items:center; padding:16px; background:rgba(18,24,43,0.6); border-radius:14px; border:1px solid rgba(255,255,255,0.08);">
            <select name="language" onchange="this.form.submit()" class="form-control" style="width:auto;">
                <option value="">All Languages</option>
                @foreach($languages as $lang)
                    <option value="{{ $lang }}" {{ request('language') === $lang ? 'selected' : '' }}>{{ $lang }}</option>
                @endforeach
            </select>

            <select name="genre" onchange="this.form.submit()" class="form-control" style="width:auto;">
                <option value="">All Genres</option>
                @foreach($genres as $genre)
                    <option value="{{ $genre }}" {{ request('genre') === $genre ? 'selected' : '' }}>{{ $genre }}</option>
                @endforeach
            </select>

            <select name="year" onchange="this.form.submit()" class="form-control" style="width:auto;">
                <option value="">All Years</option>
                @foreach($years as $year)
                    <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                @endforeach
            </select>

            @if(request()->hasAny(['language','genre','year','artist','album']))
                <a href="{{ route('video.index') }}" class="btn btn-secondary btn-sm">✕ Clear Filters</a>
            @endif
        </div>
    </form>

    <!-- Video Grid 16:9 Ratio -->
    <div class="video-grid-4col">
        @forelse($videos as $video)
        <div class="video-card-container">
            <div class="video-aspect-wrap">
                <img src="{{ $video->getThumbnailUrl() }}" alt="{{ $video->title }}">
                <a href="{{ route('video.show', $video->id) }}" class="play-video-overlay">
                    <div class="play-video-btn">🎬</div>
                </a>
                <div style="position:absolute; bottom:8px; right:8px; background:rgba(0,0,0,0.85); color:#fff; font-size:0.72rem; font-weight:700; padding:2px 8px; border-radius:4px;">
                    {{ $video->duration }}
                </div>
            </div>
            <div style="padding:16px;">
                <h3 style="font-size:1rem; font-weight:800; color:#fff; margin-bottom:4px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                    <a href="{{ route('video.show', $video->id) }}" style="color:inherit; text-decoration:none;">{{ $video->title }}</a>
                </h3>
                <p style="color:#f472b6; font-size:0.85rem; font-weight:600; margin-bottom:8px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                    {{ $video->artist }}
                </p>
                <div style="display:flex; justify-content:space-between; align-items:center; font-size:0.8rem; color:#94a3b8;">
                    <span>👁 {{ number_format($video->views) }} views</span>
                    <span style="color:#f59e0b; font-weight:700;">★ {{ number_format($video->rating, 1) }}</span>
                </div>
            </div>
        </div>
        @empty
        <div style="grid-column:1/-1; text-align:center; padding:60px 0; color:#94a3b8;">
            <div style="font-size:3rem; margin-bottom:16px">🎬</div>
            <h3 style="color:#fff; margin-bottom:8px">No videos found</h3>
            <p>Try changing your filters or <a href="{{ route('video.index') }}" style="color:var(--primary-lt)">browse all videos</a></p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div style="margin-top:20px;">
        {{ $videos->links() }}
    </div>
</div>
@endsection
