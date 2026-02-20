<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Webinar — OpenSkill</title>
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
      0%, 100% { opacity: 0.5; transform: scale(1); }
      50%       { opacity: 0.85; transform: scale(1.06); }
    }
    @keyframes livePulse {
      0%, 100% { opacity: 1; box-shadow: 0 0 0 0 rgba(34,197,94,0.45); }
      50%       { opacity: 0.75; box-shadow: 0 0 0 7px rgba(34,197,94,0); }
    }
    @keyframes ticker {
      0%   { transform: translateX(0); }
      100% { transform: translateX(-50%); }
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
    .live-dot { width: 8px; height: 8px; background: #22c55e; border-radius: 50%; display: inline-block; animation: livePulse 1.5s ease-in-out infinite; }
    .text-glow { text-shadow: 0 0 36px rgba(251,191,36,0.38); }

    /* ── Ticker ── */
    .ticker-wrap { overflow: hidden; white-space: nowrap; }
    .ticker-inner { display: inline-block; animation: ticker 30s linear infinite; }

    /* ── Search bar ── */
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

    /* ── Webinar Cards ── */
    .webinar-card {
      transition: all 0.28s ease;
      cursor: pointer;
    }
    .webinar-card:hover { transform: translateY(-4px); }
    .webinar-card:hover { border-color: rgba(245,158,11,0.22) !important; }

    /* FEATURED card */
    .featured-card { position: relative; overflow: hidden; }
    .featured-card::before {
      content: '';
      position: absolute; inset: 0;
      background: linear-gradient(135deg, rgba(245,158,11,0.06) 0%, transparent 60%);
      pointer-events: none;
    }
    .featured-card .top-accent {
      position: absolute; top: 0; left: 0; right: 0; height: 2px;
      background: linear-gradient(90deg, #f59e0b, #d97706, transparent);
    }

    /* Status badges */
    .badge-live { background: rgba(34,197,94,0.12); border: 1px solid rgba(34,197,94,0.28); color: #4ade80; }
    .badge-upcoming { background: rgba(245,158,11,0.1); border: 1px solid rgba(245,158,11,0.25); color: #fbbf24; }
    .badge-recorded { background: rgba(99,102,241,0.12); border: 1px solid rgba(99,102,241,0.28); color: #a5b4fc; }

    /* Speaker avatar stack */
    .avatar-stack { display: flex; }
    .avatar-stack img { width: 28px; height: 28px; border-radius: 50%; object-fit: cover; border: 2px solid #0b0c10; margin-left: -8px; }
    .avatar-stack img:first-child { margin-left: 0; }

    /* Sidebar sticky */
    .sidebar { position: sticky; top: 110px; }

    /* Category sidebar item */
    .cat-item { display: flex; align-items: center; justify-content: space-between; padding: 10px 14px; border-radius: 10px; cursor: pointer; transition: all 0.18s; font-size: 0.85rem; }
    .cat-item:hover { background: rgba(255,255,255,0.04); color: white; }
    .cat-item.active { background: rgba(245,158,11,0.1); color: #f59e0b; }
    .cat-count { font-family: 'DM Mono', monospace; font-size: 0.72rem; color: rgba(255,255,255,0.25); }
    .cat-item.active .cat-count { color: rgba(245,158,11,0.6); }

    /* Scroll-reveal */
    .reveal { opacity: 0; transform: translateY(18px); transition: opacity 0.5s ease, transform 0.5s ease; }
    .reveal.visible { opacity: 1; transform: translateY(0); }

    /* Pagination */
    .page-btn { width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 0.85rem; transition: all 0.2s; cursor: pointer; font-family: 'DM Mono', monospace; }
    .page-btn.active { background: rgba(245,158,11,0.15); border: 1px solid rgba(245,158,11,0.3); color: #f59e0b; }
    .page-btn:not(.active) { border: 1px solid rgba(255,255,255,0.08); color: rgba(255,255,255,0.4); }
    .page-btn:not(.active):hover { border-color: rgba(245,158,11,0.3); color: #f59e0b; }
  </style>
</head>
<body class="min-h-screen">

  <!-- BG Orbs -->
  <div class="orb" style="width:500px;height:400px;background:rgba(245,158,11,0.07);top:-120px;right:-60px;animation:glowPulse 6s ease-in-out infinite;"></div>
  <div class="orb" style="width:300px;height:300px;background:rgba(99,102,241,0.05);bottom:300px;left:-80px;animation:glowPulse 8s ease-in-out infinite reverse;"></div>

  <!-- TICKER -->
  <div class="fixed top-0 left-0 right-0 z-40 py-2 ticker-wrap" style="background:rgba(245,158,11,0.04);border-bottom:1px solid rgba(245,158,11,0.09);">
    <div class="ticker-inner text-xs font-body" style="color:rgba(245,158,11,0.6);">
      <span class="px-8">🎯 Webinar UI/UX Design — Besok, 19.00 WIB</span>
      <span class="px-8">⚡ 1.200+ Peserta Aktif Minggu Ini</span>
      <span class="px-8">🚀 Seminar AI & Machine Learning — 25 Feb 2025</span>
      <span class="px-8">🌟 Instruktur Baru: Sarah Dewi, Ex-Google</span>
      <span class="px-8">🎓 Sertifikat Digital Tersedia untuk Semua Kelas</span>
      <span class="px-8">🎯 Webinar UI/UX Design — Besok, 19.00 WIB</span>
      <span class="px-8">⚡ 1.200+ Peserta Aktif Minggu Ini</span>
      <span class="px-8">🚀 Seminar AI & Machine Learning — 25 Feb 2025</span>
      <span class="px-8">🌟 Instruktur Baru: Sarah Dewi, Ex-Google</span>
      <span class="px-8">🎓 Sertifikat Digital Tersedia untuk Semua Kelas</span>
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
        <a href="#" class="hover:text-white transition-colors" style="color:#f59e0b;font-weight:600;">Webinar</a>
        <a href="#" class="hover:text-white transition-colors">Seminar</a>
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
      <div class="flex flex-wrap items-end justify-between gap-4 mb-6">
        <div>
          <span class="font-body text-xs uppercase tracking-widest mb-2 block" style="color:rgba(245,158,11,0.7);">Live &amp; On-Demand</span>
          <h1 class="font-display font-extrabold tracking-tight text-glow" style="font-size:clamp(2rem,5vw,3.4rem);line-height:1;">
            Semua Webinar
          </h1>
          <p class="font-body text-gray-500 text-sm mt-2">Temukan sesi live, replay, dan yang akan datang — semuanya gratis.</p>
        </div>

        <!-- Live count pill -->
        <div class="card-glass rounded-xl px-5 py-3 flex items-center gap-3">
          <div class="live-dot"></div>
          <div>
            <p class="font-display font-bold text-lg" style="color:#4ade80;">8</p>
            <p class="font-body text-xs text-gray-600">Sesi Live Sekarang</p>
          </div>
        </div>
      </div>

      <!-- Search -->
      <div class="relative max-w-xl">
        <svg class="absolute left-14px top-1/2 -translate-y-1/2 text-gray-600" style="left:14px;" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
        <input type="text" id="search-input" placeholder="Cari webinar, topik, atau instruktur…" class="search-field" oninput="filterCards()">
      </div>
    </div>

    <!-- FILTER CHIPS -->
    <div class="flex flex-wrap gap-2 mb-10 stagger-2">
      <button class="chip active" data-filter="all" onclick="setFilter(this,'all')">Semua</button>
      <button class="chip" data-filter="live" onclick="setFilter(this,'live')">
        <span class="flex items-center gap-1.5"><span class="live-dot" style="width:6px;height:6px;"></span> Live Sekarang</span>
      </button>
      <button class="chip" data-filter="upcoming" onclick="setFilter(this,'upcoming')">Mendatang</button>
      <button class="chip" data-filter="recorded" onclick="setFilter(this,'recorded')">Rekaman</button>
      <div class="w-px mx-1" style="background:rgba(255,255,255,0.08);"></div>
      <button class="chip" data-filter="teknologi" onclick="setFilter(this,'teknologi')">💻 Teknologi</button>
      <button class="chip" data-filter="desain" onclick="setFilter(this,'desain')">🎨 Desain</button>
      <button class="chip" data-filter="bisnis" onclick="setFilter(this,'bisnis')">📊 Bisnis</button>
      <button class="chip" data-filter="ai" onclick="setFilter(this,'ai')">🤖 AI &amp; Data</button>
      <button class="chip" data-filter="mobile" onclick="setFilter(this,'mobile')">📱 Mobile</button>
    </div>

    <!-- CONTENT: Sidebar + Grid -->
    <div class="flex gap-8">

      <!-- LEFT SIDEBAR -->
      <aside class="hidden xl:block w-56 flex-shrink-0">
        <div class="sidebar">
          <div class="card-glass rounded-2xl p-4 mb-5">
            <p class="font-body text-xs text-gray-600 uppercase tracking-widest mb-3">Kategori</p>
            <div class="space-y-0.5">
              <div class="cat-item active font-body text-sm text-gray-400" onclick="setFilter(null,'all')">
                <span>Semua Topik</span><span class="cat-count">134</span>
              </div>
              <div class="cat-item font-body text-sm text-gray-400" onclick="setFilter(null,'teknologi')">
                <span>💻 Teknologi</span><span class="cat-count">48</span>
              </div>
              <div class="cat-item font-body text-sm text-gray-400" onclick="setFilter(null,'desain')">
                <span>🎨 Desain</span><span class="cat-count">31</span>
              </div>
              <div class="cat-item font-body text-sm text-gray-400" onclick="setFilter(null,'bisnis')">
                <span>📊 Bisnis</span><span class="cat-count">22</span>
              </div>
              <div class="cat-item font-body text-sm text-gray-400" onclick="setFilter(null,'ai')">
                <span>🤖 AI &amp; Data</span><span class="cat-count">19</span>
              </div>
              <div class="cat-item font-body text-sm text-gray-400" onclick="setFilter(null,'mobile')">
                <span>📱 Mobile Dev</span><span class="cat-count">14</span>
              </div>
            </div>
          </div>

          <!-- Sort -->
          <div class="card-glass rounded-2xl p-4 mb-5">
            <p class="font-body text-xs text-gray-600 uppercase tracking-widest mb-3">Urutkan</p>
            <div class="space-y-1">
              <label class="flex items-center gap-2 cursor-pointer py-1.5">
                <input type="radio" name="sort" value="newest" checked class="accent-amber-500">
                <span class="font-body text-sm text-gray-400">Terbaru</span>
              </label>
              <label class="flex items-center gap-2 cursor-pointer py-1.5">
                <input type="radio" name="sort" value="popular" class="accent-amber-500">
                <span class="font-body text-sm text-gray-400">Terpopuler</span>
              </label>
              <label class="flex items-center gap-2 cursor-pointer py-1.5">
                <input type="radio" name="sort" value="az" class="accent-amber-500">
                <span class="font-body text-sm text-gray-400">A – Z</span>
              </label>
            </div>
          </div>

          <!-- Upcoming mini -->
          <div class="card-glass rounded-2xl p-4">
            <p class="font-body text-xs text-gray-600 uppercase tracking-widest mb-3">Jadwal Hari Ini</p>
            <div class="space-y-3">
              <div class="flex items-start gap-2.5">
                <div class="w-1 h-full min-h-[32px] rounded-full flex-shrink-0" style="background:#f59e0b;"></div>
                <div>
                  <p class="font-body text-xs font-medium text-white">PM Framework Modern</p>
                  <p class="font-body text-xs text-gray-600">19.00 — Kevin R.</p>
                </div>
              </div>
              <div class="flex items-start gap-2.5">
                <div class="w-1 min-h-[32px] rounded-full flex-shrink-0" style="background:#7c3aed;"></div>
                <div>
                  <p class="font-body text-xs font-medium text-white">Python & Pandas</p>
                  <p class="font-body text-xs text-gray-600">21.00 — Budi S.</p>
                </div>
              </div>
              <div class="flex items-start gap-2.5">
                <div class="w-1 min-h-[32px] rounded-full flex-shrink-0" style="background:#2563eb;"></div>
                <div>
                  <p class="font-body text-xs font-medium text-white">Cybersecurity 101</p>
                  <p class="font-body text-xs text-gray-600">22.00 — Rafi A.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </aside>

      <!-- MAIN GRID -->
      <div class="flex-1 min-w-0">

        <!-- FEATURED / LIVE CARD -->
        <div class="featured-card card-glass rounded-2xl p-6 mb-6 reveal webinar-card" data-status="live" data-cat="bisnis" data-title="Dari Ide ke Produk: Framework PM Modern">
          <div class="top-accent"></div>
          <div class="flex flex-col md:flex-row gap-6">
            <!-- Thumbnail -->
            <div class="flex-shrink-0 w-full md:w-52 h-36 rounded-xl overflow-hidden relative" style="background:linear-gradient(135deg,rgba(245,158,11,0.15),rgba(245,158,11,0.04));">
              <div class="absolute inset-0 flex items-center justify-center">
                <div class="w-14 h-14 rounded-full flex items-center justify-center" style="background:rgba(245,158,11,0.15);border:2px solid rgba(245,158,11,0.3);">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                </div>
              </div>
              <!-- Live viewers overlay -->
              <div class="absolute bottom-2 left-2 flex items-center gap-1.5 px-2 py-1 rounded-lg" style="background:rgba(0,0,0,0.6);backdrop-filter:blur(8px);">
                <div class="live-dot" style="width:6px;height:6px;"></div>
                <span class="font-body text-xs text-white">1.240 menonton</span>
              </div>
            </div>

            <div class="flex-1 min-w-0">
              <div class="flex flex-wrap items-center gap-2 mb-3">
                <span class="badge-live font-body text-xs px-3 py-1 rounded-full flex items-center gap-1.5">
                  <div class="live-dot" style="width:6px;height:6px;"></div>LIVE SEKARANG
                </span>
                <span class="badge-pill font-body text-xs px-3 py-1 rounded-full" style="color:#f59e0b;">Product Management</span>
                <span class="ml-auto font-body text-xs text-gray-600">Gratis</span>
              </div>

              <h2 class="font-display font-bold text-xl leading-snug mb-2">Dari Ide ke Produk: Framework PM Modern</h2>
              <p class="font-body text-sm text-gray-500 mb-4 line-clamp-2">Pelajari framework product thinking yang digunakan para PM top Indonesia untuk mengubah ide mentah menjadi produk nyata yang disukai pengguna.</p>

              <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                  <img src="https://i.pravatar.cc/36?img=11" class="w-9 h-9 rounded-full object-cover" style="border:2px solid rgba(245,158,11,0.3);" alt="">
                  <div>
                    <p class="font-body text-sm font-medium text-white">Kevin Rahardian</p>
                    <p class="font-body text-xs text-gray-600">Senior PM · Tokopedia</p>
                  </div>
                </div>
                <div class="flex items-center gap-3">
                  <div class="flex items-center gap-1.5 text-xs text-gray-600 font-body">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                    19.00 — 21.00 WIB
                  </div>
                  <button class="btn-primary px-5 py-2 rounded-lg text-white text-sm font-body font-semibold">Gabung Live →</button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- RESULTS META -->
        <div class="flex items-center justify-between mb-5">
          <p class="font-body text-sm text-gray-600" id="results-count">Menampilkan <span class="text-white font-medium">134</span> webinar</p>
          <div class="flex items-center gap-2">
            <button class="page-btn active" style="width:auto;padding:0 12px;border-radius:8px;font-family:'DM Sans',sans-serif;font-size:0.78rem;" onclick="toggleView('grid')" id="view-grid">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
            </button>
            <button class="page-btn" style="width:auto;padding:0 12px;border-radius:8px;" onclick="toggleView('list')" id="view-list">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
            </button>
          </div>
        </div>

        <!-- WEBINAR CARDS GRID -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4 mb-8" id="cards-grid">

          <!-- Card 1 -->
          <div class="webinar-card card-glass rounded-2xl p-5 reveal" data-status="upcoming" data-cat="desain" data-title="Designing for Accessibility di 2025" style="border:1px solid rgba(255,255,255,0.06);">
            <div class="h-28 rounded-xl mb-4 flex items-center justify-center relative overflow-hidden" style="background:linear-gradient(135deg,rgba(124,58,237,0.12),rgba(124,58,237,0.04));">
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="rgba(124,58,237,0.6)" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
              <div class="absolute top-2 right-2">
                <span class="badge-upcoming font-body text-xs px-2.5 py-1 rounded-full">Mendatang</span>
              </div>
            </div>
            <span class="font-body text-xs px-2.5 py-1 rounded-full mb-3 inline-block" style="background:rgba(124,58,237,0.1);border:1px solid rgba(124,58,237,0.25);color:#a5b4fc;">🎨 Desain</span>
            <h3 class="font-display font-semibold text-base leading-snug mb-2">Designing for Accessibility di 2025</h3>
            <p class="font-body text-xs text-gray-600 mb-4 line-clamp-2">Panduan lengkap membuat produk digital yang inklusif dan ramah untuk semua pengguna.</p>
            <div class="flex items-center gap-2 mb-4">
              <img src="https://i.pravatar.cc/30?img=5" class="w-7 h-7 rounded-full object-cover" alt="">
              <div>
                <p class="font-body text-xs font-medium text-white">Sari Nuraini</p>
                <p class="font-body text-xs text-gray-600">Design Lead · Gojek</p>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <div class="flex items-center gap-1.5 text-xs text-gray-600 font-body">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                22 Feb · 14.00 WIB
              </div>
              <button class="btn-ghost px-3.5 py-1.5 rounded-lg text-xs text-gray-400 font-body">Daftar →</button>
            </div>
          </div>

          <!-- Card 2 -->
          <div class="webinar-card card-glass rounded-2xl p-5 reveal" data-status="upcoming" data-cat="ai" data-title="Analitik Data dengan Python dan Pandas" style="border:1px solid rgba(255,255,255,0.06);">
            <div class="h-28 rounded-xl mb-4 flex items-center justify-center relative overflow-hidden" style="background:linear-gradient(135deg,rgba(37,99,235,0.12),rgba(37,99,235,0.04));">
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="rgba(37,99,235,0.7)" stroke-width="1.5"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
              <div class="absolute top-2 right-2">
                <span class="badge-upcoming font-body text-xs px-2.5 py-1 rounded-full">Mendatang</span>
              </div>
            </div>
            <span class="font-body text-xs px-2.5 py-1 rounded-full mb-3 inline-block" style="background:rgba(37,99,235,0.1);border:1px solid rgba(37,99,235,0.25);color:#93c5fd;">🤖 AI &amp; Data</span>
            <h3 class="font-display font-semibold text-base leading-snug mb-2">Analitik Data dengan Python &amp; Pandas</h3>
            <p class="font-body text-xs text-gray-600 mb-4 line-clamp-2">Kuasai dasar-dasar analitik data menggunakan Python dan Pandas dari nol hingga siap kerja.</p>
            <div class="flex items-center gap-2 mb-4">
              <img src="https://i.pravatar.cc/30?img=8" class="w-7 h-7 rounded-full object-cover" alt="">
              <div>
                <p class="font-body text-xs font-medium text-white">Budi Santoso</p>
                <p class="font-body text-xs text-gray-600">Data Engineer · Bukalapak</p>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <div class="flex items-center gap-1.5 text-xs text-gray-600 font-body">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                25 Feb · 10.00 WIB
              </div>
              <button class="btn-ghost px-3.5 py-1.5 rounded-lg text-xs text-gray-400 font-body">Daftar →</button>
            </div>
          </div>

          <!-- Card 3 -->
          <div class="webinar-card card-glass rounded-2xl p-5 reveal" data-status="recorded" data-cat="teknologi" data-title="Next.js 14 Full Course untuk Pemula" style="border:1px solid rgba(255,255,255,0.06);">
            <div class="h-28 rounded-xl mb-4 flex items-center justify-center relative overflow-hidden" style="background:linear-gradient(135deg,rgba(16,185,129,0.1),rgba(16,185,129,0.03));">
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="rgba(16,185,129,0.7)" stroke-width="1.5"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2" ry="2"/></svg>
              <div class="absolute top-2 right-2">
                <span class="badge-recorded font-body text-xs px-2.5 py-1 rounded-full">Rekaman</span>
              </div>
              <!-- Duration badge -->
              <div class="absolute bottom-2 right-2 px-2 py-0.5 rounded font-body text-xs text-white" style="background:rgba(0,0,0,0.6);">2j 14m</div>
            </div>
            <span class="font-body text-xs px-2.5 py-1 rounded-full mb-3 inline-block" style="background:rgba(16,185,129,0.1);border:1px solid rgba(16,185,129,0.2);color:#6ee7b7;">💻 Teknologi</span>
            <h3 class="font-display font-semibold text-base leading-snug mb-2">Next.js 14 Full Course untuk Pemula</h3>
            <p class="font-body text-xs text-gray-600 mb-4 line-clamp-2">Belajar membangun aplikasi web modern dengan Next.js 14, dari routing hingga server actions.</p>
            <div class="flex items-center gap-2 mb-4">
              <img src="https://i.pravatar.cc/30?img=3" class="w-7 h-7 rounded-full object-cover" alt="">
              <div>
                <p class="font-body text-xs font-medium text-white">Rizky Firmansyah</p>
                <p class="font-body text-xs text-gray-600">Frontend Lead · Ruangguru</p>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <div class="flex items-center gap-1.5 text-xs text-gray-600 font-body">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                4.8K ditonton
              </div>
              <button class="btn-ghost px-3.5 py-1.5 rounded-lg text-xs text-gray-400 font-body">Tonton →</button>
            </div>
          </div>

          <!-- Card 4 -->
          <div class="webinar-card card-glass rounded-2xl p-5 reveal" data-status="live" data-cat="bisnis" data-title="Growth Hacking untuk Startup" style="border:1px solid rgba(255,255,255,0.06);">
            <div class="h-28 rounded-xl mb-4 flex items-center justify-center relative overflow-hidden" style="background:linear-gradient(135deg,rgba(245,158,11,0.1),rgba(245,158,11,0.03));">
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="rgba(245,158,11,0.7)" stroke-width="1.5"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
              <div class="absolute top-2 right-2">
                <span class="badge-live font-body text-xs px-2.5 py-1 rounded-full flex items-center gap-1">
                  <div class="live-dot" style="width:5px;height:5px;"></div>LIVE
                </span>
              </div>
              <div class="absolute bottom-2 left-2 px-2 py-0.5 rounded text-xs text-white font-body" style="background:rgba(0,0,0,0.55);">380 menonton</div>
            </div>
            <span class="badge-pill font-body text-xs px-2.5 py-1 rounded-full mb-3 inline-block" style="color:#f59e0b;">📊 Bisnis</span>
            <h3 class="font-display font-semibold text-base leading-snug mb-2">Growth Hacking untuk Startup Tahap Awal</h3>
            <p class="font-body text-xs text-gray-600 mb-4 line-clamp-2">Strategi pertumbuhan yang telah terbukti untuk startup yang baru memulai perjalanannya.</p>
            <div class="flex items-center gap-2 mb-4">
              <img src="https://i.pravatar.cc/30?img=15" class="w-7 h-7 rounded-full object-cover" alt="">
              <div>
                <p class="font-body text-xs font-medium text-white">Maya Kusuma</p>
                <p class="font-body text-xs text-gray-600">Co-founder · StartupID</p>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <div class="flex items-center gap-1.5 text-xs font-body" style="color:#4ade80;">
                <div class="live-dot" style="width:6px;height:6px;"></div>
                Sedang berlangsung
              </div>
              <button class="btn-primary px-3.5 py-1.5 rounded-lg text-xs text-white font-body font-medium">Gabung →</button>
            </div>
          </div>

          <!-- Card 5 -->
          <div class="webinar-card card-glass rounded-2xl p-5 reveal" data-status="recorded" data-cat="desain" data-title="Figma Advanced Components Workshop" style="border:1px solid rgba(255,255,255,0.06);">
            <div class="h-28 rounded-xl mb-4 flex items-center justify-center relative overflow-hidden" style="background:linear-gradient(135deg,rgba(244,63,94,0.1),rgba(244,63,94,0.03));">
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="rgba(244,63,94,0.7)" stroke-width="1.5"><path d="M5 5.5A3.5 3.5 0 0 1 8.5 2H12v7H8.5A3.5 3.5 0 0 1 5 5.5z"/><path d="M12 2h3.5a3.5 3.5 0 1 1 0 7H12V2z"/><path d="M12 12.5a3.5 3.5 0 1 1 7 0 3.5 3.5 0 1 1-7 0z"/><path d="M5 19.5A3.5 3.5 0 0 1 8.5 16H12v3.5a3.5 3.5 0 1 1-7 0z"/><path d="M5 12.5A3.5 3.5 0 0 1 8.5 9H12v7H8.5A3.5 3.5 0 0 1 5 12.5z"/></svg>
              <div class="absolute top-2 right-2">
                <span class="badge-recorded font-body text-xs px-2.5 py-1 rounded-full">Rekaman</span>
              </div>
              <div class="absolute bottom-2 right-2 px-2 py-0.5 rounded font-body text-xs text-white" style="background:rgba(0,0,0,0.6);">1j 45m</div>
            </div>
            <span class="font-body text-xs px-2.5 py-1 rounded-full mb-3 inline-block" style="background:rgba(244,63,94,0.1);border:1px solid rgba(244,63,94,0.2);color:#fda4af;">🎨 Desain</span>
            <h3 class="font-display font-semibold text-base leading-snug mb-2">Figma Advanced Components Workshop</h3>
            <p class="font-body text-xs text-gray-600 mb-4 line-clamp-2">Kuasai auto-layout, variants, dan component properties untuk membangun design system yang scalable.</p>
            <div class="flex items-center gap-2 mb-4">
              <img src="https://i.pravatar.cc/30?img=20" class="w-7 h-7 rounded-full object-cover" alt="">
              <div>
                <p class="font-body text-xs font-medium text-white">Dina Pratiwi</p>
                <p class="font-body text-xs text-gray-600">Senior Designer · Shopee</p>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <div class="flex items-center gap-1.5 text-xs text-gray-600 font-body">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                6.1K ditonton
              </div>
              <button class="btn-ghost px-3.5 py-1.5 rounded-lg text-xs text-gray-400 font-body">Tonton →</button>
            </div>
          </div>

          <!-- Card 6 -->
          <div class="webinar-card card-glass rounded-2xl p-5 reveal" data-status="upcoming" data-cat="mobile" data-title="Flutter untuk Pemula Membangun Aplikasi Pertama" style="border:1px solid rgba(255,255,255,0.06);">
            <div class="h-28 rounded-xl mb-4 flex items-center justify-center relative overflow-hidden" style="background:linear-gradient(135deg,rgba(6,182,212,0.1),rgba(6,182,212,0.03));">
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="rgba(6,182,212,0.7)" stroke-width="1.5"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
              <div class="absolute top-2 right-2">
                <span class="badge-upcoming font-body text-xs px-2.5 py-1 rounded-full">Mendatang</span>
              </div>
            </div>
            <span class="font-body text-xs px-2.5 py-1 rounded-full mb-3 inline-block" style="background:rgba(6,182,212,0.1);border:1px solid rgba(6,182,212,0.2);color:#67e8f9;">📱 Mobile Dev</span>
            <h3 class="font-display font-semibold text-base leading-snug mb-2">Flutter: Membangun Aplikasi Pertamamu</h3>
            <p class="font-body text-xs text-gray-600 mb-4 line-clamp-2">Bangun aplikasi mobile cross-platform pertamamu dengan Flutter dari nol dalam satu sesi.</p>
            <div class="flex items-center gap-2 mb-4">
              <img src="https://i.pravatar.cc/30?img=33" class="w-7 h-7 rounded-full object-cover" alt="">
              <div>
                <p class="font-body text-xs font-medium text-white">Aryo Wicaksono</p>
                <p class="font-body text-xs text-gray-600">Mobile Dev · Traveloka</p>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <div class="flex items-center gap-1.5 text-xs text-gray-600 font-body">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                28 Feb · 13.00 WIB
              </div>
              <button class="btn-ghost px-3.5 py-1.5 rounded-lg text-xs text-gray-400 font-body">Daftar →</button>
            </div>
          </div>

        </div>

        <!-- Empty State -->
        <div id="empty-state" class="hidden text-center py-20">
          <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4" style="background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.08);">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.2)" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
          </div>
          <p class="font-display font-semibold text-gray-600 mb-1">Tidak ada webinar ditemukan</p>
          <p class="font-body text-sm text-gray-700">Coba kata kunci atau filter lain</p>
        </div>

        <!-- PAGINATION -->
        <div class="flex items-center justify-between">
          <p class="font-body text-xs text-gray-700">Halaman 1 dari 12</p>
          <div class="flex items-center gap-2">
            <button class="page-btn" style="opacity:0.3;cursor:default;">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg>
            </button>
            <button class="page-btn active">1</button>
            <button class="page-btn">2</button>
            <button class="page-btn">3</button>
            <span class="font-body text-xs text-gray-700 px-1">…</span>
            <button class="page-btn">12</button>
            <button class="page-btn">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
            </button>
          </div>
        </div>

      </div><!-- /main grid -->
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

    function filterCards() {
      const search = document.getElementById('search-input').value.toLowerCase();
      const cards = document.querySelectorAll('#cards-grid .webinar-card');
      let visible = 0;

      cards.forEach(card => {
        const status = card.dataset.status;
        const cat = card.dataset.cat;
        const title = card.dataset.title.toLowerCase();

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
        `Menampilkan <span class="text-white font-medium">${visible}</span> webinar`;
    }

    function toggleView(mode) {
      const grid = document.getElementById('cards-grid');
      const btnGrid = document.getElementById('view-grid');
      const btnList = document.getElementById('view-list');
      if (mode === 'grid') {
        grid.className = 'grid md:grid-cols-2 lg:grid-cols-3 gap-4 mb-8';
        btnGrid.classList.add('active'); btnList.classList.remove('active');
      } else {
        grid.className = 'flex flex-col gap-4 mb-8';
        btnList.classList.add('active'); btnGrid.classList.remove('active');
      }
    }

    // Scroll reveal
    const observer = new IntersectionObserver(entries => {
      entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
    }, { threshold: 0.1 });
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
  </script>
</body>
</html>