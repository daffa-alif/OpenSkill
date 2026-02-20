<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profil — OpenSkill</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet" />
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: { display: ['Syne', 'sans-serif'], body: ['DM Sans', 'sans-serif'] },
          colors: { ink: '#0b0c10', panel: '#111318', amber: { vivid: '#f59e0b', glow: '#fbbf24' } }
        }
      }
    }
  </script>
  <style>
    * { box-sizing: border-box; }
    body { background-color: #0b0c10; font-family: 'DM Sans', sans-serif; overflow-x: hidden; }
    body::before {
      content: ''; position: fixed; inset: 0;
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.03'/%3E%3C/svg%3E");
      pointer-events: none; z-index: 0; opacity: 0.4;
    }
    .orb { border-radius: 50%; filter: blur(80px); position: absolute; pointer-events: none; }
    .card-glass { background: rgba(17,19,24,0.7); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.06); }
    .badge-pill { background: rgba(245,158,11,0.12); border: 1px solid rgba(245,158,11,0.3); }
    .btn-primary { background: linear-gradient(135deg, #f59e0b, #d97706); transition: all 0.3s ease; box-shadow: 0 4px 20px rgba(245,158,11,0.3); }
    .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 30px rgba(245,158,11,0.45); }
    .btn-ghost { border: 1px solid rgba(255,255,255,0.12); transition: all 0.3s ease; }
    .btn-ghost:hover { border-color: rgba(245,158,11,0.4); color: #fbbf24; }
    .text-glow { text-shadow: 0 0 40px rgba(251,191,36,0.4); }
    .nav-blur { background: rgba(11,12,16,0.85); backdrop-filter: blur(20px); border-bottom: 1px solid rgba(255,255,255,0.05); }
    .input-field {
      width: 100%; padding: 12px 14px 12px 44px;
      background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08);
      border-radius: 12px; color: white; font-family: 'DM Sans', sans-serif;
      font-size: 0.9rem; outline: none;
      transition: border-color 0.2s, box-shadow 0.2s;
    }
    .input-field:focus { border-color: rgba(245,158,11,0.5); box-shadow: 0 0 0 3px rgba(245,158,11,0.08); }
    .input-field::placeholder { color: rgba(255,255,255,0.2); }
    .input-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: rgba(255,255,255,0.22); pointer-events: none; }
    .input-icon-top { position: absolute; left: 14px; top: 14px; color: rgba(255,255,255,0.22); pointer-events: none; }
    .textarea-field {
      width: 100%; padding: 12px 14px 12px 44px;
      background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08);
      border-radius: 12px; color: white; font-family: 'DM Sans', sans-serif;
      font-size: 0.9rem; outline: none; resize: none; min-height: 90px;
      transition: border-color 0.2s, box-shadow 0.2s;
    }
    .textarea-field:focus { border-color: rgba(245,158,11,0.5); box-shadow: 0 0 0 3px rgba(245,158,11,0.08); }
    .textarea-field::placeholder { color: rgba(255,255,255,0.2); }
    .live-dot { width: 8px; height: 8px; background: #22c55e; border-radius: 50%; animation: livePulse 1.5s ease-in-out infinite; }
    @keyframes livePulse {
      0%, 100% { opacity: 1; box-shadow: 0 0 0 0 rgba(34,197,94,0.4); }
      50% { opacity: 0.8; box-shadow: 0 0 0 6px rgba(34,197,94,0); }
    }
    @keyframes fadeUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes glowPulse { 0%, 100% { opacity: 0.5; transform: scale(1); } 50% { opacity: 0.9; transform: scale(1.08); } }
    @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }
    .stagger-1 { animation: fadeUp 0.6s 0.05s ease forwards; opacity: 0; }
    .stagger-2 { animation: fadeUp 0.6s 0.15s ease forwards; opacity: 0; }
    .stagger-3 { animation: fadeUp 0.6s 0.25s ease forwards; opacity: 0; }
    .stagger-4 { animation: fadeUp 0.6s 0.35s ease forwards; opacity: 0; }
    .stat-card { transition: all 0.3s ease; }
    .stat-card:hover { border-color: rgba(245,158,11,0.3) !important; transform: translateY(-3px); }
    .line-accent { background: linear-gradient(90deg, transparent, rgba(245,158,11,0.4), transparent); height: 1px; }
    .nav-link { transition: color 0.2s; }
    .nav-link:hover { color: white; }
    .nav-link.active { color: #f59e0b; }

    /* Tab system */
    .tab-btn { padding: 10px 20px; border-radius: 10px; font-family: 'DM Sans', sans-serif; font-size: 0.85rem; font-weight: 500; transition: all 0.2s; color: rgba(255,255,255,0.4); cursor: pointer; border: none; background: transparent; }
    .tab-btn.active { background: rgba(245,158,11,0.1); color: #f59e0b; border: 1px solid rgba(245,158,11,0.25); }
    .tab-btn:not(.active):hover { color: rgba(255,255,255,0.7); }
    .tab-panel { display: none; }
    .tab-panel.active { display: block; }

    /* Avatar upload */
    .avatar-upload-zone { cursor: pointer; transition: border-color 0.2s; }
    .avatar-upload-zone:hover { border-color: rgba(245,158,11,0.4) !important; }

    /* Progress bars */
    .prog-bar { height: 4px; border-radius: 2px; background: rgba(255,255,255,0.06); overflow: hidden; }
    .prog-fill { height: 100%; border-radius: 2px; }

    /* Ticker */
    .ticker-wrap { overflow: hidden; white-space: nowrap; }
    .ticker-inner { display: inline-block; animation: ticker 30s linear infinite; }
    @keyframes ticker { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
  </style>
</head>
<body class="min-h-screen text-white relative">

  <!-- BG ORBS -->
  <div class="orb" style="width:600px;height:400px;background:rgba(245,158,11,0.06);top:-80px;right:-80px;animation:glowPulse 6s ease-in-out infinite;"></div>
  <div class="orb" style="width:350px;height:350px;background:rgba(139,92,246,0.04);bottom:200px;left:-60px;animation:glowPulse 8s ease-in-out infinite reverse;"></div>

  <!-- TICKER -->
  <div class="fixed top-0 left-0 right-0 z-40 py-2 text-xs font-body ticker-wrap" style="background:rgba(245,158,11,0.05);border-bottom:1px solid rgba(245,158,11,0.1);">
    <div class="ticker-inner text-amber-vivid/60">
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
        <div class="w-8 h-8 rounded-lg btn-primary flex items-center justify-center">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
            <path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/>
          </svg>
        </div>
        <span class="font-display font-bold text-lg tracking-tight">Open<span class="text-amber-vivid">Skill</span></span>
      </a>

      <!-- Nav links -->
      <div class="hidden md:flex items-center gap-8 text-sm text-gray-500 font-body">
        <a href="#" class="nav-link">Eksplorasi</a>
        <a href="#" class="nav-link">Webinar</a>
        <a href="#" class="nav-link">Seminar</a>
        <a href="#" class="nav-link">Komunitas</a>
        <a href="{{ route('profile.welcome') }}" class="nav-link active font-medium">Profil</a>
      </div>

      <!-- User menu -->
      <div class="flex items-center gap-3">
        <div class="flex items-center gap-2.5">
          <div class="w-8 h-8 rounded-full overflow-hidden flex items-center justify-center"
               style="background:rgba(245,158,11,0.15);border:1px solid rgba(245,158,11,0.25);">
            @if (Auth::user()->profile_picture)
              <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" class="w-full h-full object-cover" alt="">
            @else
              <span class="font-display font-bold text-sm text-amber-vivid">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
            @endif
          </div>
          <span class="font-body text-sm text-gray-300 hidden sm:block">{{ Str::words(Auth::user()->name, 1, '') }}</span>
        </div>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn-ghost px-4 py-2 rounded-lg text-gray-400 text-sm font-body">Keluar</button>
        </form>
      </div>
    </div>
  </nav>

  <!-- PAGE CONTENT -->
  <main class="relative z-10 max-w-6xl mx-auto px-6 pt-36 pb-20">

    <!-- SUCCESS TOAST -->
    @if (session('success'))
      <div class="card-glass rounded-xl px-5 py-4 mb-6 flex items-center gap-3 stagger-1" style="border:1px solid rgba(34,197,94,0.2);">
        <div class="w-7 h-7 rounded-lg flex items-center justify-center flex-shrink-0" style="background:rgba(34,197,94,0.1);">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
        </div>
        <p class="font-body text-sm text-green-400 font-medium">{{ session('success') }}</p>
      </div>
    @endif

    <!-- PROFILE HERO CARD -->
    <div class="card-glass rounded-3xl p-8 mb-6 stagger-1 relative overflow-hidden" style="border:1px solid rgba(255,255,255,0.07);">
      <!-- top accent line -->
      <div class="absolute top-0 left-0 right-0 h-px" style="background:linear-gradient(90deg, transparent, rgba(245,158,11,0.5), transparent);"></div>
      <div class="orb" style="width:300px;height:200px;background:rgba(245,158,11,0.05);top:-60px;right:-40px;filter:blur(50px);"></div>

      <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6 relative">
        <!-- Avatar -->
        <div class="relative flex-shrink-0">
          <div class="w-20 h-20 md:w-24 md:h-24 rounded-2xl overflow-hidden flex items-center justify-center"
               style="border:2px solid rgba(245,158,11,0.25);background:rgba(245,158,11,0.08);">
            @if (Auth::user()->profile_picture)
              <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" class="w-full h-full object-cover" alt="{{ Auth::user()->name }}">
            @else
              <span class="font-display font-extrabold text-3xl text-amber-vivid">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
            @endif
          </div>
          <div class="absolute -bottom-1 -right-1 flex items-center justify-center">
            <div class="live-dot" style="width:10px;height:10px;border:2px solid #0b0c10;"></div>
          </div>
        </div>

        <!-- Info -->
        <div class="flex-1 min-w-0">
          <div class="flex flex-wrap items-center gap-3 mb-1">
            <h1 class="font-display font-bold text-2xl md:text-3xl tracking-tight">{{ Auth::user()->name }}</h1>
            <span class="badge-pill text-amber-vivid text-xs font-body px-3 py-1 rounded-full">Member</span>
          </div>
          <p class="font-body text-sm text-gray-600 mb-3" style="font-family:'DM Mono',monospace;">{{ Auth::user()->email }}</p>
          @if (Auth::user()->description)
            <p class="font-body text-sm text-gray-400 leading-relaxed max-w-xl">{{ Auth::user()->description }}</p>
          @else
            <p class="font-body text-sm text-gray-700 italic">Belum ada deskripsi — tambahkan di bawah!</p>
          @endif

          <!-- Meta badges -->
          <div class="flex flex-wrap gap-3 mt-4">
            <span class="flex items-center gap-1.5 text-xs text-gray-600 font-body">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
              Bergabung {{ Auth::user()->created_at->translatedFormat('M Y') ?? Auth::user()->created_at->format('M Y') }}
            </span>
            <span class="flex items-center gap-1.5 text-xs text-gray-600 font-body">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
              Terakhir update {{ Auth::user()->updated_at->diffForHumans() }}
            </span>
          </div>
        </div>

        <!-- Edit profile trigger -->
        <div class="flex-shrink-0">
          <button onclick="switchTab('settings')" class="btn-primary px-5 py-2.5 rounded-xl text-white font-body text-sm font-medium flex items-center gap-2">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
            Edit Profil
          </button>
        </div>
      </div>
    </div>

    <!-- STATS ROW -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6 stagger-2">
      <div class="stat-card card-glass rounded-2xl p-5 cursor-default" style="border:1px solid rgba(255,255,255,0.06);">
        <p class="font-display font-bold text-2xl text-amber-vivid">12</p>
        <p class="font-body text-xs text-gray-600 mt-1">Event Diikuti</p>
      </div>
      <div class="stat-card card-glass rounded-2xl p-5 cursor-default" style="border:1px solid rgba(255,255,255,0.06);">
        <p class="font-display font-bold text-2xl text-white">5</p>
        <p class="font-body text-xs text-gray-600 mt-1">Sertifikat</p>
      </div>
      <div class="stat-card card-glass rounded-2xl p-5 cursor-default" style="border:1px solid rgba(255,255,255,0.06);">
        <p class="font-display font-bold text-2xl text-white">38h</p>
        <p class="font-body text-xs text-gray-600 mt-1">Jam Belajar</p>
      </div>
      <div class="stat-card card-glass rounded-2xl p-5 cursor-default" style="border:1px solid rgba(255,255,255,0.06);">
        <p class="font-display font-bold text-2xl text-white">#{{ str_pad(Auth::user()->id, 4, '0', STR_PAD_LEFT) }}</p>
        <p class="font-body text-xs text-gray-600 mt-1">ID Anggota</p>
      </div>
    </div>

    <!-- TABS -->
    <div class="stagger-3">
      <!-- Tab nav -->
      <div class="flex items-center gap-2 mb-5 p-1 card-glass rounded-xl w-fit" style="border:1px solid rgba(255,255,255,0.06);">
        <button class="tab-btn active" id="tab-overview" onclick="switchTab('overview')">
          <span class="flex items-center gap-2">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
            Ringkasan
          </span>
        </button>
        <button class="tab-btn" id="tab-settings" onclick="switchTab('settings')">
          <span class="flex items-center gap-2">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
            Edit Profil
          </span>
        </button>
      </div>

      <!-- ═══ TAB: OVERVIEW ═══ -->
      <div class="tab-panel active" id="panel-overview">
        <div class="grid md:grid-cols-3 gap-5">

          <!-- Activity / Learning progress -->
          <div class="md:col-span-2 card-glass rounded-2xl p-6" style="border:1px solid rgba(255,255,255,0.06);">
            <div class="flex items-center justify-between mb-6">
              <div>
                <p class="font-body text-xs text-gray-600 uppercase tracking-widest mb-1">Progress Belajar</p>
                <h3 class="font-display font-bold text-lg">Aktivitas Minggu Ini</h3>
              </div>
              <span class="badge-pill text-amber-vivid text-xs font-body px-3 py-1 rounded-full">78% tercapai</span>
            </div>

            <div class="space-y-4">
              <div>
                <div class="flex items-center justify-between mb-2">
                  <span class="font-body text-sm text-gray-400">Desain & UX</span>
                  <span class="font-body text-xs text-amber-vivid">78%</span>
                </div>
                <div class="prog-bar">
                  <div class="prog-fill" style="width:78%;background:linear-gradient(90deg,#f59e0b,#d97706);"></div>
                </div>
              </div>
              <div>
                <div class="flex items-center justify-between mb-2">
                  <span class="font-body text-sm text-gray-400">Data Science</span>
                  <span class="font-body text-xs text-violet-400">55%</span>
                </div>
                <div class="prog-bar">
                  <div class="prog-fill" style="width:55%;background:#7c3aed;"></div>
                </div>
              </div>
              <div>
                <div class="flex items-center justify-between mb-2">
                  <span class="font-body text-sm text-gray-400">Product Management</span>
                  <span class="font-body text-xs text-blue-400">92%</span>
                </div>
                <div class="prog-bar">
                  <div class="prog-fill" style="width:92%;background:#2563eb;"></div>
                </div>
              </div>
            </div>
          </div>

          <!-- Side: Upcoming event -->
          <div class="card-glass rounded-2xl p-5 flex flex-col gap-4" style="border:1px solid rgba(255,255,255,0.06);">
            <div>
              <p class="font-body text-xs text-gray-600 uppercase tracking-widest mb-3">Event Terdekat</p>
              <div class="rounded-xl p-4" style="background:rgba(245,158,11,0.06);border:1px solid rgba(245,158,11,0.12);">
                <div class="flex items-center gap-2 mb-2">
                  <div class="live-dot"></div>
                  <span class="font-body text-xs text-green-400 font-medium">LIVE SEKARANG</span>
                </div>
                <p class="font-display font-semibold text-sm leading-snug mb-3">Dari Ide ke Produk: Framework PM Modern</p>
                <div class="flex items-center gap-2">
                  <img src="https://i.pravatar.cc/28?img=11" class="w-6 h-6 rounded-full object-cover">
                  <span class="font-body text-xs text-gray-500">Kevin R. · 1.2K peserta</span>
                </div>
              </div>
            </div>
            <button class="btn-primary py-2.5 rounded-xl text-white font-body text-sm font-medium flex items-center justify-center gap-2">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="5 3 19 12 5 21 5 3"/></svg>
              Gabung Live
            </button>

            <div class="pt-2" style="border-top:1px solid rgba(255,255,255,0.05);">
              <p class="font-body text-xs text-gray-600 uppercase tracking-widest mb-3">Mendatang</p>
              <div class="space-y-3">
                <div class="flex items-center gap-3">
                  <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0" style="background:rgba(124,58,237,0.1);">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#7c3aed" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                  </div>
                  <div>
                    <p class="font-body text-xs text-white font-medium">Accessibility in 2025</p>
                    <p class="font-body text-xs text-gray-600">22 Feb · 14.00 WIB</p>
                  </div>
                </div>
                <div class="flex items-center gap-3">
                  <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0" style="background:rgba(37,99,235,0.1);">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                  </div>
                  <div>
                    <p class="font-body text-xs text-white font-medium">Python & Pandas</p>
                    <p class="font-body text-xs text-gray-600">25 Feb · 10.00 WIB</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- ═══ TAB: SETTINGS / EDIT ═══ -->
      <div class="tab-panel" id="panel-settings">
        <div class="grid md:grid-cols-3 gap-5">

          <!-- Main Edit Form -->
          <div class="md:col-span-2 card-glass rounded-2xl p-6" style="border:1px solid rgba(255,255,255,0.06);">
            <div class="mb-6">
              <p class="font-body text-xs text-gray-600 uppercase tracking-widest mb-1">Pengaturan Akun</p>
              <h3 class="font-display font-bold text-lg">Edit Profil Kamu</h3>
            </div>

            @if ($errors->any())
              <div class="rounded-xl p-4 mb-5" style="background:rgba(239,68,68,0.05);border:1px solid rgba(239,68,68,0.2);">
                @foreach ($errors->all() as $err)
                  <p class="font-body text-sm text-red-400">• {{ $err }}</p>
                @endforeach
              </div>
            @endif

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" id="profileForm">
              @csrf
              @method('PUT')

              <!-- Photo section -->
              <label for="profile_picture_input" class="avatar-upload-zone flex items-center gap-4 p-4 rounded-2xl mb-5 cursor-pointer"
                     style="background:rgba(255,255,255,0.02);border:1px dashed rgba(255,255,255,0.1);">
                <div id="photo-circle" class="w-14 h-14 rounded-xl overflow-hidden flex items-center justify-center flex-shrink-0"
                     style="background:rgba(245,158,11,0.1);border:1px solid rgba(245,158,11,0.2);">
                  @if (Auth::user()->profile_picture)
                    <img id="photo-preview" src="{{ asset('storage/' . Auth::user()->profile_picture) }}" class="w-full h-full object-cover" alt="">
                  @else
                    <span id="photo-initial" class="font-display font-bold text-xl text-amber-vivid">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    <img id="photo-preview" src="" class="w-full h-full object-cover hidden" alt="">
                  @endif
                </div>
                <div>
                  <p class="font-body text-sm font-medium text-white">Ganti foto profil</p>
                  <p class="font-body text-xs text-gray-600 mt-0.5">JPG, PNG, GIF, SVG — max 2MB</p>
                </div>
                <div class="ml-auto">
                  <div class="btn-ghost px-3 py-1.5 rounded-lg text-xs text-gray-500 font-body">Pilih File</div>
                </div>
                <input type="file" id="profile_picture_input" name="profile_picture" accept="image/*" class="hidden" onchange="previewPhoto(this)">
              </label>
              <input type="hidden" id="profile_picture_base64" name="profile_picture_base64">

              <!-- Name & Email row -->
              <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                  <label class="font-body text-xs font-medium text-gray-500 uppercase tracking-widest mb-2 block">Nama Lengkap</label>
                  <div class="relative">
                    <svg class="input-icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" class="input-field" required>
                  </div>
                </div>
                <div>
                  <label class="font-body text-xs font-medium text-gray-500 uppercase tracking-widest mb-2 block">Email</label>
                  <div class="relative">
                    <svg class="input-icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" class="input-field" required>
                  </div>
                </div>
              </div>

              <!-- Description -->
              <div class="mb-6">
                <label class="font-body text-xs font-medium text-gray-500 uppercase tracking-widest mb-2 block">
                  Bio / Deskripsi
                  <span class="ml-2 normal-case text-gray-700">(maks. 500 karakter)</span>
                </label>
                <div class="relative">
                  <svg class="input-icon-top" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
                  <textarea
                    name="description"
                    class="textarea-field"
                    maxlength="500"
                    placeholder="Ceritakan sedikit tentang dirimu, keahlianmu, atau minatmu..."
                    oninput="updateChar(this)"
                  >{{ old('description', Auth::user()->description) }}</textarea>
                </div>
                <div class="flex justify-end mt-1.5">
                  <span class="font-body text-xs text-gray-700" style="font-family:'DM Mono',monospace;"><span id="char-count">{{ strlen(old('description', Auth::user()->description ?? '')) }}</span>/500</span>
                </div>
              </div>

              <!-- Save button -->
              <button type="submit" class="btn-primary w-full py-3.5 rounded-xl text-white font-display font-bold flex items-center justify-center gap-2">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                Simpan Perubahan
              </button>
            </form>
          </div>

          <!-- Side: Account info + Danger -->
          <div class="flex flex-col gap-4">

            <!-- Account details -->
            <div class="card-glass rounded-2xl p-5" style="border:1px solid rgba(255,255,255,0.06);">
              <p class="font-body text-xs text-gray-600 uppercase tracking-widest mb-4">Info Akun</p>
              <div class="space-y-3">
                <div class="flex items-center justify-between py-2" style="border-bottom:1px solid rgba(255,255,255,0.04);">
                  <span class="font-body text-xs text-gray-600 flex items-center gap-2">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    Bergabung
                  </span>
                  <span class="font-body text-xs text-white" style="font-family:'DM Mono',monospace;">{{ Auth::user()->created_at->format('d/m/Y') }}</span>
                </div>
                <div class="flex items-center justify-between py-2" style="border-bottom:1px solid rgba(255,255,255,0.04);">
                  <span class="font-body text-xs text-gray-600 flex items-center gap-2">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                    Diperbarui
                  </span>
                  <span class="font-body text-xs text-white" style="font-family:'DM Mono',monospace;">{{ Auth::user()->updated_at->format('d/m/Y') }}</span>
                </div>
                <div class="flex items-center justify-between py-2">
                  <span class="font-body text-xs text-gray-600 flex items-center gap-2">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    Status
                  </span>
                  <span class="font-body text-xs text-green-400 flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-green-400 inline-block"></span>
                    Aktif
                  </span>
                </div>
              </div>
            </div>

            <!-- Sertifikat placeholder -->
            <div class="card-glass rounded-2xl p-5" style="border:1px solid rgba(255,255,255,0.06);">
              <p class="font-body text-xs text-gray-600 uppercase tracking-widest mb-4">Sertifikat</p>
              <div class="space-y-2">
                @for ($i = 0; $i < 3; $i++)
                  <div class="flex items-center gap-3 py-2" style="{{ $i < 2 ? 'border-bottom:1px solid rgba(255,255,255,0.04);' : '' }}">
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center flex-shrink-0" style="background:rgba(245,158,11,0.1);">
                      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>
                    </div>
                    <div class="flex-1 min-w-0">
                      <p class="font-body text-xs text-white truncate">{{ ['UI/UX Fundamentals', 'Data Analysis Basics', 'PM Bootcamp'][  $i] }}</p>
                      <p class="font-body text-xs text-gray-700">{{ ['Jan 2025', 'Des 2024', 'Nov 2024'][$i] }}</p>
                    </div>
                  </div>
                @endfor
              </div>
            </div>

            <!-- Danger zone -->
            <div class="card-glass rounded-2xl p-5" style="border:1px solid rgba(239,68,68,0.1);">
              <p class="font-body text-xs text-red-800 uppercase tracking-widest mb-1">Zona Berbahaya</p>
              <p class="font-body text-xs text-gray-700 mb-4">Tindakan ini tidak dapat dibatalkan.</p>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full py-2.5 rounded-xl font-body text-sm text-red-400 font-medium transition-all"
                        style="background:rgba(239,68,68,0.05);border:1px solid rgba(239,68,68,0.15);"
                        onmouseover="this.style.background='rgba(239,68,68,0.1)'"
                        onmouseout="this.style.background='rgba(239,68,68,0.05)'">
                  Keluar dari Semua Perangkat
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  </main>

  <!-- CTA Strip -->
  <div class="relative z-10 px-6 py-12" style="border-top:1px solid rgba(245,158,11,0.06);background:rgba(245,158,11,0.02);">
    <div class="max-w-4xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-5">
      <div>
        <h3 class="font-display font-bold text-xl mb-1">Siap belajar hal baru?</h3>
        <p class="font-body text-sm text-gray-500">Jelajahi ratusan webinar gratis dari instruktur terbaik.</p>
      </div>
      <a href="#" class="btn-primary px-7 py-3 rounded-xl text-white font-display font-semibold text-sm whitespace-nowrap flex items-center gap-2">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="5 3 19 12 5 21 5 3"/></svg>
        Eksplorasi Event
      </a>
    </div>
  </div>

  <!-- Footer -->
  <footer class="relative z-10 px-6 py-8" style="border-top:1px solid rgba(255,255,255,0.04);">
    <div class="max-w-6xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-4">
      <div class="flex items-center gap-2">
        <div class="w-6 h-6 rounded-lg btn-primary flex items-center justify-center">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
        </div>
        <span class="font-display font-bold text-sm">Open<span class="text-amber-vivid">Skill</span></span>
      </div>
      <p class="font-body text-xs text-gray-700">© {{ date('Y') }} OpenSkill. Semua hak dilindungi.</p>
    </div>
  </footer>

  <script>
    function switchTab(name) {
      document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
      document.querySelectorAll('.tab-panel').forEach(panel => panel.classList.remove('active'));
      document.getElementById('tab-' + name).classList.add('active');
      document.getElementById('panel-' + name).classList.add('active');
    }

    function previewPhoto(input) {
      if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
          const preview = document.getElementById('photo-preview');
          const initial = document.getElementById('photo-initial');
          preview.src = e.target.result;
          preview.classList.remove('hidden');
          if (initial) initial.classList.add('hidden');
        };
        reader.readAsDataURL(input.files[0]);
      }
    }

    function updateChar(el) {
      document.getElementById('char-count').textContent = el.value.length;
    }

    // Auto-open settings tab if there are validation errors (form was submitted)
    @if ($errors->any())
      document.addEventListener('DOMContentLoaded', () => switchTab('settings'));
    @endif

    // Scroll-triggered fade for stat cards
    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
        }
      });
    }, { threshold: 0.15 });

    document.querySelectorAll('.stat-card').forEach(el => {
      el.style.opacity = '0';
      el.style.transform = 'translateY(16px)';
      el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
      observer.observe(el);
    });
  </script>
</body>
</html>