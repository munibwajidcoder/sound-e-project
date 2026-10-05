@extends('layouts.app')

@section('title', 'Music - Browse All Songs')
@section('meta_description', 'Browse all Regional and English music by Album, Artist, Year, Genre.')

@push('styles')
<style>
.page-header {
    padding: 40px 0 30px;
    background: linear-gradient(180deg, #1a0a3d 0%, #0d0d1a 100%);
    border-bottom: 1px solid var(--border);
}
.page-header h1 { font-size: 2rem; font-weight: 800; color: #fff; }
.page-header p  { color: var(--text-muted); margin-top: 6px; font-size: 0.9rem; }

.filter-bar {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    padding: 20px 0;
    align-items: center;
}
.filter-bar select {
    padding: 8px 14px;
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: 8px;
    color: var(--text);
    font-size: 0.85rem;
    font-family: 'Inter', sans-serif;
    cursor: pointer;
    outline: none;
}
.filter-bar select:focus { border-color: var(--primary); }

.music-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    padding: 24px 0;
}
.rating-row { display:flex; align-items:center; gap:6px; margin-top:6px; }
.rating-num  { font-size:0.78rem; color:var(--gold); font-weight:700; }
.rating-count{ font-size:0.72rem; color:var(--text-muted); }

.lang-tag {
    display: inline-block;
    padding: 2px 8px;
    border-radius: 4px;
    font-size: 0.68rem;
    font-weight: 700;
    text-transform: uppercase;
}
.lang-regional { background: rgba(124,58,237,0.2); color: var(--primary-lt); }
.lang-english  { background: rgba(6,214,160,0.15); color: var(--accent); }

.pagination-wrap {
    padding: 24px 0;
    display: flex;
    justify-content: center;
    gap: 8px;
}
.pagination-wrap a, .pagination-wrap span {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px; height: 36px;
    border-radius: 8px;
    font-size: 0.85rem;
    font-weight: 600;
    background: var(--bg-card);
    border: 1px solid var(--border);
    color: var(--text);
    transition: all 0.2s;
}
.pagination-wrap a:hover { background: var(--primary); border-color: var(--primary); color:#fff; }
.pagination-wrap .active-page { background: var(--primary); border-color: var(--primary); color:#fff; }
</style>
@endpush

@section('content')
<div class="page-header">
    <div class="container">
        <h1>🎵 Music Directory</h1>
        <p>Browse all Regional & English songs by Album, Artist, Year, Genre and Language</p>
    </div>
</div>

<div class="container">
    <!-- Filters -->
    <form method="GET" action="{{ route('music.index') }}">
        <div class="filter-bar">
            <select name="language" onchange="this.form.submit()">
                <option value="">All Languages</option>
                @foreach($languages as $lang)
                    <option value="{{ $lang }}" {{ request('language') === $lang ? 'selected' : '' }}>{{ $lang }}</option>
                @endforeach
            </select>

            <select name="genre" onchange="this.form.submit()">
                <option value="">All Genres</option>
                @foreach($genres as $genre)
                    <option value="{{ $genre }}" {{ request('genre') === $genre ? 'selected' : '' }}>{{ $genre }}</option>
                @endforeach
            </select>

            <select name="year" onchange="this.form.submit()">
                <option value="">All Years</option>
                @foreach($years as $year)
                    <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                @endforeach
            </select>

            @if(request()->hasAny(['language','genre','year','artist','album']))
                <a href="{{ route('music.index') }}" class="btn btn-outline btn-sm">✕ Clear Filters</a>
            @endif
        </div>
    </form>

    <div class="music-grid">
        @forelse($music as $song)
        <a href="{{ route('music.show', $song->id) }}" class="media-card" style="display:block">
            @if($song->is_new)
                <span class="card-badge-pos badge-new">NEW</span>
            @endif

            {{-- Thumbnail with hover quick-play --}}
            <div style="position:relative; overflow:hidden;">
                <img src="/images/{{ $song->cover_image ?? 'music_1.jpg' }}" alt="{{ $song->title }}" class="thumb">
                @if($song->audio_url)
                <div class="card-play-btn" onclick="event.preventDefault(); openAudioModal('{{ addslashes($song->title) }}', '{{ addslashes($song->artist) }}', '/audio/{{ $song->audio_url }}')">
                    <div class="play-btn-circle">▶</div>
                </div>
                @endif
            </div>

            <div class="card-body">
                <div class="card-title">{{ $song->title }}</div>
                <div class="card-artist">{{ $song->artist }}</div>
                <div style="margin-bottom:4px">
                    <span class="lang-tag {{ $song->language === 'Regional' ? 'lang-regional' : 'lang-english' }}">{{ $song->language }}</span>
                    <span style="font-size:0.72rem; color:var(--text-muted); margin-left:6px">{{ $song->genre }} · {{ $song->year }}</span>
                </div>
                <div class="rating-row">
                    <span class="stars">★★★★★</span>
                    <span class="rating-num">{{ $song->rating }}</span>
                    <span class="rating-count">({{ $song->rating_count }})</span>
                    <span style="margin-left:auto; font-size:0.72rem; color:var(--text-muted)">🕐 {{ $song->duration }}</span>
                </div>
            </div>
        </a>
        @empty
        <div style="grid-column:1/-1; text-align:center; padding:60px 0; color:var(--text-muted)">
            <div style="font-size:3rem; margin-bottom:16px">🎵</div>
            <h3 style="color:#fff; margin-bottom:8px">No music found</h3>
            <p>Try changing your filters or <a href="{{ route('music.index') }}" style="color:var(--primary-lt)">browse all music</a></p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($music->hasPages())
    <div class="pagination-wrap">
        @if($music->onFirstPage())
            <span>‹</span>
        @else
            <a href="{{ $music->previousPageUrl() }}">‹</a>
        @endif

        @foreach($music->getUrlRange(1, $music->lastPage()) as $page => $url)
            @if($page == $music->currentPage())
                <span class="active-page">{{ $page }}</span>
            @else
                <a href="{{ $url }}">{{ $page }}</a>
            @endif
        @endforeach

        @if($music->hasMorePages())
            <a href="{{ $music->nextPageUrl() }}">›</a>
        @else
            <span>›</span>
        @endif
    </div>
    @endif
</div>
@endsection
