@extends('layouts.app')
@section('title', $albumName . ' - Album Songs - SOUND Entertainment')

@section('content')
<div style="padding:60px 0; min-height:85vh;">
    <div class="container">
        
        <!-- Back Button -->
        <a href="{{ route('albums.index') }}" style="color:#a5b4fc; text-decoration:none; font-weight:600; font-size:0.9rem; display:inline-flex; align-items:center; gap:6px; margin-bottom:24px;">
            ← Back to All Albums
        </a>

        <!-- Album Header Banner -->
        <div class="card" style="padding:30px; border-radius:24px; background:linear-gradient(135deg, rgba(30,27,75,0.8), rgba(88,28,135,0.6)); border:1px solid rgba(165,180,252,0.2); margin-bottom:40px; display:flex; gap:30px; align-items:center; flex-wrap:wrap;">
            <div style="width:140px; height:140px; border-radius:18px; overflow:hidden; background:#0f172a; flex-shrink:0; box-shadow:0 12px 28px rgba(0,0,0,0.5); border:2px solid rgba(255,255,255,0.1);">
                @if($tracks->first() && $tracks->first()->cover_image)
                    <img src="{{ Str::startsWith($tracks->first()->cover_image, 'http') ? $tracks->first()->cover_image : asset('storage/'.$tracks->first()->cover_image) }}" style="width:100%; height:100%; object-fit:cover;">
                @else
                    <div style="display:flex; align-items:center; justify-content:center; width:100%; height:100%; color:#a5b4fc; font-size:4rem;">💿</div>
                @endif
            </div>

            <div>
                <div style="color:#a5b4fc; font-size:0.85rem; font-weight:700; text-transform:uppercase; letter-spacing:1.5px; margin-bottom:6px;">ALBUM COLLECTION</div>
                <h1 style="font-size:2.4rem; font-weight:900; color:#fff; margin-bottom:8px;">{{ $albumName }}</h1>
                <p style="color:#cbd5e1; font-size:1rem; margin-bottom:12px;">
                    Featuring {{ $tracks->count() }} {{ Str::plural('track', $tracks->count()) }} by 
                    <strong>{{ $tracks->pluck('artist')->unique()->implode(', ') ?: 'Various Artists' }}</strong>
                </p>
                <div style="display:flex; gap:12px;">
                    <span class="badge badge-info">{{ $tracks->pluck('genre')->unique()->implode(', ') ?: 'Music' }}</span>
                    @if($tracks->first() && $tracks->first()->year)
                        <span class="badge badge-secondary">{{ $tracks->first()->year }}</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Tracklist Header -->
        <h2 style="font-size:1.5rem; font-weight:800; color:#fff; margin-bottom:20px; display:flex; align-items:center; gap:10px;">
            <span>🎵</span> Album Tracks ({{ $tracks->count() }})
        </h2>

        <!-- Tracks List -->
        <div style="display:flex; flex-direction:column; gap:10px;">
            @forelse($tracks as $index => $track)
            <div style="display:flex; align-items:center; justify-content:space-between; gap:16px; padding:14px 20px; background:rgba(18,24,38,0.7); border:1px solid rgba(255,255,255,0.06); border-radius:14px; transition:all 0.25s ease;"
                 onmouseover="this.style.background='rgba(99,102,241,0.12)'; this.style.borderColor='rgba(99,102,241,0.3)'"
                 onmouseout="this.style.background='rgba(18,24,38,0.7)'; this.style.borderColor='rgba(255,255,255,0.06)'">
                
                <div style="display:flex; align-items:center; gap:16px; flex:1; min-width:0;">
                    <span style="font-weight:800; color:#4a5568; width:26px; text-align:center; font-size:0.85rem;">{{ sprintf('%02d', $index + 1) }}</span>
                    
                    <div style="width:48px; height:48px; border-radius:10px; overflow:hidden; background:#0f172a; flex-shrink:0; box-shadow:0 4px 12px rgba(0,0,0,0.4);">
                        <img src="/images/{{ $track->cover_image ?? 'music_1.jpg' }}" alt="{{ $track->title }}" style="width:100%; height:100%; object-fit:cover;">
                    </div>

                    <div style="min-width:0;">
                        <h4 style="font-size:1rem; font-weight:700; color:#fff; margin:0 0 2px 0; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                            <a href="{{ route('music.show', $track->id) }}" style="color:inherit; text-decoration:none;">{{ $track->title }}</a>
                        </h4>
                        <p style="color:#94a3b8; font-size:0.82rem; margin:0; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                            {{ $track->artist }}
                            @if($track->genre) <span style="color:#64748b;"> • {{ $track->genre }}</span> @endif
                        </p>
                    </div>
                </div>

                <!-- Duration + Actions -->
                <div style="display:flex; align-items:center; gap:12px; flex-shrink:0;">
                    @if($track->duration)
                    <span style="font-size:0.78rem; color:#64748b; font-weight:600; min-width:36px; text-align:right;">{{ $track->duration }}</span>
                    @endif

                    @if($track->getAudioUrl())
                    <button onclick="openAudioModal('{{ addslashes($track->title) }}', '{{ addslashes($track->artist) }}', '{{ $track->getAudioUrl() }}')"
                        style="background:linear-gradient(135deg,var(--primary),var(--accent)); border:none; color:#fff; border-radius:50px; padding:8px 16px; font-size:0.82rem; font-weight:700; cursor:pointer; display:inline-flex; align-items:center; gap:6px; box-shadow:0 4px 14px rgba(99,102,241,0.4); transition:all 0.2s ease;"
                        onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        ▶ Play
                    </button>
                    @endif

                    <a href="{{ route('music.show', $track->id) }}"
                        style="background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.12); color:#cbd5e1; border-radius:50px; padding:8px 16px; font-size:0.82rem; font-weight:600; text-decoration:none; transition:all 0.2s ease;"
                        onmouseover="this.style.background='rgba(255,255,255,0.12)'" onmouseout="this.style.background='rgba(255,255,255,0.06)'">
                        Details
                    </a>
                </div>

            </div>
            @empty
            <div style="text-align:center; padding:40px; color:#94a3b8;">
                No tracks found in this album.
            </div>
            @endforelse
        </div>

    </div>
</div>
@endsection
