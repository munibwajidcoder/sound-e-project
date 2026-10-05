@extends('layouts.admin')
@section('title', 'Manage Users')
@section('page-title', 'Manage Users & Logins')
@section('top-action')
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">+ Add User</a>
@endsection

@section('content')
<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr><th>User ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Address</th><th>Role</th><th>Joined</th><th>Actions</th></tr>
            </thead>
            <tbody>
                @forelse($users as $u)
                <tr>
                    <td><code style="color:var(--primary-lt)">{{ $u->user_id }}</code></td>
                    <td style="font-weight:600; color:#fff">{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->phone }}</td>
                    <td style="max-width:160px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap">{{ $u->address }}</td>
                    <td><span class="badge {{ $u->role === 'admin' ? 'badge-regional' : 'badge-english' }}">{{ $u->role }}</span></td>
                    <td>{{ $u->created_at->format('M d, Y') }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $u->id) }}" class="btn btn-outline btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.users.destroy', $u->id) }}" style="display:inline"
                            onsubmit="return confirm('Delete user {{ $u->name }}?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" style="text-align:center; color:var(--text-muted); padding:32px">No users yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($users->hasPages())
    <div style="padding:20px 0 0; display:flex; gap:8px; justify-content:center">
        @if(!$users->onFirstPage())<a href="{{ $users->previousPageUrl() }}" class="btn btn-outline btn-sm">‹ Prev</a>@endif
        <span style="padding:5px 12px; font-size:0.82rem; color:var(--text-muted)">Page {{ $users->currentPage() }} of {{ $users->lastPage() }}</span>
        @if($users->hasMorePages())<a href="{{ $users->nextPageUrl() }}" class="btn btn-outline btn-sm">Next ›</a>@endif
    </div>
    @endif
</div>
@endsection
