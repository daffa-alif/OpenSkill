<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In — {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&family=DM+Mono:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --ink: #0d0d12;
            --ink-soft: #3a3a4a;
            --surface: #f5f4f0;
            --card: #ffffff;
            --accent: #e84545;
            --accent-dark: #c53030;
            --muted: #8a8a9a;
            --border: #e2e1dd;
            --input-bg: #fafaf8;
            --radius: 14px;
        }

        html, body {
            height: 100%;
            font-family: 'Sora', sans-serif;
            background: var(--surface);
            color: var(--ink);
            -webkit-font-smoothing: antialiased;
        }

        .layout {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        /* ── Left Panel ── */
        .panel-left {
            background: var(--ink);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 48px 56px;
            position: relative;
            overflow: hidden;
        }

        .panel-left::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 60% 50% at 20% 80%, rgba(232,69,69,0.18) 0%, transparent 70%),
                radial-gradient(ellipse 40% 40% at 80% 20%, rgba(232,69,69,0.08) 0%, transparent 60%);
        }

        .panel-left::after {
            content: '';
            position: absolute;
            bottom: -80px; right: -80px;
            width: 320px; height: 320px;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,0.06);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            position: relative;
            z-index: 1;
            text-decoration: none;
        }

        .brand-icon {
            width: 36px; height: 36px;
            background: var(--accent);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
        }

        .brand-icon svg { width: 20px; height: 20px; fill: white; }

        .brand-name {
            font-size: 1.1rem;
            font-weight: 700;
            color: white;
            letter-spacing: -0.02em;
        }

        .panel-hero {
            position: relative;
            z-index: 1;
        }

        .hero-tag {
            display: inline-block;
            background: rgba(232,69,69,0.15);
            border: 1px solid rgba(232,69,69,0.3);
            color: #ff8a8a;
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 5px 12px;
            border-radius: 100px;
            margin-bottom: 24px;
            font-family: 'DM Mono', monospace;
        }

        .hero-title {
            font-size: clamp(2.2rem, 3.5vw, 3rem);
            font-weight: 700;
            color: white;
            line-height: 1.1;
            letter-spacing: -0.04em;
            margin-bottom: 20px;
        }

        .hero-title em {
            font-style: normal;
            color: var(--accent);
        }

        .hero-desc {
            color: rgba(255,255,255,0.45);
            font-size: 0.95rem;
            line-height: 1.7;
            max-width: 380px;
        }

        .panel-footer {
            color: rgba(255,255,255,0.25);
            font-size: 0.75rem;
            position: relative;
            z-index: 1;
            font-family: 'DM Mono', monospace;
        }

        /* ── Right Panel ── */
        .panel-right {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 48px;
        }

        .form-container {
            width: 100%;
            max-width: 420px;
            animation: fadeUp 0.5s ease both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .form-header {
            margin-bottom: 40px;
        }

        .form-title {
            font-size: 1.9rem;
            font-weight: 700;
            letter-spacing: -0.04em;
            color: var(--ink);
            margin-bottom: 8px;
        }

        .form-sub {
            color: var(--muted);
            font-size: 0.875rem;
        }

        .form-sub a {
            color: var(--accent);
            font-weight: 600;
            text-decoration: none;
        }

        .form-sub a:hover { text-decoration: underline; }

        /* Error Alert */
        .alert-error {
            background: #fff5f5;
            border: 1px solid #fecaca;
            border-radius: var(--radius);
            padding: 12px 16px;
            margin-bottom: 24px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .alert-error svg { width: 18px; height: 18px; flex-shrink: 0; color: var(--accent); margin-top: 1px; }
        .alert-error p { font-size: 0.85rem; color: #c53030; line-height: 1.5; }

        /* Form Fields */
        .field { margin-bottom: 20px; }

        .field label {
            display: block;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--ink-soft);
            margin-bottom: 7px;
            letter-spacing: 0.01em;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap svg {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px; height: 16px;
            color: var(--muted);
            pointer-events: none;
            transition: color 0.2s;
        }

        .input-wrap input {
            width: 100%;
            padding: 13px 14px 13px 42px;
            border: 1.5px solid var(--border);
            border-radius: var(--radius);
            background: var(--input-bg);
            font-family: 'Sora', sans-serif;
            font-size: 0.92rem;
            color: var(--ink);
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .input-wrap input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(232,69,69,0.1);
        }

        .input-wrap input:focus + svg,
        .input-wrap input:focus ~ svg {
            color: var(--accent);
        }

        .input-wrap .eye-btn {
            position: absolute;
            right: 14px; top: 50%;
            transform: translateY(-50%);
            background: none; border: none;
            cursor: pointer; padding: 0;
            color: var(--muted);
            display: flex;
        }

        .field-error {
            font-size: 0.78rem;
            color: var(--accent);
            margin-top: 5px;
        }

        /* Remember / Forgot row */
        .row-util {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            font-size: 0.85rem;
            color: var(--ink-soft);
        }

        .remember input[type="checkbox"] {
            width: 16px; height: 16px;
            accent-color: var(--accent);
            cursor: pointer;
        }

        .forgot-link {
            font-size: 0.82rem;
            color: var(--accent);
            font-weight: 600;
            text-decoration: none;
        }

        .forgot-link:hover { text-decoration: underline; }

        /* Submit Button */
        .btn-submit {
            width: 100%;
            padding: 14px;
            background: var(--accent);
            color: white;
            border: none;
            border-radius: var(--radius);
            font-family: 'Sora', sans-serif;
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            letter-spacing: -0.01em;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
            box-shadow: 0 4px 16px rgba(232,69,69,0.3);
            position: relative;
            overflow: hidden;
        }

        .btn-submit::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, transparent 60%);
        }

        .btn-submit:hover {
            background: var(--accent-dark);
            transform: translateY(-1px);
            box-shadow: 0 6px 24px rgba(232,69,69,0.4);
        }

        .btn-submit:active { transform: translateY(0); }

        /* Responsive */
        @media (max-width: 768px) {
            .layout { grid-template-columns: 1fr; }
            .panel-left { display: none; }
            .panel-right { padding: 40px 24px; }
        }
    </style>
</head>
<body>
<div class="layout">

    <!-- Left visual panel -->
    <div class="panel-left">
        <a href="/" class="brand">
            <div class="brand-icon">
                <svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
            </div>
            <span class="brand-name">{{ config('app.name') }}</span>
        </a>

        <div class="panel-hero">
            <span class="hero-tag">Welcome back</span>
            <h1 class="hero-title">Pick up right<br>where you <em>left off.</em></h1>
            <p class="hero-desc">
                Your workspace is waiting. Sign in to access your profile, settings, and everything you left behind.
            </p>
        </div>

        <div class="panel-footer">
            &copy; {{ date('Y') }} {{ config('app.name') }} &mdash; All rights reserved
        </div>
    </div>

    <!-- Right form panel -->
    <div class="panel-right">
        <div class="form-container">
            <div class="form-header">
                <h2 class="form-title">Sign in</h2>
                <p class="form-sub">New here? <a href="{{ route('register') }}">Create an account</a></p>
            </div>

            @if ($errors->any())
                <div class="alert-error">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                    <p>{{ $errors->first() }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="field">
                    <label for="email">Email address</label>
                    <div class="input-wrap">
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="you@example.com"
                            autocomplete="email"
                            required
                        >
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>
                        </svg>
                    </div>
                    @error('email') <p class="field-error">{{ $message }}</p> @enderror
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <div class="input-wrap">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="••••••••"
                            autocomplete="current-password"
                            required
                        >
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                        <button type="button" class="eye-btn" onclick="togglePassword()">
                            <svg id="eye-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>
                    @error('password') <p class="field-error">{{ $message }}</p> @enderror
                </div>

                <div class="row-util">
                    <label class="remember">
                        <input type="checkbox" name="remember">
                        Remember me
                    </label>
                    <a href="#" class="forgot-link">Forgot password?</a>
                </div>

                <button type="submit" class="btn-submit">Sign In →</button>
            </form>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const input = document.getElementById('password');
        const icon = document.getElementById('eye-icon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.innerHTML = `<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/>`;
        } else {
            input.type = 'password';
            icon.innerHTML = `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>`;
        }
    }
</script>
</body>
</html>