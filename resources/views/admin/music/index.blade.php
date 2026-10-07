@extends('layouts.admin')
@section('title', 'Manage Music')
@section('page-title', 'Music Files Catalog')
@section('top-action')
    <a href="{{ route('admin.music.create') }}" class="btn btn-primary">+ Add New Music</a>
@endsection

@section('content')
<div class="card" style="padding:0; overflow:hidden;">
    <div style="overflow-x:auto; width:100%;">
        <table style="width:100%; border-collapse:collapse; min-width:900px;">
            <thead>
                <tr style="background:rgba(255,255,255,0.03);">
                    <th style="padding:13px 14px; font-size:0.72rem; font-weight:800; color:#94a3b8; text-transform:uppercase; letter-spacing:1px; border-bottom:1px solid rgba(255,255,255,0.08); white-space:nowrap; width:60px;">Cover</th>
                    <th style="padding:13px 14px; font-size:0.72rem; font-weight:800; color:#94a3b8; text-transform:uppercase; letter-spacing:1px; border-bottom:1px solid rgba(255,255,255,0.08); white-space:nowrap;">Title</th>
                    <th style="padding:13px 14px; font-size:0.72rem; font-weight:800; color:#94a3b8; text-transform:uppercase; letter-spacing:1px; border-bottom:1px solid rgba(255,255,255,0.08); white-space:nowrap;">Artist</th>
                    <th style="padding:13px 14px; font-size:0.72rem; font-weight:800; color:#94a3b8; text-transform:uppercase; letter-spacing:1px; border-bottom:1px solid rgba(255,255,255,0.08); white-space:nowrap;">Album</th>
                    <th style="padding:13px 14px; font-size:0.72rem; font-weight:800; color:#94a3b8; text-transform:uppercase; letter-spacing:1px; border-bottom:1px solid rgba(255,255,255,0.08); white-space:nowrap; width:52px;">Year</th>
                    <th style="padding:13px 14px; font-size:0.72rem; font-weight:800; color:#94a3b8; text-transform:uppercase; letter-spacing:1px; border-bottom:1px solid rgba(255,255,255,0.08); white-space:nowrap; width:80px;">Genre</th>
                    <th style="padding:13px 14px; font-size:0.72rem; font-weight:800; color:#94a3b8; text-transform:uppercase; letter-spacing:1px; border-bottom:1px solid rgba(255,255,255,0.08); white-space:nowrap; width:80px;">Lang</th>
                    <th style="padding:13px 14px; font-size:0.72rem; font-weight:800; color:#94a3b8; text-transform:uppercase; letter-spacing:1px; border-bottom:1px solid rgba(255,255,255,0.08); white-space:nowrap; width:65px;">Rating</th>
                    <th style="padding:13px 14px; font-size:0.72rem; font-weight:800; color:#94a3b8; text-transform:uppercase; letter-spacing:1px; border-bottom:1px solid rgba(255,255,255,0.08); white-space:nowrap; width:120px; text-align:center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($music as $m)
                <tr style="transition:background 0.2s;" onmouseover="this.style.background='rgba(99,102,241,0.07)'" onmouseout="this.style.background='transparent'">
                    <td style="padding:10px 14px; border-bottom:1px solid rgba(255,255,255,0.05); vertical-align:middle;">
                        <img src="{{ $m->getCoverUrl() }}" alt="{{ $m->title }}"
                             style="width:42px; height:42px; object-fit:cover; border-radius:8px; border:1px solid rgba(255,255,255,0.1); display:block;">
                    </td>
                    <td style="padding:10px 14px; border-bottom:1px solid rgba(255,255,255,0.05); vertical-align:middle;">
                        <div style="font-weight:700; color:#fff; font-size:0.88rem; max-width:160px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ $m->title }}</div>
                    </td>
                    <td style="padding:10px 14px; border-bottom:1px solid rgba(255,255,255,0.05); vertical-align:middle;">
                        <div style="color:#a5b4fc; font-size:0.85rem; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; max-width:130px;">{{ $m->artist }}</div>
                    </td>
                    <td style="padding:10px 14px; border-bottom:1px solid rgba(255,255,255,0.05); vertical-align:middle;">
                        <div style="color:#cbd5e1; font-size:0.85rem; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; max-width:120px;">{{ $m->album ?: 'Single' }}</div>
                    </td>
                    <td style="padding:10px 14px; border-bottom:1px solid rgba(255,255,255,0.05); vertical-align:middle; font-size:0.85rem; color:#94a3b8; white-space:nowrap;">{{ $m->year }}</td>
                    <td style="padding:10px 14px; border-bottom:1px solid rgba(255,255,255,0.05); vertical-align:middle; font-size:0.82rem; color:#94a3b8; white-space:nowrap;">{{ $m->genre }}</td>
                    <td style="padding:10px 14px; border-bottom:1px solid rgba(255,255,255,0.05); vertical-align:middle;">
                        <span style="display:inline-block; padding:3px 8px; border-radius:5px; font-size:0.68rem; font-weight:800; text-transform:uppercase; background:rgba(99,102,241,0.2); color:#a5b4fc; border:1px solid rgba(99,102,241,0.35); white-space:nowrap;">{{ $m->language }}</span>
                    </td>
                    <td style="padding:10px 14px; border-bottom:1px solid rgba(255,255,255,0.05); vertical-align:middle; white-space:nowrap;">
                        <span style="color:#f59e0b; font-weight:700; font-size:0.85rem;">★ {{ number_format($m->rating, 1) }}</span>
                    </td>
                    <td style="padding:10px 14px; border-bottom:1px solid rgba(255,255,255,0.05); vertical-align:middle;">
                        <div style="display:flex; gap:6px; align-items:center; justify-content:center; flex-wrap:nowrap;">
                            <a href="{{ route('admin.music.edit', $m->id) }}"
                               style="display:inline-block; padding:5px 12px; border-radius:7px; font-size:0.78rem; font-weight:700; border:1px solid rgba(255,255,255,0.15); color:#f1f5f9; background:transparent; text-decoration:none; white-space:nowrap;">Edit</a>
                            <form method="POST" action="{{ route('admin.music.destroy', $m->id) }}"
                                  onsubmit="return confirm('Delete track: {{ addslashes($m->title) }}?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        style="display:inline-block; padding:5px 12px; border-radius:7px; font-size:0.78rem; font-weight:700; border:none; color:#fff; background:#ef4444; cursor:pointer; white-space:nowrap;">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" style="text-align:center; color:#94a3b8; padding:48px; font-size:0.92rem;">
                        No music tracks found.
                        <a href="{{ route('admin.music.create') }}" style="color:#818cf8; font-weight:700;">Add New Track</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="padding:18px 20px;">
        {{ $music->links() }}
    </div>
</div>
@endsection
