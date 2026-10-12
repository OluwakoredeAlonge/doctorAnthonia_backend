<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Read {{ $book->title }} | {{ config('app.name') }}</title>
  <link rel="icon" href="{{ asset('favicon.ico') }}" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet" />
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <style>body{font-family:'Inter',sans-serif;}.font-serif{font-family:'Playfair Display',serif!important;}</style>
</head>
<body class="min-h-screen bg-cream flex items-center justify-center px-4 py-16">
  <div class="w-full max-w-md">
    <a href="{{ route('books.index') }}" class="inline-flex items-center gap-2 text-primary/60 hover:text-primary text-sm font-medium mb-8 transition-colors">
      <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
      Back to Books
    </a>

    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
      {{-- Book cover strip --}}
      @if($book->cover_image)
      <div class="h-32 overflow-hidden">
        <img src="{{ $book->cover_image }}" alt="{{ $book->title }}" class="w-full h-full object-cover" />
      </div>
      @else
      <div class="{{ $book->cover_gradient }} h-24 flex items-center justify-center">
        <svg class="w-8 h-8 text-white/30" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
      </div>
      @endif

      <div class="p-8">
        <div class="w-12 h-12 bg-primary/8 rounded-2xl flex items-center justify-center mb-5">
          <svg class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
        </div>
        <h1 class="font-serif text-2xl font-bold text-gray-900 mb-1">Read Your Book</h1>
        <p class="text-gray-500 text-sm mb-6">Enter the email address you used when ordering <strong class="text-gray-700">{{ $book->title }}</strong> to access your copy.</p>

        @if($error)
        <div class="bg-red-50 border border-red-100 rounded-xl px-4 py-3 mb-5 flex items-start gap-3">
          <svg class="w-4 h-4 text-red-400 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          <p class="text-red-600 text-sm">{{ $error }}</p>
        </div>
        @endif

        <form method="POST" action="{{ route('books.reader.show', $book) }}">
          @csrf
          <label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Email Address</label>
          <input
            type="email"
            name="email"
            required
            placeholder="your@email.com"
            value="{{ old('email') }}"
            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gold transition-colors mb-4"
          />
          <button type="submit" class="w-full bg-primary hover:bg-primary-light text-white font-semibold py-3 rounded-xl transition-colors text-sm flex items-center justify-center gap-2">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            Access My Book
          </button>
        </form>
        <p class="text-gray-400 text-xs text-center mt-4">Don't have a copy yet? <a href="{{ route('books.index') }}" class="text-gold hover:text-gold-light font-medium">Browse books</a></p>
      </div>
    </div>
  </div>
</body>
</html>
