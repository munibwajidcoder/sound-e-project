@extends('layouts.admin')
@section('title', 'Manage Videos')
@section('page-title', 'Video Files')
@section('top-action')
    <a href="{{ route('admin.video.create') }}" class="btn btn-primary">+ Add Video</a>
@endsection

@section('content')
<div class="card" style="padding:0; overflow:hidden;">
    <div style="overflow-x:auto; width:100%;">
        <table style="width:100%; border-collapse:collapse; min-width:900px;">
            <thead>
                <tr style="background:rgba(255,255,255,0.03);">
                    <th style="padding:13px 14px; font-size:0.72rem; font-weight:800; color:#94a3b8; text-transform:uppercase; letter-spacing:1px; border-bottom:1px solid rgba(255,255,255,0.08); white-space:nowrap; width:90px;">Thumb</th>
                    <th style="padding:13px 14px; font-size:0.72rem; font-weight:800; color:#94a3b8; text-transform:uppercase; letter-spacing:1px; border-bottom:1px solid rgba(255,255,255,0.08);">Title</th>
                    <th style="padding:13px 14px; font-size:0.72rem; font-weight:800; color:#94a3b8; text-transform:uppercase; letter-spacing:1px; border-bottom:1px solid rgba(255,255,255,0.08); white-space:nowrap;">Artist</th>
                    <th style="padding:13px 14px; font-size:0.72rem; font-weight:800; color:#94a3b8; text-transform:uppercase; letter-spacing:1px; border-bottom:1px solid rgba(255,255,255,0.08); white-space:nowrap;">Album</th>
                    <th style="padding:13px 14px; font-size:0.72rem; font-weight:800; color:#94a3b8; text-transform:uppercase; letter-spacing:1px; border-bottom:1px solid rgba(255,255,255,0.08); white-space:nowrap; width:52px;">Year</th>
                    <th style="padding:13px 14px; font-size:0.72rem; font-weight:800; color:#94a3b8; text-transform:uppercase; letter-spacing:1px; border-bottom:1px solid rgba(255,255,255,0.08); white-space:nowrap; width:80px;">Genre</th>
                    <th style="padding:13px 14px; font-size:0.72rem; font-weight:800; color:#94a3b8; text-transform:uppercase; letter-spacing:1px; border-bottom:1px solid rgba(255,255,255,0.08); white-space:nowrap; width:80px;">Lang</th>
                    <th style="padding:13px 14px; font-size:0.72rem; font-weight:800; color:#94a3b8; text-transform:uppercase; letter-spacing:1px; border-bottom:1px solid rgba(255,255,255,0.08); white-space:nowrap; width:45px; text-align:center;">New</th>
                    <th style="padding:13px 14px; font-size:0.72rem; font-weight:800; color:#94a3b8; text-transform:uppercase; letter-spacing:1px; border-bottom:1px solid rgba(255,255,255,0.08); white-space:nowrap; width:120px; text-align:center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($videos as $v)
                <tr onmouseover="this.style.background='rgba(99,102,241,0.07)'" onmouseout="this.style.background='transparent'">
                    <td style="padding:10px 14px; border-bottom:1px solid rgba(255,255,255,0.05); vertical-align:middle;">
                        <img src="/images/{{ $v->thumbnail ?? 'video_1.jpg' }}" alt=""
                             style="width:78px; height:44px; object-fit:cover; border-radius:7px; border:1px solid rgba(255,255,255,0.1); display:block;">
                    </td>
                    <td style="padding:10px 14px; border-bottom:1px solid rgba(255,255,255,0.05); vertical-align:middle;">
                        <div style="font-weight:700; color:#fff; font-size:0.87rem; max-width:180px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ $v->title }}</div>
                    </td>
                    <td style="padding:10px 14px; border-bottom:1px solid rgba(255,255,255,0.05); vertical-align:middle; font-size:0.85rem; color:#94a3b8; white-space:nowrap;">{{ $v->artist }}</td>
                    <td style="padding:10px 14px; border-bottom:1px solid rgba(255,255,255,0.05); vertical-align:middle; font-size:0.85rem; color:#94a3b8; white-space:nowrap;">{{ $v->album }}</td>
                    <td style="padding:10px 14px; border-bottom:1px solid rgba(255,255,255,0.05); vertical-align:middle; font-size:0.85rem; color:#94a3b8; white-space:nowrap;">{{ $v->year }}</td>
                    <td style="padding:10px 14px; border-bottom:1px solid rgba(255,255,255,0.05); vertical-align:middle; font-size:0.82rem; color:#94a3b8; white-space:nowrap;">{{ $v->genre }}</td>
                    <td style="padding:10px 14px; border-bottom:1px solid rgba(255,255,255,0.05); vertical-align:middle;">
                        <span style="display:inline-block; padding:3px 8px; border-radius:5px; font-size:0.68rem; font-weight:800; text-transform:uppercase;
                            background:rgba(236,72,153,0.2); color:#f9a8d4; border:1px solid rgba(236,72,153,0.35); white-space:nowrap;">{{ $v->language }}</span>
                    </td>
                    <td style="padding:10px 14px; border-bottom:1px solid rgba(255,255,255,0.05); vertical-align:middle; text-align:center;">
                        @if($v->is_new)<span style="color:#34d399; font-size:1rem;">✔</span>@endif
                    </td>
                    <td style="padding:10px 14px; border-bottom:1px solid rgba(255,255,255,0.05); vertical-align:middle;">
                        <div style="display:flex; gap:6px; align-items:center; justify-content:center;">
                            <a href="{{ route('admin.video.edit', $v->id) }}"
                               style="display:inline-block; padding:5px 12px; border-radius:7px; font-size:0.78rem; font-weight:700; border:1px solid rgba(255,255,255,0.15); color:#f1f5f9; background:transparent; text-decoration:none; white-space:nowrap;">Edit</a>
                            <form method="POST" action="{{ route('admin.video.destroy', $v->id) }}"
                                  onsubmit="return confirm('Delete {{ addslashes($v->title) }}?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        style="padding:5px 12px; border-radius:7px; font-size:0.78rem; font-weight:700; border:none; color:#fff; background:#ef4444; cursor:pointer; white-space:nowrap;">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" style="text-align:center; color:#94a3b8; padding:48px; font-size:0.92rem;">
                        No videos yet. <a href="{{ route('admin.video.create') }}" style="color:#818cf8; font-weight:700;">Add the first one</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($videos->hasPages())
    <div style="padding:16px 20px; display:flex; gap:8px; justify-content:center; border-top:1px solid rgba(255,255,255,0.06);">
        @if(!$videos->onFirstPage())<a href="{{ $videos->previousPageUrl() }}" class="btn btn-outline btn-sm">‹ Prev</a>@endif
        <span style="padding:5px 12px; font-size:0.82rem; color:var(--text-muted)">Page {{ $videos->currentPage() }} of {{ $videos->lastPage() }}</span>
        @if($videos->hasMorePages())<a href="{{ $videos->nextPageUrl() }}" class="btn btn-outline btn-sm">Next ›</a>@endif
    </div>
    @endif
</div>
@endsection
