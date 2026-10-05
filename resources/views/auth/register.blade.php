@extends('layouts.app')
@section('title', 'Register - SOUND Entertainment')

@section('content')
<div style="min-height:80vh; display:flex; align-items:center; justify-content:center; padding:40px 20px">
    <div style="width:100%; max-width:480px">
        <div style="text-align:center; margin-bottom:28px">
            <div style="font-size:2.5rem; margin-bottom:10px">🎵</div>
            <h1 style="font-size:1.8rem; font-weight:900; color:#fff; margin-bottom:6px">Create Account</h1>
            <p style="color:var(--text-muted)">Join SOUND Entertainment for free</p>
        </div>

        <div style="background:var(--bg-card); border:1px solid var(--border); border-radius:var(--radius-lg); padding:32px">
            @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $e) {{ $e }}<br> @endforeach
            </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="user_id">User ID <span style="color:var(--danger)">*</span></label>
                    <input type="text" id="user_id" name="user_id"
                        class="form-control @error('user_id') is-invalid @enderror"
                        placeholder="Choose a unique username (e.g. john_doe)" value="{{ old('user_id') }}" required>
                    @error('user_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <small style="color:var(--text-muted); font-size:0.75rem">This must be unique and cannot be changed later</small>
                </div>

                <div class="form-group">
                    <label for="name">Full Name <span style="color:var(--danger)">*</span></label>
                    <input type="text" id="name" name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        placeholder="Your full name" value="{{ old('name') }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label for="email">Email Address <span style="color:var(--danger)">*</span></label>
                    <input type="email" id="email" name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="your@email.com" value="{{ old('email') }}" required>
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number <span style="color:var(--danger)">*</span></label>
                    <input type="tel" id="phone" name="phone"
                        class="form-control @error('phone') is-invalid @enderror"
                        placeholder="10-digit phone number" value="{{ old('phone') }}" required>
                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label for="address">Address <span style="color:var(--danger)">*</span></label>
                    <textarea id="address" name="address" rows="2"
                        class="form-control @error('address') is-invalid @enderror"
                        placeholder="Your full address" required>{{ old('address') }}</textarea>
                    @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label for="password">Password <span style="color:var(--danger)">*</span></label>
                    <input type="password" id="password" name="password" class="form-control"
                        placeholder="Minimum 6 characters" required>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password <span style="color:var(--danger)">*</span></label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="form-control" placeholder="Re-enter your password" required>
                </div>

                <p style="font-size:0.75rem; color:var(--text-muted); margin-bottom:18px">
                    <span style="color:var(--danger)">*</span> Name, Address, Phone Numbers, Email IDs are mandatory. Proper validations are applied on all fields.
                </p>

                <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center; padding:12px">
                    Create Account →
                </button>
            </form>

            <div style="text-align:center; margin-top:20px; padding-top:20px; border-top:1px solid var(--border)">
                <p style="font-size:0.88rem; color:var(--text-muted)">
                    Already have an account?
                    <a href="{{ route('login') }}" style="color:var(--primary-lt); font-weight:600">Login here</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
