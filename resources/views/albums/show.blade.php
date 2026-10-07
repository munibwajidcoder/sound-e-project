@extends('layouts.app')
@section('title', $albumName . ' - Album Songs - SOUND Entertainment')

@section('content')
<div style="padding:50px 0; min-height:85vh;">
    <div class="container">
        
        <!-- Back Button -->
        <a href="{{ route('albums.index') }}" style="color:#a5b4fc; text-decoration:none; font-weight:700; font-size:0.9rem; display:inline-flex; align-items:center; gap:8px; margin-bottom:28px; background:rgba(99,102,241,0.1); padding:8px 18px; border-radius:50px; border:1px solid rgba(99,102,241,0.25); transition:all 0.25s ease;"
           onmouseover="this.style.background='rgba(99,102,241,0.25)'; this.style.transform='translateX(-4px)';" 
           onmouseout="this.style.background='rgba(99,102,241,0.1)'; this.style.transform='translateX(0)';">
            ← Back to All Albums
        </a>

        @php
            $firstTrack = $tracks->first();
            $albumCover = $firstTrack ? $firstTrack->cover_image : null;
            if ($albumCover && (str_starts_with($albumCover, 'http://') || str_starts_with($albumCover, 'https://') || str_starts_with($albumCover, '/images/'))) {
                $albumImgSrc = $albumCover;
            } elseif ($albumCover) {
                $albumImgSrc = '/images/' . $albumCover;
            } else {
                $albumImgSrc = '/images/music_1.jpg';
            }
        @endphp

        <!-- Album Header Banner -->
        <div style="padding:32px; border-radius:24px; background:linear-gradient(135deg, rgba(30,27,75,0.95), rgba(88,28,135,0.7)); border:1px solid rgba(165,180,252,0.25); margin-bottom:40px; display:flex; gap:32px; align-items:center; flex-wrap:wrap; box-shadow:0 20px 45px rgba(0,0,0,0.5); position:relative; overflow:hidden;">
            
            <div style="position:relative; width:160px; height:160px; border-radius:20px; overflow:hidden; background:#0f172a; flex-shrink:0; box-shadow:0 15px 35px rgba(0,0,0,0.6); border:2px solid rgba(255,255,255,0.15);">
                <img src="{{ $albumImgSrc }}" 
                     onerror="this.onerror=null; this.src='/images/music_1.jpg';" 
                     style="width:100%; height:100%; object-fit:cover;">
                <div style="position:absolute; inset:0; background:linear-gradient(to top, rgba(0,0,0,0.4), transparent);"></div>
            </div>

            <div style="flex-grow:1;">
                <div style="display:inline-block; padding:4px 14px; background:rgba(99,102,241,0.2); border:1px solid rgba(99,102,241,0.4); border-radius:50px; color:#a5b4fc; font-size:0.75rem; font-weight:800; text-transform:uppercase; letter-spacing:1.5px; margin-bottom:8px;">
                    💿 Official Album Discography
                </div>
                <h1 style="font-size:2.8rem; font-weight:900; color:#fff; margin-bottom:10px; line-height:1.1;">{{ $albumName }}</h1>
                <p style="color:#cbd5e1; font-size:1.05rem; margin-bottom:16px;">
                    Featuring {{ $tracks->count() }} {{ Str::plural('track', $tracks->count()) }} by 
                    <strong style="color:#fff;">{{ $tracks->pluck('artist')->unique()->filter()->implode(', ') ?: 'SOUND Artists' }}</strong>
                </p>
                <div style="display:flex; gap:10px; flex-wrap:wrap;">
                    <span style="padding:6px 16px; background:rgba(255,255,255,0.08); border-radius:50px; color:#a5b4fc; font-size:0.85rem; font-weight:700;">
                        🎵 {{ $tracks->pluck('genre')->unique()->filter()->implode(', ') ?: 'Music' }}
                    </span>
                    @if($firstTrack && $firstTrack->year)
                        <span style="padding:6px 16px; background:rgba(255,255,255,0.08); border-radius:50px; color:#cbd5e1; font-size:0.85rem; font-weight:600;">
                            📅 {{ $firstTrack->year }}
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Tracklist Header -->
        <h2 style="font-size:1.6rem; font-weight:800; color:#fff; margin-bottom:22px; display:flex; align-items:center; gap:10px;">
            <span>🎶</span> Tracklist ({{ $tracks->count() }} Songs)
        </h2>

        <!-- Tracks List -->
        <div style="display:flex; flex-direction:column; gap:12px;">
            @forelse($tracks as $index => $track)
            @php
                $tCover = $track->cover_image;
                if ($tCover && (str_starts_with($tCover, 'http://') || str_starts_with($tCover, 'https://') || str_starts_with($tCover, '/images/'))) {
                    $tImgSrc = $tCover;
                } elseif ($tCover) {
                    $tImgSrc = '/images/' . $tCover;
                } else {
                    $tImgSrc = '/images/music_1.jpg';
                }
            @endphp
            <div style="display:flex; align-items:center; justify-content:space-between; gap:16px; padding:16px 22px; background:rgba(18,24,43,0.75); border:1px solid rgba(255,255,255,0.08); border-radius:16px; backdrop-filter:blur(10px); transition:all 0.3s ease;"
                 onmouseover="this.style.background='rgba(99,102,241,0.15)'; this.style.borderColor='rgba(129,140,248,0.4)'; this.style.transform='translateX(6px)';"
                 onmouseout="this.style.background='rgba(18,24,43,0.75)'; this.style.borderColor='rgba(255,255,255,0.08)'; this.style.transform='translateX(0)';">
                
                <div style="display:flex; align-items:center; gap:18px; flex:1; min-width:0;">
                    <span style="font-weight:900; color:#64748b; width:28px; text-align:center; font-size:0.9rem;">{{ sprintf('%02d', $index + 1) }}</span>
                    
                    <div style="width:52px; height:52px; border-radius:12px; overflow:hidden; background:#0f172a; flex-shrink:0; box-shadow:0 6px 16px rgba(0,0,0,0.5); border:1px solid rgba(255,255,255,0.1);">
                        <img src="{{ $tImgSrc }}" 
                             onerror="this.onerror=null; this.src='/images/music_1.jpg';" 
                             alt="{{ $track->title }}" 
                             style="width:100%; height:100%; object-fit:cover;">
                    </div>

                    <div style="min-width:0;">
                        <h4 style="font-size:1.05rem; font-weight:700; color:#fff; margin:0 0 4px 0; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                            <a href="{{ route('music.show', $track->id) }}" style="color:inherit; text-decoration:none;">{{ $track->title }}</a>
                        </h4>
                        <p style="color:#94a3b8; font-size:0.85rem; margin:0; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                            🎤 {{ $track->artist }}
                            @if($track->genre) <span style="color:#64748b; margin:0 4px;">•</span> <span style="color:#a5b4fc;">{{ $track->genre }}</span> @endif
                        </p>
                    </div>
                </div>

                <!-- Duration + Actions -->
                <div style="display:flex; align-items:center; gap:12px; flex-shrink:0;">
                    @if($track->duration)
                    <span style="font-size:0.82rem; color:#94a3b8; font-weight:600; min-width:40px; text-align:right;">⏱️ {{ $track->duration }}</span>
                    @endif

                    @if($track->getAudioUrl())
                    <button onclick="openAudioModal('{{ addslashes($track->title) }}', '{{ addslashes($track->artist) }}', '{{ $track->getAudioUrl() }}')"
                        style="background:linear-gradient(135deg,#6366f1,#ec4899); border:none; color:#fff; border-radius:50px; padding:9px 18px; font-size:0.85rem; font-weight:700; cursor:pointer; display:inline-flex; align-items:center; gap:6px; box-shadow:0 4px 15px rgba(99,102,241,0.4); transition:all 0.25s ease;"
                        onmouseover="this.style.transform='scale(1.06)'" onmouseout="this.style.transform='scale(1)'">
                        ▶ Play Track
                    </button>
                    @endif

                    <a href="{{ route('music.show', $track->id) }}"
                        style="background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.12); color:#cbd5e1; border-radius:50px; padding:9px 18px; font-size:0.85rem; font-weight:600; text-decoration:none; transition:all 0.25s ease;"
                        onmouseover="this.style.background='rgba(255,255,255,0.15)'" onmouseout="this.style.background='rgba(255,255,255,0.06)'">
                        Details
                    </a>
                </div>

            </div>
            @empty
            <div style="text-align:center; padding:50px; color:#94a3b8; background:rgba(18,24,43,0.5); border-radius:18px; border:1px dashed rgba(255,255,255,0.1);">
                No tracks found in this album.
            </div>
            @endforelse
        </div>

    </div>
</div>
@endsection
