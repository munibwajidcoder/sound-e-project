@extends('layouts.app')

@section('title', 'Home - Experience Music & Cinema Without Boundaries')
@section('meta_description', 'SOUND Entertainment - Regional and English Music and Videos curated by Album, Artist, Year, Genre.')

@push('styles')
<style>
    /* ---- DJ 3D HERO ---- */
    .hero-3d {
        padding: 60px 0 50px;
        text-align: center;
        position: relative;
        overflow: hidden;
        min-height: 72vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: radial-gradient(circle at 50% 30%, rgba(99, 102, 241, 0.28) 0%, rgba(236, 72, 153, 0.15) 45%, rgba(7, 10, 20, 0.95) 85%);
    }
    .dj-glow-orb {
        position: absolute;
        top: 25%; left: 50%;
        transform: translate(-50%, -50%);
        width: 650px; height: 380px;
        background: radial-gradient(ellipse at center, rgba(236,72,153,0.35) 0%, rgba(99,102,241,0.25) 50%, transparent 80%);
        filter: blur(85px);
        pointer-events: none;
        animation: dj-pulse 4s infinite alternate ease-in-out;
    }
    @keyframes dj-pulse {
        0% { transform: translate(-50%, -50%) scale(0.85); opacity: 0.7; }
        100% { transform: translate(-50%, -50%) scale(1.15); opacity: 1; }
    }

    /* Animated DJ Equalizer Bars */
    .equalizer-wrap {
        display: flex;
        align-items: flex-end;
        justify-content: center;
        gap: 6px;
        height: 38px;
        margin-bottom: 20px;
    }
    .eq-bar {
        width: 5px;
        background: linear-gradient(to top, #6366f1, #ec4899, #f59e0b);
        border-radius: 4px;
        animation: eq-bounce 1.2s infinite ease-in-out alternate;
    }
    .eq-bar:nth-child(1) { height: 40%; animation-delay: 0.1s; }
    .eq-bar:nth-child(2) { height: 80%; animation-delay: 0.3s; }
    .eq-bar:nth-child(3) { height: 100%; animation-delay: 0.2s; }
    .eq-bar:nth-child(4) { height: 60%; animation-delay: 0.4s; }
    .eq-bar:nth-child(5) { height: 90%; animation-delay: 0.15s; }
    .eq-bar:nth-child(6) { height: 50%; animation-delay: 0.35s; }
    .eq-bar:nth-child(7) { height: 75%; animation-delay: 0.25s; }
    @keyframes eq-bounce {
        0% { height: 20%; }
        100% { height: 100%; }
    }

    .hero-3d h1 {
        font-size: clamp(2.3rem, 5vw, 4rem);
        font-weight: 900;
        line-height: 1.15;
        color: #fff;
        margin-bottom: 16px;
        letter-spacing: -1px;
    }
    .hero-3d h1 .gradient-text {
        background: linear-gradient(135deg, #a5b4fc 0%, #ec4899 50%, #f59e0b 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 0 0 30px rgba(236,72,153,0.3);
    }

    /* ---- 3D GLASS CARDS ---- */
    .media-card-3d {
        background: rgba(18, 24, 43, 0.8);
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.08);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
        transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
        position: relative;
    }
    .media-card-3d:hover {
        transform: translateY(-10px) rotateX(4deg) scale(1.03);
        box-shadow: 0 22px 50px rgba(99, 102, 241, 0.45);
        border-color: rgba(99, 102, 241, 0.6);
    }

    /* 1:1 Aspect Ratio for Music Cover Containers */
    .music-thumb-container {
        position: relative;
        width: 100%;
        aspect-ratio: 1 / 1;
        overflow: hidden;
        background: #0f172a;
    }
    .music-thumb-container img {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .media-card-3d:hover .music-thumb-container img {
        transform: scale(1.1);
    }

    /* 16:9 Aspect Ratio for Video Thumbnails (YouTube Standard Ratio) */
    .video-thumb-container-16-9 {
        position: relative;
        width: 100%;
        aspect-ratio: 16 / 9;
        overflow: hidden;
        background: #0f172a;
    }
    .video-thumb-container-16-9 img {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .media-card-3d:hover .video-thumb-container-16-9 img {
        transform: scale(1.1);
    }

    /* Vinyl Record Spinning Effect */
    .vinyl-overlay {
        position: absolute;
        top: 10px; right: 10px;
        width: 38px; height: 38px;
        border-radius: 50%;
        background: radial-gradient(circle, #000 30%, #333 40%, #111 60%, #000 100%);
        border: 1px solid rgba(255,255,255,0.2);
        display: flex; align-items: center; justify-content: center;
        box-shadow: 0 4px 10px rgba(0,0,0,0.6);
        animation: spin-vinyl 4s linear infinite;
        opacity: 0.85;
    }
    @keyframes spin-vinyl {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    .vinyl-dot {
        width: 10px; height: 10px;
        border-radius: 50%;
        background: var(--accent);
    }

    .play-overlay-btn {
        position: absolute;
        inset: 0;
        background: rgba(10, 13, 24, 0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        backdrop-filter: blur(5px);
    }
    .media-card-3d:hover .play-overlay-btn {
        opacity: 1;
    }
    .play-circle {
        width: 56px; height: 56px;
        border-radius: 50%;
        background: linear-gradient(135deg, #6366f1, #ec4899);
        color: #fff;
        display: flex; align-items: center; justify-content: center;
        font-size: 22px;
        box-shadow: 0 10px 25px rgba(99, 102, 241, 0.6);
        transform: scale(0.8);
        transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .media-card-3d:hover .play-circle {
        transform: scale(1);
    }

    /* ---- INFINITE AUTOMATED LOOPING SLIDER ---- */
    .slider-viewport {
        overflow: hidden;
        position: relative;
        width: 100%;
        padding: 10px 0;
    }
    .slider-viewport::before,
    .slider-viewport::after {
        content: '';
        position: absolute;
        top: 0; bottom: 0;
        width: 80px;
        z-index: 2;
        pointer-events: none;
    }
    .slider-viewport::before {
        left: 0;
        background: linear-gradient(to right, #070a14, transparent);
    }
    .slider-viewport::after {
        right: 0;
        background: linear-gradient(to left, #070a14, transparent);
    }
    .slider-track {
        display: flex;
        gap: 24px;
        width: max-content;
        animation: infiniteScroll 40s linear infinite;
    }
    .slider-viewport:hover .slider-track {
        animation-play-state: paused;
    }
    @keyframes infiniteScroll {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .slider-item {
        width: 220px;
        flex-shrink: 0;
    }
</style>
@endpush

@section('content')

<!-- HERO SECTION WITH DJ EQUALIZER BARS -->
<section class="hero-3d">
    <div class="dj-glow-orb"></div>
    <div class="container" style="position:relative; z-index:1;">
        
        <!-- DJ Equalizer -->
        <div class="equalizer-wrap">
            <div class="eq-bar"></div>
            <div class="eq-bar"></div>
            <div class="eq-bar"></div>
            <div class="eq-bar"></div>
            <div class="eq-bar"></div>
            <div class="eq-bar"></div>
            <div class="eq-bar"></div>
        </div>

        <h1>
            Experience High Fidelity Music & Cinema<br>
            <span class="gradient-text">Without Boundaries</span>
        </h1>
        <p style="max-width:650px; margin:0 auto 32px; color:#94a3b8; font-size:1.05rem;">
            Explore lossless tracks and 4K concert recordings by <strong>Yo Yo Honey Singh</strong>, <strong>Atif Aslam</strong>, <strong>Talwinder</strong>, <strong>Arijit Singh</strong>, <strong>The Weeknd</strong>, and classic <strong>Qawwali masters</strong>.
        </p>

        <!-- Search Bar -->
        <div style="max-width:620px; margin:0 auto 28px;">
            <form action="{{ route('search') }}" method="GET" style="display:flex; align-items:center; background:rgba(15,23,42,0.85); border:1px solid rgba(255,255,255,0.15); border-radius:50px; padding:6px 6px 6px 24px; box-shadow:0 15px 35px rgba(0,0,0,0.5);">
                <input type="text" name="q" placeholder="Search by Song Title, Artist, Album, Genre..." value="{{ request('q') }}" style="flex:1; background:none; border:none; outline:none; color:#fff; font-size:1rem; font-family:inherit;">
                <button type="submit" class="btn btn-primary" style="border-radius:50px; padding:10px 26px;">Explore 🚀</button>
            </form>
        </div>

        <!-- Quick Filters -->
        <div style="display:flex; flex-wrap:wrap; justify-content:center; gap:10px;">
            <a href="{{ route('music.index') }}?genre=Qawwali" class="category-pill">👳‍♂️ Qawwali</a>
            <a href="{{ route('music.index') }}?genre=Hip-Hop" class="category-pill">🔥 Hip-Hop</a>
            <a href="{{ route('music.index') }}?genre=Romantic" class="category-pill">❤️ Romantic</a>
            <a href="{{ route('music.index') }}?genre=Pop" class="category-pill">🎵 Pop</a>
            <a href="{{ route('albums.index') }}" class="category-pill">💿 Albums</a>
            <a href="{{ route('video.index') }}" class="category-pill">🎬 4K Concerts</a>
        </div>
    </div>
</section>

<!-- DISCOGRAPHY & FEATURED ALBUMS SPOTLIGHT -->
<section style="padding: 40px 0 20px;">
    <div class="container">
        <div class="card" style="background:linear-gradient(135deg, rgba(30,27,75,0.8), rgba(88,28,135,0.6)); border:1px solid rgba(165,180,252,0.25); border-radius:24px; padding:32px; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:24px; box-shadow:0 20px 50px rgba(0,0,0,0.5);">
            <div>
                <span style="color:#a5b4fc; font-weight:800; font-size:0.8rem; letter-spacing:1.5px; text-transform:uppercase;">OFFICIAL DISCOGRAPHY</span>
                <h2 style="font-size:2.2rem; font-weight:900; color:#fff; margin:6px 0 8px;">Explore Full Music Albums</h2>
                <p style="color:#cbd5e1; max-width:550px; margin:0; font-size:0.95rem;">
                    Listen to full studio releases including <em>Glory</em>, <em>Desi Kalakaar</em>, <em>Coke Studio Season 8</em>, <em>Brahmastra</em>, <em>After Hours</em> & more!
                </p>
            </div>
            <div>
                <a href="{{ route('albums.index') }}" class="btn btn-primary" style="padding:12px 30px; font-size:1rem; border-radius:50px;">
                    View All Albums →
                </a>
            </div>
        </div>
    </div>
</section>

<!-- NEW ARRIVALS & TRENDING SONGS (1:1 ASPECT RATIO CONTAINER) -->
<section style="padding: 40px 0;">
    <div class="container">
        <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:24px;">
            <h2 style="font-size:1.8rem; font-weight:900; color:#fff; display:flex; align-items:center; gap:10px;">
                <span style="width:6px; height:28px; background:linear-gradient(to bottom, #ec4899, #f59e0b); border-radius:4px; display:inline-block;"></span>
                🔥 New Arrivals & Trending Songs
            </h2>
            <a href="{{ route('music.index') }}" class="btn btn-secondary btn-sm">View All Songs ({{ $latestMusic->count() }}) →</a>
        </div>
    </div>

    <!-- Automated Continuous Infinite Moving Track -->
    <div class="slider-viewport">
        <div class="slider-track">
            <!-- First Set -->
            @foreach($latestMusic as $song)
            <div class="slider-item">
                <div class="media-card-3d">
                    <div class="music-thumb-container">
                        <img src="{{ $song->getCoverUrl() }}" alt="{{ $song->title }}">
                        <div class="vinyl-overlay"><div class="vinyl-dot"></div></div>
                        <div class="play-overlay-btn" onclick="openAudioModal('{{ addslashes($song->title) }}', '{{ addslashes($song->artist) }}', '{{ $song->getAudioUrl() }}')">
                            <div class="play-circle">▶</div>
                        </div>
                    </div>
                    <div style="padding:16px;">
                        <h3 style="font-size:0.98rem; font-weight:800; color:#fff; margin-bottom:4px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                            <a href="{{ route('music.show', $song->id) }}" style="color:inherit; text-decoration:none;">{{ $song->title }}</a>
                        </h3>
                        <p style="color:#a5b4fc; font-size:0.85rem; font-weight:600; margin-bottom:6px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                            {{ $song->artist }}
                        </p>
                        <div style="display:flex; justify-content:space-between; align-items:center; font-size:0.78rem; color:#94a3b8;">
                            <span>💿 {{ $song->genre }}</span>
                            <span style="color:#f59e0b; font-weight:700;">★ {{ number_format($song->rating, 1) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Duplicated Set for Infinite Loop Seamless Transition -->
            @foreach($latestMusic as $song)
            <div class="slider-item">
                <div class="media-card-3d">
                    <div class="music-thumb-container">
                        <img src="{{ $song->getCoverUrl() }}" alt="{{ $song->title }}">
                        <div class="vinyl-overlay"><div class="vinyl-dot"></div></div>
                        <div class="play-overlay-btn" onclick="openAudioModal('{{ addslashes($song->title) }}', '{{ addslashes($song->artist) }}', '{{ $song->getAudioUrl() }}')">
                            <div class="play-circle">▶</div>
                        </div>
                    </div>
                    <div style="padding:16px;">
                        <h3 style="font-size:0.98rem; font-weight:800; color:#fff; margin-bottom:4px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                            <a href="{{ route('music.show', $song->id) }}" style="color:inherit; text-decoration:none;">{{ $song->title }}</a>
                        </h3>
                        <p style="color:#a5b4fc; font-size:0.85rem; font-weight:600; margin-bottom:6px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                            {{ $song->artist }}
                        </p>
                        <div style="display:flex; justify-content:space-between; align-items:center; font-size:0.78rem; color:#94a3b8;">
                            <span>💿 {{ $song->genre }}</span>
                            <span style="color:#f59e0b; font-weight:700;">★ {{ number_format($song->rating, 1) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- 4K VIDEOS CONCERTS SECTION (STRICT 16:9 ASPECT RATIO CONTAINER) -->
<section style="padding: 40px 0 60px;">
    <div class="container">
        <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:24px;">
            <h2 style="font-size:1.8rem; font-weight:900; color:#fff; display:flex; align-items:center; gap:10px;">
                <span style="width:6px; height:28px; background:linear-gradient(to bottom, #6366f1, #10b981); border-radius:4px; display:inline-block;"></span>
                🎬 4K Concerts & Official Videos
            </h2>
            <a href="{{ route('video.index') }}" class="btn btn-secondary btn-sm">View All Videos ({{ $latestVideos->count() }}) →</a>
        </div>

        <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(260px, 1fr)); gap:24px;">
            @foreach($latestVideos as $video)
            <div class="media-card-3d">
                <div class="video-thumb-container-16-9">
                    <img src="{{ $video->getThumbnailUrl() }}" alt="{{ $video->title }}">
                    <a href="{{ route('video.show', $video->id) }}" class="play-overlay-btn">
                        <div class="play-circle" style="background:linear-gradient(135deg, #ec4899, #f59e0b);">🎬</div>
                    </a>
                </div>
                <div style="padding:16px;">
                    <h3 style="font-size:0.98rem; font-weight:800; color:#fff; margin-bottom:4px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                        <a href="{{ route('video.show', $video->id) }}" style="color:inherit; text-decoration:none;">{{ $video->title }}</a>
                    </h3>
                    <p style="color:#f472b6; font-size:0.85rem; font-weight:600; margin-bottom:6px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                        {{ $video->artist }}
                    </p>
                    <div style="display:flex; justify-content:space-between; align-items:center; font-size:0.78rem; color:#94a3b8;">
                        <span>👁 {{ number_format($video->views) }} views</span>
                        <span style="color:#f59e0b; font-weight:700;">★ {{ number_format($video->rating, 1) }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
