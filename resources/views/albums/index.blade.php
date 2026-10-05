@extends('layouts.app')
@section('title', 'Browse Music Albums - SOUND Entertainment')

@section('content')
<div style="padding:60px 0; min-height:85vh;">
    <div class="container">
        
        <!-- Header -->
        <div style="margin-bottom:40px; text-align:center;">
            <div style="display:inline-block; padding:6px 16px; background:rgba(99,102,241,0.15); border:1px solid rgba(99,102,241,0.3); border-radius:50px; color:#a5b4fc; font-size:0.85rem; font-weight:600; margin-bottom:12px; letter-spacing:1px; text-transform:uppercase;">
                💿 Discography & Collections
            </div>
            <h1 style="font-size:2.6rem; font-weight:900; background:linear-gradient(135deg, #fff 30%, #a5b4fc); -webkit-background-clip:text; -webkit-text-fill-color:transparent; margin-bottom:10px;">
                Explore Music Albums
            </h1>
            <p style="color:#94a3b8; font-size:1.05rem; max-width:600px; margin:0 auto;">
                Discover top curated albums, official soundtracks, and full song collections from legendary artists.
            </p>
        </div>

        <!-- Album Categories Badges -->
        @if($albumCategories->count() > 0)
        <div style="display:flex; flex-wrap:wrap; justify-content:center; gap:10px; margin-bottom:40px;">
            @foreach($albumCategories as $cat)
            <a href="{{ route('albums.show', $cat->name) }}" class="category-pill" style="padding:10px 20px; font-weight:600;">
                💿 {{ $cat->name }}
            </a>
            @endforeach
        </div>
        @endif

        <!-- Albums Grid -->
        <div class="media-grid">
            @forelse($albums as $album)
            <div style="border-radius:18px; overflow:hidden; background:rgba(18,24,38,0.8); border:1px solid rgba(255,255,255,0.08); transition:all 0.35s cubic-bezier(0.34,1.56,0.64,1); cursor:pointer;"
                 onmouseover="this.style.transform='translateY(-8px) scale(1.02)'; this.style.boxShadow='0 20px 45px rgba(99,102,241,0.35)'; this.style.borderColor='rgba(99,102,241,0.5)'"
                 onmouseout="this.style.transform=''; this.style.boxShadow=''; this.style.borderColor='rgba(255,255,255,0.08)'">
                <div style="position:relative; aspect-ratio:1/1; overflow:hidden; background:#0f172a;">
                    @if($album->cover)
                        <img src="/images/{{ $album->cover }}" alt="{{ $album->album }}" style="width:100%; height:100%; object-fit:cover; transition:transform 0.4s ease;" class="card-img">
                    @else
                        <div style="display:flex; align-items:center; justify-content:center; width:100%; height:100%; background:linear-gradient(135deg, #312e81, #581c87); color:#a5b4fc; font-size:3.5rem;">
                            💿
                        </div>
                    @endif
                    <div style="position:absolute; inset:0; background:linear-gradient(to top, rgba(15,23,42,0.95), transparent 60%); pointer-events:none;"></div>
                    <div style="position:absolute; bottom:14px; left:14px; right:14px; display:flex; justify-content:space-between; align-items:center;">
                        <span class="badge badge-info" style="font-size:0.75rem; padding:4px 10px; border-radius:20px;">
                            {{ $album->track_count }} {{ Str::plural('Track', $album->track_count) }}
                        </span>
                        <a href="{{ route('albums.show', $album->album) }}" class="btn btn-primary btn-sm" style="border-radius:50px; padding:6px 16px; font-size:0.8rem; box-shadow:0 4px 12px rgba(99,102,241,0.4);">
                            View Album →
                        </a>
                    </div>
                </div>
                <div style="padding:18px;">
                    <h3 style="font-size:1.15rem; font-weight:700; color:#fff; margin-bottom:4px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                        <a href="{{ route('albums.show', $album->album) }}" style="color:inherit; text-decoration:none;">{{ $album->album }}</a>
                    </h3>
                    <p style="color:#94a3b8; font-size:0.85rem; margin:0;">Official Album Release</p>
                </div>
            </div>
            @empty
            <div style="grid-column:1/-1; text-align:center; padding:60px 20px; color:#94a3b8;">
                <div style="font-size:3rem; margin-bottom:12px;">💿</div>
                <h3>No Albums Found</h3>
                <p>Check back later or add albums through the admin panel!</p>
            </div>
            @endforelse
        </div>

        <div style="margin-top:35px;">
            {{ $albums->links() }}
        </div>

    </div>
</div>
@endsection
