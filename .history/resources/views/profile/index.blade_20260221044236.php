@extends('layouts.app')

@section('title', 'Profil — ' . Auth::user()->name)

@push('styles')
  .stat-card { transition: all 0.3s ease; }
  .stat-card:hover { border-color: rgba(245,158,11,0.3) !important; transform: translateY(-3px); }

  .tab-btn { padding: 10px 20px; border-radius: 10px; font-family:'DM Sans',sans-serif; font-size:0.85rem; font-weight:500; transition:all 0.2s; color:rgba(255,255,255,0.4); cursor:pointer; border:1px solid transparent; background:transparent; }
  .tab-btn.active { background:rgba(245,158,11,0.1); color:#f59e0b; border-color:rgba(245,158,11,0.25); }
  .tab-btn:not(.active):hover { color:rgba(255,255,255,0.7); }
  .tab-panel { display:none; }
  .tab-panel.active { display:block; animation:fadeUp 0.3s ease forwards; }

  .prog-bar  { height:4px; border-radius:2px; background:rgba(255,255,255,0.06); overflow:hidden; }
  .prog-fill { height:100%; border-radius:2px; }

  .input-icon { position:absolute; left:14px; top:50%; transform:translateY(-50%); color:rgba(255,255,255,0.22); pointer-events:none; }
  .input-icon-top { position:absolute; left:14px; top:14px; color:rgba(255,255,255,0.22); pointer-events:none; }

  .textarea-field {
    width:100%; padding:12px 14px 12px 44px;
    background:rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.08);
    border-radius:12px; color:white; font-family:'DM Sans',sans-serif;
    font-size:0.9rem; outline:none; resize:none; min-height:90px;
    transition:border-color 0.2s, box-shadow 0.2s;
  }
  .textarea-field:focus { border-color:rgba(245,158,11,0.5); box-shadow:0 0 0 3px rgba(245,158,11,0.08); }
  .textarea-field::placeholder { color:rgba(255,255,255,0.2); }

  .avatar-zone { cursor:pointer; transition:border-color 0.2s, background 0.2s; }
  .avatar-zone:hover { border-color:rgba(245,158,11,0.4) !important; background:rgba(245,158,11,0.03) !important; }
@endpush

@section('content')
<div class="max-w-6xl mx-auto px-6 pt-36 pb-20">

  {{-- BG Orbs --}}
  <div class="orb" style="width:600px;height:400px;background:rgba(245,158,11,0.06);top:-80px;right:-80px;animation:glowPulse 6s ease-in-out infinite;position:fixed;z-index:0;"></div>
  <div class="orb" style="width:350px;height:350px;background:rgba(139,92,246,0.04);bottom:200px;left:-60px;animation:glowPulse 8s ease-in-out infinite reverse;position:fixed;z-index:0;"></div>

  {{-- ── PROFILE HERO ── --}}
  <div class="card-glass rounded-3xl p-8 mb-6 stagger-1 relative overflow-hidden" style="border:1px solid rgba(255,255,255,0.07);">
    <div style="position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(90deg,transparent,rgba(245,158,11,0.5),transparent);"></div>
    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6">

      {{-- Avatar --}}
      <div class="relative flex-shrink-0">
        <div class="w-20 h-20 md:w-24 md:h-24 rounded-2xl overflow-hidden flex items-center justify-center"
             style="border:2px solid rgba(245,158,11,0.25);background:rgba(245,158,11,0.08);">
          @if(Auth::user()->profile_picture)
            <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" class="w-full h-full object-cover" alt="{{ Auth::user()->name }}">
          @else
            <span class="font-display font-extrabold text-3xl" style="color:#f59e0b;">{{ strtoupper(substr(Auth::user()->name,0,1)) }}</span>
          @endif
        </div>
        <div class="absolute -bottom-1 -right-1">
          <div class="live-dot" style="width:10px;height:10px;border:2px solid #0b0c10;"></div>
        </div>
      </div>

      {{-- Info --}}
      <div class="flex-1 min-w-0">
        <div class="flex flex-wrap items-center gap-3 mb-1">
          <h1 class="font-display font-bold text-2xl md:text-3xl tracking-tight">{{ Auth::user()->name }}</h1>
          <span class="badge-pill text-xs font-body px-3 py-1 rounded-full" style="color:#f59e0b;">Member</span>
        </div>
        <p class="font-body text-sm mb-3" style="color:rgba(255,255,255,0.35);font-family:'DM Mono',monospace;">{{ Auth::user()->email }}</p>
        @if(Auth::user()->description)
          <p class="font-body text-sm text-gray-400 leading-relaxed max-w-xl">{{ Auth::user()->description }}</p>
        @else
          <p class="font-body text-sm text-gray-700 italic">Belum ada bio — tambahkan di tab Edit Profil!</p>
        @endif
        <div class="flex flex-wrap gap-4 mt-4">
          <span class="flex items-center gap-1.5 text-xs text-gray-600 font-body">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            Bergabung {{ Auth::user()->created_at->format('M Y') }}
          </span>
          <span class="flex items-center gap-1.5 text-xs text-gray-600 font-body">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
            Update {{ Auth::user()->updated_at->diffForHumans() }}
          </span>
        </div>
      </div>

      <button onclick="switchTab('settings')" class="btn-primary px-5 py-2.5 rounded-xl text-white font-body text-sm font-medium flex items-center gap-2 flex-shrink-0">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
        Edit Profil
      </button>
    </div>
  </div>

  {{-- ── STAT CARDS ── --}}
  <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6 stagger-2">
    <div class="stat-card card-glass rounded-2xl p-5" style="border:1px solid rgba(255,255,255,0.06);">
      <p class="font-display font-bold text-2xl mb-1" style="color:#f59e0b;">12</p>
      <p class="font-body text-xs text-gray-600">Event Diikuti</p>
    </div>
    <div class="stat-card card-glass rounded-2xl p-5" style="border:1px solid rgba(255,255,255,0.06);">
      <p class="font-display font-bold text-2xl mb-1 text-white">5</p>
      <p class="font-body text-xs text-gray-600">Sertifikat</p>
    </div>
    <div class="stat-card card-glass rounded-2xl p-5" style="border:1px solid rgba(255,255,255,0.06);">
      <p class="font-display font-bold text-2xl mb-1 text-white">38h</p>
      <p class="font-body text-xs text-gray-600">Jam Belajar</p>
    </div>
    <div class="stat-card card-glass rounded-2xl p-5" style="border:1px solid rgba(255,255,255,0.06);">
      <p class="font-display font-bold text-2xl mb-1 text-white" style="font-family:'DM Mono',monospace;">#{{ str_pad(Auth::user()->id, 4, '0', STR_PAD_LEFT) }}</p>
      <p class="font-body text-xs text-gray-600">ID Anggota</p>
    </div>
  </div>

  {{-- ── TABS ── --}}
  <div class="stagger-3">
    <div class="flex items-center gap-1 mb-6 p-1 card-glass rounded-xl w-fit" style="border:1px solid rgba(255,255,255,0.06);">
      <button class="tab-btn active" id="tab-overview"  onclick="switchTab('overview')">
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

    {{-- ─── TAB: OVERVIEW ─── --}}
    <div class="tab-panel active" id="panel-overview">
      <div class="grid md:grid-cols-3 gap-5">

        {{-- Learning progress --}}
        <div class="md:col-span-2 card-glass rounded-2xl p-6" style="border:1px solid rgba(255,255,255,0.06);">
          <div class="flex items-center justify-between mb-6">
            <div>
              <p class="font-body text-xs text-gray-600 uppercase tracking-widest mb-1">Progress Belajar</p>
              <h3 class="font-display font-bold text-lg">Aktivitas Minggu Ini</h3>
            </div>
            <span class="badge-pill text-xs font-body px-3 py-1 rounded-full" style="color:#f59e0b;">78% tercapai</span>
          </div>
          @foreach([['Desain & UX','78','#f59e0b'],['Data Science','55','#7c3aed'],['Product Management','92','#2563eb']] as $prog)
            <div class="mb-5">
              <div class="flex items-center justify-between mb-2">
                <span class="font-body text-sm text-gray-400">{{ $prog[0] }}</span>
                <span class="font-body text-xs" style="color:{{ $prog[2] }};font-family:'DM Mono',monospace;">{{ $prog[1] }}%</span>
              </div>
              <div class="prog-bar"><div class="prog-fill" style="width:{{ $prog[1] }}%;background:{{ $prog[2] }};"></div></div>
            </div>
          @endforeach

          <div class="mt-6 pt-5" style="border-top:1px solid rgba(255,255,255,0.05);">
            <p class="font-body text-xs text-gray-600 uppercase tracking-widest mb-3">Event yang Diikuti</p>
            <div class="flex flex-wrap gap-2">
              @foreach(['Figma Advanced Workshop','Python & Pandas','Growth Hacking Startup'] as $ev)
                <span class="font-body text-xs px-3 py-1.5 rounded-lg" style="background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.07);color:rgba(255,255,255,0.5);">{{ $ev }}</span>
              @endforeach
            </div>
          </div>
        </div>

        {{-- Upcoming sidebar --}}
        <div class="flex flex-col gap-4">
          <div class="card-glass rounded-2xl p-5" style="border:1px solid rgba(255,255,255,0.06);">
            <p class="font-body text-xs text-gray-600 uppercase tracking-widest mb-4">Event Terdekat</p>
            <div class="rounded-xl p-4 mb-4" style="background:rgba(245,158,11,0.05);border:1px solid rgba(245,158,11,0.1);">
              <div class="flex items-center gap-2 mb-2">
                <div class="live-dot"></div>
                <span class="font-body text-xs text-green-400 font-medium">LIVE SEKARANG</span>
              </div>
              <p class="font-display font-semibold text-sm leading-snug mb-3">Dari Ide ke Produk: Framework PM Modern</p>
              <div class="flex items-center gap-2">
                <img src="https://i.pravatar.cc/28?img=11" class="w-6 h-6 rounded-full object-cover" alt="">
                <span class="font-body text-xs text-gray-500">Kevin R. · 1.2K peserta</span>
              </div>
            </div>
            <button class="btn-primary w-full py-2.5 rounded-xl text-white font-body text-sm font-medium flex items-center justify-center gap-2">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="5 3 19 12 5 21 5 3"/></svg>
              Gabung Live
            </button>
          </div>

          <div class="card-glass rounded-2xl p-5" style="border:1px solid rgba(255,255,255,0.06);">
            <p class="font-body text-xs text-gray-600 uppercase tracking-widest mb-4">Mendatang</p>
            <div class="space-y-4">
              @foreach([['Accessibility in 2025','22 Feb · 14.00','7c3aed'],['Python & Pandas','25 Feb · 10.00','2563eb'],['Flutter Pemula','28 Feb · 13.00','06b6d4']] as $ev)
                <div class="flex items-center gap-3">
                  <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0" style="background:rgba({{ $ev[2] === '7c3aed' ? '124,58,237' : ($ev[2] === '2563eb' ? '37,99,235' : '6,182,212') }},0.1);">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#{{ $ev[2] }}" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                  </div>
                  <div>
                    <p class="font-body text-xs text-white font-medium">{{ $ev[0] }}</p>
                    <p class="font-body text-xs text-gray-600">{{ $ev[1] }}</p>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- ─── TAB: SETTINGS ─── --}}
    <div class="tab-panel" id="panel-settings">
      <div class="grid md:grid-cols-3 gap-5">

        {{-- Edit form --}}
        <div class="md:col-span-2 card-glass rounded-2xl p-6" style="border:1px solid rgba(255,255,255,0.06);">
          <div class="mb-6">
            <p class="font-body text-xs text-gray-600 uppercase tracking-widest mb-1">Pengaturan Akun</p>
            <h3 class="font-display font-bold text-lg">Edit Profil</h3>
          </div>

          @if($errors->any())
            <div class="rounded-xl p-4 mb-5" style="background:rgba(239,68,68,0.05);border:1px solid rgba(239,68,68,0.2);">
              @foreach($errors->all() as $err)
                <p class="font-body text-sm text-red-400">• {{ $err }}</p>
              @endforeach
            </div>
          @endif

          <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" id="profileForm">
            @csrf
            @method('PUT')

            {{-- Photo upload --}}
            <label for="pp_input" class="avatar-zone flex items-center gap-4 p-4 rounded-2xl mb-5 block"
                   style="background:rgba(255,255,255,0.02);border:1px dashed rgba(255,255,255,0.1);">
              <div class="w-14 h-14 rounded-xl overflow-hidden flex items-center justify-center flex-shrink-0"
                   style="background:rgba(245,158,11,0.1);border:1px solid rgba(245,158,11,0.2);">
                @if(Auth::user()->profile_picture)
                  <img id="photo-preview" src="{{ asset('storage/'.Auth::user()->profile_picture) }}" class="w-full h-full object-cover" alt="">
                  <span id="photo-initial" class="hidden font-display font-bold text-xl" style="color:#f59e0b;">{{ strtoupper(substr(Auth::user()->name,0,1)) }}</span>
                @else
                  <img id="photo-preview" src="" class="w-full h-full object-cover hidden" alt="">
                  <span id="photo-initial" class="font-display font-bold text-xl" style="color:#f59e0b;">{{ strtoupper(substr(Auth::user()->name,0,1)) }}</span>
                @endif
              </div>
              <div class="flex-1">
                <p class="font-body text-sm font-medium text-white">Ganti foto profil</p>
                <p class="font-body text-xs text-gray-600 mt-0.5">JPG, PNG, GIF — maks 2MB</p>
              </div>
              <div class="btn-ghost px-3 py-1.5 rounded-lg text-xs text-gray-500 font-body">Pilih File</div>
              <input type="file" id="pp_input" name="profile_picture" accept="image/*" class="hidden" onchange="previewPhoto(this)">
            </label>

            {{-- Name + Email --}}
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

            {{-- Bio --}}
            <div class="mb-6">
              <label class="font-body text-xs font-medium text-gray-500 uppercase tracking-widest mb-2 block">
                Bio <span class="normal-case text-gray-700">(maks. 500 karakter)</span>
              </label>
              <div class="relative">
                <svg class="input-icon-top" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/></svg>
                <textarea name="description" class="textarea-field" maxlength="500"
                          placeholder="Ceritakan sedikit tentang dirimu..."
                          oninput="document.getElementById('charCount').textContent=this.value.length">{{ old('description', Auth::user()->description) }}</textarea>
              </div>
              <div class="flex justify-end mt-1.5">
                <span class="font-body text-xs text-gray-700" style="font-family:'DM Mono',monospace;">
                  <span id="charCount">{{ strlen(old('description', Auth::user()->description ?? '')) }}</span>/500
                </span>
              </div>
            </div>

            <button type="submit" class="btn-primary w-full py-3.5 rounded-xl text-white font-display font-bold flex items-center justify-center gap-2">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
              Simpan Perubahan
            </button>
          </form>
        </div>

        {{-- Sidebar info --}}
        <div class="flex flex-col gap-4">
          <div class="card-glass rounded-2xl p-5" style="border:1px solid rgba(255,255,255,0.06);">
            <p class="font-body text-xs text-gray-600 uppercase tracking-widest mb-4">Info Akun</p>
            <div class="flex items-center justify-between py-2.5" style="border-bottom:1px solid rgba(255,255,255,0.04);">
              <span class="font-body text-xs text-gray-600">Bergabung</span>
              <span class="font-body text-xs text-white" style="font-family:'DM Mono',monospace;">{{ Auth::user()->created_at->format('d/m/Y') }}</span>
            </div>
            <div class="flex items-center justify-between py-2.5" style="border-bottom:1px solid rgba(255,255,255,0.04);">
              <span class="font-body text-xs text-gray-600">Diperbarui</span>
              <span class="font-body text-xs text-white" style="font-family:'DM Mono',monospace;">{{ Auth::user()->updated_at->format('d/m/Y') }}</span>
            </div>
            <div class="flex items-center justify-between py-2.5">
              <span class="font-body text-xs text-gray-600">Status</span>
              <span class="font-body text-xs flex items-center gap-1.5" style="color:#4ade80;">
                <span class="w-1.5 h-1.5 rounded-full bg-green-400 inline-block"></span>Aktif
              </span>
            </div>
          </div>

          <div class="card-glass rounded-2xl p-5" style="border:1px solid rgba(255,255,255,0.06);">
            <p class="font-body text-xs text-gray-600 uppercase tracking-widest mb-4">Sertifikat</p>
            @foreach([['UI/UX Fundamentals','Jan 2025'],['Data Analysis Basics','Des 2024'],['PM Bootcamp','Nov 2024']] as $cert)
              <div class="flex items-center gap-3 py-2" style="border-bottom:1px solid rgba(255,255,255,0.04);">
                <div class="w-7 h-7 rounded-lg flex items-center justify-center flex-shrink-0" style="background:rgba(245,158,11,0.1);">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>
                </div>
                <div>
                  <p class="font-body text-xs text-white font-medium">{{ $cert[0] }}</p>
                  <p class="font-body text-xs text-gray-700">{{ $cert[1] }}</p>
                </div>
              </div>
            @endforeach
          </div>

          <div class="card-glass rounded-2xl p-5" style="border:1px solid rgba(239,68,68,0.1);">
            <p class="font-body text-xs uppercase tracking-widest mb-1" style="color:rgba(239,68,68,0.6);">Zona Berbahaya</p>
            <p class="font-body text-xs text-gray-700 mb-4">Tindakan ini tidak dapat dibatalkan.</p>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="w-full py-2.5 rounded-xl font-body text-sm font-medium transition-all"
                      style="background:rgba(239,68,68,0.05);border:1px solid rgba(239,68,68,0.15);color:#f87171;"
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

  {{-- CTA strip --}}
  <div class="mt-10 px-6 py-10 rounded-2xl stagger-4" style="background:rgba(245,158,11,0.03);border:1px solid rgba(245,158,11,0.08);">
    <div class="flex flex-col sm:flex-row items-center justify-between gap-5">
      <div>
        <h3 class="font-display font-bold text-xl mb-1">Siap belajar hal baru?</h3>
        <p class="font-body text-sm text-gray-500">Jelajahi ratusan webinar gratis dari instruktur terbaik.</p>
      </div>
      <a href="{{ route('explore') }}" class="btn-primary px-7 py-3 rounded-xl text-white font-display font-semibold text-sm whitespace-nowrap flex items-center gap-2">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
        Eksplorasi Event
      </a>
    </div>
  </div>

</div>
@endsection

@push('scripts')
<script>
  function switchTab(name) {
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
    document.getElementById('tab-' + name).classList.add('active');
    document.getElementById('panel-' + name).classList.add('active');
  }

  function previewPhoto(input) {
    if (!input.files || !input.files[0]) return;
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

  @if($errors->any())
    document.addEventListener('DOMContentLoaded', () => switchTab('settings'));
  @endif
</script>
@endpush