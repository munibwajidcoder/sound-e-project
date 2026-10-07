@extends('layouts.app')

@section('title', 'Music - Browse All Songs')
@section('meta_description', 'Browse all Regional and English music by Album, Artist, Year, Genre.')

@push('styles')
<style>
/* ===== MUSIC PAGE BANNER ===== */
.music-banner {
    position: relative;
    padding: 64px 0 48px;
    overflow: hidden;
    background: linear-gradient(135deg, rgba(99,102,241,0.25) 0%, rgba(236,72,153,0.18) 50%, rgba(7,10,20,0.98) 100%);
    border-bottom: 1px solid rgba(255,255,255,0.07);
}
.music-banner::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%236366f1' fill-opacity='0.04'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    pointer-events: none;
}
.music-banner-glow {
    position: absolute;
    top: -60px; right: -80px;
    width: 500px; height: 400px;
    background: radial-gradient(ellipse, rgba(236,72,153,0.22) 0%, transparent 70%);
    filter: blur(60px);
    pointer-events: none;
}
.music-banner-glow2 {
    position: absolute;
    bottom: -40px; left: -60px;
    width: 400px; height: 300px;
    background: radial-gradient(ellipse, rgba(99,102,241,0.2) 0%, transparent 70%);
    filter: blur(60px);
    pointer-events: none;
}
.banner-stats {
    display: flex;
    gap: 32px;
    margin-top: 24px;
    flex-wrap: wrap;
}
.banner-stat {
    display: flex;
    align-items: center;
    gap: 10px;
}
.banner-stat-icon {
    width: 40px; height: 40px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 18px;
}
.banner-stat-text strong {
    display: block;
    font-size: 1.1rem;
    font-weight: 800;
    color: #fff;
}
.banner-stat-text span {
    font-size: 0.75rem;
    color: #94a3b8;
    font-weight: 600;
}

/* ===== FILTER BAR ===== */
.filter-section {
    background: rgba(10,13,24,0.8);
    border-bottom: 1px solid rgba(255,255,255,0.06);
    padding: 16px 0;
    position: sticky;
    top: 72px;
    z-index: 50;
    backdrop-filter: blur(16px);
}
.filter-bar {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    align-items: center;
}
.filter-select {
    padding: 9px 36px 9px 14px;
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 10px;
    color: #f1f5f9;
    font-size: 0.85rem;
    font-family: inherit;
    cursor: pointer;
    outline: none;
    appearance: none;
    -webkit-appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 12px center;
    transition: all 0.2s;
}
.filter-select:focus, .filter-select:hover {
    border-color: rgba(99,102,241,0.5);
    background-color: rgba(99,102,241,0.1);
}
.filter-select option { background: #0d0f1a; color: #f1f5f9; }

/* ===== MUSIC GRID ===== */
.music-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
    gap: 22px;
    padding: 36px 0 20px;
}

/* ===== MUSIC CARD ===== */
.music-card {
    position: relative;
    background: rgba(15,20,40,0.9);
    border-radius: 16px;
    overflow: hidden;
    border: 1px solid rgba(255,255,255,0.07);
    box-shadow: 0 8px 24px rgba(0,0,0,0.4);
    transition: all 0.35s cubic-bezier(0.34,1.56,0.64,1);
    text-decoration: none;
    display: block;
    cursor: pointer;
}
.music-card:hover {
    transform: translateY(-10px) scale(1.025);
    box-shadow: 0 20px 45px rgba(99,102,241,0.38);
    border-color: rgba(99,102,241,0.5);
}
.music-card-thumb {
    position: relative;
    width: 100%;
    aspect-ratio: 1 / 1;
    overflow: hidden;
    background: linear-gradient(135deg, #1a1a3e, #0f172a);
}
.music-card-thumb img {
    width: 100%; height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.5s ease;
}
.music-card:hover .music-card-thumb img {
    transform: scale(1.1);
}

/* Gradient overlay on image */
.music-card-thumb::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(10,13,30,0.85) 0%, transparent 50%);
    pointer-events: none;
}

/* Vinyl spin badge */
.vinyl-badge {
    position: absolute;
    top: 10px; right: 10px;
    width: 32px; height: 32px;
    border-radius: 50%;
    background: radial-gradient(circle, #000 28%, #2a2a2a 42%, #111 62%, #000 100%);
    border: 1px solid rgba(255,255,255,0.18);
    display: flex; align-items: center; justify-content: center;
    animation: vinyl-spin 4s linear infinite;
    z-index: 2;
    box-shadow: 0 3px 8px rgba(0,0,0,0.6);
}
.vinyl-dot {
    width: 8px; height: 8px;
    border-radius: 50%;
    background: linear-gradient(135deg, #ec4899, #6366f1);
}
@keyframes vinyl-spin {
    0%   { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* NEW badge */
.new-badge {
    position: absolute;
    top: 10px; left: 10px;
    z-index: 3;
    padding: 4px 10px;
    background: linear-gradient(135deg, #ec4899, #f59e0b);
    border-radius: 6px;
    font-size: 0.65rem;
    font-weight: 800;
    color: #fff;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    box-shadow: 0 4px 12px rgba(236,72,153,0.5);
}

/* Play overlay */
.play-hover {
    position: absolute;
    inset: 0;
    background: rgba(5,8,18,0.55);
    display: flex; align-items: center; justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
    backdrop-filter: blur(3px);
    z-index: 4;
}
.music-card:hover .play-hover { opacity: 1; }
.play-circle-btn {
    width: 54px; height: 54px;
    border-radius: 50%;
    background: linear-gradient(135deg, #6366f1, #ec4899);
    display: flex; align-items: center; justify-content: center;
    font-size: 22px;
    color: #fff;
    box-shadow: 0 8px 25px rgba(99,102,241,0.65);
    transform: scale(0.75);
    transition: transform 0.3s cubic-bezier(0.34,1.56,0.64,1);
}
.music-card:hover .play-circle-btn { transform: scale(1); }

/* Card info body */
.music-card-body {
    padding: 14px 16px 16px;
}
.music-card-title {
    font-size: 0.93rem;
    font-weight: 800;
    color: #fff;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    margin-bottom: 3px;
}
.music-card-artist {
    font-size: 0.8rem;
    font-weight: 600;
    color: #818cf8;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    margin-bottom: 8px;
}
.music-card-meta {
    display: flex;
    align-items: center;
    gap: 6px;
    flex-wrap: wrap;
}
.lang-chip {
    display: inline-block;
    padding: 3px 9px;
    border-radius: 5px;
    font-size: 0.65rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.chip-regional { background: rgba(124,58,237,0.25); color: #a5b4fc; border: 1px solid rgba(124,58,237,0.35); }
.chip-english  { background: rgba(16,185,129,0.15); color: #6ee7b7; border: 1px solid rgba(16,185,129,0.3); }
.chip-default  { background: rgba(99,102,241,0.15); color: #a5b4fc; border: 1px solid rgba(99,102,241,0.3); }
.genre-text {
    font-size: 0.73rem;
    color: #64748b;
    font-weight: 600;
}
.rating-row {
    display: flex;
    align-items: center;
    gap: 5px;
    margin-top: 7px;
}
.stars-filled { color: #f59e0b; font-size: 0.72rem; letter-spacing: 1px; }
.rating-num   { font-size: 0.78rem; font-weight: 800; color: #f59e0b; }
.duration-text { margin-left: auto; font-size: 0.7rem; color: #475569; }

/* Responsive */
@media (max-width: 768px) {
    .music-banner { padding: 44px 0 32px; }
    .banner-stats { gap: 20px; }
    .music-grid { grid-template-columns: repeat(auto-fill, minmax(155px, 1fr)); gap: 14px; padding: 24px 0; }
    .music-card-body { padding: 10px 12px 12px; }
    .filter-section { top: 60px; }
}
@media (max-width: 480px) {
    .music-grid { grid-template-columns: repeat(2, 1fr); gap: 12px; }
    .banner-stats { gap: 14px; }
}
</style>
@endpush

@section('content')

{{-- ===== BANNER ===== --}}
<div class="music-banner">
    <div class="music-banner-glow"></div>
    <div class="music-banner-glow2"></div>
    <div class="container" style="position:relative; z-index:1;">
        <div style="display:flex; align-items:center; gap:18px; margin-bottom:14px; flex-wrap:wrap;">
            <div style="width:58px; height:58px; border-radius:16px; background:linear-gradient(135deg,#6366f1,#ec4899); display:flex; align-items:center; justify-content:center; font-size:26px; box-shadow:0 10px 25px rgba(99,102,241,0.5); flex-shrink:0;">🎵</div>
            <div>
                <div style="display:inline-flex; align-items:center; gap:6px; padding:4px 14px; background:rgba(99,102,241,0.15); border:1px solid rgba(99,102,241,0.35); border-radius:50px; color:#a5b4fc; font-size:0.75rem; font-weight:800; letter-spacing:1px; text-transform:uppercase; margin-bottom:6px;">
                    🎧 OFFICIAL SOUND DIRECTORY
                </div>
                <h1 style="font-family:'Outfit', sans-serif; font-size:clamp(1.8rem,4.5vw,2.8rem); font-weight:900; color:#fff; letter-spacing:-0.5px; margin:0; line-height:1.15; background:linear-gradient(135deg, #ffffff 40%, #a5b4fc 75%, #ec4899 100%); -webkit-background-clip:text; -webkit-text-fill-color:transparent;">
                    Curated Music Directory
                </h1>
                <p style="color:#94a3b8; font-family:'Plus Jakarta Sans', sans-serif; font-size:0.95rem; margin:4px 0 0; line-height:1.5;">
                    Browse lossless Regional &amp; English master tracks by Album, Artist, Release Year, Genre, and Language.
                </p>
            </div>
        </div>

        {{-- Stats row --}}
        <div class="banner-stats">
            <div class="banner-stat">
                <div class="banner-stat-icon" style="background:rgba(99,102,241,0.2); border:1px solid rgba(99,102,241,0.3);">&#x1F3A7;</div>
                <div class="banner-stat-text">
                    <strong>{{ $music->total() }}</strong>
                    <span>Total Tracks</span>
                </div>
            </div>
            <div class="banner-stat">
                <div class="banner-stat-icon" style="background:rgba(236,72,153,0.2); border:1px solid rgba(236,72,153,0.3);">&#x1F30D;</div>
                <div class="banner-stat-text">
                    <strong>{{ count($languages) }}</strong>
                    <span>Languages</span>
                </div>
            </div>
            <div class="banner-stat">
                <div class="banner-stat-icon" style="background:rgba(245,158,11,0.2); border:1px solid rgba(245,158,11,0.3);">&#x1F3B8;</div>
                <div class="banner-stat-text">
                    <strong>{{ count($genres) }}</strong>
                    <span>Genres</span>
                </div>
            </div>
            @if(request()->hasAny(['language','genre','year','artist','album']))
            <div style="margin-left:auto; display:flex; align-items:center;">
                <a href="{{ route('music.index') }}" style="display:inline-flex; align-items:center; gap:6px; padding:8px 16px; border-radius:8px; background:rgba(239,68,68,0.15); border:1px solid rgba(239,68,68,0.3); color:#fca5a5; font-size:0.82rem; font-weight:700; text-decoration:none;">
                    ✕ Clear Filters
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

{{-- ===== STICKY FILTER BAR ===== --}}
<div class="filter-section">
    <div class="container">
        <form method="GET" action="{{ route('music.index') }}">
            <div class="filter-bar">
                <span style="font-size:0.8rem; font-weight:700; color:#64748b; white-space:nowrap;">FILTER BY:</span>

                <select name="language" class="filter-select" onchange="this.form.submit()">
                    <option value="">&#x1F310; All Languages</option>
                    @foreach($languages as $lang)
                        <option value="{{ $lang }}" {{ request('language') === $lang ? 'selected' : '' }}>{{ $lang }}</option>
                    @endforeach
                </select>

                <select name="genre" class="filter-select" onchange="this.form.submit()">
                    <option value="">&#x1F3B8; All Genres</option>
                    @foreach($genres as $genre)
                        <option value="{{ $genre }}" {{ request('genre') === $genre ? 'selected' : '' }}>{{ $genre }}</option>
                    @endforeach
                </select>

                <select name="year" class="filter-select" onchange="this.form.submit()">
                    <option value="">&#x1F4C5; All Years</option>
                    @foreach($years as $year)
                        <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>

                @php
                    $activeCount = collect(['language','genre','year','artist','album'])->filter(fn($k) => request($k))->count();
                @endphp
                @if($activeCount)
                <span style="padding:8px 14px; border-radius:8px; background:rgba(99,102,241,0.2); border:1px solid rgba(99,102,241,0.35); font-size:0.78rem; font-weight:700; color:#a5b4fc;">
                    {{ $activeCount }} filter{{ $activeCount > 1 ? 's' : '' }} active
                </span>
                @endif
            </div>
        </form>
    </div>
</div>

{{-- ===== MUSIC GRID ===== --}}
<div class="container">
    <div class="music-grid">
        @forelse($music as $song)
        <a href="{{ route('music.show', $song->id) }}" class="music-card">

            {{-- NEW badge --}}
            @if($song->is_new)
            <span class="new-badge">&#x2728; NEW</span>
            @endif

            {{-- Thumbnail --}}
            <div class="music-card-thumb">
                @php
                    $cover = $song->cover_image;
                    // If it already starts with /images/ strip it to avoid doubling
                    if (str_starts_with($cover, '/images/')) {
                        $imgSrc = $cover;
                    } elseif ($cover) {
                        $imgSrc = '/images/' . $cover;
                    } else {
                        $imgSrc = '/images/music_1.jpg';
                    }
                @endphp
                <img src="{{ $imgSrc }}" alt="{{ $song->title }}"
                     onerror="this.src='/images/music_1.jpg'">

                <div class="vinyl-badge"><div class="vinyl-dot"></div></div>

                @if($song->audio_url)
                <div class="play-hover"
                     onclick="event.preventDefault(); openAudioModal('{{ addslashes($song->title) }}', '{{ addslashes($song->artist) }}', '/audio/{{ $song->audio_url }}')">
                    <div class="play-circle-btn">&#x25B6;</div>
                </div>
                @else
                <div class="play-hover">
                    <div class="play-circle-btn" style="background:linear-gradient(135deg,#334155,#475569);">&#x1F3B5;</div>
                </div>
                @endif
            </div>

            {{-- Card Body --}}
            <div class="music-card-body">
                <div class="music-card-title">{{ $song->title }}</div>
                <div class="music-card-artist">{{ $song->artist }}</div>

                <div class="music-card-meta">
                    @php
                        $lang = strtolower($song->language ?? '');
                        $chipClass = str_contains($lang, 'english') ? 'chip-english' : (str_contains($lang, 'regional') ? 'chip-regional' : 'chip-default');
                    @endphp
                    <span class="lang-chip {{ $chipClass }}">{{ $song->language }}</span>
                    <span class="genre-text">{{ $song->genre }} · {{ $song->year }}</span>
                </div>

                <div class="rating-row">
                    <span class="stars-filled">★★★★★</span>
                    <span class="rating-num">{{ number_format($song->rating, 1) }}</span>
                    <span style="font-size:0.7rem; color:#475569;">({{ $song->rating_count ?? 0 }})</span>
                    <span class="duration-text">&#x23F1; {{ $song->duration }}</span>
                </div>
            </div>
        </a>
        @empty
        <div style="grid-column:1/-1; text-align:center; padding:80px 0; color:var(--text-muted)">
            <div style="font-size:4rem; margin-bottom:16px; opacity:0.4;">&#x1F3B5;</div>
            <h3 style="color:#fff; font-size:1.3rem; margin-bottom:8px;">No music found</h3>
            <p style="margin-bottom:20px;">Try changing your filters</p>
            <a href="{{ route('music.index') }}" class="btn btn-primary">Browse All Music</a>
        </div>
        @endforelse
    </div>

    {{-- ===== PAGINATION ===== --}}
    @if($music->hasPages())
    <div style="padding:8px 0 48px; display:flex; justify-content:center; gap:8px; flex-wrap:wrap;">
        @if($music->onFirstPage())
            <span style="display:inline-flex; align-items:center; justify-content:center; width:38px; height:38px; border-radius:8px; background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.07); color:#475569; font-size:1rem;">‹</span>
        @else
            <a href="{{ $music->previousPageUrl() }}" style="display:inline-flex; align-items:center; justify-content:center; width:38px; height:38px; border-radius:8px; background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.1); color:#cbd5e1; font-size:1rem; text-decoration:none; transition:all 0.2s;">‹</a>
        @endif

        @foreach($music->getUrlRange(1, $music->lastPage()) as $page => $url)
            @if($page == $music->currentPage())
                <span style="display:inline-flex; align-items:center; justify-content:center; width:38px; height:38px; border-radius:8px; background:linear-gradient(135deg,#6366f1,#8b5cf6); border:1px solid transparent; color:#fff; font-size:0.85rem; font-weight:700;">{{ $page }}</span>
            @else
                <a href="{{ $url }}" style="display:inline-flex; align-items:center; justify-content:center; width:38px; height:38px; border-radius:8px; background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.1); color:#cbd5e1; font-size:0.85rem; font-weight:600; text-decoration:none; transition:all 0.2s;">{{ $page }}</a>
            @endif
        @endforeach

        @if($music->hasMorePages())
            <a href="{{ $music->nextPageUrl() }}" style="display:inline-flex; align-items:center; justify-content:center; width:38px; height:38px; border-radius:8px; background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.1); color:#cbd5e1; font-size:1rem; text-decoration:none; transition:all 0.2s;">›</a>
        @else
            <span style="display:inline-flex; align-items:center; justify-content:center; width:38px; height:38px; border-radius:8px; background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.07); color:#475569; font-size:1rem;">›</span>
        @endif
    </div>
    @endif
</div>
@endsection
