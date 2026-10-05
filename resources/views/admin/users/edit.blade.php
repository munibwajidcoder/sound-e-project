@extends('layouts.admin')
@section('title', 'Edit User')
@section('page-title', 'Edit User: ' . $user->name)

@section('content')
<div class="card" style="max-width:700px">
    <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label class="form-label">User ID (Read-only)</label>
            <input type="text" class="form-control" value="{{ $user->user_id }}" disabled style="opacity:0.6;">
        </div>

        <div class="form-group">
            <label class="form-label">Full Name *</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            @error('name')<span style="color:#ef4444; font-size:12px;">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Email Address *</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            @error('email')<span style="color:#ef4444; font-size:12px;">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Phone Number *</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}" required>
            @error('phone')<span style="color:#ef4444; font-size:12px;">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Address *</label>
            <textarea name="address" class="form-control" rows="2" required>{{ old('address', $user->address) }}</textarea>
            @error('address')<span style="color:#ef4444; font-size:12px;">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Role *</label>
            <select name="role" class="form-control" required>
                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User (Standard)</option>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin (Full Access)</option>
            </select>
            @error('role')<span style="color:#ef4444; font-size:12px;">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">New Password (Leave blank to keep current)</label>
            <input type="password" name="password" class="form-control" placeholder="••••••••">
            @error('password')<span style="color:#ef4444; font-size:12px;">{{ $message }}</span>@enderror
        </div>

        <div style="display:flex; gap:12px; margin-top:24px;">
            <button type="submit" class="btn btn-primary">Update User</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
