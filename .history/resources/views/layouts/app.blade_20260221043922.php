<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'OpenSkill') — Platform Webinar &amp; Seminar</title>
  <meta name="description" content="@yield('meta-description', 'Platform webinar dan seminar terbuka tempat para profesional berbagi pengalaman nyata, keterampilan aktual, dan wawasan industri.')">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet" />

  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: { display: ['Syne', 'sans-serif'], body: ['DM Sans', 'sans-serif'], mono: ['DM Mono', 'monospace'] },
          colors: {
            ink:   '#0b0c10',
            panel: '#111318',
            amber: { vivid: '#f59e0b', glow: '#fbbf24', soft: '#fde68a' },
          }
        }
      }
    }
  </script>

  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --amber: #f59e0b;
      --amber-dark: #d97706;
      --ink: #0b0c10;
      --panel: #111318;
      --muted: rgba(255,255,255,0.06);
      --radius-card: 18px;
      --radius-btn: 12px;
    }

    html { scroll-behavior: smooth; }

    body {
      background-color: var(--ink);
      font-family: 'DM Sans', sans-serif;
      overflow-x: hidden;
      color: white;
      min-height: 100vh;
    }

    /* ── Noise texture overlay ── */
    body::before {
      content: '';
      position: fixed; inset: 0;
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.03'/%3E%3C/svg%3E");
      pointer-events: none; z-index: 0; opacity: 0.4;
    }

    /* ════════════════════════════════
       GLOBAL KEYFRAMES
    ════════════════════════════════ */
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(22px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeIn {
      from { opacity: 0; }
      to   { opacity: 1; }
    }
    @keyframes glowPulse {
      0%, 100% { opacity: 0.45; transform: scale(1); }
      50%       { opacity: 0.85; transform: scale(1.07); }
    }
    @keyframes livePulse {
      0%, 100% { opacity: 1; box-shadow: 0 0 0 0 rgba(34,197,94,0.45); }
      50%       { opacity: 0.75; box-shadow: 0 0 0 7px rgba(34,197,94,0); }
    }
    @keyframes amberPulse {
      0%, 100% { opacity: 1; box-shadow: 0 0 0 0 rgba(245,158,11,0.4); }
      50%       { opacity: 0.75; box-shadow: 0 0 0 6px rgba(245,158,11,0); }
    }
    @keyframes floatY {
      0%, 100% { transform: translateY(0); }
      50%       { transform: translateY(-14px); }
    }
    @keyframes ticker {
      0%   { transform: translateX(0); }
      100% { transform: translateX(-50%); }
    }
    @keyframes spinSlow {
      from { transform: rotate(0deg); }
      to   { transform: rotate(360deg); }
    }

    /* ════════════════════════════════
       STAGGER ANIMATIONS
    ════════════════════════════════ */
    .stagger-1 { animation: fadeUp 0.6s 0.05s ease forwards; opacity: 0; }
    .stagger-2 { animation: fadeUp 0.6s 0.15s ease forwards; opacity: 0; }
    .stagger-3 { animation: fadeUp 0.6s 0.25s ease forwards; opacity: 0; }
    .stagger-4 { animation: fadeUp 0.6s 0.35s ease forwards; opacity: 0; }
    .stagger-5 { animation: fadeUp 0.6s 0.45s ease forwards; opacity: 0; }
    .stagger-6 { animation: fadeUp 0.6s 0.55s ease forwards; opacity: 0; }

    /* Scroll-triggered */
    .reveal { opacity: 0; transform: translateY(18px); transition: opacity 0.5s ease, transform 0.5s ease; }
    .reveal.visible { opacity: 1; transform: translateY(0); }

    /* ════════════════════════════════
       SHARED COMPONENTS
    ════════════════════════════════ */

    /* Orb background blobs */
    .orb { border-radius: 50%; filter: blur(80px); position: absolute; pointer-events: none; }

    /* Glassmorphism card */
    .card-glass {
      background: rgba(17,19,24,0.75);
      backdrop-filter: blur(14px);
      border: 1px solid rgba(255,255,255,0.06);
    }

    /* Amber badge pill */
    .badge-pill {
      background: rgba(245,158,11,0.12);
      border: 1px solid rgba(245,158,11,0.28);
    }

    /* Buttons */
    .btn-primary {
      background: linear-gradient(135deg, #f59e0b, #d97706);
      transition: all 0.25s ease;
      box-shadow: 0 4px 18px rgba(245,158,11,0.28);
      cursor: pointer;
    }
    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 28px rgba(245,158,11,0.42);
    }
    .btn-primary:active { transform: translateY(0); }

    .btn-ghost {
      border: 1px solid rgba(255,255,255,0.12);
      transition: all 0.25s ease;
      cursor: pointer;
    }
    .btn-ghost:hover {
      border-color: rgba(245,158,11,0.45);
      color: #fbbf24;
    }

    /* Live dot */
    .live-dot {
      display: inline-block;
      width: 8px; height: 8px;
      background: #22c55e;
      border-radius: 50%;
      animation: livePulse 1.5s ease-in-out infinite;
    }

    /* Text glow */
    .text-glow { text-shadow: 0 0 36px rgba(251,191,36,0.38); }

    /* Divider accent */
    .line-accent { background: linear-gradient(90deg, transparent, rgba(245,158,11,0.4), transparent); height: 1px; }

    /* Filter chips */
    .chip {
      padding: 7px 16px; border-radius: 100px;
      font-size: 0.82rem; cursor: pointer; transition: all 0.2s;
      font-family: 'DM Sans', sans-serif; font-weight: 500;
      border: 1px solid rgba(255,255,255,0.1);
      color: rgba(255,255,255,0.45); background: transparent;
    }
    .chip:hover { border-color: rgba(245,158,11,0.4); color: #fbbf24; }
    .chip.active { background: rgba(245,158,11,0.12); border-color: rgba(245,158,11,0.35); color: #f59e0b; }

    /* Input fields */
    .input-field {
      width: 100%; padding: 12px 14px 12px 44px;
      background: rgba(255,255,255,0.03);
      border: 1px solid rgba(255,255,255,0.08);
      border-radius: 12px; color: white;
      font-family: 'DM Sans', sans-serif; font-size: 0.9rem; outline: none;
      transition: border-color 0.2s, box-shadow 0.2s;
    }
    .input-field:focus { border-color: rgba(245,158,11,0.5); box-shadow: 0 0 0 3px rgba(245,158,11,0.08); }
    .input-field::placeholder { color: rgba(255,255,255,0.22); }

    .search-field {
      width: 100%; padding: 13px 16px 13px 46px;
      background: rgba(255,255,255,0.03);
      border: 1px solid rgba(255,255,255,0.09);
      border-radius: 14px; color: white;
      font-family: 'DM Sans', sans-serif; font-size: 0.92rem; outline: none;
      transition: border-color 0.2s, box-shadow 0.2s;
    }
    .search-field:focus { border-color: rgba(245,158,11,0.45); box-shadow: 0 0 0 3px rgba(245,158,11,0.07); }
    .search-field::placeholder { color: rgba(255,255,255,0.22); }

    /* Status badges */
    .badge-live     { background: rgba(34,197,94,0.12);  border: 1px solid rgba(34,197,94,0.28);  color: #4ade80; }
    .badge-upcoming { background: rgba(245,158,11,0.1);  border: 1px solid rgba(245,158,11,0.25); color: #fbbf24; }
    .badge-recorded { background: rgba(99,102,241,0.12); border: 1px solid rgba(99,102,241,0.28); color: #a5b4fc; }
    .badge-open     { background: rgba(34,197,94,0.12);  border: 1px solid rgba(34,197,94,0.28);  color: #4ade80; }
    .badge-soon     { background: rgba(245,158,11,0.12); border: 1px solid rgba(245,158,11,0.28); color: #fbbf24; }
    .badge-closed   { background: rgba(99,102,241,0.12); border: 1px solid rgba(99,102,241,0.28); color: #a5b4fc; }
    .badge-free     { background: rgba(16,185,129,0.1);  border: 1px solid rgba(16,185,129,0.25); color: #6ee7b7; }

    /* Seat progress bar */
    .seat-bar  { height: 3px; border-radius: 2px; background: rgba(255,255,255,0.07); overflow: hidden; }
    .seat-fill { height: 100%; border-radius: 2px; background: linear-gradient(90deg, #f59e0b, #d97706); }

    /* Pagination */
    .page-btn {
      width: 36px; height: 36px; border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      font-size: 0.85rem; transition: all 0.2s; cursor: pointer;
      font-family: 'DM Mono', monospace;
    }
    .page-btn.active { background: rgba(245,158,11,0.15); border: 1px solid rgba(245,158,11,0.3); color: #f59e0b; }
    .page-btn:not(.active) { border: 1px solid rgba(255,255,255,0.08); color: rgba(255,255,255,0.4); }
    .page-btn:not(.active):hover { border-color: rgba(245,158,11,0.3); color: #f59e0b; }

    /* Sidebar sticky */
    .sidebar { position: sticky; top: 110px; }
    .cat-item { display: flex; align-items: center; justify-content: space-between; padding: 10px 14px; border-radius: 10px; cursor: pointer; transition: all 0.18s; font-size: 0.85rem; }
    .cat-item:hover { background: rgba(255,255,255,0.04); color: white; }
    .cat-item.active { background: rgba(245,158,11,0.1); color: #f59e0b; }
    .cat-count { font-family: 'DM Mono', monospace; font-size: 0.72rem; color: rgba(255,255,255,0.25); }
    .cat-item.active .cat-count { color: rgba(245,158,11,0.6); }

    /* ════════════════════════════════
       TICKER
    ════════════════════════════════ */
    .ticker-wrap  { overflow: hidden; white-space: nowrap; }
    .ticker-inner { display: inline-block; animation: ticker 30s linear infinite; }

    /* ════════════════════════════════
       NAVBAR
    ════════════════════════════════ */
    .nav-blur {
      background: rgba(11,12,16,0.85);
      backdrop-filter: blur(20px);
      border-bottom: 1px solid rgba(255,255,255,0.05);
    }
    .nav-link { transition: color 0.2s; color: rgba(255,255,255,0.45); font-size: 0.875rem; }
    .nav-link:hover { color: white; }
    .nav-link.active { color: #f59e0b; font-weight: 600; }

    /* Mobile menu */
    .mobile-menu { display: none; }
    .mobile-menu.open { display: flex; }

    /* ════════════════════════════════
       PAGE-SPECIFIC OVERRIDES VIA STACK
    ════════════════════════════════ */
    @stack('styles')
  </style>

  @stack('head')
</head>
<body class="min-h-screen">

  <!-- ══ TICKER ══ -->
  <div class="fixed top-0 left-0 right-0 z-40 py-2 ticker-wrap"
       style="background:rgba(245,158,11,0.04);border-bottom:1px solid rgba(245,158,11,0.09);">
    <div class="ticker-inner text-xs font-body" style="color:rgba(245,158,11,0.6);">
      <span class="px-8">🎯 Webinar UI/UX Design — Besok, 19.00 WIB</span>
      <span class="px-8">⚡ 1.200+ Peserta Aktif Minggu Ini</span>
      <span class="px-8">🚀 Seminar AI &amp; Machine Learning — 25 Feb 2025</span>
      <span class="px-8">🌟 Instruktur Baru: Sarah Dewi, Ex-Google</span>
      <span class="px-8">🎓 Sertifikat Digital Tersedia untuk Semua Kelas</span>
      <span class="px-8">🎯 Webinar UI/UX Design — Besok, 19.00 WIB</span>
      <span class="px-8">⚡ 1.200+ Peserta Aktif Minggu Ini</span>
      <span class="px-8">🚀 Seminar AI &amp; Machine Learning — 25 Feb 2025</span>
      <span class="px-8">🌟 Instruktur Baru: Sarah Dewi, Ex-Google</span>
      <span class="px-8">🎓 Sertifikat Digital Tersedia untuk Semua Kelas</span>
    </div>
  </div>

  <!-- ══ NAVBAR ══ -->
  <nav class="nav-blur fixed top-[33px] left-0 right-0 z-50 px-6 py-4">
    <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">

      <!-- Logo -->
      <a href="/" class="flex items-center gap-2 flex-shrink-0">
        <div class="w-8 h-8 rounded-lg btn-primary flex items-center justify-center">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
            <path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/>
          </svg>
        </div>
        <span class="font-display font-bold text-lg tracking-tight">
          Open<span style="color:#f59e0b;">Skill</span>
        </span>
      </a>

      <!-- Desktop Nav -->
      <div class="hidden md:flex items-center gap-7 font-body">
        <a href="{{ route('explore') }}"   class="nav-link {{ request()->routeIs('explore.*')  ? 'active' : '' }}">Eksplorasi</a>
        <a href="{{ route('webinar') }}"   class="nav-link {{ request()->routeIs('webinar.*')  ? 'active' : '' }}">Webinar</a>
        <a href="{{ route('seminar') }}"   class="nav-link {{ request()->routeIs('seminar.*')  ? 'active' : '' }}">Seminar</a>
        <a href="#"                              class="nav-link">Komunitas</a>
        <a href="#"                              class="nav-link">Instruktur</a>
      </div>

      <!-- Right actions -->
      <div class="flex items-center gap-3">
        @auth
          <!-- Logged in: avatar + profile link -->
          <a href="{{ route('profile.welcome') }}" class="flex items-center gap-2.5 group">
            <div class="w-8 h-8 rounded-full overflow-hidden flex items-center justify-center flex-shrink-0"
                 style="background:rgba(245,158,11,0.15);border:1px solid rgba(245,158,11,0.3);">
              @if (Auth::user()->profile_picture)
                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" class="w-full h-full object-cover" alt="">
              @else
                <span class="font-display font-bold text-xs" style="color:#f59e0b;">
                  {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </span>
              @endif
            </div>
            <span class="hidden sm:block font-body text-sm text-gray-400 group-hover:text-white transition-colors">
              {{ Str::words(Auth::user()->name, 1, '') }}
            </span>
          </a>
          <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit" class="btn-ghost px-4 py-2 rounded-lg text-gray-500 text-sm font-body">
              Keluar
            </button>
          </form>
        @else
          <a href="{{ route('login') }}"    class="btn-ghost px-4 py-2 rounded-lg text-gray-400 text-sm font-body">Masuk</a>
          <a href="{{ route('register') }}" class="btn-primary px-5 py-2 rounded-lg text-white text-sm font-semibold font-body">Daftar Gratis</a>
        @endauth

        <!-- Mobile hamburger -->
        <button class="md:hidden btn-ghost w-9 h-9 rounded-lg flex items-center justify-center" onclick="toggleMobile()">
          <svg id="ham-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/>
          </svg>
        </button>
      </div>
    </div>

    <!-- Mobile menu dropdown -->
    <div id="mobile-menu" class="mobile-menu md:hidden flex-col gap-1 pt-3 mt-3 border-t"
         style="border-color:rgba(255,255,255,0.06);">
      <a href="{{ route('explore') }}" class="nav-link {{ request()->routeIs('explore.*') ? 'active' : '' }} px-2 py-2.5 block">Eksplorasi</a>
      <a href="{{ route('webinar.index') }}" class="nav-link {{ request()->routeIs('webinar.*') ? 'active' : '' }} px-2 py-2.5 block">Webinar</a>
      <a href="{{ route('seminar.index') }}" class="nav-link {{ request()->routeIs('seminar.*') ? 'active' : '' }} px-2 py-2.5 block">Seminar</a>
      <a href="#" class="nav-link px-2 py-2.5 block">Komunitas</a>
      <a href="#" class="nav-link px-2 py-2.5 block">Instruktur</a>
    </div>
  </nav>

  <!-- ══ PAGE CONTENT ══ -->
  <main class="relative z-10">
    @yield('content')
  </main>

  <!-- ══ FLASH MESSAGES ══ -->
  @if (session('success') || session('error'))
    <div id="flash-toast" class="fixed bottom-6 right-6 z-[200] card-glass rounded-xl px-5 py-4 flex items-center gap-3 max-w-sm"
         style="border:1px solid {{ session('success') ? 'rgba(34,197,94,0.25)' : 'rgba(239,68,68,0.25)' }};
                animation: fadeUp 0.4s ease forwards;">
      <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0"
           style="background:{{ session('success') ? 'rgba(34,197,94,0.1)' : 'rgba(239,68,68,0.1)' }};">
        @if(session('success'))
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
        @else
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        @endif
      </div>
      <p class="font-body text-sm {{ session('success') ? 'text-green-400' : 'text-red-400' }} font-medium">
        {{ session('success') ?? session('error') }}
      </p>
      <button onclick="document.getElementById('flash-toast').remove()" class="ml-auto text-gray-600 hover:text-white transition-colors">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
      </button>
    </div>
    <script>setTimeout(() => document.getElementById('flash-toast')?.remove(), 4000);</script>
  @endif

  <!-- ══ FOOTER ══ -->
  <footer class="relative z-10 px-6 py-10" style="border-top:1px solid rgba(255,255,255,0.05);">
    <div class="max-w-6xl mx-auto">
      <div class="grid sm:grid-cols-4 gap-8 mb-8">
        <!-- Brand -->
        <div class="sm:col-span-2">
          <div class="flex items-center gap-2 mb-3">
            <div class="w-7 h-7 rounded-lg btn-primary flex items-center justify-center">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
                <path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/>
              </svg>
            </div>
            <span class="font-display font-bold">Open<span style="color:#f59e0b;">Skill</span></span>
          </div>
          <p class="font-body text-xs text-gray-600 leading-relaxed max-w-xs">
            Platform webinar dan seminar terbuka untuk semua profesional Indonesia. Belajar dari yang terbaik, gratis.
          </p>
        </div>
        <!-- Links -->
        <div>
          <p class="font-body text-xs text-gray-700 uppercase tracking-widest mb-3">Platform</p>
          <div class="space-y-2">
            <a href="{{ route('explore.index') }}" class="font-body text-xs text-gray-600 hover:text-gray-400 transition-colors block">Eksplorasi</a>
            <a href="{{ route('webinar.index') }}" class="font-body text-xs text-gray-600 hover:text-gray-400 transition-colors block">Webinar</a>
            <a href="{{ route('seminar.index') }}" class="font-body text-xs text-gray-600 hover:text-gray-400 transition-colors block">Seminar</a>
            <a href="#" class="font-body text-xs text-gray-600 hover:text-gray-400 transition-colors block">Komunitas</a>
          </div>
        </div>
        <div>
          <p class="font-body text-xs text-gray-700 uppercase tracking-widest mb-3">Perusahaan</p>
          <div class="space-y-2">
            <a href="#" class="font-body text-xs text-gray-600 hover:text-gray-400 transition-colors block">Tentang Kami</a>
            <a href="#" class="font-body text-xs text-gray-600 hover:text-gray-400 transition-colors block">Instruktur</a>
            <a href="#" class="font-body text-xs text-gray-600 hover:text-gray-400 transition-colors block">Privasi</a>
            <a href="#" class="font-body text-xs text-gray-600 hover:text-gray-400 transition-colors block">Kontak</a>
          </div>
        </div>
      </div>

      <div class="line-accent mb-6 opacity-30"></div>

      <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
        <p class="font-body text-xs text-gray-700">© {{ date('Y') }} OpenSkill. Semua hak dilindungi.</p>
        <div class="flex items-center gap-4">
          <!-- Social icons -->
          <a href="#" class="text-gray-700 hover:text-gray-400 transition-colors">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/></svg>
          </a>
          <a href="#" class="text-gray-700 hover:text-gray-400 transition-colors">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
          </a>
          <a href="#" class="text-gray-700 hover:text-gray-400 transition-colors">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0 12.64 12.64 0 0 0-.617-1.25.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 0 0 .031.057 19.9 19.9 0 0 0 5.993 3.03.078.078 0 0 0 .084-.028c.462-.63.874-1.295 1.226-1.994a.076.076 0 0 0-.041-.106 13.201 13.201 0 0 1-1.872-.892.077.077 0 0 1-.008-.128 10.2 10.2 0 0 0 .372-.292.074.074 0 0 1 .077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127 12.299 12.299 0 0 1-1.873.892.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028 19.839 19.839 0 0 0 6.002-3.03.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.03z"/></svg>
          </a>
        </div>
      </div>
    </div>
  </footer>

  <!-- ══ GLOBAL SCRIPTS ══ -->
  <script>
    // Mobile nav toggle
    function toggleMobile() {
      const menu = document.getElementById('mobile-menu');
      menu.classList.toggle('open');
    }

    // Scroll reveal observer (available globally)
    const revealObserver = new IntersectionObserver(entries => {
      entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
    }, { threshold: 0.08 });
    document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));
  </script>

  @stack('scripts')

</body>
</html>