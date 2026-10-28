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
    #desc-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.55);z-index:120;align-items:flex-end;justify-content:center;padding-bottom:0;}
    #desc-overlay.open{display:flex;}
    @media(min-width:640px){#desc-overlay{align-items:center;padding-bottom:0;}}
    .desc-sheet{transform:translateY(100%);transition:transform .35s cubic-bezier(.32,1,.46,1);}
    #desc-overlay.open .desc-sheet{transform:translateY(0);}
    @media(min-width:640px){.desc-sheet{transform:translateY(0) scale(.96);transition:transform .3s cubic-bezier(.32,1,.46,1),opacity .3s;opacity:0;}#desc-overlay.open .desc-sheet{transform:scale(1);opacity:1;}}
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
        <div class="bg-gray-50 flex items-center justify-center">
          <img src="{{ $book->cover_image }}" alt="{{ $book->title }}" class="w-full object-contain" />
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
          <div class="flex-1">
            <p class="text-gray-500 text-sm leading-relaxed line-clamp-3" id="desc-{{ $book->id }}">{{ $book->description }}</p>
            @if(strlen($book->description) > 160)
            <button
              onclick="openDescModal(this)"
              data-title="{{ e($book->title) }}"
              data-cover="{{ e($book->cover_image ?? '') }}"
              data-desc="{{ e($book->description) }}"
              class="mt-1 text-xs font-semibold text-primary hover:underline focus:outline-none"
            >Read more</button>
            @endif
          </div>

          <div class="mt-5 pt-4 border-t border-gray-100">
            <div class="flex items-start justify-between gap-3 mb-3">
              <div class="space-y-0.5">
                @if(!is_null($book->digital_price))
                <p class="text-sm font-semibold text-emerald-700">{{ $book->digital_price > 0 ? '₦'.number_format($book->digital_price,0) : 'Free' }} <span class="font-normal text-gray-400 text-xs">digital</span></p>
                @endif
                @if(!is_null($book->hardcopy_price))
                <p class="text-sm font-semibold text-amber-700">{{ $book->hardcopy_price > 0 ? '₦'.number_format($book->hardcopy_price,0) : 'Free' }} <span class="font-normal text-gray-400 text-xs">hardcopy</span></p>
                @endif
                @if(is_null($book->digital_price) && is_null($book->hardcopy_price))
                <p class="text-gray-400 text-sm italic">Price TBA</p>
                @endif
              </div>
              <span class="text-xs font-semibold px-2 py-0.5 rounded-full {{ !is_null($book->digital_price) && !is_null($book->hardcopy_price) ? 'bg-blue-50 text-blue-700' : (!is_null($book->digital_price) ? 'bg-emerald-50 text-emerald-600' : 'bg-amber-50 text-amber-700') }} whitespace-nowrap flex-shrink-0">{{ $book->type_label }}</span>
            </div>
            @php
              $freeDigital  = !is_null($book->digital_price) && (float)$book->digital_price === 0.0;
              $paidDigital  = !is_null($book->digital_price) && (float)$book->digital_price > 0;
              $hasHardcopy  = !is_null($book->hardcopy_price);
              // Show order button when there's something to pay for
              $showOrder    = $paidDigital || $hasHardcopy;
              // digital_price for the order modal should exclude free (already accessible via Read button)
              $modalDigitalPrice  = $paidDigital  ? $book->digital_price  : '';
              $modalHasDigital    = $paidDigital  ? '1' : '0';
            @endphp

            {{-- Free digital: direct read button --}}
            @if($freeDigital && $book->file_path)
            <a href="{{ route('books.reader.show', $book) }}" class="w-full inline-flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition-all">
              <i data-lucide="book-open" class="w-4 h-4"></i>
              Read Free
            </a>
            @endif

            {{-- Order button for anything that has a price --}}
            @if($showOrder)
            <button
              class="{{ $freeDigital ? 'mt-1.5 ' : '' }}w-full inline-flex items-center justify-center gap-2 bg-primary hover:bg-primary-light text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition-all"
              onclick="openOrderModal(this)"
              data-book-id="{{ $book->id }}"
              data-book-title="{{ e($book->title) }}"
              data-book-digital-price="{{ $modalDigitalPrice }}"
              data-book-hardcopy-price="{{ $book->hardcopy_price ?? '' }}"
              data-book-has-digital="{{ $modalHasDigital }}"
              data-book-has-hardcopy="{{ $hasHardcopy ? '1' : '0' }}"
              data-book-additional-info="{{ e($book->additional_info ?? '') }}"
            >
              <i data-lucide="shopping-bag" class="w-4 h-4"></i>
              {{ $hasHardcopy && !$paidDigital ? 'Order Hardcopy' : 'Order This Book' }}
            </button>
            @endif

            {{-- Paid digital read: after order confirmed, show "Read My Book" --}}
            @if($paidDigital && $book->file_path)
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
      {{-- Type selector (shown when both types available) --}}
      <div id="om-type-selector" class="hidden mb-5">
        <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide mb-2">Select Copy Type</p>
        <div class="flex gap-2">
          <button type="button" id="om-btn-digital" onclick="selectOrderType('digital')" class="flex-1 border-2 rounded-xl py-3 text-sm font-semibold transition-colors border-gray-200 text-gray-500">
            <span class="block text-xs text-gray-400 mb-0.5">Digital</span>
            <span id="om-digital-price-label"></span>
          </button>
          <button type="button" id="om-btn-hardcopy" onclick="selectOrderType('hardcopy')" class="flex-1 border-2 rounded-xl py-3 text-sm font-semibold transition-colors border-gray-200 text-gray-500">
            <span class="block text-xs text-gray-400 mb-0.5">Hardcopy</span>
            <span id="om-hardcopy-price-label"></span>
          </button>
        </div>
      </div>
      {{-- Single type badge (shown when only one type) --}}
      <div id="om-type-badge-row" class="hidden mb-4 flex items-center justify-between bg-gray-50 rounded-xl px-4 py-3">
        <span id="om-single-type-label" class="text-sm text-gray-600"></span>
        <span class="font-bold text-gold text-lg" id="om-single-price"></span>
      </div>
      {{-- Additional info --}}
      <div id="om-info-row" class="hidden mb-4 bg-blue-50 rounded-xl px-4 py-3 text-sm text-blue-700 leading-relaxed" id="om-info-text"></div>
      <form id="order-form" class="space-y-4">
        <input type="hidden" id="om-book-id" name="book_id" />
        <input type="hidden" id="om-order-type" name="order_type" value="digital" />
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
        {{-- Coupon code --}}
        <div>
          <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Coupon Code <span class="text-gray-300 normal-case font-normal">(optional)</span></label>
          <div class="flex gap-2">
            <input type="text" id="om-coupon-input" placeholder="Enter code" maxlength="50" onkeydown="if(event.key==='Enter'){event.preventDefault();applyCoupon();}" class="flex-1 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gold transition-colors uppercase placeholder-gray-300" style="text-transform:uppercase" />
            <button type="button" onclick="applyCoupon()" id="om-coupon-btn" class="flex-shrink-0 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold px-4 py-3 rounded-xl transition-colors">Apply</button>
          </div>
          <div id="om-coupon-result" class="hidden mt-2 text-xs font-semibold px-3 py-2 rounded-lg"></div>
          <input type="hidden" name="coupon_code" id="om-coupon-code" />
        </div>
        <div id="om-error" class="hidden text-sm text-red-500 bg-red-50 rounded-xl px-4 py-3"></div>
        <div class="flex gap-3 pt-2">
          <button type="button" onclick="closeOrderModal()" class="flex-1 py-3 border border-gray-200 text-gray-600 text-sm font-semibold rounded-xl hover:bg-gray-50 transition-colors">Cancel</button>
          <button type="submit" id="om-submit" class="flex-1 py-3 bg-primary hover:bg-primary-light text-white text-sm font-semibold rounded-xl flex items-center justify-center gap-2 transition-colors">
            <i data-lucide="shopping-bag" class="w-4 h-4"></i> Place Order
          </button>
        </div>
        <p class="text-gray-400 text-xs text-center leading-relaxed">
          After placing your order you'll receive bank details to complete payment.
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
    <h3 class="font-serif text-2xl font-bold text-gray-800 mb-3">Order Placed!</h3>
    <p class="text-gray-500 text-sm leading-relaxed mb-3">
      Your order reference is <strong id="success-ref" class="text-primary font-mono"></strong>.
    </p>
    <p class="text-gray-500 text-sm leading-relaxed mb-6">Complete your payment using the bank details on the order page, then tap <em>I've Paid</em> and we'll confirm within 24 hours.</p>
    <a id="success-order-link" href="#" class="block w-full bg-primary hover:bg-primary-light text-white font-semibold px-8 py-3 rounded-xl transition-colors text-sm mb-3">
      View My Order &amp; Pay
    </a>
    <button onclick="document.getElementById('success-overlay').classList.remove('open')" class="text-gray-400 text-sm hover:text-gray-600 transition-colors">
      Close
    </button>
  </div>
</div>

<!-- DESCRIPTION MODAL -->
<div id="desc-overlay" onclick="closeDescModal(event)">
  <div class="desc-sheet bg-white w-full sm:max-w-lg sm:mx-4 sm:rounded-3xl rounded-t-3xl shadow-2xl overflow-hidden" style="max-height:90vh;" onclick="event.stopPropagation()">
    {{-- Drag handle (mobile) --}}
    <div class="sm:hidden flex justify-center pt-3 pb-1">
      <div class="w-10 h-1 bg-gray-200 rounded-full"></div>
    </div>
    {{-- Header --}}
    <div class="flex items-start gap-4 px-6 pt-4 pb-5 border-b border-gray-100">
      <div id="dm-cover-wrap" class="flex-shrink-0 hidden">
        <img id="dm-cover" src="" alt="" class="w-16 h-20 object-contain rounded-xl border border-gray-100 bg-gray-50" />
      </div>
      <div class="flex-1 min-w-0">
        <p class="text-xs text-primary font-semibold uppercase tracking-wide mb-1">About this book</p>
        <h3 id="dm-title" class="font-serif text-xl font-bold text-gray-900 leading-snug"></h3>
      </div>
      <button onclick="closeDescModal()" class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200 text-gray-500 transition-colors mt-0.5">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>
    </div>
    {{-- Body --}}
    <div class="px-6 py-5 overflow-y-auto" style="max-height:55vh;">
      <p id="dm-body" class="text-gray-600 text-sm leading-relaxed whitespace-pre-line"></p>
    </div>
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
  let selectedOrderType = 'digital';

  function fmtPrice(p) {
    return p !== '' && p !== null && p !== undefined
      ? (Number(p) === 0 ? 'Free' : '₦' + Number(p).toLocaleString('en-NG', {minimumFractionDigits: 0}))
      : '';
  }

  function resetCoupon() {
    document.getElementById('om-coupon-input').value = '';
    document.getElementById('om-coupon-code').value  = '';
    const r = document.getElementById('om-coupon-result');
    r.classList.add('hidden');
    r.textContent = '';
  }

  function selectOrderType(type) {
    selectedOrderType = type;
    document.getElementById('om-order-type').value = type;
    ['digital','hardcopy'].forEach(t => {
      const btn = document.getElementById('om-btn-' + t);
      if (t === type) {
        btn.classList.add('border-primary','text-primary');
        btn.classList.remove('border-gray-200','text-gray-500');
      } else {
        btn.classList.remove('border-primary','text-primary');
        btn.classList.add('border-gray-200','text-gray-500');
      }
    });
    const addrRow = document.getElementById('om-address-row');
    addrRow.classList.toggle('hidden', type === 'digital');
    resetCoupon();
  }

  async function applyCoupon() {
    const input  = document.getElementById('om-coupon-input');
    const code   = input.value.trim().toUpperCase();
    const result = document.getElementById('om-coupon-result');
    const hidden = document.getElementById('om-coupon-code');

    if (!code) { return; }

    const btn = document.getElementById('om-coupon-btn');
    btn.disabled   = true;
    btn.textContent = 'Checking…';

    try {
      const res  = await fetch('{{ route("books.coupons.validate") }}', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Accept':       'application/json',
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ code, book_id: currentBookId, order_type: selectedOrderType }),
      });
      const data = await res.json();

      result.classList.remove('hidden', 'text-green-700', 'bg-green-50', 'text-red-600', 'bg-red-50');

      if (data.valid) {
        hidden.value = code;
        const label = data.final === 0
          ? data.discount + '% off — Free!'
          : data.discount + '% off — now ₦' + Number(data.final).toLocaleString('en-NG', {minimumFractionDigits: 0});
        result.textContent = label;
        result.classList.add('text-green-700', 'bg-green-50');
      } else {
        hidden.value = '';
        result.textContent = data.message || 'Invalid coupon code.';
        result.classList.add('text-red-600', 'bg-red-50');
      }
    } catch {
      hidden.value = '';
      result.textContent = 'Could not check coupon. Try again.';
      result.classList.remove('hidden');
      result.classList.add('text-red-600', 'bg-red-50');
    }

    btn.disabled    = false;
    btn.textContent = 'Apply';
  }

  function openOrderModal(btn) {
    const d = btn.dataset;
    currentBookId = d.bookId;
    const hasDigital  = d.bookHasDigital === '1';
    const hasHardcopy = d.bookHasHardcopy === '1';
    const bothTypes   = hasDigital && hasHardcopy;

    document.getElementById('om-title').textContent = d.bookTitle;
    document.getElementById('om-book-id').value = currentBookId;
    document.getElementById('om-error').classList.add('hidden');
    document.getElementById('order-form').reset();
    document.getElementById('om-book-id').value = currentBookId;
    resetCoupon();

    // Additional info
    const infoRow = document.getElementById('om-info-row');
    if (d.bookAdditionalInfo) {
      infoRow.textContent = d.bookAdditionalInfo;
      infoRow.classList.remove('hidden');
    } else {
      infoRow.classList.add('hidden');
    }

    if (bothTypes) {
      // Show type selector
      document.getElementById('om-type-selector').classList.remove('hidden');
      document.getElementById('om-type-badge-row').classList.add('hidden');
      document.getElementById('om-subtitle').textContent = 'Choose your copy type below';
      document.getElementById('om-digital-price-label').textContent = fmtPrice(d.bookDigitalPrice);
      document.getElementById('om-hardcopy-price-label').textContent = fmtPrice(d.bookHardcopyPrice);
      selectOrderType('digital');
    } else {
      document.getElementById('om-type-selector').classList.add('hidden');
      const type   = hasDigital ? 'digital' : 'hardcopy';
      const price  = hasDigital ? d.bookDigitalPrice : d.bookHardcopyPrice;
      selectedOrderType = type;
      document.getElementById('om-order-type').value = type;
      document.getElementById('om-subtitle').textContent = type === 'digital' ? 'Digital book' : 'Hardcopy — physical delivery';
      const badgeRow = document.getElementById('om-type-badge-row');
      badgeRow.classList.remove('hidden');
      document.getElementById('om-single-type-label').textContent = type === 'digital' ? 'Digital copy' : 'Hardcopy';
      document.getElementById('om-single-price').textContent = fmtPrice(price);
      document.getElementById('om-address-row').classList.toggle('hidden', type === 'digital');
    }

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
        document.getElementById('success-ref').textContent  = data.reference || '';
        document.getElementById('success-order-link').href  = data.order_url  || '#';
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

  function openDescModal(btn) {
    const d = btn.dataset;
    document.getElementById('dm-title').textContent = d.title;
    document.getElementById('dm-body').textContent  = d.desc;
    const coverWrap = document.getElementById('dm-cover-wrap');
    const coverImg  = document.getElementById('dm-cover');
    if (d.cover) {
      coverImg.src = d.cover;
      coverImg.alt = d.title;
      coverWrap.classList.remove('hidden');
    } else {
      coverWrap.classList.add('hidden');
    }
    document.getElementById('desc-overlay').classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function closeDescModal(e) {
    if (!e || e.target === document.getElementById('desc-overlay')) {
      document.getElementById('desc-overlay').classList.remove('open');
      document.body.style.overflow = '';
    }
  }
</script>
</body>
</html>
