@extends('layouts.app')

@section('title', 'Videos - Browse All 4K Concerts & Music Videos')
@section('meta_description', 'Browse all Regional and English videos by Album, Artist, Year, Genre in Ultra HD 4K.')

@push('styles')
<style>
    /* Hero Header */
    .video-hero {
        position: relative;
        padding: 60px 0 40px;
        background: radial-gradient(circle at 50% 20%, rgba(236, 72, 153, 0.2) 0%, rgba(99, 102, 241, 0.12) 45%, transparent 75%);
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        overflow: hidden;
    }
    .video-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(rgba(255,255,255,0.06) 1px, transparent 1px);
        background-size: 30px 30px;
        opacity: 0.3;
        pointer-events: none;
    }

    .hero-badge-video {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 18px;
        background: rgba(236, 72, 153, 0.15);
        border: 1px solid rgba(236, 72, 153, 0.4);
        border-radius: 50px;
        color: #f472b6;
        font-size: 0.82rem;
        font-weight: 800;
        letter-spacing: 1.2px;
        text-transform: uppercase;
        box-shadow: 0 0 20px rgba(236, 72, 153, 0.25);
    }

    .hero-title-video {
        font-family: 'Outfit', sans-serif;
        font-size: clamp(2.2rem, 5vw, 3.4rem);
        font-weight: 900;
        letter-spacing: -0.8px;
        background: linear-gradient(135deg, #ffffff 30%, #f472b6 65%, #818cf8 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin: 14px 0;
        line-height: 1.15;
    }

    .video-stats-row {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 25px;
        margin-top: 28px;
        flex-wrap: wrap;
    }

    .v-stat-pill {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 22px;
        background: rgba(18, 24, 43, 0.7);
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(12px);
        border-radius: 50px;
        color: #cbd5e1;
        font-size: 0.88rem;
    }
    .v-stat-pill strong {
        color: #fff;
        font-size: 1.05rem;
        font-weight: 800;
    }

    /* Sticky Filter Bar */
    .video-filter-bar {
        position: sticky;
        top: 72px;
        z-index: 40;
        padding: 16px 0;
        background: rgba(7, 10, 20, 0.88);
        backdrop-filter: blur(18px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        margin-bottom: 35px;
    }

    .video-search-wrap {
        position: relative;
        flex-grow: 1;
        max-width: 400px;
    }
    .v-search-input {
        width: 100%;
        padding: 11px 20px 11px 44px;
        background: rgba(18, 24, 43, 0.85);
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 50px;
        color: #fff;
        font-size: 0.9rem;
        outline: none;
        transition: all 0.3s ease;
    }
    .v-search-input:focus {
        border-color: #ec4899;
        box-shadow: 0 0 20px rgba(236, 72, 153, 0.3);
        background: rgba(25, 33, 56, 0.95);
    }
    .v-search-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 1rem;
        pointer-events: none;
    }

    .v-select-custom {
        padding: 10px 38px 10px 16px;
        background: rgba(18, 24, 43, 0.85);
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 50px;
        color: #cbd5e1;
        font-size: 0.88rem;
        font-weight: 600;
        outline: none;
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23a5b4fc' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 14px center;
        transition: all 0.25s ease;
    }
    .v-select-custom:hover, .v-select-custom:focus {
        border-color: #818cf8;
        color: #fff;
        background-color: rgba(25, 33, 56, 0.95);
    }

    /* Video Card Grid */
    .video-grid-4col {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 26px;
    }

    .video-card-container {
        background: rgba(18, 24, 43, 0.75);
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.08);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(12px);
        transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
        display: flex;
        flex-direction: column;
    }

    .video-card-container:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 25px 50px -12px rgba(236, 72, 153, 0.35);
        border-color: rgba(236, 72, 153, 0.5);
    }

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
        transition: transform 0.5s ease;
    }

    .video-card-container:hover .video-aspect-wrap img {
        transform: scale(1.08);
    }

    .play-video-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(7, 10, 20, 0.85) 0%, rgba(7, 10, 20, 0.4) 50%, transparent 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.35s ease;
        backdrop-filter: blur(2px);
    }

    .video-card-container:hover .play-video-overlay {
        opacity: 1;
    }

    .play-video-btn {
        width: 58px;
        height: 58px;
        border-radius: 50%;
        background: linear-gradient(135deg, #ec4899, #6366f1);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        box-shadow: 0 0 25px rgba(236, 72, 153, 0.8);
        transform: scale(0.7);
        transition: transform 0.35s ease;
    }

    .video-card-container:hover .play-video-btn {
        transform: scale(1);
    }

    .badge-duration {
        position: absolute;
        bottom: 10px;
        right: 10px;
        background: rgba(7, 10, 20, 0.85);
        color: #fff;
        font-size: 0.75rem;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 6px;
        border: 1px solid rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(6px);
        z-index: 5;
    }

    .badge-quality {
        position: absolute;
        top: 10px;
        left: 10px;
        background: linear-gradient(135deg, #ec4899, #f59e0b);
        color: #fff;
        font-size: 0.7rem;
        font-weight: 900;
        padding: 3px 8px;
        border-radius: 6px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.4);
        z-index: 5;
    }

    .video-card-info {
        padding: 18px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .video-card-title {
        font-size: 1.05rem;
        font-weight: 800;
        color: #fff;
        margin-bottom: 4px;
        line-height: 1.35;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .video-card-artist {
        color: #f472b6;
        font-size: 0.86rem;
        font-weight: 600;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .video-card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.82rem;
        color: #94a3b8;
        padding-top: 10px;
        border-top: 1px solid rgba(255, 255, 255, 0.08);
    }

    /* Featured Cinema Card */
    .featured-cinema-banner {
        border-radius: 24px;
        background: linear-gradient(135deg, rgba(88, 28, 135, 0.9), rgba(30, 27, 75, 0.8));
        border: 1px solid rgba(236, 72, 153, 0.35);
        padding: 32px;
        margin-bottom: 45px;
        display: grid;
        grid-template-columns: 1.2fr 1fr;
        gap: 32px;
        align-items: center;
        box-shadow: 0 20px 45px rgba(0,0,0,0.5);
        position: relative;
        overflow: hidden;
    }

    @media (max-width: 992px) {
        .featured-cinema-banner { grid-template-columns: 1fr; }
        .hero-title-video { font-size: 2.2rem; }
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="video-hero">
    <div class="container text-center">
        <div class="hero-badge-video">
            🎬 4K CONCERTS & OFFICIAL MUSIC VIDEOS
        </div>
        <h1 class="hero-title-video">Ultra HD Video Catalog</h1>
        <p style="color:#94a3b8; font-size:1.1rem; max-width:640px; margin:0 auto; line-height:1.6;">
            Watch high-definition live concerts, music videos, and behind-the-scenes performances from iconic global artists.
        </p>

        <!-- Stats Bar -->
        <div class="video-stats-row">
            <div class="v-stat-pill">
                <span style="font-size:1.3rem;">🎥</span>
                <div>
                    <strong>{{ $totalVideos ?? $videos->total() }}</strong> <span style="color:#94a3b8;">4K Videos</span>
                </div>
            </div>
            <div class="v-stat-pill">
                <span style="font-size:1.3rem;">👁️</span>
                <div>
                    <strong>{{ number_format($totalViews ?? 0) }}</strong> <span style="color:#94a3b8;">Total Views</span>
                </div>
            </div>
            <div class="v-stat-pill">
                <span style="font-size:1.3rem;">⚡</span>
                <div>
                    <strong>Ultra HD 4K</strong> <span style="color:#94a3b8;">Quality</span>
                </div>
            </div>
            <div class="v-stat-pill">
                <span style="font-size:1.3rem;">🏆</span>
                <div>
                    <strong>Top Rated</strong> <span style="color:#94a3b8;">Performances</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Filter & Search Sticky Bar -->
<div class="video-filter-bar">
    <div class="container" style="display:flex; align-items:center; justify-content:space-between; gap:16px; flex-wrap:wrap;">
        
        <!-- Live Search -->
        <form method="GET" action="{{ route('video.index') }}" class="video-search-wrap" id="videoSearchForm">
            <span class="v-search-icon">🔍</span>
            <input type="text" 
                   name="search" 
                   id="videoSearchInput"
                   value="{{ request('search') }}" 
                   placeholder="Search video title, artist, or genre..." 
                   class="v-search-input"
                   onkeyup="filterVideosLocally()">
        </form>

        <!-- Filters Form -->
        <form method="GET" action="{{ route('video.index') }}" style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
            @if(request('search'))
                <input type="hidden" name="search" value="{{ request('search') }}">
            @endif

            <select name="language" onchange="this.form.submit()" class="v-select-custom">
                <option value="">🌐 All Languages</option>
                @foreach($languages as $lang)
                    <option value="{{ $lang }}" {{ request('language') === $lang ? 'selected' : '' }}>{{ $lang }}</option>
                @endforeach
            </select>

            <select name="genre" onchange="this.form.submit()" class="v-select-custom">
                <option value="">🎵 All Genres</option>
                @foreach($genres as $genre)
                    <option value="{{ $genre }}" {{ request('genre') === $genre ? 'selected' : '' }}>{{ $genre }}</option>
                @endforeach
            </select>

            <select name="year" onchange="this.form.submit()" class="v-select-custom">
                <option value="">📅 All Years</option>
                @foreach($years as $year)
                    <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                @endforeach
            </select>

            @if(request()->hasAny(['language','genre','year','search','artist','album']))
                <a href="{{ route('video.index') }}" class="btn btn-secondary btn-sm" style="border-radius:50px; padding:9px 18px; font-weight:700; font-size:0.85rem; background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.15);">
                    ✕ Clear Filters
                </a>
            @endif
        </form>

    </div>
</div>

<div class="container" style="padding-bottom:70px;">

    <!-- Featured Spotlight Video (If available and no search filter) -->
    @if(isset($featuredVideo) && !request()->hasAny(['search', 'language', 'genre', 'year']))
    <div class="featured-cinema-banner">
        <div class="video-aspect-wrap" style="border-radius:18px; box-shadow:0 15px 35px rgba(0,0,0,0.6); border:2px solid rgba(255,255,255,0.15);">
            <img src="{{ $featuredVideo->getThumbnailUrl() }}" 
                 onerror="this.onerror=null; this.src='/images/video_1.jpg';" 
                 alt="{{ $featuredVideo->title }}">
            <a href="{{ route('video.show', $featuredVideo->id) }}" class="play-video-overlay" style="opacity:1; background:rgba(0,0,0,0.35);">
                <div class="play-video-btn" style="transform:scale(1);">▶</div>
            </a>
            <span class="badge-quality">ULTRA HD 4K</span>
            <span class="badge-duration">{{ $featuredVideo->duration }}</span>
        </div>

        <div>
            <div style="display:inline-block; padding:4px 14px; background:rgba(236,72,153,0.25); border:1px solid rgba(236,72,153,0.5); border-radius:50px; color:#f472b6; font-size:0.75rem; font-weight:800; text-transform:uppercase; margin-bottom:10px;">
                🔥 #1 TRENDING MUSIC VIDEO
            </div>
            <h2 style="font-size:2rem; font-weight:900; color:#fff; margin-bottom:8px; line-height:1.2;">
                <a href="{{ route('video.show', $featuredVideo->id) }}" style="color:inherit; text-decoration:none;">{{ $featuredVideo->title }}</a>
            </h2>
            <p style="color:#f472b6; font-size:1.05rem; font-weight:700; margin-bottom:14px;">
                🎤 {{ $featuredVideo->artist }}
            </p>
            <div style="display:flex; gap:18px; align-items:center; color:#cbd5e1; font-size:0.9rem; margin-bottom:22px;">
                <span>👁️ <strong>{{ number_format($featuredVideo->views) }}</strong> views</span>
                <span>⭐ <strong>{{ number_format($featuredVideo->rating, 1) }}</strong> / 5.0</span>
                @if($featuredVideo->genre)
                    <span style="color:#a5b4fc; font-weight:600;">🎵 {{ $featuredVideo->genre }}</span>
                @endif
            </div>
            <a href="{{ route('video.show', $featuredVideo->id) }}" class="btn btn-primary" style="padding:12px 28px; border-radius:50px; font-weight:800; background:linear-gradient(135deg, #ec4899, #6366f1); border:none; box-shadow:0 8px 25px rgba(236,72,153,0.5); display:inline-flex; align-items:center; gap:8px;">
                ▶ Watch Video Now
            </a>
        </div>
    </div>
    @endif

    <!-- Catalog Section Header -->
    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:26px;">
        <div>
            <h2 style="font-size:1.6rem; font-weight:800; color:#fff;">
                All Music Videos & Concerts
            </h2>
            <p style="color:#94a3b8; font-size:0.9rem; margin:0;">
                Showing {{ $videos->count() }} of {{ $videos->total() }} available videos
            </p>
        </div>
    </div>

    <!-- Video Grid (16:9 Aspect Ratio Cards) -->
    <div class="video-grid-4col" id="videoGridContainer">
        @forelse($videos as $video)
        <div class="video-card-container" data-video-title="{{ strtolower($video->title) }}" data-artist="{{ strtolower($video->artist) }}">
            <!-- 16:9 Thumbnail Cover -->
            <div class="video-aspect-wrap">
                <img src="{{ $video->getThumbnailUrl() }}" 
                     onerror="this.onerror=null; this.src='/images/video_1.jpg';" 
                     alt="{{ $video->title }}">
                
                <a href="{{ route('video.show', $video->id) }}" class="play-video-overlay" title="Watch Video">
                    <div class="play-video-btn">▶</div>
                </a>

                <span class="badge-quality">4K HD</span>

                @if($video->duration)
                <span class="badge-duration">
                    {{ $video->duration }}
                </span>
                @endif
            </div>

            <!-- Card Info -->
            <div class="video-card-info">
                <div>
                    <h3 class="video-card-title">
                        <a href="{{ route('video.show', $video->id) }}" style="color:inherit; text-decoration:none;">
                            {{ $video->title }}
                        </a>
                    </h3>
                    <p class="video-card-artist">
                        <span>🎤 {{ $video->artist }}</span>
                    </p>
                </div>

                <div class="video-card-footer">
                    <span>👁️ {{ number_format($video->views) }} views</span>
                    <span style="color:#f59e0b; font-weight:800;">★ {{ number_format($video->rating, 1) }}</span>
                </div>
            </div>
        </div>
        @empty
        <div style="grid-column:1/-1; text-align:center; padding:70px 20px; background:rgba(18,24,43,0.5); border-radius:20px; border:1px dashed rgba(255,255,255,0.12);">
            <div style="font-size:3.5rem; margin-bottom:14px;">🎬</div>
            <h3 style="color:#fff; font-size:1.4rem; font-weight:700; margin-bottom:8px;">No Videos Found</h3>
            <p style="color:#94a3b8; max-width:400px; margin:0 auto 20px auto;">
                No videos match your filter or search query. Try choosing a different filter or reset all.
            </p>
            <a href="{{ route('video.index') }}" class="btn btn-primary" style="border-radius:50px; padding:10px 24px;">
                Reset Video Filters
            </a>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($videos->hasPages())
    <div style="margin-top:45px; display:flex; justify-content:center;">
        {{ $videos->links() }}
    </div>
    @endif

</div>

<!-- Client-side Realtime Search Filter Script -->
<script>
function filterVideosLocally() {
    const input = document.getElementById('videoSearchInput').value.toLowerCase().trim();
    const cards = document.querySelectorAll('#videoGridContainer .video-card-container');

    cards.forEach(card => {
        const title = card.getAttribute('data-video-title') || '';
        const artist = card.getAttribute('data-artist') || '';
        if (title.includes(input) || artist.includes(input)) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
}
</script>
@endsection
