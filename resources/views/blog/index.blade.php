<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Blog &amp; Insights | Dr. Anthonia Yemisi Soje</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet" />
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
    .reveal{opacity:0;transform:translateY(24px);transition:opacity .65s ease,transform .65s ease;}
    .reveal.visible{opacity:1;transform:translateY(0);}
    #navbar{transition:background .3s ease,box-shadow .3s ease;}
    #navbar.scrolled{background:rgba(255,255,255,.97)!important;box-shadow:0 2px 20px rgba(0,0,0,.08);}
    #navbar.scrolled .nav-link{color:#0F2444!important;}
    #navbar.scrolled .nav-logo{color:#0F2444!important;}
    .post-card{transition:transform .3s ease,box-shadow .3s ease;}
    .post-card:hover{transform:translateY(-5px);box-shadow:0 16px 32px rgba(15,36,68,.1);}
    .post-card:hover .post-title{color:#C9922A;}
    .post-img{transition:transform .4s ease;}
    .post-card:hover .post-img{transform:scale(1.04);}
    ::-webkit-scrollbar{width:6px;}::-webkit-scrollbar-track{background:#FDF9F4;}::-webkit-scrollbar-thumb{background:#C9922A;border-radius:3px;}
    #mobile-menu{max-height:0;opacity:0;overflow:hidden;transition:max-height .35s ease,opacity .3s ease;}
    #mobile-menu.open{max-height:440px;opacity:1;}
  </style>
</head>
<body class="bg-cream antialiased">

<!-- NAVBAR -->
<nav id="navbar" class="fixed top-0 left-0 right-0 z-50 px-6 py-4 bg-primary">
  <div class="max-w-7xl mx-auto flex items-center justify-between">
    <a href="{{ route('home') }}" class="nav-logo font-serif text-white text-xl font-bold tracking-wide">Dr. A.Y. Soje</a>
    <div class="hidden md:flex items-center gap-7">
      <a href="{{ route('home') }}#about"        class="nav-link text-white/80 hover:text-gold text-sm font-medium transition-colors">About</a>
      <a href="{{ route('home') }}#services"     class="nav-link text-white/80 hover:text-gold text-sm font-medium transition-colors">Services</a>
      <a href="{{ route('home') }}#books"        class="nav-link text-white/80 hover:text-gold text-sm font-medium transition-colors">Books</a>
      <a href="{{ route('home') }}#organization" class="nav-link text-white/80 hover:text-gold text-sm font-medium transition-colors">Organization</a>
      <a href="{{ route('blog') }}" class="nav-link text-gold text-sm font-semibold border-b border-gold pb-0.5">Blog</a>
    </div>
    <a href="{{ route('home') }}#contact" class="hidden md:inline-flex items-center gap-2 bg-gold hover:bg-gold-light text-white text-sm font-semibold px-6 py-2.5 rounded-full transition-all shadow-lg shadow-gold/25">
      <i data-lucide="calendar" class="w-4 h-4"></i> Book a Session
    </a>
    <button id="ham" class="md:hidden text-white" onclick="toggleMenu()"><i data-lucide="menu" class="w-6 h-6" id="ham-icon"></i></button>
  </div>
  <div id="mobile-menu">
    <div class="mt-3 bg-white rounded-2xl shadow-2xl p-6 space-y-4">
      <a href="{{ route('home') }}#about"        class="block text-primary font-medium hover:text-gold transition-colors" onclick="toggleMenu()">About</a>
      <a href="{{ route('home') }}#services"     class="block text-primary font-medium hover:text-gold transition-colors" onclick="toggleMenu()">Services</a>
      <a href="{{ route('home') }}#books"        class="block text-primary font-medium hover:text-gold transition-colors" onclick="toggleMenu()">Books</a>
      <a href="{{ route('home') }}#organization" class="block text-primary font-medium hover:text-gold transition-colors" onclick="toggleMenu()">Organization</a>
      <a href="{{ route('blog') }}" class="block text-gold font-semibold">Blog</a>
      <a href="{{ route('home') }}#contact" onclick="toggleMenu()" class="block bg-gold hover:bg-gold-light text-white font-semibold px-6 py-3 rounded-full text-center transition-colors">Book a Session</a>
    </div>
  </div>
</nav>

<!-- HERO -->
<section class="pt-32 pb-16 bg-primary relative overflow-hidden">
  <div class="absolute inset-0 pointer-events-none opacity-30" style="background-image:radial-gradient(circle,rgba(201,146,42,.25) 1px,transparent 1px);background-size:28px 28px;"></div>
  <div class="relative max-w-7xl mx-auto px-6">
    <div class="flex items-center gap-2 text-white/50 text-sm mb-6">
      <a href="{{ route('home') }}" class="hover:text-gold transition-colors">Home</a>
      <i data-lucide="chevron-right" class="w-4 h-4"></i>
      <span class="text-gold">Blog</span>
    </div>
    <div class="max-w-2xl">
      <div class="inline-flex items-center gap-2 border border-gold/35 bg-gold/10 text-gold text-xs font-semibold px-4 py-2 rounded-full mb-6 tracking-widest uppercase">
        <i data-lucide="pen-line" class="w-3.5 h-3.5"></i> Insights &amp; Reflections
      </div>
      <h1 class="font-serif text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight mb-4">Blog &amp; <span class="text-gold">Articles</span></h1>
      <p class="text-white/60 text-lg leading-relaxed">Practical insights on mental health, healing, relationships, and faith — written to inform, encourage, and transform.</p>
    </div>
  </div>
</section>

<!-- FILTER BAR -->
<div class="sticky top-16 z-40 bg-white border-b border-gray-100 shadow-sm">
  <div class="max-w-7xl mx-auto px-6 py-3">
    <div class="flex items-center gap-2 overflow-x-auto pb-1">
      <a href="{{ route('blog') }}" class="flex-shrink-0 border text-xs font-semibold px-4 py-2 rounded-full transition-all {{ !request('category') ? 'bg-primary text-white border-primary' : 'border-gray-200 text-primary hover:border-primary' }}">All Posts</a>
      @foreach($categories as $cat)
      <a href="{{ route('blog', ['category' => $cat]) }}" class="flex-shrink-0 border text-xs font-semibold px-4 py-2 rounded-full transition-all {{ request('category') === $cat ? 'bg-primary text-white border-primary' : 'border-gray-200 text-primary hover:border-primary' }}">{{ $cat }}</a>
      @endforeach
    </div>
  </div>
</div>

<!-- MAIN -->
<main class="max-w-7xl mx-auto px-6 py-16">
  <div class="grid lg:grid-cols-3 gap-10">

    <!-- Posts -->
    <div class="lg:col-span-2">

      @if($posts->isEmpty())
      <div class="text-center py-20">
        <i data-lucide="file-text" class="w-16 h-16 text-gray-200 mx-auto mb-4"></i>
        <h3 class="font-serif text-xl text-gray-400">No articles yet</h3>
        <p class="text-gray-300 text-sm mt-2">Check back soon for new insights.</p>
      </div>
      @else

      @if($featured && !request('category'))
      <!-- Featured post -->
      <a href="{{ route('blog.show', $featured) }}" class="post-card group bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 mb-8 cursor-pointer reveal block">
        <div class="overflow-hidden" style="height:280px;background:linear-gradient(135deg,#0F2444,#1C3A5E);">
          @if($featured->featured_image)
            <div class="post-img w-full h-full"><img src="{{ $featured->featured_image }}" alt="{{ $featured->title }}" class="w-full h-full object-cover" /></div>
          @else
            <div class="post-img w-full h-full flex items-center justify-center text-white/20"><i data-lucide="image" class="w-16 h-16 mx-auto"></i></div>
          @endif
        </div>
        <div class="p-8">
          <div class="flex items-center gap-3 mb-4">
            <span class="bg-gold/10 text-gold text-xs font-semibold px-3 py-1 rounded-full">{{ $featured->category }}</span>
            <span class="bg-blue-50 text-blue-600 text-xs font-semibold px-3 py-1 rounded-full">Featured</span>
          </div>
          <h2 class="post-title font-serif text-2xl font-bold text-primary leading-tight mb-3 transition-colors duration-300">{{ $featured->title }}</h2>
          <p class="text-gray-500 text-sm leading-relaxed mb-5">{{ $featured->excerpt ?? Str::limit(strip_tags($featured->content), 200) }}</p>
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
              <div class="w-9 h-9 rounded-xl bg-primary flex items-center justify-center"><i data-lucide="user" class="w-4 h-4 text-white/50"></i></div>
              <div>
                <p class="text-xs font-semibold text-primary">Dr. A.Y. Soje</p>
                <p class="text-xs text-gray-400">{{ $featured->published_at?->format('M j, Y') }} · {{ $featured->read_time }} min read</p>
              </div>
            </div>
            <div class="flex items-center gap-4">
              <span class="flex items-center gap-1 text-gray-400 text-xs"><i data-lucide="eye" class="w-3.5 h-3.5"></i> {{ number_format($featured->views) }}</span>
              <span class="inline-flex items-center gap-1.5 text-gold text-sm font-semibold group-hover:gap-2.5 transition-all">Read More <i data-lucide="arrow-right" class="w-4 h-4"></i></span>
            </div>
          </div>
        </div>
      </a>
      @endif

      <!-- Post grid -->
      @php $catColorMap = ['Mental Health'=>'blue','Addiction & Recovery'=>'green','Marriage & Family'=>'red','Faith & Healing'=>'purple','Parenting'=>'orange']; @endphp
      <div class="grid sm:grid-cols-2 gap-6">
        @foreach($posts as $post)
        @php $clr = $catColorMap[$post->category] ?? 'gray'; @endphp
        <a href="{{ route('blog.show', $post) }}" class="post-card group bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 cursor-pointer reveal block">
          <div class="overflow-hidden" style="height:160px;background:linear-gradient(135deg,#0F2444,#1C3A5E);">
            @if($post->featured_image)
              <div class="post-img w-full h-full"><img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="w-full h-full object-cover" /></div>
            @else
              <div class="post-img w-full h-full flex items-center justify-center text-white/20"><i data-lucide="file-text" class="w-8 h-8"></i></div>
            @endif
          </div>
          <div class="p-5">
            <span class="text-xs bg-{{ $clr }}-50 text-{{ $clr }}-700 px-2.5 py-1 rounded-full font-medium">{{ $post->category }}</span>
            <h3 class="post-title font-serif text-base font-bold text-primary leading-snug mt-3 mb-2 transition-colors duration-300">{{ $post->title }}</h3>
            <p class="text-gray-400 text-xs leading-relaxed mb-4 line-clamp-2">{{ $post->excerpt ?? Str::limit(strip_tags($post->content), 120) }}</p>
            <div class="flex items-center justify-between">
              <div class="flex items-center gap-3 text-gray-400 text-xs">
                <span class="flex items-center gap-1"><i data-lucide="clock" class="w-3 h-3"></i> {{ $post->read_time }} min</span>
                <span class="flex items-center gap-1"><i data-lucide="eye" class="w-3 h-3"></i> {{ number_format($post->views) }}</span>
              </div>
              <span class="text-gold text-xs font-semibold flex items-center gap-1 group-hover:gap-2 transition-all">Read <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i></span>
            </div>
          </div>
        </a>
        @endforeach
      </div>

      <!-- Pagination -->
      @if($posts->hasPages())
      <div class="mt-10 flex items-center justify-center gap-2">
        {{ $posts->appends(request()->query())->links('pagination::simple-tailwind') }}
      </div>
      @endif

      @endif
    </div>

    <!-- Sidebar -->
    <aside class="space-y-6">

      <!-- Search -->
      <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
        <h3 class="font-semibold text-gray-800 text-sm mb-4 flex items-center gap-2"><i data-lucide="search" class="w-4 h-4 text-gold"></i> Search</h3>
        <form method="GET" action="{{ route('blog') }}" class="relative">
          <input type="text" name="q" value="{{ request('q') }}" placeholder="Search articles..." class="w-full border border-gray-200 rounded-xl pl-4 pr-10 py-2.5 text-sm focus:outline-none focus:border-gold transition-all placeholder-gray-300" />
          <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-primary"><i data-lucide="search" class="w-4 h-4"></i></button>
        </form>
      </div>

      <!-- About widget -->
      <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
        <div class="flex items-center gap-3 mb-4">
          <div class="w-12 h-12 rounded-xl bg-primary flex items-center justify-center"><i data-lucide="user" class="w-6 h-6 text-white/50"></i></div>
          <div><p class="font-semibold text-gray-800 text-sm">Dr. A.Y. Soje</p><p class="text-gray-400 text-xs">Psycho-trauma Therapist</p></div>
        </div>
        <p class="text-gray-400 text-xs leading-relaxed">Medical practitioner, faith-integrated therapist, and published author dedicated to whole-person healing.</p>
        <a href="{{ route('home') }}#about" class="mt-3 block text-gold text-xs font-semibold hover:text-gold-light transition-colors">Read full bio →</a>
      </div>

      <!-- Categories -->
      <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
        <h3 class="font-semibold text-gray-800 text-sm mb-4 flex items-center gap-2"><i data-lucide="tag" class="w-4 h-4 text-gold"></i> Categories</h3>
        <ul class="space-y-2">
          <li><a href="{{ route('blog') }}" class="flex items-center justify-between text-gray-500 hover:text-gold text-sm transition-colors"><span>All Posts</span><span class="text-xs bg-gray-100 px-2 py-0.5 rounded-full">{{ $posts->total() }}</span></a></li>
          @foreach($categories as $cat)
          <li><a href="{{ route('blog', ['category' => $cat]) }}" class="flex items-center justify-between text-gray-500 hover:text-gold text-sm transition-colors"><span>{{ $cat }}</span></a></li>
          @endforeach
        </ul>
      </div>

      <!-- Books CTA -->
      <div class="bg-primary rounded-2xl p-5 text-white">
        <div class="w-10 h-10 bg-gold/20 rounded-xl flex items-center justify-center mb-4"><i data-lucide="book-open" class="w-5 h-5 text-gold"></i></div>
        <h3 class="font-serif font-bold text-base mb-2">Explore Dr. Soje's Books</h3>
        <p class="text-white/55 text-xs leading-relaxed mb-4">A growing library of works on mental health, faith, and healing.</p>
        <a href="{{ route('home') }}#books" class="block text-center bg-gold hover:bg-gold-light text-white text-xs font-semibold px-4 py-2.5 rounded-xl transition-colors">View Books</a>
      </div>

    </aside>
  </div>
</main>

<!-- FOOTER -->
<footer class="bg-primary-dark text-white py-12 mt-8">
  <div class="max-w-7xl mx-auto px-6 text-center">
    <p class="font-serif text-xl font-bold mb-1">Dr. A.Y. Soje</p>
    <p class="text-gold text-sm mb-4">Mental Health Professional &amp; Author</p>
    <div class="pt-6 border-t border-white/8">
      <p class="text-white/30 text-sm">© {{ date('Y') }} Dr. Mrs. Anthonia Yemisi Soje. All rights reserved.</p>
    </div>
  </div>
</footer>

<script>
  lucide.createIcons();
  window.addEventListener('scroll', () => document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 55));
  function toggleMenu(){const m=document.getElementById('mobile-menu'),open=m.classList.toggle('open');document.getElementById('ham-icon').setAttribute('data-lucide',open?'x':'menu');lucide.createIcons();}
  const io=new IntersectionObserver(entries=>entries.forEach(e=>{if(e.isIntersecting)e.target.classList.add('visible');}),{threshold:0.1});
  document.querySelectorAll('.reveal').forEach(el=>io.observe(el));
</script>
</body>
</html>
