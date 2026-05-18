<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dr. Mrs. Anthonia Yemisi Soje | Mental Health &amp; Wellness</title>
  <meta name="description" content="Dr. Anthonia Yemisi Soje — Medical Practitioner, Psycho-trauma Therapist, Marriage Counsellor, ADHD Specialist &amp; Author. Founder of Fosterheirs Mental Health Consultancy, Oye-Ekiti." />
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
    .reveal{opacity:0;transform:translateY(28px);transition:opacity .7s ease,transform .7s ease;}
    .reveal.visible{opacity:1;transform:translateY(0);}
    .hero-dots{background-image:radial-gradient(circle,rgba(201,146,42,.22) 1px,transparent 1px);background-size:28px 28px;}
    .gold-rule::after{content:'';display:block;width:52px;height:3px;background:#C9922A;border-radius:2px;margin-top:10px;}
    #navbar{transition:background .3s ease,box-shadow .3s ease;}
    #navbar.scrolled{background:rgba(255,255,255,.97)!important;box-shadow:0 2px 20px rgba(0,0,0,.08);}
    #navbar.scrolled .nav-link{color:#0F2444!important;}
    #navbar.scrolled .nav-logo{color:#0F2444!important;}
    .svc-card{transition:transform .3s ease,box-shadow .3s ease;}
    .svc-card:hover{transform:translateY(-7px);box-shadow:0 18px 36px rgba(15,36,68,.11);}
    .book-card{transition:transform .3s ease,box-shadow .3s ease;}
    .book-card:hover{transform:translateY(-7px) scale(1.02);box-shadow:0 22px 44px rgba(0,0,0,.28);}
    .bg-b1{background:linear-gradient(135deg,#1C3A5E,#0A1F3C);}
    .bg-b2{background:linear-gradient(135deg,#1A5E3A,#0A3C22);}
    .bg-b3{background:linear-gradient(135deg,#4A1A6E,#2E0A4A);}
    .bg-b4{background:linear-gradient(135deg,#6E1A1A,#4A0A0A);}
    .bg-b5{background:linear-gradient(135deg,#1A3A6E,#0A1F4A);}
    .bg-b6{background:linear-gradient(135deg,#6E3A1A,#4A1F0A);}
    .bg-b7{background:linear-gradient(135deg,#1A6E3A,#0A4A22);}
    .bg-b8{background:linear-gradient(135deg,#4A1A5E,#2A0A3C);}
    .t-slider{overflow:hidden;}
    .t-track{display:flex;transition:transform .5s ease;}
    .t-slide{min-width:100%;}
    .star-gold{color:#C9922A;fill:#C9922A;}
    ::-webkit-scrollbar{width:6px;}
    ::-webkit-scrollbar-track{background:#FDF9F4;}
    ::-webkit-scrollbar-thumb{background:#C9922A;border-radius:3px;}
    @keyframes spin-slow{to{transform:rotate(360deg);}}
    .spin-slow{animation:spin-slow 22s linear infinite;}
    @keyframes spin-slow-rev{from{transform:rotate(0deg);}to{transform:rotate(-360deg);}}
    .spin-slow-reverse{animation:spin-slow-rev 30s linear infinite;}
    @keyframes heroFadeIn{from{opacity:0;transform:translateY(16px);}to{opacity:1;transform:translateY(0);}}
    @keyframes floatUpDown{0%,100%{transform:translateY(0);}50%{transform:translateY(-10px);}}
    @keyframes floatDownUp{0%,100%{transform:translateY(0);}50%{transform:translateY(10px);}}
    .float-card-1{animation:heroFadeIn .8s ease .5s both,floatUpDown 4s ease-in-out 1.3s infinite;}
    .float-card-2{animation:heroFadeIn .8s ease .9s both,floatDownUp 5s ease-in-out 1.7s infinite;}
    .float-card-3{animation:heroFadeIn .8s ease .7s both,floatDownUp 4.5s ease-in-out 1.5s infinite;}
    .float-card-4{animation:heroFadeIn .8s ease 1.1s both,floatUpDown 3.8s ease-in-out 1.9s infinite;}
    @keyframes goldShimmer{0%{background-position:0% 50%;}100%{background-position:200% 50%;}}
    .hero-name-gold{background:linear-gradient(90deg,#C9922A 0%,#D4A847 35%,#F0D898 50%,#D4A847 65%,#C9922A 100%);background-size:200% auto;-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;animation:goldShimmer 4s linear infinite;}
    @keyframes ticker{from{transform:translateX(0);}to{transform:translateX(-50%);}}
    .ticker-track{animation:ticker 38s linear infinite;width:max-content;}
    .ticker-track:hover{animation-play-state:paused;}
    .hero-bg{background:url('{{ asset('asset/DrAnthonia.png') }}') center 20% / cover no-repeat #0F2444;}
    @media(max-width:640px){.hero-bg{background-position:center top;}}
    @media(min-width:641px) and (max-width:1023px){.hero-bg{background-position:center 15%;}}
    .hero-overlay{background:linear-gradient(to bottom,rgba(8,21,38,.82) 0%,rgba(8,21,38,.18) 14%,rgba(8,21,38,.08) 45%,rgba(8,21,38,.68) 65%,rgba(8,21,38,.93) 80%,rgba(8,21,38,.97) 100%);}
    #mobile-menu{max-height:0;opacity:0;overflow:hidden;transition:max-height .35s ease,opacity .3s ease;}
    #mobile-menu.open{max-height:440px;opacity:1;}
    .hero-orb-1,.hero-orb-2{transition:transform .12s ease-out;will-change:transform;}
  </style>
</head>
<body class="bg-cream antialiased">

@if(session('contact_success'))
<div id="contact-toast" class="fixed top-6 right-6 z-[999] bg-green-600 text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-3 text-sm font-semibold">
  <i data-lucide="check-circle" class="w-5 h-5"></i> Message sent! We'll get back to you within 24 hours.
</div>
<script>setTimeout(()=>document.getElementById('contact-toast')?.remove(),5000);</script>
@endif

<!-- NAVBAR -->
<nav id="navbar" class="fixed top-0 left-0 right-0 z-50 px-6 py-4">
  <div class="max-w-7xl mx-auto flex items-center justify-between">
    <a href="#home" class="nav-logo font-serif text-white text-xl font-bold tracking-wide">Dr. A.Y. Soje</a>
    <div class="hidden md:flex items-center gap-7">
      <a href="#about"        class="nav-link text-white/80 hover:text-gold text-sm font-medium transition-colors">About</a>
      <a href="#services"     class="nav-link text-white/80 hover:text-gold text-sm font-medium transition-colors">Services</a>
      <a href="#books"        class="nav-link text-white/80 hover:text-gold text-sm font-medium transition-colors">Books</a>
      <a href="#organization" class="nav-link text-white/80 hover:text-gold text-sm font-medium transition-colors">Organization</a>
      <a href="#testimonials" class="nav-link text-white/80 hover:text-gold text-sm font-medium transition-colors">Testimonials</a>
      <a href="{{ route('blog') }}" class="nav-link text-white/80 hover:text-gold text-sm font-medium transition-colors">Blog</a>
    </div>
    <a href="#contact" class="hidden md:inline-flex items-center gap-2 bg-gold hover:bg-gold-light text-white text-sm font-semibold px-6 py-2.5 rounded-full transition-all shadow-lg shadow-gold/25">
      <i data-lucide="calendar" class="w-4 h-4"></i> Book a Session
    </a>
    <button id="ham" class="md:hidden text-white" onclick="toggleMenu()">
      <i data-lucide="menu" class="w-6 h-6" id="ham-icon"></i>
    </button>
  </div>
  <div id="mobile-menu">
    <div class="mt-3 bg-white rounded-2xl shadow-2xl p-6 space-y-4">
      <a href="#about"        class="block text-primary font-medium hover:text-gold transition-colors" onclick="toggleMenu()">About</a>
      <a href="#services"     class="block text-primary font-medium hover:text-gold transition-colors" onclick="toggleMenu()">Services</a>
      <a href="#books"        class="block text-primary font-medium hover:text-gold transition-colors" onclick="toggleMenu()">Books</a>
      <a href="#organization" class="block text-primary font-medium hover:text-gold transition-colors" onclick="toggleMenu()">Organization</a>
      <a href="#testimonials" class="block text-primary font-medium hover:text-gold transition-colors" onclick="toggleMenu()">Testimonials</a>
      <a href="{{ route('blog') }}" class="block text-primary font-medium hover:text-gold transition-colors">Blog</a>
      <a href="#contact" onclick="toggleMenu()" class="block bg-gold hover:bg-gold-light text-white font-semibold px-6 py-3 rounded-full text-center transition-colors">Book a Session</a>
    </div>
  </div>
</nav>

<!-- HERO -->
<section id="home" class="relative min-h-screen hero-bg flex flex-col overflow-hidden">
  <div class="hero-overlay absolute inset-0 pointer-events-none"></div>
  <div class="absolute inset-0 hero-dots pointer-events-none opacity-30"></div>
  <div class="hero-orb-1 absolute -top-20 -left-20 w-[560px] h-[560px] rounded-full pointer-events-none" style="background:radial-gradient(circle,rgba(201,146,42,.1),transparent 70%)"></div>
  <div class="hero-orb-2 absolute -bottom-20 -right-20 w-[460px] h-[460px] rounded-full pointer-events-none" style="background:radial-gradient(circle,rgba(46,125,99,.09),transparent 70%)"></div>
  <div class="absolute -top-10 -left-10 w-56 h-56 rounded-full border border-gold/10 spin-slow pointer-events-none"></div>
  <div class="absolute -top-4 -left-4 w-40 h-40 rounded-full border border-dashed border-gold/8 spin-slow-reverse pointer-events-none"></div>
  <div class="absolute -bottom-10 -right-10 w-64 h-64 rounded-full border border-white/5 spin-slow pointer-events-none"></div>
  <div class="float-card-1 absolute left-4 xl:left-12 top-[22%] hidden lg:flex items-center gap-3 bg-black/40 backdrop-blur-md border border-white/15 rounded-2xl px-4 py-3 shadow-2xl shadow-black/50 z-10">
    <div class="w-9 h-9 rounded-xl bg-blue-500/25 flex items-center justify-center flex-shrink-0"><i data-lucide="brain" class="w-4 h-4 text-blue-300"></i></div>
    <div><p class="text-xs font-bold text-white">Trauma Therapist</p><p class="text-xs text-white/40 mt-0.5">Board Certified</p></div>
  </div>
  <div class="float-card-2 absolute left-4 xl:left-12 top-[47%] hidden lg:flex items-center gap-3 bg-black/40 backdrop-blur-md border border-white/15 rounded-2xl px-4 py-3 shadow-2xl shadow-black/50 z-10">
    <div class="w-9 h-9 rounded-xl bg-gold/25 flex items-center justify-center flex-shrink-0"><i data-lucide="book-open" class="w-4 h-4 text-gold-light"></i></div>
    <div><p class="text-xs font-bold text-white">{{ $settings['stat_books'] ?? '8' }}+ Published Books</p><p class="text-xs text-white/40 mt-0.5">Author &amp; Researcher</p></div>
  </div>
  <div class="float-card-3 absolute right-4 xl:right-12 top-[25%] hidden lg:flex items-center gap-3 bg-black/40 backdrop-blur-md border border-white/15 rounded-2xl px-4 py-3 shadow-2xl shadow-black/50 z-10">
    <div class="w-9 h-9 rounded-xl bg-sage/30 flex items-center justify-center flex-shrink-0"><i data-lucide="heart" class="w-4 h-4 text-green-300"></i></div>
    <div><p class="text-xs font-bold text-white">Marriage Counsellor</p><p class="text-xs text-white/40 mt-0.5">{{ $settings['stat_marriages'] ?? '50' }}+ Marriages Restored</p></div>
  </div>
  <div class="float-card-4 absolute right-4 xl:right-12 top-[49%] hidden lg:flex items-center gap-3 bg-black/40 backdrop-blur-md border border-white/15 rounded-2xl px-4 py-3 shadow-2xl shadow-black/50 z-10">
    <div class="w-9 h-9 rounded-xl bg-purple-500/25 flex items-center justify-center flex-shrink-0"><i data-lucide="zap" class="w-4 h-4 text-purple-300"></i></div>
    <div><p class="text-xs font-bold text-white">ADHD Specialist</p><p class="text-xs text-white/40 mt-0.5">Child &amp; Adult Cases</p></div>
  </div>
  <div class="flex-1 min-h-[46vh] sm:min-h-[52vh] lg:min-h-[58vh] pt-20 pointer-events-none"></div>
  <div class="relative z-10 w-full text-center text-white px-5 sm:px-8 pb-20">
    <div class="absolute inset-0 bg-gradient-to-b from-transparent to-primary-dark/60 pointer-events-none -z-10"></div>
    <div class="max-w-4xl mx-auto">
      <div class="inline-flex items-center gap-2 border border-gold/35 bg-gold/10 text-white text-xs font-semibold px-5 py-2 rounded-full mb-7 tracking-widest uppercase">
        <i data-lucide="sparkles" class="w-3.5 h-3.5"></i> Physician &amp; Mental Health Specialist
      </div>
      <h1 class="font-serif text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold leading-tight mb-5">
        Dr. Mrs. Anthonia<br><span class="hero-name-gold">Yemisi Soje</span>
      </h1>
      <div class="flex items-center justify-center gap-4 mb-6">
        <div class="w-12 h-px bg-gold/35 flex-shrink-0"></div>
        <p class="text-gold/85 font-medium text-base md:text-lg" id="typing-role" style="min-height:28px">&nbsp;</p>
        <div class="w-12 h-px bg-gold/35 flex-shrink-0"></div>
      </div>
      <p class="text-white/65 text-base leading-relaxed mb-8 max-w-2xl mx-auto">
        Bridging medicine, psychology, and faith to restore lives. Founder of
        <span class="text-white/95 font-semibold">Fosterheirs Mental Health Consultancy</span>
        — healing hearts, rebuilding homes, restoring hope.
      </p>
      <div class="flex flex-wrap gap-4 justify-center mb-10">
        <a href="#contact" class="inline-flex items-center gap-2 bg-gold hover:bg-gold-light text-white font-semibold px-8 py-4 rounded-full transition-all duration-200 shadow-xl shadow-gold/30 hover:shadow-gold/50 hover:-translate-y-0.5 transform">
          <i data-lucide="calendar" class="w-5 h-5"></i> Book a Session
        </a>
        <a href="#about" class="inline-flex items-center gap-2 border border-white/25 hover:border-gold/60 hover:bg-white/5 text-white hover:text-gold font-semibold px-8 py-4 rounded-full transition-all duration-200">
          <i data-lucide="user" class="w-5 h-5"></i> About Dr. Soje
        </a>
      </div>
      <!-- Stats -->
      <div class="grid grid-cols-2 md:grid-cols-4 gap-px bg-white/10 rounded-2xl overflow-hidden border border-white/10 shadow-2xl shadow-black/40 backdrop-blur-sm">
        <div class="bg-primary-dark/70 backdrop-blur-md px-6 py-5">
          <p class="font-serif text-3xl font-bold text-gold" data-count="{{ $settings['stat_books'] ?? 8 }}" data-suffix="+">0</p>
          <p class="text-white/50 text-xs mt-1.5 uppercase tracking-wider leading-relaxed">Published<br>Books</p>
        </div>
        <div class="bg-primary-dark/70 backdrop-blur-md px-6 py-5">
          <p class="font-serif text-3xl font-bold text-gold" data-count="{{ $settings['stat_lives'] ?? 200 }}" data-suffix="+">0</p>
          <p class="text-white/50 text-xs mt-1.5 uppercase tracking-wider leading-relaxed">Lives<br>Transformed</p>
        </div>
        <div class="bg-primary-dark/70 backdrop-blur-md px-6 py-5">
          <p class="font-serif text-3xl font-bold text-gold" data-count="{{ $settings['stat_marriages'] ?? 50 }}" data-suffix="+">0</p>
          <p class="text-white/50 text-xs mt-1.5 uppercase tracking-wider leading-relaxed">Marriages<br>Restored</p>
        </div>
        <div class="bg-primary-dark/70 backdrop-blur-md px-6 py-5">
          <p class="font-serif text-3xl font-bold text-gold" data-count="{{ $settings['stat_addicts'] ?? 100 }}" data-suffix="+">0</p>
          <p class="text-white/50 text-xs mt-1.5 uppercase tracking-wider leading-relaxed">Addicts<br>Rehabilitated</p>
        </div>
      </div>
    </div>
  </div>
  <!-- Ticker -->
  <div class="absolute bottom-0 left-0 right-0 border-t border-white/10 bg-black/40 backdrop-blur-md py-3 overflow-hidden">
    <div class="ticker-track flex items-center gap-10">
      @foreach(['Medical Practitioner','Psycho-trauma Therapist','ADHD Specialist','Marriage Counsellor','Addiction Recovery Expert','Life Coach','Published Author','Faith-integrated Therapist'] as $cred)
        <span class="flex-shrink-0 flex items-center gap-2.5 text-white/30 text-xs font-medium uppercase tracking-widest"><i data-lucide="check-circle" class="w-3.5 h-3.5 text-gold/50"></i>{{ $cred }}</span>
        <span class="flex-shrink-0 text-gold/20 text-lg">·</span>
      @endforeach
      @foreach(['Medical Practitioner','Psycho-trauma Therapist','ADHD Specialist','Marriage Counsellor','Addiction Recovery Expert','Life Coach','Published Author','Faith-integrated Therapist'] as $cred)
        <span class="flex-shrink-0 flex items-center gap-2.5 text-white/30 text-xs font-medium uppercase tracking-widest"><i data-lucide="check-circle" class="w-3.5 h-3.5 text-gold/50"></i>{{ $cred }}</span>
        <span class="flex-shrink-0 text-gold/20 text-lg">·</span>
      @endforeach
    </div>
  </div>
</section>

<!-- ABOUT -->
<section id="about" class="py-28 bg-white">
  <div class="max-w-7xl mx-auto px-6">
    <div class="grid lg:grid-cols-2 gap-20 items-center">
      <div class="relative reveal">
        <div class="absolute top-6 left-6 right-0 bottom-0 rounded-3xl bg-cream border border-gold/20"></div>
        <div class="relative rounded-3xl overflow-hidden bg-primary-light" style="aspect-ratio:4/5">
          <div class="absolute inset-0 flex flex-col items-center justify-center text-white/20">
            <video autoplay muted loop playsinline class="w-full h-full object-cover">
              <source src="{{ asset('asset/drAnthonia_.mp4') }}" type="video/mp4">
            </video>
            <p class="text-sm mt-2">Dr. Anthonia Yemisi Soje</p>
          </div>
          <div class="absolute bottom-0 left-0 right-0 h-40 bg-gradient-to-t from-primary to-transparent"></div>
          <div class="absolute bottom-6 left-6 right-6">
            <p class="font-serif text-white text-lg font-semibold">Dr. Mrs. Anthonia Yemisi Soje</p>
            <p class="text-gold/80 text-sm mt-0.5">Physician &amp; Psycho-trauma Therapist · Author</p>
          </div>
        </div>
        <div class="absolute -bottom-5 -right-5 bg-gold rounded-2xl p-5 shadow-2xl shadow-gold/30 text-white text-center">
          <p class="font-serif text-3xl font-bold">5+</p>
          <p class="text-white/80 text-xs mt-0.5 leading-tight">Years of<br>Impact</p>
        </div>
      </div>
      <div class="reveal" style="transition-delay:.18s">
        <p class="text-gold font-semibold text-xs tracking-widest uppercase mb-4">About Dr. Soje</p>
        <h2 class="font-serif text-4xl lg:text-5xl font-bold text-primary leading-tight gold-rule">Healing Minds,<br>Restoring Lives</h2>
        <div class="flex items-center gap-3 mt-10 mb-6">
          <div class="flex items-center gap-2 bg-gold/10 border border-gold/25 text-gold text-xs font-semibold px-4 py-2 rounded-full tracking-wider uppercase">
            <i data-lucide="sparkles" class="w-3.5 h-3.5"></i> Faith meets Science
          </div>
          <div class="flex items-center gap-2 bg-primary/5 border border-primary/15 text-primary text-xs font-semibold px-4 py-2 rounded-full tracking-wider uppercase">
            <i data-lucide="mic" class="w-3.5 h-3.5"></i> Conference Speaker
          </div>
        </div>
        <p class="text-gray-500 leading-relaxed mb-5">{{ $settings['about_bio_1'] ?? '' }}</p>
        <p class="text-gray-500 leading-relaxed mb-8">{{ $settings['about_bio_2'] ?? '' }}</p>
        <div class="flex flex-wrap gap-2 mb-8">
          <span class="bg-cream border border-gold/20 text-primary text-xs font-medium px-3 py-1.5 rounded-full">Physician &amp; Psycho-trauma Therapist</span>
          <span class="bg-cream border border-gold/20 text-primary text-xs font-medium px-3 py-1.5 rounded-full">ADHD Specialist</span>
          <span class="bg-cream border border-gold/20 text-primary text-xs font-medium px-3 py-1.5 rounded-full">Marriage Counsellor</span>
          <span class="bg-cream border border-gold/20 text-primary text-xs font-medium px-3 py-1.5 rounded-full">Conference Speaker</span>
          <span class="bg-cream border border-gold/20 text-primary text-xs font-medium px-3 py-1.5 rounded-full">Faith Advocate</span>
          <span class="bg-cream border border-gold/20 text-primary text-xs font-medium px-3 py-1.5 rounded-full">Published Author</span>
        </div>
        <blockquote class="relative bg-cream rounded-2xl p-6 border-l-4 border-gold">
          <i data-lucide="quote" class="w-8 h-8 text-gold/20 absolute top-4 right-4"></i>
          <p class="font-serif italic text-primary text-lg leading-relaxed">"{{ $settings['about_quote'] ?? '' }}"</p>
          <footer class="mt-3 text-gold text-sm font-semibold">— Dr. Anthonia Yemisi Soje</footer>
        </blockquote>
      </div>
    </div>
  </div>
</section>

<!-- SERVICES -->
<section id="services" class="py-28 bg-cream">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-16 reveal">
      <p class="text-gold font-semibold text-xs tracking-widest uppercase mb-3">What I Offer</p>
      <h2 class="font-serif text-4xl lg:text-5xl font-bold text-primary">Services &amp; Speaking</h2>
      <div class="w-14 h-0.5 bg-gold mx-auto mt-3 mb-6"></div>
      <p class="text-gray-400 max-w-xl mx-auto text-sm leading-relaxed">From intimate therapy rooms to large conference halls — every service flows from one conviction: where faith meets science, whole people are formed.</p>
    </div>

    <!-- Featured speaking card (static) -->
    <div class="reveal mb-6">
      <div class="relative bg-primary rounded-3xl overflow-hidden border border-white/5">
        <div class="absolute inset-0 hero-dots opacity-25 pointer-events-none"></div>
        <div class="relative grid lg:grid-cols-2 items-stretch">
          <div class="p-10 lg:p-14">
            <div class="inline-flex items-center gap-2 bg-gold/20 border border-gold/30 text-gold text-xs font-bold px-4 py-1.5 rounded-full mb-7 tracking-widest uppercase">
              <i data-lucide="mic" class="w-3.5 h-3.5"></i> Speaking &amp; Events
            </div>
            <h3 class="font-serif text-3xl lg:text-4xl font-bold text-white leading-tight mb-5">Invite Dr. Soje to<br><span class="text-gold">Speak at Your Event</span></h3>
            <p class="text-white/55 leading-relaxed mb-8 max-w-md text-sm">Dr. Soje is available as a keynote speaker, panelist, or workshop facilitator for corporate organisations, churches, conferences, retreats, and seminars.</p>
            <div class="flex flex-wrap gap-2 mb-9">
              @foreach(['Mental Health','Faith & Wellness','Life Purpose','Addiction & Recovery','Marriage & Family','Emotional Resilience','Corporate Wellness'] as $topic)
                <span class="text-xs bg-white/10 border border-white/15 text-white/70 px-3 py-1.5 rounded-full">{{ $topic }}</span>
              @endforeach
            </div>
            <a href="#contact" class="inline-flex items-center gap-2 bg-gold hover:bg-gold-light text-white font-semibold px-8 py-4 rounded-full transition-all duration-200 shadow-xl shadow-gold/30 hover:-translate-y-0.5 transform">
              <i data-lucide="calendar" class="w-4 h-4"></i> Book Dr. Soje for Your Event
            </a>
          </div>
          <div class="border-t lg:border-t-0 lg:border-l border-white/8 p-10 lg:p-14 flex flex-col justify-center gap-4">
            <p class="text-gold text-xs font-bold tracking-widest uppercase mb-2">Ideal Venues &amp; Formats</p>
            @foreach([['building-2','Corporate Organisations','Workplace mental health, executive resilience &amp; employee wellness','blue'],['bookmark','Churches & Religious Organisations','Faith-mental health integration, pastoral care &amp; congregational wellbeing','gold'],['users','Seminars & Conferences','Keynotes, panel discussions &amp; interactive workshops','sage'],['graduation-cap','Academic & Community Events','Schools, universities, NGOs &amp; community outreach programmes','purple']] as [$icon,$title,$desc,$clr])
            <div class="flex items-start gap-4 bg-white/5 hover:bg-white/10 rounded-2xl p-4 transition-colors cursor-default group">
              <div class="w-10 h-10 rounded-xl bg-{{ $clr }}-500/15 flex items-center justify-center flex-shrink-0">
                <i data-lucide="{{ $icon }}" class="w-5 h-5 text-{{ $clr }}-300"></i>
              </div>
              <div><p class="text-white font-semibold text-sm mb-0.5">{{ $title }}</p><p class="text-white/40 text-xs leading-relaxed">{!! $desc !!}</p></div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>

    <!-- Divider -->
    <div class="flex items-center gap-5 mb-6 reveal">
      <div class="h-px flex-1 bg-gold/15"></div>
      <p class="text-gold font-bold text-xs tracking-widest uppercase flex items-center gap-2"><i data-lucide="stethoscope" class="w-3.5 h-3.5"></i> Clinical &amp; Therapy Services</p>
      <div class="h-px flex-1 bg-gold/15"></div>
    </div>

    <!-- Service cards from DB -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
      @php $colorMap = ['#C9922A'=>'gold','#3B82F6'=>'blue','#F59E0B'=>'amber','#2E7D63'=>'sage','#8B5CF6'=>'purple','#F97316'=>'orange','#EC4899'=>'pink','#14B8A6'=>'teal']; @endphp
      @foreach($services as $i => $svc)
        @php
          $color = $svc->color;
          $delay = ($i % 4) * 0.07;
          $isFirst = $svc->is_featured;
          $colSpan = $isFirst ? 'lg:col-span-2' : '';
        @endphp
        <div class="svc-card group bg-white rounded-2xl overflow-hidden shadow-sm cursor-default reveal border {{ $isFirst ? 'border-gold/15' : 'border-gray-100' }} {{ $colSpan }} relative" @if($delay) style="transition-delay:{{ $delay }}s" @endif>
          <div class="h-{{ $isFirst ? '2' : '1.5' }}" style="background:{{ $color }}"></div>
          <div class="p-7 {{ $isFirst ? 'flex flex-col md:flex-row gap-5 items-start' : '' }}">
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center {{ $isFirst ? 'flex-shrink-0' : 'mb-5' }} transition-colors duration-300" style="background:{{ $color }}20">
              <i data-lucide="{{ $svc->icon }}" class="w-6 h-6 transition-colors duration-300" style="color:{{ $color }}"></i>
            </div>
            <div>
              @if($isFirst)<div class="inline-flex items-center gap-1.5 text-xs font-bold px-3 py-1 rounded-full mb-3 uppercase tracking-wider" style="background:{{ $color }}20;color:{{ $color }}">Core Identity</div>@endif
              <h3 class="font-serif {{ $isFirst ? 'text-xl' : 'text-lg' }} font-{{ $isFirst ? 'bold' : 'semibold' }} text-primary mb-2">{{ $svc->title }}</h3>
              <p class="text-gray-400 text-sm leading-relaxed">{{ $svc->description }}</p>
              @if(!$isFirst)
              <a href="#contact" class="mt-5 inline-flex items-center gap-1.5 text-xs font-semibold opacity-0 group-hover:opacity-100 transition-opacity" style="color:{{ $color }}">
                <span>Book session</span><i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
              </a>
              @endif
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<!-- BOOKS -->
<section id="books" class="py-28 bg-primary overflow-hidden">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-16 reveal">
      <p class="text-gold font-semibold text-xs tracking-widest uppercase mb-3">Published Works</p>
      <h2 class="font-serif text-4xl lg:text-5xl font-bold text-white">Books &amp; Publications</h2>
      <div class="w-14 h-0.5 bg-gold mx-auto mt-3 mb-6"></div>
      <p class="text-white/50 max-w-xl mx-auto text-sm leading-relaxed">A growing library of works on mental health, relationships, addiction recovery, and faith-based healing — each one a lamp on the path to wholeness.</p>
    </div>
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
      @foreach($books as $i => $book)
        @php $delay = ($i % 4) * 0.07; @endphp
        <div class="book-card {{ $book->cover_gradient }} rounded-2xl p-6 border border-white/8 cursor-default reveal" @if($delay) style="transition-delay:{{ $delay }}s" @endif>
          <div class="w-11 h-11 bg-white/10 rounded-xl flex items-center justify-center mb-5"><i data-lucide="{{ $book->icon }}" class="w-5 h-5 text-white"></i></div>
          <span class="text-xs bg-white/10 text-white/55 px-2.5 py-1 rounded-full inline-block mb-4">{{ $book->category }}</span>
          <h3 class="font-serif text-lg font-bold text-white mb-2">{{ $book->title }}</h3>
          <p class="text-white/50 text-sm leading-relaxed">{{ $book->description }}</p>
          <div class="mt-5 pt-4 border-t border-white/8 flex items-center justify-between">
            <span class="text-gold text-xs font-medium">Dr. A.Y. Soje</span>
            @if($book->buy_link)
            <a href="{{ $book->buy_link }}" target="_blank" rel="noopener"
               class="inline-flex items-center gap-1.5 bg-gold hover:bg-gold-light text-white text-xs font-semibold px-3.5 py-1.5 rounded-full transition-all shadow-lg shadow-gold/30 hover:-translate-y-0.5 transform">
              <i data-lucide="shopping-bag" class="w-3 h-3"></i> Buy Now
            </a>
            @endif
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<!-- ORGANIZATION (static) -->
<section id="organization" class="py-28 bg-white">
  <div class="max-w-7xl mx-auto px-6">
    <div class="grid lg:grid-cols-2 gap-16 items-center">
      <div class="reveal">
        <p class="text-gold font-semibold text-xs tracking-widest uppercase mb-4">The Organization</p>
        <h2 class="font-serif text-4xl lg:text-5xl font-bold text-primary leading-tight gold-rule">Fosterheirs <br>Mental Health Therapists</h2>
        <p class="text-gray-500 leading-relaxed mt-10 mb-5">Founded in 2023 by Dr. Soje, Fosterheirs is a counseling and rehabilitation organization based in Oye-Ekiti, Nigeria. Nestled within the <strong class="text-primary font-semibold">Heirs Specialist Hospital Complex</strong>, it operates as a sanctuary for holistic healing — addressing addiction, trauma, marital crises, and emotional instability.</p>
        <p class="text-gray-500 leading-relaxed mb-8">The organization's mission is a fourfold healing approach: medical intervention, psychological therapy, social rehabilitation, and spiritual anchoring — because true recovery honors the whole person.</p>
        <div class="grid grid-cols-2 gap-4 mb-10">
          @foreach(['Drug & Alcohol Rehab|Comprehensive programs','Marriage Restoration|Rebuilding broken bonds','Trauma Recovery|Psycho-trauma therapy','Relapse Prevention|Ongoing support systems'] as $item)
            @php [$t,$s] = explode('|',$item); @endphp
            <div class="flex items-start gap-3">
              <div class="w-8 h-8 rounded-lg bg-gold/10 flex items-center justify-center flex-shrink-0"><i data-lucide="check" class="w-4 h-4 text-gold"></i></div>
              <div><p class="text-primary font-medium text-sm">{{ $t }}</p><p class="text-gray-400 text-xs mt-0.5">{{ $s }}</p></div>
            </div>
          @endforeach
        </div>
        <a href="#contact" class="inline-flex items-center gap-2 bg-primary hover:bg-primary-light text-white font-semibold px-8 py-4 rounded-full transition-colors">
          <i data-lucide="map-pin" class="w-4 h-4"></i> Visit Fosterheirs
        </a>
      </div>
      <div class="space-y-5 reveal" style="transition-delay:.18s">
        <div class="bg-primary rounded-3xl p-10 text-white relative overflow-hidden">
          <div class="relative">
            <p class="text-gold font-semibold text-xs tracking-widest uppercase mb-8">Impact Since 2023</p>
            <div class="grid grid-cols-3 gap-6 text-center">
              <div><p class="font-serif text-4xl font-bold">{{ $settings['stat_addicts'] ?? '100' }}+</p><p class="text-white/45 text-xs mt-2 leading-relaxed">Addicts<br>Rehabilitated</p></div>
              <div class="border-x border-white/10"><p class="font-serif text-4xl font-bold text-gold">{{ $settings['stat_marriages'] ?? '50' }}+</p><p class="text-white/45 text-xs mt-2 leading-relaxed">Marriages<br>Restored</p></div>
              <div><p class="font-serif text-4xl font-bold">{{ $settings['stat_lives'] ?? '200' }}+</p><p class="text-white/45 text-xs mt-2 leading-relaxed">Lives<br>Transformed</p></div>
            </div>
          </div>
        </div>
        <div class="bg-cream rounded-3xl p-6 border border-gold/20 flex items-start gap-4">
          <div class="w-12 h-12 rounded-xl bg-gold/10 flex items-center justify-center flex-shrink-0"><i data-lucide="building-2" class="w-6 h-6 text-gold"></i></div>
          <div>
            <p class="font-semibold text-primary mb-1">Location</p>
            <p class="text-gray-400 text-sm leading-relaxed">Heirs Specialist Hospital Complex,<br>Oye-Ekiti, Ekiti State, Nigeria</p>
            <a href="#contact" class="inline-flex items-center gap-1 text-gold text-sm font-medium mt-2 hover:gap-2 transition-all">Get Directions <i data-lucide="arrow-right" class="w-4 h-4"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- TESTIMONIALS -->
<section id="testimonials" class="py-16 bg-cream overflow-hidden">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-10 reveal">
      <p class="text-gold font-semibold text-xs tracking-widest uppercase mb-3">Testimonials</p>
      <h2 class="font-serif text-3xl lg:text-4xl font-bold text-primary">Stories of Transformation</h2>
      <div class="w-14 h-0.5 bg-gold mx-auto mt-3"></div>
    </div>
    @if($testimonials->count())
    @php $tAccents = ['#0F2444','#2E7D63','#C9922A','#7C3AED','#2563EB']; @endphp
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
      @foreach($testimonials as $ti => $t)
      <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 reveal" style="transition-delay:{{ ($ti % 3) * 0.07 }}s">
        <div class="flex items-center justify-between mb-3">
          <div class="flex gap-0.5">
            @for($s=1;$s<=5;$s++)<i data-lucide="star" class="w-3.5 h-3.5 {{ $s <= $t->rating ? 'star-gold' : 'text-gray-200' }}"></i>@endfor
          </div>
          <svg class="w-5 h-5 opacity-20" fill="#C9922A" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
        </div>
        <p class="font-serif italic text-gray-500 text-sm leading-relaxed mb-4">"{{ Str::limit($t->content, 200) }}"</p>
        <div class="flex items-center gap-2.5 pt-3 border-t border-gray-50">
          <div class="w-7 h-7 rounded-lg flex items-center justify-center flex-shrink-0" style="background:{{ $tAccents[$ti % count($tAccents)] }}18">
            <i data-lucide="user" class="w-3.5 h-3.5" style="color:{{ $tAccents[$ti % count($tAccents)] }}"></i>
          </div>
          <div>
            <p class="font-semibold text-primary text-xs leading-tight">{{ $t->name }}</p>
            <p class="text-gold text-xs">{{ $t->service }} Client</p>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    @endif
  </div>
</section>

<!-- CONTACT -->
<section id="contact" class="py-28 bg-white">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-16 reveal">
      <p class="text-gold font-semibold text-xs tracking-widest uppercase mb-3">Get in Touch</p>
      <h2 class="font-serif text-4xl lg:text-5xl font-bold text-primary">Begin Your Healing Journey</h2>
      <div class="w-14 h-0.5 bg-gold mx-auto mt-3 mb-6"></div>
      <p class="text-gray-400 max-w-xl mx-auto text-sm leading-relaxed">Take the first step toward wholeness. Reach out to schedule a consultation — we respond within 24 hours.</p>
    </div>
    <div class="grid lg:grid-cols-5 gap-10">
      <div class="lg:col-span-2 space-y-5 reveal">
        <div class="bg-primary rounded-2xl p-6 text-white">
          <div class="w-11 h-11 bg-white/10 rounded-xl flex items-center justify-center mb-4"><i data-lucide="map-pin" class="w-5 h-5 text-gold"></i></div>
          <p class="font-semibold mb-1">Office Address</p>
          <p class="text-white/55 text-sm leading-relaxed">Fosterheirs, Heirs Specialist Hospital Complex,<br>Oye-Ekiti, Ekiti State, Nigeria</p>
        </div>
        @if(!empty($settings['contact_phone']))
        <div class="bg-cream rounded-2xl p-6 border border-gold/20">
          <div class="w-11 h-11 bg-gold/10 rounded-xl flex items-center justify-center mb-4"><i data-lucide="phone" class="w-5 h-5 text-gold"></i></div>
          <p class="font-semibold text-primary mb-1">Phone</p>
          <p class="text-gray-400 text-sm">{{ $settings['contact_phone'] }}</p>
        </div>
        @endif
        @if(!empty($settings['contact_email']))
        <div class="bg-cream rounded-2xl p-6 border border-gold/20">
          <div class="w-11 h-11 bg-gold/10 rounded-xl flex items-center justify-center mb-4"><i data-lucide="mail" class="w-5 h-5 text-gold"></i></div>
          <p class="font-semibold text-primary mb-1">Email</p>
          <p class="text-gray-400 text-sm">{{ $settings['contact_email'] }}</p>
        </div>
        @endif
        <div class="bg-cream rounded-2xl p-6 border border-gold/20">
          <div class="w-11 h-11 bg-gold/10 rounded-xl flex items-center justify-center mb-4"><i data-lucide="clock" class="w-5 h-5 text-gold"></i></div>
          <p class="font-semibold text-primary mb-1">Working Hours</p>
          <p class="text-gray-400 text-sm">Mon – Fri: 8:00 AM – 6:00 PM<br>Saturday: 9:00 AM – 2:00 PM</p>
        </div>
        @php
          $hasSocial = !empty($settings['social_facebook']) || !empty($settings['social_instagram']) || !empty($settings['social_twitter']) || !empty($settings['social_linkedin']) || !empty($settings['social_youtube']) || !empty($settings['social_tiktok']);
        @endphp
        @if($hasSocial)
        <div class="bg-cream rounded-2xl px-5 py-4 border border-gold/20 flex items-center gap-4">
          <p class="text-primary font-semibold text-xs uppercase tracking-wide whitespace-nowrap">Follow Dr. Soje</p>
          <div class="flex flex-wrap gap-2">
            @if(!empty($settings['social_facebook']))
            <a href="{{ $settings['social_facebook'] }}" target="_blank" rel="noopener" title="Facebook" class="w-9 h-9 rounded-xl bg-primary/5 hover:bg-[#1877F2] hover:text-white text-primary flex items-center justify-center transition-all" aria-label="Facebook">
              <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
            </a>
            @endif
            @if(!empty($settings['social_instagram']))
            <a href="{{ $settings['social_instagram'] }}" target="_blank" rel="noopener" title="Instagram" class="w-9 h-9 rounded-xl bg-primary/5 hover:bg-gradient-to-br hover:from-[#833ab4] hover:to-[#fd1d1d] hover:text-white text-primary flex items-center justify-center transition-all" aria-label="Instagram">
              <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
            </a>
            @endif
            @if(!empty($settings['social_twitter']))
            <a href="{{ $settings['social_twitter'] }}" target="_blank" rel="noopener" title="X / Twitter" class="w-9 h-9 rounded-xl bg-primary/5 hover:bg-black hover:text-white text-primary flex items-center justify-center transition-all" aria-label="X / Twitter">
              <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.748l7.73-8.835L1.254 2.25H8.08l4.259 5.63 5.905-5.63zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
            </a>
            @endif
            @if(!empty($settings['social_linkedin']))
            <a href="{{ $settings['social_linkedin'] }}" target="_blank" rel="noopener" title="LinkedIn" class="w-9 h-9 rounded-xl bg-primary/5 hover:bg-[#0A66C2] hover:text-white text-primary flex items-center justify-center transition-all" aria-label="LinkedIn">
              <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
            </a>
            @endif
            @if(!empty($settings['social_youtube']))
            <a href="{{ $settings['social_youtube'] }}" target="_blank" rel="noopener" title="YouTube" class="w-9 h-9 rounded-xl bg-primary/5 hover:bg-[#FF0000] hover:text-white text-primary flex items-center justify-center transition-all" aria-label="YouTube">
              <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
            </a>
            @endif
            @if(!empty($settings['social_tiktok']))
            <a href="{{ $settings['social_tiktok'] }}" target="_blank" rel="noopener" title="TikTok" class="w-9 h-9 rounded-xl bg-primary/5 hover:bg-black hover:text-white text-primary flex items-center justify-center transition-all" aria-label="TikTok">
              <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.95a8.16 8.16 0 004.77 1.52V7.02a4.85 4.85 0 01-1-.33z"/></svg>
            </a>
            @endif
          </div>
        </div>
        @endif
      </div>
      <div class="lg:col-span-3 reveal" style="transition-delay:.18s">
        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 md:p-10">
          <h3 class="font-serif text-2xl font-bold text-primary mb-1">Send a Message</h3>
          <p class="text-gray-400 text-sm mb-8">We'll get back to you within 24 hours.</p>
          <form method="POST" action="{{ route('contact') }}" class="space-y-5">
            @csrf
            <div>
              <label class="block text-xs font-semibold text-primary mb-2 uppercase tracking-wide">Full Name</label>
              <input type="text" name="name" value="{{ old('name') }}" placeholder="Your full name" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gold focus:ring-2 focus:ring-yellow-100 transition-all placeholder-gray-300" />
            </div>
            <div class="grid sm:grid-cols-2 gap-5">
              <div>
                <label class="block text-xs font-semibold text-primary mb-2 uppercase tracking-wide">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="your@email.com" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gold focus:ring-2 focus:ring-yellow-100 transition-all placeholder-gray-300" />
              </div>
              <div>
                <label class="block text-xs font-semibold text-primary mb-2 uppercase tracking-wide">WhatsApp Number</label>
                <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="+234 800 000 0000" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gold focus:ring-2 focus:ring-yellow-100 transition-all placeholder-gray-300" />
              </div>
            </div>
            <div>
              <label class="block text-xs font-semibold text-primary mb-2 uppercase tracking-wide">Preferred Way to Receive Feedback</label>
              <select name="preferred_feedback" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-500 bg-white focus:outline-none focus:border-gold transition-all">
                <option value="">Select preference...</option>
                <option value="WhatsApp text" {{ old('preferred_feedback')=='WhatsApp text'?'selected':'' }}>WhatsApp text message</option>
                <option value="Email reply" {{ old('preferred_feedback')=='Email reply'?'selected':'' }}>Email reply</option>
                <option value="Phone call" {{ old('preferred_feedback')=='Phone call'?'selected':'' }}>Phone call</option>
                <option value="WhatsApp call" {{ old('preferred_feedback')=='WhatsApp call'?'selected':'' }}>WhatsApp voice call</option>
                <option value="Any" {{ old('preferred_feedback')=='Any'?'selected':'' }}>Any — I'm flexible</option>
              </select>
            </div>
            <div>
              <label class="block text-xs font-semibold text-primary mb-2 uppercase tracking-wide">How Can We Help?</label>
              <select name="service" id="serviceSelect" onchange="toggleEventNote()" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-500 bg-white focus:outline-none focus:border-gold transition-all">
                <option value="">Select a service or inquiry...</option>
                <optgroup label="── Speaking & Events ──">
                  <option value="event" {{ old('service')=='event'?'selected':'' }}>Corporate Speaking / Organisation Event</option>
                  <option value="event" {{ old('service')=='event'?'selected':'' }}>Church / Religious Organisation Event</option>
                  <option value="event" {{ old('service')=='event'?'selected':'' }}>Conference or Seminar (Keynote / Panel)</option>
                </optgroup>
                <optgroup label="── Therapy & Counselling ──">
                  @foreach(['Psycho-trauma Therapy','Addiction Recovery','Marriage Counselling','Premarital Counselling','ADHD Management','Life Coaching','Emotional Wellness','Faith-integrated Therapy'] as $svcOpt)
                  <option value="{{ $svcOpt }}" {{ old('service')==$svcOpt?'selected':'' }}>{{ $svcOpt }}</option>
                  @endforeach
                </optgroup>
                <optgroup label="── Other ──">
                  <option value="Book / Publication Inquiry">Book / Publication Inquiry</option>
                  <option value="General Inquiry">General Inquiry</option>
                </optgroup>
              </select>
            </div>
            <div id="eventNote" class="hidden bg-primary/5 border border-primary/15 rounded-xl px-5 py-4 flex items-start gap-3">
              <i data-lucide="mic" class="w-4 h-4 text-primary flex-shrink-0 mt-0.5"></i>
              <p class="text-primary text-xs leading-relaxed"><strong>Event Booking:</strong> Please include the event name, date, venue, expected audience size, and preferred topic(s) in your message below.</p>
            </div>
            <div>
              <label class="block text-xs font-semibold text-primary mb-2 uppercase tracking-wide">Message</label>
              <textarea name="message" rows="5" placeholder="Tell us about yourself and how we can help..." required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gold focus:ring-2 focus:ring-yellow-100 transition-all placeholder-gray-300 resize-none">{{ old('message') }}</textarea>
            </div>
            <button type="submit" class="w-full bg-primary hover:bg-primary-light text-white font-semibold py-4 rounded-xl transition-colors flex items-center justify-center gap-2">
              <i data-lucide="send" class="w-5 h-5"></i> Send Message
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FOOTER -->
<footer class="bg-primary-dark text-white py-16">
  <div class="max-w-7xl mx-auto px-6">
    <div class="grid md:grid-cols-4 gap-10 mb-12">
      <div class="md:col-span-2">
        <p class="font-serif text-2xl font-bold mb-1">Dr. A.Y. Soje</p>
        <p class="text-gold text-sm mb-4">Mental Health Professional &amp; Author</p>
        <p class="text-white/40 text-sm leading-relaxed max-w-xs">Bridging medicine, psychology, and faith to restore lives and rebuild homes across Nigeria and beyond.</p>
        <div class="flex flex-wrap gap-2 mt-6">
          @if(!empty($settings['social_facebook']))<a href="{{ $settings['social_facebook'] }}" target="_blank" rel="noopener" title="Facebook" class="w-9 h-9 rounded-xl bg-white/8 hover:bg-[#1877F2] flex items-center justify-center transition-colors text-white"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></a>@endif
          @if(!empty($settings['social_instagram']))<a href="{{ $settings['social_instagram'] }}" target="_blank" rel="noopener" title="Instagram" class="w-9 h-9 rounded-xl bg-white/8 hover:bg-gradient-to-br hover:from-[#833ab4] hover:to-[#fd1d1d] flex items-center justify-center transition-all text-white"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></a>@endif
          @if(!empty($settings['social_twitter']))<a href="{{ $settings['social_twitter'] }}" target="_blank" rel="noopener" title="X / Twitter" class="w-9 h-9 rounded-xl bg-white/8 hover:bg-black flex items-center justify-center transition-colors text-white"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.748l7.73-8.835L1.254 2.25H8.08l4.259 5.63 5.905-5.63zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg></a>@endif
          @if(!empty($settings['social_linkedin']))<a href="{{ $settings['social_linkedin'] }}" target="_blank" rel="noopener" title="LinkedIn" class="w-9 h-9 rounded-xl bg-white/8 hover:bg-[#0A66C2] flex items-center justify-center transition-colors text-white"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg></a>@endif
          @if(!empty($settings['social_youtube']))<a href="{{ $settings['social_youtube'] }}" target="_blank" rel="noopener" title="YouTube" class="w-9 h-9 rounded-xl bg-white/8 hover:bg-[#FF0000] flex items-center justify-center transition-colors text-white"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg></a>@endif
          @if(!empty($settings['social_tiktok']))<a href="{{ $settings['social_tiktok'] }}" target="_blank" rel="noopener" title="TikTok" class="w-9 h-9 rounded-xl bg-white/8 hover:bg-black flex items-center justify-center transition-colors text-white"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.95a8.16 8.16 0 004.77 1.52V7.02a4.85 4.85 0 01-1-.33z"/></svg></a>@endif
          @if(empty($settings['social_facebook']) && empty($settings['social_instagram']) && empty($settings['social_twitter']) && empty($settings['social_linkedin']) && empty($settings['social_youtube']) && empty($settings['social_tiktok']))
            @foreach(['facebook','instagram','twitter','linkedin','youtube'] as $sn)
            <a href="#" class="w-9 h-9 rounded-xl bg-white/8 hover:bg-gold flex items-center justify-center transition-colors"><i data-lucide="{{ $sn }}" class="w-4 h-4"></i></a>
            @endforeach
          @endif
        </div>
      </div>
      <div>
        <p class="font-semibold text-white text-xs uppercase tracking-widest mb-5">Quick Links</p>
        <ul class="space-y-3">
          <li><a href="#about"        class="text-white/40 hover:text-gold text-sm transition-colors">About</a></li>
          <li><a href="#services"     class="text-white/40 hover:text-gold text-sm transition-colors">Services</a></li>
          <li><a href="#books"        class="text-white/40 hover:text-gold text-sm transition-colors">Books</a></li>
          <li><a href="#organization" class="text-white/40 hover:text-gold text-sm transition-colors">Fosterheirs</a></li>
          <li><a href="{{ route('blog') }}" class="text-white/40 hover:text-gold text-sm transition-colors">Blog</a></li>
          <li><a href="#contact"      class="text-white/40 hover:text-gold text-sm transition-colors">Contact</a></li>
        </ul>
      </div>
      <div>
        <p class="font-semibold text-white text-xs uppercase tracking-widest mb-5">Services</p>
        <ul class="space-y-3">
          <li><a href="#services" class="text-white/40 hover:text-gold text-sm transition-colors">Speaking &amp; Events</a></li>
          <li><a href="#services" class="text-white/40 hover:text-gold text-sm transition-colors">Trauma Therapy</a></li>
          <li><a href="#services" class="text-white/40 hover:text-gold text-sm transition-colors">Addiction Recovery</a></li>
          <li><a href="#services" class="text-white/40 hover:text-gold text-sm transition-colors">Marriage Counselling</a></li>
          <li><a href="#services" class="text-white/40 hover:text-gold text-sm transition-colors">ADHD Specialist</a></li>
          <li><a href="#contact"  class="text-white/40 hover:text-gold text-sm transition-colors">Book a Session</a></li>
        </ul>
      </div>
    </div>
    <div class="pt-8 border-t border-white/8 flex flex-col md:flex-row items-center justify-between gap-3">
      <p class="text-white/30 text-sm">© {{ date('Y') }} Dr. Mrs. Anthonia Yemisi Soje. All rights reserved.</p>
      <p class="text-white/30 text-sm">Fosterheirs Mental Health Therapists · Oye-Ekiti, Nigeria</p>
    </div>
  </div>
</footer>

<script>
  lucide.createIcons();
  window.addEventListener('scroll', () => document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 55));

  function countUp(el) {
    const target = parseInt(el.dataset.count), suffix = el.dataset.suffix||'', steps=60, delay=1600/steps;
    let step=0;
    const t=setInterval(()=>{ step++; el.textContent=Math.round(target*(step/steps))+suffix; if(step>=steps)clearInterval(t); },delay);
  }
  const countObs=new IntersectionObserver(entries=>{ entries.forEach(e=>{if(e.isIntersecting){countUp(e.target);countObs.unobserve(e.target);}}) },{threshold:0.6});
  document.querySelectorAll('[data-count]').forEach(el=>countObs.observe(el));

  document.getElementById('home').addEventListener('mousemove',e=>{
    const r=document.getElementById('home').getBoundingClientRect(),x=(e.clientX-r.left)/r.width-.5,y=(e.clientY-r.top)/r.height-.5;
    document.querySelector('.hero-orb-1').style.transform=`translate(${x*28}px,${y*28}px)`;
    document.querySelector('.hero-orb-2').style.transform=`translate(${-x*22}px,${-y*22}px)`;
  });

  function toggleMenu(){const m=document.getElementById('mobile-menu'),open=m.classList.toggle('open');document.getElementById('ham-icon').setAttribute('data-lucide',open?'x':'menu');lucide.createIcons();}

  const io=new IntersectionObserver(entries=>entries.forEach(e=>{if(e.isIntersecting)e.target.classList.add('visible');}),{threshold:0.1});
  document.querySelectorAll('.reveal').forEach(el=>io.observe(el));

  const roles=['Psycho-trauma Therapist','Christian Mental Health Advocate','Conference Speaker & Author','Addiction Recovery Expert','Faith & Wellness Voice','Marriage Counsellor','ADHD Specialist','Life Coach'];
  let ri=0,ci=0,del=false;const typEl=document.getElementById('typing-role');
  (function type(){const cur=roles[ri];typEl.textContent=del?cur.slice(0,--ci):cur.slice(0,++ci);if(!del&&ci===cur.length)setTimeout(()=>del=true,2400);else if(del&&ci===0){del=false;ri=(ri+1)%roles.length;}setTimeout(type,del?45:90);})();


  function toggleEventNote(){const sel=document.getElementById('serviceSelect'),note=document.getElementById('eventNote'),isEvent=sel.value==='event';note.classList.toggle('hidden',!isEvent);if(isEvent)lucide.createIcons();}
</script>
</body>
</html>
