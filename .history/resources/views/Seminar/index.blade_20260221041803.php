<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Seminar — OpenSkill</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet" />
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: { display: ['Syne', 'sans-serif'], body: ['DM Sans', 'sans-serif'] },
          colors: {
            ink: '#0b0c10', panel: '#111318',
            amber: { vivid: '#f59e0b', glow: '#fbbf24' }
          }
        }
      }
    }
  </script>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body { background-color: #0b0c10; font-family: 'DM Sans', sans-serif; overflow-x: hidden; color: white; }
    body::before {
      content: ''; position: fixed; inset: 0;
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.03'/%3E%3C/svg%3E");
      pointer-events: none; z-index: 0; opacity: 0.4;
    }

    /* ── Keyframes ── */
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(22px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes glowPulse {
      0%, 100% { opacity: 0.4; transform: scale(1); }
      50%       { opacity: 0.8; transform: scale(1.06); }
    }
    @keyframes livePulse {
      0%, 100% { opacity: 1; box-shadow: 0 0 0 0 rgba(245,158,11,0.45); }
      50%       { opacity: 0.75; box-shadow: 0 0 0 7px rgba(245,158,11,0); }
    }
    @keyframes ticker {
      0%   { transform: translateX(0); }
      100% { transform: translateX(-50%); }
    }
    @keyframes shimmer {
      0%   { transform: translateX(-100%); }
      100% { transform: translateX(100%); }
    }

    .stagger-1 { animation: fadeUp 0.6s 0.05s ease forwards; opacity: 0; }
    .stagger-2 { animation: fadeUp 0.6s 0.15s ease forwards; opacity: 0; }
    .stagger-3 { animation: fadeUp 0.6s 0.25s ease forwards; opacity: 0; }
    .stagger-4 { animation: fadeUp 0.6s 0.35s ease forwards; opacity: 0; }

    /* ── Base UI ── */
    .orb { border-radius: 50%; filter: blur(80px); position: absolute; pointer-events: none; }
    .card-glass { background: rgba(17,19,24,0.75); backdrop-filter: blur(14px); border: 1px solid rgba(255,255,255,0.06); }
    .badge-pill { background: rgba(245,158,11,0.12); border: 1px solid rgba(245,158,11,0.28); }
    .btn-primary { background: linear-gradient(135deg, #f59e0b, #d97706); transition: all 0.25s ease; box-shadow: 0 4px 18px rgba(245,158,11,0.28); }
    .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(245,158,11,0.42); }
    .btn-ghost { border: 1px solid rgba(255,255,255,0.12); transition: all 0.25s ease; }
    .btn-ghost:hover { border-color: rgba(245,158,11,0.45); color: #fbbf24; }
    .nav-blur { background: rgba(11,12,16,0.85); backdrop-filter: blur(20px); border-bottom: 1px solid rgba(255,255,255,0.05); }
    .text-glow { text-shadow: 0 0 36px rgba(251,191,36,0.38); }

    /* ── Ticker ── */
    .ticker-wrap { overflow: hidden; white-space: nowrap; }
    .ticker-inner { display: inline-block; animation: ticker 30s linear infinite; }

    /* ── Search ── */
    .search-field {
      width: 100%; padding: 13px 16px 13px 46px;
      background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.09);
      border-radius: 14px; color: white; font-family: 'DM Sans', sans-serif; font-size: 0.92rem; outline: none;
      transition: border-color 0.2s, box-shadow 0.2s;
    }
    .search-field:focus { border-color: rgba(245,158,11,0.45); box-shadow: 0 0 0 3px rgba(245,158,11,0.07); }
    .search-field::placeholder { color: rgba(255,255,255,0.22); }

    /* ── Filter chips ── */
    .chip { padding: 7px 16px; border-radius: 100px; font-size: 0.82rem; cursor: pointer; transition: all 0.2s; font-family: 'DM Sans', sans-serif; font-weight: 500; border: 1px solid rgba(255,255,255,0.1); color: rgba(255,255,255,0.45); background: transparent; }
    .chip:hover { border-color: rgba(245,158,11,0.4); color: #fbbf24; }
    .chip.active { background: rgba(245,158,11,0.12); border-color: rgba(245,158,11,0.35); color: #f59e0b; }

    /* ── Seminar Cards (horizontal, more editorial) ── */
    .seminar-card { transition: all 0.28s ease; cursor: pointer; }
    .seminar-card:hover { transform: translateY(-3px); border-color: rgba(245,158,11,0.2) !important; }

    /* Featured banner */
    .hero-banner { position: relative; overflow: hidden; }
    .hero-banner::after {
      content: '';
      position: absolute; inset: 0;
      background: linear-gradient(to right, rgba(11,12,16,0.9) 0%, rgba(11,12,16,0.5) 50%, transparent 100%);
    }
    .hero-banner-content { position: relative; z-index: 2; }

    /* Status badges */
    .badge-open    { background: rgba(34,197,94,0.12);  border: 1px solid rgba(34,197,94,0.28);  color: #4ade80; }
    .badge-soon    { background: rgba(245,158,11,0.12); border: 1px solid rgba(245,158,11,0.28); color: #fbbf24; }
    .badge-closed  { background: rgba(99,102,241,0.12); border: 1px solid rgba(99,102,241,0.28); color: #a5b4fc; }
    .badge-free    { background: rgba(16,185,129,0.1);  border: 1px solid rgba(16,185,129,0.25); color: #6ee7b7; }
    .badge-premium { background: rgba(245,158,11,0.1);  border: 1px solid rgba(245,158,11,0.25); color: #fbbf24; }

    /* Speaker row */
    .speaker-chip {
      display: inline-flex; align-items: center; gap: 8px;
      background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.07);
      border-radius: 100px; padding: 5px 12px 5px 5px;
    }

    /* Timeline / schedule indicator */
    .timeline-dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }

    /* Countdown pill */
    .countdown { font-family: 'DM Mono', monospace; letter-spacing: 0.04em; }

    /* Reveal */
    .reveal { opacity: 0; transform: translateY(18px); transition: opacity 0.5s ease, transform 0.5s ease; }
    .reveal.visible { opacity: 1; transform: translateY(0); }

    /* Pagination */
    .page-btn { width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 0.85rem; transition: all 0.2s; cursor: pointer; font-family: 'DM Mono', monospace; }
    .page-btn.active { background: rgba(245,158,11,0.15); border: 1px solid rgba(245,158,11,0.3); color: #f59e0b; }
    .page-btn:not(.active) { border: 1px solid rgba(255,255,255,0.08); color: rgba(255,255,255,0.4); }
    .page-btn:not(.active):hover { border-color: rgba(245,158,11,0.3); color: #f59e0b; }

    /* Sidebar */
    .sidebar { position: sticky; top: 110px; }
    .cat-item { display: flex; align-items: center; justify-content: space-between; padding: 10px 14px; border-radius: 10px; cursor: pointer; transition: all 0.18s; font-size: 0.85rem; }
    .cat-item:hover { background: rgba(255,255,255,0.04); color: white; }
    .cat-item.active { background: rgba(245,158,11,0.1); color: #f59e0b; }
    .cat-count { font-family: 'DM Mono', monospace; font-size: 0.72rem; color: rgba(255,255,255,0.25); }
    .cat-item.active .cat-count { color: rgba(245,158,11,0.6); }

    /* Progress bar (seats) */
    .seat-bar { height: 3px; border-radius: 2px; background: rgba(255,255,255,0.07); overflow: hidden; }
    .seat-fill { height: 100%; border-radius: 2px; background: linear-gradient(90deg, #f59e0b, #d97706); }
  </style>
</head>
<body class="min-h-screen">

  <!-- BG Orbs -->
  <div class="orb" style="width:600px;height:400px;background:rgba(245,158,11,0.06);top:-100px;left:-100px;animation:glowPulse 7s ease-in-out infinite;"></div>
  <div class="orb" style="width:350px;height:350px;background:rgba(99,102,241,0.04);bottom:200px;right:-80px;animation:glowPulse 9s ease-in-out infinite reverse;"></div>

  <!-- TICKER -->
  <div class="fixed top-0 left-0 right-0 z-40 py-2 ticker-wrap" style="background:rgba(245,158,11,0.04);border-bottom:1px solid rgba(245,158,11,0.09);">
    <div class="ticker-inner text-xs font-body" style="color:rgba(245,158,11,0.6);">
      <span class="px-8">🎓 Seminar AI &amp; Future of Work — 25 Feb 2025 · Gratis</span>
      <span class="px-8">📋 Kuota Terbatas: Seminar Cybersecurity — 80% terisi</span>
      <span class="px-8">🌟 Pembicara Baru: Dr. Hana Pertiwi, Ex-NASA</span>
      <span class="px-8">🏆 Sertifikat terverifikasi untuk semua peserta seminar</span>
      <span class="px-8">⚡ 3 Seminar Live minggu ini — Daftar sekarang!</span>
      <span class="px-8">🎓 Seminar AI &amp; Future of Work — 25 Feb 2025 · Gratis</span>
      <span class="px-8">📋 Kuota Terbatas: Seminar Cybersecurity — 80% terisi</span>
      <span class="px-8">🌟 Pembicara Baru: Dr. Hana Pertiwi, Ex-NASA</span>
      <span class="px-8">🏆 Sertifikat terverifikasi untuk semua peserta seminar</span>
      <span class="px-8">⚡ 3 Seminar Live minggu ini — Daftar sekarang!</span>
    </div>
  </div>

  <!-- NAVBAR -->
  <nav class="nav-blur fixed top-[33px] left-0 right-0 z-50 px-6 py-4">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
      <a href="/" class="flex items-center gap-2">
        <div class="w-8 h-8 rounded-lg btn-primary flex items-center justify-center flex-shrink-0">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
            <path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/>
          </svg>
        </div>
        <span class="font-display font-bold text-lg tracking-tight">Open<span style="color:#f59e0b;">Skill</span></span>
      </a>

      <div class="hidden md:flex items-center gap-7 text-sm text-gray-500 font-body">
        <a href="#" class="hover:text-white transition-colors">Eksplorasi</a>
        <a href="#" class="hover:text-white transition-colors">Webinar</a>
        <a href="#" class="hover:text-white transition-colors" style="color:#f59e0b;font-weight:600;">Seminar</a>
        <a href="#" class="hover:text-white transition-colors">Komunitas</a>
        <a href="#" class="hover:text-white transition-colors">Instruktur</a>
      </div>

      <div class="flex items-center gap-3">
        @auth
          <a href="{{ route('profile.welcome') }}" class="flex items-center gap-2">
            <div class="w-8 h-8 rounded-full overflow-hidden flex items-center justify-center" style="background:rgba(245,158,11,0.15);border:1px solid rgba(245,158,11,0.25);">
              @if (Auth::user()->profile_picture)
                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" class="w-full h-full object-cover" alt="">
              @else
                <span class="font-display font-bold text-xs" style="color:#f59e0b;">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
              @endif
            </div>
          </a>
        @else
          <a href="{{ route('login') }}" class="btn-ghost px-4 py-2 rounded-lg text-gray-400 text-sm font-body">Masuk</a>
          <a href="{{ route('register') }}" class="btn-primary px-5 py-2 rounded-lg text-white text-sm font-semibold font-body">Daftar Gratis</a>
        @endauth
      </div>
    </div>
  </nav>

  <!-- PAGE CONTENT -->
  <div class="relative z-10 max-w-7xl mx-auto px-6 pt-36 pb-24">

    <!-- PAGE HEADER -->
    <div class="mb-10 stagger-1">
      <div class="flex flex-wrap items-end justify-between gap-5 mb-8">
        <div>
          <span class="font-body text-xs uppercase tracking-widest mb-2 block" style="color:rgba(245,158,11,0.7);">Edukasi Mendalam</span>
          <h1 class="font-display font-extrabold tracking-tight text-glow" style="font-size:clamp(2rem,5vw,3.4rem);line-height:1;">
            Semua Seminar
          </h1>
          <p class="font-body text-gray-500 text-sm mt-2">Sesi intensif, materi mendalam, dan pembicara kelas dunia. Sertifikat terverifikasi.</p>
        </div>

        <!-- Stats pills -->
        <div class="flex items-center gap-3">
          <div class="card-glass rounded-xl px-4 py-3 text-center">
            <p class="font-display font-bold text-xl" style="color:#f59e0b;">72</p>
            <p class="font-body text-xs text-gray-600">Bulan Ini</p>
          </div>
          <div class="card-glass rounded-xl px-4 py-3 text-center">
            <p class="font-display font-bold text-xl text-white">150+</p>
            <p class="font-body text-xs text-gray-600">Pembicara</p>
          </div>
          <div class="card-glass rounded-xl px-4 py-3 text-center">
            <p class="font-display font-bold text-xl text-white">100%</p>
            <p class="font-body text-xs text-gray-600">Gratis</p>
          </div>
        </div>
      </div>

      <!-- Search + filter row -->
      <div class="flex flex-col sm:flex-row gap-3 mb-6">
        <div class="relative flex-1 max-w-xl">
          <svg class="absolute top-1/2 -translate-y-1/2 text-gray-600" style="left:14px;" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
          <input type="text" id="search-input" placeholder="Cari seminar, topik, pembicara…" class="search-field" oninput="filterCards()">
        </div>
        <select class="search-field" style="padding-left:16px;max-width:180px;cursor:pointer;" onchange="filterByDate(this.value)">
          <option value="all">Semua Waktu</option>
          <option value="week">Minggu Ini</option>
          <option value="month">Bulan Ini</option>
          <option value="next">Bulan Depan</option>
        </select>
      </div>

      <!-- Filter chips -->
      <div class="flex flex-wrap gap-2">
        <button class="chip active" data-filter="all" onclick="setFilter(this,'all')">Semua</button>
        <button class="chip" data-filter="open" onclick="setFilter(this,'open')">
          <span class="flex items-center gap-1.5">
            <span class="w-1.5 h-1.5 rounded-full bg-green-400 inline-block"></span>Pendaftaran Buka
          </span>
        </button>
        <button class="chip" data-filter="soon" onclick="setFilter(this,'soon')">Segera Tutup</button>
        <button class="chip" data-filter="closed" onclick="setFilter(this,'closed')">Arsip</button>
        <div class="w-px mx-1" style="background:rgba(255,255,255,0.08);"></div>
        <button class="chip" data-filter="teknologi" onclick="setFilter(this,'teknologi')">💻 Teknologi</button>
        <button class="chip" data-filter="bisnis" onclick="setFilter(this,'bisnis')">📊 Bisnis</button>
        <button class="chip" data-filter="ai" onclick="setFilter(this,'ai')">🤖 AI &amp; Data</button>
        <button class="chip" data-filter="desain" onclick="setFilter(this,'desain')">🎨 Desain</button>
        <button class="chip" data-filter="keamanan" onclick="setFilter(this,'keamanan')">🔐 Cybersecurity</button>
      </div>
    </div>

    <!-- CONTENT -->
    <div class="flex gap-8">

      <!-- SIDEBAR -->
      <aside class="hidden xl:block w-56 flex-shrink-0">
        <div class="sidebar">
          <div class="card-glass rounded-2xl p-4 mb-5">
            <p class="font-body text-xs text-gray-600 uppercase tracking-widest mb-3">Kategori</p>
            <div class="space-y-0.5">
              <div class="cat-item active font-body text-sm text-gray-400" onclick="setFilter(null,'all')"><span>Semua</span><span class="cat-count">72</span></div>
              <div class="cat-item font-body text-sm text-gray-400" onclick="setFilter(null,'teknologi')"><span>💻 Teknologi</span><span class="cat-count">24</span></div>
              <div class="cat-item font-body text-sm text-gray-400" onclick="setFilter(null,'bisnis')"><span>📊 Bisnis</span><span class="cat-count">18</span></div>
              <div class="cat-item font-body text-sm text-gray-400" onclick="setFilter(null,'ai')"><span>🤖 AI &amp; Data</span><span class="cat-count">14</span></div>
              <div class="cat-item font-body text-sm text-gray-400" onclick="setFilter(null,'desain')"><span>🎨 Desain</span><span class="cat-count">10</span></div>
              <div class="cat-item font-body text-sm text-gray-400" onclick="setFilter(null,'keamanan')"><span>🔐 Cybersecurity</span><span class="cat-count">6</span></div>
            </div>
          </div>

          <!-- Upcoming this week -->
          <div class="card-glass rounded-2xl p-4 mb-5">
            <p class="font-body text-xs text-gray-600 uppercase tracking-widest mb-3">Minggu Ini</p>
            <div class="space-y-4">
              <div>
                <p class="font-body text-xs font-medium text-white mb-0.5">AI & Future of Work</p>
                <p class="font-body text-xs text-gray-600">25 Feb — 09.00 WIB</p>
                <div class="seat-bar mt-2"><div class="seat-fill" style="width:65%;"></div></div>
                <p class="font-body text-xs text-gray-700 mt-1">350 / 500 kursi</p>
              </div>
              <div style="border-top:1px solid rgba(255,255,255,0.05);padding-top:12px;">
                <p class="font-body text-xs font-medium text-white mb-0.5">Cybersecurity 2025</p>
                <p class="font-body text-xs text-gray-600">27 Feb — 13.00 WIB</p>
                <div class="seat-bar mt-2"><div class="seat-fill" style="width:82%;background:linear-gradient(90deg,#ef4444,#dc2626);"></div></div>
                <p class="font-body text-xs mt-1" style="color:#f87171;">410 / 500 kursi</p>
              </div>
            </div>
          </div>

          <!-- Format filter -->
          <div class="card-glass rounded-2xl p-4">
            <p class="font-body text-xs text-gray-600 uppercase tracking-widest mb-3">Format</p>
            <div class="space-y-1.5">
              <label class="flex items-center gap-2 cursor-pointer py-1">
                <input type="checkbox" checked class="accent-amber-500"><span class="font-body text-sm text-gray-400">Online</span>
              </label>
              <label class="flex items-center gap-2 cursor-pointer py-1">
                <input type="checkbox" class="accent-amber-500"><span class="font-body text-sm text-gray-400">Hybrid</span>
              </label>
              <label class="flex items-center gap-2 cursor-pointer py-1">
                <input type="checkbox" class="accent-amber-500"><span class="font-body text-sm text-gray-400">Offline</span>
              </label>
            </div>
          </div>
        </div>
      </aside>

      <!-- MAIN: Featured + List -->
      <div class="flex-1 min-w-0">

        <!-- ── FEATURED SEMINAR (hero card) ── -->
        <div class="hero-banner card-glass rounded-3xl mb-6 reveal seminar-card" data-status="soon" data-cat="ai" data-title="AI dan Future of Work Bagaimana Bertahan di Era Otomasi" style="border:1px solid rgba(245,158,11,0.14);min-height:220px;position:relative;overflow:hidden;">
          <!-- Decorative bg -->
          <div class="absolute inset-0" style="background:linear-gradient(135deg,rgba(245,158,11,0.08) 0%,rgba(245,158,11,0.02) 40%,transparent 70%);"></div>
          <div class="absolute right-0 top-0 bottom-0 w-1/2 flex items-center justify-center opacity-5">
            <svg width="200" height="200" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="0.5"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
          </div>
          <!-- Top accent -->
          <div style="position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,#f59e0b,#d97706,transparent);"></div>

          <div class="relative p-8 flex flex-col md:flex-row items-start md:items-center gap-6">
            <div class="flex-1">
              <div class="flex flex-wrap items-center gap-2 mb-4">
                <span class="badge-soon font-body text-xs px-3 py-1 rounded-full flex items-center gap-1.5">
                  <span class="w-1.5 h-1.5 rounded-full bg-amber-400 inline-block" style="animation:livePulse 1.5s infinite;"></span>
                  Segera Tutup
                </span>
                <span class="badge-pill font-body text-xs px-3 py-1 rounded-full" style="color:#f59e0b;">🤖 AI &amp; Data</span>
                <span class="badge-free font-body text-xs px-3 py-1 rounded-full">Gratis</span>
                <span class="font-body text-xs text-gray-600 ml-1 countdown">⏱ 2h 34m tersisa</span>
              </div>

              <h2 class="font-display font-bold text-2xl md:text-3xl leading-tight mb-3 tracking-tight">
                AI &amp; Future of Work:<br/>Bertahan di Era Otomasi
              </h2>
              <p class="font-body text-sm text-gray-500 mb-5 max-w-lg">
                Panel diskusi eksklusif bersama 4 pemimpin industri membahas dampak nyata AI pada karier dan bagaimana mempersiapkan diri menghadapinya.
              </p>

              <!-- Speakers -->
              <div class="flex flex-wrap items-center gap-2 mb-5">
                <div class="speaker-chip">
                  <img src="https://i.pravatar.cc/26?img=11" class="w-6 h-6 rounded-full object-cover" alt="">
                  <span class="font-body text-xs text-gray-300">Kevin R.</span>
                </div>
                <div class="speaker-chip">
                  <img src="https://i.pravatar.cc/26?img=5" class="w-6 h-6 rounded-full object-cover" alt="">
                  <span class="font-body text-xs text-gray-300">Sari N.</span>
                </div>
                <div class="speaker-chip">
                  <img src="https://i.pravatar.cc/26?img=8" class="w-6 h-6 rounded-full object-cover" alt="">
                  <span class="font-body text-xs text-gray-300">Budi S.</span>
                </div>
                <span class="font-body text-xs text-gray-600">+1 pembicara</span>
              </div>

              <div class="flex flex-wrap items-center gap-4">
                <div class="flex items-center gap-2 text-xs text-gray-500 font-body">
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                  Selasa, 25 Feb 2025 · 09.00 — 12.00 WIB
                </div>
                <div class="flex items-center gap-2 text-xs text-gray-500 font-body">
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                  350 / 500 kursi
                </div>
              </div>
            </div>

            <div class="flex-shrink-0 flex flex-col items-center gap-3">
              <!-- Seat visual -->
              <div class="card-glass rounded-2xl p-5 text-center" style="border:1px solid rgba(245,158,11,0.15);min-width:150px;">
                <p class="font-body text-xs text-gray-600 mb-2">Kursi Tersedia</p>
                <p class="font-display font-bold text-3xl text-white mb-1">150</p>
                <div class="seat-bar mb-2"><div class="seat-fill" style="width:70%;"></div></div>
                <p class="font-body text-xs text-gray-700">dari 500 total</p>
              </div>
              <button class="btn-primary w-full py-3 rounded-xl text-white font-display font-semibold text-sm flex items-center justify-center gap-2">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
                Daftar Sekarang
              </button>
            </div>
          </div>
        </div>

        <!-- Results meta -->
        <div class="flex items-center justify-between mb-5">
          <p class="font-body text-sm text-gray-600" id="results-count">Menampilkan <span class="text-white font-medium">72</span> seminar</p>
        </div>

        <!-- ── LIST VIEW (editorial horizontal cards) ── -->
        <div class="flex flex-col gap-4 mb-8" id="cards-list">

          <!-- Seminar 1 -->
          <div class="seminar-card card-glass rounded-2xl p-5 reveal" data-status="open" data-cat="keamanan" data-title="Cybersecurity Landscape 2025 Ancaman Terbaru dan Cara Mitigasi" style="border:1px solid rgba(255,255,255,0.06);">
            <div class="flex flex-col sm:flex-row gap-5">
              <!-- Left: thumbnail -->
              <div class="flex-shrink-0 w-full sm:w-44 h-28 rounded-xl overflow-hidden flex items-center justify-center" style="background:linear-gradient(135deg,rgba(239,68,68,0.12),rgba(239,68,68,0.04));">
                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="rgba(239,68,68,0.6)" stroke-width="1.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
              </div>
              <!-- Right: info -->
              <div class="flex-1 min-w-0">
                <div class="flex flex-wrap items-center gap-2 mb-2">
                  <span class="badge-open font-body text-xs px-2.5 py-0.5 rounded-full">Buka</span>
                  <span class="font-body text-xs px-2.5 py-0.5 rounded-full" style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.2);color:#fca5a5;">🔐 Cybersecurity</span>
                  <span class="badge-free font-body text-xs px-2.5 py-0.5 rounded-full">Gratis</span>
                </div>
                <h3 class="font-display font-bold text-base leading-snug mb-1">Cybersecurity Landscape 2025: Ancaman &amp; Cara Mitigasi</h3>
                <p class="font-body text-xs text-gray-500 mb-3 line-clamp-1">Memahami lanskap keamanan siber terkini dan strategi mitigasi yang efektif untuk organisasi dari berbagai skala.</p>

                <div class="flex flex-wrap items-center justify-between gap-3">
                  <div class="flex items-center gap-4">
                    <div class="speaker-chip">
                      <img src="https://i.pravatar.cc/24?img=22" class="w-5 h-5 rounded-full" alt="">
                      <span class="font-body text-xs text-gray-400">Rafi Ananta · BSSN</span>
                    </div>
                  </div>
                  <div class="flex items-center gap-4">
                    <div class="text-xs text-gray-600 font-body flex items-center gap-1.5">
                      <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                      27 Feb · 13.00 — 16.00 WIB
                    </div>
                    <div class="text-xs font-body flex flex-col items-end">
                      <div class="seat-bar w-20 mb-1"><div class="seat-fill" style="width:82%;background:linear-gradient(90deg,#ef4444,#dc2626);"></div></div>
                      <span class="text-xs font-body" style="color:#f87171;">410/500 kursi</span>
                    </div>
                    <button class="btn-primary px-4 py-2 rounded-lg text-xs text-white font-body font-semibold whitespace-nowrap">Daftar →</button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Seminar 2 -->
          <div class="seminar-card card-glass rounded-2xl p-5 reveal" data-status="open" data-cat="bisnis" data-title="Venture Capital dan Startup Funding 101 Cara Mendapatkan Investor" style="border:1px solid rgba(255,255,255,0.06);">
            <div class="flex flex-col sm:flex-row gap-5">
              <div class="flex-shrink-0 w-full sm:w-44 h-28 rounded-xl overflow-hidden flex items-center justify-center" style="background:linear-gradient(135deg,rgba(16,185,129,0.1),rgba(16,185,129,0.03));">
                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="rgba(16,185,129,0.6)" stroke-width="1.5"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
              </div>
              <div class="flex-1 min-w-0">
                <div class="flex flex-wrap items-center gap-2 mb-2">
                  <span class="badge-open font-body text-xs px-2.5 py-0.5 rounded-full">Buka</span>
                  <span class="font-body text-xs px-2.5 py-0.5 rounded-full" style="background:rgba(16,185,129,0.1);border:1px solid rgba(16,185,129,0.2);color:#6ee7b7;">📊 Bisnis</span>
                  <span class="badge-free font-body text-xs px-2.5 py-0.5 rounded-full">Gratis</span>
                </div>
                <h3 class="font-display font-bold text-base leading-snug mb-1">Venture Capital &amp; Startup Funding 101</h3>
                <p class="font-body text-xs text-gray-500 mb-3 line-clamp-1">Dari pitch deck hingga term sheet — panduan lengkap mendapatkan pendanaan untuk startup kamu.</p>
                <div class="flex flex-wrap items-center justify-between gap-3">
                  <div class="speaker-chip">
                    <img src="https://i.pravatar.cc/24?img=30" class="w-5 h-5 rounded-full" alt="">
                    <span class="font-body text-xs text-gray-400">Andi Wijaya · East Ventures</span>
                  </div>
                  <div class="flex items-center gap-4">
                    <div class="text-xs text-gray-600 font-body flex items-center gap-1.5">
                      <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                      1 Mar · 14.00 — 16.00 WIB
                    </div>
                    <div class="text-xs font-body flex flex-col items-end">
                      <div class="seat-bar w-20 mb-1"><div class="seat-fill" style="width:40%;"></div></div>
                      <span class="text-xs text-gray-600 font-body">200/500 kursi</span>
                    </div>
                    <button class="btn-primary px-4 py-2 rounded-lg text-xs text-white font-body font-semibold whitespace-nowrap">Daftar →</button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Seminar 3 -->
          <div class="seminar-card card-glass rounded-2xl p-5 reveal" data-status="open" data-cat="teknologi" data-title="Cloud Architecture AWS untuk Engineer Backend" style="border:1px solid rgba(255,255,255,0.06);">
            <div class="flex flex-col sm:flex-row gap-5">
              <div class="flex-shrink-0 w-full sm:w-44 h-28 rounded-xl overflow-hidden flex items-center justify-center" style="background:linear-gradient(135deg,rgba(245,158,11,0.1),rgba(245,158,11,0.03));">
                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="rgba(245,158,11,0.6)" stroke-width="1.5"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
              </div>
              <div class="flex-1 min-w-0">
                <div class="flex flex-wrap items-center gap-2 mb-2">
                  <span class="badge-open font-body text-xs px-2.5 py-0.5 rounded-full">Buka</span>
                  <span class="badge-pill font-body text-xs px-2.5 py-0.5 rounded-full" style="color:#f59e0b;">💻 Teknologi</span>
                  <span class="badge-free font-body text-xs px-2.5 py-0.5 rounded-full">Gratis</span>
                </div>
                <h3 class="font-display font-bold text-base leading-snug mb-1">Cloud Architecture AWS untuk Backend Engineer</h3>
                <p class="font-body text-xs text-gray-500 mb-3 line-clamp-1">Desain sistem cloud-native yang scalable, reliable, dan cost-efficient menggunakan layanan AWS terkini.</p>
                <div class="flex flex-wrap items-center justify-between gap-3">
                  <div class="speaker-chip">
                    <img src="https://i.pravatar.cc/24?img=42" class="w-5 h-5 rounded-full" alt="">
                    <span class="font-body text-xs text-gray-400">Dimas Prastyo · AWS Solutions Architect</span>
                  </div>
                  <div class="flex items-center gap-4">
                    <div class="text-xs text-gray-600 font-body flex items-center gap-1.5">
                      <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                      4 Mar · 10.00 — 13.00 WIB
                    </div>
                    <div class="text-xs font-body flex flex-col items-end">
                      <div class="seat-bar w-20 mb-1"><div class="seat-fill" style="width:25%;"></div></div>
                      <span class="text-xs text-gray-600 font-body">125/500 kursi</span>
                    </div>
                    <button class="btn-primary px-4 py-2 rounded-lg text-xs text-white font-body font-semibold whitespace-nowrap">Daftar →</button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Seminar 4 -->
          <div class="seminar-card card-glass rounded-2xl p-5 reveal" data-status="closed" data-cat="desain" data-title="Design Systems at Scale Pelajaran dari Tokopedia dan Gojek" style="border:1px solid rgba(255,255,255,0.06);">
            <div class="flex flex-col sm:flex-row gap-5">
              <div class="flex-shrink-0 w-full sm:w-44 h-28 rounded-xl overflow-hidden flex items-center justify-center relative" style="background:linear-gradient(135deg,rgba(124,58,237,0.1),rgba(124,58,237,0.03));">
                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="rgba(124,58,237,0.6)" stroke-width="1.5"><path d="M5 5.5A3.5 3.5 0 0 1 8.5 2H12v7H8.5A3.5 3.5 0 0 1 5 5.5z"/><path d="M12 2h3.5a3.5 3.5 0 1 1 0 7H12V2z"/><path d="M12 12.5a3.5 3.5 0 1 1 7 0 3.5 3.5 0 1 1-7 0z"/><path d="M5 19.5A3.5 3.5 0 0 1 8.5 16H12v3.5a3.5 3.5 0 1 1-7 0z"/><path d="M5 12.5A3.5 3.5 0 0 1 8.5 9H12v7H8.5A3.5 3.5 0 0 1 5 12.5z"/></svg>
                <!-- Closed overlay -->
                <div class="absolute inset-0 flex items-center justify-center" style="background:rgba(11,12,16,0.6);backdrop-filter:blur(2px);">
                  <span class="badge-closed font-body text-xs px-2.5 py-1 rounded-full">Selesai</span>
                </div>
              </div>
              <div class="flex-1 min-w-0" style="opacity:0.65;">
                <div class="flex flex-wrap items-center gap-2 mb-2">
                  <span class="badge-closed font-body text-xs px-2.5 py-0.5 rounded-full">Arsip</span>
                  <span class="font-body text-xs px-2.5 py-0.5 rounded-full" style="background:rgba(124,58,237,0.1);border:1px solid rgba(124,58,237,0.2);color:#c4b5fd;">🎨 Desain</span>
                </div>
                <h3 class="font-display font-bold text-base leading-snug mb-1">Design Systems at Scale: Pelajaran dari Tokopedia &amp; Gojek</h3>
                <p class="font-body text-xs text-gray-500 mb-3 line-clamp-1">Studi kasus nyata bagaimana dua unicorn Indonesia membangun dan menjaga design system mereka.</p>
                <div class="flex flex-wrap items-center justify-between gap-3">
                  <div class="speaker-chip">
                    <img src="https://i.pravatar.cc/24?img=20" class="w-5 h-5 rounded-full" alt="">
                    <span class="font-body text-xs text-gray-500">Dina P. &amp; Sari N.</span>
                  </div>
                  <div class="flex items-center gap-4">
                    <div class="text-xs text-gray-700 font-body flex items-center gap-1.5">
                      <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                      15 Jan · Selesai
                    </div>
                    <button class="btn-ghost px-4 py-2 rounded-lg text-xs text-gray-600 font-body" disabled>Ditutup</button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Seminar 5 -->
          <div class="seminar-card card-glass rounded-2xl p-5 reveal" data-status="open" data-cat="ai" data-title="Machine Learning in Production Dari Notebook ke Deployment" style="border:1px solid rgba(255,255,255,0.06);">
            <div class="flex flex-col sm:flex-row gap-5">
              <div class="flex-shrink-0 w-full sm:w-44 h-28 rounded-xl overflow-hidden flex items-center justify-center" style="background:linear-gradient(135deg,rgba(37,99,235,0.1),rgba(37,99,235,0.03));">
                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="rgba(37,99,235,0.6)" stroke-width="1.5"><circle cx="12" cy="12" r="3"/><path d="M12 1v4M12 19v4M4.22 4.22l2.83 2.83M16.95 16.95l2.83 2.83M1 12h4M19 12h4M4.22 19.78l2.83-2.83M16.95 7.05l2.83-2.83"/></svg>
              </div>
              <div class="flex-1 min-w-0">
                <div class="flex flex-wrap items-center gap-2 mb-2">
                  <span class="badge-open font-body text-xs px-2.5 py-0.5 rounded-full">Buka</span>
                  <span class="font-body text-xs px-2.5 py-0.5 rounded-full" style="background:rgba(37,99,235,0.1);border:1px solid rgba(37,99,235,0.2);color:#93c5fd;">🤖 AI &amp; Data</span>
                  <span class="badge-free font-body text-xs px-2.5 py-0.5 rounded-full">Gratis</span>
                </div>
                <h3 class="font-display font-bold text-base leading-snug mb-1">Machine Learning in Production: Notebook → Deployment</h3>
                <p class="font-body text-xs text-gray-500 mb-3 line-clamp-1">Panduan lengkap membawa model ML dari eksperimen lokal ke sistem produksi yang stabil dan scalable.</p>
                <div class="flex flex-wrap items-center justify-between gap-3">
                  <div class="speaker-chip">
                    <img src="https://i.pravatar.cc/24?img=38" class="w-5 h-5 rounded-full" alt="">
                    <span class="font-body text-xs text-gray-400">Hana Pertiwi · ex-NASA, ML Engineer</span>
                  </div>
                  <div class="flex items-center gap-4">
                    <div class="text-xs text-gray-600 font-body flex items-center gap-1.5">
                      <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                      8 Mar · 09.00 — 12.00 WIB
                    </div>
                    <div class="text-xs font-body flex flex-col items-end">
                      <div class="seat-bar w-20 mb-1"><div class="seat-fill" style="width:18%;"></div></div>
                      <span class="text-xs text-gray-600 font-body">90/500 kursi</span>
                    </div>
                    <button class="btn-primary px-4 py-2 rounded-lg text-xs text-white font-body font-semibold whitespace-nowrap">Daftar →</button>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

        <!-- Empty state -->
        <div id="empty-state" class="hidden text-center py-20">
          <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4" style="background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.08);">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.2)" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
          </div>
          <p class="font-display font-semibold text-gray-600 mb-1">Tidak ada seminar ditemukan</p>
          <p class="font-body text-sm text-gray-700">Coba kata kunci atau filter lain</p>
        </div>

        <!-- PAGINATION -->
        <div class="flex items-center justify-between">
          <p class="font-body text-xs text-gray-700">Halaman 1 dari 8</p>
          <div class="flex items-center gap-2">
            <button class="page-btn" style="opacity:0.3;cursor:default;">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg>
            </button>
            <button class="page-btn active">1</button>
            <button class="page-btn">2</button>
            <button class="page-btn">3</button>
            <span class="font-body text-xs text-gray-700 px-1">…</span>
            <button class="page-btn">8</button>
            <button class="page-btn">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
            </button>
          </div>
        </div>

      </div><!-- /main -->
    </div><!-- /flex layout -->
  </div><!-- /content -->

  <!-- FOOTER -->
  <footer class="relative z-10 px-6 py-8" style="border-top:1px solid rgba(255,255,255,0.04);">
    <div class="max-w-6xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-4">
      <div class="flex items-center gap-2">
        <div class="w-6 h-6 rounded-lg btn-primary flex items-center justify-center">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
        </div>
        <span class="font-display font-bold text-sm">Open<span style="color:#f59e0b;">Skill</span></span>
      </div>
      <div class="flex items-center gap-6 text-xs text-gray-700 font-body">
        <a href="#" class="hover:text-gray-400 transition-colors">Tentang</a>
        <a href="#" class="hover:text-gray-400 transition-colors">Privasi</a>
        <a href="#" class="hover:text-gray-400 transition-colors">Kontak</a>
      </div>
      <p class="font-body text-xs text-gray-700">© {{ date('Y') }} OpenSkill.</p>
    </div>
  </footer>

  <script>
    let currentFilter = 'all';

    function setFilter(btn, filter) {
      currentFilter = filter;
      document.querySelectorAll('.chip').forEach(c => c.classList.remove('active'));
      document.querySelectorAll('.cat-item').forEach(c => c.classList.remove('active'));
      if (btn) btn.classList.add('active');
      filterCards();
    }

    function filterByDate(val) { /* date filter logic */ filterCards(); }

    function filterCards() {
      const search = document.getElementById('search-input').value.toLowerCase();
      const cards = document.querySelectorAll('#cards-list .seminar-card');
      let visible = 0;

      cards.forEach(card => {
        const status = card.dataset.status;
        const cat    = card.dataset.cat;
        const title  = card.dataset.title.toLowerCase();

        const matchFilter = currentFilter === 'all'
          || currentFilter === status
          || currentFilter === cat;
        const matchSearch = !search || title.includes(search);

        if (matchFilter && matchSearch) {
          card.style.display = '';
          visible++;
        } else {
          card.style.display = 'none';
        }
      });

      document.getElementById('empty-state').classList.toggle('hidden', visible > 0);
      document.getElementById('results-count').innerHTML =
        `Menampilkan <span class="text-white font-medium">${visible}</span> seminar`;
    }

    // Scroll reveal
    const observer = new IntersectionObserver(entries => {
      entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
    }, { threshold: 0.08 });
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

    // Live countdown (cosmetic)
    let mins = 154, secs = 0;
    setInterval(() => {
      if (secs === 0) { mins--; secs = 59; } else { secs--; }
      const el = document.querySelector('.countdown');
      if (el) el.textContent = `⏱ ${mins}m ${secs < 10 ? '0'+secs : secs}s tersisa`;
    }, 1000);
  </script>
</body>
</html>