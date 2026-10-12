<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="{{ asset('favicon.ico') }}" />
  <title>Books &amp; Publications | {{ $settings['doctor_name'] ?? 'Dr. O.A. Soje' }}</title>
  <meta name="description" content="Browse and purchase books by {{ $settings['doctor_name'] ?? 'Dr. O.A. Soje' }} — on mental health, relationships, addiction recovery, and faith-based healing." />
  <link rel="canonical" href="{{ url('/books') }}" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="{{ url('/books') }}" />
  <meta property="og:title" content="Books &amp; Publications | {{ $settings['doctor_name'] ?? 'Dr. O.A. Soje' }}" />
  <meta property="og:description" content="Browse and purchase books by {{ $settings['doctor_name'] ?? 'Dr. O.A. Soje' }}." />
  <meta property="og:site_name" content="{{ $settings['doctor_name'] ?? 'Dr. O.A. Soje' }}" />
  <meta name="twitter:card" content="summary" />
  <meta name="twitter:title" content="Books &amp; Publications | {{ $settings['doctor_name'] ?? 'Dr. O.A. Soje' }}" />
  <meta name="twitter:description" content="Browse and purchase books by {{ $settings['doctor_name'] ?? 'Dr. O.A. Soje' }}." />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet" />
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
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
    #mobile-menu.open{max-height:380px;opacity:1;}
    .book-card{transition:transform .3s ease,box-shadow .3s ease;}
    .book-card:hover{transform:translateY(-6px);box-shadow:0 24px 48px rgba(15,36,68,.14);}
    @keyframes fadeUp{from{opacity:0;transform:translateY(24px);}to{opacity:1;transform:translateY(0);}}
    .fade-in{animation:fadeUp .55s ease both;}
    #order-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:100;align-items:center;justify-content:center;}
    #order-overlay.open{display:flex;}
    #success-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:110;align-items:center;justify-content:center;}
    #success-overlay.open{display:flex;}
  </style>
</head>
<body class="bg-cream antialiased">

<!-- NAVBAR -->
<nav id="navbar" class="fixed top-0 left-0 right-0 z-50 bg-primary px-6 py-4">
  <div class="max-w-7xl mx-auto flex items-center justify-between">
    <a href="{{ route('home') }}" class="nav-logo font-serif text-white text-xl font-bold tracking-wide">{{ $settings['doctor_name'] ?? 'Dr. O.A. Soje' }}</a>
    <div class="hidden md:flex items-center gap-7">
      <a href="{{ route('home') }}#about"     class="nav-link text-white/70 hover:text-gold text-sm font-medium transition-colors">About</a>
      <a href="{{ route('home') }}#services"  class="nav-link text-white/70 hover:text-gold text-sm font-medium transition-colors">Services</a>
      <a href="{{ route('books.index') }}"    class="nav-link text-gold text-sm font-semibold transition-colors">Books</a>
      <a href="{{ route('courses.index') }}"  class="nav-link text-white/70 hover:text-gold text-sm font-medium transition-colors">Courses</a>
      <a href="{{ route('blog') }}"           class="nav-link text-white/70 hover:text-gold text-sm font-medium transition-colors">Blog</a>
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
      <a href="{{ route('home') }}#about"     class="block text-primary font-medium hover:text-gold transition-colors">About</a>
      <a href="{{ route('home') }}#services"  class="block text-primary font-medium hover:text-gold transition-colors">Services</a>
      <a href="{{ route('books.index') }}"    class="block text-gold font-semibold hover:text-primary transition-colors">Books</a>
      <a href="{{ route('courses.index') }}"  class="block text-primary font-medium hover:text-gold transition-colors">Courses</a>
      <a href="{{ route('blog') }}"           class="block text-primary font-medium hover:text-gold transition-colors">Blog</a>
      <a href="{{ route('home') }}#contact"   class="block bg-gold hover:bg-gold-light text-white font-semibold px-6 py-3 rounded-full text-center transition-colors">Book a Session</a>
    </div>
  </div>
</nav>

<!-- HERO -->
<div class="bg-primary pt-28 pb-16 px-6">
  <div class="max-w-7xl mx-auto text-center">
    <p class="text-gold font-semibold text-xs tracking-widest uppercase mb-4">Published Works</p>
    <h1 class="font-serif text-4xl lg:text-5xl font-bold text-white leading-tight mb-4">Books &amp; Publications</h1>
    <div class="w-14 h-0.5 bg-gold mx-auto mb-5"></div>
    <p class="text-white/50 text-sm leading-relaxed max-w-xl mx-auto">
      A growing library of works on mental health, relationships, addiction recovery, and faith-based healing —
      each one a lamp on the path to wholeness.
    </p>
  </div>
</div>

<!-- BOOKS GRID -->
<main class="py-20 px-6">
  <div class="max-w-7xl mx-auto">

    @if($books->isEmpty())
    <div class="text-center py-24">
      <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
        <i data-lucide="book-open" class="w-7 h-7 text-gray-300"></i>
      </div>
      <p class="text-gray-400 font-medium">No books available yet. Check back soon.</p>
    </div>
    @else
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
      @foreach($books as $i => $book)
      <div class="book-card bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm flex flex-col fade-in" style="animation-delay:{{ $i * 0.07 }}s">
        {{-- Cover --}}
        @if($book->cover_image)
        <div class="h-64 overflow-hidden bg-gray-50">
          <img src="{{ $book->cover_image }}" alt="{{ $book->title }}" class="w-full h-full object-cover" />
        </div>
        @else
        <div class="{{ $book->cover_gradient }} h-48 flex items-center justify-center">
          <i data-lucide="{{ $book->icon }}" class="w-10 h-10 text-white/30"></i>
        </div>
        @endif

        {{-- Details --}}
        <div class="p-5 flex flex-col flex-1">
          <span class="text-xs bg-blue-50 text-blue-700 px-2.5 py-1 rounded-full inline-block mb-3 self-start font-medium">{{ $book->category }}</span>
          <h3 class="font-serif text-lg font-bold text-gray-900 mb-2 leading-snug">{{ $book->title }}</h3>
          <p class="text-gray-500 text-sm leading-relaxed flex-1">{{ $book->description }}</p>

          <div class="mt-5 pt-4 border-t border-gray-100">
            <div class="flex items-center justify-between gap-3">
              <div>
                @if($book->price)
                <p class="text-xs text-gray-400 uppercase tracking-wide font-semibold">Price</p>
                <p class="text-gold font-bold text-lg">₦{{ number_format($book->price, 0) }}</p>
                @else
                <p class="text-gray-400 text-sm italic">Price TBA</p>
                @endif
              </div>
              <div class="flex flex-col gap-1.5">
                @if($book->is_digital)
                <span class="text-xs bg-emerald-50 text-emerald-600 px-2 py-0.5 rounded-full font-medium text-center">Digital</span>
                @else
                <span class="text-xs bg-amber-50 text-amber-700 px-2 py-0.5 rounded-full font-medium text-center">Physical</span>
                @endif
              </div>
            </div>
            <button
              class="mt-3 w-full inline-flex items-center justify-center gap-2 bg-primary hover:bg-primary-light text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition-all"
              onclick="openOrderModal(this)"
              data-book-id="{{ $book->id }}"
              data-book-title="{{ e($book->title) }}"
              data-book-price="{{ $book->price ?? '' }}"
              data-book-digital="{{ $book->is_digital ? '1' : '0' }}"
            >
              <i data-lucide="shopping-bag" class="w-4 h-4"></i>
              Order This Book
            </button>
            @if($book->is_digital && $book->file_path)
            <a href="{{ route('books.reader.show', $book) }}" class="mt-1.5 w-full inline-flex items-center justify-center gap-2 border border-primary text-primary hover:bg-primary/5 text-sm font-semibold px-4 py-2.5 rounded-xl transition-all">
              <i data-lucide="book-open" class="w-4 h-4"></i>
              Read My Book
            </a>
            @endif
          </div>
        </div>
      </div>
      @endforeach
    </div>
    @endif

    {{-- Pagination --}}
    @if($books->hasPages())
    <div class="mt-12 flex items-center justify-center gap-1">
      {{-- Previous --}}
      @if($books->onFirstPage())
      <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl border border-gray-200 text-gray-300 cursor-not-allowed text-sm">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
      </span>
      @else
      <a href="{{ $books->previousPageUrl() }}" class="inline-flex items-center justify-center w-10 h-10 rounded-xl border border-gray-200 hover:border-primary text-gray-500 hover:text-primary transition-colors text-sm">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
      </a>
      @endif

      {{-- Page numbers --}}
      @foreach($books->getUrlRange(max(1, $books->currentPage() - 2), min($books->lastPage(), $books->currentPage() + 2)) as $page => $url)
        @if($page == $books->currentPage())
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-primary text-white font-semibold text-sm">{{ $page }}</span>
        @else
        <a href="{{ $url }}" class="inline-flex items-center justify-center w-10 h-10 rounded-xl border border-gray-200 hover:border-primary text-gray-600 hover:text-primary transition-colors text-sm font-medium">{{ $page }}</a>
        @endif
      @endforeach

      {{-- Next --}}
      @if($books->hasMorePages())
      <a href="{{ $books->nextPageUrl() }}" class="inline-flex items-center justify-center w-10 h-10 rounded-xl border border-gray-200 hover:border-primary text-gray-500 hover:text-primary transition-colors text-sm">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
      </a>
      @else
      <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl border border-gray-200 text-gray-300 cursor-not-allowed text-sm">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
      </span>
      @endif
    </div>
    <p class="text-center text-gray-400 text-xs mt-4">Showing {{ $books->firstItem() }}–{{ $books->lastItem() }} of {{ $books->total() }} books</p>
    @endif

  </div>
</main>

<!-- FOOTER -->
<footer class="bg-primary py-10 px-6 mt-8">
  <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4">
    <span class="font-serif text-white text-lg font-bold">{{ $settings['doctor_name'] ?? 'Dr. O.A. Soje' }}</span>
    <p class="text-white/30 text-xs text-center">&copy; {{ date('Y') }} {{ $settings['doctor_name'] ?? 'Dr. O.A. Soje' }}. All rights reserved.</p>
    <div class="flex items-center gap-4">
      <a href="{{ route('home') }}" class="text-white/50 hover:text-gold text-xs transition-colors">Home</a>
      <a href="{{ route('books.index') }}" class="text-gold text-xs font-semibold">Books</a>
      <a href="{{ route('courses.index') }}" class="text-white/50 hover:text-gold text-xs transition-colors">Courses</a>
      <a href="{{ route('blog') }}" class="text-white/50 hover:text-gold text-xs transition-colors">Blog</a>
    </div>
  </div>
</footer>

<!-- ORDER MODAL -->
<div id="order-overlay" onclick="closeOrderModal(event)">
  <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md mx-4 max-h-[92vh] overflow-y-auto" onclick="event.stopPropagation()">
    <div class="flex items-center justify-between px-7 py-5 border-b border-gray-100">
      <div>
        <h3 class="font-serif text-xl font-bold text-gray-800" id="om-title">Order Book</h3>
        <p class="text-gray-400 text-xs mt-0.5" id="om-subtitle"></p>
      </div>
      <button onclick="closeOrderModal()" class="text-gray-400 hover:text-primary p-1"><i data-lucide="x" class="w-5 h-5"></i></button>
    </div>
    <div class="px-7 py-5">
      <div id="om-price-row" class="hidden bg-gold/8 rounded-xl px-4 py-3 mb-5 flex items-center justify-between">
        <span class="text-gray-500 text-sm">Total</span>
        <span class="font-bold text-gold text-xl" id="om-price"></span>
      </div>
      <div id="om-type-row" class="hidden mb-5">
        <span id="om-type-badge" class="text-xs font-semibold px-3 py-1 rounded-full"></span>
      </div>
      <form id="order-form" class="space-y-4">
        <input type="hidden" id="om-book-id" name="book_id" />
        <div>
          <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Full Name <span class="text-red-400">*</span></label>
          <input type="text" name="customer_name" id="om-name" required placeholder="Your full name" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gold transition-colors" />
        </div>
        <div>
          <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Email Address <span class="text-red-400">*</span></label>
          <input type="email" name="customer_email" id="om-email" required placeholder="your@email.com" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gold transition-colors" />
        </div>
        <div>
          <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Phone Number</label>
          <input type="tel" name="customer_phone" id="om-phone" placeholder="+234 xxx xxx xxxx" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gold transition-colors" />
        </div>
        <div id="om-address-row">
          <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Delivery Address</label>
          <textarea name="customer_address" id="om-address" rows="2" placeholder="Street address, city, state" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gold resize-none transition-colors"></textarea>
        </div>
        <div id="om-error" class="hidden text-sm text-red-500 bg-red-50 rounded-xl px-4 py-3"></div>
        <div class="flex gap-3 pt-2">
          <button type="button" onclick="closeOrderModal()" class="flex-1 py-3 border border-gray-200 text-gray-600 text-sm font-semibold rounded-xl hover:bg-gray-50 transition-colors">Cancel</button>
          <button type="submit" id="om-submit" class="flex-1 py-3 bg-primary hover:bg-primary-light text-white text-sm font-semibold rounded-xl flex items-center justify-center gap-2 transition-colors">
            <i data-lucide="shopping-bag" class="w-4 h-4"></i> Place Order
          </button>
        </div>
        <p class="text-gray-400 text-xs text-center leading-relaxed">
          After submitting, our team will contact you within 24 hours with payment details and delivery information.
        </p>
      </form>
    </div>
  </div>
</div>

<!-- SUCCESS MODAL -->
<div id="success-overlay" onclick="document.getElementById('success-overlay').classList.remove('open')">
  <div class="bg-white rounded-3xl shadow-2xl w-full max-w-sm mx-4 text-center p-10" onclick="event.stopPropagation()">
    <div class="w-16 h-16 bg-emerald-50 rounded-full flex items-center justify-center mx-auto mb-5">
      <i data-lucide="check-circle" class="w-8 h-8 text-emerald-500"></i>
    </div>
    <h3 class="font-serif text-2xl font-bold text-gray-800 mb-3">Order Received!</h3>
    <p class="text-gray-500 text-sm leading-relaxed mb-6">
      Thank you for your order. We'll reach out to <strong id="success-email" class="text-primary"></strong> within 24 hours with payment details and delivery information.
    </p>
    <button onclick="document.getElementById('success-overlay').classList.remove('open')" class="bg-primary hover:bg-primary-light text-white font-semibold px-8 py-3 rounded-xl transition-colors text-sm">
      Done
    </button>
  </div>
</div>

<script>
  lucide.createIcons();

  window.addEventListener('scroll', () => {
    document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 40);
  });

  function toggleMenu() {
    const menu = document.getElementById('mobile-menu');
    const icon = document.getElementById('ham-icon');
    menu.classList.toggle('open');
    icon.setAttribute('data-lucide', menu.classList.contains('open') ? 'x' : 'menu');
    lucide.createIcons();
  }

  let currentBookId = null;

  function openOrderModal(btn) {
    currentBookId = btn.dataset.bookId;
    const title    = btn.dataset.bookTitle;
    const price    = btn.dataset.bookPrice;
    const digital  = btn.dataset.bookDigital === '1';

    document.getElementById('om-title').textContent = title;
    document.getElementById('om-subtitle').textContent = digital ? 'Digital book — delivered via email' : 'Physical book — delivered to your address';
    document.getElementById('om-book-id').value = currentBookId;

    const priceRow = document.getElementById('om-price-row');
    if (price) {
      document.getElementById('om-price').textContent = '₦' + Number(price).toLocaleString('en-NG', {minimumFractionDigits: 0});
      priceRow.classList.remove('hidden');
    } else {
      priceRow.classList.add('hidden');
    }

    const typeRow   = document.getElementById('om-type-row');
    const typeBadge = document.getElementById('om-type-badge');
    typeRow.classList.remove('hidden');
    typeBadge.textContent = digital ? 'Digital Download' : 'Physical Copy';
    typeBadge.className   = digital
      ? 'text-xs font-semibold px-3 py-1 rounded-full bg-emerald-50 text-emerald-600'
      : 'text-xs font-semibold px-3 py-1 rounded-full bg-amber-50 text-amber-700';

    const addrRow = document.getElementById('om-address-row');
    if (digital) {
      addrRow.classList.add('hidden');
    } else {
      addrRow.classList.remove('hidden');
    }

    document.getElementById('om-error').classList.add('hidden');
    document.getElementById('order-form').reset();
    document.getElementById('om-book-id').value = currentBookId;
    document.getElementById('order-overlay').classList.add('open');
    lucide.createIcons();
  }

  function closeOrderModal(e) {
    if (!e || e.target === document.getElementById('order-overlay')) {
      document.getElementById('order-overlay').classList.remove('open');
    }
  }

  document.getElementById('order-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    const btn = document.getElementById('om-submit');
    btn.disabled = true;
    btn.innerHTML = '<svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"/></svg> Processing…';

    const errEl = document.getElementById('om-error');
    errEl.classList.add('hidden');

    try {
      const form = new FormData(this);
      const res  = await fetch('/books/' + currentBookId + '/order', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
        body: form,
      });
      const data = await res.json();
      if (res.ok && data.success) {
        document.getElementById('order-overlay').classList.remove('open');
        const email = document.getElementById('om-email').value;
        document.getElementById('success-email').textContent = email;
        document.getElementById('success-overlay').classList.add('open');
        lucide.createIcons();
      } else {
        const msgs = data.errors ? Object.values(data.errors).flat().join(' ') : (data.message || 'Something went wrong. Please try again.');
        errEl.textContent = msgs;
        errEl.classList.remove('hidden');
      }
    } catch {
      errEl.textContent = 'Network error. Please check your connection and try again.';
      errEl.classList.remove('hidden');
    }

    btn.disabled = false;
    btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 7H4l1-7z"/></svg> Place Order';
  });
</script>
</body>
</html>
