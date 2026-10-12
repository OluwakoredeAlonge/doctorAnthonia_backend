<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $book->title }} — Reader</title>
  <link rel="icon" href="{{ asset('favicon.ico') }}" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet" />
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <style>
    *{box-sizing:border-box;}
    body{font-family:'Inter',sans-serif;margin:0;padding:0;background:#1a1a2e;color:#fff;display:flex;flex-direction:column;height:100vh;overflow:hidden;}
    #topbar{flex-shrink:0;background:#0F2444;border-bottom:1px solid rgba(255,255,255,.08);padding:.75rem 1.25rem;display:flex;align-items:center;justify-content:space-between;gap:1rem;}
    #topbar h1{font-size:.9rem;font-weight:600;color:#fff;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:60vw;}
    #reader-wrap{flex:1;overflow:hidden;position:relative;}
    #pdf-frame{width:100%;height:100%;border:none;display:block;}
    .badge{display:inline-flex;align-items:center;gap:.35rem;font-size:.7rem;font-weight:600;color:#C9922A;background:rgba(201,146,42,.12);padding:.25rem .7rem;border-radius:99px;}
  </style>
</head>
<body>
  <div id="topbar">
    <div style="display:flex;align-items:center;gap:.75rem;min-width:0;">
      <a href="{{ route('books.index') }}" style="color:rgba(255,255,255,.5);flex-shrink:0;" title="Back to books">
        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
      </a>
      <h1>{{ $book->title }}</h1>
    </div>
    <span class="badge">
      <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
      Read Only
    </span>
  </div>

  <div id="reader-wrap">
    <iframe
      id="pdf-frame"
      src="{{ route('books.reader.stream', ['book' => $book, 'token' => $token]) }}?e={{ urlencode(request()->query('e', '')) }}#toolbar=0&navpanes=0&scrollbar=1"
      allowfullscreen
    ></iframe>
  </div>

  <script>
    // Intercept common download shortcuts
    document.addEventListener('keydown', function(e){
      if((e.ctrlKey||e.metaKey) && e.key==='s'){e.preventDefault();}
      if((e.ctrlKey||e.metaKey) && e.key==='p'){e.preventDefault();}
    });
    // Block right-click on the iframe area
    document.getElementById('reader-wrap').addEventListener('contextmenu', function(e){e.preventDefault();});
  </script>
</body>
</html>
