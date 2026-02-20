<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>OpenSkill — Platform Webinar & Seminar</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet" />

  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            display: ['Syne', 'sans-serif'],
            body: ['DM Sans', 'sans-serif'],
          },
          colors: {
            ink: '#0b0c10',
            panel: '#111318',
            border: '#1e2029',
            amber: {
              vivid: '#f59e0b',
              glow: '#fbbf24',
              soft: '#fde68a',
            },
            slate: {
              muted: '#6b7280',
              light: '#9ca3af',
            }
          },
          animation: {
            'fade-up': 'fadeUp 0.7s ease forwards',
            'float': 'float 6s ease-in-out infinite',
            'pulse-slow': 'pulse 4s ease-in-out infinite',
            'spin-slow': 'spin 20s linear infinite',
            'glow-pulse': 'glowPulse 3s ease-in-out infinite',
          },
          keyframes: {
            fadeUp: {
              '0%': { opacity: '0', transform: 'translateY(30px)' },
              '100%': { opacity: '1', transform: 'translateY(0)' },
            },
            float: {
              '0%, 100%': { transform: 'translateY(0px)' },
              '50%': { transform: 'translateY(-18px)' },
            },
            glowPulse: {
              '0%, 100%': { opacity: '0.5', transform: 'scale(1)' },
              '50%': { opacity: '0.9', transform: 'scale(1.08)' },
            }
          }
        }
      }
    }
  </script>

  <style>
    * { box-sizing: border-box; }
    body {
      background-color: #0b0c10;
      font-family: 'DM Sans', sans-serif;
      overflow-x: hidden;
    }

    /* Noise overlay */
    body::before {
      content: '';
      position: fixed;
      inset: 0;
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.03'/%3E%3C/svg%3E");
      pointer-events: none;
      z-index: 0;
      opacity: 0.4;
    }

    .glow-amber {
      box-shadow: 0 0 60px 10px rgba(245,158,11,0.18);
    }
    .text-glow {
      text-shadow: 0 0 40px rgba(251,191,36,0.4);
    }
    .card-glass {
      background: rgba(17,19,24,0.7);
      backdrop-filter: blur(12px);
      border: 1px solid rgba(255,255,255,0.06);
    }
    .badge-pill {
      background: rgba(245,158,11,0.12);
      border: 1px solid rgba(245,158,11,0.3);
    }
    .nav-blur {
      background: rgba(11,12,16,0.8);
      backdrop-filter: blur(20px);
      border-bottom: 1px solid rgba(255,255,255,0.05);
    }
    .btn-primary {
      background: linear-gradient(135deg, #f59e0b, #d97706);
      transition: all 0.3s ease;
      box-shadow: 0 4px 20px rgba(245,158,11,0.3);
    }
    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 30px rgba(245,158,11,0.45);
    }
    .btn-ghost {
      border: 1px solid rgba(255,255,255,0.15);
      transition: all 0.3s ease;
    }
    .btn-ghost:hover {
      border-color: rgba(245,158,11,0.5);
      color: #fbbf24;
    }
    .orb {
      border-radius: 50%;
      filter: blur(80px);
      position: absolute;
      pointer-events: none;
    }
    .line-accent {
      background: linear-gradient(90deg, transparent, #f59e0b, transparent);
      height: 1px;
    }
    .stat-card:hover {
      border-color: rgba(245,158,11,0.3) !important;
      transform: translateY(-4px);
    }
    .event-card:hover {
      border-color: rgba(245,158,11,0.25) !important;
    }
    .stagger-1 { animation-delay: 0.1s; opacity: 0; }
    .stagger-2 { animation-delay: 0.25s; opacity: 0; }
    .stagger-3 { animation-delay: 0.4s; opacity: 0; }
    .stagger-4 { animation-delay: 0.55s; opacity: 0; }
    .stagger-5 { animation-delay: 0.7s; opacity: 0; }

    .ticker-wrap {
      overflow: hidden;
      white-space: nowrap;
    }
    .ticker-inner {
      display: inline-block;
      animation: ticker 30s linear infinite;
    }
    @keyframes ticker {
      0%   { transform: translateX(0); }
      100% { transform: translateX(-50%); }
    }

    /* Diagonal decorative line */
    .diagonal-line {
      position: absolute;
      width: 1px;
      height: 200px;
      background: linear-gradient(to bottom, transparent, rgba(245,158,11,0.4), transparent);
      transform: rotate(30deg);
    }

    .live-dot {
      width: 8px;
      height: 8px;
      background: #22c55e;
      border-radius: 50%;
      animation: pulse 1.5s ease-in-out infinite;
    }
    @keyframes pulse {
      0%, 100% { opacity: 1; box-shadow: 0 0 0 0 rgba(34,197,94,0.4); }
      50% { opacity: 0.8; box-shadow: 0 0 0 6px rgba(34,197,94,0); }
    }
  </style>
</head>
<body class="min-h-screen text-white relative">

  <!-- BACKGROUND ORBS -->
  <div class="orb" style="width:600px;height:600px;background:rgba(245,158,11,0.07);top:-150px;right:-100px;animation:glowPulse 5s ease-in-out infinite;"></div>
  <div class="orb" style="width:400px;height:400px;background:rgba(139,92,246,0.05);bottom:100px;left:-100px;animation:glowPulse 7s ease-in-out infinite reverse;"></div>
  <div class="orb" style="width:300px;height:300px;background:rgba(245,158,11,0.05);top:50%;left:50%;transform:translate(-50%,-50%);animation:glowPulse 6s ease-in-out infinite;"></div>

  <!-- DIAGONAL DECORATIVE -->
  <div class="diagonal-line" style="top:120px;left:15%;"></div>
  <div class="diagonal-line" style="top:300px;right:10%;opacity:0.4;"></div>

  <!-- NAVBAR -->
  <nav class="nav-blur fixed top-0 left-0 right-0 z-50 px-6 py-4">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
      <!-- Logo -->
      <div class="flex items-center gap-2">
        <div class="w-8 h-8 rounded-lg btn-primary flex items-center justify-center">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
            <path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/>
          </svg>
        </div>
        <span class="font-display font-800 text-lg tracking-tight">Open<span class="text-amber-vivid">Skill</span></span>
      </div>

      <!-- Nav links (desktop) -->
      <div class="hidden md:flex items-center gap-8 text-sm text-gray-400 font-body">
        <a href="#" class="hover:text-white transition-colors">Eksplorasi</a>
        <a href="#" class="hover:text-white transition-colors">Webinar</a>
        <a href="#" class="hover:text-white transition-colors">Seminar</a>
        <a href="#" class="hover:text-white transition-colors">Komunitas</a>
        <a href="#" class="hover:text-white transition-colors">Instruktur</a>
      </div>

      <!-- CTA -->
      <div class="flex items-center gap-3">
      <form action="/login" method="GET" class="inline-block">
    <button type="submit" class="btn-ghost text-sm px-4 py-2 rounded-lg text-gray-300 font-body">Masuk</button>
</form>

<form action="/register" method="GET" class="inline-block">
    <button type="submit" class="btn-primary text-sm px-5 py-2 rounded-lg text-white font-semibold font-body">Daftar Gratis</button>
</form>
      </div>
    </div>
  </nav>

  <!-- TICKER BAR -->
  <div class="fixed top-[65px] left-0 right-0 z-40 py-2 text-xs text-amber-vivid/70 font-body ticker-wrap" style="background:rgba(245,158,11,0.04);border-bottom:1px solid rgba(245,158,11,0.1);">
    <div class="ticker-inner">
      <span class="px-8">🎯 Webinar UI/UX Design &mdash; Besok, 19.00 WIB</span>
      <span class="px-8">⚡ 1.200+ Peserta Aktif Minggu Ini</span>
      <span class="px-8">🚀 Seminar AI & Machine Learning &mdash; 25 Feb 2025</span>
      <span class="px-8">🌟 Instruktur Baru: Sarah Dewi, Ex-Google</span>
      <span class="px-8">🎓 Sertifikat Digital Tersedia untuk Semua Kelas</span>
      <span class="px-8">🎯 Webinar UI/UX Design &mdash; Besok, 19.00 WIB</span>
      <span class="px-8">⚡ 1.200+ Peserta Aktif Minggu Ini</span>
      <span class="px-8">🚀 Seminar AI & Machine Learning &mdash; 25 Feb 2025</span>
      <span class="px-8">🌟 Instruktur Baru: Sarah Dewi, Ex-Google</span>
      <span class="px-8">🎓 Sertifikat Digital Tersedia untuk Semua Kelas</span>
    </div>
  </div>

  <!-- HERO SECTION -->
  <section class="relative z-10 min-h-screen flex flex-col items-center justify-center pt-32 pb-20 px-6">
    <div class="max-w-5xl mx-auto text-center">

      <!-- Live badge -->
      <div class="animate-fade-up stagger-1 inline-flex items-center gap-2 badge-pill rounded-full px-4 py-2 mb-8 font-body text-sm">
        <div class="live-dot"></div>
        <span class="text-amber-vivid font-medium">Live Sekarang</span>
        <span class="text-gray-400">— Webinar Product Management oleh Kevin R.</span>
      </div>

      <!-- Main headline -->
      <h1 class="animate-fade-up stagger-2 font-display font-extrabold leading-none tracking-tight mb-6"
          style="font-size: clamp(3rem, 9vw, 7.5rem); line-height: 0.95;">
        Belajar<br/>
        <span class="text-glow" style="color:#f59e0b;">Tanpa Batas</span><br/>
        Tumbuh<br/>
        Bersama.
      </h1>

      <!-- Subheadline -->
      <p class="animate-fade-up stagger-3 font-body text-gray-400 text-lg md:text-xl max-w-2xl mx-auto mb-10 leading-relaxed">
        Platform webinar dan seminar terbuka tempat para profesional berbagi pengalaman nyata, keterampilan aktual, dan wawasan industri — gratis untuk semua.
      </p>

      <!-- CTA Buttons -->
      <div class="animate-fade-up stagger-4 flex flex-col sm:flex-row gap-4 justify-center items-center mb-16">
        <button class="btn-primary px-8 py-4 rounded-xl text-white font-display font-semibold text-base flex items-center gap-2">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <polygon points="5 3 19 12 5 21 5 3"/>
          </svg>
          Mulai Belajar Sekarang
        </button>
        <button class="btn-ghost px-8 py-4 rounded-xl text-gray-300 font-display font-semibold text-base flex items-center gap-2">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
          </svg>
          Lihat Jadwal Event
        </button>
      </div>

      <!-- Stats Row -->
      <div class="animate-fade-up stagger-5 grid grid-cols-2 md:grid-cols-4 gap-4 max-w-3xl mx-auto">
        <div class="stat-card card-glass rounded-2xl p-5 text-left transition-all duration-300 cursor-default">
          <p class="font-display font-bold text-3xl text-white">48K+</p>
          <p class="font-body text-sm text-gray-500 mt-1">Peserta Terdaftar</p>
        </div>
        <div class="stat-card card-glass rounded-2xl p-5 text-left transition-all duration-300 cursor-default">
          <p class="font-display font-bold text-3xl text-white">320+</p>
          <p class="font-body text-sm text-gray-500 mt-1">Event Per Bulan</p>
        </div>
        <div class="stat-card card-glass rounded-2xl p-5 text-left transition-all duration-300 cursor-default">
          <p class="font-display font-bold text-3xl text-amber-vivid">92%</p>
          <p class="font-body text-sm text-gray-500 mt-1">Tingkat Kepuasan</p>
        </div>
        <div class="stat-card card-glass rounded-2xl p-5 text-left transition-all duration-300 cursor-default">
          <p class="font-display font-bold text-3xl text-white">150+</p>
          <p class="font-body text-sm text-gray-500 mt-1">Instruktur Aktif</p>
        </div>
      </div>
    </div>

    <!-- Scroll hint -->
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 animate-float">
      <span class="font-body text-xs text-gray-600 tracking-widest uppercase">Scroll</span>
      <div class="w-px h-10" style="background: linear-gradient(to bottom, rgba(245,158,11,0.5), transparent);"></div>
    </div>
  </section>

  <!-- DIVIDER -->
  <div class="line-accent max-w-5xl mx-auto my-0 opacity-40"></div>

  <!-- UPCOMING EVENTS -->
  <section class="relative z-10 px-6 py-24">
    <div class="max-w-6xl mx-auto">

      <div class="flex items-end justify-between mb-12">
        <div>
          <span class="font-body text-xs text-amber-vivid/70 uppercase tracking-widest mb-2 block">Segera Hadir</span>
          <h2 class="font-display font-bold text-4xl md:text-5xl">Event Unggulan</h2>
        </div>
        <a href="#" class="btn-ghost px-5 py-2.5 rounded-lg text-sm text-gray-400 font-body hidden md:inline-flex items-center gap-2">
          Lihat Semua
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="M12 5l7 7-7 7"/></svg>
        </a>
      </div>

      <div class="grid md:grid-cols-3 gap-5">

        <!-- Event Card 1 - Featured -->
        <div class="event-card card-glass rounded-2xl p-6 md:col-span-2 transition-all duration-300 cursor-pointer" style="border:1px solid rgba(255,255,255,0.06);">
          <div class="flex items-center gap-2 mb-5">
            <div class="live-dot"></div>
            <span class="font-body text-xs text-green-400 font-medium">LIVE SEKARANG</span>
          </div>
          <div class="flex items-start justify-between mb-6">
            <div>
              <span class="badge-pill text-amber-vivid text-xs font-body px-3 py-1 rounded-full">Product Management</span>
              <h3 class="font-display font-bold text-2xl mt-3 leading-tight">Dari Ide ke Produk:<br/>Framework PM Modern</h3>
            </div>
            <div class="w-14 h-14 rounded-xl flex-shrink-0 ml-4 flex items-center justify-center" style="background:rgba(245,158,11,0.12);">
              <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="1.8">
                <rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/>
              </svg>
            </div>
          </div>
          <div class="flex items-center gap-4 mb-6">
            <img src="https://i.pravatar.cc/40?img=11" class="w-10 h-10 rounded-full object-cover border-2" style="border-color:rgba(245,158,11,0.3);" alt="Speaker"/>
            <div>
              <p class="font-body font-medium text-sm text-white">Kevin Rahardian</p>
              <p class="font-body text-xs text-gray-500">Senior PM · Tokopedia</p>
            </div>
          </div>
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-5 text-xs text-gray-500 font-body">
              <span class="flex items-center gap-1.5">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                19.00 — 21.00 WIB
              </span>
              <span class="flex items-center gap-1.5">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                1.240 Peserta
              </span>
            </div>
            <button class="btn-primary px-5 py-2 rounded-lg text-sm text-white font-body font-medium">Gabung Live</button>
          </div>
        </div>

        <!-- Event Card 2 -->
        <div class="flex flex-col gap-5">
          <div class="event-card card-glass rounded-2xl p-5 transition-all duration-300 cursor-pointer flex-1" style="border:1px solid rgba(255,255,255,0.06);">
            <span class="badge-pill text-amber-vivid text-xs font-body px-3 py-1 rounded-full">UI/UX Design</span>
            <h3 class="font-display font-semibold text-lg mt-3 mb-3 leading-snug">Designing for Accessibility di 2025</h3>
            <div class="flex items-center gap-2 mb-4">
              <img src="https://i.pravatar.cc/32?img=5" class="w-8 h-8 rounded-full object-cover" alt="Speaker"/>
              <div>
                <p class="font-body text-xs text-white font-medium">Sari Nuraini</p>
                <p class="font-body text-xs text-gray-600">Design Lead · Gojek</p>
              </div>
            </div>
            <div class="flex items-center justify-between text-xs font-body">
              <span class="text-gray-500 flex items-center gap-1">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                22 Feb &bull; 14.00 WIB
              </span>
              <span class="text-amber-vivid font-medium">Gratis</span>
            </div>
          </div>

          <div class="event-card card-glass rounded-2xl p-5 transition-all duration-300 cursor-pointer flex-1" style="border:1px solid rgba(255,255,255,0.06);">
            <span style="background:rgba(139,92,246,0.12);border:1px solid rgba(139,92,246,0.3);" class="text-violet-400 text-xs font-body px-3 py-1 rounded-full">Data Science</span>
            <h3 class="font-display font-semibold text-lg mt-3 mb-3 leading-snug">Analitik Data dengan Python & Pandas</h3>
            <div class="flex items-center gap-2 mb-4">
              <img src="https://i.pravatar.cc/32?img=8" class="w-8 h-8 rounded-full object-cover" alt="Speaker"/>
              <div>
                <p class="font-body text-xs text-white font-medium">Budi Santoso</p>
                <p class="font-body text-xs text-gray-600">Data Engineer · Bukalapak</p>
              </div>
            </div>
            <div class="flex items-center justify-between text-xs font-body">
              <span class="text-gray-500 flex items-center gap-1">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                25 Feb &bull; 10.00 WIB
              </span>
              <span class="text-amber-vivid font-medium">Gratis</span>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- CATEGORIES SECTION -->
  <section class="relative z-10 px-6 py-16">
    <div class="max-w-6xl mx-auto">
      <div class="mb-10">
        <span class="font-body text-xs text-amber-vivid/70 uppercase tracking-widest mb-2 block">Eksplorasi Topik</span>
        <h2 class="font-display font-bold text-4xl md:text-5xl">Semua Bidang,<br/>Satu Platform.</h2>
      </div>

      <div class="flex flex-wrap gap-3">
        <button class="btn-primary px-5 py-2.5 rounded-full font-body text-sm font-medium text-white">Semua Topik</button>
        <button class="btn-ghost px-5 py-2.5 rounded-full font-body text-sm text-gray-400">💻 Teknologi</button>
        <button class="btn-ghost px-5 py-2.5 rounded-full font-body text-sm text-gray-400">🎨 Desain</button>
        <button class="btn-ghost px-5 py-2.5 rounded-full font-body text-sm text-gray-400">📊 Bisnis</button>
        <button class="btn-ghost px-5 py-2.5 rounded-full font-body text-sm text-gray-400">🤖 AI & Data</button>
        <button class="btn-ghost px-5 py-2.5 rounded-full font-body text-sm text-gray-400">📱 Mobile Dev</button>
        <button class="btn-ghost px-5 py-2.5 rounded-full font-body text-sm text-gray-400">🔐 Cybersecurity</button>
        <button class="btn-ghost px-5 py-2.5 rounded-full font-body text-sm text-gray-400">💰 Keuangan</button>
        <button class="btn-ghost px-5 py-2.5 rounded-full font-body text-sm text-gray-400">🌱 Soft Skills</button>
      </div>
    </div>
  </section>

  <!-- DIVIDER -->
  <div class="line-accent max-w-5xl mx-auto opacity-30"></div>

  <!-- WHY OPENSKILL -->
  <section class="relative z-10 px-6 py-24">
    <div class="max-w-6xl mx-auto">

      <div class="grid md:grid-cols-2 gap-16 items-center">
        <div>
          <span class="font-body text-xs text-amber-vivid/70 uppercase tracking-widest mb-3 block">Mengapa OpenSkill?</span>
          <h2 class="font-display font-bold text-4xl md:text-5xl leading-tight mb-6">Pengalaman Nyata,<br/>Bukan Teori Semata.</h2>
          <p class="font-body text-gray-400 text-base leading-relaxed mb-8">
            Kami percaya pembelajaran terbaik datang dari praktisi aktif di industri. OpenSkill menghubungkan kamu dengan para profesional yang setiap harinya menghadapi tantangan yang sama seperti yang ingin kamu pelajari.
          </p>
          <div class="space-y-5">
            <div class="flex items-start gap-4">
              <div class="w-10 h-10 rounded-xl flex-shrink-0 flex items-center justify-center mt-0.5" style="background:rgba(245,158,11,0.12);border:1px solid rgba(245,158,11,0.2);">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2">
                  <polyline points="20 6 9 17 4 12"/>
                </svg>
              </div>
              <div>
                <p class="font-body font-medium text-white text-sm">Instruktur dari Industri Terkemuka</p>
                <p class="font-body text-gray-500 text-sm mt-1">Belajar langsung dari profesional aktif di Google, Tokopedia, Gojek, dan ratusan perusahaan lainnya.</p>
              </div>
            </div>
            <div class="flex items-start gap-4">
              <div class="w-10 h-10 rounded-xl flex-shrink-0 flex items-center justify-center mt-0.5" style="background:rgba(245,158,11,0.12);border:1px solid rgba(245,158,11,0.2);">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2">
                  <polyline points="20 6 9 17 4 12"/>
                </svg>
              </div>
              <div>
                <p class="font-body font-medium text-white text-sm">Interaktif & Terbuka untuk Semua</p>
                <p class="font-body text-gray-500 text-sm mt-1">Tanya jawab langsung, forum diskusi komunitas, dan rekaman replay tersedia gratis.</p>
              </div>
            </div>
            <div class="flex items-start gap-4">
              <div class="w-10 h-10 rounded-xl flex-shrink-0 flex items-center justify-center mt-0.5" style="background:rgba(245,158,11,0.12);border:1px solid rgba(245,158,11,0.2);">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2">
                  <polyline points="20 6 9 17 4 12"/>
                </svg>
              </div>
              <div>
                <p class="font-body font-medium text-white text-sm">Sertifikat yang Diakui</p>
                <p class="font-body text-gray-500 text-sm mt-1">Dapatkan sertifikat digital yang bisa langsung ditampilkan di profil LinkedIn kamu.</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Visual side -->
        <div class="relative">
          <div class="card-glass rounded-3xl p-8 animate-float" style="border:1px solid rgba(245,158,11,0.1);">
            <div class="flex items-center gap-3 mb-6 pb-5" style="border-bottom:1px solid rgba(255,255,255,0.05);">
              <div class="w-10 h-10 rounded-xl bg-amber-vivid/10 flex items-center justify-center">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2">
                  <path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/>
                </svg>
              </div>
              <div>
                <p class="font-display font-semibold text-sm text-white">OpenSkill Platform</p>
                <p class="font-body text-xs text-gray-500">Dashboard Pembelajaran</p>
              </div>
              <div class="ml-auto flex gap-1.5">
                <div class="w-2.5 h-2.5 rounded-full bg-red-500/60"></div>
                <div class="w-2.5 h-2.5 rounded-full bg-yellow-500/60"></div>
                <div class="w-2.5 h-2.5 rounded-full bg-green-500/60"></div>
              </div>
            </div>

            <div class="space-y-3 mb-6">
              <p class="font-body text-xs text-gray-500 uppercase tracking-widest">Aktivitas Minggu Ini</p>
              <div class="flex items-center gap-3">
                <div class="flex-1 h-2 rounded-full bg-gray-800 overflow-hidden">
                  <div class="h-full rounded-full bg-amber-vivid" style="width:78%;"></div>
                </div>
                <span class="font-body text-xs text-gray-400 w-8">78%</span>
              </div>
              <div class="flex items-center gap-3">
                <div class="flex-1 h-2 rounded-full bg-gray-800 overflow-hidden">
                  <div class="h-full rounded-full bg-violet-500" style="width:55%;"></div>
                </div>
                <span class="font-body text-xs text-gray-400 w-8">55%</span>
              </div>
              <div class="flex items-center gap-3">
                <div class="flex-1 h-2 rounded-full bg-gray-800 overflow-hidden">
                  <div class="h-full rounded-full bg-blue-500" style="width:92%;"></div>
                </div>
                <span class="font-body text-xs text-gray-400 w-8">92%</span>
              </div>
            </div>

            <div class="grid grid-cols-3 gap-3">
              <div class="rounded-xl p-3 text-center" style="background:rgba(245,158,11,0.08);border:1px solid rgba(245,158,11,0.15);">
                <p class="font-display font-bold text-xl text-amber-vivid">12</p>
                <p class="font-body text-xs text-gray-500 mt-0.5">Diikuti</p>
              </div>
              <div class="rounded-xl p-3 text-center" style="background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.06);">
                <p class="font-display font-bold text-xl text-white">5</p>
                <p class="font-body text-xs text-gray-500 mt-0.5">Sertifikat</p>
              </div>
              <div class="rounded-xl p-3 text-center" style="background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.06);">
                <p class="font-display font-bold text-xl text-white">38h</p>
                <p class="font-body text-xs text-gray-500 mt-0.5">Jam Belajar</p>
              </div>
            </div>
          </div>

          <!-- Floating notification -->
          <div class="absolute -top-4 -right-4 card-glass rounded-xl px-4 py-3 flex items-center gap-2.5 glow-amber" style="border:1px solid rgba(245,158,11,0.2);">
            <div class="live-dot"></div>
            <div>
              <p class="font-body text-xs text-white font-medium">Webinar dimulai!</p>
              <p class="font-body text-xs text-gray-500">1.2K orang bergabung</p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- TESTIMONIAL STRIP -->
  <section class="relative z-10 px-6 py-16" style="background:rgba(245,158,11,0.03);border-top:1px solid rgba(245,158,11,0.08);border-bottom:1px solid rgba(245,158,11,0.08);">
    <div class="max-w-6xl mx-auto">
      <p class="font-body text-center text-xs text-gray-600 uppercase tracking-widest mb-8">Dipercaya oleh ribuan profesional</p>
      <div class="grid sm:grid-cols-3 gap-5">

        <div class="card-glass rounded-2xl p-5" style="border:1px solid rgba(255,255,255,0.05);">
          <div class="flex gap-1 mb-3">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="#f59e0b" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="#f59e0b" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="#f59e0b" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="#f59e0b" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="#f59e0b" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
          </div>
          <p class="font-body text-sm text-gray-300 leading-relaxed mb-4">"OpenSkill benar-benar mengubah cara saya belajar. Webinarnya sangat praktis dan instrukturnya responsif banget."</p>
          <div class="flex items-center gap-2">
            <img src="https://i.pravatar.cc/32?img=47" class="w-8 h-8 rounded-full" alt="user"/>
            <div>
              <p class="font-body text-xs text-white font-medium">Rina Kartika</p>
              <p class="font-body text-xs text-gray-600">Junior Developer · Bandung</p>
            </div>
          </div>
        </div>

        <div class="card-glass rounded-2xl p-5" style="border:1px solid rgba(255,255,255,0.05);">
          <div class="flex gap-1 mb-3">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="#f59e0b" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="#f59e0b" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="#f59e0b" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="#f59e0b" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="#f59e0b" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
          </div>
          <p class="font-body text-sm text-gray-300 leading-relaxed mb-4">"Seminar data sciencenya top banget. Dapat insight yang nggak bisa saya temukan di tempat lain, dan gratis lagi!"</p>
          <div class="flex items-center gap-2">
            <img src="https://i.pravatar.cc/32?img=12" class="w-8 h-8 rounded-full" alt="user"/>
            <div>
              <p class="font-body text-xs text-white font-medium">Fajar Ramadhan</p>
              <p class="font-body text-xs text-gray-600">Data Analyst · Jakarta</p>
            </div>
          </div>
        </div>

        <div class="card-glass rounded-2xl p-5" style="border:1px solid rgba(255,255,255,0.05);">
          <div class="flex gap-1 mb-3">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="#f59e0b" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="#f59e0b" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="#f59e0b" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="#f59e0b" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="#f59e0b" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
          </div>
          <p class="font-body text-sm text-gray-300 leading-relaxed mb-4">"Akhirnya platform yang fokus ke practical skills! Setiap webinar langsung bisa saya terapkan di kerjaan."</p>
          <div class="flex items-center gap-2">
            <img src="https://i.pravatar.cc/32?img=25" class="w-8 h-8 rounded-full" alt="user"/>
            <div>
              <p class="font-body text-xs text-white font-medium">Maya Putri</p>
              <p class="font-body text-xs text-gray-600">UX Designer · Surabaya</p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- CTA FINAL -->
  <section class="relative z-10 px-6 py-28 text-center overflow-hidden">
    <div class="orb" style="width:500px;height:300px;background:rgba(245,158,11,0.08);top:50%;left:50%;transform:translate(-50%,-50%);filter:blur(60px);"></div>
    <div class="max-w-3xl mx-auto relative">
      <h2 class="font-display font-extrabold leading-none mb-6 text-glow" style="font-size:clamp(2.5rem,7vw,5rem);">
        Siap Mulai<br/>Perjalananmu?
      </h2>
      <p class="font-body text-gray-400 text-lg mb-10 max-w-xl mx-auto">
        Bergabunglah dengan 48.000+ profesional yang sudah belajar dan berkembang bersama komunitas OpenSkill.
      </p>
      <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <button class="btn-primary px-10 py-4 rounded-xl text-white font-display font-semibold text-base">
          Daftar Sekarang — Gratis
        </button>
        <button class="btn-ghost px-8 py-4 rounded-xl text-gray-400 font-display font-semibold text-base">
          Jadi Instruktur
        </button>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="relative z-10 px-6 py-12" style="border-top:1px solid rgba(255,255,255,0.05);">
    <div class="max-w-6xl mx-auto">
      <div class="flex flex-col md:flex-row items-center justify-between gap-6">
        <div class="flex items-center gap-2">
          <div class="w-7 h-7 rounded-lg btn-primary flex items-center justify-center">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
              <path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/>
            </svg>
          </div>
          <span class="font-display font-bold text-base">Open<span class="text-amber-vivid">Skill</span></span>
        </div>
        <div class="flex items-center gap-8 text-xs text-gray-600 font-body">
          <a href="#" class="hover:text-gray-400 transition-colors">Tentang Kami</a>
          <a href="#" class="hover:text-gray-400 transition-colors">Privasi</a>
          <a href="#" class="hover:text-gray-400 transition-colors">Syarat & Ketentuan</a>
          <a href="#" class="hover:text-gray-400 transition-colors">Kontak</a>
        </div>
        <p class="font-body text-xs text-gray-700">© 2025 OpenSkill. Semua hak dilindungi.</p>
      </div>
    </div>
  </footer>

  <script>
    // Stagger animation trigger on load
    document.addEventListener('DOMContentLoaded', () => {
      const staggerEls = document.querySelectorAll('[class*="stagger-"]');
      staggerEls.forEach(el => {
        el.style.animationName = 'fadeUp';
        el.style.animationFillMode = 'forwards';
        el.style.animationDuration = '0.7s';
        el.style.animationTimingFunction = 'ease';
      });

      // Category button active toggle
      const catBtns = document.querySelectorAll('section button');
      catBtns.forEach(btn => {
        btn.addEventListener('click', () => {
          if (btn.closest('section').querySelector('.btn-primary[data-cat]')) return;
        });
      });

      // Simple scroll-triggered fade for event cards
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
          }
        });
      }, { threshold: 0.15 });

      document.querySelectorAll('.event-card, .stat-card').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
      });
    });
  </script>

</body>
</html>