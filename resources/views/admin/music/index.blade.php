@extends('layouts.admin')
@section('title', 'Manage Music')
@section('page-title', 'Music Files Catalog')
@section('top-action')
    <a href="{{ route('admin.music.create') }}" class="btn btn-primary">+ Add New Music</a>
@endsection

@section('content')
<div class="card">
    <div class="table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width:70px;">Cover</th>
                    <th>Title</th>
                    <th>Artist</th>
                    <th>Album</th>
                    <th>Year</th>
                    <th>Genre</th>
                    <th>Language</th>
                    <th>Rating</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($music as $m)
                <tr>
                    <td>
                        <img src="{{ $m->getCoverUrl() }}" alt="{{ $m->title }}" class="table-img-thumb">
                    </td>
                    <td style="font-weight:800; color:#fff; white-space:nowrap;">{{ $m->title }}</td>
                    <td style="color:#a5b4fc; font-weight:600; white-space:nowrap;">{{ $m->artist }}</td>
                    <td style="color:#cbd5e1; white-space:nowrap;">{{ $m->album ?: 'Single' }}</td>
                    <td style="white-space:nowrap;">{{ $m->year }}</td>
                    <td style="white-space:nowrap;">{{ $m->genre }}</td>
                    <td>
                        <span class="badge badge-info">{{ $m->language }}</span>
                    </td>
                    <td style="color:#f59e0b; font-weight:700; white-space:nowrap;">★ {{ number_format($m->rating, 1) }}</td>
                    <td style="text-align:right;">
                        <div class="btn-group" style="justify-content:flex-end;">
                            <a href="{{ route('admin.music.edit', $m->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                            <form method="POST" action="{{ route('admin.music.destroy', $m->id) }}" onsubmit="return confirm('Delete track: {{ addslashes($m->title) }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" style="text-align:center; color:#94a3b8; padding:40px;">
                        No music tracks found in database. <a href="{{ route('admin.music.create') }}" style="color:var(--primary-lt)">Add New Track</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top:20px;">
        {{ $music->links() }}
    </div>
</div>
@endsection
