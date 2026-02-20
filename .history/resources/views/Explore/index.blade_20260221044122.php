@extends('layouts.app')

@section('title', 'Eksplorasi')
@section('meta-description', 'Temukan semua webinar, seminar, dan konten belajar dari OpenSkill dalam satu tempat. Filter by topik, instruktur, atau format.')

@push('styles')
  /* ── Hero section ── */
  .hero-orb-1 { position:absolute; width:500px; height:500px; border-radius:50%; filter:blur(100px); background:rgba(245,158,11,0.08); top:-150px; right:-100px; animation:glowPulse 6s ease-in-out infinite; pointer-events:none; }
  .hero-orb-2 { position:absolute; width:300px; height:300px; border-radius:50%; filter:blur(80px); background:rgba(99,102,241,0.07); bottom:-50px; left:-60px; animation:glowPulse 8s ease-in-out infinite reverse; pointer-events:none; }

  /* ── Category cards ── */
  .cat-card { transition: all 0.3s cubic-bezier(0.34,1.56,0.64,1); cursor:pointer; }
  .cat-card:hover { transform:translateY(-6px) scale(1.01); }
  .cat-card:hover .cat-icon { transform:scale(1.15); }
  .cat-icon { transition:transform 0.3s ease; }

  /* ── Content cards ── */
  .content-card { transition: all 0.25s ease; cursor:pointer; }
  .content-card:hover { transform:translateY(-3px); border-color:rgba(245,158,11,0.2) !important; }

  /* ── Instructor card ── */
  .instructor-card { transition: all 0.25s ease; cursor:pointer; }
  .instructor-card:hover { transform:translateY(-3px); border-color:rgba(245,158,11,0.25) !important; }

  /* ── Section divider ── */
  .section-label { font-family:'DM Sans',sans-serif; font-size:0.7rem; text-transform:uppercase; letter-spacing:0.1em; color:rgba(245,158,11,0.7); }

  /* ── Tag cloud ── */
  .tag { display:inline-flex; align-items:center; padding:6px 14px; border-radius:100px; font-family:'DM Sans',sans-serif; font-size:0.8rem; border:1px solid rgba(255,255,255,0.08); color:rgba(255,255,255,0.4); transition:all 0.2s; cursor:pointer; }
  .tag:hover { border-color:rgba(245,158,11,0.3); color:#fbbf24; background:rgba(245,158,11,0.05); }

  /* ── Hero search ── */
  .hero-search {
    width:100%; max-width:520px;
    padding:16px 20px 16px 52px;
    background:rgba(255,255,255,0.04);
    border:1px solid rgba(255,255,255,0.1);
    border-radius:18px; color:white;
    font-family:'DM Sans',sans-serif; font-size:1rem; outline:none;
    transition:border-color 0.25s, box-shadow 0.25s, background 0.25s;
    box-shadow:0 8px 32px rgba(0,0,0,0.3);
  }
  .hero-search:focus { border-color:rgba(245,158,11,0.5); box-shadow:0 0 0 4px rgba(245,158,11,0.08), 0 8px 32px rgba(0,0,0,0.3); background:rgba(255,255,255,0.06); }
  .hero-search::placeholder { color:rgba(255,255,255,0.28); }

  /* ── Horizontal scroll strip ── */
  .h-scroll { display:flex; gap:16px; overflow-x:auto; padding-bottom:8px; scrollbar-width:none; }
  .h-scroll::-webkit-scrollbar { display:none; }
  .h-scroll-card { flex-shrink:0; }

  /* ── Live badge pulse on hero ── */
  @keyframes heroPulse {
    0%, 100% { box-shadow:0 0 0 0 rgba(34,197,94,0.5); }
    50%       { box-shadow:0 0 0 8px rgba(34,197,94,0); }
  }
  .hero-live { animation:heroPulse 2s ease-in-out infinite; }
@endpush

@section('content')

{{-- ═══════════════════════════════════════
     HERO SECTION
═══════════════════════════════════════ --}}
<section class="relative overflow-hidden pt-40 pb-20 px-6">
  <div class="hero-orb-1"></div>
  <div class="hero-orb-2"></div>

  {{-- Diagonal accent lines --}}
  <div style="position:absolute;top:80px;left:5%;width:1px;height:280px;background:linear-gradient(to bottom,transparent,rgba(245,158,11,0.15),transparent);transform:rotate(20deg);pointer-events:none;"></div>
  <div style="position:absolute;top:120px;right:8%;width:1px;height:200px;background:linear-gradient(to bottom,transparent,rgba(99,102,241,0.12),transparent);transform:rotate(-15deg);pointer-events:none;"></div>

  <div class="max-w-7xl mx-auto relative z-10">
    <div class="max-w-3xl">
      <div class="flex items-center gap-3 mb-5 stagger-1">
        <div class="hero-live w-2 h-2 rounded-full" style="background:#22c55e;"></div>
        <span class="font-body text-sm text-gray-500">Platform belajar #1 profesional Indonesia</span>
        <span class="badge-pill font-body text-xs px-2.5 py-0.5 rounded-full" style="color:#f59e0b;">Beta</span>
      </div>

      <h1 class="font-display font-extrabold tracking-tight text-glow mb-5 stagger-2"
          style="font-size:clamp(2.5rem,7vw,5rem);line-height:1.02;">
        Eksplorasi<br/>
        <span style="background:linear-gradient(135deg,#f59e0b,#fbbf24);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
          Semua Event
        </span>
      </h1>

      <p class="font-body text-gray-500 text-lg mb-8 max-w-xl stagger-3" style="line-height:1.7;">
        Ratusan webinar live, seminar intensif, dan rekaman berkualitas — semua gratis, dari para profesional terbaik industri.
      </p>

      {{-- Hero search --}}
      <div class="relative w-full max-w-lg stagger-4">
        <svg style="position:absolute;left:18px;top:50%;transform:translateY(-50%);" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.4)" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
        <input type="text" class="hero-search" placeholder="Cari topik, instruktur, atau event…" id="hero-search" oninput="heroSearch(this.value)">
        <div class="absolute right-3 top-1/2 -translate-y-1/2">
          <kbd class="font-body text-xs px-2 py-1 rounded-md" style="background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.1);color:rgba(255,255,255,0.3);">⌘K</kbd>
        </div>
      </div>

      {{-- Quick tags --}}
      <div class="flex flex-wrap gap-2 mt-5 stagger-4">
        <span class="font-body text-xs text-gray-700 self-center">Populer:</span>
        @foreach(['UI/UX Design','Machine Learning','Product Management','Flutter','Data Science','Cybersecurity'] as $tag)
          <button class="tag" onclick="document.getElementById('hero-search').value='{{ $tag }}';heroSearch('{{ $tag }}')">{{ $tag }}</button>
        @endforeach
      </div>
    </div>

    {{-- Stats strip --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-16 stagger-4">
      @foreach([['1.2K+','Event Tersedia'],['150+','Instruktur Aktif'],['48K+','Peserta Terdaftar'],['100%','Konten Gratis']] as $stat)
        <div class="card-glass rounded-2xl p-5 text-center reveal" style="border:1px solid rgba(255,255,255,0.06);">
          <p class="font-display font-extrabold text-2xl mb-1" style="color:#f59e0b;">{{ $stat[0] }}</p>
          <p class="font-body text-xs text-gray-600">{{ $stat[1] }}</p>
        </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ═══════════════════════════════════════
     LIVE RIGHT NOW STRIP
═══════════════════════════════════════ --}}
<section class="px-6 pb-16">
  <div class="max-w-7xl mx-auto">
    <div class="flex items-center gap-3 mb-5">
      <div class="live-dot"></div>
      <h2 class="font-display font-bold text-xl">Live Sekarang</h2>
      <span class="badge-live font-body text-xs px-2.5 py-1 rounded-full">8 sesi aktif</span>
      <a href="{{ route('webinar') }}" class="ml-auto font-body text-xs text-gray-600 hover:text-amber-vivid transition-colors flex items-center gap-1" style="color:rgba(255,255,255,0.35);">
        Lihat semua <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
      </a>
    </div>

    <div class="h-scroll">
      @foreach([
        ['PM Framework Modern','Kevin Rahardian','1.240 menonton','#f59e0b','bisnis','11'],
        ['Growth Hacking 101','Maya Kusuma','380 menonton','#7c3aed','bisnis','15'],
        ['Intro to DevOps','Andi Wijaya','620 menonton','#2563eb','teknologi','30'],
        ['React Native Crash','Rizky F.','890 menonton','#06b6d4','mobile','3'],
        ['Excel untuk Analis','Sari N.','1.050 menonton','#16a34a','bisnis','5'],
      ] as $live)
        <div class="h-scroll-card content-card card-glass rounded-2xl p-5 w-64" style="border:1px solid rgba(255,255,255,0.06);">
          <div class="h-28 rounded-xl mb-4 flex items-center justify-center relative overflow-hidden"
               style="background:linear-gradient(135deg,{{ $live[3] }}22,{{ $live[3] }}08);">
            <div class="w-12 h-12 rounded-full flex items-center justify-center" style="background:{{ $live[3] }}25;border:1.5px solid {{ $live[3] }}55;">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="{{ $live[3] }}" stroke-width="2"><polygon points="5 3 19 12 5 21 5 3"/></svg>
            </div>
            <div class="absolute top-2 left-2">
              <span class="badge-live font-body text-xs px-2 py-0.5 rounded-full flex items-center gap-1">
                <div class="live-dot" style="width:5px;height:5px;"></div>LIVE
              </span>
            </div>
            <div class="absolute bottom-2 left-2 px-2 py-0.5 rounded text-xs font-body text-white" style="background:rgba(0,0,0,0.55);">{{ $live[2] }}</div>
          </div>
          <p class="font-display font-semibold text-sm leading-snug mb-2">{{ $live[0] }}</p>
          <div class="flex items-center gap-2">
            <img src="https://i.pravatar.cc/24?img={{ $live[5] }}" class="w-5 h-5 rounded-full object-cover" alt="">
            <span class="font-body text-xs text-gray-600">{{ $live[1] }}</span>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ═══════════════════════════════════════
     CATEGORY GRID
═══════════════════════════════════════ --}}
<section class="px-6 pb-20">
  <div class="max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-6">
      <div>
        <p class="section-label mb-1">Topik</p>
        <h2 class="font-display font-bold text-2xl">Jelajahi Kategori</h2>
      </div>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
      @foreach([
        ['💻','Teknologi','48 event','rgba(245,158,11','#f59e0b','teknologi'],
        ['🎨','Desain','31 event','rgba(244,63,94','#f87171','desain'],
        ['🤖','AI & Data','19 event','rgba(37,99,235','#93c5fd','ai'],
        ['📊','Bisnis','22 event','rgba(16,185,129','#6ee7b7','bisnis'],
        ['📱','Mobile Dev','14 event','rgba(6,182,212','#67e8f9','mobile'],
        ['🔐','Cybersecurity','8 event','rgba(124,58,237','#c4b5fd','keamanan'],
      ] as $cat)
        <a href="{{ route('webinar') }}?cat={{ $cat[5] }}"
           class="cat-card card-glass rounded-2xl p-5 text-center reveal"
           style="border:1px solid rgba(255,255,255,0.06);">
          <div class="cat-icon w-12 h-12 rounded-xl flex items-center justify-center mx-auto mb-3 text-2xl"
               style="background:{{ $cat[3] }},0.1);border:1px solid {{ $cat[3] }},0.2);">
            {{ $cat[0] }}
          </div>
          <p class="font-display font-semibold text-sm mb-1">{{ $cat[1] }}</p>
          <p class="font-body text-xs text-gray-600">{{ $cat[2] }}</p>
        </a>
      @endforeach
    </div>
  </div>
</section>

{{-- ═══════════════════════════════════════
     FEATURED SEMINAR BANNER
═══════════════════════════════════════ --}}
<section class="px-6 pb-20">
  <div class="max-w-7xl mx-auto">
    <div class="relative overflow-hidden card-glass rounded-3xl p-8 md:p-12 reveal"
         style="border:1px solid rgba(245,158,11,0.12);background:linear-gradient(135deg,rgba(245,158,11,0.07),rgba(17,19,24,0.9));">
      <div style="position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,#f59e0b,#d97706,transparent);"></div>
      <div style="position:absolute;right:0;top:0;bottom:0;width:40%;background:linear-gradient(to left,rgba(245,158,11,0.03),transparent);pointer-events:none;"></div>

      <div class="max-w-2xl relative z-10">
        <div class="flex flex-wrap items-center gap-2 mb-5">
          <span class="badge-soon font-body text-xs px-3 py-1 rounded-full flex items-center gap-1.5">
            <span class="w-1.5 h-1.5 rounded-full bg-amber-400 inline-block" style="animation:amberPulse 1.5s infinite;"></span>
            Seminar Unggulan · Segera Tutup
          </span>
          <span class="badge-free font-body text-xs px-3 py-1 rounded-full">Gratis</span>
        </div>
        <h2 class="font-display font-extrabold text-3xl md:text-4xl tracking-tight mb-4 leading-tight">
          AI &amp; Future of Work:<br/>Bertahan di Era Otomasi
        </h2>
        <p class="font-body text-gray-400 mb-6 text-base leading-relaxed">
          Panel diskusi eksklusif bersama 4 pemimpin industri top Indonesia. Pelajari cara mempersiapkan karier di era kecerdasan buatan.
        </p>
        <div class="flex flex-wrap items-center gap-5 mb-8">
          <div class="flex -space-x-2">
            @foreach([11,5,8,22] as $img)
              <img src="https://i.pravatar.cc/36?img={{ $img }}" class="w-9 h-9 rounded-full object-cover" style="border:2px solid #0b0c10;" alt="">
            @endforeach
          </div>
          <div class="text-sm font-body text-gray-500">4 pembicara · <span style="color:#f59e0b;">350 / 500 kursi</span> terisi</div>
        </div>
        <div class="flex flex-wrap items-center gap-4">
          <a href="{{ route('seminar.index') }}" class="btn-primary px-8 py-3.5 rounded-xl text-white font-display font-bold flex items-center gap-2">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
            Daftar Sekarang — Gratis
          </a>
          <div class="flex items-center gap-2 text-xs text-gray-600 font-body">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            Selasa, 25 Feb 2025 · 09.00 WIB
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ═══════════════════════════════════════
     UPCOMING THIS WEEK
═══════════════════════════════════════ --}}
<section class="px-6 pb-20">
  <div class="max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-6">
      <div>
        <p class="section-label mb-1">Jadwal</p>
        <h2 class="font-display font-bold text-2xl">Minggu Ini</h2>
      </div>
      <div class="flex gap-2">
        <a href="{{ route('webinar') }}" class="btn-ghost px-4 py-2 rounded-lg font-body text-sm text-gray-500">Webinar</a>
        <a href="{{ route('seminar.index') }}" class="btn-ghost px-4 py-2 rounded-lg font-body text-sm text-gray-500">Seminar</a>
      </div>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
      @foreach([
        ['Designing for Accessibility di 2025','22 Feb · Sabtu · 14.00 WIB','Sari Nuraini','Design Lead · Gojek','webinar','desain','5','rgba(124,58,237','#a5b4fc','🎨'],
        ['Analitik Data dengan Python & Pandas','25 Feb · Selasa · 10.00 WIB','Budi Santoso','Data Eng · Bukalapak','webinar','ai','8','rgba(37,99,235','#93c5fd','🤖'],
        ['Cybersecurity Landscape 2025','27 Feb · Kamis · 13.00 WIB','Rafi Ananta','BSSN','seminar','keamanan','22','rgba(239,68,68','#fca5a5','🔐'],
        ['Cloud Architecture AWS','4 Mar · Selasa · 10.00 WIB','Dimas Prastyo','AWS Solutions Architect','seminar','teknologi','42','rgba(245,158,11','#fbbf24','💻'],
        ['Flutter: Aplikasi Pertamamu','28 Feb · Jumat · 13.00 WIB','Aryo Wicaksono','Mobile Dev · Traveloka','webinar','mobile','33','rgba(6,182,212','#67e8f9','📱'],
        ['Venture Capital 101','1 Mar · Sabtu · 14.00 WIB','Andi Wijaya','East Ventures','seminar','bisnis','30','rgba(16,185,129','#6ee7b7','📊'],
      ] as $event)
        <div class="content-card card-glass rounded-2xl p-5 reveal" style="border:1px solid rgba(255,255,255,0.06);">
          <div class="flex items-start gap-4">
            {{-- Date box --}}
            <div class="flex-shrink-0 w-12 text-center">
              <div class="rounded-xl py-2 px-1" style="background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.07);">
                <p class="font-display font-bold text-lg leading-none" style="color:#f59e0b;">{{ explode(' ', $event[1])[1] }}</p>
                <p class="font-body text-xs text-gray-600">{{ explode(' ', $event[1])[2] }}</p>
              </div>
            </div>
            <div class="flex-1 min-w-0">
              <div class="flex flex-wrap items-center gap-2 mb-2">
                <span class="font-body text-xs px-2 py-0.5 rounded-full"
                      style="background:{{ $event[7] }},0.1);border:1px solid {{ $event[7] }},0.2);color:{{ $event[8] }};">
                  {{ $event[9] }} {{ ucfirst($event[5]) }}
                </span>
                <span class="font-body text-xs px-2 py-0.5 rounded-full capitalize"
                      style="background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.07);color:rgba(255,255,255,0.4);">
                  {{ $event[4] }}
                </span>
              </div>
              <p class="font-display font-semibold text-sm leading-snug mb-2">{{ $event[0] }}</p>
              <div class="flex items-center gap-2 mb-3">
                <img src="https://i.pravatar.cc/22?img={{ $event[6] }}" class="w-5 h-5 rounded-full object-cover" alt="">
                <span class="font-body text-xs text-gray-600">{{ $event[2] }} · {{ $event[3] }}</span>
              </div>
              <div class="flex items-center justify-between">
                <span class="font-body text-xs text-gray-700">{{ implode(' · ', array_slice(explode(' · ', $event[1]), 1)) }}</span>
                <button class="btn-primary px-3 py-1.5 rounded-lg text-xs text-white font-body font-medium">Daftar →</button>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ═══════════════════════════════════════
     FEATURED INSTRUCTORS
═══════════════════════════════════════ --}}
<section class="px-6 pb-20">
  <div class="max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-6">
      <div>
        <p class="section-label mb-1">Tim Pengajar</p>
        <h2 class="font-display font-bold text-2xl">Instruktur Unggulan</h2>
      </div>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
      @foreach([
        ['Kevin Rahardian','Senior PM · Tokopedia','11','32 sesi'],
        ['Sari Nuraini','Design Lead · Gojek','5','18 sesi'],
        ['Budi Santoso','Data Eng · Bukalapak','8','24 sesi'],
        ['Maya Kusuma','Co-founder · StartupID','15','15 sesi'],
        ['Dina Pratiwi','Designer · Shopee','20','20 sesi'],
        ['Rafi Ananta','Cybersec · BSSN','22','12 sesi'],
      ] as $inst)
        <div class="instructor-card card-glass rounded-2xl p-5 text-center reveal" style="border:1px solid rgba(255,255,255,0.06);">
          <div class="relative w-14 h-14 mx-auto mb-3">
            <img src="https://i.pravatar.cc/56?img={{ $inst[2] }}" class="w-14 h-14 rounded-xl object-cover" style="border:2px solid rgba(245,158,11,0.2);" alt="{{ $inst[0] }}">
            <div class="absolute -bottom-1 -right-1">
              <div class="live-dot" style="width:8px;height:8px;border:1.5px solid #0b0c10;"></div>
            </div>
          </div>
          <p class="font-display font-semibold text-sm mb-0.5">{{ $inst[0] }}</p>
          <p class="font-body text-xs text-gray-600 mb-2 leading-tight">{{ $inst[1] }}</p>
          <span class="badge-pill font-body text-xs px-2.5 py-0.5 rounded-full" style="color:#f59e0b;">{{ $inst[3] }}</span>
        </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ═══════════════════════════════════════
     RECENTLY ADDED RECORDINGS
═══════════════════════════════════════ --}}
<section class="px-6 pb-20">
  <div class="max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-6">
      <div>
        <p class="section-label mb-1">On Demand</p>
        <h2 class="font-display font-bold text-2xl">Rekaman Terbaru</h2>
      </div>
      <a href="{{ route('webinar') }}?status=recorded" class="btn-ghost px-4 py-2 rounded-lg font-body text-sm text-gray-500">Lihat semua →</a>
    </div>

    <div class="h-scroll">
      @foreach([
        ['Next.js 14 Full Course','Rizky Firmansyah','2j 14m','4.8K ditonton','3','rgba(16,185,129','#6ee7b7'],
        ['Figma Advanced Components','Dina Pratiwi','1j 45m','6.1K ditonton','20','rgba(244,63,94','#fda4af'],
        ['Python Dasar untuk Pemula','Budi Santoso','3j 02m','9.2K ditonton','8','rgba(37,99,235','#93c5fd'],
        ['Intro to SQL','Andi Wijaya','1j 20m','3.4K ditonton','30','rgba(245,158,11','#fbbf24'],
        ['UX Research Methods','Sari Nuraini','2j 30m','5.7K ditonton','5','rgba(124,58,237','#c4b5fd'],
      ] as $rec)
        <div class="h-scroll-card content-card card-glass rounded-2xl p-5 w-64" style="border:1px solid rgba(255,255,255,0.06);">
          <div class="h-28 rounded-xl mb-4 flex items-center justify-center relative overflow-hidden"
               style="background:linear-gradient(135deg,{{ $rec[5] }},0.1),{{ $rec[5] }},0.03));">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="{{ $rec[6] }}" stroke-width="1.5" opacity="0.6"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2"/></svg>
            <div class="absolute top-2 right-2">
              <span class="badge-recorded font-body text-xs px-2 py-0.5 rounded-full">Rekaman</span>
            </div>
            <div class="absolute bottom-2 right-2 px-2 py-0.5 rounded text-xs font-body text-white" style="background:rgba(0,0,0,0.6);">{{ $rec[2] }}</div>
          </div>
          <p class="font-display font-semibold text-sm leading-snug mb-2">{{ $rec[0] }}</p>
          <div class="flex items-center gap-2 mb-3">
            <img src="https://i.pravatar.cc/22?img={{ $rec[4] }}" class="w-5 h-5 rounded-full object-cover" alt="">
            <span class="font-body text-xs text-gray-600">{{ $rec[1] }}</span>
          </div>
          <div class="flex items-center justify-between">
            <span class="font-body text-xs text-gray-700">{{ $rec[3] }}</span>
            <button class="btn-ghost px-3 py-1 rounded-lg text-xs text-gray-500 font-body">Tonton →</button>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ═══════════════════════════════════════
     CTA SECTION
═══════════════════════════════════════ --}}
<section class="px-6 pb-24">
  <div class="max-w-7xl mx-auto">
    <div class="card-glass rounded-3xl p-10 md:p-16 text-center reveal relative overflow-hidden"
         style="border:1px solid rgba(245,158,11,0.1);">
      <div style="position:absolute;inset:0;background:radial-gradient(ellipse at center,rgba(245,158,11,0.06),transparent 70%);pointer-events:none;"></div>
      <div style="position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(90deg,transparent,rgba(245,158,11,0.4),transparent);"></div>

      <div class="relative z-10">
        <p class="section-label mb-3">Mulai Sekarang</p>
        <h2 class="font-display font-extrabold text-4xl md:text-5xl tracking-tight mb-5 text-glow">
          Siap Tingkatkan Skillmu?
        </h2>
        <p class="font-body text-gray-500 text-lg mb-10 max-w-xl mx-auto">
          Daftar gratis dan mulai belajar dari ratusan instruktur terbaik Indonesia hari ini.
        </p>
        <div class="flex flex-wrap items-center justify-center gap-4">
          @auth
            <a href="{{ route('webinar') }}" class="btn-primary px-10 py-4 rounded-2xl text-white font-display font-bold text-base">
              Jelajahi Webinar →
            </a>
          @else
            <a href="{{ route('register') }}" class="btn-primary px-10 py-4 rounded-2xl text-white font-display font-bold text-base">
              Daftar Gratis — Mulai Sekarang →
            </a>
            <a href="{{ route('login') }}" class="btn-ghost px-8 py-4 rounded-2xl font-body text-gray-400 text-base">
              Sudah punya akun? Masuk
            </a>
          @endauth
        </div>
        <p class="font-body text-xs text-gray-700 mt-6">Tidak perlu kartu kredit · Gratis selamanya</p>
      </div>
    </div>
  </div>
</section>

@endsection

@push('scripts')
<script>
  function heroSearch(val) {
    if (!val.trim()) return;
    // Could redirect to webinar with search param
    // window.location.href = "{{ route('webinar') }}?q=" + encodeURIComponent(val);
  }

  // Keyboard shortcut ⌘K / Ctrl+K focus search
  document.addEventListener('keydown', e => {
    if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
      e.preventDefault();
      document.getElementById('hero-search').focus();
    }
  });
</script>
@endpush