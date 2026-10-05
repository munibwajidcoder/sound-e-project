@extends('layouts.app')
@section('title', 'Search - SOUND Entertainment')

@section('content')
<div style="padding:50px 0; min-height:80vh">
<div class="container">

    <h1 style="font-size:2rem; font-weight:900; color:#fff; margin-bottom:8px">🔍 Search Entertainment</h1>
    <p style="color:var(--text-muted); margin-bottom:32px">Search by Name, Artist, Album, Year and more</p>

    <!-- Search Form -->
    <form method="GET" action="{{ route('search') }}">
        <div style="background:var(--bg-card); border:1px solid var(--border); border-radius:var(--radius-lg); padding:24px; margin-bottom:36px">
            <div style="display:grid; grid-template-columns:1fr 1fr 1fr 1fr; gap:16px; margin-bottom:16px">
                <div class="form-group" style="margin:0">
                    <label>Search Name</label>
                    <input type="text" name="q" class="form-control" placeholder="Song or video name..." value="{{ $query }}">
                </div>
                <div class="form-group" style="margin:0">
                    <label>Artist</label>
                    <input type="text" name="artist" class="form-control" placeholder="Artist name..." value="{{ $artist }}">
                </div>
                <div class="form-group" style="margin:0">
                    <label>Album</label>
                    <input type="text" name="album" class="form-control" placeholder="Album name..." value="{{ $album }}">
                </div>
                <div class="form-group" style="margin:0">
                    <label>Year</label>
                    <input type="number" name="year" class="form-control" placeholder="e.g. 2024" value="{{ $year }}" min="1900" max="2030">
                </div>
            </div>
            <div style="display:flex; align-items:center; gap:12px">
                <div style="display:flex; gap:8px">
                    @foreach(['all' => 'All', 'music' => '🎵 Music Only', 'video' => '🎬 Videos Only'] as $val => $label)
                    <label style="display:flex; align-items:center; gap:6px; cursor:pointer; padding:7px 14px; background:{{ $type === $val ? 'rgba(124,58,237,0.3)' : 'rgba(255,255,255,0.04)' }}; border:1px solid {{ $type === $val ? 'var(--primary)' : 'var(--border)' }}; border-radius:8px; font-size:0.85rem; color:{{ $type === $val ? '#fff' : 'var(--text-muted)' }}">
                        <input type="radio" name="type" value="{{ $val }}" {{ $type === $val ? 'checked' : '' }} style="accent-color:var(--primary)">
                        {{ $label }}
                    </label>
                    @endforeach
                </div>
                <button type="submit" class="btn btn-primary" style="margin-left:auto">Search →</button>
                @if($query || $artist || $album || $year)
                <a href="{{ route('search') }}" class="btn btn-outline">Clear</a>
                @endif
            </div>
        </div>
    </form>

    @if($query || $artist || $album || $year)

    <!-- Music Results -->
    @if($type !== 'video')
    <div style="margin-bottom:40px">
        <h2 style="font-size:1.2rem; font-weight:800; color:#fff; margin-bottom:16px; display:flex; align-items:center; gap:10px">
            <span style="width:4px;height:20px;background:linear-gradient(to bottom,var(--primary),var(--accent));border-radius:2px;display:inline-block"></span>
            Music Results <span style="font-size:0.85rem; color:var(--text-muted); font-weight:400">({{ $musicResults->count() }})</span>
        </h2>
        @if($musicResults->count())
        <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:18px">
            @foreach($musicResults as $song)
            <a href="{{ route('music.show', $song->id) }}" class="media-card" style="display:block">
                @if($song->is_new)<span class="card-badge-pos badge-new">NEW</span>@endif
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
                    <div style="font-size:0.72rem; color:var(--text-muted)">{{ $song->genre }} · {{ $song->year }}</div>
                </div>
            </a>
            @endforeach
        </div>
        @else
        <p style="color:var(--text-muted)">No music found matching your search.</p>
        @endif
    </div>
    @endif

    <!-- Video Results -->
    @if($type !== 'music')
    <div>
        <h2 style="font-size:1.2rem; font-weight:800; color:#fff; margin-bottom:16px; display:flex; align-items:center; gap:10px">
            <span style="width:4px;height:20px;background:linear-gradient(to bottom,#06d6a0,#0891b2);border-radius:2px;display:inline-block"></span>
            Video Results <span style="font-size:0.85rem; color:var(--text-muted); font-weight:400">({{ $videoResults->count() }})</span>
        </h2>
        @if($videoResults->count())
        <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:18px">
            @foreach($videoResults as $video)
            <a href="{{ route('video.show', $video->id) }}" class="media-card" style="display:block">
                @if($video->is_new)<span class="card-badge-pos badge-new">NEW</span>@endif
                <div class="video-thumb-wrap">
                    <img src="/images/{{ $video->thumbnail ?? 'video_1.jpg' }}" alt="{{ $video->title }}">
                    <div class="play-overlay"><div class="play-btn-circle">▶</div></div>
                </div>
                <div class="card-body">
                    <div class="card-title">{{ $video->title }}</div>
                    <div class="card-artist">{{ $video->artist }}</div>
                    <div style="font-size:0.72rem; color:var(--text-muted)">{{ $video->genre }} · {{ $video->year }}</div>
                </div>
            </a>
            @endforeach
        </div>
        @else
        <p style="color:var(--text-muted)">No videos found matching your search.</p>
        @endif
    </div>
    @endif

    @else
    <div style="text-align:center; padding:60px; color:var(--text-muted)">
        <div style="font-size:3rem; margin-bottom:16px">🔍</div>
        <h3 style="color:#fff; margin-bottom:8px">Start Searching</h3>
        <p>Enter a name, artist, album or year above to find music and videos.</p>
    </div>
    @endif

</div>
</div>
@endsection
