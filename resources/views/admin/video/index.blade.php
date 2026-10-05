@extends('layouts.admin')
@section('title', 'Manage Videos')
@section('page-title', 'Video Files')
@section('top-action')
    <a href="{{ route('admin.video.create') }}" class="btn btn-primary">+ Add Video</a>
@endsection

@section('content')
<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Thumb</th><th>Title</th><th>Artist</th><th>Album</th>
                    <th>Year</th><th>Genre</th><th>Language</th><th>New</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($videos as $v)
                <tr>
                    <td><img src="/images/{{ $v->thumbnail ?? 'video_1.jpg' }}" alt="{{ $v->title }}"></td>
                    <td style="font-weight:600; color:#fff">{{ $v->title }}</td>
                    <td>{{ $v->artist }}</td>
                    <td>{{ $v->album }}</td>
                    <td>{{ $v->year }}</td>
                    <td>{{ $v->genre }}</td>
                    <td><span class="badge {{ $v->language === 'Regional' ? 'badge-regional' : 'badge-english' }}">{{ $v->language }}</span></td>
                    <td>{{ $v->is_new ? '✅' : '' }}</td>
                    <td>
                        <a href="{{ route('admin.video.edit', $v->id) }}" class="btn btn-outline btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.video.destroy', $v->id) }}" style="display:inline"
                            onsubmit="return confirm('Delete {{ $v->title }}?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="9" style="text-align:center; color:var(--text-muted); padding:32px">No videos yet. <a href="{{ route('admin.video.create') }}" style="color:var(--primary-lt)">Add the first one</a>.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($videos->hasPages())
    <div style="padding:20px 0 0; display:flex; gap:8px; justify-content:center">
        @if(!$videos->onFirstPage())<a href="{{ $videos->previousPageUrl() }}" class="btn btn-outline btn-sm">‹ Prev</a>@endif
        <span style="padding:5px 12px; font-size:0.82rem; color:var(--text-muted)">Page {{ $videos->currentPage() }} of {{ $videos->lastPage() }}</span>
        @if($videos->hasMorePages())<a href="{{ $videos->nextPageUrl() }}" class="btn btn-outline btn-sm">Next ›</a>@endif
    </div>
    @endif
</div>
@endsection
