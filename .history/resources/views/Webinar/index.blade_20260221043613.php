@extends('layouts.app')

@section('title', 'Webinar')
@section('meta-description', 'Temukan ratusan webinar live, rekaman, dan mendatang dari para profesional industri terbaik Indonesia. Gratis untuk semua.')

@push('styles')
  .webinar-card { transition: all 0.28s ease; cursor: pointer; }
  .webinar-card:hover { transform: translateY(-4px); border-color: rgba(245,158,11,0.22) !important; }

  .featured-card { position: relative; overflow: hidden; }
  .featured-card::before { content: ''; position: absolute; inset: 0; background: linear-gradient(135deg, rgba(245,158,11,0.06) 0%, transparent 60%); pointer-events: none; }
  .featured-card .top-accent { position: absolute; top: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, #f59e0b, #d97706, transparent); }

  .speaker-chip { display: inline-flex; align-items: center; gap: 8px; background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.07); border-radius: 100px; padding: 5px 12px 5px 5px; }

  .diagonal-line { position: absolute; width: 1px; height: 200px; background: linear-gradient(to bottom, transparent, rgba(245,158,11,0.3), transparent); transform: rotate(30deg); }
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-6 pt-36 pb-24">

  <!-- BG Orbs -->
  <div class="orb" style="width:500px;height:400px;background:rgba(245,158,11,0.07);top:-120px;right:-60px;animation:glowPulse 6s ease-in-out infinite;position:fixed;z-index:0;"></div>
  <div class="orb" style="width:300px;height:300px;background:rgba(99,102,241,0.05);bottom:300px;left:-80px;animation:glowPulse 8s ease-in-out infinite reverse;position:fixed;z-index:0;"></div>
  <div class="diagonal-line" style="top:140px;left:12%;z-index:0;"></div>

  <!-- PAGE HEADER -->
  <div class="mb-10 stagger-1">
    <div class="flex flex-wrap items-end justify-between gap-4 mb-6">
      <div>
        <span class="font-body text-xs uppercase tracking-widest mb-2 block" style="color:rgba(245,158,11,0.7);">Live &amp; On-Demand</span>
        <h1 class="font-display font-extrabold tracking-tight text-glow" style="font-size:clamp(2rem,5vw,3.4rem);line-height:1;">Semua Webinar</h1>
        <p class="font-body text-gray-500 text-sm mt-2">Temukan sesi live, replay, dan yang akan datang — semuanya gratis.</p>
      </div>
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
      <svg class="absolute top-1/2 -translate-y-1/2 text-gray-600" style="left:14px;" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
      <input type="text" id="search-input" placeholder="Cari webinar, topik, atau instruktur…" class="search-field" oninput="filterCards()">
    </div>
  </div>

  <!-- FILTER CHIPS -->
  <div class="flex flex-wrap gap-2 mb-10 stagger-2">
    <button class="chip active" data-filter="all"       onclick="setFilter(this,'all')">Semua</button>
    <button class="chip"        data-filter="live"      onclick="setFilter(this,'live')"><span class="flex items-center gap-1.5"><span class="live-dot" style="width:6px;height:6px;"></span>Live Sekarang</span></button>
    <button class="chip"        data-filter="upcoming"  onclick="setFilter(this,'upcoming')">Mendatang</button>
    <button class="chip"        data-filter="recorded"  onclick="setFilter(this,'recorded')">Rekaman</button>
    <div class="w-px mx-1" style="background:rgba(255,255,255,0.08);"></div>
    <button class="chip"        data-filter="teknologi" onclick="setFilter(this,'teknologi')">💻 Teknologi</button>
    <button class="chip"        data-filter="desain"    onclick="setFilter(this,'desain')">🎨 Desain</button>
    <button class="chip"        data-filter="bisnis"    onclick="setFilter(this,'bisnis')">📊 Bisnis</button>
    <button class="chip"        data-filter="ai"        onclick="setFilter(this,'ai')">🤖 AI &amp; Data</button>
    <button class="chip"        data-filter="mobile"    onclick="setFilter(this,'mobile')">📱 Mobile</button>
  </div>

  <!-- CONTENT -->
  <div class="flex gap-8">

    <!-- SIDEBAR -->
    <aside class="hidden xl:block w-56 flex-shrink-0">
      <div class="sidebar">
        <div class="card-glass rounded-2xl p-4 mb-5">
          <p class="font-body text-xs text-gray-600 uppercase tracking-widest mb-3">Kategori</p>
          <div class="space-y-0.5">
            <div class="cat-item active font-body text-sm text-gray-400" onclick="setFilter(null,'all')"><span>Semua Topik</span><span class="cat-count">134</span></div>
            <div class="cat-item font-body text-sm text-gray-400" onclick="setFilter(null,'teknologi')"><span>💻 Teknologi</span><span class="cat-count">48</span></div>
            <div class="cat-item font-body text-sm text-gray-400" onclick="setFilter(null,'desain')"><span>🎨 Desain</span><span class="cat-count">31</span></div>
            <div class="cat-item font-body text-sm text-gray-400" onclick="setFilter(null,'bisnis')"><span>📊 Bisnis</span><span class="cat-count">22</span></div>
            <div class="cat-item font-body text-sm text-gray-400" onclick="setFilter(null,'ai')"><span>🤖 AI &amp; Data</span><span class="cat-count">19</span></div>
            <div class="cat-item font-body text-sm text-gray-400" onclick="setFilter(null,'mobile')"><span>📱 Mobile Dev</span><span class="cat-count">14</span></div>
          </div>
        </div>
        <div class="card-glass rounded-2xl p-4 mb-5">
          <p class="font-body text-xs text-gray-600 uppercase tracking-widest mb-3">Urutkan</p>
          <div class="space-y-1">
            <label class="flex items-center gap-2 cursor-pointer py-1.5"><input type="radio" name="sort" checked class="accent-amber-500"><span class="font-body text-sm text-gray-400">Terbaru</span></label>
            <label class="flex items-center gap-2 cursor-pointer py-1.5"><input type="radio" name="sort" class="accent-amber-500"><span class="font-body text-sm text-gray-400">Terpopuler</span></label>
            <label class="flex items-center gap-2 cursor-pointer py-1.5"><input type="radio" name="sort" class="accent-amber-500"><span class="font-body text-sm text-gray-400">A – Z</span></label>
          </div>
        </div>
        <div class="card-glass rounded-2xl p-4">
          <p class="font-body text-xs text-gray-600 uppercase tracking-widest mb-3">Jadwal Hari Ini</p>
          <div class="space-y-3">
            <div class="flex items-start gap-2.5"><div class="w-1 min-h-[32px] rounded-full flex-shrink-0" style="background:#f59e0b;"></div><div><p class="font-body text-xs font-medium text-white">PM Framework Modern</p><p class="font-body text-xs text-gray-600">19.00 — Kevin R.</p></div></div>
            <div class="flex items-start gap-2.5"><div class="w-1 min-h-[32px] rounded-full flex-shrink-0" style="background:#7c3aed;"></div><div><p class="font-body text-xs font-medium text-white">Python &amp; Pandas</p><p class="font-body text-xs text-gray-600">21.00 — Budi S.</p></div></div>
            <div class="flex items-start gap-2.5"><div class="w-1 min-h-[32px] rounded-full flex-shrink-0" style="background:#2563eb;"></div><div><p class="font-body text-xs font-medium text-white">Cybersecurity 101</p><p class="font-body text-xs text-gray-600">22.00 — Rafi A.</p></div></div>
          </div>
        </div>
      </div>
    </aside>

    <!-- MAIN -->
    <div class="flex-1 min-w-0">

      <!-- Featured Live -->
      <div class="featured-card card-glass rounded-2xl p-6 mb-6 reveal webinar-card" data-status="live" data-cat="bisnis" data-title="Dari Ide ke Produk: Framework PM Modern" style="border:1px solid rgba(245,158,11,0.14);">
        <div class="top-accent"></div>
        <div class="flex flex-col md:flex-row gap-6">
          <div class="flex-shrink-0 w-full md:w-52 h-36 rounded-xl relative flex items-center justify-center" style="background:linear-gradient(135deg,rgba(245,158,11,0.15),rgba(245,158,11,0.04));">
            <div class="w-14 h-14 rounded-full flex items-center justify-center" style="background:rgba(245,158,11,0.15);border:2px solid rgba(245,158,11,0.3);">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2"><polygon points="5 3 19 12 5 21 5 3"/></svg>
            </div>
            <div class="absolute bottom-2 left-2 flex items-center gap-1.5 px-2 py-1 rounded-lg" style="background:rgba(0,0,0,0.6);backdrop-filter:blur(8px);">
              <div class="live-dot" style="width:6px;height:6px;"></div>
              <span class="font-body text-xs text-white">1.240 menonton</span>
            </div>
          </div>
          <div class="flex-1 min-w-0">
            <div class="flex flex-wrap items-center gap-2 mb-3">
              <span class="badge-live font-body text-xs px-3 py-1 rounded-full flex items-center gap-1.5"><div class="live-dot" style="width:6px;height:6px;"></div>LIVE SEKARANG</span>
              <span class="badge-pill font-body text-xs px-3 py-1 rounded-full" style="color:#f59e0b;">Product Management</span>
            </div>
            <h2 class="font-display font-bold text-xl leading-snug mb-2">Dari Ide ke Produk: Framework PM Modern</h2>
            <p class="font-body text-sm text-gray-500 mb-4 line-clamp-2">Pelajari framework product thinking yang digunakan para PM top Indonesia untuk mengubah ide mentah menjadi produk nyata.</p>
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

      <!-- Results meta + view toggle -->
      <div class="flex items-center justify-between mb-5">
        <p class="font-body text-sm text-gray-600" id="results-count">Menampilkan <span class="text-white font-medium">134</span> webinar</p>
        <div class="flex items-center gap-2">
          <button class="page-btn active" style="width:auto;padding:0 12px;" onclick="toggleView('grid')" id="view-grid">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
          </button>
          <button class="page-btn" style="width:auto;padding:0 12px;" onclick="toggleView('list')" id="view-list">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
          </button>
        </div>
      </div>

      <!-- Cards Grid -->
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4 mb-8" id="cards-grid">

        @php
          $webinars = [
            ['status'=>'upcoming','cat'=>'desain',    'title'=>'Designing for Accessibility di 2025',       'cat_label'=>'🎨 Desain',    'cat_color'=>'rgba(124,58,237',  'icon_color'=>'rgba(124,58,237,0.6)', 'text_color'=>'#a5b4fc', 'desc'=>'Panduan lengkap membuat produk digital inklusif dan ramah untuk semua pengguna.','speaker_name'=>'Sari Nuraini','speaker_role'=>'Design Lead · Gojek','speaker_img'=>'5','date'=>'22 Feb · 14.00 WIB','cta'=>'Daftar →','meta'=>'22 Feb · 14.00 WIB','badge'=>'Mendatang'],
            ['status'=>'upcoming','cat'=>'ai',        'title'=>'Analitik Data dengan Python & Pandas',       'cat_label'=>'🤖 AI & Data', 'cat_color'=>'rgba(37,99,235',   'icon_color'=>'rgba(37,99,235,0.7)',  'text_color'=>'#93c5fd', 'desc'=>'Kuasai analitik data menggunakan Python dan Pandas dari nol hingga siap kerja.','speaker_name'=>'Budi Santoso','speaker_role'=>'Data Engineer · Bukalapak','speaker_img'=>'8','date'=>'25 Feb · 10.00 WIB','cta'=>'Daftar →','meta'=>'25 Feb · 10.00 WIB','badge'=>'Mendatang'],
            ['status'=>'recorded','cat'=>'teknologi', 'title'=>'Next.js 14 Full Course untuk Pemula',        'cat_label'=>'💻 Teknologi', 'cat_color'=>'rgba(16,185,129',  'icon_color'=>'rgba(16,185,129,0.7)', 'text_color'=>'#6ee7b7', 'desc'=>'Belajar membangun aplikasi web modern dengan Next.js 14, dari routing hingga server actions.','speaker_name'=>'Rizky Firmansyah','speaker_role'=>'Frontend Lead · Ruangguru','speaker_img'=>'3','date'=>'4.8K ditonton','cta'=>'Tonton →','meta'=>'4.8K ditonton','badge'=>'Rekaman'],
            ['status'=>'live',    'cat'=>'bisnis',    'title'=>'Growth Hacking untuk Startup',               'cat_label'=>'📊 Bisnis',    'cat_color'=>'rgba(245,158,11',  'icon_color'=>'rgba(245,158,11,0.7)','text_color'=>'#fbbf24', 'desc'=>'Strategi pertumbuhan yang terbukti untuk startup yang baru memulai perjalanannya.','speaker_name'=>'Maya Kusuma','speaker_role'=>'Co-founder · StartupID','speaker_img'=>'15','date'=>'Sedang berlangsung','cta'=>'Gabung →','meta'=>'380 menonton','badge'=>'Live'],
            ['status'=>'recorded','cat'=>'desain',    'title'=>'Figma Advanced Components Workshop',         'cat_label'=>'🎨 Desain',    'cat_color'=>'rgba(244,63,94',   'icon_color'=>'rgba(244,63,94,0.7)', 'text_color'=>'#fda4af', 'desc'=>'Kuasai auto-layout, variants, dan component properties untuk design system scalable.','speaker_name'=>'Dina Pratiwi','speaker_role'=>'Senior Designer · Shopee','speaker_img'=>'20','date'=>'6.1K ditonton','cta'=>'Tonton →','meta'=>'6.1K ditonton','badge'=>'Rekaman'],
            ['status'=>'upcoming','cat'=>'mobile',    'title'=>'Flutter: Membangun Aplikasi Pertamamu',      'cat_label'=>'📱 Mobile Dev','cat_color'=>'rgba(6,182,212',   'icon_color'=>'rgba(6,182,212,0.7)', 'text_color'=>'#67e8f9', 'desc'=>'Bangun aplikasi mobile cross-platform pertamamu dengan Flutter dari nol dalam satu sesi.','speaker_name'=>'Aryo Wicaksono','speaker_role'=>'Mobile Dev · Traveloka','speaker_img'=>'33','date'=>'28 Feb · 13.00 WIB','cta'=>'Daftar →','meta'=>'28 Feb · 13.00 WIB','badge'=>'Mendatang'],
          ];
        @endphp

        @foreach($webinars as $w)
          <div class="webinar-card card-glass rounded-2xl p-5 reveal"
               data-status="{{ $w['status'] }}" data-cat="{{ $w['cat'] }}" data-title="{{ $w['title'] }}"
               style="border:1px solid rgba(255,255,255,0.06);">
            <div class="h-28 rounded-xl mb-4 flex items-center justify-center relative overflow-hidden"
                 style="background:linear-gradient(135deg,{{ $w['cat_color'] }},0.12),{{ $w['cat_color'] }},0.04));">
              <div class="absolute top-2 right-2">
                @if($w['status'] === 'live')
                  <span class="badge-live font-body text-xs px-2.5 py-1 rounded-full flex items-center gap-1"><div class="live-dot" style="width:5px;height:5px;"></div>LIVE</span>
                @elseif($w['status'] === 'recorded')
                  <span class="badge-recorded font-body text-xs px-2.5 py-1 rounded-full">Rekaman</span>
                @else
                  <span class="badge-upcoming font-body text-xs px-2.5 py-1 rounded-full">Mendatang</span>
                @endif
              </div>
            </div>
            <span class="font-body text-xs px-2.5 py-1 rounded-full mb-3 inline-block"
                  style="background:{{ $w['cat_color'] }},0.1);border:1px solid {{ $w['cat_color'] }},0.25);color:{{ $w['text_color'] }};">
              {{ $w['cat_label'] }}
            </span>
            <h3 class="font-display font-semibold text-base leading-snug mb-2">{{ $w['title'] }}</h3>
            <p class="font-body text-xs text-gray-600 mb-4 line-clamp-2">{{ $w['desc'] }}</p>
            <div class="flex items-center gap-2 mb-4">
              <img src="https://i.pravatar.cc/30?img={{ $w['speaker_img'] }}" class="w-7 h-7 rounded-full object-cover" alt="">
              <div>
                <p class="font-body text-xs font-medium text-white">{{ $w['speaker_name'] }}</p>
                <p class="font-body text-xs text-gray-600">{{ $w['speaker_role'] }}</p>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <span class="text-xs text-gray-600 font-body">{{ $w['meta'] }}</span>
              @if($w['status'] === 'live')
                <button class="btn-primary px-3.5 py-1.5 rounded-lg text-xs text-white font-body font-medium">{{ $w['cta'] }}</button>
              @else
                <button class="btn-ghost px-3.5 py-1.5 rounded-lg text-xs text-gray-400 font-body">{{ $w['cta'] }}</button>
              @endif
            </div>
          </div>
        @endforeach

      </div>

      <!-- Empty state -->
      <div id="empty-state" class="hidden text-center py-20">
        <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4" style="background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.08);">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.2)" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
        </div>
        <p class="font-display font-semibold text-gray-600 mb-1">Tidak ada webinar ditemukan</p>
        <p class="font-body text-sm text-gray-700">Coba kata kunci atau filter lain</p>
      </div>

      <!-- Pagination -->
      <div class="flex items-center justify-between">
        <p class="font-body text-xs text-gray-700">Halaman 1 dari 12</p>
        <div class="flex items-center gap-2">
          <button class="page-btn" style="opacity:0.3;cursor:default;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg></button>
          <button class="page-btn active">1</button>
          <button class="page-btn">2</button>
          <button class="page-btn">3</button>
          <span class="font-body text-xs text-gray-700 px-1">…</span>
          <button class="page-btn">12</button>
          <button class="page-btn"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg></button>
        </div>
      </div>

    </div><!-- /main -->
  </div><!-- /flex -->
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
    const cards = document.querySelectorAll('#cards-grid .webinar-card');
    let visible = 0;
    cards.forEach(card => {
      const matchFilter = currentFilter === 'all' || currentFilter === card.dataset.status || currentFilter === card.dataset.cat;
      const matchSearch = !search || card.dataset.title.toLowerCase().includes(search);
      card.style.display = (matchFilter && matchSearch) ? '' : 'none';
      if (matchFilter && matchSearch) visible++;
    });
    document.getElementById('empty-state').classList.toggle('hidden', visible > 0);
    document.getElementById('results-count').innerHTML = `Menampilkan <span class="text-white font-medium">${visible}</span> webinar`;
  }

  function toggleView(mode) {
    const grid = document.getElementById('cards-grid');
    document.getElementById('view-grid').classList.toggle('active', mode === 'grid');
    document.getElementById('view-list').classList.toggle('active', mode === 'list');
    grid.className = mode === 'grid' ? 'grid md:grid-cols-2 lg:grid-cols-3 gap-4 mb-8' : 'flex flex-col gap-4 mb-8';
  }
</script>
@endpush