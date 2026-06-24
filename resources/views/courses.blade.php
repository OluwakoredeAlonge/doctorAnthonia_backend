<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="{{ asset('favicon.ico') }}" />
  <title>Courses &amp; Teachings | {{ $settings['doctor_name'] ?? 'Dr. O.A. Soje' }}</title>
  <meta name="description" content="Watch and learn from {{ $settings['doctor_name'] ?? 'Dr. O.A. Soje' }} — courses on mental health, trauma recovery, marriage restoration, and faith-based wellness." />
  <link rel="canonical" href="{{ url('/courses') }}" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="{{ url('/courses') }}" />
  <meta property="og:title" content="Courses &amp; Teachings | {{ $settings['doctor_name'] ?? 'Dr. O.A. Soje' }}" />
  <meta property="og:description" content="Courses on mental health, trauma recovery, marriage restoration, and faith-based wellness." />
  <meta property="og:site_name" content="{{ $settings['doctor_name'] ?? 'Dr. O.A. Soje' }}" />
  <meta name="twitter:card" content="summary" />
  <meta name="twitter:title" content="Courses &amp; Teachings | {{ $settings['doctor_name'] ?? 'Dr. O.A. Soje' }}" />
  <meta name="twitter:description" content="Courses on mental health, trauma recovery, marriage restoration, and faith-based wellness." />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
  <script>
    tailwind.config = {
      theme: { extend: {
        colors: {
          primary:'#0F2444','primary-light':'#1C3A5E','primary-dark':'#081526',
          gold:'#C9922A','gold-light':'#D4A847',cream:'#FDF9F4',sage:'#2E7D63'
        },
        fontFamily: {
          serif:['Playfair Display','Georgia','serif'],
          sans:['Inter','system-ui','sans-serif']
        },
      }}
    }
  </script>
  <style>
    body{font-family:'Inter',sans-serif;}
    .font-serif{font-family:'Playfair Display',serif!important;}
    ::-webkit-scrollbar{width:6px;}
    ::-webkit-scrollbar-track{background:#FDF9F4;}
    ::-webkit-scrollbar-thumb{background:#C9922A;border-radius:3px;}
    #navbar{transition:background .3s ease,box-shadow .3s ease;}
    #navbar.scrolled{background:rgba(255,255,255,.97)!important;box-shadow:0 2px 20px rgba(0,0,0,.08);}
    #navbar.scrolled .nav-link{color:#0F2444!important;}
    #navbar.scrolled .nav-logo{color:#0F2444!important;}
    #mobile-menu{max-height:0;opacity:0;overflow:hidden;transition:max-height .35s ease,opacity .3s ease;}
    #mobile-menu.open{max-height:360px;opacity:1;}
    .course-card{transition:transform .25s ease,box-shadow .25s ease,border-color .25s ease;}
    .course-card:hover{transform:translateY(-5px);box-shadow:0 20px 40px rgba(15,36,68,.10);}
    @keyframes fadeSlideUp{from{opacity:0;transform:translateY(22px);}to{opacity:1;transform:translateY(0);}}
    .fade-in{animation:fadeSlideUp .55s ease both;}
  </style>
</head>
<body class="bg-cream antialiased">

<!-- NAVBAR -->
<nav id="navbar" class="fixed top-0 left-0 right-0 z-50 bg-primary px-6 py-4">
  <div class="max-w-7xl mx-auto flex items-center justify-between">
    <a href="{{ route('home') }}" class="nav-logo font-serif text-white text-xl font-bold tracking-wide">{{ $settings['doctor_name'] ?? 'Dr. O.A. Soje' }}</a>
    <div class="hidden md:flex items-center gap-7">
      <a href="{{ route('home') }}#about"        class="nav-link text-white/70 hover:text-gold text-sm font-medium transition-colors">About</a>
      <a href="{{ route('home') }}#services"     class="nav-link text-white/70 hover:text-gold text-sm font-medium transition-colors">Services</a>
      <a href="{{ route('home') }}#books"        class="nav-link text-white/70 hover:text-gold text-sm font-medium transition-colors">Books</a>
      <a href="{{ route('courses.index') }}"     class="nav-link text-gold text-sm font-semibold transition-colors">Courses</a>
      <a href="{{ route('home') }}#organization" class="nav-link text-white/70 hover:text-gold text-sm font-medium transition-colors">Organization</a>
      <a href="{{ route('blog') }}"              class="nav-link text-white/70 hover:text-gold text-sm font-medium transition-colors">Blog</a>
    </div>
    <a href="{{ route('home') }}#contact" class="hidden md:inline-flex items-center gap-2 bg-gold hover:bg-gold-light text-white text-sm font-semibold px-6 py-2.5 rounded-full transition-all shadow-lg shadow-gold/25">
      <i data-lucide="calendar" class="w-4 h-4"></i> Book a Session
    </a>
    <button id="ham" class="md:hidden text-white" onclick="toggleMenu()">
      <i data-lucide="menu" class="w-6 h-6" id="ham-icon"></i>
    </button>
  </div>
  <div id="mobile-menu">
    <div class="mt-3 bg-white rounded-2xl shadow-2xl p-6 space-y-4">
      <a href="{{ route('home') }}#about"        class="block text-primary font-medium hover:text-gold transition-colors">About</a>
      <a href="{{ route('home') }}#services"     class="block text-primary font-medium hover:text-gold transition-colors">Services</a>
      <a href="{{ route('home') }}#books"        class="block text-primary font-medium hover:text-gold transition-colors">Books</a>
      <a href="{{ route('courses.index') }}"     class="block text-gold font-semibold hover:text-primary transition-colors">Courses</a>
      <a href="{{ route('home') }}#organization" class="block text-primary font-medium hover:text-gold transition-colors">Organization</a>
      <a href="{{ route('blog') }}"              class="block text-primary font-medium hover:text-gold transition-colors">Blog</a>
      <a href="{{ route('home') }}#contact"      class="block bg-gold hover:bg-gold-light text-white font-semibold px-6 py-3 rounded-full text-center transition-colors">Book a Session</a>
    </div>
  </div>
</nav>

<!-- HERO -->
<div class="bg-primary pt-28 pb-16 px-6">
  <div class="max-w-7xl mx-auto text-center">
    <p class="text-gold font-semibold text-xs tracking-widest uppercase mb-4">Learning Resources</p>
    <h1 class="font-serif text-4xl lg:text-5xl font-bold text-white leading-tight mb-4">Courses &amp; Teachings</h1>
    <div class="w-14 h-0.5 bg-gold mx-auto mb-5"></div>
    <p class="text-white/50 text-sm leading-relaxed max-w-xl mx-auto">
      Watch, learn, and grow. Each course is broken into episodes and paired with a workbook to deepen your journey.
    </p>
  </div>
</div>

<!-- COURSE GRID -->
<main class="max-w-7xl mx-auto px-6 py-16">

  @if($courses->isEmpty())
  <div class="text-center py-20">
    <div class="w-20 h-20 bg-white rounded-2xl border border-gray-100 shadow-sm flex items-center justify-center mx-auto mb-5">
      <svg class="w-10 h-10 text-gray-200" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
    </div>
    <h2 class="font-serif text-xl font-bold text-primary mb-2">Courses Coming Soon</h2>
    <p class="text-gray-400 text-sm mb-6">Check back shortly — courses will be uploaded here.</p>
    <a href="{{ route('home') }}" class="inline-flex items-center gap-2 bg-primary hover:bg-primary-light text-white text-sm font-semibold px-6 py-3 rounded-full transition-colors">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
      Back to Portfolio
    </a>
  </div>
  @else
  <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-7">
    @foreach($courses as $ci => $course)
    @php
      $firstModule = $course->modules->first();
      $total       = $course->modules->count();
    @endphp
    <a href="{{ route('courses.show', $course) }}"
       class="course-card fade-in group bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm block"
       style="animation-delay: {{ $ci * 0.07 }}s">
      {{-- Thumbnail --}}
      <div class="relative aspect-video bg-primary overflow-hidden">
        @if($firstModule?->youtube_id)
        <img src="https://img.youtube.com/vi/{{ $firstModule->youtube_id }}/hqdefault.jpg"
             alt="{{ $course->title }}"
             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
        @else
        <div class="w-full h-full flex items-center justify-center">
          <svg class="w-12 h-12 text-white/15" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
        </div>
        @endif
        {{-- Play button overlay --}}
        <div class="absolute inset-0 bg-primary/40 group-hover:bg-primary/20 transition-colors flex items-center justify-center">
          <div class="w-14 h-14 bg-[#FF0000] rounded-full flex items-center justify-center shadow-2xl group-hover:scale-110 transition-transform duration-300">
            <svg class="w-6 h-6 text-white ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
          </div>
        </div>
        {{-- Episode count --}}
        @if($total > 0)
        <div class="absolute bottom-3 right-3 bg-black/70 text-white text-xs font-semibold px-2.5 py-1 rounded-lg backdrop-blur-sm">
          {{ $total }} {{ Str::plural('Episode', $total) }}
        </div>
        @endif
      </div>
      {{-- Card body --}}
      <div class="p-5">
        <h2 class="font-serif text-base font-bold text-primary mb-2 leading-snug group-hover:text-gold transition-colors">{{ $course->title }}</h2>
        @if($course->description)
        <p class="text-gray-400 text-sm leading-relaxed mb-4 line-clamp-2">{{ $course->description }}</p>
        @endif
        <span class="inline-flex items-center gap-1.5 text-gold text-xs font-semibold">
          Watch All Episodes
          <svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
        </span>
      </div>
    </a>
    @endforeach
  </div>
  @endif

</main>

<!-- FOOTER (matching landing page) -->
<footer class="bg-primary-dark text-white py-16 mt-8">
  <div class="max-w-7xl mx-auto px-6">
    <div class="grid md:grid-cols-4 gap-10 mb-12">
      <div class="md:col-span-2">
        <p class="font-serif text-2xl font-bold mb-1">{{ $settings['doctor_name'] ?? 'Dr. O.A. Soje' }}</p>
        <p class="text-gold text-sm mb-4">Mental Health Professional &amp; Author</p>
        <p class="text-white/40 text-sm leading-relaxed max-w-xs">Bridging medicine, psychology, and faith to restore lives and rebuild homes across Nigeria and beyond.</p>
        <div class="flex flex-wrap gap-2 mt-6">
          @if(!empty($settings['social_facebook']))<a href="{{ $settings['social_facebook'] }}" target="_blank" rel="noopener" title="Facebook" class="w-9 h-9 rounded-xl bg-white/8 hover:bg-[#1877F2] flex items-center justify-center transition-colors text-white"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></a>@endif
          @if(!empty($settings['social_instagram']))<a href="{{ $settings['social_instagram'] }}" target="_blank" rel="noopener" title="Instagram" class="w-9 h-9 rounded-xl bg-white/8 hover:bg-gradient-to-br hover:from-[#833ab4] hover:to-[#fd1d1d] flex items-center justify-center transition-all text-white"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></a>@endif
          @if(!empty($settings['social_twitter']))<a href="{{ $settings['social_twitter'] }}" target="_blank" rel="noopener" title="X / Twitter" class="w-9 h-9 rounded-xl bg-white/8 hover:bg-black flex items-center justify-center transition-colors text-white"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.748l7.73-8.835L1.254 2.25H8.08l4.259 5.63 5.905-5.63zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg></a>@endif
          @if(!empty($settings['social_linkedin']))<a href="{{ $settings['social_linkedin'] }}" target="_blank" rel="noopener" title="LinkedIn" class="w-9 h-9 rounded-xl bg-white/8 hover:bg-[#0A66C2] flex items-center justify-center transition-colors text-white"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg></a>@endif
          @if(!empty($settings['social_youtube']))<a href="{{ $settings['social_youtube'] }}" target="_blank" rel="noopener" title="YouTube" class="w-9 h-9 rounded-xl bg-white/8 hover:bg-[#FF0000] flex items-center justify-center transition-colors text-white"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg></a>@endif
          @if(!empty($settings['social_tiktok']))<a href="{{ $settings['social_tiktok'] }}" target="_blank" rel="noopener" title="TikTok" class="w-9 h-9 rounded-xl bg-white/8 hover:bg-black flex items-center justify-center transition-colors text-white"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.95a8.16 8.16 0 004.77 1.52V7.02a4.85 4.85 0 01-1-.33z"/></svg></a>@endif
          @if(!empty($settings['social_spotify']))<a href="{{ $settings['social_spotify'] }}" target="_blank" rel="noopener" title="Spotify Podcast" class="w-9 h-9 rounded-xl bg-white/8 hover:bg-[#1DB954] flex items-center justify-center transition-colors text-white"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.4 0 0 5.4 0 12s5.4 12 12 12 12-5.4 12-12S18.66 0 12 0zm5.521 17.34c-.24.359-.66.48-1.021.24-2.82-1.74-6.36-2.101-10.561-1.141-.418.122-.779-.179-.899-.539-.12-.421.18-.78.54-.9 4.56-1.021 8.52-.6 11.64 1.32.42.18.479.659.301 1.02zm1.44-3.3c-.301.42-.841.6-1.262.3-3.239-1.98-8.159-2.58-11.939-1.38-.479.12-1.02-.12-1.14-.6-.12-.48.12-1.021.6-1.141C9.6 9.9 15 10.561 18.72 12.84c.361.181.54.78.241 1.2zm.12-3.36C15.24 8.4 8.82 8.16 5.16 9.301c-.6.179-1.2-.181-1.38-.721-.18-.601.18-1.2.72-1.381 4.26-1.26 11.28-1.02 15.721 1.621.539.3.719 1.02.419 1.56-.299.421-1.02.599-1.559.3z"/></svg></a>@endif
        </div>
      </div>
      <div>
        <p class="font-semibold text-white text-xs uppercase tracking-widest mb-5">Quick Links</p>
        <ul class="space-y-3">
          <li><a href="{{ route('home') }}#about"        class="text-white/40 hover:text-gold text-sm transition-colors">About</a></li>
          <li><a href="{{ route('home') }}#services"     class="text-white/40 hover:text-gold text-sm transition-colors">Services</a></li>
          <li><a href="{{ route('home') }}#books"        class="text-white/40 hover:text-gold text-sm transition-colors">Books</a></li>
          <li><a href="{{ route('courses.index') }}"     class="text-white/40 hover:text-gold text-sm transition-colors">Courses</a></li>
          <li><a href="{{ route('home') }}#organization" class="text-white/40 hover:text-gold text-sm transition-colors">Fosterheirs</a></li>
          <li><a href="{{ route('blog') }}"              class="text-white/40 hover:text-gold text-sm transition-colors">Blog</a></li>
          <li><a href="{{ route('home') }}#contact"      class="text-white/40 hover:text-gold text-sm transition-colors">Contact</a></li>
        </ul>
      </div>
      <div>
        <p class="font-semibold text-white text-xs uppercase tracking-widest mb-5">Services</p>
        <ul class="space-y-3">
          <li><a href="{{ route('home') }}#services" class="text-white/40 hover:text-gold text-sm transition-colors">Speaking &amp; Events</a></li>
          <li><a href="{{ route('home') }}#services" class="text-white/40 hover:text-gold text-sm transition-colors">Trauma Therapy</a></li>
          <li><a href="{{ route('home') }}#services" class="text-white/40 hover:text-gold text-sm transition-colors">Addiction Recovery</a></li>
          <li><a href="{{ route('home') }}#services" class="text-white/40 hover:text-gold text-sm transition-colors">Marriage Counselling</a></li>
          <li><a href="{{ route('home') }}#contact"  class="text-white/40 hover:text-gold text-sm transition-colors">Book a Session</a></li>
        </ul>
      </div>
    </div>
    <div class="pt-8 border-t border-white/8 flex flex-col md:flex-row items-center justify-between gap-3">
      <p class="text-white/30 text-sm">© {{ date('Y') }} {{ $settings['doctor_name'] ?? 'Dr. O.A. Soje' }}. All rights reserved.</p>
      <p class="text-white/30 text-sm">Fosterheirs Mental Health Consultancy · Oye-Ekiti, Nigeria</p>
    </div>
  </div>
</footer>

<script>
  lucide.createIcons();
  window.addEventListener('scroll', () =>
    document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 55)
  );
  function toggleMenu(){
    const m=document.getElementById('mobile-menu'), open=m.classList.toggle('open');
    document.getElementById('ham-icon').setAttribute('data-lucide', open ? 'x' : 'menu');
    lucide.createIcons();
  }
</script>
</body>
</html>
