<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Order {{ $order->payment_reference }} | {{ config('app.name') }}</title>
  <link rel="icon" href="{{ asset('favicon.ico') }}" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet" />
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <style>body{font-family:'Inter',sans-serif;}.font-serif{font-family:'Playfair Display',serif!important;}</style>
</head>
<body class="min-h-screen bg-cream">

  {{-- Top nav --}}
  <div class="bg-white border-b border-gray-100 px-4 py-3 flex items-center gap-3">
    <a href="{{ route('books.index') }}" class="inline-flex items-center gap-1.5 text-primary/60 hover:text-primary text-sm font-medium transition-colors">
      <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
      Books
    </a>
    <span class="text-gray-300">/</span>
    <span class="text-gray-500 text-sm">Order {{ $order->payment_reference }}</span>
  </div>

  <div class="max-w-lg mx-auto px-4 py-12">

    {{-- Book info strip --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-4">
      <div class="flex gap-4 p-5">
        @if($order->book->cover_image)
          <img src="{{ $order->book->cover_image }}" alt="{{ $order->book->title }}" class="w-16 h-20 object-cover rounded-xl flex-shrink-0" />
        @else
          <div class="w-16 h-20 rounded-xl {{ $order->book->cover_gradient }} flex items-center justify-center flex-shrink-0">
            <svg class="w-6 h-6 text-white/40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
          </div>
        @endif
        <div class="flex-1 min-w-0">
          <p class="text-xs text-gray-400 mb-1">{{ $order->book->category }}</p>
          <h2 class="font-serif font-bold text-gray-900 leading-tight mb-2">{{ $order->book->title }}</h2>
          <div class="flex flex-wrap gap-2 items-center">
            <span class="text-xs font-semibold px-2 py-0.5 rounded-full {{ $order->order_type === 'digital' ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700' }}">
              {{ ucfirst($order->order_type) }}
            </span>
            @if((float)$order->amount === 0.0)
              <span class="text-xs font-bold text-emerald-600">Free</span>
            @else
              <span class="text-sm font-bold text-gold">₦{{ number_format($order->amount, 0) }}</span>
            @endif
          </div>
        </div>
      </div>
    </div>

    {{-- Status card --}}
    @if($order->payment_status === 'pending')
    {{-- ── PENDING: show bank details ── --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
      <div class="flex items-center gap-3 mb-5">
        <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center flex-shrink-0">
          <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
        </div>
        <div>
          <h3 class="font-semibold text-gray-800">Complete your payment</h3>
          <p class="text-xs text-gray-400">Transfer the exact amount to the account below</p>
        </div>
      </div>

      @if($bankSettings['books_bank_name'] || $bankSettings['books_bank_number'])
      <div class="bg-gray-50 rounded-xl p-4 mb-4 space-y-3">
        @if($bankSettings['books_bank_name'])
        <div class="flex justify-between items-center">
          <span class="text-xs text-gray-500 font-medium">Bank</span>
          <span class="text-sm font-semibold text-gray-800">{{ $bankSettings['books_bank_name'] }}</span>
        </div>
        @endif
        @if($bankSettings['books_bank_number'])
        <div class="flex justify-between items-center">
          <span class="text-xs text-gray-500 font-medium">Account Number</span>
          <div class="flex items-center gap-2">
            <span class="text-sm font-bold text-primary tracking-widest" id="acct-num">{{ $bankSettings['books_bank_number'] }}</span>
            <button onclick="copyText('{{ $bankSettings['books_bank_number'] }}','acct-num')" class="text-xs text-primary/60 hover:text-primary transition-colors" title="Copy">
              <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/></svg>
            </button>
          </div>
        </div>
        @endif
        @if($bankSettings['books_account_name'])
        <div class="flex justify-between items-center">
          <span class="text-xs text-gray-500 font-medium">Account Name</span>
          <span class="text-sm font-semibold text-gray-800">{{ $bankSettings['books_account_name'] }}</span>
        </div>
        @endif
        <div class="flex justify-between items-center border-t border-gray-200 pt-3">
          <span class="text-xs text-gray-500 font-medium">Amount</span>
          <span class="text-base font-bold text-primary">₦{{ number_format($order->amount, 0) }}</span>
        </div>
      </div>
      @else
      <div class="bg-amber-50 rounded-xl p-4 mb-4 text-amber-700 text-sm">
        Payment details have not been configured yet. Please contact us directly to complete your order.
      </div>
      @endif

      @if($bankSettings['books_payment_note'])
      <div class="bg-blue-50 rounded-xl p-3.5 mb-4 text-sm text-blue-700 leading-relaxed">
        {{ $bankSettings['books_payment_note'] }}
      </div>
      @endif

      <p class="text-xs text-gray-500 mb-4">Use <strong>{{ $order->payment_reference }}</strong> as your payment narration/description so we can identify your transfer.</p>

      <form method="POST" action="{{ route('books.order.claim', $order->payment_reference) }}">
        @csrf @method('PATCH')
        <label class="flex items-start gap-3 mb-4 cursor-pointer">
          <input type="checkbox" id="confirm-check" required class="w-4 h-4 mt-0.5 rounded border-gray-300 text-primary flex-shrink-0" />
          <span class="text-sm text-gray-600">I have made the bank transfer and understand my order will be confirmed once payment is verified.</span>
        </label>
        <button type="submit" class="w-full bg-primary hover:bg-primary-light text-white font-semibold py-3 rounded-xl transition-colors text-sm flex items-center justify-center gap-2">
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
          I've Paid — Notify for Confirmation
        </button>
      </form>
    </div>

    @elseif($order->payment_status === 'awaiting_confirmation')
    {{-- ── AWAITING CONFIRMATION ── --}}
    <div class="bg-white rounded-2xl border border-amber-200 shadow-sm p-6 text-center">
      <div class="w-14 h-14 bg-amber-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
        <svg class="w-7 h-7 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
      </div>
      <h3 class="font-serif text-xl font-bold text-gray-800 mb-2">Payment Received — Awaiting Confirmation</h3>
      <p class="text-gray-500 text-sm leading-relaxed mb-5">Thank you! We've received your payment notification. Our team will verify your transfer and confirm your order shortly. Please check back soon.</p>
      <div class="bg-amber-50 rounded-xl px-4 py-3 text-xs text-amber-700 font-medium">
        Paid on {{ $order->paid_claimed_at?->format('D, d M Y \a\t g:ia') }}
      </div>
    </div>

    @elseif($order->payment_status === 'confirmed')
    {{-- ── CONFIRMED ── --}}
    <div class="bg-white rounded-2xl border border-emerald-200 shadow-sm p-6 text-center">
      <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
        <svg class="w-7 h-7 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
      </div>
      <h3 class="font-serif text-xl font-bold text-gray-800 mb-2">
        @if((float)$order->amount === 0.0) Your free copy is ready! @else Order Confirmed! @endif
      </h3>
      <p class="text-gray-500 text-sm mb-5">
        @if($order->order_type === 'digital')
          Your digital copy of <strong>{{ $order->book->title }}</strong> is now accessible. Click below to start reading.
        @else
          Your hardcopy of <strong>{{ $order->book->title }}</strong> has been confirmed. We will be in touch regarding delivery.
        @endif
      </p>
      @if($order->order_type === 'digital' && $order->book->is_digital && $order->book->file_path)
      <a href="{{ route('books.reader.show', $order->book) }}" class="inline-flex items-center justify-center gap-2 bg-primary hover:bg-primary-light text-white font-semibold px-6 py-3 rounded-xl transition-colors text-sm">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
        Read {{ $order->book->title }}
      </a>
      @else
      <a href="{{ route('books.index') }}" class="inline-flex items-center gap-2 border border-gray-200 text-gray-600 hover:border-primary hover:text-primary font-semibold px-5 py-2.5 rounded-xl transition-colors text-sm">
        Browse More Books
      </a>
      @endif
    </div>

    @elseif($order->payment_status === 'rejected')
    {{-- ── REJECTED ── --}}
    <div class="bg-white rounded-2xl border border-red-100 shadow-sm p-6 text-center">
      <div class="w-14 h-14 bg-red-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
        <svg class="w-7 h-7 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
      </div>
      <h3 class="font-serif text-xl font-bold text-gray-800 mb-2">Order Not Confirmed</h3>
      <p class="text-gray-500 text-sm leading-relaxed mb-5">We could not verify your payment for this order. Please contact us with your payment receipt and order reference <strong>{{ $order->payment_reference }}</strong> and we will resolve this for you.</p>
      <a href="{{ route('home') }}#contact" class="inline-flex items-center gap-2 bg-primary hover:bg-primary-light text-white font-semibold px-5 py-2.5 rounded-xl transition-colors text-sm">
        Contact Us
      </a>
    </div>
    @endif

    {{-- Order summary footer --}}
    <div class="mt-4 bg-white rounded-2xl border border-gray-100 shadow-sm p-4">
      <p class="text-xs text-gray-400 mb-2 uppercase tracking-wide font-semibold">Order Details</p>
      <div class="space-y-1.5 text-sm">
        <div class="flex justify-between"><span class="text-gray-500">Reference</span><span class="font-mono text-gray-700 font-semibold">{{ $order->payment_reference }}</span></div>
        <div class="flex justify-between"><span class="text-gray-500">Name</span><span class="text-gray-700">{{ $order->customer_name }}</span></div>
        <div class="flex justify-between"><span class="text-gray-500">Email</span><span class="text-gray-700">{{ $order->customer_email }}</span></div>
        <div class="flex justify-between"><span class="text-gray-500">Placed</span><span class="text-gray-700">{{ $order->created_at->format('d M Y, g:ia') }}</span></div>
      </div>
    </div>

  </div>

  <script>
    function copyText(text, elId) {
      navigator.clipboard.writeText(text).then(() => {
        const el = document.getElementById(elId);
        const orig = el.textContent;
        el.textContent = 'Copied!';
        el.classList.add('text-emerald-600');
        setTimeout(() => { el.textContent = orig; el.classList.remove('text-emerald-600'); }, 1500);
      });
    }
  </script>
</body>
</html>
