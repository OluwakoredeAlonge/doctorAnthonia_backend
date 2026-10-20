<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $book->title }} — Reader</title>
  <link rel="icon" href="{{ asset('favicon.ico') }}" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/page-flip@2.0.7/dist/js/page-flip.browser.js"></script>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'Inter', sans-serif;
      background: #111827;
      color: #fff;
      height: 100vh;
      display: flex;
      flex-direction: column;
      overflow: hidden;
      user-select: none;
    }

    /* ── Top bar ── */
    #topbar {
      flex-shrink: 0;
      background: #0F2444;
      border-bottom: 1px solid rgba(255,255,255,.07);
      padding: 0 1.25rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 1rem;
      height: 54px;
    }
    #topbar h1 {
      font-size: .875rem;
      font-weight: 600;
      color: #fff;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      max-width: 55vw;
    }
    .badge {
      display: inline-flex;
      align-items: center;
      gap: .3rem;
      font-size: .68rem;
      font-weight: 600;
      color: #C9922A;
      background: rgba(201,146,42,.12);
      padding: .2rem .65rem;
      border-radius: 99px;
      white-space: nowrap;
      flex-shrink: 0;
    }

    /* ── Loader ── */
    #loader {
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 1.25rem;
      background: #111827;
    }
    .loader-book-icon {
      width: 56px;
      height: 56px;
      border-radius: 16px;
      background: rgba(201,146,42,.1);
      display: flex;
      align-items: center;
      justify-content: center;
      animation: pulse 2s infinite;
    }
    @keyframes pulse {
      0%, 100% { opacity: 1; }
      50% { opacity: .5; }
    }
    #loader-title { font-size: .95rem; font-weight: 600; color: #fff; }
    #progress-bar-wrap {
      width: 260px;
      background: rgba(255,255,255,.08);
      border-radius: 99px;
      height: 5px;
      overflow: hidden;
    }
    #progress-bar {
      height: 100%;
      background: linear-gradient(90deg, #C9922A, #e8b04a);
      border-radius: 99px;
      width: 0%;
      transition: width .15s;
    }
    #loader-sub { font-size: .78rem; color: rgba(255,255,255,.35); }

    /* ── Reader area ── */
    #reader-area {
      flex: 1;
      display: none;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      background: radial-gradient(ellipse at center, #1e2a42 0%, #0d1117 100%);
      padding: 16px 0 8px;
    }
    #reader-area.visible { display: flex; }

    /* Shadow beneath the book */
    #book-shadow {
      position: absolute;
      bottom: 0;
      width: 70%;
      height: 30px;
      background: radial-gradient(ellipse at center, rgba(0,0,0,.5) 0%, transparent 70%);
      pointer-events: none;
    }

    /* page-flip overrides */
    .stf__parent { touch-action: none !important; }

    .page {
      background: #fff;
      overflow: hidden;
    }
    .page canvas {
      display: block;
      width: 100% !important;
      height: 100% !important;
    }
    /* Page turn shadow is rendered by the library — keep page bg white */
    .page--left  { border-right: 1px solid rgba(0,0,0,.08); }
    .page--right { border-left: 1px solid rgba(0,0,0,.08); }

    /* ── Nav bar ── */
    #navbar {
      flex-shrink: 0;
      background: rgba(15,36,68,.95);
      border-top: 1px solid rgba(255,255,255,.06);
      height: 50px;
      display: none;
      align-items: center;
      justify-content: center;
      gap: .75rem;
      padding: 0 1.25rem;
    }
    #navbar.visible { display: flex; }
    #navbar button {
      background: rgba(255,255,255,.07);
      border: 1px solid rgba(255,255,255,.08);
      color: #fff;
      border-radius: 10px;
      padding: .35rem .9rem;
      font-size: .78rem;
      font-weight: 600;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: .4rem;
      transition: background .15s, border-color .15s;
      font-family: 'Inter', sans-serif;
    }
    #navbar button:hover:not(:disabled) { background: rgba(255,255,255,.14); border-color: rgba(255,255,255,.2); }
    #navbar button:disabled { opacity: .25; cursor: not-allowed; }
    #page-info { font-size: .78rem; color: rgba(255,255,255,.4); min-width: 90px; text-align: center; }
    #render-hint { font-size: .7rem; color: rgba(201,146,42,.6); }
  </style>
</head>
<body>

  <div id="topbar">
    <div style="display:flex;align-items:center;gap:.75rem;min-width:0;">
      <a href="{{ route('books.index') }}" style="color:rgba(255,255,255,.45);flex-shrink:0;" title="Back to books">
        <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
      </a>
      <h1>{{ $book->title }}</h1>
    </div>
    <span class="badge">
      <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
      Read Only
    </span>
  </div>

  <!-- Loading screen -->
  <div id="loader">
    <div class="loader-book-icon">
      <svg width="26" height="26" fill="none" viewBox="0 0 24 24" stroke="#C9922A" stroke-width="1.5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
      </svg>
    </div>
    <div id="loader-title">Opening your book…</div>
    <div id="progress-bar-wrap"><div id="progress-bar"></div></div>
    <div id="loader-sub">Preparing pages, please wait</div>
  </div>

  <!-- Flipbook reader -->
  <div id="reader-area">
    <div id="flipbook"></div>
    <div id="book-shadow"></div>
  </div>

  <!-- Navigation -->
  <div id="navbar">
    <button id="btn-first"  onclick="goToPage(0)"    title="First page">
      <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 19l-7-7 7-7M18 19l-7-7 7-7"/></svg>
    </button>
    <button id="btn-prev" onclick="goToPrev()">
      <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
      Prev
    </button>
    <span id="page-info">— / —</span>
    <button id="btn-next" onclick="goToNext()">
      Next
      <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
    </button>
    <button id="btn-last" onclick="goToPage(totalPages - 1)" title="Last page">
      <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 5l7 7-7 7M6 5l7 7-7 7"/></svg>
    </button>
    <span id="render-hint" style="display:none;">Loading remaining pages…</span>
  </div>

  <script>
    pdfjsLib.GlobalWorkerOptions.workerSrc =
      'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

    @php $streamUrl = route('books.reader.stream', ['book' => $book, 'token' => $token]) . '?' . http_build_query(['e' => request()->query('e', '')]); @endphp
    const PDF_URL           = @json($streamUrl);
    const WATERMARK_ENABLED = @json($watermarkEnabled ?? false);
    const WATERMARK_TEXT    = @json($email ?? '');

    let pageFlip   = null;
    let totalPages = 0;

    // Block download shortcuts and right-click
    document.addEventListener('keydown', e => {
      if ((e.ctrlKey || e.metaKey) && ['s','p','u'].includes(e.key.toLowerCase())) {
        e.preventDefault();
      }
    });
    document.getElementById('reader-area').addEventListener('contextmenu', e => e.preventDefault());

    async function loadBook() {
      try {
        const pdf = await pdfjsLib.getDocument({ url: PDF_URL, disableFontFace: false }).promise;
        totalPages = pdf.numPages;

        // ── Calculate display dimensions from first page ──
        const firstPdfPage = await pdf.getPage(1);
        const native = firstPdfPage.getViewport({ scale: 1 });

        const TOPBAR   = 54;
        const NAVBAR   = 50;
        const VPAD     = 24;
        const HPAD     = 40;
        const isMobile = window.innerWidth < 640;

        const availH = window.innerHeight - TOPBAR - NAVBAR - VPAD;
        // On desktop two pages sit side-by-side; each gets half width
        const availW = isMobile
          ? window.innerWidth - HPAD
          : (window.innerWidth - HPAD) / 2;

        const scaleByH  = availH / native.height;
        const scaleByW  = availW / native.width;
        const renderScale = Math.min(scaleByH, scaleByW, 2.0); // max 2x for quality

        const pgW = Math.floor(native.width  * renderScale);
        const pgH = Math.floor(native.height * renderScale);

        // ── Create all page divs upfront (empty canvases) ──
        const container  = document.getElementById('flipbook');
        const pageEls    = [];

        for (let i = 0; i < totalPages; i++) {
          const div    = document.createElement('div');
          div.className = i % 2 === 0 ? 'page page--right' : 'page page--left';
          div.style.cssText = `width:${pgW}px;height:${pgH}px;`;

          const canvas  = document.createElement('canvas');
          canvas.width  = pgW;
          canvas.height = pgH;
          div.appendChild(canvas);
          container.appendChild(div);
          pageEls.push({ div, canvas, num: i + 1 });
        }

        // ── Render first 4 pages so the book looks good on open ──
        const setProgress = (done) =>
          (document.getElementById('progress-bar').style.width =
            Math.round((done / Math.min(4, totalPages)) * 100) + '%');
        document.getElementById('loader-sub').textContent =
          `Loading ${totalPages} pages…`;

        for (let i = 0; i < Math.min(4, totalPages); i++) {
          await renderPage(pdf, pageEls[i], renderScale);
          setProgress(i + 1);
        }

        // ── Initialise PageFlip ──
        pageFlip = new St.PageFlip(container, {
          width          : pgW,
          height         : pgH,
          size           : 'fixed',
          drawShadow     : true,
          flippingTime   : 750,
          usePortrait    : isMobile,
          startZIndex    : 0,
          autoSize       : false,
          maxShadowOpacity: 0.45,
          showCover      : false,
          mobileScrollSupport: false,
          swipeDistance  : 35,
          clickEventForward: true,
          useMouseEvents : true,
        });

        pageFlip.loadFromHTML(document.querySelectorAll('.page'));

        pageFlip.on('flip',        e  => updatePageInfo(e.data + 1));
        pageFlip.on('changeState', () => updateNavButtons());

        // ── Show the reader ──
        document.getElementById('loader').style.display = 'none';
        document.getElementById('reader-area').classList.add('visible');
        document.getElementById('navbar').classList.add('visible');
        updatePageInfo(1);
        updateNavButtons();

        // ── Render remaining pages in the background ──
        if (totalPages > 4) {
          document.getElementById('render-hint').style.display = '';
          let rendered = 4;
          for (let i = 4; i < totalPages; i++) {
            await renderPage(pdf, pageEls[i], renderScale);
            rendered++;
            if (rendered >= totalPages) {
              document.getElementById('render-hint').style.display = 'none';
            }
            // yield every 4 pages to keep UI responsive
            if (i % 4 === 0) await sleep(0);
          }
        }

      } catch (err) {
        console.error('PDF load error:', err);
        document.getElementById('loader-title').textContent = 'Could not open book.';
        document.getElementById('loader-sub').textContent =
          'Please refresh the page or contact support.';
        document.getElementById('progress-bar').style.background = '#ef4444';
      }
    }

    async function renderPage(pdf, { canvas, num }, scale) {
      const page = await pdf.getPage(num);
      const vp   = page.getViewport({ scale });
      canvas.width  = vp.width;
      canvas.height = vp.height;
      await page.render({ canvasContext: canvas.getContext('2d'), viewport: vp }).promise;
      if (WATERMARK_ENABLED && WATERMARK_TEXT) applyWatermark(canvas, WATERMARK_TEXT);
    }

    function applyWatermark(canvas, text) {
      const ctx  = canvas.getContext('2d');
      const w    = canvas.width;
      const h    = canvas.height;
      const size = Math.max(10, Math.round(w * 0.034)); // ~3.4% of page width

      ctx.save();
      ctx.font        = `600 ${size}px Inter, Arial, sans-serif`;
      ctx.fillStyle   = 'rgba(80, 80, 80, 0.13)';
      ctx.textAlign   = 'center';
      ctx.textBaseline = 'middle';

      // Rotate the whole context and tile the watermark text in a grid
      ctx.translate(w / 2, h / 2);
      ctx.rotate(-Math.PI / 6); // 30° diagonal

      const colSpacing = Math.max(w * 0.55, 200);
      const rowSpacing = Math.max(h * 0.18, 60);

      for (let row = -h; row < h * 1.5; row += rowSpacing) {
        for (let col = -w; col < w * 1.5; col += colSpacing) {
          ctx.fillText(text, col, row);
        }
      }

      ctx.restore();
    }

    function sleep(ms) {
      return new Promise(r => setTimeout(r, ms));
    }

    function updatePageInfo(currentPage) {
      document.getElementById('page-info').textContent =
        `Page ${currentPage} of ${totalPages}`;
    }

    function updateNavButtons() {
      if (!pageFlip) return;
      const curr = pageFlip.getCurrentPageIndex();
      document.getElementById('btn-first').disabled = curr <= 0;
      document.getElementById('btn-prev').disabled  = curr <= 0;
      document.getElementById('btn-next').disabled  = curr >= totalPages - 1;
      document.getElementById('btn-last').disabled  = curr >= totalPages - 1;
    }

    function goToPrev()      { pageFlip?.flipPrev('bottom'); }
    function goToNext()      { pageFlip?.flipNext('bottom'); }
    function goToPage(index) { pageFlip?.flip(index, 'top'); updatePageInfo(index + 1); }

    loadBook();
  </script>
</body>
</html>
