@extends('layouts.app')

@section('title', $music->title . ' - SOUND Music')
@section('meta_description', $music->description)

@push('styles')
<style>
.detail-hero {
    background: linear-gradient(180deg, #1a0a3d 0%, #0d0d1a 100%);
    padding: 50px 0 40px;
    border-bottom: 1px solid var(--border);
}
.detail-layout {
    display: grid;
    grid-template-columns: 260px 1fr;
    gap: 40px;
    align-items: start;
}
.cover-img {
    width: 260px; height: 260px;
    object-fit: cover;
    border-radius: var(--radius-lg);
    box-shadow: 0 20px 60px rgba(0,0,0,0.6);
}
.detail-info h1 {
    font-size: 2rem;
    font-weight: 900;
    color: #fff;
    line-height: 1.2;
    margin-bottom: 8px;
}
.detail-meta { display: flex; flex-wrap: wrap; gap: 10px; margin: 14px 0; }
.meta-badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.78rem;
    font-weight: 600;
    background: rgba(255,255,255,0.08);
    color: var(--text-muted);
}
.meta-badge.lang { background: rgba(124,58,237,0.2); color: var(--primary-lt); }

/* Audio Player */
.audio-player {
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 20px 24px;
    margin-top: 20px;
}
.audio-player h3 {
    font-size: 0.85rem;
    font-weight: 700;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 14px;
}
audio {
    width: 100%;
    filter: invert(0.15) hue-rotate(270deg);
    border-radius: 8px;
}

/* Reviews Section */
.reviews-section {
    padding: 50px 0;
}
.reviews-section h2 {
    font-size: 1.3rem;
    font-weight: 800;
    color: #fff;
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.reviews-section h2 .bar {
    width: 4px; height: 22px;
    background: linear-gradient(to bottom, var(--primary), var(--accent));
    border-radius: 2px;
    display: inline-block;
}

.review-card {
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 18px 20px;
    margin-bottom: 14px;
}
.review-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 8px;
}
.reviewer-name { font-weight: 700; color: #fff; font-size: 0.9rem; }
.review-date   { font-size: 0.75rem; color: var(--text-muted); }
.review-text   { font-size: 0.88rem; color: var(--text-muted); margin-top: 6px; line-height: 1.6; }

/* Review Form */
.review-form-box {
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 24px;
    margin-bottom: 24px;
}
.review-form-box h3 {
    font-size: 1rem;
    font-weight: 700;
    color: #fff;
    margin-bottom: 18px;
}
.star-select {
    display: flex;
    gap: 6px;
    margin-bottom: 16px;
}
.star-select input[type=radio] { display: none; }
.star-select label {
    font-size: 1.8rem;
    cursor: pointer;
    color: var(--border);
    transition: color 0.15s;
}
.star-select input[type=radio]:checked ~ label,
.star-select label:hover,
.star-select label:hover ~ label { color: var(--gold); }
.star-select { flex-direction: row-reverse; }
.star-select label:hover,
.star-select label:hover ~ label { color: var(--gold); }

/* Related */
.related-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
}
</style>
@endpush

@section('content')

<!-- HERO + COVER -->
<div class="detail-hero">
    <div class="container">
        <div class="detail-layout">
            <img src="/images/{{ $music->cover_image ?? 'music_1.jpg' }}" alt="{{ $music->title }}" class="cover-img">

            <div class="detail-info">
                <p style="font-size:0.75rem; font-weight:700; letter-spacing:2px; color:var(--accent); text-transform:uppercase; margin-bottom:8px">🎵 Song</p>
                <h1>{{ $music->title }}</h1>
                <p style="font-size:1.1rem; color:var(--primary-lt); font-weight:600; margin-bottom:10px">{{ $music->artist }}</p>
                <p style="font-size:0.88rem; color:var(--text-muted)">{{ $music->description }}</p>

                <div class="detail-meta">
                    <span class="meta-badge lang">{{ $music->language }}</span>
                    <span class="meta-badge">{{ $music->genre }}</span>
                    <span class="meta-badge">{{ $music->year }}</span>
                    @if($music->album)
                        <span class="meta-badge">💿 {{ $music->album }}</span>
                    @endif
                    <span class="meta-badge">🕐 {{ $music->duration }}</span>
                    @if($music->is_new)
                        <span class="badge-new">NEW</span>
                    @endif
                </div>

                <div style="display:flex; align-items:center; gap:8px; margin-bottom:20px">
                    <span style="font-size:1.3rem; color:var(--gold)">★</span>
                    <span style="font-size:1.1rem; font-weight:800; color:var(--gold)">{{ $music->rating }}</span>
                    <span style="font-size:0.85rem; color:var(--text-muted)">/ 5 ({{ $music->rating_count }} ratings)</span>
                </div>

                <!-- Audio Player -->
                @if($music->audio_url)
                <div class="audio-player">
                    <h3>🔊 Listen Now</h3>
                    <audio controls>
                        <source src="/audio/{{ $music->audio_url }}" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- REVIEWS SECTION -->
<div class="container reviews-section">
    <div style="display:grid; grid-template-columns: 1fr 380px; gap:40px; align-items:start">

        <!-- All Reviews -->
        <div>
            <h2><span class="bar"></span>Reviews & Ratings
                <span style="font-size:0.85rem; color:var(--text-muted); font-weight:400">({{ $reviews->count() }} reviews)</span>
            </h2>

            @forelse($reviews as $review)
            <div class="review-card">
                <div class="review-header">
                    <div>
                        <span class="reviewer-name">{{ $review->user->name ?? 'User' }}</span>
                        <span style="font-size:0.75rem; color:var(--text-muted); margin-left:8px">@{{ $review->user->user_id ?? '' }}</span>
                    </div>
                    <div style="display:flex; align-items:center; gap:10px">
                        <span style="color:var(--gold); font-size:0.9rem">{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}</span>
                        <span class="review-date">{{ $review->created_at->format('M d, Y') }}</span>
                        @auth
                            @if(Auth::id() === $review->user_id)
                            <form method="POST" action="{{ route('reviews.destroy', $review->id) }}" onsubmit="return confirm('Delete this review?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                            @endif
                        @endauth
                    </div>
                </div>
                @if($review->review_text)
                    <p class="review-text">{{ $review->review_text }}</p>
                @endif
            </div>
            @empty
            <div style="text-align:center; padding:40px; background:var(--bg-card); border-radius:var(--radius-lg); color:var(--text-muted)">
                <div style="font-size:2.5rem; margin-bottom:10px">💬</div>
                <p>No reviews yet. Be the first to review this song!</p>
            </div>
            @endforelse
        </div>

        <!-- Add / Modify Review Form -->
        <div>
            @auth
            <div class="review-form-box">
                <h3>{{ $userReview ? '✏ Modify Your Review' : '⭐ Add Your Review' }}</h3>
                <form method="POST" action="{{ route('reviews.store') }}">
                    @csrf
                    <input type="hidden" name="item_type" value="music">
                    <input type="hidden" name="item_id" value="{{ $music->id }}">

                    <div class="form-group">
                        <label>Your Rating</label>
                        <div class="star-select">
                            @for($s = 5; $s >= 1; $s--)
                            <input type="radio" name="rating" id="star{{ $s }}" value="{{ $s }}"
                                {{ ($userReview && $userReview->rating == $s) ? 'checked' : ($s == 5 && !$userReview ? 'checked' : '') }}>
                            <label for="star{{ $s }}">★</label>
                            @endfor
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Your Review (optional)</label>
                        <textarea name="review_text" class="form-control" rows="4"
                            placeholder="Share your thoughts about this song...">{{ $userReview->review_text ?? '' }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width:100%">
                        {{ $userReview ? '💾 Update Review' : '✓ Submit Review' }}
                    </button>
                </form>
            </div>
            @else
            <div class="review-form-box" style="text-align:center">
                <div style="font-size:2.5rem; margin-bottom:12px">🔒</div>
                <h3 style="color:var(--text-muted); font-weight:400; margin-bottom:16px">Login to rate and review this song</h3>
                <a href="{{ route('login') }}" class="btn btn-primary" style="width:100%; justify-content:center">Login</a>
                <a href="{{ route('register') }}" class="btn btn-outline" style="width:100%; justify-content:center; margin-top:8px">Register</a>
            </div>
            @endauth
        </div>
    </div>

    <!-- Related Music -->
    @if($related->count())
    <div style="margin-top:50px">
        <h2><span class="bar"></span>More Like This</h2>
        <div class="related-grid">
            @foreach($related as $song)
            <a href="{{ route('music.show', $song->id) }}" class="media-card" style="display:block">
                @if($song->is_new)<span class="card-badge-pos badge-new">NEW</span>@endif
                <img src="/images/{{ $song->cover_image ?? 'music_1.jpg' }}" alt="{{ $song->title }}" class="thumb">
                <div class="card-body">
                    <div class="card-title">{{ $song->title }}</div>
                    <div class="card-artist">{{ $song->artist }}</div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</div>

@endsection
