@extends('layouts.admin')
@section('title', 'Add User')
@section('page-title', 'Create New User Account')

@section('content')
<div class="card" style="max-width:700px">
    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf

        <div class="form-group">
            <label class="form-label">User ID (Unique Code) *</label>
            <input type="text" name="user_id" class="form-control" value="{{ old('user_id', 'USR-' . strtoupper(Str::random(5))) }}" required>
            @error('user_id')<span style="color:#ef4444; font-size:12px;">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Full Name *</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="John Doe" required>
            @error('name')<span style="color:#ef4444; font-size:12px;">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Email Address *</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="user@example.com" required>
            @error('email')<span style="color:#ef4444; font-size:12px;">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Phone Number *</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="03001234567" required>
            @error('phone')<span style="color:#ef4444; font-size:12px;">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Address *</label>
            <textarea name="address" class="form-control" rows="2" placeholder="Full mailing address" required>{{ old('address') }}</textarea>
            @error('address')<span style="color:#ef4444; font-size:12px;">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Role *</label>
            <select name="role" class="form-control" required>
                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User (Standard)</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin (Full Access)</option>
            </select>
            @error('role')<span style="color:#ef4444; font-size:12px;">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Password *</label>
            <input type="password" name="password" class="form-control" placeholder="Minimum 6 characters" required>
            @error('password')<span style="color:#ef4444; font-size:12px;">{{ $message }}</span>@enderror
        </div>

        <div style="display:flex; gap:12px; margin-top:24px;">
            <button type="submit" class="btn btn-primary">Create User</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
