<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Masuk — OpenSkill</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet" />
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: { display: ['Syne', 'sans-serif'], body: ['DM Sans', 'sans-serif'] },
          colors: {
            ink: '#0b0c10', panel: '#111318', border: '#1e2029',
            amber: { vivid: '#f59e0b', glow: '#fbbf24', soft: '#fde68a' },
            slate: { muted: '#6b7280', light: '#9ca3af' }
          },
          keyframes: {
            fadeUp: { '0%': { opacity: '0', transform: 'translateY(30px)' }, '100%': { opacity: '1', transform: 'translateY(0)' } },
            float: { '0%, 100%': { transform: 'translateY(0px)' }, '50%': { transform: 'translateY(-14px)' } },
            glowPulse: { '0%, 100%': { opacity: '0.5', transform: 'scale(1)' }, '50%': { opacity: '0.9', transform: 'scale(1.08)' } },
            pulse: { '0%, 100%': { opacity: '1', boxShadow: '0 0 0 0 rgba(34,197,94,0.4)' }, '50%': { opacity: '0.8', boxShadow: '0 0 0 6px rgba(34,197,94,0)' } },
          },
          animation: {
            'fade-up': 'fadeUp 0.7s ease forwards',
            'float': 'float 6s ease-in-out infinite',
            'glow-pulse': 'glowPulse 3s ease-in-out infinite',
          }
        }
      }
    }
  </script>
  <style>
    * { box-sizing: border-box; }
    body { background-color: #0b0c10; font-family: 'DM Sans', sans-serif; overflow-x: hidden; }
    body::before {
      content: '';
      position: fixed; inset: 0;
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.03'/%3E%3C/svg%3E");
      pointer-events: none; z-index: 0; opacity: 0.4;
    }
    .orb { border-radius: 50%; filter: blur(80px); position: absolute; pointer-events: none; }
    .card-glass { background: rgba(17,19,24,0.7); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.06); }
    .badge-pill { background: rgba(245,158,11,0.12); border: 1px solid rgba(245,158,11,0.3); }
    .btn-primary { background: linear-gradient(135deg, #f59e0b, #d97706); transition: all 0.3s ease; box-shadow: 0 4px 20px rgba(245,158,11,0.3); }
    .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 30px rgba(245,158,11,0.45); }
    .btn-ghost { border: 1px solid rgba(255,255,255,0.15); transition: all 0.3s ease; }
    .btn-ghost:hover { border-color: rgba(245,158,11,0.5); color: #fbbf24; }
    .text-glow { text-shadow: 0 0 40px rgba(251,191,36,0.4); }
    .input-field {
      width: 100%; padding: 13px 14px 13px 44px;
      background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08);
      border-radius: 12px; color: white; font-family: 'DM Sans', sans-serif;
      font-size: 0.92rem; outline: none;
      transition: border-color 0.2s, box-shadow 0.2s;
    }
    .input-field:focus { border-color: rgba(245,158,11,0.5); box-shadow: 0 0 0 3px rgba(245,158,11,0.08); }
    .input-field::placeholder { color: rgba(255,255,255,0.25); }
    .input-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: rgba(255,255,255,0.25); pointer-events: none; }
    .stagger-1 { animation-delay: 0.1s; opacity: 0; }
    .stagger-2 { animation-delay: 0.2s; opacity: 0; }
    .stagger-3 { animation-delay: 0.3s; opacity: 0; }
    .stagger-4 { animation-delay: 0.4s; opacity: 0; }
    .stagger-5 { animation-delay: 0.55s; opacity: 0; }
    .live-dot { width: 8px; height: 8px; background: #22c55e; border-radius: 50%; animation: livePulse 1.5s ease-in-out infinite; }
    @keyframes livePulse {
      0%, 100% { opacity: 1; box-shadow: 0 0 0 0 rgba(34,197,94,0.4); }
      50% { opacity: 0.8; box-shadow: 0 0 0 6px rgba(34,197,94,0); }
    }
    .nav-blur { background: rgba(11,12,16,0.8); backdrop-filter: blur(20px); border-bottom: 1px solid rgba(255,255,255,0.05); }
    .diagonal-line { position: absolute; width: 1px; height: 200px; background: linear-gradient(to bottom, transparent, rgba(245,158,11,0.3), transparent); transform: rotate(30deg); }
    .glow-amber { box-shadow: 0 0 60px 10px rgba(245,158,11,0.12); }
    .line-accent { background: linear-gradient(90deg, transparent, #f59e0b, transparent); height: 1px; }
    .feature-item:hover .feature-icon { background: rgba(245,158,11,0.2); border-color: rgba(245,158,11,0.35); }
  </style>
</head>
<body class="min-h-screen text-white relative">

  <!-- BG ORBS -->
  <div class="orb" style="width:500px;height:500px;background:rgba(245,158,11,0.07);top:-100px;right:-80px;animation:glowPulse 5s ease-in-out infinite;"></div>
  <div class="orb" style="width:300px;height:300px;background:rgba(139,92,246,0.05);bottom:200px;left:-60px;animation:glowPulse 7s ease-in-out infinite reverse;"></div>
  <div class="diagonal-line" style="top:140px;left:12%;"></div>
  <div class="diagonal-line" style="top:260px;right:8%;opacity:0.4;"></div>

  <!-- NAVBAR -->
  <nav class="nav-blur fixed top-0 left-0 right-0 z-50 px-6 py-4">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
      <a href="/" class="flex items-center gap-2">
        <div class="w-8 h-8 rounded-lg btn-primary flex items-center justify-center">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
            <path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/>
          </svg>
        </div>
        <span class="font-display font-bold text-lg tracking-tight">Open<span class="text-amber-vivid">Skill</span></span>
      </a>
      <div class="flex items-center gap-3">
        <span class="text-sm text-gray-500 font-body hidden sm:block">Belum punya akun?</span>
        <a href="{{ route('register') }}" class="btn-primary px-5 py-2 rounded-lg text-white text-sm font-semibold font-body">Daftar Gratis</a>
      </div>
    </div>
  </nav>

  <!-- MAIN -->
  <div class="relative z-10 min-h-screen flex">

    <!-- LEFT: Branding Panel -->
    <div class="hidden lg:flex lg:w-[45%] flex-col justify-between p-16 relative overflow-hidden">
      <div class="orb" style="width:350px;height:350px;background:rgba(245,158,11,0.08);bottom:-80px;left:-60px;filter:blur(60px);"></div>

      <!-- Hero text -->
      <div class="mt-24 relative">
        <div class="inline-flex items-center gap-2 badge-pill rounded-full px-4 py-2 mb-8">
          <div class="live-dot"></div>
          <span class="font-body text-sm text-amber-vivid font-medium">320+ Event Aktif Bulan Ini</span>
        </div>

        <h1 class="font-display font-extrabold leading-none tracking-tight mb-6"
            style="font-size: clamp(2.8rem, 5vw, 4.5rem); line-height: 0.95;">
          Selamat<br/>
          <span class="text-glow" style="color:#f59e0b;">Kembali.</span><br/>
          Kami Sudah<br/>
          Menunggumu.
        </h1>
        <p class="font-body text-gray-500 text-base leading-relaxed max-w-sm">
          Lanjutkan perjalanan belajarmu. Ratusan webinar dan seminar baru menanti setiap minggunya.
        </p>
      </div>

      <!-- Stats mini -->
      <div class="grid grid-cols-3 gap-4 relative">
        <div class="card-glass rounded-2xl p-4 text-center">
          <p class="font-display font-bold text-2xl text-white">48K+</p>
          <p class="font-body text-xs text-gray-600 mt-1">Peserta</p>
        </div>
        <div class="card-glass rounded-2xl p-4 text-center">
          <p class="font-display font-bold text-2xl text-amber-vivid">92%</p>
          <p class="font-body text-xs text-gray-600 mt-1">Puas</p>
        </div>
        <div class="card-glass rounded-2xl p-4 text-center">
          <p class="font-display font-bold text-2xl text-white">150+</p>
          <p class="font-body text-xs text-gray-600 mt-1">Instruktur</p>
        </div>
      </div>
    </div>

    <!-- Divider -->
    <div class="hidden lg:block w-px my-16" style="background:linear-gradient(to bottom, transparent, rgba(245,158,11,0.2), transparent);"></div>

    <!-- RIGHT: Form Panel -->
    <div class="flex-1 flex items-center justify-center px-6 py-24">
      <div class="w-full max-w-md">

        <!-- Form header -->
        <div class="mb-10 stagger-1" style="animation:fadeUp 0.7s ease forwards;opacity:0;">
          <h2 class="font-display font-bold text-3xl md:text-4xl tracking-tight mb-2">Masuk ke Akun</h2>
          <p class="font-body text-gray-500 text-sm">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-amber-vivid font-medium hover:underline">Daftar gratis sekarang</a>
          </p>
        </div>

        <!-- Error alert -->
        @if ($errors->any())
          <div class="card-glass rounded-xl p-4 mb-6 flex items-start gap-3 stagger-1" style="border:1px solid rgba(239,68,68,0.25);animation:fadeUp 0.7s ease forwards;opacity:0;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2" class="flex-shrink-0 mt-0.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <div>
              @foreach ($errors->all() as $err)
                <p class="font-body text-sm text-red-400">{{ $err }}</p>
              @endforeach
            </div>
          </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
          @csrf

          <!-- Email -->
          <div class="stagger-2" style="animation:fadeUp 0.7s ease forwards;opacity:0;">
            <label class="font-body text-xs font-medium text-gray-400 uppercase tracking-widest mb-2 block">Email</label>
            <div class="relative">
              <svg class="input-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>
              </svg>
              <input type="email" name="email" value="{{ old('email') }}" placeholder="kamu@email.com" class="input-field" required autocomplete="email">
            </div>
          </div>

          <!-- Password -->
          <div class="stagger-3" style="animation:fadeUp 0.7s ease forwards;opacity:0;">
            <label class="font-body text-xs font-medium text-gray-400 uppercase tracking-widest mb-2 block">Password</label>
            <div class="relative">
              <svg class="input-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
              </svg>
              <input type="password" id="password" name="password" placeholder="••••••••" class="input-field" style="padding-right:44px;" required autocomplete="current-password">
              <button type="button" onclick="togglePwd()" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-600 hover:text-amber-vivid transition-colors">
                <svg id="eye-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                </svg>
              </button>
            </div>
          </div>

          <!-- Remember / Forgot -->
          <div class="stagger-4 flex items-center justify-between" style="animation:fadeUp 0.7s ease forwards;opacity:0;">
            <label class="flex items-center gap-2 cursor-pointer">
              <input type="checkbox" name="remember" class="w-4 h-4 rounded accent-amber-500">
              <span class="font-body text-sm text-gray-400">Ingat saya</span>
            </label>
            <a href="#" class="font-body text-sm text-amber-vivid hover:underline">Lupa password?</a>
          </div>

          <!-- Submit -->
          <div class="stagger-5" style="animation:fadeUp 0.7s ease forwards;opacity:0;">
            <button type="submit" class="btn-primary w-full py-3.5 rounded-xl text-white font-display font-bold text-base flex items-center justify-center gap-2">
              <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/>
              </svg>
              Masuk Sekarang
            </button>
          </div>
        </form>

        <!-- Divider -->
        <div class="flex items-center gap-4 my-8 stagger-5" style="animation:fadeUp 0.7s ease forwards;opacity:0;">
          <div class="flex-1 h-px" style="background:rgba(255,255,255,0.06);"></div>
          <span class="font-body text-xs text-gray-700">atau lanjutkan dengan</span>
          <div class="flex-1 h-px" style="background:rgba(255,255,255,0.06);"></div>
        </div>

        <!-- Social -->
        <div class="grid grid-cols-2 gap-3 stagger-5" style="animation:fadeUp 0.7s ease forwards;opacity:0;">
          <button class="btn-ghost py-3 rounded-xl font-body text-sm text-gray-400 flex items-center justify-center gap-2">
            <svg width="17" height="17" viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
            Google
          </button>
          <button class="btn-ghost py-3 rounded-xl font-body text-sm text-gray-400 flex items-center justify-center gap-2">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="currentColor"><path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0 12.64 12.64 0 0 0-.617-1.25.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 0 0 .031.057 19.9 19.9 0 0 0 5.993 3.03.078.078 0 0 0 .084-.028c.462-.63.874-1.295 1.226-1.994.021-.04.001-.088-.041-.104a13.201 13.201 0 0 1-1.872-.892.077.077 0 0 1-.008-.128 10.2 10.2 0 0 0 .372-.292.074.074 0 0 1 .077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127 12.299 12.299 0 0 1-1.873.892.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028 19.839 19.839 0 0 0 6.002-3.03.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.03z" fill="#5865F2"/></svg>
            Discord
          </button>
        </div>

      </div>
    </div>
  </div>

  <script>
    function togglePwd() {
      const input = document.getElementById('password');
      const icon = document.getElementById('eye-icon');
      if (input.type === 'password') {
        input.type = 'text';
        icon.innerHTML = `<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/>`;
      } else {
        input.type = 'password';
        icon.innerHTML = `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>`;
      }
    }
  </script>
</body>
</html>