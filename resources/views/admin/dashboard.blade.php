<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard | Dr. A.Y. Soje</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.css" />
  <script src="https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.umd.js"></script>
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
    #sidebar{transition:width .3s ease;}
    #sidebar.collapsed{width:72px;}
    #sidebar.collapsed .sidebar-label,#sidebar.collapsed .sidebar-section-label,#sidebar.collapsed .sidebar-brand-text{display:none;}
    #sidebar.collapsed .sidebar-nav-item{justify-content:center;padding-left:0;padding-right:0;}
    .sidebar-nav-item{transition:background .2s ease,color .2s ease;}
    .sidebar-nav-item.active{background:rgba(201,146,42,.12);color:#C9922A;}
    .sidebar-nav-item.active .nav-icon{color:#C9922A;}
    .sidebar-nav-item:hover:not(.active){background:rgba(255,255,255,.06);}
    .panel{display:none;}.panel.active{display:block;}
    ::-webkit-scrollbar{width:5px;height:5px;}::-webkit-scrollbar-track{background:#F3F4F6;}::-webkit-scrollbar-thumb{background:#C9922A;border-radius:3px;}
    tbody tr{transition:background .15s ease;}tbody tr:hover{background:#FAFAFA;}
    #modal-overlay,#book-modal-overlay,#edit-post-overlay,#edit-book-overlay,#edit-service-overlay,#msg-modal-overlay,#preview-overlay,#add-testi-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.45);z-index:100;align-items:center;justify-content:center;}
    #modal-overlay.open,#book-modal-overlay.open,#edit-post-overlay.open,#edit-book-overlay.open,#edit-service-overlay.open,#msg-modal-overlay.open,#preview-overlay.open,#add-testi-overlay.open{display:flex;}
    .ck.ck-editor__editable{min-height:320px;font-family:'Inter',sans-serif;font-size:.875rem;border-radius:0 0 .75rem .75rem!important;}
    .ck.ck-toolbar{border-radius:.75rem .75rem 0 0!important;border-color:#E5E7EB!important;background:#FAFAFA!important;}
    .ck.ck-editor__editable:not(.ck-editor__nested-editable).ck-focused{border-color:#C9922A!important;box-shadow:0 0 0 3px rgba(201,146,42,.1)!important;}
    .ck.ck-editor__editable_inline{border-color:#E5E7EB!important;padding:1rem 1.25rem!important;}
    .ck-reset_all *,.ck.ck-reset_all{font-family:'Inter',sans-serif!important;}
    .badge-new{background:#EFF6FF;color:#2563EB;}.badge-read{background:#F0FDF4;color:#16A34A;}.badge-pub{background:#F0FDF4;color:#16A34A;}.badge-draft{background:#FFF7ED;color:#EA580C;}.badge-approved{background:#F0FDF4;color:#16A34A;}.badge-pending{background:#FFF7ED;color:#EA580C;}.badge-rejected{background:#FEF2F2;color:#DC2626;}
    @keyframes fadein{from{opacity:0;transform:translateY(12px);}to{opacity:1;transform:translateY(0);}}
    .fadein{animation:fadein .4s ease forwards;}
    .stat-card{transition:transform .25s ease,box-shadow .25s ease;}
    .stat-card:hover{transform:translateY(-3px);box-shadow:0 12px 24px rgba(0,0,0,.08);}
    #mob-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.4);z-index:30;}
    #mob-overlay.open{display:block;}
    .toast{position:fixed;top:1.5rem;right:1.5rem;z-index:999;padding:.75rem 1.25rem;border-radius:1rem;font-size:.875rem;font-weight:600;display:flex;align-items:center;gap:.5rem;box-shadow:0 8px 24px rgba(0,0,0,.15);}
    /* Preview article styles */
    .preview-article h1,.preview-article h2,.preview-article h3,.preview-article h4{font-family:'Playfair Display',serif;color:#0F2444;font-weight:700;line-height:1.3;margin-top:1.75rem;margin-bottom:.65rem;}
    .preview-article h2{font-size:1.45rem;}.preview-article h3{font-size:1.2rem;}.preview-article h4{font-size:1.05rem;}
    .preview-article p{color:#374151;line-height:1.8;margin-bottom:1.1rem;font-size:1rem;}
    .preview-article a{color:#C9922A;text-decoration:underline;}
    .preview-article ul,.preview-article ol{margin:1rem 0 1.1rem 1.5rem;color:#374151;line-height:1.75;font-size:1rem;}
    .preview-article ul{list-style-type:disc;}.preview-article ol{list-style-type:decimal;}
    .preview-article li{margin-bottom:.35rem;}
    .preview-article blockquote{border-left:4px solid #C9922A;background:#FDF9F4;margin:1.5rem 0;padding:1rem 1.25rem;border-radius:0 .75rem .75rem 0;font-style:italic;color:#0F2444;font-size:1.05rem;line-height:1.7;}
    .preview-article blockquote p{color:#0F2444;margin-bottom:0;}
    .preview-article strong{color:#0F2444;font-weight:600;}
    .preview-article hr{border:none;border-top:2px solid #F3F4F6;margin:1.75rem 0;}
    .preview-article table{width:100%;border-collapse:collapse;margin:1.25rem 0;font-size:.875rem;}
    .preview-article table th{background:#0F2444;color:white;padding:.6rem .875rem;text-align:left;font-weight:600;}
    .preview-article table td{padding:.55rem .875rem;border-bottom:1px solid #F3F4F6;}
    .preview-article pre{background:#1e293b;color:#e2e8f0;padding:1rem;border-radius:.75rem;overflow-x:auto;margin:1.25rem 0;font-size:.8rem;}
    .preview-article code:not(pre code){background:#F3F4F6;padding:.1rem .35rem;border-radius:.25rem;color:#0F2444;font-size:.85rem;}
    .preview-article figure img{width:100%;border-radius:.75rem;}
    .preview-article mark{background:#fef9c3;padding:.05rem .2rem;border-radius:.2rem;}
  </style>
</head>
<body class="bg-gray-50 min-h-screen flex">

@if(session('success'))
<div class="toast bg-green-600 text-white" id="flash-toast"><i data-lucide="check-circle" class="w-4 h-4"></i> {{ session('success') }}</div>
<script>setTimeout(()=>document.getElementById('flash-toast')?.remove(),4000);</script>
@endif

<div id="mob-overlay" onclick="closeMobileSidebar()"></div>

<!-- SIDEBAR -->
<aside id="sidebar" class="fixed top-0 left-0 h-full w-64 bg-primary-dark flex flex-col z-40 -translate-x-full lg:translate-x-0 transition-transform duration-300" style="transition:transform .3s ease,width .3s ease;">
  <div class="flex items-center gap-3 px-5 py-5 border-b border-white/8">
    <div class="w-9 h-9 rounded-xl bg-gold flex items-center justify-center flex-shrink-0"><i data-lucide="shield-check" class="w-5 h-5 text-white"></i></div>
    <div class="sidebar-brand-text overflow-hidden">
      <p class="font-serif text-white text-sm font-bold leading-tight">Dr. A.Y. Soje</p>
      <p class="text-white/35 text-xs">Admin Portal</p>
    </div>
  </div>
  <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
    <p class="sidebar-section-label text-white/25 text-xs font-semibold uppercase tracking-widest px-3 mb-2 mt-1">Main</p>
    <button onclick="showPanel('dashboard')" class="sidebar-nav-item w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-white text-sm font-medium"><i data-lucide="layout-dashboard" class="nav-icon w-5 h-5 flex-shrink-0 text-gold"></i><span class="sidebar-label">Dashboard</span></button>
    <button onclick="showPanel('posts')" class="sidebar-nav-item w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/60 text-sm font-medium"><i data-lucide="file-text" class="nav-icon w-5 h-5 flex-shrink-0"></i><span class="sidebar-label">Blog Posts</span><span class="sidebar-label ml-auto bg-gold text-white text-xs px-1.5 py-0.5 rounded-full">{{ $stats['posts'] }}</span></button>
    <button onclick="showPanel('testimonials')" class="sidebar-nav-item w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/60 text-sm font-medium"><i data-lucide="message-square" class="nav-icon w-5 h-5 flex-shrink-0"></i><span class="sidebar-label">Testimonials</span></button>
    <button onclick="showPanel('messages')" class="sidebar-nav-item w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/60 text-sm font-medium"><i data-lucide="mail" class="nav-icon w-5 h-5 flex-shrink-0"></i><span class="sidebar-label">Messages</span>@if($stats['new_messages']>0)<span class="sidebar-label ml-auto bg-red-500 text-white text-xs px-1.5 py-0.5 rounded-full">{{ $stats['new_messages'] }}</span>@endif</button>
    <button onclick="showPanel('books')" class="sidebar-nav-item w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/60 text-sm font-medium"><i data-lucide="book-open" class="nav-icon w-5 h-5 flex-shrink-0"></i><span class="sidebar-label">Books</span></button>
    <p class="sidebar-section-label text-white/25 text-xs font-semibold uppercase tracking-widest px-3 mb-2 mt-5">Content</p>
    <button onclick="showPanel('about')" class="sidebar-nav-item w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/60 text-sm font-medium"><i data-lucide="user" class="nav-icon w-5 h-5 flex-shrink-0"></i><span class="sidebar-label">About Section</span></button>
    <button onclick="showPanel('services')" class="sidebar-nav-item w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/60 text-sm font-medium"><i data-lucide="briefcase" class="nav-icon w-5 h-5 flex-shrink-0"></i><span class="sidebar-label">Services</span></button>
    <p class="sidebar-section-label text-white/25 text-xs font-semibold uppercase tracking-widest px-3 mb-2 mt-5">Settings</p>
    <button onclick="showPanel('settings')" class="sidebar-nav-item w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/60 text-sm font-medium"><i data-lucide="settings" class="nav-icon w-5 h-5 flex-shrink-0"></i><span class="sidebar-label">Settings</span></button>
    <a href="{{ route('home') }}" target="_blank" class="sidebar-nav-item w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/60 text-sm font-medium"><i data-lucide="external-link" class="nav-icon w-5 h-5 flex-shrink-0"></i><span class="sidebar-label">View Portfolio</span></a>
  </nav>
  <div class="px-3 py-4 border-t border-white/8">
    <div class="flex items-center gap-3 px-2 mb-3">
      <div class="w-9 h-9 rounded-xl bg-primary flex items-center justify-center flex-shrink-0"><i data-lucide="user" class="w-4 h-4 text-white/50"></i></div>
      <div class="sidebar-label overflow-hidden">
        <p class="text-white text-xs font-semibold truncate">{{ auth()->user()->display_name ?? auth()->user()->name }}</p>
        <p class="text-white/35 text-xs truncate">Administrator</p>
      </div>
    </div>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="sidebar-nav-item w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-red-400 text-sm font-medium hover:bg-red-500/10">
        <i data-lucide="log-out" class="nav-icon w-5 h-5 flex-shrink-0"></i><span class="sidebar-label">Sign Out</span>
      </button>
    </form>
  </div>
</aside>

<!-- MAIN -->
<div class="flex-1 flex flex-col min-h-screen lg:ml-64 transition-all duration-300" id="main-content">
  <header class="bg-white border-b border-gray-100 px-6 py-4 flex items-center justify-between sticky top-0 z-20">
    <div class="flex items-center gap-4">
      <button onclick="toggleMobileSidebar()" class="lg:hidden text-gray-400 hover:text-primary transition-colors"><i data-lucide="menu" class="w-5 h-5"></i></button>
      <button onclick="toggleSidebar()" class="hidden lg:block text-gray-400 hover:text-primary transition-colors"><i data-lucide="panel-left-close" class="w-5 h-5" id="sidebar-toggle-icon"></i></button>
      <div><h1 class="text-gray-800 font-semibold text-sm" id="page-title">Dashboard</h1><p class="text-gray-400 text-xs" id="page-subtitle">Welcome back, Dr. Soje</p></div>
    </div>
    <div></div>
  </header>

  {{-- ═══ DASHBOARD PANEL ═══ --}}
  <section id="panel-dashboard" class="panel p-6 fadein">
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
      <div class="stat-card bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
        <div class="flex items-start justify-between mb-4"><div class="w-11 h-11 rounded-xl bg-blue-50 flex items-center justify-center"><i data-lucide="file-text" class="w-5 h-5 text-primary"></i></div></div>
        <p class="font-serif text-3xl font-bold text-primary">{{ $stats['posts'] }}</p><p class="text-gray-400 text-xs mt-1">Blog Posts</p>
      </div>
      <div class="stat-card bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
        <div class="flex items-start justify-between mb-4"><div class="w-11 h-11 rounded-xl bg-red-50 flex items-center justify-center"><i data-lucide="mail" class="w-5 h-5 text-red-500"></i></div>@if($stats['new_messages'])<span class="text-xs font-semibold text-red-600 bg-red-50 px-2 py-1 rounded-full">{{ $stats['new_messages'] }} New</span>@endif</div>
        <p class="font-serif text-3xl font-bold text-primary">{{ $stats['messages'] }}</p><p class="text-gray-400 text-xs mt-1">Messages</p>
      </div>
      <div class="stat-card bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
        <div class="flex items-start justify-between mb-4"><div class="w-11 h-11 rounded-xl bg-amber-50 flex items-center justify-center"><i data-lucide="star" class="w-5 h-5 text-gold"></i></div>@if($stats['pending_testimonials'])<span class="text-xs font-semibold text-amber-600 bg-amber-50 px-2 py-1 rounded-full">{{ $stats['pending_testimonials'] }} Pending</span>@endif</div>
        <p class="font-serif text-3xl font-bold text-primary">{{ $stats['testimonials'] }}</p><p class="text-gray-400 text-xs mt-1">Testimonials</p>
      </div>
      <div class="stat-card bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
        <div class="flex items-start justify-between mb-4"><div class="w-11 h-11 rounded-xl bg-green-50 flex items-center justify-center"><i data-lucide="book-open" class="w-5 h-5 text-sage"></i></div></div>
        <p class="font-serif text-3xl font-bold text-primary">{{ $stats['books'] }}</p><p class="text-gray-400 text-xs mt-1">Published Books</p>
      </div>
    </div>
    <div class="grid lg:grid-cols-3 gap-6">
      <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
          <h2 class="font-semibold text-gray-800 text-sm">Recent Messages</h2>
          <button onclick="showPanel('messages')" class="text-gold text-xs font-semibold hover:text-gold-light transition-colors flex items-center gap-1">View all <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i></button>
        </div>
        <div class="divide-y divide-gray-50">
          @forelse($recentMessages as $msg)
          <div class="px-6 py-4 flex items-start gap-4 hover:bg-gray-50 transition-colors cursor-pointer" onclick="openMessageModal({{ $msg->id }},'{{ addslashes($msg->name) }}','{{ addslashes($msg->email) }}','{{ addslashes($msg->phone ?? '') }}','{{ addslashes($msg->service ?? '') }}','{{ addslashes($msg->preferred_feedback ?? '') }}','{{ addslashes($msg->message) }}','{{ $msg->created_at->diffForHumans() }}')">
            <div class="w-9 h-9 rounded-xl bg-primary flex items-center justify-center flex-shrink-0 mt-0.5"><i data-lucide="user" class="w-4 h-4 text-white/40"></i></div>
            <div class="flex-1 min-w-0">
              <div class="flex items-center gap-2 mb-0.5">
                <p class="text-sm font-semibold text-gray-800 truncate">{{ $msg->name }}</p>
                <span class="badge-{{ $msg->status }} text-xs font-semibold px-2 py-0.5 rounded-full flex-shrink-0">{{ ucfirst($msg->status) }}</span>
              </div>
              <p class="text-gray-400 text-xs truncate">{{ Str::limit($msg->message, 70) }}</p>
              <p class="text-gray-300 text-xs mt-1 flex items-center gap-1"><i data-lucide="clock" class="w-3 h-3"></i> {{ $msg->created_at->diffForHumans() }}{{ $msg->service ? ' · '.$msg->service : '' }}</p>
            </div>
          </div>
          @empty
          <p class="px-6 py-8 text-gray-400 text-sm text-center">No messages yet.</p>
          @endforelse
        </div>
      </div>
      <div class="space-y-5">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
          <h2 class="font-semibold text-gray-800 text-sm mb-4">Quick Actions</h2>
          <div class="space-y-2.5">
            <button onclick="openPostModal()" class="w-full flex items-center gap-3 bg-primary hover:bg-primary-light text-white text-sm font-medium px-4 py-3 rounded-xl transition-colors"><i data-lucide="plus" class="w-4 h-4"></i> New Blog Post</button>
            <button onclick="showPanel('testimonials')" class="w-full flex items-center gap-3 bg-gold/10 hover:bg-gold/20 text-gold text-sm font-medium px-4 py-3 rounded-xl transition-colors"><i data-lucide="star" class="w-4 h-4"></i> Review Testimonials</button>
            <button onclick="showPanel('messages')" class="w-full flex items-center gap-3 bg-gray-50 hover:bg-gray-100 text-gray-700 text-sm font-medium px-4 py-3 rounded-xl transition-colors"><i data-lucide="mail" class="w-4 h-4"></i> Check Messages</button>
            <a href="{{ route('home') }}" target="_blank" class="w-full flex items-center gap-3 bg-gray-50 hover:bg-gray-100 text-gray-700 text-sm font-medium px-4 py-3 rounded-xl transition-colors"><i data-lucide="eye" class="w-4 h-4"></i> Preview Portfolio</a>
          </div>
        </div>
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
          <h2 class="font-semibold text-gray-800 text-sm mb-4">Latest Posts</h2>
          <div class="space-y-3">
            @forelse($recentPosts as $rp)
            <div class="flex items-start gap-3">
              <div class="w-8 h-8 rounded-lg flex-shrink-0" style="background:linear-gradient(135deg,#0F2444,#1C3A5E)"></div>
              <div><p class="text-xs font-semibold text-gray-700 leading-snug">{{ Str::limit($rp->title,45) }}</p><p class="text-gray-400 text-xs mt-0.5">{{ $rp->published_at?->format('M j') ?? 'Draft' }} · <span class="{{ $rp->status==='published'?'text-green-600':'text-orange-500' }}">{{ ucfirst($rp->status) }}</span></p></div>
            </div>
            @empty
            <p class="text-gray-400 text-xs">No posts yet.</p>
            @endforelse
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- ═══ POSTS PANEL ═══ --}}
  <section id="panel-posts" class="panel p-6 fadein">
    <div class="flex items-center justify-between mb-6">
      <div><h2 class="font-serif text-xl font-bold text-gray-800">Blog Posts</h2><p class="text-gray-400 text-sm mt-0.5">Manage all published and draft articles</p></div>
      <button onclick="openPostModal()" class="inline-flex items-center gap-2 bg-primary hover:bg-primary-light text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition-colors"><i data-lucide="plus" class="w-4 h-4"></i> New Post</button>
    </div>
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full text-sm">
          <thead><tr class="border-b border-gray-100 bg-gray-50">
            <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wide px-6 py-3.5">Title</th>
            <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wide px-4 py-3.5 hidden md:table-cell">Category</th>
            <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wide px-4 py-3.5 hidden lg:table-cell">Date</th>
            <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wide px-4 py-3.5 hidden lg:table-cell">Views</th>
            <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wide px-4 py-3.5">Status</th>
            <th class="text-right text-xs font-semibold text-gray-400 uppercase tracking-wide px-6 py-3.5">Actions</th>
          </tr></thead>
          <tbody class="divide-y divide-gray-50">
            @forelse($posts as $post)
            <tr>
              <td class="px-6 py-4"><p class="font-medium text-gray-800 text-sm leading-snug">{{ $post->title }}</p><p class="text-gray-400 text-xs mt-0.5">{{ $post->read_time }} min read</p></td>
              <td class="px-4 py-4 hidden md:table-cell"><span class="text-xs bg-blue-50 text-blue-700 px-2.5 py-1 rounded-full font-medium">{{ $post->category }}</span></td>
              <td class="px-4 py-4 text-gray-400 text-xs hidden lg:table-cell">{{ $post->published_at?->format('M j, Y') ?? '—' }}</td>
              <td class="px-4 py-4 text-gray-400 text-xs hidden lg:table-cell"><span class="flex items-center gap-1"><i data-lucide="eye" class="w-3 h-3"></i>{{ number_format($post->views) }}</span></td>
              <td class="px-4 py-4"><span class="badge-{{ $post->status==='published'?'pub':'draft' }} text-xs font-semibold px-2.5 py-1 rounded-full">{{ ucfirst($post->status) }}</span></td>
              <td class="px-6 py-4">
                <div class="flex items-center justify-end gap-2">
                  <button class="p-1.5 text-gray-400 hover:text-primary hover:bg-gray-50 rounded-lg transition-colors" onclick="openEditPostModal({{ $post->id }},'{{ addslashes($post->title) }}','{{ addslashes($post->category) }}','{{ $post->status }}','{{ addslashes($post->excerpt ?? '') }}','{{ addslashes(htmlspecialchars_decode($post->read_time)) }}','{{ addslashes($post->featured_image ?? '') }}')" title="Edit"><i data-lucide="pencil" class="w-4 h-4"></i></button>
                  <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" class="inline" onsubmit="return confirm('Delete this post?')">@csrf @method('DELETE')<button type="submit" class="p-1.5 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors"><i data-lucide="trash-2" class="w-4 h-4"></i></button></form>
                </div>
              </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-6 py-12 text-center text-gray-400 text-sm">No posts yet. Create your first post!</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
      @if($posts->hasPages())
      <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-between">
        <p class="text-gray-400 text-xs">Showing {{ $posts->firstItem() }}–{{ $posts->lastItem() }} of {{ $posts->total() }} posts</p>
        {{ $posts->links('pagination::simple-tailwind') }}
      </div>
      @endif
    </div>
  </section>
  <script>
    window.postsData = window.postsData || {};
    @foreach($posts as $post)
    window.postsData[{{ $post->id }}] = @json($post->content ?? '');
    @endforeach
  </script>

  {{-- ═══ TESTIMONIALS PANEL ═══ --}}
  <section id="panel-testimonials" class="panel p-6 fadein">
    <div class="flex items-center justify-between mb-6">
      <div><h2 class="font-serif text-xl font-bold text-gray-800">Testimonials</h2><p class="text-gray-400 text-sm mt-0.5">Add client testimonials and manage existing ones</p></div>
      <button onclick="document.getElementById('add-testi-overlay').classList.add('open');lucide.createIcons();" class="inline-flex items-center gap-2 bg-primary hover:bg-primary-light text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition-colors"><i data-lucide="plus" class="w-4 h-4"></i> Add Testimonial</button>
    </div>
    @if($testimonials->isEmpty())
    <p class="text-gray-400 text-sm text-center py-12">No testimonials yet.</p>
    @else
    <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-5">
      @foreach($testimonials as $t)
      <div class="bg-white rounded-2xl border {{ $t->status==='pending'?'border-amber-100 ring-1 ring-amber-200':'border-gray-100' }} shadow-sm p-5" id="tcard-{{ $t->id }}">
        <div class="flex items-start justify-between mb-4">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center"><i data-lucide="user" class="w-5 h-5 text-white/40"></i></div>
            <div><p class="font-semibold text-gray-800 text-sm">{{ $t->name }}</p><p class="text-xs text-gray-400">{{ $t->service }}</p></div>
          </div>
          <span class="badge-{{ $t->status }} text-xs font-semibold px-2.5 py-1 rounded-full">{{ ucfirst($t->status) }}</span>
        </div>
        <div class="flex gap-0.5 mb-3">@for($s=1;$s<=5;$s++)<i data-lucide="star" class="w-3.5 h-3.5" style="{{ $s<=$t->rating?'color:#C9922A;fill:#C9922A;':'color:#d1d5db;fill:#d1d5db;' }}"></i>@endfor</div>
        <p class="text-gray-500 text-xs leading-relaxed italic">"{{ Str::limit($t->content,160) }}"</p>
        <div class="flex gap-2 mt-4">
          @if($t->status==='pending')
          <button onclick="testimonialAction({{ $t->id }},'approve')" class="flex-1 py-2 text-xs font-medium text-green-600 bg-green-50 hover:bg-green-100 rounded-lg transition-colors flex items-center justify-center gap-1.5"><i data-lucide="check" class="w-3.5 h-3.5"></i> Approve</button>
          <button onclick="testimonialAction({{ $t->id }},'reject')" class="flex-1 py-2 text-xs font-medium text-red-500 bg-red-50 hover:bg-red-100 rounded-lg transition-colors flex items-center justify-center gap-1.5"><i data-lucide="x" class="w-3.5 h-3.5"></i> Reject</button>
          @else
          <button onclick="testimonialAction({{ $t->id }},'destroy')" class="flex-1 py-2 text-xs font-medium text-red-500 bg-red-50 hover:bg-red-100 rounded-lg transition-colors flex items-center justify-center gap-1.5"><i data-lucide="x" class="w-3.5 h-3.5"></i> Remove</button>
          @endif
        </div>
      </div>
      @endforeach
    </div>
    @endif
  </section>

  {{-- ═══ MESSAGES PANEL ═══ --}}
  <section id="panel-messages" class="panel p-6 fadein">
    <div class="flex items-center justify-between mb-6">
      <div><h2 class="font-serif text-xl font-bold text-gray-800">Contact Messages</h2><p class="text-gray-400 text-sm mt-0.5">{{ $stats['new_messages'] }} unread message{{ $stats['new_messages']!=1?'s':'' }}</p></div>
    </div>
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full text-sm">
          <thead><tr class="border-b border-gray-100 bg-gray-50">
            <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wide px-6 py-3.5">From</th>
            <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wide px-4 py-3.5 hidden md:table-cell">Service</th>
            <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wide px-4 py-3.5">Message</th>
            <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wide px-4 py-3.5 hidden lg:table-cell">Date</th>
            <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wide px-4 py-3.5">Status</th>
            <th class="text-right text-xs font-semibold text-gray-400 uppercase tracking-wide px-6 py-3.5">Action</th>
          </tr></thead>
          <tbody class="divide-y divide-gray-50">
            @forelse($messages as $msg)
            <tr class="{{ $msg->status==='new'?'bg-blue-50/30':'' }}" id="msgrow-{{ $msg->id }}">
              <td class="px-6 py-4"><p class="font-semibold text-gray-800 text-sm">{{ $msg->name }}</p><p class="text-gray-400 text-xs">{{ $msg->email }}</p></td>
              <td class="px-4 py-4 hidden md:table-cell">@if($msg->service)<span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded-full">{{ $msg->service }}</span>@endif</td>
              <td class="px-4 py-4 max-w-xs"><p class="text-gray-600 text-xs leading-relaxed truncate">{{ Str::limit($msg->message,80) }}</p></td>
              <td class="px-4 py-4 text-gray-400 text-xs hidden lg:table-cell">{{ $msg->created_at->format('M j, Y') }}</td>
              <td class="px-4 py-4"><span class="badge-{{ $msg->status }} text-xs font-semibold px-2.5 py-1 rounded-full" id="msgbadge-{{ $msg->id }}">{{ ucfirst($msg->status) }}</span></td>
              <td class="px-6 py-4 text-right">
                <button class="inline-flex items-center gap-1.5 text-primary hover:text-gold text-xs font-semibold transition-colors" onclick="openMessageModal({{ $msg->id }},'{{ addslashes($msg->name) }}','{{ addslashes($msg->email) }}','{{ addslashes($msg->phone ?? '') }}','{{ addslashes($msg->service ?? '') }}','{{ addslashes($msg->preferred_feedback ?? '') }}','{{ addslashes($msg->message) }}','{{ $msg->created_at->format('M j, Y') }}')">
                  <i data-lucide="mail-open" class="w-3.5 h-3.5"></i> Read
                </button>
              </td>
            </tr>
            @empty
            <tr><td colspan="6" class="px-6 py-12 text-center text-gray-400 text-sm">No messages yet.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </section>

  {{-- ═══ BOOKS PANEL ═══ --}}
  <section id="panel-books" class="panel p-6 fadein">
    <div class="flex items-center justify-between mb-6">
      <div><h2 class="font-serif text-xl font-bold text-gray-800">Books &amp; Publications</h2><p class="text-gray-400 text-sm mt-0.5">Manage published works and publication info</p></div>
      <button onclick="openBookModal()" class="inline-flex items-center gap-2 bg-primary hover:bg-primary-light text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition-colors"><i data-lucide="plus" class="w-4 h-4"></i> Add Book</button>
    </div>
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
      @foreach($books as $book)
      <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden group">
        <div class="h-24 flex items-center justify-center {{ $book->cover_gradient }}">
          <i data-lucide="{{ $book->icon }}" class="w-8 h-8 text-white/30"></i>
        </div>
        <div class="p-4">
          <span class="text-xs bg-blue-50 text-blue-700 px-2 py-0.5 rounded-full">{{ $book->category }}</span>
          <h3 class="font-serif font-bold text-gray-800 text-sm mt-2 mb-1">{{ $book->title }}</h3>
          <p class="text-gray-400 text-xs leading-relaxed">{{ Str::limit($book->description,80) }}</p>
          <div class="flex gap-2 mt-4">
            <button onclick="openEditBookModal({{ $book->id }},'{{ addslashes($book->title) }}','{{ addslashes($book->description) }}','{{ addslashes($book->category) }}','{{ $book->cover_gradient }}','{{ $book->icon }}','{{ addslashes($book->buy_link ?? '') }}','{{ $book->sort_order }}')" class="flex-1 py-2 text-xs font-medium text-primary bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors flex items-center justify-center gap-1"><i data-lucide="pencil" class="w-3.5 h-3.5"></i> Edit</button>
            <form method="POST" action="{{ route('admin.books.destroy', $book) }}" class="inline" onsubmit="return confirm('Delete this book?')">@csrf @method('DELETE')<button type="submit" class="p-2 text-red-400 bg-red-50 hover:bg-red-100 rounded-lg transition-colors"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button></form>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </section>

  {{-- ═══ ABOUT PANEL ═══ --}}
  <section id="panel-about" class="panel p-6 fadein">
    <div class="mb-6"><h2 class="font-serif text-xl font-bold text-gray-800">About Section</h2><p class="text-gray-400 text-sm mt-0.5">Edit the bio and quote shown on your portfolio</p></div>
    <form method="POST" action="{{ route('admin.settings.about') }}" class="max-w-3xl">
      @csrf
      <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-5">
        <div>
          <label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Bio — Paragraph 1</label>
          <textarea name="about_bio_1" rows="5" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gold transition-all resize-none">{{ $settings['about_bio_1'] ?? '' }}</textarea>
        </div>
        <div>
          <label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Bio — Paragraph 2</label>
          <textarea name="about_bio_2" rows="4" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gold transition-all resize-none">{{ $settings['about_bio_2'] ?? '' }}</textarea>
        </div>
        <div>
          <label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Featured Quote</label>
          <textarea name="about_quote" rows="3" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gold transition-all resize-none">{{ $settings['about_quote'] ?? '' }}</textarea>
          <p class="text-gray-400 text-xs mt-1">This appears in the highlighted quote block on the portfolio page.</p>
        </div>
        <button type="submit" class="bg-primary hover:bg-primary-light text-white text-sm font-semibold px-6 py-2.5 rounded-xl transition-colors flex items-center gap-2"><i data-lucide="save" class="w-4 h-4"></i> Save About Section</button>
      </div>
    </form>
  </section>

  {{-- ═══ SERVICES PANEL ═══ --}}
  <section id="panel-services" class="panel p-6 fadein">
    <div class="mb-6"><h2 class="font-serif text-xl font-bold text-gray-800">Services</h2><p class="text-gray-400 text-sm mt-0.5">Edit service titles and descriptions shown on your portfolio</p></div>
    <div class="grid md:grid-cols-2 gap-5">
      @foreach($services as $svc)
      <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
        <div class="flex items-center gap-3 mb-4">
          <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0" style="background:{{ $svc->color }}20">
            <i data-lucide="{{ $svc->icon }}" class="w-5 h-5" style="color:{{ $svc->color }}"></i>
          </div>
          <h3 class="font-semibold text-gray-800 text-sm">{{ $svc->title }}</h3>
        </div>
        <form method="POST" action="{{ route('admin.services.update', $svc) }}">
          @csrf @method('PUT')
          <div class="space-y-3">
            <div>
              <label class="block text-xs font-semibold text-gray-500 mb-1 uppercase tracking-wide">Title</label>
              <input type="text" name="title" value="{{ $svc->title }}" class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:border-gold transition-all" />
            </div>
            <div>
              <label class="block text-xs font-semibold text-gray-500 mb-1 uppercase tracking-wide">Description</label>
              <textarea name="description" rows="3" class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:border-gold transition-all resize-none">{{ $svc->description }}</textarea>
            </div>
            <button type="submit" class="w-full py-2 bg-primary hover:bg-primary-light text-white text-xs font-semibold rounded-xl transition-colors flex items-center justify-center gap-1"><i data-lucide="save" class="w-3.5 h-3.5"></i> Save</button>
          </div>
        </form>
      </div>
      @endforeach
    </div>
  </section>

  {{-- ═══ SETTINGS PANEL ═══ --}}
  <section id="panel-settings" class="panel p-6 fadein">
    <div class="mb-6"><h2 class="font-serif text-xl font-bold text-gray-800">Settings</h2><p class="text-gray-400 text-sm mt-0.5">Manage your account and portfolio settings</p></div>
    <div class="grid lg:grid-cols-3 gap-6">
      <div class="lg:col-span-2 space-y-5">

        <!-- Profile -->
        <form method="POST" action="{{ route('admin.settings.profile') }}" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
          @csrf
          <h3 class="font-semibold text-gray-800 mb-5 flex items-center gap-2"><i data-lucide="user" class="w-4 h-4 text-gold"></i> Profile Information</h3>
          <div class="grid sm:grid-cols-2 gap-4">
            <div><label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Full Name</label><input type="text" name="name" value="{{ auth()->user()->name }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gold transition-all" /></div>
            <div><label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Display Name</label><input type="text" name="display_name" value="{{ auth()->user()->display_name }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gold transition-all" /></div>
            <div><label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Email</label><input type="email" name="email" value="{{ auth()->user()->email }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gold transition-all" /></div>
            <div><label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Phone (for password reset)</label><input type="tel" name="phone" value="{{ auth()->user()->phone }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gold transition-all" /></div>
          </div>
          <button class="mt-4 bg-primary hover:bg-primary-light text-white text-sm font-semibold px-6 py-2.5 rounded-xl transition-colors flex items-center gap-2"><i data-lucide="save" class="w-4 h-4"></i> Save Changes</button>
        </form>

        <!-- Password -->
        <form method="POST" action="{{ route('admin.settings.password') }}" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
          @csrf
          <h3 class="font-semibold text-gray-800 mb-5 flex items-center gap-2"><i data-lucide="lock" class="w-4 h-4 text-gold"></i> Change Password</h3>
          @error('current_password')<p class="text-red-500 text-xs mb-3">{{ $message }}</p>@enderror
          <div class="space-y-4">
            <div><label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Current Password</label><input type="password" name="current_password" placeholder="••••••••" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gold transition-all placeholder-gray-300" /></div>
            <div class="grid sm:grid-cols-2 gap-4">
              <div><label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">New Password</label><input type="password" name="password" placeholder="••••••••" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gold transition-all placeholder-gray-300" /></div>
              <div><label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Confirm Password</label><input type="password" name="password_confirmation" placeholder="••••••••" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gold transition-all placeholder-gray-300" /></div>
            </div>
          </div>
          <button class="mt-4 bg-primary hover:bg-primary-light text-white text-sm font-semibold px-6 py-2.5 rounded-xl transition-colors flex items-center gap-2"><i data-lucide="shield" class="w-4 h-4"></i> Update Password</button>
        </form>

        <!-- Stats -->
        <form method="POST" action="{{ route('admin.settings.stats') }}" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
          @csrf
          <h3 class="font-semibold text-gray-800 mb-5 flex items-center gap-2"><i data-lucide="bar-chart" class="w-4 h-4 text-gold"></i> Hero Statistics</h3>
          <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            <div><label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Books</label><input type="number" name="stat_books" value="{{ $settings['stat_books'] ?? 8 }}" min="0" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gold transition-all" /></div>
            <div><label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Lives</label><input type="number" name="stat_lives" value="{{ $settings['stat_lives'] ?? 200 }}" min="0" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gold transition-all" /></div>
            <div><label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Marriages</label><input type="number" name="stat_marriages" value="{{ $settings['stat_marriages'] ?? 50 }}" min="0" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gold transition-all" /></div>
            <div><label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Addicts</label><input type="number" name="stat_addicts" value="{{ $settings['stat_addicts'] ?? 100 }}" min="0" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gold transition-all" /></div>
          </div>
          <button class="mt-4 bg-primary hover:bg-primary-light text-white text-sm font-semibold px-6 py-2.5 rounded-xl transition-colors flex items-center gap-2"><i data-lucide="save" class="w-4 h-4"></i> Save Statistics</button>
        </form>

      </div>

      <!-- Social + Contact -->
      <div class="space-y-5">
        <form method="POST" action="{{ route('admin.settings.social') }}" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
          @csrf
          <h3 class="font-semibold text-gray-800 mb-5 flex items-center gap-2"><i data-lucide="share-2" class="w-4 h-4 text-gold"></i> Social &amp; Contact</h3>
          <div class="space-y-3">
            <div class="relative"><i data-lucide="facebook" class="w-4 h-4 text-gray-400 absolute left-3.5 top-1/2 -translate-y-1/2"></i><input type="text" name="social_facebook" value="{{ $settings['social_facebook'] ?? '' }}" placeholder="https://facebook.com/yourpage" class="w-full border border-gray-200 rounded-xl pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:border-gold transition-all placeholder-gray-300" /></div>
            <div class="relative"><i data-lucide="instagram" class="w-4 h-4 text-gray-400 absolute left-3.5 top-1/2 -translate-y-1/2"></i><input type="text" name="social_instagram" value="{{ $settings['social_instagram'] ?? '' }}" placeholder="https://instagram.com/yourhandle" class="w-full border border-gray-200 rounded-xl pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:border-gold transition-all placeholder-gray-300" /></div>
            <div class="relative"><i data-lucide="twitter" class="w-4 h-4 text-gray-400 absolute left-3.5 top-1/2 -translate-y-1/2"></i><input type="text" name="social_twitter" value="{{ $settings['social_twitter'] ?? '' }}" placeholder="https://x.com/yourhandle" class="w-full border border-gray-200 rounded-xl pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:border-gold transition-all placeholder-gray-300" /></div>
            <div class="relative"><i data-lucide="linkedin" class="w-4 h-4 text-gray-400 absolute left-3.5 top-1/2 -translate-y-1/2"></i><input type="text" name="social_linkedin" value="{{ $settings['social_linkedin'] ?? '' }}" placeholder="https://linkedin.com/in/yourname" class="w-full border border-gray-200 rounded-xl pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:border-gold transition-all placeholder-gray-300" /></div>
            <div class="relative"><i data-lucide="youtube" class="w-4 h-4 text-gray-400 absolute left-3.5 top-1/2 -translate-y-1/2"></i><input type="text" name="social_youtube" value="{{ $settings['social_youtube'] ?? '' }}" placeholder="https://youtube.com/@yourchannel" class="w-full border border-gray-200 rounded-xl pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:border-gold transition-all placeholder-gray-300" /></div>
            <div class="relative">
              <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-1/2 -translate-y-1/2" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.95a8.16 8.16 0 004.77 1.52V7.02a4.85 4.85 0 01-1-.33z"/></svg>
              <input type="text" name="social_tiktok" value="{{ $settings['social_tiktok'] ?? '' }}" placeholder="https://tiktok.com/@yourhandle" class="w-full border border-gray-200 rounded-xl pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:border-gold transition-all placeholder-gray-300" />
            </div>
            <div class="relative"><i data-lucide="phone" class="w-4 h-4 text-gray-400 absolute left-3.5 top-1/2 -translate-y-1/2"></i><input type="tel" name="contact_phone" value="{{ $settings['contact_phone'] ?? '' }}" placeholder="Contact Phone" class="w-full border border-gray-200 rounded-xl pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:border-gold transition-all placeholder-gray-300" /></div>
            <div class="relative"><i data-lucide="mail" class="w-4 h-4 text-gray-400 absolute left-3.5 top-1/2 -translate-y-1/2"></i><input type="email" name="contact_email" value="{{ $settings['contact_email'] ?? '' }}" placeholder="Contact Email" class="w-full border border-gray-200 rounded-xl pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:border-gold transition-all placeholder-gray-300" /></div>
          </div>
          <button class="mt-4 w-full bg-gray-50 hover:bg-gray-100 text-gray-700 text-sm font-semibold px-6 py-2.5 rounded-xl transition-colors flex items-center justify-center gap-2"><i data-lucide="save" class="w-4 h-4"></i> Save Links</button>
        </form>
      </div>
    </div>
  </section>

</div><!-- /main -->

{{-- ═══ NEW POST MODAL ═══ --}}
<div id="modal-overlay" onclick="closeModal(event)">
  <div class="bg-white rounded-3xl shadow-2xl w-full max-w-4xl mx-4 max-h-[93vh] flex flex-col" onclick="event.stopPropagation()">
    <div class="flex items-center justify-between px-8 py-5 border-b border-gray-100 flex-shrink-0">
      <h3 class="font-serif text-xl font-bold text-gray-800">New Blog Post</h3>
      <button onclick="closePostModal()" class="text-gray-400 hover:text-primary transition-colors p-1"><i data-lucide="x" class="w-5 h-5"></i></button>
    </div>
    <div class="overflow-y-auto flex-1">
    <form id="new-post-form" method="POST" action="{{ route('admin.posts.store') }}" class="p-8 space-y-5">
      @csrf
      <div class="grid sm:grid-cols-2 gap-4">
        <div class="sm:col-span-2"><label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Post Title</label><input type="text" name="title" id="np-title" placeholder="Enter post title..." required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gold transition-all placeholder-gray-300" /></div>
        <div><label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Category</label><select name="category" id="np-category" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-white focus:outline-none focus:border-gold transition-all"><option value="">Select category...</option><option>Mental Health</option><option>Addiction &amp; Recovery</option><option>Marriage &amp; Family</option><option>Faith &amp; Healing</option><option>Parenting</option></select></div>
        <div><label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Status</label><select name="status" id="np-status" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-white focus:outline-none focus:border-gold transition-all"><option value="draft">Draft — Save for later</option><option value="published">Published — Go live now</option></select></div>
        <div><label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Read Time (minutes)</label><input type="number" name="read_time" value="5" min="1" max="120" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gold transition-all" /></div>
        <div>
          <label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Featured Image <span class="text-gray-300 normal-case font-normal">(optional)</span></label>
          <div class="flex gap-2">
            <input type="url" name="featured_image" id="np-feat-url" placeholder="Paste URL or upload →" class="flex-1 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gold transition-all placeholder-gray-300 min-w-0" />
            <label class="cursor-pointer flex-shrink-0 bg-primary hover:bg-primary-light text-white text-xs font-semibold rounded-xl px-3 py-3 flex items-center gap-1.5 transition-colors whitespace-nowrap" id="np-upload-btn">
              <i data-lucide="upload-cloud" class="w-4 h-4"></i> Upload
              <input type="file" class="hidden" accept="image/jpeg,image/jpg,image/png,image/gif,image/webp" onchange="uploadFeaturedImage(this,'np-feat-url','np-feat-preview','np-upload-btn')" />
            </label>
          </div>
          <div id="np-feat-preview" class="hidden mt-2 rounded-xl overflow-hidden h-28 border border-gray-100">
            <img class="w-full h-full object-cover" src="" alt="Preview" />
          </div>
        </div>
        <div class="sm:col-span-2"><label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Excerpt / Summary</label><textarea name="excerpt" id="np-excerpt" rows="2" placeholder="A short compelling summary shown on the blog listing (1–2 sentences)..." class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gold transition-all placeholder-gray-300 resize-none"></textarea></div>
      </div>
      <div>
        <div class="flex items-center justify-between mb-2">
          <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wide">Article Content</label>
          <button type="button" onclick="openPreview('new')" class="inline-flex items-center gap-1.5 text-xs text-gold hover:text-primary font-semibold transition-colors border border-gold/30 hover:border-primary/30 px-3 py-1 rounded-lg"><i data-lucide="eye" class="w-3.5 h-3.5"></i> Preview Post</button>
        </div>
        <div id="new-post-editor" class="rounded-xl overflow-hidden border border-gray-200"></div>
        <input type="hidden" name="content" id="new-post-content" />
      </div>
      <div class="flex gap-3 pt-2 border-t border-gray-100">
        <button type="button" onclick="closePostModal()" class="py-3 px-6 border border-gray-200 text-gray-600 text-sm font-semibold rounded-xl hover:bg-gray-50 transition-colors">Cancel</button>
        <button type="button" onclick="openPreview('new')" class="py-3 px-5 border border-gold/40 text-gold text-sm font-semibold rounded-xl hover:bg-gold/5 transition-colors flex items-center gap-2"><i data-lucide="eye" class="w-4 h-4"></i> Preview</button>
        <button type="submit" id="np-submit" class="flex-1 py-3 bg-primary hover:bg-primary-light text-white text-sm font-semibold rounded-xl transition-colors flex items-center justify-center gap-2"><i data-lucide="send" class="w-4 h-4"></i> Save Post</button>
      </div>
    </form>
    </div>
  </div>
</div>

{{-- ═══ EDIT POST MODAL ═══ --}}
<div id="edit-post-overlay" onclick="closeEditPostModal(event)">
  <div class="bg-white rounded-3xl shadow-2xl w-full max-w-4xl mx-4 max-h-[93vh] flex flex-col" onclick="event.stopPropagation()">
    <div class="flex items-center justify-between px-8 py-5 border-b border-gray-100 flex-shrink-0">
      <h3 class="font-serif text-xl font-bold text-gray-800">Edit Blog Post</h3>
      <button onclick="document.getElementById('edit-post-overlay').classList.remove('open')" class="text-gray-400 hover:text-primary p-1"><i data-lucide="x" class="w-5 h-5"></i></button>
    </div>
    <div class="overflow-y-auto flex-1">
    <form method="POST" id="edit-post-form" class="p-8 space-y-5">
      @csrf @method('PUT')
      <div class="grid sm:grid-cols-2 gap-4">
        <div class="sm:col-span-2"><label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Post Title</label><input type="text" name="title" id="ep-title" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gold transition-all" /></div>
        <div><label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Category</label><select name="category" id="ep-category" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-white focus:outline-none focus:border-gold"><option>Mental Health</option><option>Addiction &amp; Recovery</option><option>Marriage &amp; Family</option><option>Faith &amp; Healing</option><option>Parenting</option></select></div>
        <div><label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Status</label><select name="status" id="ep-status" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-white focus:outline-none focus:border-gold"><option value="draft">Draft — Save for later</option><option value="published">Published — Go live now</option></select></div>
        <div><label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Read Time (min)</label><input type="number" name="read_time" id="ep-readtime" min="1" max="120" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gold" /></div>
        <div>
          <label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Featured Image</label>
          <div class="flex gap-2">
            <input type="url" name="featured_image" id="ep-image" placeholder="Paste URL or upload →" class="flex-1 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gold placeholder-gray-300 min-w-0" />
            <label class="cursor-pointer flex-shrink-0 bg-primary hover:bg-primary-light text-white text-xs font-semibold rounded-xl px-3 py-3 flex items-center gap-1.5 transition-colors whitespace-nowrap" id="ep-upload-btn">
              <i data-lucide="upload-cloud" class="w-4 h-4"></i> Upload
              <input type="file" class="hidden" accept="image/jpeg,image/jpg,image/png,image/gif,image/webp" onchange="uploadFeaturedImage(this,'ep-image','ep-feat-preview','ep-upload-btn')" />
            </label>
          </div>
          <div id="ep-feat-preview" class="hidden mt-2 rounded-xl overflow-hidden h-28 border border-gray-100">
            <img class="w-full h-full object-cover" src="" alt="Preview" />
          </div>
        </div>
        <div class="sm:col-span-2"><label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Excerpt</label><textarea name="excerpt" id="ep-excerpt" rows="2" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gold resize-none"></textarea></div>
      </div>
      <div>
        <div class="flex items-center justify-between mb-2">
          <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wide">Article Content</label>
          <button type="button" onclick="openPreview('edit')" class="inline-flex items-center gap-1.5 text-xs text-gold hover:text-primary font-semibold transition-colors border border-gold/30 hover:border-primary/30 px-3 py-1 rounded-lg"><i data-lucide="eye" class="w-3.5 h-3.5"></i> Preview Post</button>
        </div>
        <div id="edit-post-editor" class="rounded-xl overflow-hidden border border-gray-200"></div>
        <input type="hidden" name="content" id="ep-content" />
      </div>
      <div class="flex gap-3 pt-2 border-t border-gray-100">
        <button type="button" onclick="document.getElementById('edit-post-overlay').classList.remove('open')" class="py-3 px-6 border border-gray-200 text-gray-600 text-sm font-semibold rounded-xl hover:bg-gray-50">Cancel</button>
        <button type="button" onclick="openPreview('edit')" class="py-3 px-5 border border-gold/40 text-gold text-sm font-semibold rounded-xl hover:bg-gold/5 transition-colors flex items-center gap-2"><i data-lucide="eye" class="w-4 h-4"></i> Preview</button>
        <button type="submit" id="ep-submit" class="flex-1 py-3 bg-primary hover:bg-primary-light text-white text-sm font-semibold rounded-xl flex items-center justify-center gap-2"><i data-lucide="save" class="w-4 h-4"></i> Update Post</button>
      </div>
    </form>
    </div>
  </div>
</div>

{{-- ═══ ADD BOOK MODAL ═══ --}}
<div id="book-modal-overlay" onclick="closeBookModal(event)">
  <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg mx-4 max-h-[90vh] overflow-y-auto" onclick="event.stopPropagation()">
    <div class="flex items-center justify-between px-8 py-5 border-b border-gray-100">
      <h3 class="font-serif text-xl font-bold text-gray-800">Add Book</h3>
      <button onclick="closeBookModal()" class="text-gray-400 hover:text-primary p-1"><i data-lucide="x" class="w-5 h-5"></i></button>
    </div>
    <form method="POST" action="{{ route('admin.books.store') }}" class="p-8 space-y-4">
      @csrf
      <div><label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Title</label><input type="text" name="title" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gold" /></div>
      <div><label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Category</label><input type="text" name="category" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gold" /></div>
      <div><label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Description</label><textarea name="description" rows="3" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gold resize-none"></textarea></div>
      <div class="grid grid-cols-2 gap-4">
        <div><label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Cover Style</label><select name="cover_gradient" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-white focus:outline-none focus:border-gold"><option value="bg-b1">Blue Dark</option><option value="bg-b2">Green Dark</option><option value="bg-b3">Purple Dark</option><option value="bg-b4">Red Dark</option><option value="bg-b5">Navy</option><option value="bg-b6">Brown</option><option value="bg-b7">Forest</option><option value="bg-b8">Violet</option></select></div>
        <div><label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Icon</label><select name="icon" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-white focus:outline-none focus:border-gold"><option>book</option><option>book-open</option><option>navigation</option><option>unlock</option><option>eye</option><option>anchor</option><option>shield</option><option>key</option><option>smile</option><option>heart</option></select></div>
      </div>
      <div><label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Buy Link (optional)</label><input type="url" name="buy_link" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gold" /></div>
      <div class="flex gap-3 pt-2 border-t border-gray-100">
        <button type="button" onclick="closeBookModal()" class="flex-1 py-3 border border-gray-200 text-gray-600 text-sm font-semibold rounded-xl hover:bg-gray-50">Cancel</button>
        <button type="submit" class="flex-1 py-3 bg-primary hover:bg-primary-light text-white text-sm font-semibold rounded-xl flex items-center justify-center gap-2"><i data-lucide="save" class="w-4 h-4"></i> Add Book</button>
      </div>
    </form>
  </div>
</div>

{{-- ═══ EDIT BOOK MODAL ═══ --}}
<div id="edit-book-overlay" onclick="document.getElementById('edit-book-overlay').classList.remove('open')">
  <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg mx-4 max-h-[90vh] overflow-y-auto" onclick="event.stopPropagation()">
    <div class="flex items-center justify-between px-8 py-5 border-b border-gray-100">
      <h3 class="font-serif text-xl font-bold text-gray-800">Edit Book</h3>
      <button onclick="document.getElementById('edit-book-overlay').classList.remove('open')" class="text-gray-400 hover:text-primary p-1"><i data-lucide="x" class="w-5 h-5"></i></button>
    </div>
    <form method="POST" id="edit-book-form" class="p-8 space-y-4">
      @csrf @method('PUT')
      <div><label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Title</label><input type="text" name="title" id="eb-title" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gold" /></div>
      <div><label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Category</label><input type="text" name="category" id="eb-category" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gold" /></div>
      <div><label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Description</label><textarea name="description" id="eb-description" rows="3" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gold resize-none"></textarea></div>
      <div class="grid grid-cols-2 gap-4">
        <div><label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Cover Style</label><select name="cover_gradient" id="eb-gradient" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-white focus:outline-none focus:border-gold"><option value="bg-b1">Blue Dark</option><option value="bg-b2">Green Dark</option><option value="bg-b3">Purple Dark</option><option value="bg-b4">Red Dark</option><option value="bg-b5">Navy</option><option value="bg-b6">Brown</option><option value="bg-b7">Forest</option><option value="bg-b8">Violet</option></select></div>
        <div><label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Icon</label><select name="icon" id="eb-icon" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-white focus:outline-none focus:border-gold"><option>book</option><option>book-open</option><option>navigation</option><option>unlock</option><option>eye</option><option>anchor</option><option>shield</option><option>key</option><option>smile</option><option>heart</option></select></div>
      </div>
      <div><label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Buy Link</label><input type="url" name="buy_link" id="eb-buylink" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gold" /></div>
      <div class="flex gap-3 pt-2 border-t border-gray-100">
        <button type="button" onclick="document.getElementById('edit-book-overlay').classList.remove('open')" class="flex-1 py-3 border border-gray-200 text-gray-600 text-sm font-semibold rounded-xl hover:bg-gray-50">Cancel</button>
        <button type="submit" class="flex-1 py-3 bg-primary hover:bg-primary-light text-white text-sm font-semibold rounded-xl flex items-center justify-center gap-2"><i data-lucide="save" class="w-4 h-4"></i> Update Book</button>
      </div>
    </form>
  </div>
</div>

{{-- ═══ MESSAGE READ MODAL ═══ --}}
<div id="msg-modal-overlay" onclick="document.getElementById('msg-modal-overlay').classList.remove('open')">
  <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg mx-4" onclick="event.stopPropagation()">
    <div class="flex items-center justify-between px-7 py-5 border-b border-gray-100">
      <div>
        <h3 class="font-serif text-lg font-bold text-gray-800" id="msg-modal-name">Message</h3>
        <p class="text-xs text-gray-400 mt-0.5" id="msg-modal-date"></p>
      </div>
      <button onclick="document.getElementById('msg-modal-overlay').classList.remove('open')" class="text-gray-400 hover:text-primary p-1"><i data-lucide="x" class="w-5 h-5"></i></button>
    </div>
    <div class="p-7 space-y-4">
      <!-- Clickable contact actions -->
      <div class="flex flex-wrap gap-2">
        <a id="msg-modal-email-link" href="#" class="inline-flex items-center gap-1.5 bg-blue-50 hover:bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-2 rounded-xl transition-colors"><i data-lucide="mail" class="w-3.5 h-3.5"></i><span id="msg-modal-email"></span></a>
        <a id="msg-modal-phone-link" href="#" class="hidden items-center gap-1.5 bg-gray-50 hover:bg-gray-100 text-gray-700 text-xs font-semibold px-3 py-2 rounded-xl transition-colors"><i data-lucide="phone" class="w-3.5 h-3.5"></i><span id="msg-modal-phone"></span></a>
        <a id="msg-modal-wa-link" href="#" class="hidden items-center gap-1.5 text-white text-xs font-semibold px-3 py-2 rounded-xl transition-colors" style="background:#25D366"><i data-lucide="message-circle" class="w-3.5 h-3.5"></i> WhatsApp</a>
      </div>
      <!-- Badges -->
      <div class="flex flex-wrap gap-2" id="msg-modal-badges">
        <span id="msg-modal-service-badge" class="hidden text-xs bg-gray-100 text-gray-600 px-3 py-1.5 rounded-full font-medium"></span>
        <span id="msg-modal-feedback-badge" class="hidden text-xs bg-amber-50 text-amber-700 px-3 py-1.5 rounded-full font-medium"></span>
      </div>
      <!-- Message body -->
      <div class="bg-gray-50 rounded-2xl p-4 border border-gray-100">
        <p class="text-gray-600 text-sm leading-relaxed" id="msg-modal-body"></p>
      </div>
      <!-- Quick reply buttons -->
      <div class="flex gap-2 pt-1">
        <a id="msg-modal-reply-email" href="#" class="flex-1 py-2.5 text-xs font-semibold text-center bg-primary hover:bg-primary-light text-white rounded-xl transition-colors flex items-center justify-center gap-1.5"><i data-lucide="mail" class="w-3.5 h-3.5"></i> Reply by Email</a>
        <a id="msg-modal-reply-wa" href="#" class="hidden flex-1 py-2.5 text-xs font-semibold text-center text-white rounded-xl transition-colors items-center justify-center gap-1.5" style="background:#25D366"><i data-lucide="message-circle" class="w-3.5 h-3.5"></i> Reply on WhatsApp</a>
        <button onclick="document.getElementById('msg-modal-overlay').classList.remove('open')" class="px-4 py-2.5 text-xs font-semibold text-gray-500 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors">Close</button>
      </div>
    </div>
  </div>
</div>

{{-- ═══ PREVIEW MODAL ═══ --}}
<div id="preview-overlay" onclick="document.getElementById('preview-overlay').classList.remove('open')">
  <div class="bg-white rounded-3xl shadow-2xl w-full max-w-4xl mx-4 max-h-[93vh] flex flex-col" onclick="event.stopPropagation()">
    <div class="flex items-center justify-between px-8 py-5 border-b border-gray-100 flex-shrink-0" style="background:linear-gradient(135deg,#0F2444,#1C3A5E);border-radius:1.5rem 1.5rem 0 0;">
      <div>
        <p class="text-xs font-semibold uppercase tracking-widest text-gold mb-1" id="preview-category-badge">Mental Health</p>
        <h2 class="font-serif text-xl font-bold text-white" id="preview-title-text">Post Title</h2>
      </div>
      <div class="flex items-center gap-3">
        <span class="text-white/50 text-xs" id="preview-meta"></span>
        <button onclick="document.getElementById('preview-overlay').classList.remove('open')" class="text-white/60 hover:text-white p-1.5 rounded-lg hover:bg-white/10 transition-colors"><i data-lucide="x" class="w-5 h-5"></i></button>
      </div>
    </div>
    <div class="overflow-y-auto flex-1 px-10 py-8">
      <div id="preview-excerpt" class="text-gray-500 text-base leading-relaxed border-l-4 border-gold pl-4 mb-8 italic"></div>
      <div id="preview-body" class="preview-article"></div>
    </div>
    <div class="px-8 py-4 border-t border-gray-100 flex items-center justify-between flex-shrink-0 bg-gray-50 rounded-b-3xl">
      <p class="text-xs text-gray-400">This is a preview — content will look similar on the live site.</p>
      <button onclick="document.getElementById('preview-overlay').classList.remove('open')" class="text-xs text-primary font-semibold hover:text-gold transition-colors">Close Preview</button>
    </div>
  </div>
</div>

{{-- ═══ ADD TESTIMONIAL MODAL ═══ --}}
<div id="add-testi-overlay" onclick="document.getElementById('add-testi-overlay').classList.remove('open')">
  <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg mx-4 max-h-[90vh] overflow-y-auto" onclick="event.stopPropagation()">
    <div class="flex items-center justify-between px-8 py-5 border-b border-gray-100">
      <div>
        <h3 class="font-serif text-xl font-bold text-gray-800">Add Testimonial</h3>
        <p class="text-gray-400 text-xs mt-0.5">Add a client testimonial directly — it will appear as approved</p>
      </div>
      <button onclick="document.getElementById('add-testi-overlay').classList.remove('open')" class="text-gray-400 hover:text-primary p-1"><i data-lucide="x" class="w-5 h-5"></i></button>
    </div>
    <form method="POST" action="{{ route('admin.testimonials.store') }}" class="p-8 space-y-4">
      @csrf
      <div><label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Client Name</label><input type="text" name="name" placeholder="e.g. Mrs. A. Johnson" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gold transition-all placeholder-gray-300" /></div>
      <div><label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Service Received</label>
        <select name="service" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-white focus:outline-none focus:border-gold transition-all">
          <option value="">Select service...</option>
          <option>Addiction Recovery</option>
          <option>Trauma Therapy</option>
          <option>Marriage Counselling</option>
          <option>Faith &amp; Mental Health</option>
          <option>ADHD Support</option>
          <option>Family Therapy</option>
          <option>General Counselling</option>
        </select>
      </div>
      <div>
        <label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Rating</label>
        <div class="flex gap-2" id="star-picker">
          @for($i = 1; $i <= 5; $i++)
          <button type="button" onclick="setRating({{ $i }})" class="star-btn w-9 h-9 rounded-lg border border-gray-200 flex items-center justify-center text-gray-300 hover:text-gold hover:border-gold transition-colors text-lg" data-val="{{ $i }}">★</button>
          @endfor
        </div>
        <input type="hidden" name="rating" id="testi-rating" value="5" required />
      </div>
      <div><label class="block text-xs font-semibold text-gray-600 mb-2 uppercase tracking-wide">Testimonial</label><textarea name="content" rows="5" placeholder="Write the client's testimonial here..." required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gold transition-all placeholder-gray-300 resize-none"></textarea></div>
      <div class="flex gap-3 pt-2 border-t border-gray-100">
        <button type="button" onclick="document.getElementById('add-testi-overlay').classList.remove('open')" class="flex-1 py-3 border border-gray-200 text-gray-600 text-sm font-semibold rounded-xl hover:bg-gray-50">Cancel</button>
        <button type="submit" class="flex-1 py-3 bg-primary hover:bg-primary-light text-white text-sm font-semibold rounded-xl flex items-center justify-center gap-2"><i data-lucide="check-circle" class="w-4 h-4"></i> Add Testimonial</button>
      </div>
    </form>
  </div>
</div>

<script>
  lucide.createIcons();
  const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

  /* ── Sidebar ── */
  let sidebarCollapsed=false;
  function toggleSidebar(){sidebarCollapsed=!sidebarCollapsed;const sb=document.getElementById('sidebar'),mc=document.getElementById('main-content'),icon=document.getElementById('sidebar-toggle-icon');sb.classList.toggle('collapsed',sidebarCollapsed);mc.style.marginLeft=sidebarCollapsed?'72px':'';icon.setAttribute('data-lucide',sidebarCollapsed?'panel-left-open':'panel-left-close');lucide.createIcons();}
  function toggleMobileSidebar(){document.getElementById('sidebar').classList.toggle('-translate-x-full');document.getElementById('mob-overlay').classList.toggle('open');}
  function closeMobileSidebar(){document.getElementById('sidebar').classList.add('-translate-x-full');document.getElementById('mob-overlay').classList.remove('open');}

  /* ── Panel navigation ── */
  const panelMeta={
    dashboard:{title:'Dashboard',sub:'Welcome back, Dr. Soje'},
    posts:{title:'Blog Posts',sub:'{{ $stats["posts"] }} total posts'},
    testimonials:{title:'Testimonials',sub:'Add and manage client testimonials'},
    messages:{title:'Contact Messages',sub:'{{ $stats["new_messages"] }} unread messages'},
    books:{title:'Books',sub:'{{ $stats["books"] }} published books'},
    about:{title:'About Section',sub:'Edit your portfolio bio and quote'},
    services:{title:'Services',sub:'Edit service titles and descriptions'},
    settings:{title:'Settings',sub:'Manage account & preferences'},
  };

  function showPanel(id){
    document.querySelectorAll('.panel').forEach(p=>p.classList.remove('active'));
    const target=document.getElementById('panel-'+id);
    if(!target)return;
    target.classList.add('active');
    target.classList.remove('fadein');void target.offsetWidth;target.classList.add('fadein');
    document.querySelectorAll('.sidebar-nav-item').forEach(b=>b.classList.remove('active'));
    const navBtn=[...document.querySelectorAll('.sidebar-nav-item')].find(b=>b.getAttribute('onclick')===`showPanel('${id}')`);
    if(navBtn)navBtn.classList.add('active');
    const meta=panelMeta[id]||{};
    document.getElementById('page-title').textContent=meta.title||id;
    document.getElementById('page-subtitle').textContent=meta.sub||'';
    closeMobileSidebar();
  }

  /* ── CKEditor 5 ── */
  let newPostEditor = null, editPostEditor = null;
  const { ClassicEditor, Essentials, Paragraph, Bold, Italic, Underline, Strikethrough, Subscript, Superscript,
    Link, AutoLink, Heading, List, ListProperties, BlockQuote, Table, TableToolbar, TableColumnResize,
    TableCellProperties, TableProperties, Image, ImageCaption, ImageStyle, ImageToolbar, ImageInsertViaUrl,
    ImageUpload, SimpleUploadAdapter,
    MediaEmbed, FontColor, FontBackgroundColor, FontSize, Alignment, HorizontalLine,
    CodeBlock, RemoveFormat, Indent, IndentBlock, Autoformat, PasteFromOffice, TextTransformation,
    SpecialCharacters, SpecialCharactersEssentials, FindAndReplace } = CKEDITOR;

  const ckConfig = {
    plugins: [ Essentials, Paragraph, Bold, Italic, Underline, Strikethrough, Subscript, Superscript,
      Link, AutoLink, Heading, List, ListProperties, BlockQuote, Table, TableToolbar, TableColumnResize,
      TableCellProperties, TableProperties, Image, ImageCaption, ImageStyle, ImageToolbar, ImageInsertViaUrl,
      ImageUpload, SimpleUploadAdapter,
      MediaEmbed, FontColor, FontBackgroundColor, FontSize, Alignment, HorizontalLine,
      CodeBlock, RemoveFormat, Indent, IndentBlock, Autoformat, PasteFromOffice, TextTransformation,
      SpecialCharacters, SpecialCharactersEssentials, FindAndReplace ],
    simpleUpload: {
      uploadUrl: '{{ route("admin.images.upload") }}',
      headers: { 'X-CSRF-TOKEN': csrfToken },
    },
    toolbar: {
      items: [ 'heading', '|',
        'bold', 'italic', 'underline', 'strikethrough', '|',
        'fontColor', 'fontBackgroundColor', 'fontSize', '|',
        'link', '|',
        'bulletedList', 'numberedList', 'outdent', 'indent', '|',
        'blockQuote', 'horizontalLine', '|',
        'insertTable', 'mediaEmbed', 'insertImageViaUrl', '|',
        'alignment', '|',
        'codeBlock', 'specialCharacters', 'removeFormat', '|',
        'findAndReplace', 'undo', 'redo' ],
      shouldNotGroupWhenFull: false
    },
    heading: { options: [
      {model:'paragraph',title:'Paragraph',class:'ck-heading_paragraph'},
      {model:'heading2',view:'h2',title:'Heading 2',class:'ck-heading_heading2'},
      {model:'heading3',view:'h3',title:'Heading 3',class:'ck-heading_heading3'},
      {model:'heading4',view:'h4',title:'Heading 4',class:'ck-heading_heading4'},
    ]},
    image: { toolbar: ['imageStyle:inline','imageStyle:block','imageStyle:side','|','toggleImageCaption','imageTextAlternative'] },
    table: { contentToolbar: ['tableColumn','tableRow','mergeTableCells','tableProperties','tableCellProperties'] },
    link: { decorators: { openInNewTab: { mode:'manual', label:'Open in a new tab', attributes:{ target:'_blank', rel:'noopener noreferrer' } } } },
    fontSize: { options: ['tiny','small','default','big','huge'] },
    mediaEmbed: { previewsInData: true },
  };

  /* ── Cloudinary Featured Image Upload ── */
  async function uploadFeaturedImage(input, urlFieldId, previewId, btnId) {
    if (!input.files[0]) return;
    const btn = document.getElementById(btnId);
    const origHTML = btn.innerHTML;
    btn.innerHTML = '<svg class="w-4 h-4 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path></svg> Uploading…';
    btn.style.pointerEvents = 'none';
    const formData = new FormData();
    formData.append('upload', input.files[0]);
    try {
      const res = await fetch('{{ route("admin.images.upload") }}', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': csrfToken },
        body: formData,
      });
      const data = await res.json();
      if (data.url) {
        document.getElementById(urlFieldId).value = data.url;
        const prev = document.getElementById(previewId);
        prev.querySelector('img').src = data.url;
        prev.classList.remove('hidden');
        showToast('Image uploaded successfully!');
      } else {
        showToast((data.error?.message || 'Upload failed'), 'bg-red-600');
      }
    } catch(e) {
      showToast('Upload error. Check connection.', 'bg-red-600');
    }
    btn.innerHTML = origHTML;
    btn.style.pointerEvents = '';
    lucide.createIcons();
    input.value = '';
  }

  async function initEditors(){
    try {
      newPostEditor = await ClassicEditor.create(document.getElementById('new-post-editor'), ckConfig);
      editPostEditor = await ClassicEditor.create(document.getElementById('edit-post-editor'), ckConfig);
      /* Sync hidden inputs on submit */
      document.getElementById('new-post-form').addEventListener('submit', ()=>{
        document.getElementById('new-post-content').value = newPostEditor.getData();
      });
      document.getElementById('edit-post-form').addEventListener('submit', ()=>{
        document.getElementById('ep-content').value = editPostEditor.getData();
      });
    } catch(e){ console.error('CKEditor init error:', e); }
  }
  initEditors();

  /* ── Modals ── */
  function openPostModal(){
    document.getElementById('modal-overlay').classList.add('open');
    if(newPostEditor) newPostEditor.setData('');
    lucide.createIcons();
  }
  function closePostModal(){document.getElementById('modal-overlay').classList.remove('open');}
  function closeModal(e){if(e.target===document.getElementById('modal-overlay'))closePostModal();}

  function openBookModal(){document.getElementById('book-modal-overlay').classList.add('open');lucide.createIcons();}
  function closeBookModal(e){if(e&&e.target===document.getElementById('book-modal-overlay')){document.getElementById('book-modal-overlay').classList.remove('open');}else{document.getElementById('book-modal-overlay').classList.remove('open');}}

  function openEditPostModal(id,title,category,status,excerpt,readTime,image){
    const form=document.getElementById('edit-post-form');
    form.action='/admin/posts/'+id;
    document.getElementById('ep-title').value=title;
    document.getElementById('ep-category').value=category;
    document.getElementById('ep-status').value=status;
    document.getElementById('ep-excerpt').value=excerpt;
    document.getElementById('ep-readtime').value=readTime;
    document.getElementById('ep-image').value=image||'';
    const epPrev=document.getElementById('ep-feat-preview');
    if(image){epPrev.querySelector('img').src=image;epPrev.classList.remove('hidden');}
    else{epPrev.classList.add('hidden');epPrev.querySelector('img').src='';}
    /* Load content from pre-fetched postsData */
    if(editPostEditor){ editPostEditor.setData(window.postsData?.[id]||''); }
    document.getElementById('edit-post-overlay').classList.add('open');
    lucide.createIcons();
  }
  function closeEditPostModal(e){if(e.target===document.getElementById('edit-post-overlay'))document.getElementById('edit-post-overlay').classList.remove('open');}

  function openEditBookModal(id,title,desc,cat,grad,icon,buyLink,sort){
    const form=document.getElementById('edit-book-form');
    form.action='/admin/books/'+id;
    document.getElementById('eb-title').value=title;
    document.getElementById('eb-description').value=desc;
    document.getElementById('eb-category').value=cat;
    document.getElementById('eb-gradient').value=grad;
    document.getElementById('eb-icon').value=icon;
    document.getElementById('eb-buylink').value=buyLink||'';
    document.getElementById('edit-book-overlay').classList.add('open');
    lucide.createIcons();
  }

  function openMessageModal(id,name,email,phone,service,feedback,message,date){
    document.getElementById('msg-modal-name').textContent=name;
    document.getElementById('msg-modal-date').textContent=date;
    // Email (always present) — clickable mailto link
    document.getElementById('msg-modal-email').textContent=email;
    document.getElementById('msg-modal-email-link').href='mailto:'+email;
    document.getElementById('msg-modal-reply-email').href='mailto:'+email+'?subject=Re: Your Enquiry';
    // Phone / WhatsApp (optional)
    const phoneEl=document.getElementById('msg-modal-phone-link');
    const waEl=document.getElementById('msg-modal-wa-link');
    const waReplyEl=document.getElementById('msg-modal-reply-wa');
    if(phone){
      document.getElementById('msg-modal-phone').textContent=phone;
      phoneEl.href='tel:'+phone.replace(/\s+/g,'');
      phoneEl.classList.remove('hidden');phoneEl.classList.add('inline-flex');
      const waNum=phone.replace(/[^0-9]/g,'');
      const waUrl='https://wa.me/'+waNum;
      waEl.href=waUrl; waEl.classList.remove('hidden');waEl.classList.add('inline-flex');
      waReplyEl.href=waUrl; waReplyEl.classList.remove('hidden');waReplyEl.classList.add('flex');
    } else {
      phoneEl.classList.add('hidden');phoneEl.classList.remove('inline-flex');
      waEl.classList.add('hidden');waEl.classList.remove('inline-flex');
      waReplyEl.classList.add('hidden');waReplyEl.classList.remove('flex');
    }
    // Service badge
    const svcBadge=document.getElementById('msg-modal-service-badge');
    if(service){svcBadge.textContent='Service: '+service;svcBadge.classList.remove('hidden');}
    else{svcBadge.classList.add('hidden');}
    // Preferred feedback badge
    const fbBadge=document.getElementById('msg-modal-feedback-badge');
    if(feedback){fbBadge.textContent='Prefers: '+feedback;fbBadge.classList.remove('hidden');}
    else{fbBadge.classList.add('hidden');}
    document.getElementById('msg-modal-body').textContent=message;
    document.getElementById('msg-modal-overlay').classList.add('open');
    lucide.createIcons();
    fetch('/admin/messages/'+id+'/read',{method:'PATCH',headers:{'X-CSRF-TOKEN':csrfToken,'Content-Type':'application/json'}}).then(()=>{
      const badge=document.getElementById('msgbadge-'+id);
      if(badge&&badge.textContent.trim()==='New'){badge.textContent='Read';badge.className='badge-read text-xs font-semibold px-2.5 py-1 rounded-full';}
      const row=document.getElementById('msgrow-'+id);
      if(row)row.classList.remove('bg-blue-50/30');
    });
  }

  /* ── Preview Post ── */
  function openPreview(mode){
    const editor = mode==='new' ? newPostEditor : editPostEditor;
    const titleEl = mode==='new' ? document.getElementById('np-title') : document.getElementById('ep-title');
    const catEl   = mode==='new' ? document.getElementById('np-category') : document.getElementById('ep-category');
    const excerptEl = mode==='new' ? document.getElementById('np-excerpt') : document.getElementById('ep-excerpt');
    const content = editor ? editor.getData() : '';
    document.getElementById('preview-title-text').textContent = titleEl?.value || 'Untitled Post';
    document.getElementById('preview-category-badge').textContent = catEl?.value || '';
    document.getElementById('preview-meta').textContent = (catEl?.value||'') + ' · Preview';
    const exc = excerptEl?.value || '';
    document.getElementById('preview-excerpt').style.display = exc ? '' : 'none';
    document.getElementById('preview-excerpt').textContent = exc;
    document.getElementById('preview-body').innerHTML = content || '<p class="text-gray-400 italic">No content written yet.</p>';
    document.getElementById('preview-overlay').classList.add('open');
    lucide.createIcons();
  }

  /* ── Testimonials ── */
  function setRating(val){
    document.getElementById('testi-rating').value=val;
    document.querySelectorAll('.star-btn').forEach(btn=>{
      const v=parseInt(btn.getAttribute('data-val'));
      btn.style.color=v<=val?'#C9922A':'';
      btn.style.borderColor=v<=val?'#C9922A':'';
      btn.style.background=v<=val?'rgba(201,146,42,.08)':'';
    });
  }
  /* Init star picker at 5 */
  document.addEventListener('DOMContentLoaded',()=>setRating(5));

  async function testimonialAction(id,action){
    let url='/admin/testimonials/'+id,method='PATCH';
    if(action==='approve')url+='/approve';
    else if(action==='reject')url+='/reject';
    else if(action==='destroy'){url='/admin/testimonials/'+id;method='DELETE';}
    const res=await fetch(url,{method,headers:{'X-CSRF-TOKEN':csrfToken,'Content-Type':'application/json'}});
    if(res.ok){
      if(action==='destroy'){document.getElementById('tcard-'+id)?.remove();}
      else{
        const card=document.getElementById('tcard-'+id);
        if(card){
          const badge=card.querySelector('[class*="badge-"]');
          if(badge){badge.className='badge-'+(action==='approve'?'approved':'rejected')+' text-xs font-semibold px-2.5 py-1 rounded-full';badge.textContent=action==='approve'?'Approved':'Rejected';}
          const btns=card.querySelectorAll('.flex.gap-2.mt-4');
          btns.forEach(b=>b.remove());
          const div=document.createElement('div');div.className='flex gap-2 mt-4';
          div.innerHTML='<button onclick="testimonialAction('+id+',\'destroy\')" class="flex-1 py-2 text-xs font-medium text-red-500 bg-red-50 hover:bg-red-100 rounded-lg transition-colors flex items-center justify-center gap-1.5"><i data-lucide="x" class="w-3.5 h-3.5"></i> Remove</button>';
          card.appendChild(div);lucide.createIcons();
        }
      }
      showToast(action==='destroy'?'Testimonial removed.':(action==='approve'?'Testimonial approved.':'Testimonial rejected.'));
    }
  }

  function showToast(msg,color='bg-green-600'){
    const t=document.createElement('div');
    t.className='toast '+color+' text-white';
    t.innerHTML='<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> '+msg;
    document.body.appendChild(t);setTimeout(()=>t.remove(),3500);
  }

  /* ── Auto-activate panel from URL param ── */
  const initPanel='{{ $panel }}';
  showPanel(initPanel||'dashboard');
</script>
</body>
</html>
