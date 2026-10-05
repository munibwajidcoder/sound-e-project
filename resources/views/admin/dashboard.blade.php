@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Overview Dashboard')

@section('content')

<!-- Stats Grid -->
<div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:20px; margin-bottom:32px;">
    <div class="card" style="margin-bottom:0; text-align:center; padding:20px;">
        <div style="font-size:2rem; margin-bottom:6px;">🎵</div>
        <div style="font-size:2.2rem; font-weight:900; color:#fff;">{{ $totalMusic }}</div>
        <div style="font-size:0.85rem; color:#a5b4fc; font-weight:700;">Music Tracks</div>
    </div>
    <div class="card" style="margin-bottom:0; text-align:center; padding:20px;">
        <div style="font-size:2rem; margin-bottom:6px;">🎬</div>
        <div style="font-size:2.2rem; font-weight:900; color:#fff;">{{ $totalVideos }}</div>
        <div style="font-size:0.85rem; color:#f472b6; font-weight:700;">4K Videos</div>
    </div>
    <div class="card" style="margin-bottom:0; text-align:center; padding:20px;">
        <div style="font-size:2rem; margin-bottom:6px;">👥</div>
        <div style="font-size:2.2rem; font-weight:900; color:#fff;">{{ $totalUsers }}</div>
        <div style="font-size:0.85rem; color:#6ee7b7; font-weight:700;">Registered Users</div>
    </div>
    <div class="card" style="margin-bottom:0; text-align:center; padding:20px;">
        <div style="font-size:2rem; margin-bottom:6px;">💬</div>
        <div style="font-size:2.2rem; font-weight:900; color:#fff;">{{ $totalReviews }}</div>
        <div style="font-size:0.85rem; color:#fcd34d; font-weight:700;">User Reviews</div>
    </div>
    <div class="card" style="margin-bottom:0; text-align:center; padding:20px;">
        <div style="font-size:2rem; margin-bottom:6px;">🏷</div>
        <div style="font-size:2.2rem; font-weight:900; color:#fff;">{{ $totalCategories }}</div>
        <div style="font-size:0.85rem; color:#cbd5e1; font-weight:700;">Categories</div>
    </div>
</div>

<!-- Quick Actions & Recent Reviews -->
<div style="display:grid; grid-template-columns:1fr 1fr; gap:24px; margin-bottom:32px">
    <div class="card" style="margin-bottom:0">
        <div class="card-title">⚡ Quick Management Actions</div>
        <div style="display:flex; flex-wrap:wrap; gap:12px">
            <a href="{{ route('admin.music.create') }}" class="btn btn-primary">+ Add New Music</a>
            <a href="{{ route('admin.video.create') }}" class="btn btn-secondary" style="background:rgba(236,72,153,0.2); color:#f472b6; border-color:rgba(236,72,153,0.4);">+ Add New Video</a>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-outline">+ Add Category</a>
            <a href="{{ route('admin.users.create') }}" class="btn btn-outline">+ Add User</a>
        </div>
    </div>

    <div class="card" style="margin-bottom:0">
        <div class="card-title">💬 Latest Customer Reviews</div>
        @forelse($recentReviews as $r)
        <div style="display:flex; justify-content:space-between; align-items:center; padding:10px 0; border-bottom:1px solid rgba(255,255,255,0.06)">
            <div>
                <span style="font-weight:700; color:#fff;">{{ $r->user->name ?? 'User' }}</span>
                <span style="font-size:0.8rem; color:#94a3b8;">reviewed {{ ucfirst($r->item_type) }} #{{ $r->item_id }}</span>
            </div>
            <span style="color:#f59e0b; font-size:0.9rem;">{{ str_repeat('★', $r->rating) }}</span>
        </div>
        @empty
        <p style="color:#94a3b8; font-size:0.9rem;">No reviews submitted yet.</p>
        @endforelse
    </div>
</div>

<!-- Recent Registered Users Table -->
<div class="card">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px">
        <div class="card-title" style="margin:0">👥 Recent User Registrations</div>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm">Manage All Users →</a>
    </div>
    <div style="overflow-x:auto;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Registered</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentUsers as $u)
                <tr>
                    <td><code style="color:#a5b4fc; font-weight:700;">{{ $u->user_id }}</code></td>
                    <td style="font-weight:700; color:#fff;">{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->phone ?: 'N/A' }}</td>
                    <td>
                        <span class="badge {{ $u->role === 'admin' ? 'badge-info' : '' }}" style="background:rgba(255,255,255,0.08); color:#cbd5e1;">
                            {{ strtoupper($u->role) }}
                        </span>
                    </td>
                    <td>{{ $u->created_at->format('M d, Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center; color:#94a3b8; padding:30px;">No registered users found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
