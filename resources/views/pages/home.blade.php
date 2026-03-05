@extends('layouts.app')
@section('title', 'KaungPyaeTheinTUn — Full Stack Developer')

@section('content')

<style>
/* Responsive Styles */
:root {
    --hero-padding: 0 2.5rem;
    --container-max-width: 1200px;
}

/* Tablet & Mobile Adjustments */
@media (max-width: 1024px) {
    #hero {
        padding: 0 2rem !important;
        min-height: auto !important;
        padding-top: 4rem !important;
        padding-bottom: 4rem !important;
    }
    
    #hero > div {
        grid-template-columns: 1fr !important;
        gap: 3rem !important;
        padding-top: 2rem !important;
    }
    
    .hero-title {
        font-size: clamp(2.5rem, 8vw, 4.5rem) !important;
    }
    
    .hero-actions {
        flex-wrap: wrap !important;
    }
}

@media (max-width: 768px) {
    #hero {
        padding: 0 1.5rem !important;
    }
    
    .hero-stats {
        flex-direction: column !important;
        gap: 1rem !important;
        align-items: flex-start !important;
    }
    
    .hero-stats > div {
        width: 100% !important;
    }
    
    .hero-actions {
        flex-direction: column !important;
        align-items: stretch !important;
    }
    
    .hero-actions a {
        text-align: center !important;
        justify-content: center !important;
    }
    
    /* Projects section */
    #projects {
        padding: 4rem 1.5rem !important;
    }
    
    #projects .container > div:first-of-type {
        flex-direction: column !important;
        align-items: flex-start !important;
    }
    
    #slider-inner > div {
        grid-template-columns: 1fr !important;
    }
    
    /* Slider buttons adjustment */
    #btn-prev, #btn-next {
        width: 36px !important;
        height: 36px !important;
        font-size: 1rem !important;
    }
    
    #btn-prev {
        left: -1rem !important;
    }
    
    #btn-next {
        right: -1rem !important;
    }
    
    /* Floating badges reposition */
    #hero [style*="position:absolute"] {
        transform: scale(0.9) !important;
    }
    
    #hero [style*="bottom:10px"] {
        bottom: 0 !important;
        right: 0 !important;
    }
    
    #hero [style*="top:10px"] {
        top: 0 !important;
        left: 0 !important;
    }
}

@media (max-width: 480px) {
    #hero {
        padding: 0 1rem !important;
    }
    
    .hero-title {
        font-size: clamp(2rem, 7vw, 3rem) !important;
    }
    
    .hero-eyebrow {
        font-size: 0.7rem !important;
        flex-wrap: wrap !important;
    }
    
    #hero [style*="width:320px"] {
        width: 250px !important;
        height: 250px !important;
    }
    
    .project-card {
        margin: 0 !important;
    }
    
    .project-links {
        flex-direction: column !important;
        gap: 0.5rem !important;
    }
    
    .project-links a {
        width: 100% !important;
        text-align: center !important;
    }
    
    #btn-prev {
        left: -0.5rem !important;
    }
    
    #btn-next {
        right: -0.5rem !important;
    }
    
    #btn-prev, #btn-next {
        width: 32px !important;
        height: 32px !important;
        opacity: 0.8 !important;
    }
}

/* Fix floating badges position on mobile */
@media (max-width: 600px) {
    #hero [style*="bottom:10px"] {
        padding: 0.4rem 0.8rem !important;
    }
    
    #hero [style*="top:10px"] {
        padding: 0.4rem 0.8rem !important;
    }
    
    #hero [style*="top:10px"] > div:first-child {
        font-size: 1rem !important;
    }
}

/* Touch-friendly adjustments */
@media (hover: none) and (pointer: coarse) {
    .project-card:hover {
        transform: none !important;
    }
    
    #btn-prev, #btn-next {
        opacity: 0.8 !important;
    }
}

/* Landscape mode adjustments */
@media (max-height: 600px) and (orientation: landscape) {
    #hero {
        min-height: auto !important;
        padding: 2rem 2rem !important;
    }
    
    #hero > div {
        padding-top: 0 !important;
    }
}

/* Project card responsive styles */
.project-card {
    width: 100% !important;
    margin: 0 !important;
}

.project-thumb {
    width: 100% !important;
    aspect-ratio: 16/9 !important;
}

.project-body {
    padding: 1.5rem !important;
}

.project-tech {
    flex-wrap: wrap !important;
}

/* Slider container fix */
#slider-track {
    overflow: hidden !important;
    width: 100% !important;
}

/* Disable slider on mobile - show all projects as grid */
@media (max-width: 768px) {
    /* Remove slider functionality */
    #slider-inner {
        transform: none !important;
        display: grid !important;
        grid-template-columns: 1fr !important;
        gap: 1.5rem !important;
    }
    
    #slider-inner > div {
        min-width: 100% !important;
        display: grid !important;
        grid-template-columns: 1fr !important;
        gap: 1.5rem !important;
        margin-bottom: 1.5rem !important;
    }
    
    /* Hide slider controls */
    #btn-prev,
    #btn-next,
    #slider-dots,
    #slide-counter {
        display: none !important;
    }
    
    /* Make all slides visible */
    #slider-track {
        overflow: visible !important;
        height: auto !important;
    }
    
    /* Remove any transform animations */
    #slider-inner {
        transition: none !important;
    }
}
</style>

<!-- HERO -->
<section id="hero" style="min-height:100vh;display:flex;align-items:center;padding:0 2.5rem;position:relative;z-index:1;overflow:hidden;">
  <div style="max-width:1200px;margin:0 auto;width:100%;padding-top:6rem;display:grid;grid-template-columns:1fr 1fr;gap:4rem;align-items:center;">

    <!-- LEFT: Text -->
    <div>
      <p class="hero-eyebrow" style="font-family:'DM Mono',monospace;font-size:0.8rem;color:var(--blue-bright);letter-spacing:0.2em;text-transform:uppercase;margin-bottom:1.5rem;">Available for work &nbsp;&middot;&nbsp; Based in Yangon</p>

      <h1 class="hero-title" style="font-size:clamp(3rem, 6vw, 4.5rem);font-weight:800;line-height:1.1;letter-spacing:-0.03em;color:#fff;margin-bottom:1.5rem;">
        Full Stack<br>
        <span class="accent" style="color:var(--blue-bright);">Developer</span>
      </h1>

      <p class="hero-sub" style="font-size:clamp(1rem, 2vw, 1.2rem);color:var(--muted);margin-bottom:2rem;max-width:500px;">
        I craft high-performance web applications from pixel-perfect frontends
        to scalable distributed backends &mdash; with a bias for clean code and exceptional UX.
      </p>

      <div class="hero-actions" style="display:flex;gap:1rem;margin-bottom:3rem;">
        <a href="#projects" class="btn-primary" style="display:inline-flex;align-items:center;gap:0.5rem;background:var(--blue);color:#fff;padding:0.8rem 2rem;border-radius:6px;font-size:0.9rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;text-decoration:none;transition:all 0.2s;">View Projects &rarr;</a>
        <a href="{{ route('contact') }}" class="btn-outline" style="display:inline-flex;align-items:center;gap:0.5rem;background:transparent;color:#fff;padding:0.8rem 2rem;border-radius:6px;font-size:0.9rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;text-decoration:none;border:1px solid var(--border);transition:all 0.2s;">Let&rsquo;s Talk</a>
      </div>

      <div class="hero-stats" style="display:flex;gap:3rem;">
        <div>
          <div class="stat-num" style="font-size:2.5rem;font-weight:800;color:#fff;line-height:1;">2<span style="color:var(--blue-bright);">+</span></div>
          <div class="stat-label" style="font-size:0.8rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.1em;">Years Experience</div>
        </div>
        <div>
          <div class="stat-num" style="font-size:2.5rem;font-weight:800;color:#fff;line-height:1;">{{ $totalProjects }}<span style="color:var(--blue-bright);">+</span></div>
          <div class="stat-label" style="font-size:0.8rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.1em;">Projects Shipped</div>
        </div>
      </div>
    </div>

    <!-- RIGHT: Profile Image -->
    <div style="display:flex;justify-content:center;align-items:center;opacity:0;transform:translateY(24px);animation:fadeUp 0.8s 0.6s forwards;">
      <div style="position:relative;">

        <!-- Glow ring behind image -->
        <div style="position:absolute;inset:-3px;border-radius:50%;background:conic-gradient(from 0deg,var(--blue),#8b5cf6,#06b6d4,var(--blue));animation:spinRing 6s linear infinite;z-index:0;"></div>
        <div style="position:absolute;inset:3px;border-radius:50%;background:var(--dark);z-index:1;"></div>

        <!-- Profile photo -->
        <div style="position:relative;z-index:2;width:320px;height:320px;border-radius:50%;overflow:hidden;border:4px solid var(--dark);">
          @if(file_exists(public_path('images/p.jpeg')))
          <img src="{{ asset('images/p.jpeg') }}"
            alt="KaungPyaeTheinTun"
            style="width:100%;height:100%;object-fit:cover;object-position:top;">
          @else
          <!-- Placeholder when no image uploaded yet -->
          <div style="width:100%;height:100%;background:linear-gradient(135deg,var(--surface2),#1a2d50);display:flex;align-items:center;justify-content:center;flex-direction:column;gap:0.5rem;">
            <div style="font-size:4rem;">&#x1F468;&#x200D;&#x1F4BB;</div>
            <div style="font-family:'DM Mono',monospace;font-size:0.65rem;color:var(--blue-bright);letter-spacing:0.15em;text-transform:uppercase;">Add profile.jpg</div>
          </div>
          @endif
        </div>

        <!-- Floating badge: Available -->
        <div style="position:absolute;bottom:10px;right:-10px;z-index:3;background:var(--surface);border:1px solid var(--border);border-radius:8px;padding:0.6rem 1rem;display:flex;align-items:center;gap:0.5rem;box-shadow:0 8px 32px rgba(0,0,0,0.4);animation:float 4s ease-in-out infinite;">
          <div style="width:8px;height:8px;background:#10b981;border-radius:50%;box-shadow:0 0 8px #10b981;flex-shrink:0;"></div>
          <div>
            <div style="font-size:0.7rem;font-weight:700;color:#fff;white-space:nowrap;">Available for work</div>
            <div style="font-family:'DM Mono',monospace;font-size:0.6rem;color:var(--muted);">Full Stack Dev</div>
          </div>
        </div>

        <!-- Floating badge: Experience -->
        <div style="position:absolute;top:10px;left:-20px;z-index:3;background:var(--blue);border-radius:8px;padding:0.6rem 1rem;box-shadow:0 8px 32px rgba(59,130,246,0.4);animation:float 4s ease-in-out 1s infinite;">
          <div style="font-size:1.3rem;font-weight:800;color:#fff;line-height:1;">2<span style="font-size:0.8rem;">+</span></div>
          <div style="font-family:'DM Mono',monospace;font-size:0.58rem;color:rgba(255,255,255,0.7);text-transform:uppercase;letter-spacing:0.1em;margin-top:0.1rem;">Yrs Exp</div>
        </div>

        <!-- Corner brackets decoration -->
        <div style="position:absolute;top:-16px;right:-16px;width:32px;height:32px;border-top:2px solid var(--blue-bright);border-right:2px solid var(--blue-bright);border-radius:0 4px 0 0;z-index:3;"></div>
        <div style="position:absolute;bottom:-16px;left:-16px;width:32px;height:32px;border-bottom:2px solid var(--blue-bright);border-left:2px solid var(--blue-bright);border-radius:0 0 0 4px;z-index:3;"></div>

      </div>
    </div>

  </div>
</section>

<!-- Scroll indicator -->
<div style="position:absolute;bottom:2.5rem;left:50%;transform:translateX(-50%);z-index:2;display:flex;flex-direction:column;align-items:center;gap:0.5rem;opacity:0;animation:fadeUp 0.6s 1.4s forwards;">
  <div style="font-family:'DM Mono',monospace;font-size:0.62rem;letter-spacing:0.2em;color:var(--muted);text-transform:uppercase;">Scroll</div>
  <div style="width:1px;height:40px;background:linear-gradient(180deg,var(--blue-bright),transparent);animation:scrollPulse 1.8s ease-in-out infinite;"></div>
</div>

<!-- ALL PROJECTS SLIDER -->
@if($allProjects->isNotEmpty())

@php
$gradients = [
'#1e3a5f,#0d2640',
'#2d1b69,#1a0f40',
'#1a3a2a,#0d2419',
'#3a1a1a,#2d1010',
'#1a2a3a,#0d1a26',
'#2a1a3a,#1a0d26',
];
$chunks = $allProjects->chunk(3);
$totalSlides = $chunks->count();
@endphp

<section id="projects" style="background:var(--surface);padding:7rem 2.5rem;">
  <div class="grid-line"></div>
  <div class="container" style="max-width:1200px;margin:0 auto;">

    <!-- Section Header -->
    <div class="section-label reveal" style="font-family:'DM Mono',monospace;font-size:0.8rem;color:var(--blue-bright);letter-spacing:0.2em;text-transform:uppercase;">Selected Work</div>
    <div style="display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:1rem;margin-top:0.75rem;margin-bottom:3rem;">
      <h2 class="section-title" style="margin-top:0;font-size:clamp(1.8rem,4vw,2.5rem);font-weight:700;color:#fff;">Projects I&rsquo;m <em style="color:var(--blue-bright);">proud</em> of</h2>
      <a href="{{ route('projects') }}"
        style="font-family:'DM Mono',monospace;font-size:0.72rem;letter-spacing:0.15em;text-transform:uppercase;color:var(--blue-bright);text-decoration:none;display:flex;align-items:center;gap:0.4rem;transition:gap 0.2s;"
        onmouseover="this.style.gap='0.7rem'"
        onmouseout="this.style.gap='0.4rem'">
        View All &rarr;
      </a>
    </div>

    <!-- Slider Wrapper -->
    <div style="position:relative;padding:0 0.5rem;">

      <!-- Track -->
      <div id="slider-track" style="overflow:hidden;border-radius:4px;width:100%;">
        <div id="slider-inner"
          style="display:flex;transition:transform 0.55s cubic-bezier(.4,0,.2,1);">

          @foreach($chunks as $slideIndex => $chunk)
          <!-- Slide {{ $slideIndex }} -->
          <div style="min-width:100%;display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem;padding-bottom:1rem;box-sizing:border-box;">

            @foreach($chunk as $cardIndex => $project)
            @php $gi = ($slideIndex * 3 + $cardIndex) % 6; @endphp
            <div class="project-card" style="background:var(--dark);border:1px solid var(--border);border-radius:6px;overflow:hidden;transition:transform 0.3s, box-shadow 0.3s;">
              <!-- Thumbnail -->
              <div class="project-thumb"
                style="background:linear-gradient(135deg,{{ $gradients[$gi] }});height:180px;display:flex;align-items:center;justify-content:center;font-size:2.5rem;">
                @if($project->screenshot)
                <img src="{{ $project->screenshot_url }}" alt="{{ $project->title }}" style="width:100%;height:100%;object-fit:cover;">
                @else
                <span class="thumb-icon">&#x1F5A5;&#xFE0F;</span>
                @endif
              </div>

              <!-- Body -->
              <div class="project-body" style="padding:1.5rem;">
                <div class="project-tags" style="display:flex;gap:0.5rem;margin-bottom:1rem;">
                  <span class="project-tag" style="font-size:0.65rem;padding:0.2rem 0.6rem;border-radius:2px;background:rgba(59,130,246,0.15);color:#60a5fa;">
                    Full Stack
                  </span>
                  @if($project->is_featured)
                  <span class="project-tag" style="font-size:0.65rem;padding:0.2rem 0.6rem;border-radius:2px;background:rgba(245,158,11,0.12);color:#fbbf24;">
                    &#x2605; Featured
                  </span>
                  @endif
                </div>
                <div class="project-title" style="font-size:1.1rem;font-weight:700;color:#fff;margin-bottom:0.5rem;">{{ $project->title }}</div>
                <div class="project-desc" style="font-size:0.85rem;color:var(--muted);margin-bottom:1rem;">{{ Str::limit($project->description, 110) }}</div>
                <div class="project-tech" style="display:flex;gap:0.3rem;margin-bottom:1.2rem;">
                  @foreach($project->technologies_array as $tech)
                  <span class="tech-pill" style="font-size:0.6rem;color:#60a5fa;background:rgba(59,130,246,0.12);padding:0.15rem 0.5rem;border-radius:2px;">{{ trim($tech) }}</span>
                  @endforeach
                </div>
                <div class="project-links" style="display:flex;gap:0.5rem;">
                  @if($project->live_demo)
                  <a href="{{ $project->live_demo }}" target="_blank" class="proj-btn proj-btn-primary" style="display:inline-block;padding:0.4rem 1rem;background:rgba(59,130,246,0.1);border:1px solid rgba(59,130,246,0.2);border-radius:4px;color:#60a5fa;text-decoration:none;font-size:0.7rem;font-weight:600;transition:all 0.2s;">Live Demo</a>
                  @endif
                  @if($project->github_link)
                  <a href="{{ $project->github_link }}" target="_blank" class="proj-btn proj-btn-ghost" style="display:inline-block;padding:0.4rem 1rem;background:transparent;border:1px solid var(--border);border-radius:4px;color:var(--text);text-decoration:none;font-size:0.7rem;font-weight:600;transition:all 0.2s;">GitHub</a>
                  @endif
                  @if(!$project->live_demo && !$project->github_link)
                  <span class="proj-btn proj-btn-ghost" style="display:inline-block;padding:0.4rem 1rem;background:transparent;border:1px solid var(--border);border-radius:4px;color:var(--text);text-decoration:none;font-size:0.7rem;font-weight:600;opacity:0.4;cursor:default;">Coming Soon</span>
                  @endif
                </div>
              </div>
            </div>
            @endforeach

            {{-- Fill empty slots so grid stays 3-column --}}
            @for($e = $chunk->count(); $e < 3; $e++)
              <div>
          </div>
          @endfor

        </div>
        @endforeach

      </div><!-- /slider-inner -->
    </div><!-- /slider-track -->

    <!-- Prev Arrow -->
    <button id="btn-prev" onclick="slideProjects(-1)"
      style="position:absolute;top:50%;left:-1.75rem;transform:translateY(-60%);width:46px;height:46px;border-radius:50%;background:var(--dark);border:1px solid var(--border);color:var(--text);font-size:1.2rem;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all 0.25s;z-index:10;opacity:0.35;"
      onmouseover="this.style.borderColor='var(--blue)';this.style.color='var(--blue-bright)';this.style.opacity='1';this.style.boxShadow='0 0 24px var(--blue-glow)'"
      onmouseout="this.style.borderColor='var(--border)';this.style.color='var(--text)';this.style.opacity='0.35';this.style.boxShadow='none'">
      &#8592;
    </button>

    <!-- Next Arrow -->
    <button id="btn-next" onclick="slideProjects(1)"
      style="position:absolute;top:50%;right:-1.75rem;transform:translateY(-60%);width:46px;height:46px;border-radius:50%;background:var(--dark);border:1px solid var(--border);color:var(--text);font-size:1.2rem;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all 0.25s;z-index:10;"
      onmouseover="this.style.borderColor='var(--blue)';this.style.color='var(--blue-bright)';this.style.boxShadow='0 0 24px var(--blue-glow)'"
      onmouseout="this.style.borderColor='var(--border)';this.style.color='var(--text)';this.style.boxShadow='none'">
      &#8594;
    </button>

  </div><!-- /position:relative -->

  <!-- Dot Indicators -->
  @if($totalSlides > 1)
  <div id="slider-dots" style="display:flex;justify-content:center;align-items:center;gap:0.5rem;margin-top:2.5rem;">
    @for($i = 0; $i < $totalSlides; $i++)
      <button onclick="goToSlide({{ $i }})" id="dot-{{ $i }}"
      style="height:8px;border-radius:99px;border:none;cursor:pointer;transition:all 0.35s;padding:0;
                 width:{{ $i === 0 ? '28px' : '8px' }};
                 background:{{ $i === 0 ? 'var(--blue)' : 'rgba(59,130,246,0.25)' }};">
      </button>
      @endfor
  </div>
  @endif

  <!-- Slide Counter -->
  <div style="text-align:center;margin-top:1rem;">
    <span id="slide-counter"
      style="font-family:'DM Mono',monospace;font-size:0.72rem;color:var(--muted);letter-spacing:0.12em;">
      01 / {{ str_pad($totalSlides, 2, '0', STR_PAD_LEFT) }}
    </span>
  </div>

  </div>
</section>
@endif

@endsection


@push('scripts')
<script>
  document.addEventListener("DOMContentLoaded", function() {

    let current = 0;
    const total = {{ $totalSlides ?? 1 }};
    const inner = document.getElementById('slider-inner');
    const btnPrev = document.getElementById('btn-prev');
    const btnNext = document.getElementById('btn-next');
    const track = document.getElementById('slider-track');

    if (!inner) return; // stop if slider not found

    let autoTimer;

    function updateDots() {
      for (let i = 0; i < total; i++) {
        const dot = document.getElementById('dot-' + i);
        if (!dot) continue;

        dot.style.width = i === current ? '28px' : '8px';
        dot.style.background =
          i === current ? 'var(--blue)' : 'rgba(59,130,246,0.25)';
      }
    }

    function updateCounter() {
      const counter = document.getElementById('slide-counter');
      if (!counter) return;

      const pad = n => String(n).padStart(2, '0');
      counter.textContent = pad(current + 1) + ' / ' + pad(total);
    }

    function updateArrows() {
      if (btnPrev) btnPrev.style.opacity = current === 0 ? '0.35' : '1';
      if (btnNext) btnNext.style.opacity = current === total - 1 ? '0.35' : '1';
    }

    function goToSlide(index) {
      if (index < 0) index = total - 1;
      if (index >= total) index = 0;

      current = index;
      inner.style.transform = `translateX(-${current * 100}%)`;

      updateDots();
      updateCounter();
      updateArrows();
    }

    function slideProjects(dir) {
      stopAuto();
      goToSlide(current + dir);
      startAuto();
    }

    function startAuto() {
      autoTimer = setInterval(() => {
        goToSlide(current + 1);
      }, 5000);
    }

    function stopAuto() {
      if (autoTimer) clearInterval(autoTimer);
    }

    // Buttons
    window.slideProjects = slideProjects;
    window.goToSlide = function(index) {
      stopAuto();
      goToSlide(index);
      startAuto();
    };

    // Keyboard
    document.addEventListener('keydown', function(e) {
      if (e.key === 'ArrowLeft') slideProjects(-1);
      if (e.key === 'ArrowRight') slideProjects(1);
    });

    // Swipe
    if (track) {
      let startX = 0;

      track.addEventListener('touchstart', function(e) {
        startX = e.touches[0].clientX;
      }, {
        passive: true
      });

      track.addEventListener('touchend', function(e) {
        const diff = startX - e.changedTouches[0].clientX;

        if (Math.abs(diff) > 40) {
          slideProjects(diff > 0 ? 1 : -1);
        }
      });
    }

    // Init
    goToSlide(0);
    startAuto();

  });
</script>
@endpush