<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Reset Password | Dr. A.Y. Soje Admin</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet" />
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
    body{font-family:'Inter',sans-serif;}
    input:focus{outline:none;border-color:#C9922A;box-shadow:0 0 0 3px rgba(201,146,42,.12);}
  </style>
</head>
<body class="min-h-screen bg-cream flex items-center justify-center p-6">
  <div class="w-full max-w-md">

    <div class="text-center mb-8">
      <p class="font-serif text-primary text-2xl font-bold">Dr. A.Y. Soje</p>
      <p class="text-gold text-sm mt-1">Enter OTP</p>
    </div>

    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 md:p-10">

      <div class="w-12 h-12 bg-primary rounded-2xl flex items-center justify-center mb-5">
        <i data-lucide="key" class="w-6 h-6 text-gold"></i>
      </div>

      <h1 class="font-serif text-2xl font-bold text-primary mb-1">Enter OTP</h1>

      {{-- Success banner --}}
      @if(session('otp_sent'))
      <div class="mt-4 mb-5 rounded-xl px-4 py-3 flex items-start gap-3" style="background:#dcfce7;border:1px solid #86efac;">
        <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="none" stroke="#16a34a" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        <p class="text-green-700 text-xs leading-relaxed">
          A 6-digit OTP has been sent to <strong>{{ $phone }}</strong> via WhatsApp. Check your WhatsApp messages — it may take a few seconds to arrive.
        </p>
      </div>
      @else
      <p class="text-gray-400 text-sm mt-1 mb-6">Enter the 6-digit OTP sent to your WhatsApp, then set your new password.</p>
      @endif

      @if($errors->has('otp'))
      <div class="mb-5 bg-red-50 border border-red-200 rounded-xl px-4 py-3 flex items-start gap-3">
        <i data-lucide="alert-circle" class="w-4 h-4 text-red-500 flex-shrink-0 mt-0.5"></i>
        <p class="text-red-600 text-xs">{{ $errors->first('otp') }}</p>
      </div>
      @endif

      <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        <input type="hidden" name="phone" value="{{ $phone }}" />

        <div>
          <label class="block text-xs font-semibold text-primary mb-2 uppercase tracking-wide">OTP Code</label>
          <input type="text" name="otp" maxlength="6" placeholder="• • • • • •"
            autocomplete="one-time-code" inputmode="numeric" required
            class="w-full border border-gray-200 rounded-xl px-4 py-3.5 text-sm transition-all placeholder-gray-300 tracking-[.4em] text-center font-mono text-xl @error('otp') border-red-300 @enderror" />
          <p class="text-gray-400 text-xs mt-1.5 text-center">OTP is valid for 10 minutes</p>
        </div>

        <div>
          <label class="block text-xs font-semibold text-primary mb-2 uppercase tracking-wide">New Password</label>
          <input type="password" name="password" placeholder="Minimum 8 characters" required
            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm transition-all placeholder-gray-300" />
        </div>

        <div>
          <label class="block text-xs font-semibold text-primary mb-2 uppercase tracking-wide">Confirm New Password</label>
          <input type="password" name="password_confirmation" placeholder="Repeat new password" required
            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm transition-all placeholder-gray-300" />
          @error('password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <button type="submit" class="w-full bg-primary hover:bg-primary-light text-white font-semibold py-4 rounded-xl transition-colors flex items-center justify-center gap-2">
          <i data-lucide="check-circle" class="w-5 h-5"></i> Reset Password
        </button>
      </form>

      <div class="mt-6 pt-6 border-t border-gray-100 flex items-center justify-between text-sm">
        <a href="{{ route('password.request') }}" class="inline-flex items-center gap-1.5 text-gray-400 hover:text-primary transition-colors">
          <i data-lucide="refresh-cw" class="w-4 h-4"></i> Resend OTP
        </a>
        <a href="{{ route('login') }}" class="inline-flex items-center gap-1.5 text-gray-400 hover:text-primary transition-colors">
          <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to Login
        </a>
      </div>
    </div>
  </div>
  <script>lucide.createIcons();</script>
</body>
</html>
