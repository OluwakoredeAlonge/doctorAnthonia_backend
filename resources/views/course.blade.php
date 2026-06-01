<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $course->title }} | {{ $settings['doctor_name'] ?? 'Dr. O.A. Soje' }}</title>
  <meta name="description" content="{{ $course->description ?? $course->title }}" />
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
    ::-webkit-scrollbar{width:5px;}
    ::-webkit-scrollbar-track{background:#f1f1f1;}
    ::-webkit-scrollbar-thumb{background:#C9922A;border-radius:3px;}
    .ep-list::-webkit-scrollbar{width:4px;}
    .ep-list::-webkit-scrollbar-thumb{background:#e2d4be;border-radius:3px;}
    #navbar{transition:background .3s ease,box-shadow .3s ease;}
    #navbar.scrolled{background:rgba(255,255,255,.97)!important;box-shadow:0 2px 20px rgba(0,0,0,.08);}
    #navbar.scrolled .nav-link-page{color:#0F2444!important;}
    #navbar.scrolled .nav-logo{color:#0F2444!important;}
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
    <a href="{{ route('home') }}" class="nav-logo font-serif text-white text-xl font-bold tracking-wide flex-shrink-0">
      {{ $settings['doctor_name'] ?? 'Dr. O.A. Soje' }}
    </a>
    <div class="flex items-center gap-4 min-w-0">
      <span class="hidden sm:block text-white/30 text-sm font-medium truncate max-w-xs lg:max-w-md">{{ $course->title }}</span>
    </div>
    <a href="{{ route('home') }}#courses"
       class="nav-link-page flex-shrink-0 inline-flex items-center gap-1.5 text-white/70 hover:text-gold text-sm font-medium transition-colors">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
      All Courses
    </a>
  </div>
</nav>

<!-- MAIN CONTENT -->
<main class="pt-20 min-h-screen">

  <!-- Course heading strip -->
  <div class="bg-primary text-white px-6 pt-8 pb-10">
    <div class="max-w-7xl mx-auto">
      <a href="{{ route('home') }}#courses" class="inline-flex items-center gap-1.5 text-white/40 hover:text-gold text-xs font-medium transition-colors mb-4">
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
  <!-- No episodes yet -->
  <div class="max-w-7xl mx-auto px-6 py-20 text-center">
    <div class="w-20 h-20 bg-white rounded-2xl border border-gray-100 flex items-center justify-center mx-auto mb-5 shadow-sm">
      <svg class="w-10 h-10 text-gray-200" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
    </div>
    <h2 class="font-serif text-xl font-bold text-primary mb-2">Episodes Coming Soon</h2>
    <p class="text-gray-400 text-sm mb-6">Check back shortly — episodes for this course will be uploaded soon.</p>
    <a href="{{ route('home') }}#courses" class="inline-flex items-center gap-2 bg-primary hover:bg-primary-light text-white text-sm font-semibold px-6 py-3 rounded-full transition-colors">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
      Browse Other Courses
    </a>
  </div>
  @else

  <!-- Player + Episodes layout -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 py-8">
    <div class="flex flex-col lg:flex-row gap-6">

      <!-- ── LEFT: Player ── -->
      <div class="flex-1 min-w-0">

        <!-- Video player -->
        <div id="player-area">
          @php $first = $course->modules->first(); @endphp
          @if($first->youtube_id)
          <div class="player-wrapper shadow-xl">
            <iframe id="yt-player"
              src="https://www.youtube.com/embed/{{ $first->youtube_id }}?rel=0&modestbranding=1"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowfullscreen
              title="{{ $first->title }}">
            </iframe>
          </div>
          @else
          <div class="player-placeholder shadow-xl flex items-center justify-center">
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
            @if($first->workbook_url)
            <div id="ep-workbook-wrap">
              <a href="{{ $first->workbook_url }}" target="_blank" rel="noopener" id="ep-workbook-link"
                 class="inline-flex items-center gap-2 bg-gold/10 hover:bg-gold text-gold hover:text-white text-sm font-semibold px-5 py-2.5 rounded-full transition-all border border-gold/25 hover:border-gold flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                Read Workbook
              </a>
            </div>
            @else
            <div id="ep-workbook-wrap" class="hidden">
              <a href="#" target="_blank" rel="noopener" id="ep-workbook-link"
                 class="inline-flex items-center gap-2 bg-gold/10 hover:bg-gold text-gold hover:text-white text-sm font-semibold px-5 py-2.5 rounded-full transition-all border border-gold/25 hover:border-gold flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                Read Workbook
              </a>
            </div>
            @endif
          </div>

          <!-- Prev / Next navigation -->
          <div class="flex items-center gap-3 mt-5 pt-5 border-t border-gray-100">
            <button id="btn-prev" onclick="goEp(currentEp - 1)"
              class="inline-flex items-center gap-1.5 text-sm font-medium text-gray-400 hover:text-primary disabled:opacity-30 disabled:cursor-not-allowed transition-colors">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
              Previous
            </button>
            <span class="text-gray-200 text-xs">|</span>
            <button id="btn-next" onclick="goEp(currentEp + 1)"
              class="inline-flex items-center gap-1.5 text-sm font-medium text-gray-400 hover:text-primary disabled:opacity-30 disabled:cursor-not-allowed transition-colors">
              Next
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button>
          </div>
        </div>

        <!-- About the course (shown below player on desktop) -->
        @if($course->description)
        <div class="mt-8 bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
          <h3 class="font-serif font-bold text-primary text-base mb-2">About This Course</h3>
          <p class="text-gray-400 text-sm leading-relaxed">{{ $course->description }}</p>
        </div>
        @endif
      </div>

      <!-- ── RIGHT: Episodes list ── -->
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
              {{-- Thumbnail --}}
              <div class="w-20 h-12 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0 relative">
                @if($module->youtube_id)
                <img src="https://img.youtube.com/vi/{{ $module->youtube_id }}/default.jpg"
                     alt="{{ $module->title }}"
                     class="w-full h-full object-cover" loading="lazy" />
                <div class="absolute inset-0 bg-black/20 flex items-center justify-center {{ $mi === 0 ? 'opacity-100' : 'opacity-0 group-hover:opacity-100' }}">
                  <div class="w-5 h-5 bg-[#FF0000] rounded-full flex items-center justify-center">
                    <svg class="w-2.5 h-2.5 text-white ml-px" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                  </div>
                </div>
                @else
                <div class="w-full h-full flex items-center justify-center bg-primary/80">
                  <svg class="w-5 h-5 text-white/30" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                </div>
                @endif
              </div>
              {{-- Info --}}
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

<!-- FOOTER (minimal) -->
<footer class="bg-primary mt-16 py-10 px-6">
  <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4">
    <div>
      <p class="font-serif text-white font-bold text-lg">{{ $settings['doctor_name'] ?? 'Dr. O.A. Soje' }}</p>
      <p class="text-white/35 text-xs mt-1">Fosterheirs Mental Health Consultancy · Oye-Ekiti, Nigeria</p>
    </div>
    <div class="flex items-center gap-5">
      <a href="{{ route('home') }}" class="text-white/40 hover:text-gold text-sm transition-colors">Portfolio</a>
      <a href="{{ route('home') }}#courses" class="text-white/40 hover:text-gold text-sm transition-colors">All Courses</a>
      <a href="{{ route('home') }}#contact" class="text-white/40 hover:text-gold text-sm transition-colors">Contact</a>
    </div>
    <p class="text-white/25 text-xs">© {{ date('Y') }} {{ $settings['doctor_name'] ?? 'Dr. O.A. Soje' }}</p>
  </div>
</footer>

<script>
  lucide.createIcons();

  /* ── Episode data ── */
  const episodes = @json($course->modules->map(fn($m, $i) => [
    'index'       => $i,
    'title'       => $m->title,
    'youtube_id'  => $m->youtube_id,
    'youtube_url' => $m->youtube_url,
    'workbook_url'=> $m->workbook_url,
  ])->values());

  let currentEp = 0;

  function goEp(idx) {
    if (idx < 0 || idx >= episodes.length) return;

    const ep = episodes[idx];
    currentEp = idx;

    /* Update player */
    const playerArea = document.getElementById('player-area');
    if (ep.youtube_id) {
      playerArea.innerHTML = `
        <div class="player-wrapper shadow-xl">
          <iframe id="yt-player"
            src="https://www.youtube.com/embed/${ep.youtube_id}?rel=0&modestbranding=1&autoplay=1"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen
            title="${ep.title.replace(/"/g,'&quot;')}">
          </iframe>
        </div>`;
    } else {
      playerArea.innerHTML = `
        <div class="player-placeholder shadow-xl flex items-center justify-center">
          <div class="absolute inset-0 flex flex-col items-center justify-center gap-3">
            <svg class="w-14 h-14 text-white/15" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
            <p class="text-white/30 text-sm">Video not available yet</p>
          </div>
        </div>`;
    }

    /* Update episode info */
    document.getElementById('ep-number').textContent = 'Episode ' + (idx + 1);
    document.getElementById('ep-title').textContent  = ep.title;

    const wbWrap = document.getElementById('ep-workbook-wrap');
    const wbLink = document.getElementById('ep-workbook-link');
    if (ep.workbook_url) {
      wbLink.href = ep.workbook_url;
      wbWrap.classList.remove('hidden');
    } else {
      wbWrap.classList.add('hidden');
    }

    /* Update prev/next buttons */
    document.getElementById('btn-prev').disabled = idx === 0;
    document.getElementById('btn-next').disabled = idx === episodes.length - 1;

    /* Highlight active episode in list */
    document.querySelectorAll('.ep-item').forEach((el, i) => {
      el.classList.toggle('active', i === idx);
    });

    /* Scroll episode into view in the list */
    const activeBtn = document.getElementById('ep-btn-' + idx);
    if (activeBtn) {
      activeBtn.scrollIntoView({ block: 'nearest', behavior: 'smooth' });
    }

    /* Scroll to top of player on mobile */
    if (window.innerWidth < 1024) {
      document.getElementById('player-area').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  }

  /* Init prev/next state */
  document.getElementById('btn-prev').disabled = true;
  if (episodes.length <= 1) document.getElementById('btn-next').disabled = true;

  /* Navbar scroll tint */
  window.addEventListener('scroll', () =>
    document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 55)
  );
</script>
</body>
</html>
