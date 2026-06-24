<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="{{ asset('favicon.ico') }}" />
  <title>{{ $course->title }} | {{ $settings['doctor_name'] ?? 'Dr. O.A. Soje' }}</title>
  <meta name="description" content="{{ Str::limit($course->description ?? $course->title, 160) }}" />
  <link rel="canonical" href="{{ route('courses.show', $course) }}" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="{{ route('courses.show', $course) }}" />
  <meta property="og:title" content="{{ $course->title }} | {{ $settings['doctor_name'] ?? 'Dr. O.A. Soje' }}" />
  <meta property="og:description" content="{{ Str::limit($course->description ?? $course->title, 160) }}" />
  <meta property="og:site_name" content="{{ $settings['doctor_name'] ?? 'Dr. O.A. Soje' }}" />
  <meta name="twitter:card" content="summary" />
  <meta name="twitter:title" content="{{ $course->title }}" />
  <meta name="twitter:description" content="{{ Str::limit($course->description ?? $course->title, 160) }}" />
  <!-- JSON-LD: Course -->
  @php
  $courseJsonLd = json_encode([
      '@context'    => 'https://schema.org',
      '@type'       => 'Course',
      'name'        => $course->title,
      'description' => Str::limit($course->description ?? $course->title, 500),
      'url'         => route('courses.show', $course),
      'provider'    => [
          '@type' => 'Person',
          'name'  => $settings['doctor_name'] ?? 'Dr. O.A. Soje',
          'url'   => url('/'),
      ],
  ], JSON_UNESCAPED_SLASHES);
  @endphp
  <script type="application/ld+json">{!! $courseJsonLd !!}</script>
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
    .ep-list::-webkit-scrollbar{width:4px;}
    .ep-list::-webkit-scrollbar-thumb{background:#e2d4be;border-radius:3px;}
    #navbar{transition:background .3s ease,box-shadow .3s ease;}
    #navbar.scrolled{background:rgba(255,255,255,.97)!important;box-shadow:0 2px 20px rgba(0,0,0,.08);}
    #navbar.scrolled .nav-link{color:#0F2444!important;}
    #navbar.scrolled .nav-logo{color:#0F2444!important;}
    #mobile-menu{max-height:0;opacity:0;overflow:hidden;transition:max-height .35s ease,opacity .3s ease;}
    #mobile-menu.open{max-height:360px;opacity:1;}
    .ep-item{transition:background .18s ease,border-color .18s ease;}
    .ep-item.active{background:#FDF9F4;border-left:3px solid #C9922A;}
    .ep-item:not(.active){border-left:3px solid transparent;}
    .ep-item:hover:not(.active){background:#f9f9f9;border-left-color:#e2d4be;}
    @keyframes fadeIn{from{opacity:0;transform:translateY(8px);}to{opacity:1;transform:translateY(0);}}
    .fadein{animation:fadeIn .4s ease both;}
    .player-wrapper{position:relative;padding-bottom:56.25%;height:0;overflow:hidden;border-radius:16px;}
    .player-wrapper iframe{position:absolute;top:0;left:0;width:100%;height:100%;border:0;border-radius:16px;}
    .player-placeholder{position:relative;padding-bottom:56.25%;height:0;overflow:hidden;border-radius:16px;background:#0F2444;}
  </style>
</head>
<body class="bg-cream antialiased">

<!-- NAV -->
<nav id="navbar" class="fixed top-0 left-0 right-0 z-50 bg-primary px-6 py-4">
  <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
    <a href="{{ route('home') }}" class="nav-logo font-serif text-white text-xl font-bold tracking-wide flex-shrink-0">{{ $settings['doctor_name'] ?? 'Dr. O.A. Soje' }}</a>
    <div class="hidden md:flex items-center gap-7">
      <a href="{{ route('home') }}#about"        class="nav-link text-white/70 hover:text-gold text-sm font-medium transition-colors">About</a>
      <a href="{{ route('home') }}#services"     class="nav-link text-white/70 hover:text-gold text-sm font-medium transition-colors">Services</a>
      <a href="{{ route('home') }}#books"        class="nav-link text-white/70 hover:text-gold text-sm font-medium transition-colors">Books</a>
      <a href="{{ route('courses.index') }}"     class="nav-link text-gold text-sm font-semibold">Courses</a>
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

<!-- MAIN CONTENT -->
<main class="pt-20 min-h-screen">

  <!-- Course heading strip -->
  <div class="bg-primary text-white px-6 pt-8 pb-10">
    <div class="max-w-7xl mx-auto">
      <a href="{{ route('courses.index') }}" class="inline-flex items-center gap-1.5 text-white/40 hover:text-gold text-xs font-medium transition-colors mb-4">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        Back to Courses
      </a>
      <h1 class="font-serif text-2xl sm:text-3xl lg:text-4xl font-bold leading-snug mb-2">{{ $course->title }}</h1>
      @if($course->description)
      <p class="text-white/55 text-sm leading-relaxed max-w-2xl mt-2">{{ $course->description }}</p>
      @endif
      <div class="flex items-center gap-4 mt-4">
        <span class="inline-flex items-center gap-1.5 bg-white/10 text-gold text-xs font-semibold px-3 py-1.5 rounded-full">
          <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
          {{ $course->modules->count() }} {{ Str::plural('Episode', $course->modules->count()) }}
        </span>
        <span class="text-white/30 text-xs">by {{ $settings['doctor_name'] ?? 'Dr. O.A. Soje' }}</span>
      </div>
    </div>
  </div>

  @if($course->modules->isEmpty())
  <div class="max-w-7xl mx-auto px-6 py-20 text-center">
    <div class="w-20 h-20 bg-white rounded-2xl border border-gray-100 flex items-center justify-center mx-auto mb-5 shadow-sm">
      <svg class="w-10 h-10 text-gray-200" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
    </div>
    <h2 class="font-serif text-xl font-bold text-primary mb-2">Episodes Coming Soon</h2>
    <p class="text-gray-400 text-sm mb-6">Check back shortly — episodes for this course will be uploaded soon.</p>
    <a href="{{ route('courses.index') }}" class="inline-flex items-center gap-2 bg-primary hover:bg-primary-light text-white text-sm font-semibold px-6 py-3 rounded-full transition-colors">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
      Browse Other Courses
    </a>
  </div>
  @else

  @php $first = $course->modules->first(); @endphp

  <!-- Player + Episodes layout -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 py-8">
    <div class="flex flex-col lg:flex-row gap-6">

      <!-- LEFT: Player -->
      <div class="flex-1 min-w-0">

        <!-- Video player -->
        <div id="player-area">
          @if($first->youtube_id)
          <div class="player-wrapper shadow-xl">
            <iframe id="yt-player"
              src="https://www.youtube.com/embed/{{ $first->youtube_id }}?rel=0&modestbranding=1"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowfullscreen
              title="{{ e($first->title) }}">
            </iframe>
          </div>
          @else
          <div class="player-placeholder shadow-xl">
            <div class="absolute inset-0 flex flex-col items-center justify-center gap-3">
              <svg class="w-14 h-14 text-white/15" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
              <p class="text-white/30 text-sm">Video not available yet</p>
            </div>
          </div>
          @endif
        </div>

        <!-- Active episode info -->
        <div class="mt-5 fadein" id="ep-info">
          <div class="flex items-start justify-between gap-4 flex-wrap">
            <div class="min-w-0">
              <p class="text-gold text-xs font-bold uppercase tracking-wider mb-1" id="ep-number">Episode 1</p>
              <h2 class="font-serif text-xl sm:text-2xl font-bold text-primary leading-snug" id="ep-title">{{ $first->title }}</h2>
            </div>
            <div id="ep-workbook-wrap" class="{{ $first->workbook_url ? '' : 'hidden' }}">
              <a href="{{ $first->workbook_url ?? '#' }}" target="_blank" rel="noopener" id="ep-workbook-link"
                 class="inline-flex items-center gap-2 bg-gold/10 hover:bg-gold text-gold hover:text-white text-sm font-semibold px-5 py-2.5 rounded-full transition-all border border-gold/25 hover:border-gold flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                Read Workbook
              </a>
            </div>
          </div>

          <!-- Prev / Next -->
          <div class="flex items-center gap-3 mt-5 pt-5 border-t border-gray-100">
            <button id="btn-prev" onclick="goEp(currentEp - 1)" disabled
              class="inline-flex items-center gap-1.5 text-sm font-medium text-gray-400 hover:text-primary disabled:opacity-30 disabled:cursor-not-allowed transition-colors">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
              Previous
            </button>
            <span class="text-gray-200 text-xs">|</span>
            <button id="btn-next" onclick="goEp(currentEp + 1)" {{ $course->modules->count() <= 1 ? 'disabled' : '' }}
              class="inline-flex items-center gap-1.5 text-sm font-medium text-gray-400 hover:text-primary disabled:opacity-30 disabled:cursor-not-allowed transition-colors">
              Next
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button>
          </div>
        </div>

        @if($course->description)
        <div class="mt-8 bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
          <h3 class="font-serif font-bold text-primary text-base mb-2">About This Course</h3>
          <p class="text-gray-400 text-sm leading-relaxed">{{ $course->description }}</p>
        </div>
        @endif
      </div>

      <!-- RIGHT: Episodes list -->
      <div class="w-full lg:w-80 xl:w-96 flex-shrink-0">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden sticky top-24">
          <div class="px-5 py-4 border-b border-gray-50 flex items-center justify-between">
            <h3 class="font-semibold text-primary text-sm">Episodes</h3>
            <span class="text-gold text-xs font-bold bg-gold/10 px-2.5 py-1 rounded-full">{{ $course->modules->count() }}</span>
          </div>
          <div class="ep-list overflow-y-auto" style="max-height: 520px;">
            @foreach($course->modules as $mi => $module)
            <button type="button"
              onclick="goEp({{ $mi }})"
              id="ep-btn-{{ $mi }}"
              class="ep-item {{ $mi === 0 ? 'active' : '' }} w-full flex items-start gap-3 px-4 py-3.5 text-left cursor-pointer">
              <div class="w-20 h-12 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0 relative">
                @if($module->youtube_id)
                <img src="https://img.youtube.com/vi/{{ $module->youtube_id }}/default.jpg"
                     alt="{{ $module->title }}"
                     class="w-full h-full object-cover" loading="lazy" />
                @else
                <div class="w-full h-full flex items-center justify-center bg-primary/80">
                  <svg class="w-5 h-5 text-white/30" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                </div>
                @endif
              </div>
              <div class="flex-1 min-w-0">
                <p class="text-gold text-[10px] font-bold uppercase tracking-wider">Episode {{ $mi + 1 }}</p>
                <p class="text-primary text-xs font-semibold leading-snug mt-0.5 line-clamp-2">{{ $module->title }}</p>
                @if($module->workbook_url)
                <span class="inline-flex items-center gap-0.5 text-[10px] text-emerald-600 mt-1">
                  <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                  Workbook available
                </span>
                @endif
              </div>
            </button>
            @endforeach
          </div>
        </div>
      </div>

    </div>
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

  /* Episodes data — pre-computed in controller, safe for Blade */
  const episodes = @json($episodes);

  let currentEp = 0;

  function goEp(idx) {
    if (idx < 0 || idx >= episodes.length) return;
    const ep = episodes[idx];
    currentEp = idx;

    /* Swap player */
    const pa = document.getElementById('player-area');
    if (ep.youtube_id) {
      pa.innerHTML = `<div class="player-wrapper shadow-xl"><iframe src="https://www.youtube.com/embed/${ep.youtube_id}?rel=0&modestbranding=1&autoplay=1" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen title="${ep.title.replace(/"/g,'&quot;')}"></iframe></div>`;
    } else {
      pa.innerHTML = `<div class="player-placeholder shadow-xl"><div class="absolute inset-0 flex flex-col items-center justify-center gap-3"><svg class="w-14 h-14 text-white/15" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg><p class="text-white/30 text-sm">Video not available yet</p></div></div>`;
    }

    /* Update episode label + title */
    document.getElementById('ep-number').textContent = 'Episode ' + (idx + 1);
    document.getElementById('ep-title').textContent  = ep.title;

    /* Workbook button */
    const ww = document.getElementById('ep-workbook-wrap');
    const wl = document.getElementById('ep-workbook-link');
    if (ep.workbook_url) { wl.href = ep.workbook_url; ww.classList.remove('hidden'); }
    else { ww.classList.add('hidden'); }

    /* Prev / Next */
    document.getElementById('btn-prev').disabled = idx === 0;
    document.getElementById('btn-next').disabled = idx === episodes.length - 1;

    /* Highlight active in list */
    document.querySelectorAll('.ep-item').forEach((el, i) => el.classList.toggle('active', i === idx));
    const ab = document.getElementById('ep-btn-' + idx);
    if (ab) ab.scrollIntoView({ block: 'nearest', behavior: 'smooth' });

    /* Scroll to player on mobile */
    if (window.innerWidth < 1024) document.getElementById('player-area').scrollIntoView({ behavior: 'smooth', block: 'start' });
  }

  /* Navbar scroll tint */
  window.addEventListener('scroll', () => document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 55));

  function toggleMenu(){
    const m=document.getElementById('mobile-menu'), open=m.classList.toggle('open');
    document.getElementById('ham-icon').setAttribute('data-lucide', open ? 'x' : 'menu');
    lucide.createIcons();
  }
</script>
</body>
</html>
