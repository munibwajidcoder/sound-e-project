@extends('layouts.app')
@section('title', 'Login - SOUND Entertainment')

@section('content')
<div style="min-height:80vh; display:flex; align-items:center; justify-content:center; padding:40px 20px">
    <div style="width:100%; max-width:420px">
        <div style="text-align:center; margin-bottom:32px">
            <div style="font-size:2.5rem; margin-bottom:10px">🎵</div>
            <h1 style="font-size:1.8rem; font-weight:900; color:#fff; margin-bottom:6px">Welcome Back</h1>
            <p style="color:var(--text-muted)">Login to your SOUND account</p>
        </div>

        <div style="background:var(--bg-card); border:1px solid var(--border); border-radius:var(--radius-lg); padding:32px">
            @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $e) {{ $e }}<br> @endforeach
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        placeholder="your@email.com" value="{{ old('email') }}" required>
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control"
                        placeholder="Enter your password" required>
                </div>

                <div style="display:flex; align-items:center; gap:8px; margin-bottom:20px">
                    <input type="checkbox" id="remember" name="remember" style="accent-color:var(--primary)">
                    <label for="remember" style="font-size:0.85rem; color:var(--text-muted); cursor:pointer; margin:0">Remember me</label>
                </div>

                <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center; padding:12px">
                    Sign In →
                </button>
            </form>

            <div style="text-align:center; margin-top:20px; padding-top:20px; border-top:1px solid var(--border)">
                <p style="font-size:0.88rem; color:var(--text-muted)">
                    Don't have an account?
                    <a href="{{ route('register') }}" style="color:var(--primary-lt); font-weight:600">Register here</a>
                </p>
            </div>
        </div>

        <div style="margin-top:20px; background:var(--bg-card2); border:1px solid var(--border); border-radius:var(--radius); padding:16px; font-size:0.82rem; color:var(--text-muted)">
            <strong style="color:var(--accent)">Demo Credentials:</strong><br>
            Admin → admin@sound.com / admin123<br>
            User → user@sound.com / user123
        </div>
    </div>
</div>
@endsection
