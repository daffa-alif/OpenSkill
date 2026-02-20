<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile — {{ config('app.name') }}</title>
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
            --radius: 16px;
            --nav-h: 64px;
        }

        html, body { min-height: 100%; font-family: 'Sora', sans-serif; background: var(--surface); color: var(--ink); -webkit-font-smoothing: antialiased; }

        /* ══ Navbar ══ */
        .navbar {
            position: sticky; top: 0; z-index: 100;
            height: var(--nav-h);
            background: rgba(245,244,240,0.85);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 40px;
        }

        .nav-brand {
            display: flex; align-items: center; gap: 10px; text-decoration: none;
        }

        .brand-icon {
            width: 32px; height: 32px;
            background: var(--accent); border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
        }

        .brand-icon svg { width: 17px; height: 17px; fill: none; stroke: white; stroke-width: 2; }
        .brand-name { font-size: 1rem; font-weight: 700; color: var(--ink); letter-spacing: -0.02em; }

        .nav-actions { display: flex; align-items: center; gap: 12px; }

        .nav-btn {
            padding: 8px 18px;
            border-radius: 100px;
            font-family: 'Sora', sans-serif;
            font-size: 0.82rem; font-weight: 600;
            cursor: pointer; text-decoration: none;
            transition: all 0.2s;
        }

        .nav-btn-ghost {
            background: none; border: 1.5px solid var(--border);
            color: var(--ink-soft);
        }

        .nav-btn-ghost:hover { border-color: var(--accent); color: var(--accent); }

        .nav-btn-red {
            background: var(--accent); border: none;
            color: white;
        }

        .nav-btn-red:hover { background: var(--accent-dark); }

        /* ══ Main Layout ══ */
        .main { max-width: 1100px; margin: 0 auto; padding: 48px 24px; }

        /* Success / info toast */
        .toast {
            background: #f0fdf4; border: 1px solid #bbf7d0;
            border-radius: var(--radius); padding: 14px 18px;
            margin-bottom: 28px;
            display: flex; align-items: center; gap: 10px;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }

        .toast svg { width: 18px; height: 18px; color: #16a34a; flex-shrink: 0; }
        .toast p { font-size: 0.88rem; color: #166534; font-weight: 500; }

        /* ══ Profile Card ══ */
        .profile-header {
            background: var(--card);
            border-radius: var(--radius);
            border: 1px solid var(--border);
            padding: 40px;
            margin-bottom: 24px;
            display: flex; align-items: center; gap: 32px;
            position: relative; overflow: hidden;
        }

        .profile-header::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0; height: 4px;
            background: linear-gradient(90deg, var(--accent) 0%, #f97316 50%, var(--accent) 100%);
        }

        .avatar-wrap { position: relative; flex-shrink: 0; }

        .avatar {
            width: 96px; height: 96px;
            border-radius: 50%; object-fit: cover;
            border: 3px solid white;
            box-shadow: 0 0 0 2px var(--border), 0 4px 20px rgba(0,0,0,0.1);
        }

        .avatar-placeholder {
            width: 96px; height: 96px; border-radius: 50%;
            background: linear-gradient(135deg, #e84545 0%, #c53030 100%);
            display: flex; align-items: center; justify-content: center;
            border: 3px solid white;
            box-shadow: 0 0 0 2px var(--border), 0 4px 20px rgba(232,69,69,0.2);
            font-size: 2rem; font-weight: 700; color: white;
        }

        .online-dot {
            position: absolute; bottom: 4px; right: 4px;
            width: 16px; height: 16px; border-radius: 50%;
            background: #22c55e; border: 2px solid white;
        }

        .profile-info { flex: 1; }

        .profile-name {
            font-size: 1.7rem; font-weight: 700;
            letter-spacing: -0.04em; color: var(--ink);
            margin-bottom: 4px;
        }

        .profile-email {
            font-family: 'DM Mono', monospace;
            font-size: 0.82rem; color: var(--muted); margin-bottom: 12px;
        }

        .profile-desc { font-size: 0.9rem; color: var(--ink-soft); line-height: 1.6; max-width: 500px; }

        .profile-meta {
            display: flex; gap: 20px; margin-top: 16px;
        }

        .meta-pill {
            display: inline-flex; align-items: center; gap: 6px;
            background: var(--surface); border: 1px solid var(--border);
            padding: 5px 12px; border-radius: 100px;
            font-size: 0.75rem; color: var(--muted);
            font-family: 'DM Mono', monospace;
        }

        .meta-pill svg { width: 12px; height: 12px; }

        .profile-actions { display: flex; flex-direction: column; gap: 10px; flex-shrink: 0; }

        .btn-edit {
            padding: 10px 22px; border-radius: 100px;
            font-family: 'Sora', sans-serif; font-size: 0.85rem; font-weight: 600;
            cursor: pointer; text-decoration: none; display: flex; align-items: center; gap: 6px;
            background: var(--ink); color: white; border: none;
            transition: all 0.2s;
        }

        .btn-edit:hover { background: #1a1a28; transform: translateY(-1px); }
        .btn-edit svg { width: 14px; height: 14px; }

        /* ══ Content Grid ══ */
        .grid { display: grid; grid-template-columns: 2fr 1fr; gap: 24px; }

        /* ══ Edit Form Card ══ */
        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
        }

        .card-header {
            padding: 24px 28px;
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
        }

        .card-title { font-size: 1rem; font-weight: 700; letter-spacing: -0.02em; }
        .card-subtitle { font-size: 0.8rem; color: var(--muted); margin-top: 2px; }

        .card-body { padding: 28px; }

        /* Form */
        .field { margin-bottom: 20px; }
        .field label { display: block; font-size: 0.8rem; font-weight: 600; color: var(--ink-soft); margin-bottom: 7px; letter-spacing: 0.01em; }

        .input-wrap { position: relative; }
        .input-wrap .icon {
            position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
            width: 15px; height: 15px; color: var(--muted); pointer-events: none;
        }

        .input-wrap input,
        .input-wrap textarea {
            width: 100%; padding: 11px 14px 11px 40px;
            border: 1.5px solid var(--border); border-radius: 12px;
            background: var(--input-bg); font-family: 'Sora', sans-serif;
            font-size: 0.88rem; color: var(--ink); outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            resize: none;
        }

        .input-wrap textarea { padding-top: 12px; min-height: 100px; }

        .input-wrap input:focus,
        .input-wrap textarea:focus {
            border-color: var(--accent); box-shadow: 0 0 0 3px rgba(232,69,69,0.1);
        }

        .char-count { font-size: 0.72rem; color: var(--muted); text-align: right; margin-top: 4px; font-family: 'DM Mono', monospace; }

        /* Avatar section in form */
        .photo-section {
            display: flex; align-items: center; gap: 16px; padding: 16px;
            background: var(--input-bg); border: 1.5px solid var(--border);
            border-radius: 12px; margin-bottom: 20px; cursor: pointer;
            transition: border-color 0.2s;
        }
        .photo-section:hover { border-color: var(--accent); }

        .photo-thumb {
            width: 52px; height: 52px; border-radius: 50%; overflow: hidden;
            background: linear-gradient(135deg, #e84545, #c53030);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0; font-size: 1.2rem; font-weight: 700; color: white;
        }

        .photo-thumb img { width: 100%; height: 100%; object-fit: cover; }

        .photo-info h4 { font-size: 0.85rem; font-weight: 600; margin-bottom: 2px; }
        .photo-info p { font-size: 0.75rem; color: var(--muted); }

        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

        .btn-save {
            width: 100%; padding: 13px;
            background: var(--accent); color: white; border: none;
            border-radius: 12px; font-family: 'Sora', sans-serif;
            font-size: 0.9rem; font-weight: 700; cursor: pointer;
            transition: all 0.2s; box-shadow: 0 4px 14px rgba(232,69,69,0.3);
        }
        .btn-save:hover { background: var(--accent-dark); transform: translateY(-1px); }

        /* ══ Side Card ══ */
        .stat-list { padding: 0 28px 28px; }
        .stat-item {
            display: flex; align-items: center; justify-content: space-between;
            padding: 14px 0; border-bottom: 1px solid var(--border);
        }
        .stat-item:last-child { border-bottom: none; }
        .stat-key { font-size: 0.82rem; color: var(--muted); display: flex; align-items: center; gap: 8px; }
        .stat-key svg { width: 14px; height: 14px; }
        .stat-val { font-size: 0.85rem; font-weight: 600; color: var(--ink); font-family: 'DM Mono', monospace; }

        .danger-zone { margin-top: 24px; }
        .danger-header { padding: 20px 28px; border-bottom: 1px solid #fecaca; }
        .danger-title { font-size: 0.9rem; font-weight: 700; color: #c53030; }
        .danger-sub { font-size: 0.75rem; color: var(--muted); margin-top: 2px; }
        .danger-body { padding: 20px 28px; }
        .btn-danger {
            width: 100%; padding: 11px;
            background: none; border: 1.5px solid #fecaca;
            color: #c53030; border-radius: 12px;
            font-family: 'Sora', sans-serif; font-size: 0.85rem; font-weight: 600;
            cursor: pointer; transition: all 0.2s;
        }
        .btn-danger:hover { background: #fff5f5; border-color: var(--accent); }

        @media (max-width: 900px) {
            .grid { grid-template-columns: 1fr; }
            .profile-header { flex-direction: column; text-align: center; }
            .profile-meta { justify-content: center; }
            .profile-actions { align-items: center; }
            .navbar { padding: 0 20px; }
            .main { padding: 28px 16px; }
        }

        @media (max-width: 560px) {
            .form-row { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
    <a href="{{ route('profile.welcome') }}" class="nav-brand">
        <div class="brand-icon">
            <svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
        </div>
        <span class="brand-name">{{ config('app.name') }}</span>
    </a>
    <div class="nav-actions">
        <a href="{{ route('profile.welcome') }}" class="nav-btn nav-btn-ghost">Profile</a>
        <form method="POST" action="{{ route('logout') }}" style="display:inline">
            @csrf
            <button type="submit" class="nav-btn nav-btn-red">Sign out</button>
        </form>
    </div>
</nav>

<!-- Main -->
<main class="main">

    @if (session('success'))
        <div class="toast">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
            </svg>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <!-- Profile Header -->
    <div class="profile-header">
        <div class="avatar-wrap">
            @if (Auth::user()->profile_picture)
                <img class="avatar" src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="{{ Auth::user()->name }}">
            @else
                <div class="avatar-placeholder">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            @endif
            <span class="online-dot"></span>
        </div>

        <div class="profile-info">
            <h1 class="profile-name">{{ Auth::user()->name }}</h1>
            <p class="profile-email">{{ Auth::user()->email }}</p>
            @if (Auth::user()->description)
                <p class="profile-desc">{{ Auth::user()->description }}</p>
            @else
                <p class="profile-desc" style="color:var(--muted);font-style:italic;">No description yet — add one below!</p>
            @endif
            <div class="profile-meta">
                <span class="meta-pill">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    Joined {{ Auth::user()->created_at->format('M Y') }}
                </span>
                <span class="meta-pill">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07"/><path d="M14.05 2.23a4 4 0 0 0-5.17 5.17"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                    Active now
                </span>
            </div>
        </div>

        <div class="profile-actions">
            <button class="btn-edit" onclick="document.getElementById('edit-form').scrollIntoView({behavior:'smooth'})">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                </svg>
                Edit Profile
            </button>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="grid">

        <!-- Edit Form -->
        <div class="card" id="edit-form">
            <div class="card-header">
                <div>
                    <div class="card-title">Edit Profile</div>
                    <div class="card-subtitle">Update your personal information</div>
                </div>
            </div>
            <div class="card-body">

                @if ($errors->any())
                    <div style="background:#fff5f5;border:1px solid #fecaca;border-radius:12px;padding:14px 16px;margin-bottom:20px;">
                        @foreach ($errors->all() as $error)
                            <p style="font-size:0.83rem;color:#c53030;margin-bottom:2px;">• {{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" id="profileForm">
                    @csrf
                    @method('PUT')

                    <!-- Photo upload section -->
                    <label for="profile_picture" class="photo-section">
                        <div class="photo-thumb">
                            @if (Auth::user()->profile_picture)
                                <img id="photo-preview" src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Photo">
                            @else
                                <span id="photo-initial">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                <img id="photo-preview" src="" style="display:none;" alt="Preview">
                            @endif
                        </div>
                        <div class="photo-info">
                            <h4>Change profile photo</h4>
                            <p>JPG, PNG, GIF, SVG up to 2MB</p>
                        </div>
                        <input type="file" id="profile_picture" name="profile_picture" accept="image/*" style="display:none" onchange="previewPhoto(this)">
                    </label>
                    <input type="hidden" id="profile_picture_base64" name="profile_picture_base64">

                    <div class="form-row">
                        <div class="field">
                            <label for="name">Full name</label>
                            <div class="input-wrap">
                                <input type="text" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                                <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            </div>
                        </div>

                        <div class="field">
                            <label for="email">Email address</label>
                            <div class="input-wrap">
                                <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                                <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            </div>
                        </div>
                    </div>

                    <div class="field">
                        <label for="description">Bio / Description</label>
                        <div class="input-wrap">
                            <textarea
                                id="description"
                                name="description"
                                placeholder="Tell others a bit about yourself..."
                                maxlength="500"
                                oninput="updateChar(this)"
                            >{{ old('description', Auth::user()->description) }}</textarea>
                            <svg class="icon" style="top:16px;transform:none;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
                        </div>
                        <p class="char-count"><span id="char-count">{{ strlen(old('description', Auth::user()->description ?? '')) }}</span>/500</p>
                    </div>

                    <button type="submit" class="btn-save">Save Changes</button>
                </form>
            </div>
        </div>

        <!-- Sidebar -->
        <div>
            <!-- Account info -->
            <div class="card" style="margin-bottom:24px;">
                <div class="card-header">
                    <div>
                        <div class="card-title">Account Info</div>
                        <div class="card-subtitle">Your account details</div>
                    </div>
                </div>
                <div class="stat-list">
                    <div class="stat-item">
                        <span class="stat-key">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            Member since
                        </span>
                        <span class="stat-val">{{ Auth::user()->created_at->format('d/m/y') }}</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-key">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            Last updated
                        </span>
                        <span class="stat-val">{{ Auth::user()->updated_at->format('d/m/y') }}</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-key">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            Account ID
                        </span>
                        <span class="stat-val">#{{ str_pad(Auth::user()->id, 5, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-key">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                            Status
                        </span>
                        <span class="stat-val" style="color:#22c55e;">● Active</span>
                    </div>
                </div>
            </div>

            <!-- Danger Zone -->
            <div class="card danger-zone">
                <div class="danger-header">
                    <div class="danger-title">⚠ Danger Zone</div>
                    <div class="danger-sub">These actions are irreversible</div>
                </div>
                <div class="danger-body">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn-danger">Sign out of all devices</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</main>

<script>
    function previewPhoto(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                const preview = document.getElementById('photo-preview');
                const initial = document.getElementById('photo-initial');
                preview.src = e.target.result;
                preview.style.display = 'block';
                if (initial) initial.style.display = 'none';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function updateChar(el) {
        document.getElementById('char-count').textContent = el.value.length;
    }
</script>
</body>
</html>