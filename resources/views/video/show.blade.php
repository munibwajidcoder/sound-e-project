@extends('layouts.app')

@section('title', $video->title . ' - SOUND Video')
@section('meta_description', $video->description)

@push('styles')
<style>
.detail-hero {
    background: linear-gradient(180deg, #0a1a2d 0%, #0d0d1a 100%);
    padding: 40px 0 36px;
    border-bottom: 1px solid var(--border);
}
.video-player-wrap {
    width: 100%;
    aspect-ratio: 16/9;
    border-radius: var(--radius-lg);
    overflow: hidden;
    background: #000;
    margin-bottom: 24px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.7);
}
.video-player-wrap iframe,
.video-player-wrap video {
    width: 100%; height: 100%;
    border: none;
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
.meta-badge.lang { background: rgba(6,214,160,0.15); color: var(--accent); }

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
    flex-direction: row-reverse;
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

.related-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
}
.section-title2 {
    font-size: 1.3rem;
    font-weight: 800;
    color: #fff;
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.section-title2 .bar {
    width: 4px; height: 22px;
    background: linear-gradient(to bottom, #06d6a0, #0891b2);
    border-radius: 2px;
    display: inline-block;
}
</style>
@endpush

@section('content')

<!-- VIDEO PLAYER HERO -->
<div class="detail-hero">
    <div class="container">
        <!-- Video Player -->
        <div class="video-player-wrap">
            @if($video->video_url && str_contains($video->video_url, 'youtube'))
                <iframe src="{{ $video->video_url }}" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            @elseif($video->video_url)
                <video controls>
                    <source src="{{ $video->video_url }}" type="video/mp4">
                    Your browser does not support video.
                </video>
            @else
                <div style="display:flex;align-items:center;justify-content:center;height:100%;color:var(--text-muted)">
                    <div style="text-align:center">
                        <div style="font-size:4rem; margin-bottom:16px">🎬</div>
                        <p>Video coming soon</p>
                    </div>
                </div>
            @endif
        </div>

        <!-- Video Info -->
        <p style="font-size:0.75rem; font-weight:700; letter-spacing:2px; color:var(--accent); text-transform:uppercase; margin-bottom:8px">🎬 Video</p>
        <h1 style="font-size:1.8rem; font-weight:900; color:#fff; margin-bottom:6px">{{ $video->title }}</h1>
        <p style="font-size:1rem; color:var(--primary-lt); font-weight:600; margin-bottom:10px">{{ $video->artist }}</p>
        <p style="font-size:0.88rem; color:var(--text-muted)">{{ $video->description }}</p>

        <div class="detail-meta">
            <span class="meta-badge lang">{{ $video->language }}</span>
            <span class="meta-badge">{{ $video->genre }}</span>
            <span class="meta-badge">{{ $video->year }}</span>
            @if($video->album)<span class="meta-badge">💿 {{ $video->album }}</span>@endif
            <span class="meta-badge">🕐 {{ $video->duration }}</span>
            @if($video->is_new)<span class="badge-new">NEW</span>@endif
        </div>

        <div style="display:flex; align-items:center; gap:8px">
            <span style="font-size:1.3rem; color:var(--gold)">★</span>
            <span style="font-size:1.1rem; font-weight:800; color:var(--gold)">{{ $video->rating }}</span>
            <span style="font-size:0.85rem; color:var(--text-muted)">/ 5 ({{ $video->rating_count }} ratings)</span>
        </div>
    </div>
</div>

<!-- REVIEWS -->
<div class="container" style="padding-top:50px; padding-bottom:50px">
    <div style="display:grid; grid-template-columns: 1fr 380px; gap:40px; align-items:start">

        <div>
            <h2 class="section-title2"><span class="bar"></span>Reviews & Ratings
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
                <p>No reviews yet. Be the first to review this video!</p>
            </div>
            @endforelse
        </div>

        <!-- Review Form -->
        <div>
            @auth
            <div class="review-form-box">
                <h3>{{ $userReview ? '✏ Modify Your Review' : '⭐ Add Your Review' }}</h3>
                <form method="POST" action="{{ route('reviews.store') }}">
                    @csrf
                    <input type="hidden" name="item_type" value="video">
                    <input type="hidden" name="item_id" value="{{ $video->id }}">

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
                            placeholder="Share your thoughts about this video...">{{ $userReview->review_text ?? '' }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width:100%">
                        {{ $userReview ? '💾 Update Review' : '✓ Submit Review' }}
                    </button>
                </form>
            </div>
            @else
            <div class="review-form-box" style="text-align:center">
                <div style="font-size:2.5rem; margin-bottom:12px">🔒</div>
                <h3 style="color:var(--text-muted); font-weight:400; margin-bottom:16px">Login to rate and review this video</h3>
                <a href="{{ route('login') }}" class="btn btn-primary" style="width:100%; justify-content:center">Login</a>
                <a href="{{ route('register') }}" class="btn btn-outline" style="width:100%; justify-content:center; margin-top:8px">Register</a>
            </div>
            @endauth
        </div>
    </div>

    <!-- Related -->
    @if($related->count())
    <div style="margin-top:50px">
        <h2 class="section-title2"><span class="bar"></span>More Like This</h2>
        <div class="related-grid">
            @foreach($related as $v)
            <a href="{{ route('video.show', $v->id) }}" class="media-card" style="display:block">
                @if($v->is_new)<span class="card-badge-pos badge-new">NEW</span>@endif
                <div class="video-thumb-wrap">
                    <img src="{{ $v->getThumbnailUrl() }}" onerror="this.onerror=null; this.src='/images/video_1.jpg';" alt="{{ $v->title }}">
                    <div class="play-overlay"><div class="play-btn-circle">▶</div></div>
                </div>
                <div class="card-body">
                    <div class="card-title">{{ $v->title }}</div>
                    <div class="card-artist">{{ $v->artist }}</div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</div>

@endsection
