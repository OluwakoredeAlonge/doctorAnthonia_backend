<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Courses &amp; Teachings | {{ $settings['doctor_name'] ?? 'Dr. O.A. Soje' }}</title>
  <meta name="description" content="Watch and learn from {{ $settings['doctor_name'] ?? 'Dr. O.A. Soje' }} — courses on mental health, trauma recovery, marriage restoration, and faith-based wellness." />
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

<!-- FOOTER -->
<footer class="bg-primary mt-8 py-10 px-6">
  <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4">
    <div>
      <p class="font-serif text-white font-bold text-lg">{{ $settings['doctor_name'] ?? 'Dr. O.A. Soje' }}</p>
      <p class="text-white/35 text-xs mt-1">Fosterheirs Mental Health Consultancy · Oye-Ekiti, Nigeria</p>
    </div>
    <div class="flex items-center gap-5">
      <a href="{{ route('home') }}"          class="text-white/40 hover:text-gold text-sm transition-colors">Portfolio</a>
      <a href="{{ route('courses.index') }}" class="text-gold text-sm font-semibold transition-colors">Courses</a>
      <a href="{{ route('blog') }}"          class="text-white/40 hover:text-gold text-sm transition-colors">Blog</a>
      <a href="{{ route('home') }}#contact"  class="text-white/40 hover:text-gold text-sm transition-colors">Contact</a>
    </div>
    <p class="text-white/25 text-xs">© {{ date('Y') }} {{ $settings['doctor_name'] ?? 'Dr. O.A. Soje' }}</p>
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
