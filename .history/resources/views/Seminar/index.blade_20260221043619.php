@extends('layouts.app')

@section('title', 'Seminar')
@section('meta-description', 'Sesi intensif dengan pembicara kelas dunia. Materi mendalam, format terstruktur, dan sertifikat terverifikasi untuk semua peserta.')

@push('styles')
  .seminar-card { transition: all 0.28s ease; cursor: pointer; }
  .seminar-card:hover { transform: translateY(-3px); border-color: rgba(245,158,11,0.2) !important; }

  .hero-banner { position: relative; overflow: hidden; }
  .hero-banner::before { content: ''; position: absolute; inset: 0; background: linear-gradient(135deg,rgba(245,158,11,0.08) 0%,transparent 60%); }
  .hero-banner .top-accent { position: absolute; top: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg,#f59e0b,#d97706,transparent); }

  .speaker-chip { display: inline-flex; align-items: center; gap: 8px; background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.07); border-radius: 100px; padding: 5px 12px 5px 5px; }

  @keyframes amberPulseDot {
    0%, 100% { opacity: 1; } 50% { opacity: 0.5; }
  }
  .countdown { font-family: 'DM Mono', monospace; letter-spacing: 0.04em; }
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-6 pt-36 pb-24">

  <!-- BG Orbs -->
  <div class="orb" style="width:600px;height:400px;background:rgba(245,158,11,0.06);top:-100px;left:-100px;animation:glowPulse 7s ease-in-out infinite;position:fixed;z-index:0;"></div>
  <div class="orb" style="width:350px;height:350px;background:rgba(99,102,241,0.04);bottom:200px;right:-80px;animation:glowPulse 9s ease-in-out infinite reverse;position:fixed;z-index:0;"></div>

  <!-- PAGE HEADER -->
  <div class="mb-10 stagger-1">
    <div class="flex flex-wrap items-end justify-between gap-5 mb-8">
      <div>
        <span class="font-body text-xs uppercase tracking-widest mb-2 block" style="color:rgba(245,158,11,0.7);">Edukasi Mendalam</span>
        <h1 class="font-display font-extrabold tracking-tight text-glow" style="font-size:clamp(2rem,5vw,3.4rem);line-height:1;">Semua Seminar</h1>
        <p class="font-body text-gray-500 text-sm mt-2">Sesi intensif, materi mendalam, dan pembicara kelas dunia. Sertifikat terverifikasi.</p>
      </div>
      <div class="flex items-center gap-3">
        <div class="card-glass rounded-xl px-4 py-3 text-center"><p class="font-display font-bold text-xl" style="color:#f59e0b;">72</p><p class="font-body text-xs text-gray-600">Bulan Ini</p></div>
        <div class="card-glass rounded-xl px-4 py-3 text-center"><p class="font-display font-bold text-xl text-white">150+</p><p class="font-body text-xs text-gray-600">Pembicara</p></div>
        <div class="card-glass rounded-xl px-4 py-3 text-center"><p class="font-display font-bold text-xl text-white">100%</p><p class="font-body text-xs text-gray-600">Gratis</p></div>
      </div>
    </div>

    <!-- Search + date filter -->
    <div class="flex flex-col sm:flex-row gap-3 mb-6">
      <div class="relative flex-1 max-w-xl">
        <svg class="absolute top-1/2 -translate-y-1/2 text-gray-600" style="left:14px;" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
        <input type="text" id="search-input" placeholder="Cari seminar, topik, pembicara…" class="search-field" oninput="filterCards()">
      </div>
      <select class="search-field" style="padding-left:16px;max-width:180px;cursor:pointer;">
        <option>Semua Waktu</option><option>Minggu Ini</option><option>Bulan Ini</option><option>Bulan Depan</option>
      </select>
    </div>

    <!-- Filter chips -->
    <div class="flex flex-wrap gap-2">
      <button class="chip active" data-filter="all"       onclick="setFilter(this,'all')">Semua</button>
      <button class="chip"        data-filter="open"      onclick="setFilter(this,'open')"><span class="flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-green-400 inline-block"></span>Buka</span></button>
      <button class="chip"        data-filter="soon"      onclick="setFilter(this,'soon')">Segera Tutup</button>
      <button class="chip"        data-filter="closed"    onclick="setFilter(this,'closed')">Arsip</button>
      <div class="w-px mx-1" style="background:rgba(255,255,255,0.08);"></div>
      <button class="chip"        data-filter="teknologi" onclick="setFilter(this,'teknologi')">💻 Teknologi</button>
      <button class="chip"        data-filter="bisnis"    onclick="setFilter(this,'bisnis')">📊 Bisnis</button>
      <button class="chip"        data-filter="ai"        onclick="setFilter(this,'ai')">🤖 AI &amp; Data</button>
      <button class="chip"        data-filter="desain"    onclick="setFilter(this,'desain')">🎨 Desain</button>
      <button class="chip"        data-filter="keamanan"  onclick="setFilter(this,'keamanan')">🔐 Cybersecurity</button>
    </div>
  </div>

  <!-- LAYOUT -->
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
        <div class="card-glass rounded-2xl p-4 mb-5">
          <p class="font-body text-xs text-gray-600 uppercase tracking-widest mb-3">Minggu Ini</p>
          <div class="space-y-4">
            <div>
              <p class="font-body text-xs font-medium text-white mb-0.5">AI &amp; Future of Work</p>
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
        <div class="card-glass rounded-2xl p-4">
          <p class="font-body text-xs text-gray-600 uppercase tracking-widest mb-3">Format</p>
          <div class="space-y-1.5">
            <label class="flex items-center gap-2 cursor-pointer py-1"><input type="checkbox" checked class="accent-amber-500"><span class="font-body text-sm text-gray-400">Online</span></label>
            <label class="flex items-center gap-2 cursor-pointer py-1"><input type="checkbox" class="accent-amber-500"><span class="font-body text-sm text-gray-400">Hybrid</span></label>
            <label class="flex items-center gap-2 cursor-pointer py-1"><input type="checkbox" class="accent-amber-500"><span class="font-body text-sm text-gray-400">Offline</span></label>
          </div>
        </div>
      </div>
    </aside>

    <!-- MAIN -->
    <div class="flex-1 min-w-0">

      <!-- Featured Hero -->
      <div class="hero-banner card-glass rounded-3xl mb-6 reveal seminar-card" data-status="soon" data-cat="ai" data-title="AI dan Future of Work Bertahan di Era Otomasi" style="border:1px solid rgba(245,158,11,0.14);">
        <div class="top-accent"></div>
        <div class="relative p-8 flex flex-col md:flex-row items-start md:items-center gap-6">
          <div class="flex-1">
            <div class="flex flex-wrap items-center gap-2 mb-4">
              <span class="badge-soon font-body text-xs px-3 py-1 rounded-full flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-amber-400 inline-block"></span>Segera Tutup</span>
              <span class="badge-pill font-body text-xs px-3 py-1 rounded-full" style="color:#f59e0b;">🤖 AI &amp; Data</span>
              <span class="badge-free font-body text-xs px-3 py-1 rounded-full">Gratis</span>
              <span class="font-body text-xs text-gray-600 ml-1 countdown" id="countdown-text">⏱ 2h 34m tersisa</span>
            </div>
            <h2 class="font-display font-bold text-2xl md:text-3xl leading-tight mb-3 tracking-tight">AI &amp; Future of Work:<br/>Bertahan di Era Otomasi</h2>
            <p class="font-body text-sm text-gray-500 mb-5 max-w-lg">Panel diskusi eksklusif bersama 4 pemimpin industri membahas dampak nyata AI pada karier dan cara mempersiapkan diri.</p>
            <div class="flex flex-wrap items-center gap-2 mb-5">
              <div class="speaker-chip"><img src="https://i.pravatar.cc/26?img=11" class="w-6 h-6 rounded-full object-cover" alt=""><span class="font-body text-xs text-gray-300">Kevin R.</span></div>
              <div class="speaker-chip"><img src="https://i.pravatar.cc/26?img=5" class="w-6 h-6 rounded-full object-cover" alt=""><span class="font-body text-xs text-gray-300">Sari N.</span></div>
              <div class="speaker-chip"><img src="https://i.pravatar.cc/26?img=8" class="w-6 h-6 rounded-full object-cover" alt=""><span class="font-body text-xs text-gray-300">Budi S.</span></div>
              <span class="font-body text-xs text-gray-600">+1 pembicara</span>
            </div>
            <div class="flex flex-wrap items-center gap-4">
              <div class="flex items-center gap-2 text-xs text-gray-500 font-body"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/></svg>Selasa, 25 Feb 2025 · 09.00 — 12.00 WIB</div>
              <div class="flex items-center gap-2 text-xs text-gray-500 font-body"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>350 / 500 kursi</div>
            </div>
          </div>
          <div class="flex-shrink-0 flex flex-col items-center gap-3">
            <div class="card-glass rounded-2xl p-5 text-center" style="border:1px solid rgba(245,158,11,0.15);min-width:150px;">
              <p class="font-body text-xs text-gray-600 mb-2">Kursi Tersedia</p>
              <p class="font-display font-bold text-3xl text-white mb-1">150</p>
              <div class="seat-bar mb-2"><div class="seat-fill" style="width:70%;"></div></div>
              <p class="font-body text-xs text-gray-700">dari 500 total</p>
            </div>
            <button class="btn-primary w-full py-3 rounded-xl text-white font-display font-semibold text-sm">Daftar Sekarang</button>
          </div>
        </div>
      </div>

      <!-- Results meta -->
      <div class="flex items-center justify-between mb-5">
        <p class="font-body text-sm text-gray-600" id="results-count">Menampilkan <span class="text-white font-medium">72</span> seminar</p>
      </div>

      <!-- List -->
      <div class="flex flex-col gap-4 mb-8" id="cards-list">

        @php
          $seminars = [
            ['status'=>'open',  'cat'=>'keamanan',  'title'=>'Cybersecurity Landscape 2025: Ancaman & Cara Mitigasi',  'cat_label'=>'🔐 Cybersecurity','cat_color'=>'rgba(239,68,68',  'text_color'=>'#fca5a5','speaker_name'=>'Rafi Ananta','speaker_role'=>'BSSN','speaker_img'=>'22','date'=>'27 Feb · 13.00 — 16.00 WIB','seats'=>410,'total'=>500,'seats_pct'=>82,'seats_color'=>'linear-gradient(90deg,#ef4444,#dc2626)','seats_text'=>'color:#f87171'],
            ['status'=>'open',  'cat'=>'bisnis',    'title'=>'Venture Capital & Startup Funding 101',                  'cat_label'=>'📊 Bisnis',       'cat_color'=>'rgba(16,185,129', 'text_color'=>'#6ee7b7','speaker_name'=>'Andi Wijaya','speaker_role'=>'East Ventures','speaker_img'=>'30','date'=>'1 Mar · 14.00 — 16.00 WIB','seats'=>200,'total'=>500,'seats_pct'=>40,'seats_color'=>'linear-gradient(90deg,#f59e0b,#d97706)','seats_text'=>'color:rgba(255,255,255,0.4)'],
            ['status'=>'open',  'cat'=>'teknologi', 'title'=>'Cloud Architecture AWS untuk Backend Engineer',          'cat_label'=>'💻 Teknologi',    'cat_color'=>'rgba(245,158,11', 'text_color'=>'#fbbf24','speaker_name'=>'Dimas Prastyo','speaker_role'=>'AWS Solutions Architect','speaker_img'=>'42','date'=>'4 Mar · 10.00 — 13.00 WIB','seats'=>125,'total'=>500,'seats_pct'=>25,'seats_color'=>'linear-gradient(90deg,#f59e0b,#d97706)','seats_text'=>'color:rgba(255,255,255,0.4)'],
            ['status'=>'closed','cat'=>'desain',    'title'=>'Design Systems at Scale: Tokopedia & Gojek',            'cat_label'=>'🎨 Desain',       'cat_color'=>'rgba(124,58,237', 'text_color'=>'#c4b5fd','speaker_name'=>'Dina P. & Sari N.','speaker_role'=>'Shopee, Gojek','speaker_img'=>'20','date'=>'15 Jan · Selesai','seats'=>500,'total'=>500,'seats_pct'=>100,'seats_color'=>'linear-gradient(90deg,#6b7280,#4b5563)','seats_text'=>'color:rgba(255,255,255,0.25)'],
            ['status'=>'open',  'cat'=>'ai',        'title'=>'Machine Learning in Production: Notebook → Deployment',  'cat_label'=>'🤖 AI & Data',    'cat_color'=>'rgba(37,99,235',  'text_color'=>'#93c5fd','speaker_name'=>'Hana Pertiwi','speaker_role'=>'ex-NASA, ML Engineer','speaker_img'=>'38','date'=>'8 Mar · 09.00 — 12.00 WIB','seats'=>90,'total'=>500,'seats_pct'=>18,'seats_color'=>'linear-gradient(90deg,#f59e0b,#d97706)','seats_text'=>'color:rgba(255,255,255,0.4)'],
          ];
        @endphp

        @foreach($seminars as $s)
          <div class="seminar-card card-glass rounded-2xl p-5 reveal {{ $s['status'] === 'closed' ? 'opacity-60' : '' }}"
               data-status="{{ $s['status'] }}" data-cat="{{ $s['cat'] }}" data-title="{{ $s['title'] }}"
               style="border:1px solid rgba(255,255,255,0.06);">
            <div class="flex flex-col sm:flex-row gap-5">
              <!-- Thumbnail -->
              <div class="flex-shrink-0 w-full sm:w-44 h-28 rounded-xl overflow-hidden flex items-center justify-center relative"
                   style="background:linear-gradient(135deg,{{ $s['cat_color'] }},0.12),{{ $s['cat_color'] }},0.03));">
                @if($s['status'] === 'closed')
                  <div class="absolute inset-0 flex items-center justify-center" style="background:rgba(11,12,16,0.6);backdrop-filter:blur(2px);">
                    <span class="badge-closed font-body text-xs px-2.5 py-1 rounded-full">Selesai</span>
                  </div>
                @endif
              </div>
              <!-- Info -->
              <div class="flex-1 min-w-0">
                <div class="flex flex-wrap items-center gap-2 mb-2">
                  @if($s['status'] === 'open')    <span class="badge-open font-body text-xs px-2.5 py-0.5 rounded-full">Buka</span>
                  @elseif($s['status'] === 'soon') <span class="badge-soon font-body text-xs px-2.5 py-0.5 rounded-full">Segera Tutup</span>
                  @else                            <span class="badge-closed font-body text-xs px-2.5 py-0.5 rounded-full">Arsip</span>
                  @endif
                  <span class="font-body text-xs px-2.5 py-0.5 rounded-full" style="background:{{ $s['cat_color'] }},0.1);border:1px solid {{ $s['cat_color'] }},0.2);color:{{ $s['text_color'] }};">{{ $s['cat_label'] }}</span>
                  @if($s['status'] !== 'closed') <span class="badge-free font-body text-xs px-2.5 py-0.5 rounded-full">Gratis</span> @endif
                </div>
                <h3 class="font-display font-bold text-base leading-snug mb-1">{{ $s['title'] }}</h3>
                <div class="flex flex-wrap items-center justify-between gap-3 mt-3">
                  <div class="speaker-chip">
                    <img src="https://i.pravatar.cc/24?img={{ $s['speaker_img'] }}" class="w-5 h-5 rounded-full" alt="">
                    <span class="font-body text-xs text-gray-400">{{ $s['speaker_name'] }} · {{ $s['speaker_role'] }}</span>
                  </div>
                  <div class="flex items-center gap-4">
                    <span class="text-xs text-gray-600 font-body flex items-center gap-1.5">
                      <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                      {{ $s['date'] }}
                    </span>
                    @if($s['status'] !== 'closed')
                      <div class="flex flex-col items-end">
                        <div class="seat-bar w-20 mb-1"><div class="seat-fill" style="width:{{ $s['seats_pct'] }}%;background:{{ $s['seats_color'] }};"></div></div>
                        <span class="text-xs font-body" style="{{ $s['seats_text'] }}">{{ $s['seats'] }}/{{ $s['total'] }}</span>
                      </div>
                      <button class="btn-primary px-4 py-2 rounded-lg text-xs text-white font-body font-semibold whitespace-nowrap">Daftar →</button>
                    @else
                      <button class="btn-ghost px-4 py-2 rounded-lg text-xs text-gray-600 font-body" disabled>Ditutup</button>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach

      </div>

      <!-- Empty state -->
      <div id="empty-state" class="hidden text-center py-20">
        <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4" style="background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.08);">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.2)" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
        </div>
        <p class="font-display font-semibold text-gray-600 mb-1">Tidak ada seminar ditemukan</p>
        <p class="font-body text-sm text-gray-700">Coba kata kunci atau filter lain</p>
      </div>

      <!-- Pagination -->
      <div class="flex items-center justify-between">
        <p class="font-body text-xs text-gray-700">Halaman 1 dari 8</p>
        <div class="flex items-center gap-2">
          <button class="page-btn" style="opacity:0.3;cursor:default;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg></button>
          <button class="page-btn active">1</button>
          <button class="page-btn">2</button>
          <button class="page-btn">3</button>
          <span class="font-body text-xs text-gray-700 px-1">…</span>
          <button class="page-btn">8</button>
          <button class="page-btn"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg></button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
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
    const cards  = document.querySelectorAll('#cards-list .seminar-card');
    let visible  = 0;
    cards.forEach(card => {
      const match = (currentFilter === 'all' || currentFilter === card.dataset.status || currentFilter === card.dataset.cat)
                 && (!search || card.dataset.title.toLowerCase().includes(search));
      card.style.display = match ? '' : 'none';
      if (match) visible++;
    });
    document.getElementById('empty-state').classList.toggle('hidden', visible > 0);
    document.getElementById('results-count').innerHTML = `Menampilkan <span class="text-white font-medium">${visible}</span> seminar`;
  }

  // Countdown
  let mins = 154, secs = 0;
  setInterval(() => {
    if (secs === 0) { mins--; secs = 59; } else secs--;
    const el = document.getElementById('countdown-text');
    if (el) el.textContent = `⏱ ${mins}m ${secs < 10 ? '0'+secs : secs}s tersisa`;
  }, 1000);
</script>
@endpush