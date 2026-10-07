@extends('layouts.app')
@section('title', 'Explore Music Albums - SOUND Entertainment')

@section('content')
<style>
    /* Custom Styling for Albums Index */
    .albums-hero {
        position: relative;
        padding: 65px 0 45px 0;
        background: radial-gradient(circle at 50% 20%, rgba(99, 102, 241, 0.22) 0%, rgba(236, 72, 153, 0.12) 45%, transparent 75%);
        overflow: hidden;
        border-bottom: 1px solid rgba(255, 255, 255, 0.06);
    }
    .albums-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(rgba(255,255,255,0.08) 1px, transparent 1px);
        background-size: 28px 28px;
        opacity: 0.3;
        pointer-events: none;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 18px;
        background: rgba(99, 102, 241, 0.15);
        border: 1px solid rgba(99, 102, 241, 0.4);
        border-radius: 50px;
        color: #a5b4fc;
        font-size: 0.82rem;
        font-weight: 700;
        letter-spacing: 1.2px;
        text-transform: uppercase;
        box-shadow: 0 0 20px rgba(99, 102, 241, 0.25);
    }

    .hero-title {
        font-family: 'Outfit', sans-serif;
        font-size: clamp(2.2rem, 5vw, 3.4rem);
        font-weight: 900;
        letter-spacing: -0.8px;
        background: linear-gradient(135deg, #ffffff 30%, #a5b4fc 70%, #ec4899 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin: 15px 0;
        line-height: 1.15;
    }

    .hero-stats-row {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 30px;
        margin-top: 30px;
        flex-wrap: wrap;
    }

    .stat-pill {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 22px;
        background: rgba(18, 24, 43, 0.7);
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(12px);
        border-radius: 50px;
        color: #cbd5e1;
        font-size: 0.9rem;
    }
    .stat-pill strong {
        color: #fff;
        font-size: 1.1rem;
        font-weight: 800;
    }

    /* Filter & Search Bar */
    .filter-wrapper {
        position: sticky;
        top: 72px;
        z-index: 40;
        padding: 16px 0;
        background: rgba(7, 10, 20, 0.85);
        backdrop-filter: blur(16px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        margin-bottom: 40px;
    }

    .search-box-wrap {
        position: relative;
        max-width: 480px;
        width: 100%;
    }
    .search-input {
        width: 100%;
        padding: 12px 20px 12px 46px;
        background: rgba(18, 24, 43, 0.8);
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 50px;
        color: #fff;
        font-size: 0.92rem;
        outline: none;
        transition: all 0.3s ease;
    }
    .search-input:focus {
        border-color: #818cf8;
        box-shadow: 0 0 20px rgba(99, 102, 241, 0.3);
        background: rgba(25, 33, 56, 0.9);
    }
    .search-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 1.1rem;
        pointer-events: none;
    }

    .category-scroll {
        display: flex;
        align-items: center;
        gap: 8px;
        overflow-x: auto;
        padding: 4px 2px;
        scrollbar-width: none;
    }
    .category-scroll::-webkit-scrollbar { display: none; }

    .cat-btn {
        padding: 8px 18px;
        border-radius: 50px;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.08);
        color: #94a3b8;
        font-size: 0.85rem;
        font-weight: 600;
        white-space: nowrap;
        transition: all 0.25s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .cat-btn:hover, .cat-btn.active {
        background: linear-gradient(135deg, #6366f1, #818cf8);
        border-color: transparent;
        color: #fff;
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
        transform: translateY(-2px);
    }

    /* Album Cards Grid */
    .albums-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(270px, 1fr));
        gap: 28px;
    }

    .album-card {
        position: relative;
        border-radius: 20px;
        background: rgba(18, 24, 43, 0.75);
        border: 1px solid rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(12px);
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        display: flex;
        flex-direction: column;
    }

    .album-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 25px 50px -12px rgba(99, 102, 241, 0.35);
        border-color: rgba(129, 140, 248, 0.5);
    }

    /* Vinyl Disc Popout Animation */
    .card-cover-box {
        position: relative;
        aspect-ratio: 1 / 1;
        overflow: hidden;
        background: #0f172a;
    }

    .vinyl-disc {
        position: absolute;
        top: 10%;
        right: -30px;
        width: 80%;
        height: 80%;
        border-radius: 50%;
        background: radial-gradient(circle, #0b0f19 30%, #1e293b 31%, #0b0f19 32%, #0b0f19 45%, #1e293b 46%, #0b0f19 47%, #000 100%);
        border: 3px solid #334155;
        box-shadow: 0 0 15px rgba(0,0,0,0.8);
        transition: transform 0.5s ease;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0.85;
    }
    .vinyl-disc::after {
        content: '';
        width: 28%;
        height: 28%;
        border-radius: 50%;
        background: linear-gradient(135deg, #ec4899, #6366f1);
        border: 2px solid #fff;
    }

    .album-card:hover .vinyl-disc {
        transform: translateX(-25px) rotate(180deg);
        opacity: 1;
    }

    .cover-img-wrapper {
        position: relative;
        z-index: 2;
        width: 100%;
        height: 100%;
    }

    .album-cover-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .album-card:hover .album-cover-img {
        transform: scale(1.08);
    }

    .cover-gradient-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(7, 10, 20, 0.95) 0%, rgba(7, 10, 20, 0.3) 50%, transparent 100%);
        z-index: 3;
    }

    .play-overlay-btn {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0.7);
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: linear-gradient(135deg, #6366f1, #ec4899);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        opacity: 0;
        transition: all 0.35s ease;
        z-index: 4;
        box-shadow: 0 10px 25px rgba(99, 102, 241, 0.6);
    }

    .album-card:hover .play-overlay-btn {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1);
    }

    .badge-tracks {
        position: absolute;
        top: 14px;
        left: 14px;
        z-index: 4;
        padding: 5px 14px;
        background: rgba(7, 10, 20, 0.75);
        border: 1px solid rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(8px);
        border-radius: 50px;
        color: #a5b4fc;
        font-size: 0.78rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .badge-edition {
        position: absolute;
        top: 14px;
        right: 14px;
        z-index: 4;
        padding: 4px 10px;
        background: linear-gradient(135deg, rgba(236, 72, 153, 0.85), rgba(99, 102, 241, 0.85));
        border-radius: 50px;
        color: #fff;
        font-size: 0.72rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    }

    .card-body-content {
        padding: 20px;
        z-index: 3;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .album-title {
        font-size: 1.25rem;
        font-weight: 800;
        color: #fff;
        margin-bottom: 6px;
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .album-artist {
        color: #94a3b8;
        font-size: 0.88rem;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .card-footer-action {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 14px;
        border-top: 1px solid rgba(255, 255, 255, 0.08);
    }

    .btn-explore {
        width: 100%;
        padding: 10px 18px;
        border-radius: 12px;
        background: rgba(99, 102, 241, 0.12);
        border: 1px solid rgba(99, 102, 241, 0.3);
        color: #a5b4fc;
        font-weight: 700;
        font-size: 0.88rem;
        text-align: center;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none;
    }

    .album-card:hover .btn-explore {
        background: linear-gradient(135deg, #6366f1, #818cf8);
        border-color: transparent;
        color: #fff;
        box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
    }

    /* Featured Spotlight Banner */
    .spotlight-banner {
        border-radius: 24px;
        background: linear-gradient(135deg, rgba(30, 27, 75, 0.9), rgba(88, 28, 135, 0.7));
        border: 1px solid rgba(129, 140, 248, 0.3);
        padding: 32px;
        margin-bottom: 45px;
        display: flex;
        align-items: center;
        gap: 32px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0,0,0,0.4);
    }
    .spotlight-banner::before {
        content: '';
        position: absolute;
        right: -60px;
        top: -60px;
        width: 250px;
        height: 250px;
        background: radial-gradient(circle, rgba(236, 72, 153, 0.3) 0%, transparent 70%);
        pointer-events: none;
    }

    @media (max-width: 768px) {
        .hero-title { font-size: 2.2rem; }
        .spotlight-banner { flex-direction: column; text-align: center; }
        .filter-wrapper .container { flex-direction: column; gap: 14px; }
        .search-box-wrap { max-width: 100%; }
    }
</style>

<!-- Hero Banner Section -->
<section class="albums-hero">
    <div class="container text-center">
        <div class="hero-badge">
            <span style="display:inline-block; animation: spin 8s linear infinite;">💿</span> Official Discography & Soundtracks
        </div>
        <h1 class="hero-title">Explore Music Albums</h1>
        <p style="color:#94a3b8; font-size:1.1rem; max-width:640px; margin:0 auto; line-height:1.6;">
            Immerse yourself in top curated studio albums, chart-topping soundtracks, and exclusive full-length song collections.
        </p>

        <!-- Stats Bar -->
        <div class="hero-stats-row">
            <div class="stat-pill">
                <span style="font-size:1.3rem;">💿</span>
                <div>
                    <strong>{{ $totalAlbums ?? $albums->total() }}</strong> <span style="color:#94a3b8;">Albums</span>
                </div>
            </div>
            <div class="stat-pill">
                <span style="font-size:1.3rem;">🎵</span>
                <div>
                    <strong>{{ $totalTracks ?? '50+' }}</strong> <span style="color:#94a3b8;">Songs & Tracks</span>
                </div>
            </div>
            <div class="stat-pill">
                <span style="font-size:1.3rem;">🎧</span>
                <div>
                    <strong>{{ $albumCategories->count() }}</strong> <span style="color:#94a3b8;">Categories</span>
                </div>
            </div>
            <div class="stat-pill">
                <span style="font-size:1.3rem;">🔥</span>
                <div>
                    <strong>100% High Quality</strong> <span style="color:#94a3b8;">Audio</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Filter & Search Sticky Bar -->
<div class="filter-wrapper">
    <div class="container" style="display:flex; align-items:center; justify-content:space-between; gap:20px; flex-wrap:wrap;">
        
        <!-- Search Input -->
        <form action="{{ route('albums.index') }}" method="GET" class="search-box-wrap" id="searchForm">
            <span class="search-icon">🔍</span>
            <input type="text" 
                   name="search" 
                   id="albumSearchInput"
                   value="{{ request('search') }}" 
                   placeholder="Search album title, artist, or genre..." 
                   class="search-input"
                   onkeyup="filterAlbumsLocally()">
        </form>

        <!-- Category Quick Badges -->
        <div class="category-scroll">
            <a href="{{ route('albums.index') }}" class="cat-btn {{ !request('search') ? 'active' : '' }}">
                ✨ All Albums
            </a>
            @foreach($albumCategories as $cat)
            <a href="{{ route('albums.show', $cat->name) }}" class="cat-btn">
                💿 {{ $cat->name }}
            </a>
            @endforeach
        </div>

    </div>
</div>

<div class="container" style="padding-bottom:70px;">

    <!-- Featured Spotlight Album Banner (If albums exist) -->
    @if($albums->count() > 0 && !request('search'))
    @php
        $spotlight = $albums->first();
        $spotlightCover = $spotlight->cover;
        if (str_starts_with($spotlightCover, 'http://') || str_starts_with($spotlightCover, 'https://') || str_starts_with($spotlightCover, '/images/')) {
            $spotlightImgSrc = $spotlightCover;
        } elseif ($spotlightCover) {
            $spotlightImgSrc = '/images/' . $spotlightCover;
        } else {
            $spotlightImgSrc = '/images/music_1.jpg';
        }
    @endphp
    <div class="spotlight-banner">
        <div style="position:relative; width:160px; height:160px; flex-shrink:0; margin:0 auto;">
            <img src="{{ $spotlightImgSrc }}" 
                 onerror="this.onerror=null; this.src='/images/music_1.jpg';"
                 alt="{{ $spotlight->album }}" 
                 style="width:100%; height:100%; object-fit:cover; border-radius:18px; box-shadow:0 12px 30px rgba(0,0,0,0.5); border:2px solid rgba(255,255,255,0.15);">
            <div style="position:absolute; -right:20px; top:15px; width:130px; height:130px; border-radius:50%; background:radial-gradient(circle, #0b0f19 30%, #1e293b 35%, #000 100%); border:3px solid #475569; z-index:-1; animation: spin 12s linear infinite;"></div>
        </div>

        <div style="flex-grow:1;">
            <div style="display:inline-block; padding:4px 12px; background:rgba(236,72,153,0.2); border:1px solid rgba(236,72,153,0.4); border-radius:50px; color:#f472b6; font-size:0.75rem; font-weight:800; text-transform:uppercase; margin-bottom:8px;">
                🔥 Featured Album Release
            </div>
            <h2 style="font-size:2rem; font-weight:900; color:#fff; margin-bottom:6px;">
                {{ $spotlight->album }}
            </h2>
            <p style="color:#cbd5e1; font-size:0.95rem; margin-bottom:18px; max-width:550px;">
                Listen to {{ $spotlight->track_count }} featured track(s) including top releases from {{ $spotlight->artist ?? 'SOUND Artists' }}.
            </p>
            <div style="display:flex; gap:14px; align-items:center; flex-wrap:wrap;">
                <a href="{{ route('albums.show', $spotlight->album) }}" class="btn btn-primary" style="padding:10px 24px; border-radius:50px; font-weight:700; background:linear-gradient(135deg, #6366f1, #ec4899); border:none; box-shadow:0 6px 20px rgba(236,72,153,0.4);">
                    ▶ Listen Now & View Tracks
                </a>
                <span style="color:#94a3b8; font-size:0.85rem;">
                    🎵 {{ $spotlight->track_count }} Songs
                </span>
            </div>
        </div>
    </div>
    @endif

    <!-- Section Heading -->
    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:28px;">
        <div>
            <h2 style="font-size:1.6rem; font-weight:800; color:#fff;">
                All Album Collections
            </h2>
            <p style="color:#94a3b8; font-size:0.9rem; margin:0;">
                Showing {{ $albums->count() }} of {{ $albums->total() }} available albums
            </p>
        </div>
    </div>

    <!-- Albums Cards Grid -->
    <div class="albums-grid" id="albumsGridContainer">
        @forelse($albums as $album)
        @php
            $cover = $album->cover;
            if (str_starts_with($cover, 'http://') || str_starts_with($cover, 'https://') || str_starts_with($cover, '/images/')) {
                $imgSrc = $cover;
            } elseif ($cover) {
                $imgSrc = '/images/' . $cover;
            } else {
                $imgSrc = '/images/music_1.jpg';
            }
        @endphp

        <div class="album-card" data-album-title="{{ strtolower($album->album) }}" data-artist="{{ strtolower($album->artist ?? '') }}">
            <!-- Cover Artwork with Vinyl Disc Animation -->
            <div class="card-cover-box">
                <div class="vinyl-disc"></div>
                
                <div class="cover-img-wrapper">
                    <img src="{{ $imgSrc }}" 
                         onerror="this.onerror=null; this.src='/images/music_1.jpg';" 
                         alt="{{ $album->album }}" 
                         class="album-cover-img">
                </div>

                <div class="cover-gradient-overlay"></div>

                <span class="badge-tracks">
                    🎵 {{ $album->track_count }} {{ Str::plural('Track', $album->track_count) }}
                </span>

                <span class="badge-edition">
                    ALBUM
                </span>

                <a href="{{ route('albums.show', $album->album) }}" class="play-overlay-btn" title="View Album">
                    ▶
                </a>
            </div>

            <!-- Card Body Content -->
            <div class="card-body-content">
                <div>
                    <h3 class="album-title">
                        <a href="{{ route('albums.show', $album->album) }}" style="color:inherit; text-decoration:none;">
                            {{ $album->album }}
                        </a>
                    </h3>
                    <div class="album-artist">
                        <span>🎙️ {{ $album->artist ?? 'Various Artists' }}</span>
                        @if(!empty($album->genre))
                            <span style="margin:0 4px; color:#475569;">•</span>
                            <span style="color:#a5b4fc; font-weight:600;">{{ $album->genre }}</span>
                        @endif
                    </div>
                </div>

                <div class="card-footer-action">
                    <a href="{{ route('albums.show', $album->album) }}" class="btn-explore">
                        Explore Tracks →
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div style="grid-column:1/-1; text-align:center; padding:70px 20px; background:rgba(18,24,43,0.5); border-radius:20px; border:1px dashed rgba(255,255,255,0.12);">
            <div style="font-size:3.5rem; margin-bottom:14px; animation: bounce 2s infinite;">💿</div>
            <h3 style="color:#fff; font-size:1.4rem; font-weight:700; margin-bottom:8px;">No Albums Found</h3>
            <p style="color:#94a3b8; max-width:400px; margin:0 auto 20px auto;">
                We couldn't find any albums matching your criteria. Try searching for a different keyword or view all albums.
            </p>
            <a href="{{ route('albums.index') }}" class="btn btn-primary" style="border-radius:50px; padding:10px 24px;">
                Reset Search Filters
            </a>
        </div>
        @endforelse
    </div>

    <!-- Pagination Links -->
    @if($albums->hasPages())
    <div style="margin-top:45px; display:flex; justify-content:center;">
        {{ $albums->links() }}
    </div>
    @endif

</div>

<!-- Realtime Client-side Search Script -->
<script>
function filterAlbumsLocally() {
    const input = document.getElementById('albumSearchInput').value.toLowerCase().trim();
    const cards = document.querySelectorAll('#albumsGridContainer .album-card');

    cards.forEach(card => {
        const title = card.getAttribute('data-album-title') || '';
        const artist = card.getAttribute('data-artist') || '';
        if (title.includes(input) || artist.includes(input)) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
}
</script>

<style>
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>
@endsection
