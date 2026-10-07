@extends('layouts.app')
@section('title', 'Login - SOUND Entertainment')

@section('content')
<div style="min-height:80vh; display:flex; align-items:center; justify-content:center; padding:40px 20px">
    <div style="width:100%; max-width:420px">
        <div style="text-align:center; margin-bottom:32px">
            <div style="font-size:2.5rem; margin-bottom:10px">🎵</div>
            <h1 style="font-size:1.8rem; font-weight:900; color:#fff; margin-bottom:6px">Admin Login</h1>
            <p style="color:var(--text-muted)">Secure access to SOUND Admin Panel</p>
        </div>

        <div style="background:var(--bg-card); border:1px solid var(--border); border-radius:var(--radius-lg); padding:32px">
            @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $e) {{ $e }}<br> @endforeach
            </div>
            @endif

            @if(session('success'))
            <div class="alert" style="background:rgba(52,211,153,0.15); border:1px solid #34d399; color:#34d399; padding:12px 16px; border-radius:8px; margin-bottom:16px; font-size:0.9rem;">
                ✅ {{ session('success') }}
            </div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        placeholder="your@email.com" value="{{ old('email') }}" required>
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div style="position:relative;">
                        <input type="password" id="password" name="password" class="form-control"
                            placeholder="Enter your password" required>
                        <button type="button" onclick="const p=document.getElementById('password'); p.type=p.type==='password'?'text':'password';" style="position:absolute; right:12px; top:50%; transform:translateY(-50%); background:none; border:none; color:var(--text-muted); cursor:pointer; font-size:1.2rem;">👁</button>
                    </div>
                </div>

                <div style="display:flex; align-items:center; gap:8px; margin-bottom:20px">
                    <input type="checkbox" id="remember" name="remember" style="accent-color:var(--primary)">
                    <label for="remember" style="font-size:0.85rem; color:var(--text-muted); cursor:pointer; margin:0">Remember me</label>
                </div>

                <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center; padding:12px">
                    Sign In →
                </button>
            </form>


    </div>
</div>
@endsection
