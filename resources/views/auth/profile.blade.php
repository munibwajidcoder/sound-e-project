@extends('layouts.app')
@section('title', 'My Profile - SOUND Entertainment')

@section('content')
<div style="padding:40px 0; min-height:85vh;">
<div class="container">
    <h1 style="font-size:2rem; font-weight:900; color:#fff; margin-bottom:28px">👤 My Profile</h1>

    <div style="display:grid; grid-template-columns:320px 1fr; gap:32px; align-items:start">

        <!-- Profile Info Card -->
        <div style="background:var(--bg-card); border:1px solid var(--border); border-radius:var(--radius-lg); padding:28px; box-shadow:0 10px 30px rgba(0,0,0,0.4);">
            <div style="text-align:center; margin-bottom:24px">
                <div style="width:76px;height:76px;background:linear-gradient(135deg,var(--primary),var(--accent));border-radius:50%;margin:0 auto 14px;display:flex;align-items:center;justify-content:center;font-size:2.2rem;color:#fff;font-weight:800;box-shadow:0 8px 20px rgba(99,102,241,0.5);">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <h2 style="font-size:1.2rem; font-weight:800; color:#fff">{{ $user->name }}</h2>
                <p style="font-size:0.85rem; color:var(--text-muted); margin-top:2px">@ {{ $user->user_id }}</p>
                <span style="display:inline-block; margin-top:8px; padding:4px 14px; background:rgba(124,58,237,0.2); color:var(--primary-lt); border-radius:20px; font-size:0.75rem; font-weight:800; text-transform:uppercase; border:1px solid rgba(124,58,237,0.4);">
                    {{ $user->role }} Account
                </span>
            </div>

            <div style="display:flex; flex-direction:column; gap:12px;">
                <div style="padding:10px 0; border-bottom:1px solid var(--border)">
                    <div style="font-size:0.75rem; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.5px; margin-bottom:2px">Email Address</div>
                    <div style="font-size:0.92rem; color:var(--text); font-weight:600;">{{ $user->email }}</div>
                </div>
                <div style="padding:10px 0; border-bottom:1px solid var(--border)">
                    <div style="font-size:0.75rem; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.5px; margin-bottom:2px">Phone Number</div>
                    <div style="font-size:0.92rem; color:var(--text); font-weight:600;">{{ $user->phone ?? 'Not provided' }}</div>
                </div>
                <div style="padding:10px 0; border-bottom:1px solid var(--border)">
                    <div style="font-size:0.75rem; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.5px; margin-bottom:2px">Address</div>
                    <div style="font-size:0.92rem; color:var(--text); font-weight:600;">{{ $user->address ?? 'Not provided' }}</div>
                </div>
                <div style="padding:10px 0; border-bottom:1px solid var(--border)">
                    <div style="font-size:0.75rem; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.5px; margin-bottom:2px">Member Since</div>
                    <div style="font-size:0.92rem; color:var(--text); font-weight:600;">{{ $user->created_at->format('M d, Y') }}</div>
                </div>

                <!-- Account Logout Button -->
                <div style="margin-top:16px;">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger" style="width:100%; border-radius:12px; padding:12px; font-size:0.95rem; display:flex; align-items:center; justify-content:center; gap:8px;">
                            🚪 Logout Account
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- My Reviews & Rating Activity -->
        <div>
            <h2 style="font-size:1.3rem; font-weight:800; color:#fff; margin-bottom:20px; display:flex; align-items:center; gap:10px">
                <span style="width:5px;height:24px;background:linear-gradient(to bottom,var(--primary),var(--accent));border-radius:3px;display:inline-block"></span>
                My Ratings & Reviews
                <span style="font-size:0.85rem; color:var(--text-muted); font-weight:600">({{ $reviews->count() }} total)</span>
            </h2>

            @forelse($reviews as $review)
            <div style="background:var(--bg-card); border:1px solid var(--border); border-radius:var(--radius); padding:20px; margin-bottom:16px; box-shadow:0 6px 20px rgba(0,0,0,0.3);">
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:10px">
                    <div>
                        @if($review->item_type === 'music')
                            <span style="font-size:0.75rem; padding:4px 10px; background:rgba(124,58,237,0.2); color:var(--primary-lt); border-radius:6px; font-weight:700; text-transform:uppercase; margin-right:8px; border:1px solid rgba(124,58,237,0.3)">🎵 Music Item #{{ $review->item_id }}</span>
                        @else
                            <span style="font-size:0.75rem; padding:4px 10px; background:rgba(16,185,129,0.15); color:var(--accent); border-radius:6px; font-weight:700; text-transform:uppercase; margin-right:8px; border:1px solid rgba(16,185,129,0.3)">🎬 Video Item #{{ $review->item_id }}</span>
                        @endif
                    </div>
                    <div style="display:flex; align-items:center; gap:12px">
                        <span style="color:var(--gold); font-size:1.1rem;">{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}</span>
                        <span style="font-size:0.8rem; color:var(--text-muted)">{{ $review->created_at->format('M d, Y') }}</span>
                        <form method="POST" action="{{ route('reviews.destroy', $review->id) }}" onsubmit="return confirm('Delete this review?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" style="border-radius:6px;">Delete</button>
                        </form>
                    </div>
                </div>
                @if($review->review_text)
                    <p style="font-size:0.9rem; color:#cbd5e1; line-height:1.6; margin:0;">{{ $review->review_text }}</p>
                @endif
            </div>
            @empty
            <div style="text-align:center; padding:60px 20px; background:var(--bg-card); border-radius:var(--radius-lg); color:var(--text-muted); border:1px solid var(--border);">
                <div style="font-size:3rem; margin-bottom:12px">💬</div>
                <h3 style="font-size:1.1rem; color:#fff; margin-bottom:6px;">No Reviews Added Yet</h3>
                <p style="font-size:0.9rem; margin-bottom:20px;">Explore music & video collections to post ratings and reviews.</p>
                <a href="{{ route('music.index') }}" class="btn btn-primary">Browse Catalog →</a>
            </div>
            @endforelse
        </div>
    </div>
</div>
</div>
@endsection
