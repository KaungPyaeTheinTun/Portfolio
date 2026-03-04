<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>@yield('title', 'KP2T — Full Stack Developer')</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" type="image/jpeg" href="{{ asset('images/_ (1).jpeg') }}">
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Mono:ital,wght@0,300;0,400;0,500;1,300&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet"/>
  <style>
    :root {
      --blue: #3b82f6;
      --blue-bright: #60a5fa;
      --blue-glow: rgba(59,130,246,0.35);
      --dark: #080c14;
      --surface: #0d1526;
      --surface2: #111e36;
      --border: rgba(59,130,246,0.18);
      --text: #e2e8f0;
      --muted: #64748b;
    }
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; }
    body { background: var(--dark); color: var(--text); font-family: 'Syne', sans-serif; overflow-x: hidden; cursor: none; }

    #cursor { position: fixed; top: 0; left: 0; z-index: 9999; pointer-events: none; mix-blend-mode: screen; }
    #cursor .dot { width: 8px; height: 8px; background: var(--blue-bright); border-radius: 50%; transform: translate(-50%,-50%); }
    #cursor .ring { position: absolute; width: 36px; height: 36px; border: 1.5px solid var(--blue-bright); border-radius: 50%; top: 50%; left: 50%; transform: translate(-50%,-50%) scale(1); transition: transform 0.35s cubic-bezier(.17,.67,.41,1.3), opacity 0.3s; opacity: 0.5; }
    body:has(a:hover) #cursor .ring, body:has(button:hover) #cursor .ring { transform: translate(-50%,-50%) scale(2.2); opacity: 1; }

    #bg-canvas { position: fixed; inset: 0; z-index: 0; pointer-events: none; }

    ::-webkit-scrollbar { width: 4px; }
    ::-webkit-scrollbar-track { background: var(--dark); }
    ::-webkit-scrollbar-thumb { background: var(--blue); border-radius: 4px; }

    nav { position: fixed; top: 0; left: 0; right: 0; z-index: 100; padding: 1.25rem 2.5rem; display: flex; align-items: center; justify-content: space-between; backdrop-filter: blur(18px); background: rgba(8,12,20,0.7); border-bottom: 1px solid var(--border); transition: box-shadow 0.3s; }
    nav.scrolled { box-shadow: 0 0 40px rgba(59,130,246,0.12); }
    .nav-logo { font-family: 'Instrument Serif', serif; font-size: 1.5rem; color: #fff; letter-spacing: -0.02em; }
    .nav-logo span { color: var(--blue-bright); }
    .nav-links { display: flex; gap: 2.5rem; list-style: none; }
    .nav-links a { font-size: 0.8rem; font-weight: 600; letter-spacing: 0.12em; text-transform: uppercase; color: var(--muted); text-decoration: none; position: relative; transition: color 0.3s; }
    .nav-links a::after { content: ''; position: absolute; bottom: -4px; left: 0; width: 0; height: 1px; background: var(--blue-bright); transition: width 0.3s; }
    .nav-links a:hover { color: #fff; }
    .nav-links a:hover::after { width: 100%; }
    .nav-cta { font-size: 0.78rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; padding: 0.55rem 1.4rem; background: var(--blue); color: #fff; border: none; border-radius: 4px; cursor: none; transition: background 0.3s, box-shadow 0.3s; text-decoration: none; }
    .nav-cta:hover { background: var(--blue-bright); box-shadow: 0 0 24px var(--blue-glow); }
    .hamburger { display: none; flex-direction: column; gap: 5px; cursor: none; background: none; border: none; }
    .hamburger span { display: block; width: 24px; height: 2px; background: var(--text); }

    #hero { position: relative; z-index: 1; min-height: 100vh; display: flex; align-items: center; padding: 0 2.5rem; overflow: hidden; }
    .hero-inner { max-width: 1200px; margin: 0 auto; width: 100%; padding-top: 6rem; }
    .hero-eyebrow { font-family: 'DM Mono', monospace; font-size: 0.78rem; letter-spacing: 0.2em; color: var(--blue-bright); text-transform: uppercase; display: flex; align-items: center; gap: 0.75rem; opacity: 0; transform: translateY(16px); animation: fadeUp 0.7s 0.2s forwards; }
    .hero-eyebrow::before { content: ''; display: block; width: 32px; height: 1px; background: var(--blue-bright); }
    .hero-title { font-family: 'Syne', sans-serif; font-size: clamp(3rem, 7vw, 6.5rem); font-weight: 800; line-height: 1.0; letter-spacing: -0.03em; color: #fff; margin: 1.2rem 0 0; opacity: 0; transform: translateY(20px); animation: fadeUp 0.7s 0.4s forwards; }
    .hero-title .accent { color: var(--blue-bright); font-family: 'Instrument Serif', serif; font-style: italic; font-weight: 400; }
    .hero-sub { font-size: 1.05rem; color: var(--muted); max-width: 500px; line-height: 1.7; margin-top: 1.5rem; opacity: 0; transform: translateY(20px); animation: fadeUp 0.7s 0.6s forwards; }
    .hero-actions { display: flex; gap: 1rem; margin-top: 2.5rem; flex-wrap: wrap; opacity: 0; transform: translateY(20px); animation: fadeUp 0.7s 0.8s forwards; }
    .btn-primary { padding: 0.85rem 2.2rem; background: var(--blue); color: #fff; border: none; border-radius: 4px; font-family: 'Syne', sans-serif; font-size: 0.85rem; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; cursor: none; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; transition: background 0.3s, box-shadow 0.3s, transform 0.2s; position: relative; overflow: hidden; }
    .btn-primary::before { content: ''; position: absolute; inset: 0; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent); transform: translateX(-100%); transition: transform 0.5s; }
    .btn-primary:hover::before { transform: translateX(100%); }
    .btn-primary:hover { background: var(--blue-bright); box-shadow: 0 0 32px var(--blue-glow); transform: translateY(-2px); }
    .btn-outline { padding: 0.85rem 2.2rem; background: transparent; color: var(--text); border: 1px solid var(--border); border-radius: 4px; font-family: 'Syne', sans-serif; font-size: 0.85rem; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; cursor: none; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; transition: border-color 0.3s, color 0.3s, box-shadow 0.3s, transform 0.2s; }
    .btn-outline:hover { border-color: var(--blue-bright); color: var(--blue-bright); box-shadow: 0 0 20px var(--blue-glow); transform: translateY(-2px); }
    .hero-stats { display: flex; gap: 3rem; margin-top: 4rem; opacity: 0; transform: translateY(20px); animation: fadeUp 0.7s 1s forwards; }
    .stat-num { font-size: 2.2rem; font-weight: 800; color: #fff; line-height: 1; }
    .stat-num span { color: var(--blue-bright); }
    .stat-label { font-size: 0.75rem; color: var(--muted); text-transform: uppercase; letter-spacing: 0.12em; margin-top: 0.3rem; }

    section { position: relative; z-index: 1; padding: 7rem 2.5rem; }
    .container { max-width: 1200px; margin: 0 auto; }
    .section-label { font-family: 'DM Mono', monospace; font-size: 0.72rem; letter-spacing: 0.22em; color: var(--blue-bright); text-transform: uppercase; display: flex; align-items: center; gap: 0.75rem; }
    .section-label::before { content: ''; display: block; width: 24px; height: 1px; background: var(--blue-bright); }
    .section-title { font-size: clamp(2rem, 4vw, 3.2rem); font-weight: 800; letter-spacing: -0.03em; color: #fff; margin-top: 0.75rem; line-height: 1.1; }
    .section-title em { font-family: 'Instrument Serif', serif; font-style: italic; font-weight: 400; color: var(--blue-bright); }

    #about { background: var(--surface); }
    .about-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 5rem; align-items: center; margin-top: 4rem; }
    .about-img-inner { width: 100%; aspect-ratio: 4/5; background: linear-gradient(135deg, var(--surface2), #1a2d50); border-radius: 2px; border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; font-size: 6rem; position: relative; overflow: hidden; }
    .about-img-inner::before { content: ''; position: absolute; inset: 0; background: linear-gradient(180deg, transparent 60%, rgba(59,130,246,0.15)); }
    .about-img-corner { position: absolute; width: 80px; height: 80px; border: 2px solid var(--blue); }
    .tl { top: -12px; left: -12px; border-right: none; border-bottom: none; }
    .br { bottom: -12px; right: -12px; border-left: none; border-top: none; }
    .about-badge { position: absolute; bottom: -20px; right: -20px; background: var(--blue); color: #fff; padding: 1rem 1.4rem; border-radius: 4px; font-size: 0.75rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; box-shadow: 0 0 30px var(--blue-glow); }
    .about-badge .num { font-size: 2rem; font-weight: 800; display: block; letter-spacing: -0.02em; }
    .about-img-wrap { position: relative; }
    .about-text p { color: var(--muted); line-height: 1.8; margin-bottom: 1rem; font-size: 1rem; }
    .about-text p strong { color: var(--text); }
    .about-tags { display: flex; flex-wrap: wrap; gap: 0.6rem; margin-top: 1.5rem; }
    .tag { font-family: 'DM Mono', monospace; font-size: 0.72rem; color: var(--blue-bright); background: rgba(59,130,246,0.1); border: 1px solid var(--border); padding: 0.3rem 0.8rem; border-radius: 2px; transition: background 0.3s; }
    .tag:hover { background: rgba(59,130,246,0.2); }

    #skills { background: var(--dark); }
    .skills-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; margin-top: 4rem; }
    .skill-card { background: var(--surface); border: 1px solid var(--border); border-radius: 4px; padding: 2rem; transition: border-color 0.3s, box-shadow 0.3s, transform 0.3s; position: relative; overflow: hidden; }
    .skill-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, transparent, var(--blue), transparent); transform: scaleX(0); transition: transform 0.4s; }
    .skill-card:hover { border-color: var(--blue); box-shadow: 0 0 40px rgba(59,130,246,0.1); transform: translateY(-4px); }
    .skill-card:hover::before { transform: scaleX(1); }
    .skill-cat { font-size: 0.7rem; font-weight: 700; letter-spacing: 0.18em; text-transform: uppercase; color: var(--blue-bright); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem; }
    .skill-cat::before { content: ''; display: block; width: 12px; height: 12px; border: 2px solid var(--blue); border-radius: 2px; }
    .skill-item { margin-bottom: 1.2rem; }
    .skill-name { font-size: 0.85rem; color: var(--text); margin-bottom: 0.45rem; display: flex; justify-content: space-between; }
    .skill-pct { font-family: 'DM Mono', monospace; font-size: 0.72rem; color: var(--muted); }
    .skill-bar-bg { height: 3px; background: rgba(59,130,246,0.12); border-radius: 2px; overflow: hidden; }
    .skill-bar { height: 100%; background: linear-gradient(90deg, var(--blue), var(--blue-bright)); border-radius: 2px; width: 0; transition: width 1.2s cubic-bezier(.4,0,.2,1); box-shadow: 0 0 8px var(--blue-glow); }

    #projects { background: var(--surface); }
    .projects-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; margin-top: 4rem; }
    .project-card { background: var(--dark); border: 1px solid var(--border); border-radius: 4px; overflow: hidden; transition: border-color 0.3s, box-shadow 0.3s, transform 0.3s; display: flex; flex-direction: column; cursor: none; }
    .project-card:hover { border-color: var(--blue); box-shadow: 0 0 50px rgba(59,130,246,0.12); transform: translateY(-6px); }
    .project-thumb { height: 180px; display: flex; align-items: center; justify-content: center; font-size: 3.5rem; position: relative; overflow: hidden; }
    .project-thumb span { position: relative; z-index: 1; }
    .project-body { padding: 1.5rem; flex: 1; display: flex; flex-direction: column; }
    .project-tags { display: flex; gap: 0.5rem; flex-wrap: wrap; margin-bottom: 1rem; }
    .project-tag { font-family: 'DM Mono', monospace; font-size: 0.65rem; letter-spacing: 0.1em; text-transform: uppercase; padding: 0.2rem 0.6rem; border-radius: 2px; }
    .project-title { font-size: 1.15rem; font-weight: 700; color: #fff; margin-bottom: 0.6rem; }
    .project-desc { font-size: 0.85rem; color: var(--muted); line-height: 1.7; flex: 1; }
    .project-tech { display: flex; flex-wrap: wrap; gap: 0.4rem; margin-top: 1.2rem; }
    .tech-pill { font-family: 'DM Mono', monospace; font-size: 0.65rem; color: var(--muted); border: 1px solid rgba(100,116,139,0.3); padding: 0.2rem 0.55rem; border-radius: 2px; }
    .project-links { display: flex; gap: 0.75rem; margin-top: 1.4rem; }
    .proj-btn { font-family: 'Syne', sans-serif; font-size: 0.72rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; padding: 0.5rem 1rem; border-radius: 3px; cursor: none; text-decoration: none; transition: all 0.3s; }
    .proj-btn-primary { background: var(--blue); color: #fff; border: 1px solid var(--blue); }
    .proj-btn-primary:hover { background: var(--blue-bright); box-shadow: 0 0 16px var(--blue-glow); }
    .proj-btn-ghost { background: transparent; color: var(--muted); border: 1px solid var(--border); }
    .proj-btn-ghost:hover { color: #fff; border-color: var(--muted); }

    #contact { background: var(--dark); }
    .contact-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 5rem; margin-top: 4rem; align-items: start; }
    .contact-info h3 { font-size: 1.6rem; font-weight: 700; color: #fff; margin-bottom: 1rem; }
    .contact-info p { color: var(--muted); line-height: 1.8; }
    .contact-items { margin-top: 2rem; display: flex; flex-direction: column; gap: 1rem; }
    .contact-item { display: flex; align-items: center; gap: 1rem; padding: 1rem 1.2rem; background: var(--surface); border: 1px solid var(--border); border-radius: 4px; transition: border-color 0.3s; text-decoration: none; }
    .contact-item:hover { border-color: var(--blue); }
    .contact-icon { width: 36px; height: 36px; border-radius: 4px; background: rgba(59,130,246,0.15); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; font-size: 1rem; flex-shrink: 0; }
    .contact-item-label { font-size: 0.7rem; color: var(--muted); text-transform: uppercase; letter-spacing: 0.1em; }
    .contact-item-val { font-size: 0.9rem; color: var(--text); font-weight: 600; }
    .form-group { margin-bottom: 1.2rem; }
    .form-group label { display: block; font-size: 0.72rem; font-weight: 600; letter-spacing: 0.12em; text-transform: uppercase; color: var(--muted); margin-bottom: 0.5rem; }
    .form-group input, .form-group textarea { width: 100%; background: var(--surface); border: 1px solid var(--border); border-radius: 4px; padding: 0.85rem 1rem; color: var(--text); font-family: 'Syne', sans-serif; font-size: 0.9rem; outline: none; transition: border-color 0.3s, box-shadow 0.3s; resize: none; }
    .form-group input:focus, .form-group textarea:focus { border-color: var(--blue); box-shadow: 0 0 0 3px rgba(59,130,246,0.12); }
    .form-group textarea { min-height: 130px; }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    .form-submit { width: 100%; padding: 1rem; background: var(--blue); color: #fff; border: none; border-radius: 4px; font-family: 'Syne', sans-serif; font-size: 0.85rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; cursor: none; transition: background 0.3s, box-shadow 0.3s, transform 0.2s; }
    .form-submit:hover { background: var(--blue-bright); box-shadow: 0 0 32px var(--blue-glow); transform: translateY(-1px); }

    footer { position: relative; z-index: 1; background: var(--surface); border-top: 1px solid var(--border); padding: 3rem 2.5rem; }
    .footer-inner { max-width: 1200px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1.5rem; }
    .footer-logo { font-family: 'Instrument Serif', serif; font-size: 1.4rem; color: #fff; }
    .footer-logo span { color: var(--blue-bright); }
    .footer-copy { font-size: 0.78rem; color: var(--muted); }
    .footer-socials { display: flex; gap: 1rem; }
    .social-btn { width: 36px; height: 36px; border-radius: 4px; background: var(--dark); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; font-size: 1rem; transition: border-color 0.3s, box-shadow 0.3s; text-decoration: none; }
    .social-btn:hover { border-color: var(--blue); box-shadow: 0 0 16px var(--blue-glow); }

    .grid-line { position: absolute; top: 0; left: 50%; width: 1px; height: 100%; background: linear-gradient(180deg, transparent, var(--border), transparent); pointer-events: none; }

    .reveal { opacity: 0; transform: translateY(30px); transition: opacity 0.7s, transform 0.7s; }
    .reveal.visible { opacity: 1; transform: translateY(0); }

    @keyframes fadeUp { to { opacity: 1; transform: translateY(0); } }
    @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-12px); } }
    .float-anim { animation: float 5s ease-in-out infinite; }

    body::after { content: ''; position: fixed; inset: 0; z-index: 200; background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E"); opacity: 0.018; pointer-events: none; }
    @media (max-width: 768px) {
      #cursor {
        display: none !important;
      }
    }
    @media (max-width: 900px) {
      #cursor {display: none !important;}
      .skills-grid, .projects-grid { grid-template-columns: 1fr 1fr; }
      .about-grid, .contact-grid { grid-template-columns: 1fr; gap: 3rem; }
    }
    @media (max-width: 640px) {
      #cursor {display: none !important;}
      nav { padding: 1rem 1.25rem; }
      .nav-links, .nav-cta { display: none; }
      .hamburger { display: flex; }
      section { padding: 5rem 1.25rem; }
      .skills-grid, .projects-grid { grid-template-columns: 1fr; }
      .hero-stats { gap: 2rem; flex-wrap: wrap; }
      .form-row { grid-template-columns: 1fr; }
      .footer-inner { flex-direction: column; text-align: center; align-items: center; }
    }
    
    /* Fixed mobile menu styles */
    .mobile-menu { 
      display: none; 
      position: fixed; 
      inset: 0; 
      z-index: 999; 
      background: rgba(8,12,20,0.98); 
      backdrop-filter: blur(10px);
      flex-direction: column; 
      align-items: center; 
      justify-content: center; 
      gap: 2rem; 
    }
    .mobile-menu.open { 
      display: flex !important; 
    }
    .mobile-menu a { 
      font-size: 2rem; 
      font-weight: 700; 
      color: var(--text); 
      text-decoration: none; 
      transition: color 0.3s; 
    }
    .mobile-menu a:hover { 
      color: var(--blue-bright); 
    }
    .mobile-menu .close-btn { 
      position: absolute; 
      top: 1.5rem; 
      right: 1.5rem; 
      background: none; 
      border: none; 
      font-size: 2rem; 
      color: var(--muted); 
      cursor: none; 
      transition: color 0.3s;
      z-index: 1000;
    }
    .mobile-menu .close-btn:hover {
      color: var(--blue-bright);
    }

    .about-img-inner img { width:100%; height:100%; object-fit:cover; }
    .project-thumb img   { width:100%; height:100%; object-fit:cover; }
    .field-error { font-size:0.72rem; color:#f87171; margin-top:0.35rem; }
    .alert-success { background:rgba(16,185,129,0.1); border:1px solid rgba(16,185,129,0.3); color:#34d399; padding:1rem 1.25rem; border-radius:4px; margin-bottom:1.5rem; font-size:0.88rem; }
    .nav-links a.active { color:#fff; }
    .nav-links a.active::after { width:100%; }
  </style>
</head>
<body>

{{-- Custom Cursor --}}
<div id="cursor"><div class="dot"></div><div class="ring"></div></div>
<canvas id="bg-canvas"></canvas>

{{-- Mobile Menu with fixed close functionality --}}
<div class="mobile-menu" id="mobileMenu">
  <button class="close-btn" onclick="closeMobileMenu()">&#x2715;</button>
  <a href="{{ route('home') }}"     onclick="closeMobileMenu()">Home</a>
  <a href="{{ route('about') }}"    onclick="closeMobileMenu()">About</a>
  <a href="{{ route('skills') }}"   onclick="closeMobileMenu()">Skills</a>
  <a href="{{ route('projects') }}" onclick="closeMobileMenu()">Projects</a>
  <a href="{{ route('contact') }}"  onclick="closeMobileMenu()">Contact</a>
</div>

{{-- Navbar --}}
<nav id="navbar">
  <a href="{{ route('home') }}" class="nav-logo">KaungPyaeTheinTun<span>.</span></a>
  <ul class="nav-links">
    <li><a href="{{ route('home') }}"     class="{{ request()->routeIs('home')     ? 'active' : '' }}">Home</a></li>
    <li><a href="{{ route('about') }}"    class="{{ request()->routeIs('about')    ? 'active' : '' }}">About</a></li>
    <li><a href="{{ route('skills') }}"   class="{{ request()->routeIs('skills')   ? 'active' : '' }}">Skills</a></li>
    <li><a href="{{ route('projects') }}" class="{{ request()->routeIs('projects') ? 'active' : '' }}">Projects</a></li>
    <li><a href="{{ route('contact') }}"  class="{{ request()->routeIs('contact')  ? 'active' : '' }}">Contact</a></li>
  </ul>
  <a href="{{ route('contact') }}" class="nav-cta">Hire Me</a>
  <button class="hamburger" onclick="openMobileMenu()">
    <span></span><span></span><span></span>
  </button>
</nav>

{{-- Page Content --}}
@yield('content')

{{-- Footer --}}
<footer>
  <div class="footer-inner">
    <div class="footer-logo">KaungPyaeTheinTun<span>.</span></div>
    <div class="footer-copy">&copy; {{ date('Y') }} KaungPyaeTheinTun. Crafted with Laravel.</div>
    <div class="footer-socials">
      <a href="https://github.com/KaungPyaeTheinTun" target="_blank" class="social-btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path>
        </svg>
      </a>
      <a href="https://linkedin.com/in/yourname" target="_blank" class="social-btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
          <rect x="2" y="9" width="4" height="12"></rect>
          <circle cx="4" cy="4" r="2"></circle>
        </svg>
      </a>
      <a href="https://twitter.com/yourname" target="_blank" class="social-btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"></path>
        </svg>
      </a>
      <a href="mailto:kaungpyaethaintun@gmail.com" class="social-btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
          <polyline points="22,6 12,13 2,6"></polyline>
        </svg>
      </a>
    </div>
  </div>
</footer>
@stack('scripts')
<script>
  // Custom Cursor
  const cursor = document.getElementById('cursor');
  const dot = cursor.querySelector('.dot');
  const ring = cursor.querySelector('.ring');
  let mx = 0, my = 0;
  document.addEventListener('mousemove', e => { mx = e.clientX; my = e.clientY; });
  (function animCursor() {
    cursor.style.left = mx + 'px';
    cursor.style.top = my + 'px';
    requestAnimationFrame(animCursor);
  })();

  // Navbar scroll effect
  window.addEventListener('scroll', () => {
    document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 50);
  });

  // Particle Canvas
  const canvas = document.getElementById('bg-canvas');
  const ctx = canvas.getContext('2d');
  let W, H, particles = [];
  function resize() { W = canvas.width = window.innerWidth; H = canvas.height = window.innerHeight; }
  resize(); window.addEventListener('resize', resize);

  function Particle() {
    this.reset = function() {
      this.x = Math.random() * W; this.y = Math.random() * H;
      this.vx = (Math.random()-.5)*.3; this.vy = (Math.random()-.5)*.3;
      this.r = Math.random()*1.5+.3; this.a = Math.random()*.4+.1;
    };
    this.reset();
    this.update = function() {
      this.x += this.vx; this.y += this.vy;
      if(this.x<0||this.x>W||this.y<0||this.y>H) this.reset();
    };
    this.draw = function() {
      ctx.beginPath(); ctx.arc(this.x,this.y,this.r,0,Math.PI*2);
      ctx.fillStyle = 'rgba(59,130,246,'+this.a+')'; ctx.fill();
    };
  }
  for(let i=0;i<130;i++) particles.push(new Particle());

  (function animCanvas() {
    ctx.clearRect(0,0,W,H);
    for(let i=0;i<particles.length;i++){
      particles[i].update(); particles[i].draw();
      for(let j=i+1;j<particles.length;j++){
        const dx=particles[i].x-particles[j].x, dy=particles[i].y-particles[j].y;
        const d=Math.sqrt(dx*dx+dy*dy);
        if(d<110){ ctx.beginPath(); ctx.moveTo(particles[i].x,particles[i].y); ctx.lineTo(particles[j].x,particles[j].y);
          ctx.strokeStyle='rgba(59,130,246,'+(0.07*(1-d/110))+')'; ctx.lineWidth=.5; ctx.stroke(); }
      }
    }
    requestAnimationFrame(animCanvas);
  })();

  // Scroll reveal
  const obs = new IntersectionObserver(entries => {
    entries.forEach(e => { if(e.isIntersecting) e.target.classList.add('visible'); });
  }, {threshold: 0.1});
  document.querySelectorAll('.reveal').forEach(el => obs.observe(el));

  // Skill bars
  const barObs = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if(e.isIntersecting) e.target.querySelectorAll('.skill-bar').forEach(b => { b.style.width = b.dataset.w + '%'; });
    });
  }, {threshold: 0.2});
  document.querySelectorAll('.skill-card').forEach(c => barObs.observe(c));

  // Fixed Mobile Menu Functions
  function openMobileMenu() {
    document.getElementById('mobileMenu').classList.add('open');
    document.body.style.overflow = 'hidden'; // Prevent scrolling when menu is open
  }

  function closeMobileMenu() {
    document.getElementById('mobileMenu').classList.remove('open');
    document.body.style.overflow = ''; // Restore scrolling
  }

  // Make functions globally available
  window.openMobileMenu = openMobileMenu;
  window.closeMobileMenu = closeMobileMenu;

  // Close mobile menu when clicking outside (optional - but we have close button)
  document.addEventListener('click', function(e) {
    const menu = document.getElementById('mobileMenu');
    const hamburger = document.querySelector('.hamburger');
    
    if (menu.classList.contains('open') && 
        !menu.contains(e.target) && 
        !hamburger.contains(e.target)) {
      closeMobileMenu();
    }
  });

  // Handle escape key to close menu
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      closeMobileMenu();
    }
  });

  // Form submit
  const submitBtn = document.getElementById('submitBtn');
  if (submitBtn) {
    submitBtn.addEventListener('click', function() {
      var btn = this; btn.textContent = 'Sending...'; btn.style.opacity = '0.7';
      setTimeout(function() {
        btn.textContent = '\u2713 Message Sent!'; btn.style.background = '#059669'; btn.style.opacity = '1';
        setTimeout(function() { btn.innerHTML = 'Send Message &rarr;'; btn.style.background = ''; }, 3000);
      }, 1500);
    });
  }

  // Scrollspy
  const sections = document.querySelectorAll('section[id]');
  const navLinks = document.querySelectorAll('.nav-links a');
  window.addEventListener('scroll', function() {
    var current = '';
    sections.forEach(function(s) { if(window.scrollY >= s.offsetTop - 120) current = s.id; });
    navLinks.forEach(function(a) { 
      a.style.color = a.getAttribute('href') === '#'+current ? '#fff' : ''; 
    });
  });
</script>
</body>
</html>