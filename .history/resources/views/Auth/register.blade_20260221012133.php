<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account — {{ config('app.name') }}</title>
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

        html, body { height: 100%; font-family: 'Sora', sans-serif; background: var(--surface); color: var(--ink); -webkit-font-smoothing: antialiased; }

        .layout { min-height: 100vh; display: grid; grid-template-columns: 1fr 1fr; }

        /* ── Left Panel ── */
        .panel-left {
            background: var(--ink);
            display: flex; flex-direction: column; justify-content: space-between;
            padding: 48px 56px;
            position: relative; overflow: hidden;
        }

        .panel-left::before {
            content: '';
            position: absolute; inset: 0;
            background:
                radial-gradient(ellipse 55% 55% at 10% 90%, rgba(232,69,69,0.2) 0%, transparent 70%),
                radial-gradient(ellipse 35% 35% at 85% 15%, rgba(232,69,69,0.08) 0%, transparent 60%);
        }

        .decorative-grid {
            position: absolute; inset: 0; overflow: hidden; opacity: 0.04;
        }

        .decorative-grid::before {
            content: '';
            position: absolute; inset: -40px;
            background-image: linear-gradient(rgba(255,255,255,0.5) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(255,255,255,0.5) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        .brand {
            display: flex; align-items: center; gap: 10px;
            position: relative; z-index: 1; text-decoration: none;
        }

        .brand-icon {
            width: 36px; height: 36px;
            background: var(--accent); border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
        }

        .brand-icon svg { width: 20px; height: 20px; fill: none; stroke: white; stroke-width: 2; }
        .brand-name { font-size: 1.1rem; font-weight: 700; color: white; letter-spacing: -0.02em; }

        .panel-hero { position: relative; z-index: 1; }

        .hero-tag {
            display: inline-block;
            background: rgba(232,69,69,0.15);
            border: 1px solid rgba(232,69,69,0.3);
            color: #ff8a8a;
            font-size: 0.7rem; font-weight: 600; letter-spacing: 0.12em;
            text-transform: uppercase; padding: 5px 12px;
            border-radius: 100px; margin-bottom: 24px;
            font-family: 'DM Mono', monospace;
        }

        .hero-title {
            font-size: clamp(2rem, 3.2vw, 2.8rem);
            font-weight: 700; color: white;
            line-height: 1.1; letter-spacing: -0.04em; margin-bottom: 20px;
        }

        .hero-title em { font-style: normal; color: var(--accent); }

        .hero-desc { color: rgba(255,255,255,0.45); font-size: 0.9rem; line-height: 1.7; max-width: 360px; }

        .perks { margin-top: 32px; display: flex; flex-direction: column; gap: 12px; }

        .perk {
            display: flex; align-items: center; gap: 10px;
            color: rgba(255,255,255,0.55); font-size: 0.82rem;
        }

        .perk-dot {
            width: 6px; height: 6px; border-radius: 50%;
            background: var(--accent); flex-shrink: 0;
        }

        .panel-footer {
            color: rgba(255,255,255,0.25); font-size: 0.75rem;
            position: relative; z-index: 1; font-family: 'DM Mono', monospace;
        }

        /* ── Right Panel ── */
        .panel-right {
            display: flex; align-items: flex-start; justify-content: center;
            padding: 60px 48px;
            overflow-y: auto;
        }

        .form-container {
            width: 100%; max-width: 420px;
            animation: fadeUp 0.5s ease both;
            padding: 20px 0;
        }

        @keyframes fadeUp { from { opacity: 0; transform: translateY(24px); } to { opacity: 1; transform: translateY(0); } }

        .form-header { margin-bottom: 36px; }

        .form-title { font-size: 1.9rem; font-weight: 700; letter-spacing: -0.04em; color: var(--ink); margin-bottom: 8px; }
        .form-sub { color: var(--muted); font-size: 0.875rem; }
        .form-sub a { color: var(--accent); font-weight: 600; text-decoration: none; }
        .form-sub a:hover { text-decoration: underline; }

        /* Avatar Upload */
        .avatar-upload {
            display: flex; align-items: center; gap: 16px; margin-bottom: 28px;
            padding: 16px; background: var(--input-bg);
            border: 1.5px dashed var(--border); border-radius: var(--radius);
            cursor: pointer; transition: border-color 0.2s;
        }

        .avatar-upload:hover { border-color: var(--accent); }

        .avatar-preview {
            width: 56px; height: 56px; border-radius: 50%;
            background: linear-gradient(135deg, #f0f0ed 0%, #e2e1dd 100%);
            display: flex; align-items: center; justify-content: center;
            overflow: hidden; flex-shrink: 0;
        }

        .avatar-preview img { width: 100%; height: 100%; object-fit: cover; display: none; }
        .avatar-preview svg { width: 24px; height: 24px; color: var(--muted); }

        .avatar-info h4 { font-size: 0.85rem; font-weight: 600; color: var(--ink-soft); margin-bottom: 2px; }
        .avatar-info p { font-size: 0.75rem; color: var(--muted); }

        .avatar-upload input[type="file"] { display: none; }

        /* Alerts */
        .alert-error {
            background: #fff5f5; border: 1px solid #fecaca;
            border-radius: var(--radius); padding: 12px 16px; margin-bottom: 24px;
        }
        .alert-error p { font-size: 0.83rem; color: #c53030; line-height: 1.5; }

        /* Fields */
        .fields-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0 16px; }
        .field { margin-bottom: 18px; }
        .field.full { grid-column: 1 / -1; }

        .field label { display: block; font-size: 0.82rem; font-weight: 600; color: var(--ink-soft); margin-bottom: 7px; letter-spacing: 0.01em; }

        .input-wrap { position: relative; }

        .input-wrap .icon {
            position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
            width: 16px; height: 16px; color: var(--muted); pointer-events: none; transition: color 0.2s;
        }

        .input-wrap input {
            width: 100%; padding: 12px 14px 12px 42px;
            border: 1.5px solid var(--border); border-radius: var(--radius);
            background: var(--input-bg); font-family: 'Sora', sans-serif;
            font-size: 0.9rem; color: var(--ink); outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .input-wrap input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(232,69,69,0.1);
        }

        .eye-btn {
            position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
            background: none; border: none; cursor: pointer; padding: 0; color: var(--muted); display: flex;
        }

        .field-error { font-size: 0.78rem; color: var(--accent); margin-top: 4px; }

        /* Password strength */
        .strength-bar { display: flex; gap: 4px; margin-top: 8px; }
        .strength-seg { height: 3px; flex: 1; border-radius: 2px; background: var(--border); transition: background 0.3s; }
        .strength-label { font-size: 0.73rem; color: var(--muted); margin-top: 4px; font-family: 'DM Mono', monospace; }

        /* Terms */
        .terms {
            display: flex; align-items: flex-start; gap: 10px;
            margin-bottom: 24px; font-size: 0.82rem; color: var(--muted);
        }
        .terms input[type="checkbox"] { width: 16px; height: 16px; accent-color: var(--accent); cursor: pointer; margin-top: 1px; flex-shrink: 0; }
        .terms a { color: var(--accent); font-weight: 600; text-decoration: none; }

        /* Submit */
        .btn-submit {
            width: 100%; padding: 14px;
            background: var(--accent); color: white;
            border: none; border-radius: var(--radius);
            font-family: 'Sora', sans-serif; font-size: 0.95rem; font-weight: 700;
            cursor: pointer; letter-spacing: -0.01em;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
            box-shadow: 0 4px 16px rgba(232,69,69,0.3);
            position: relative; overflow: hidden;
        }
        .btn-submit::after { content: ''; position: absolute; inset: 0; background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, transparent 60%); }
        .btn-submit:hover { background: var(--accent-dark); transform: translateY(-1px); box-shadow: 0 6px 24px rgba(232,69,69,0.4); }
        .btn-submit:active { transform: translateY(0); }

        @media (max-width: 768px) {
            .layout { grid-template-columns: 1fr; }
            .panel-left { display: none; }
            .panel-right { padding: 40px 24px; }
            .fields-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
<div class="layout">

    <!-- Left visual panel -->
    <div class="panel-left">
        <div class="decorative-grid"></div>
        <a href="/" class="brand">
            <div class="brand-icon">
                <svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
            </div>
            <span class="brand-name">{{ config('app.name') }}</span>
        </a>

        <div class="panel-hero">
            <span class="hero-tag">Get started free</span>
            <h1 class="hero-title">Your journey<br>starts <em>today.</em></h1>
            <p class="hero-desc">Join thousands who have already created their space. Set up your profile in under 2 minutes.</p>
            <div class="perks">
                <div class="perk"><span class="perk-dot"></span> Personalized profile with custom photo</div>
                <div class="perk"><span class="perk-dot"></span> Secure and private by default</div>
                <div class="perk"><span class="perk-dot"></span> Update your info anytime, instantly</div>
            </div>
        </div>

        <div class="panel-footer">
            &copy; {{ date('Y') }} {{ config('app.name') }} &mdash; All rights reserved
        </div>
    </div>

    <!-- Right form panel -->
    <div class="panel-right">
        <div class="form-container">
            <div class="form-header">
                <h2 class="form-title">Create account</h2>
                <p class="form-sub">Already have one? <a href="{{ route('login') }}">Sign in instead</a></p>
            </div>

            @if ($errors->any())
                <div class="alert-error">
                    @foreach ($errors->all() as $error)
                        <p>• {{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf

                <!-- Avatar upload -->
                <label class="avatar-upload" for="profile_picture">
                    <div class="avatar-preview">
                        <img id="avatar-img" src="" alt="Preview">
                        <svg id="avatar-placeholder" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                        </svg>
                    </div>
                    <div class="avatar-info">
                        <h4>Upload profile photo</h4>
                        <p>JPG, PNG, GIF up to 2MB &mdash; optional</p>
                    </div>
                    <input type="file" id="profile_picture" name="profile_picture" accept="image/*" onchange="previewAvatar(this)">
                </label>

                <div class="fields-grid">
                    <div class="field full">
                        <label for="name">Full name</label>
                        <div class="input-wrap">
                            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="John Doe" required>
                            <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                            </svg>
                        </div>
                        @error('name') <p class="field-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="field full">
                        <label for="email">Email address</label>
                        <div class="input-wrap">
                            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required>
                            <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>
                            </svg>
                        </div>
                        @error('email') <p class="field-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="field">
                        <label for="password">Password</label>
                        <div class="input-wrap">
                            <input type="password" id="password" name="password" placeholder="Min. 8 chars" required oninput="checkStrength(this.value)">
                            <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                            <button type="button" class="eye-btn" onclick="togglePwd('password','eye1')">
                                <svg id="eye1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                                </svg>
                            </button>
                        </div>
                        <div class="strength-bar">
                            <div class="strength-seg" id="s1"></div>
                            <div class="strength-seg" id="s2"></div>
                            <div class="strength-seg" id="s3"></div>
                            <div class="strength-seg" id="s4"></div>
                        </div>
                        <div class="strength-label" id="slabel">Enter a password</div>
                        @error('password') <p class="field-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="field">
                        <label for="password_confirmation">Confirm password</label>
                        <div class="input-wrap">
                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repeat it" required>
                            <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <button type="button" class="eye-btn" onclick="togglePwd('password_confirmation','eye2')">
                                <svg id="eye2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="terms">
                    <input type="checkbox" id="terms" required>
                    <label for="terms">I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></label>
                </div>

                <button type="submit" class="btn-submit">Create Account →</button>
            </form>
        </div>
    </div>
</div>

<script>
    function previewAvatar(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('avatar-img').src = e.target.result;
                document.getElementById('avatar-img').style.display = 'block';
                document.getElementById('avatar-placeholder').style.display = 'none';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function togglePwd(id, iconId) {
        const input = document.getElementById(id);
        const icon  = document.getElementById(iconId);
        if (input.type === 'password') {
            input.type = 'text';
            icon.innerHTML = `<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/>`;
        } else {
            input.type = 'password';
            icon.innerHTML = `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>`;
        }
    }

    function checkStrength(val) {
        const segs = ['s1','s2','s3','s4'];
        const label = document.getElementById('slabel');
        let score = 0;
        if (val.length >= 8) score++;
        if (/[A-Z]/.test(val)) score++;
        if (/[0-9]/.test(val)) score++;
        if (/[^A-Za-z0-9]/.test(val)) score++;

        const colors = ['#e84545','#f97316','#eab308','#22c55e'];
        const labels = ['Weak','Fair','Good','Strong'];

        segs.forEach((id, i) => {
            document.getElementById(id).style.background = i < score ? colors[score - 1] : 'var(--border)';
        });

        label.textContent = val.length ? labels[score - 1] || 'Too short' : 'Enter a password';
        label.style.color = val.length ? colors[score - 1] : 'var(--muted)';
    }
</script>
</body>
</html>