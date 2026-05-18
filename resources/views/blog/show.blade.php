<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $blogPost->title }} | Dr. A.Y. Soje</title>
  <meta name="description" content="{{ $blogPost->excerpt }}" />
  <meta property="og:title" content="{{ $blogPost->title }}" />
  <meta property="og:description" content="{{ $blogPost->excerpt }}" />
  @if($blogPost->featured_image)<meta property="og:image" content="{{ $blogPost->featured_image }}" />@endif
  <meta property="og:url" content="{{ route('blog.show', $blogPost) }}" />
  <meta property="og:type" content="article" />
  <meta name="twitter:card" content="summary_large_image" />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;0,800;1,400;1,700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
  <script>
    tailwind.config = {
      theme: { extend: {
        colors: { primary:'#0F2444','primary-light':'#1C3A5E','primary-dark':'#081526',gold:'#C9922A','gold-light':'#D4A847',cream:'#FDF9F4' },
        fontFamily: { serif:['Playfair Display','Georgia','serif'] },
      }}
    }
  </script>
  <style>
    body { font-family: 'Inter', sans-serif; background: #fff; }
    .font-serif { font-family: 'Playfair Display', serif !important; }

    /* Reading progress bar */
    #reading-bar { position: fixed; top: 0; left: 0; height: 3px; background: linear-gradient(90deg, #C9922A, #D4A847); width: 0%; z-index: 9999; transition: width .1s linear; }

    /* Animated hero gradient */
    @keyframes gradientShift {
      0%   { background-position: 0% 50%; }
      50%  { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }
    .hero-animated {
      background: linear-gradient(-45deg, #0F2444, #0d1e35, #1C3A5E, #152d4d, #081526, #1a3358);
      background-size: 400% 400%;
      animation: gradientShift 12s ease infinite;
    }

    /* Article typography */
    .article-body { font-size: 1.0625rem; line-height: 1.85; color: #374151; }
    .article-body h2 { font-family:'Playfair Display',serif; font-size:1.7rem; font-weight:700; color:#0F2444; margin-top:2.5rem; margin-bottom:.85rem; line-height:1.25; }
    .article-body h3 { font-family:'Playfair Display',serif; font-size:1.3rem; font-weight:700; color:#0F2444; margin-top:2rem; margin-bottom:.65rem; line-height:1.3; }
    .article-body h4 { font-family:'Playfair Display',serif; font-size:1.1rem; font-weight:600; color:#0F2444; margin-top:1.5rem; margin-bottom:.5rem; }
    .article-body p { margin-bottom:1.3rem; }
    .article-body p:first-of-type::first-letter { font-family:'Playfair Display',serif; font-size:3.5rem; font-weight:700; float:left; line-height:.8; margin:.08em .12em -.05em 0; color:#0F2444; }
    .article-body a { color:#C9922A; text-decoration:underline; text-underline-offset:3px; font-weight:500; }
    .article-body a:hover { color:#0F2444; }
    .article-body ul,.article-body ol { margin:1rem 0 1.3rem 1.75rem; }
    .article-body ul { list-style:none; padding-left:0; margin-left:0; }
    .article-body ul li { padding-left:1.5rem; position:relative; margin-bottom:.5rem; }
    .article-body ul li::before { content:''; position:absolute; left:0; top:.7em; width:.5rem; height:.5rem; background:#C9922A; border-radius:50%; }
    .article-body ol { list-style:decimal; }
    .article-body ol li { margin-bottom:.5rem; padding-left:.25rem; }
    .article-body blockquote {
      position:relative; border:none; margin:2.5rem 0;
      background:linear-gradient(135deg, #fdf6ec, #fef9f3);
      border-radius:1rem; padding:2rem 2rem 2rem 2.5rem;
      border-left:5px solid #C9922A;
      box-shadow:0 4px 24px rgba(201,146,42,.1);
    }
    .article-body blockquote::before {
      content:'\201C';
      position:absolute; top:-1rem; left:1.5rem;
      font-family:'Playfair Display',serif;
      font-size:5rem; color:#C9922A; opacity:.25;
      line-height:1;
    }
    .article-body blockquote p { color:#0F2444; font-size:1.1rem; font-style:italic; line-height:1.7; margin-bottom:0; font-weight:500; }
    .article-body strong { color:#0F2444; font-weight:600; }
    .article-body em { color:#4B5563; }
    .article-body hr { border:none; margin:2.5rem 0; height:1px; background:linear-gradient(90deg,transparent,#E5E7EB,transparent); }
    .article-body table { width:100%; border-collapse:collapse; margin:2rem 0; font-size:.9rem; border-radius:.75rem; overflow:hidden; box-shadow:0 2px 12px rgba(0,0,0,.06); }
    .article-body table th { background:#0F2444; color:white; padding:.8rem 1rem; text-align:left; font-weight:600; font-size:.8rem; text-transform:uppercase; letter-spacing:.05em; }
    .article-body table td { padding:.7rem 1rem; border-bottom:1px solid #F3F4F6; }
    .article-body table tr:last-child td { border-bottom:none; }
    .article-body table tr:nth-child(even) td { background:#FAFAFA; }
    .article-body pre { background:#1e293b; color:#e2e8f0; padding:1.5rem; border-radius:.875rem; overflow-x:auto; margin:2rem 0; font-size:.83rem; line-height:1.65; }
    .article-body code:not(pre code) { background:#F0F4FF; color:#3730a3; padding:.15rem .45rem; border-radius:.35rem; font-size:.875em; font-weight:500; }
    .article-body figure { margin:2rem 0; }
    .article-body figure img { width:100%; border-radius:.875rem; box-shadow:0 8px 32px rgba(0,0,0,.1); }
    .article-body figure figcaption { text-align:center; color:#9CA3AF; font-size:.8rem; margin-top:.6rem; font-style:italic; }
    .article-body mark { background:linear-gradient(120deg,#fef3c7,#fde68a); padding:.05rem .2rem; border-radius:.2rem; }
    .article-body img { max-width:100%; border-radius:.875rem; }

    /* Share buttons */
    .share-btn { width:2.75rem; height:2.75rem; border-radius:.75rem; display:flex; align-items:center; justify-content:center; transition:transform .2s,box-shadow .2s; box-shadow:0 2px 8px rgba(0,0,0,.12); }
    .share-btn:hover { transform:translateY(-3px); box-shadow:0 6px 20px rgba(0,0,0,.18); }
    .share-btn svg { width:1.1rem; height:1.1rem; }

    /* Fade-in animation */
    @keyframes fadein { from{opacity:0;transform:translateY(20px);} to{opacity:1;transform:translateY(0);} }
    .fadein { animation:fadein .7s ease forwards; }
    .fadein-delay { animation:fadein .7s ease .2s forwards; opacity:0; }

    /* Tooltip */
    .tooltip { position:relative; }
    .tooltip::after { content:attr(data-tip); position:absolute; left:50%; transform:translateX(-50%); bottom:calc(100% + 8px); background:#1F2937; color:white; font-size:.7rem; padding:.3rem .65rem; border-radius:.4rem; white-space:nowrap; opacity:0; pointer-events:none; transition:opacity .2s; }
    .tooltip:hover::after { opacity:1; }

    /* Table of contents highlight */
    .toc-link { transition:color .2s,border-color .2s; }
    .toc-link.active { color:#C9922A; border-left-color:#C9922A; }

    ::-webkit-scrollbar { width:5px; } ::-webkit-scrollbar-track { background:#f3f4f6; } ::-webkit-scrollbar-thumb { background:#C9922A; border-radius:3px; }
  </style>
</head>
<body>

<!-- Reading progress bar -->
<div id="reading-bar"></div>

<!-- NAVBAR -->
<nav class="fixed top-0 left-0 right-0 z-50 bg-primary/95 backdrop-blur-md" style="top:3px">
  <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
    <a href="{{ route('home') }}" class="font-serif text-white text-lg font-bold tracking-wide hover:text-gold transition-colors">Dr. A.Y. Soje</a>
    <a href="{{ route('blog') }}" class="text-white/70 hover:text-gold text-sm font-medium transition-colors flex items-center gap-2 group">
      <i data-lucide="arrow-left" class="w-4 h-4 group-hover:-translate-x-1 transition-transform"></i> All Articles
    </a>
  </div>
</nav>

<!-- ════════════════════════ HERO ════════════════════════ -->
<div class="hero-animated relative overflow-hidden pt-20">
  <!-- Decorative elements -->
  <div class="absolute inset-0 overflow-hidden pointer-events-none">
    <div class="absolute -top-32 -right-32 w-[600px] h-[600px] rounded-full bg-gold/5 blur-3xl"></div>
    <div class="absolute bottom-0 -left-20 w-80 h-80 rounded-full bg-primary-light/30 blur-3xl"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[400px] rounded-full bg-white/2 blur-3xl"></div>
    <!-- Subtle dot grid -->
    <div class="absolute inset-0 opacity-[0.04]" style="background-image:radial-gradient(rgba(255,255,255,.8) 1px,transparent 1px);background-size:28px 28px;"></div>
    <!-- Diagonal accent line -->
    <div class="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-gold/30 to-transparent"></div>
  </div>

  <div class="relative max-w-4xl mx-auto px-6 pt-12 pb-16 fadein">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-xs text-white/40 mb-8 font-medium">
      <a href="{{ route('home') }}" class="hover:text-white/70 transition-colors">Home</a>
      <i data-lucide="chevron-right" class="w-3 h-3"></i>
      <a href="{{ route('blog') }}" class="hover:text-white/70 transition-colors">Blog</a>
      <i data-lucide="chevron-right" class="w-3 h-3"></i>
      <span class="text-white/60 truncate max-w-xs">{{ $blogPost->category }}</span>
    </div>

    <!-- Category + Read time -->
    <div class="flex flex-wrap items-center gap-3 mb-6">
      <a href="{{ route('blog', ['category' => $blogPost->category]) }}"
         class="text-xs font-bold uppercase tracking-widest bg-gold text-white px-3.5 py-1.5 rounded-full hover:bg-gold-light transition-colors">
        {{ $blogPost->category }}
      </a>
      <span class="flex items-center gap-1.5 text-white/50 text-xs font-medium bg-white/5 px-3 py-1.5 rounded-full">
        <i data-lucide="clock" class="w-3.5 h-3.5"></i> {{ $blogPost->read_time }} min read
      </span>
      <span class="flex items-center gap-1.5 text-white/50 text-xs font-medium bg-white/5 px-3 py-1.5 rounded-full">
        <i data-lucide="eye" class="w-3.5 h-3.5"></i> {{ number_format($blogPost->views) }} views
      </span>
    </div>

    <!-- Title -->
    <h1 class="font-serif text-3xl md:text-4xl lg:text-5xl font-bold text-white leading-tight mb-6 max-w-3xl">
      {{ $blogPost->title }}
    </h1>

    <!-- Excerpt -->
    @if($blogPost->excerpt)
    <p class="text-white/65 text-lg leading-relaxed mb-10 max-w-2xl font-light">{{ $blogPost->excerpt }}</p>
    @endif

    <!-- Author row -->
    <div class="flex flex-wrap items-center gap-x-8 gap-y-3 pb-2">
      <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-gold to-gold-light flex items-center justify-center ring-2 ring-white/10">
          <i data-lucide="user" class="w-5 h-5 text-white"></i>
        </div>
        <div>
          <p class="text-white text-sm font-semibold leading-tight">Dr. Mrs. A.Y. Soje</p>
          {{-- <p class="text-white/40 text-xs">Psycho-Trauma Therapist</p> --}}
        </div>
      </div>
      <div class="h-6 w-px bg-white/10 hidden sm:block"></div>
      <div class="flex items-center gap-1.5 text-white/45 text-xs">
        <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
        {{ $blogPost->published_at?->format('F j, Y') ?? $blogPost->created_at->format('F j, Y') }}
      </div>
      @if($blogPost->published_at)
      <div class="flex items-center gap-1.5 text-white/45 text-xs">
        <i data-lucide="refresh-cw" class="w-3.5 h-3.5"></i>
        Updated {{ $blogPost->updated_at->diffForHumans() }}
      </div>
      @endif
    </div>
  </div>
</div>

<!-- ════════════════════════ CONTENT + SHARE ════════════════════════ -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 pt-10 pb-16">

  @if($blogPost->featured_image)
  <!-- Featured image — sits inside content area, above article -->
  <div class="max-w-3xl mx-auto mb-10 fadein-delay">
    <div class="rounded-2xl overflow-hidden shadow-xl ring-1 ring-black/8">
      <img src="{{ $blogPost->featured_image }}" alt="{{ $blogPost->title }}"
           class="w-full h-64 md:h-[420px] object-cover" />
    </div>
  </div>
  @endif
  <div class="flex gap-8 xl:gap-14 justify-center">

    <!-- ── Floating share sidebar (desktop) ── -->
    <aside class="hidden xl:flex flex-col items-center gap-3 self-start sticky top-24 flex-shrink-0 pt-2">
      <p class="text-xs text-gray-300 font-semibold uppercase tracking-[.2em] mb-1"
         style="writing-mode:vertical-rl;text-orientation:mixed;">Share</p>
      <div class="w-px h-8 bg-gray-200 my-1"></div>

      <!-- Facebook -->
      <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $blogPost)) }}"
         target="_blank" rel="noopener" class="share-btn tooltip" data-tip="Facebook"
         style="background:#1877F2;">
        <svg viewBox="0 0 24 24" fill="white"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
      </a>

      <!-- Twitter / X -->
      <a href="https://twitter.com/intent/tweet?text={{ urlencode($blogPost->title) }}&url={{ urlencode(route('blog.show', $blogPost)) }}"
         target="_blank" rel="noopener" class="share-btn tooltip" data-tip="Share on X"
         style="background:#000;">
        <svg viewBox="0 0 24 24" fill="white"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
      </a>

      <!-- WhatsApp -->
      <a href="https://api.whatsapp.com/send?text={{ urlencode($blogPost->title . ' – ' . route('blog.show', $blogPost)) }}"
         target="_blank" rel="noopener" class="share-btn tooltip" data-tip="WhatsApp"
         style="background:#25D366;">
        <svg viewBox="0 0 24 24" fill="white"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
      </a>

      <!-- LinkedIn -->
      <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('blog.show', $blogPost)) }}"
         target="_blank" rel="noopener" class="share-btn tooltip" data-tip="LinkedIn"
         style="background:#0A66C2;">
        <svg viewBox="0 0 24 24" fill="white"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
      </a>

      <div class="w-px h-8 bg-gray-200 my-1"></div>

      <!-- Copy Link -->
      <button onclick="copyLink()" id="copy-sidebar-btn"
              class="share-btn tooltip bg-gray-100 hover:bg-gray-200 transition-colors" data-tip="Copy link">
        <i data-lucide="link" class="w-4 h-4 text-gray-600"></i>
      </button>
    </aside>

    <!-- ── Main Article ── -->
    <div class="w-full max-w-3xl">

      <!-- Table of contents (auto-generated) -->
      <div id="toc-container" class="hidden bg-cream rounded-2xl border border-gold/15 p-5 mb-10">
        <p class="text-xs font-bold text-primary uppercase tracking-widest mb-3 flex items-center gap-2">
          <i data-lucide="list" class="w-4 h-4 text-gold"></i> In This Article
        </p>
        <ul id="toc-list" class="space-y-1.5 text-sm"></ul>
      </div>

      <!-- Article -->
      <article id="article-body" class="article-body">
        {!! $blogPost->content !!}
      </article>

      <!-- ── Inline share section ── -->
      <div class="mt-14 pt-8 border-t border-gray-100">
        <div class="bg-gradient-to-br from-primary to-primary-light rounded-2xl p-6 md:p-8">
          <p class="font-serif text-white text-lg font-bold mb-1">Found this helpful?</p>
          <p class="text-white/55 text-sm mb-6">Share it with someone who might need it.</p>
          <div class="flex flex-wrap gap-3">
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $blogPost)) }}"
               target="_blank" rel="noopener"
               class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-white text-sm font-semibold transition-all hover:scale-105"
               style="background:#1877F2;">
              <svg class="w-4 h-4" viewBox="0 0 24 24" fill="white"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
              Facebook
            </a>
            <a href="https://twitter.com/intent/tweet?text={{ urlencode($blogPost->title) }}&url={{ urlencode(route('blog.show', $blogPost)) }}"
               target="_blank" rel="noopener"
               class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-white text-sm font-semibold transition-all hover:scale-105 bg-black">
              <svg class="w-4 h-4" viewBox="0 0 24 24" fill="white"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
              Share on X
            </a>
            <a href="https://api.whatsapp.com/send?text={{ urlencode($blogPost->title . ' – ' . route('blog.show', $blogPost)) }}"
               target="_blank" rel="noopener"
               class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-white text-sm font-semibold transition-all hover:scale-105"
               style="background:#25D366;">
              <svg class="w-4 h-4" viewBox="0 0 24 24" fill="white"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
              WhatsApp
            </a>
            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('blog.show', $blogPost)) }}"
               target="_blank" rel="noopener"
               class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-white text-sm font-semibold transition-all hover:scale-105"
               style="background:#0A66C2;">
              <svg class="w-4 h-4" viewBox="0 0 24 24" fill="white"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
              LinkedIn
            </a>
            <button onclick="copyLink()"
                    id="copy-inline-btn"
                    class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white text-sm font-semibold transition-all hover:scale-105 border border-white/20">
              <i data-lucide="link-2" class="w-4 h-4"></i>
              <span id="copy-inline-text">Copy Link</span>
            </button>
          </div>
        </div>
      </div>

      <!-- ── Tags / Category ── -->
      <div class="mt-6 flex items-center gap-3 flex-wrap">
        <span class="text-xs text-gray-400 font-semibold uppercase tracking-wide">Filed under:</span>
        <a href="{{ route('blog', ['category' => $blogPost->category]) }}"
           class="text-xs bg-primary/8 text-primary px-3.5 py-1.5 rounded-full font-medium hover:bg-primary hover:text-white transition-colors">
          {{ $blogPost->category }}
        </a>
        <span class="flex items-center gap-1 text-gray-400 text-xs ml-auto">
          <i data-lucide="eye" class="w-3.5 h-3.5"></i>
          {{ number_format($blogPost->views) }} {{ Str::plural('view', $blogPost->views) }}
        </span>
      </div>

      <!-- ── Author Bio ── -->
      <div class="mt-10 rounded-2xl overflow-hidden border border-gray-100 shadow-sm">
        <div class="h-2 bg-gradient-to-r from-primary via-gold to-primary-light"></div>
        <div class="p-6 bg-white flex gap-5 items-start">
          <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-primary to-primary-light flex items-center justify-center flex-shrink-0 shadow-md">
            <i data-lucide="user" class="w-8 h-8 text-white/40"></i>
          </div>
          <div class="flex-1 min-w-0">
            <p class="font-serif font-bold text-primary text-lg leading-tight">Dr. Mrs. Anthonia Yemisi Soje</p>
            <p class="text-gold text-xs font-bold uppercase tracking-widest mt-0.5 mb-3">
              Medical Doctor · Psycho-Trauma Therapist · Author · Speaker
            </p>
            <p class="text-gray-500 text-sm leading-relaxed">
              Founder &amp; CEO of Fosterheirs Mental Health Consultancy. Board-certified psycho-trauma therapist working at the intersection of Christian faith and psychology. A published author, international speaker, and advocate for integrated mental health.
            </p>
            <a href="{{ route('home') }}#about"
               class="mt-3 inline-flex items-center gap-1.5 text-xs text-gold font-semibold hover:text-primary transition-colors">
              Learn more <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
            </a>
          </div>
        </div>
      </div>

    </div><!-- /main article column -->

    <!-- Right spacer to balance layout on xl -->
    <div class="hidden xl:block flex-shrink-0" style="min-width:52px;"></div>
  </div>
</div>

<!-- ════════════════════════ RELATED POSTS ════════════════════════ -->
@if($related->count() > 0)
<section class="bg-gray-50 py-16 border-t border-gray-100">
  <div class="max-w-6xl mx-auto px-6">
    <div class="flex items-end justify-between mb-10">
      <div>
        <p class="text-xs font-bold text-gold uppercase tracking-widest mb-2">Keep Reading</p>
        <h2 class="font-serif text-2xl font-bold text-primary">Related Articles</h2>
      </div>
      <a href="{{ route('blog', ['category' => $blogPost->category]) }}"
         class="text-sm text-gray-400 hover:text-primary transition-colors flex items-center gap-1.5 font-medium">
        All {{ $blogPost->category }} <i data-lucide="arrow-right" class="w-4 h-4"></i>
      </a>
    </div>
    <div class="grid md:grid-cols-3 gap-6">
      @foreach($related as $rp)
      <a href="{{ route('blog.show', $rp) }}"
         class="group bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
        <div class="h-44 overflow-hidden"
             style="background:linear-gradient(135deg,#0F2444,#1C3A5E);">
          @if($rp->featured_image)
          <img src="{{ $rp->featured_image }}" alt="{{ $rp->title }}"
               class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
          @else
          <div class="w-full h-full flex items-center justify-center">
            <i data-lucide="file-text" class="w-10 h-10 text-white/15"></i>
          </div>
          @endif
        </div>
        <div class="p-5">
          <span class="text-xs text-gold font-bold uppercase tracking-wide">{{ $rp->category }}</span>
          <h3 class="font-serif font-bold text-primary text-base mt-1.5 mb-2.5 group-hover:text-gold transition-colors leading-snug line-clamp-2">{{ $rp->title }}</h3>
          <p class="text-gray-400 text-xs leading-relaxed line-clamp-2 mb-3">{{ $rp->excerpt }}</p>
          <div class="flex items-center justify-between text-xs text-gray-300">
            <span class="flex items-center gap-1"><i data-lucide="clock" class="w-3 h-3"></i> {{ $rp->read_time }} min</span>
            <span class="flex items-center gap-1"><i data-lucide="eye" class="w-3 h-3"></i> {{ number_format($rp->views) }}</span>
          </div>
        </div>
      </a>
      @endforeach
    </div>
  </div>
</section>
@endif

<!-- ════════════════════════ CTA FOOTER ════════════════════════ -->
<section class="bg-primary py-20 relative overflow-hidden">
  <div class="absolute inset-0 opacity-[0.04]" style="background-image:radial-gradient(rgba(255,255,255,.8) 1px,transparent 1px);background-size:28px 28px;"></div>
  <div class="absolute top-0 right-0 w-96 h-96 rounded-full bg-gold/8 blur-3xl"></div>
  <div class="relative max-w-2xl mx-auto text-center px-6">
    <div class="w-14 h-14 rounded-2xl bg-gold/15 border border-gold/25 flex items-center justify-center mx-auto mb-6">
      <i data-lucide="heart" class="w-7 h-7 text-gold"></i>
    </div>
    <h2 class="font-serif text-3xl font-bold text-white mb-3">Ready to Begin Your Healing Journey?</h2>
    <p class="text-white/55 text-base mb-8 leading-relaxed">Dr. Soje and the Fosterheirs team are here to walk alongside you — with compassion, expertise, and faith-grounded care.</p>
    <div class="flex flex-wrap gap-4 justify-center">
      <a href="{{ route('home') }}#contact"
         class="inline-flex items-center gap-2 bg-gold hover:bg-gold-light text-white font-semibold px-7 py-3.5 rounded-xl transition-all hover:scale-105 shadow-lg shadow-gold/25 text-sm">
        <i data-lucide="mail" class="w-4 h-4"></i> Get in Touch
      </a>
      <a href="{{ route('blog') }}"
         class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/15 text-white font-semibold px-7 py-3.5 rounded-xl transition-colors border border-white/15 text-sm">
        <i data-lucide="book-open" class="w-4 h-4"></i> More Articles
      </a>
    </div>
  </div>
</section>

<!-- ════════════════════════ MOBILE SHARE BAR ════════════════════════ -->
<div class="xl:hidden fixed bottom-0 left-0 right-0 bg-white/95 backdrop-blur-md border-t border-gray-100 shadow-xl z-40 px-4 py-3">
  <div class="flex items-center justify-between max-w-lg mx-auto">
    <span class="text-xs text-gray-400 font-semibold">Share this article</span>
    <div class="flex gap-2">
      <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $blogPost)) }}"
         target="_blank" rel="noopener"
         class="w-9 h-9 rounded-xl flex items-center justify-center text-white text-xs font-semibold" style="background:#1877F2;">
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="white"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
      </a>
      <a href="https://api.whatsapp.com/send?text={{ urlencode($blogPost->title . ' – ' . route('blog.show', $blogPost)) }}"
         target="_blank" rel="noopener"
         class="w-9 h-9 rounded-xl flex items-center justify-center" style="background:#25D366;">
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="white"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
      </a>
      <a href="https://twitter.com/intent/tweet?text={{ urlencode($blogPost->title) }}&url={{ urlencode(route('blog.show', $blogPost)) }}"
         target="_blank" rel="noopener"
         class="w-9 h-9 rounded-xl bg-black flex items-center justify-center">
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="white"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
      </a>
      <button onclick="copyLink()"
              class="w-9 h-9 rounded-xl bg-gray-100 hover:bg-gray-200 flex items-center justify-center transition-colors">
        <i data-lucide="link" class="w-4 h-4 text-gray-600"></i>
      </button>
    </div>
  </div>
</div>

<!-- Bottom padding for mobile share bar -->
<div class="xl:hidden h-16"></div>

<script>
  lucide.createIcons();

  /* ── Reading progress bar ── */
  const bar = document.getElementById('reading-bar');
  const article = document.getElementById('article-body');
  window.addEventListener('scroll', () => {
    const articleTop = article.offsetTop;
    const articleBottom = articleTop + article.offsetHeight;
    const viewBottom = window.scrollY + window.innerHeight;
    const progress = Math.min(100, Math.max(0, (viewBottom - articleTop) / (articleBottom - articleTop) * 100));
    bar.style.width = progress + '%';
  }, { passive: true });

  /* ── Copy link ── */
  function copyLink() {
    const url = window.location.href;
    const fallback = () => {
      const ta = document.createElement('textarea');
      ta.value = url; ta.style.position = 'fixed'; ta.style.opacity = '0';
      document.body.appendChild(ta); ta.select();
      try { document.execCommand('copy'); } catch(e) {}
      document.body.removeChild(ta);
    };
    (navigator.clipboard ? navigator.clipboard.writeText(url) : Promise.reject())
      .catch(fallback)
      .finally(() => {
        /* sidebar btn */
        const sb = document.getElementById('copy-sidebar-btn');
        if (sb) { sb.style.background='#16a34a'; sb.querySelector('i')?.setAttribute('data-lucide','check'); lucide.createIcons(); setTimeout(()=>{sb.style.background='';sb.querySelector('i')?.setAttribute('data-lucide','link');lucide.createIcons();},2000); }
        /* inline btn */
        const inlineText = document.getElementById('copy-inline-text');
        const inlineBtn  = document.getElementById('copy-inline-btn');
        if (inlineText && inlineBtn) {
          const orig = inlineText.textContent;
          inlineText.textContent = 'Copied!';
          inlineBtn.style.background='rgba(22,163,74,.15)';
          inlineBtn.style.borderColor='rgba(22,163,74,.4)';
          setTimeout(()=>{ inlineText.textContent=orig; inlineBtn.style.background=''; inlineBtn.style.borderColor=''; },2000);
        }
        /* toast */
        showCopiedToast();
      });
  }

  function showCopiedToast() {
    const t = document.createElement('div');
    t.style.cssText = 'position:fixed;top:5rem;right:1.5rem;z-index:9999;background:#16a34a;color:white;font-size:.8rem;font-weight:600;padding:.6rem 1.1rem;border-radius:.75rem;display:flex;align-items:center;gap:.5rem;box-shadow:0 8px 24px rgba(0,0,0,.15);animation:fadein .3s ease';
    t.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg> Link copied to clipboard';
    document.body.appendChild(t);
    setTimeout(()=>{ t.style.opacity='0'; t.style.transition='opacity .3s'; setTimeout(()=>t.remove(),300); }, 2200);
  }

  /* ── Auto Table of Contents ── */
  document.addEventListener('DOMContentLoaded', () => {
    const headings = article.querySelectorAll('h2, h3');
    if (headings.length < 2) return;
    const toc = document.getElementById('toc-list');
    const tocContainer = document.getElementById('toc-container');
    headings.forEach((h, i) => {
      const id = 'heading-' + i;
      h.id = id;
      const li = document.createElement('li');
      const a = document.createElement('a');
      a.href = '#' + id;
      a.textContent = h.textContent;
      a.className = 'toc-link block text-sm text-gray-500 hover:text-primary transition-colors pl-3 border-l-2 border-transparent py-0.5'
        + (h.tagName === 'H3' ? ' ml-3 text-xs' : '');
      a.addEventListener('click', (e) => {
        e.preventDefault();
        document.getElementById(id)?.scrollIntoView({ behavior: 'smooth', block: 'start' });
        history.replaceState(null, '', '#' + id);
      });
      li.appendChild(a);
      toc.appendChild(li);
    });
    tocContainer.classList.remove('hidden');

    /* Highlight active heading on scroll */
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        const link = toc.querySelector(`a[href="#${entry.target.id}"]`);
        if (link) link.classList.toggle('active', entry.isIntersecting);
      });
    }, { rootMargin: '-10% 0px -80% 0px' });
    headings.forEach(h => observer.observe(h));
  });
</script>
</body>
</html>
