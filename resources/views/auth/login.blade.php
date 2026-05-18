<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Login | Dr. A.Y. Soje</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
  <script>
    tailwind.config = {
      theme: { extend: {
        colors: { primary:'#0F2444','primary-light':'#1C3A5E','primary-dark':'#081526',gold:'#C9922A','gold-light':'#D4A847',cream:'#FDF9F4',sage:'#2E7D63' },
        fontFamily: { serif:['Playfair Display','Georgia','serif'], sans:['Inter','system-ui','sans-serif'] },
      }}
    }
  </script>
  <style>
    body{font-family:'Inter',sans-serif;}
    .font-serif{font-family:'Playfair Display',serif!important;}
    .hero-dots{background-image:radial-gradient(circle,rgba(201,146,42,.18) 1px,transparent 1px);background-size:26px 26px;}
    @keyframes spin-slow{to{transform:rotate(360deg);}}
    .spin-slow{animation:spin-slow 20s linear infinite;}
    @keyframes fadein{from{opacity:0;transform:translateY(20px);}to{opacity:1;transform:translateY(0);}}
    .fadein{animation:fadein .6s ease forwards;}
    input:focus{outline:none;border-color:#C9922A;box-shadow:0 0 0 3px rgba(201,146,42,.12);}
  </style>
</head>
<body class="min-h-screen bg-primary flex">

  <!-- Left panel -->
  <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden flex-col justify-between p-12">
    <div class="absolute inset-0 bg-primary-dark"></div>
    <div class="absolute inset-0 hero-dots opacity-60"></div>
    <div class="absolute top-1/4 left-1/4 w-96 h-96 rounded-full pointer-events-none" style="background:radial-gradient(circle,rgba(201,146,42,.12),transparent 70%)"></div>
    <div class="absolute bottom-1/4 right-10 w-64 h-64 rounded-full pointer-events-none" style="background:radial-gradient(circle,rgba(46,125,99,.1),transparent 70%)"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 rounded-full border border-dashed border-gold/15 spin-slow pointer-events-none"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 rounded-full border border-gold/8 pointer-events-none"></div>
    <div class="relative">
      <p class="font-serif text-white text-2xl font-bold">Dr. A.Y. Soje</p>
      <p class="text-gold text-sm mt-1">Admin Portal</p>
    </div>
    <div class="relative text-white">
      <div class="w-16 h-1 bg-gold mb-8 rounded-full"></div>
      <h2 class="font-serif text-4xl font-bold leading-tight mb-4">Manage Your<br><span class="text-gold">Digital Presence</span></h2>
      <p class="text-white/55 leading-relaxed max-w-sm">Control your blog posts, testimonials, contact messages, and content — all from one elegant dashboard.</p>
      <div class="mt-10 space-y-4">
        <div class="flex items-center gap-3"><div class="w-8 h-8 rounded-lg bg-gold/15 flex items-center justify-center flex-shrink-0"><i data-lucide="file-text" class="w-4 h-4 text-gold"></i></div><p class="text-white/65 text-sm">Publish &amp; manage blog articles</p></div>
        <div class="flex items-center gap-3"><div class="w-8 h-8 rounded-lg bg-gold/15 flex items-center justify-center flex-shrink-0"><i data-lucide="message-square" class="w-4 h-4 text-gold"></i></div><p class="text-white/65 text-sm">Moderate testimonials</p></div>
        <div class="flex items-center gap-3"><div class="w-8 h-8 rounded-lg bg-gold/15 flex items-center justify-center flex-shrink-0"><i data-lucide="mail" class="w-4 h-4 text-gold"></i></div><p class="text-white/65 text-sm">Read &amp; reply to contact messages</p></div>
        <div class="flex items-center gap-3"><div class="w-8 h-8 rounded-lg bg-gold/15 flex items-center justify-center flex-shrink-0"><i data-lucide="book-open" class="w-4 h-4 text-gold"></i></div><p class="text-white/65 text-sm">Update books &amp; publication info</p></div>
      </div>
    </div>
    <div class="relative">
      <p class="text-white/30 text-xs">© 2025 Dr. Mrs. Anthonia Yemisi Soje</p>
      <p class="text-white/20 text-xs mt-1">Fosterheirs Mental Health Therapists</p>
    </div>
  </div>

  <!-- Right panel -->
  <div class="w-full lg:w-1/2 flex items-center justify-center p-6 bg-cream min-h-screen">
    <div class="w-full max-w-md fadein">

      <div class="lg:hidden text-center mb-10">
        <p class="font-serif text-primary text-2xl font-bold">Dr. A.Y. Soje</p>
        <p class="text-gold text-sm mt-1">Admin Portal</p>
      </div>

      <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 md:p-10">

        @if (session('status'))
          <div class="mb-6 bg-green-50 border border-green-200 rounded-xl px-4 py-3 text-green-700 text-sm flex items-center gap-2">
            <i data-lucide="check-circle" class="w-4 h-4 flex-shrink-0"></i>
            {{ session('status') }}
          </div>
        @endif

        <div class="mb-8">
          <div class="w-12 h-12 bg-primary rounded-2xl flex items-center justify-center mb-5">
            <i data-lucide="shield-check" class="w-6 h-6 text-gold"></i>
          </div>
          <h1 class="font-serif text-2xl font-bold text-primary">Welcome back</h1>
          <p class="text-gray-400 text-sm mt-1">Sign in to your admin dashboard</p>
        </div>

        <form method="POST" action="{{ route('login.post') }}" class="space-y-5">
          @csrf

          <div>
            <label class="block text-xs font-semibold text-primary mb-2 uppercase tracking-wide">Email Address</label>
            <div class="relative">
              <i data-lucide="mail" class="w-4 h-4 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2"></i>
              <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@example.com" required
                class="w-full border border-gray-200 rounded-xl pl-11 pr-4 py-3 text-sm transition-all placeholder-gray-300 @error('email') border-red-300 @enderror" />
            </div>
            @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
          </div>

          <div>
            <label class="block text-xs font-semibold text-primary mb-2 uppercase tracking-wide">Password</label>
            <div class="relative">
              <i data-lucide="lock" class="w-4 h-4 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2"></i>
              <input type="password" name="password" id="password" placeholder="••••••••" required
                class="w-full border border-gray-200 rounded-xl pl-11 pr-12 py-3 text-sm transition-all placeholder-gray-300" />
              <button type="button" onclick="togglePwd()" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-primary transition-colors">
                <i data-lucide="eye" class="w-4 h-4" id="eye-icon"></i>
              </button>
            </div>
          </div>

          <div class="flex items-center justify-between">
            <label class="flex items-center gap-2.5 cursor-pointer">
              <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-300 text-primary" />
              <span class="text-gray-500 text-sm">Remember me</span>
            </label>
            <a href="{{ route('password.request') }}" class="text-gold text-sm font-medium hover:text-gold-light transition-colors">Forgot password?</a>
          </div>

          <button type="submit"
            class="w-full bg-primary hover:bg-primary-light text-white font-semibold py-4 rounded-xl transition-colors flex items-center justify-center gap-2 mt-2">
            <i data-lucide="log-in" class="w-5 h-5"></i> Sign In
          </button>
        </form>

        <div class="mt-8 pt-6 border-t border-gray-100 text-center">
          <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-primary text-sm transition-colors">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to Portfolio
          </a>
        </div>
      </div>

      <div class="flex items-center justify-center gap-2 mt-6 text-gray-400 text-xs">
        <i data-lucide="shield" class="w-3.5 h-3.5"></i>
        <span>Secured connection · Authorized personnel only</span>
      </div>
    </div>
  </div>

  <script>
    lucide.createIcons();
    function togglePwd() {
      const pwd  = document.getElementById('password');
      const icon = document.getElementById('eye-icon');
      const show = pwd.type === 'password';
      pwd.type = show ? 'text' : 'password';
      icon.setAttribute('data-lucide', show ? 'eye-off' : 'eye');
      lucide.createIcons();
    }
  </script>
</body>
</html>
