@extends('layouts.app')
@section('title', 'Projects — KaungPyaeTheinTun')

@section('content')

<section id="projects" style="padding-top:9rem;background:var(--surface);">
  <div class="container">

    {{-- Section Header --}}
    <div class="section-label reveal">003 &mdash; Selected Work</div>
    <h2 class="section-title reveal">Projects I&rsquo;m <em>proud</em> of</h2>

    {{-- Filter Bar --}}
    <div class="reveal" style="display:flex;flex-wrap:wrap;gap:0.6rem;margin-top:2.5rem;">
      <button onclick="filterProjects('all')" id="filter-all"
        style="font-family:'DM Mono',monospace;font-size:0.7rem;letter-spacing:0.12em;text-transform:uppercase;padding:0.4rem 1rem;border-radius:2px;border:1px solid var(--blue);background:var(--blue);color:#fff;cursor:pointer;transition:all 0.2s;">
        All ({{ $projects->total() }})
      </button>
    </div>

    {{-- Projects Grid --}}
    <div class="projects-grid" style="margin-top:2rem;">

      @forelse($projects as $index => $project)
      <div class="project-card reveal {{ $project->is_featured ? 'featured-project' : '' }}"
        style="transition-delay:{{ ($index % 3) * 0.1 }}s">

        {{-- Thumbnail --}}
        <div class="project-thumb"
          style="background:linear-gradient(135deg,
               {{ ['#1e3a5f,#0d2640','#2d1b69,#1a0f40','#1a3a2a,#0d2419','#3a1a1a,#2d1010','#1a2a3a,#0d1a26'][$index % 5] }})">
          @if($project->screenshot)
          <img src="{{ $project->screenshot_url }}" alt="{{ $project->title }}">
          @else
          <span class="thumb-icon">&#x1F5A5;&#xFE0F;</span>
          @endif
        </div>

        <div class="project-body">

          {{-- Tags --}}
          <div class="project-tags">
            <span class="project-tag"
              style="background:rgba(59,130,246,0.15);color:#60a5fa;">
              Full Stack
            </span>
            @if($project->is_featured)
            <span class="project-tag"
              style="background:rgba(245,158,11,0.12);color:#fbbf24;">
              &#x2605; Featured
            </span>
            @endif
          </div>

          {{-- Title --}}
          <div class="project-title">{{ $project->title }}</div>

          {{-- Description --}}
          <div class="project-desc">{{ $project->description }}</div>

          {{-- Tech Pills --}}
          <div class="project-tech">
            @foreach($project->technologies_array as $tech)
            <span class="tech-pill">{{ trim($tech) }}</span>
            @endforeach
          </div>

          {{-- Action Links --}}
          <div class="project-links">
            @if($project->live_demo)
            <a href="{{ $project->live_demo }}" target="_blank"
              rel="noopener noreferrer"
              class="proj-btn proj-btn-primary">
              Live Demo
            </a>
            @endif
            @if($project->github_link)
            <a href="{{ $project->github_link }}" target="_blank"
              rel="noopener noreferrer"
              class="proj-btn proj-btn-ghost">
              GitHub
            </a>
            @endif
            @if(!$project->live_demo && !$project->github_link)
            <span class="proj-btn proj-btn-ghost" style="opacity:0.4;cursor:default;">
              Coming Soon
            </span>
            @endif
          </div>

        </div>
      </div>
      @empty

      {{-- Empty State --}}
      <div style="grid-column:1/-1;text-align:center;padding:6rem 2rem;">
        <div style="font-size:3rem;margin-bottom:1.25rem; display:flex; justify-content:center;">
          <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="color: #60a5fa;">
            <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z" />
          </svg>
        </div>
        <div style="color:#fff;font-weight:700;font-size:1.2rem;margin-bottom:0.5rem;">
          Projects coming soon
        </div>
        <div style="color:var(--muted);font-size:0.9rem;">
          Check back soon — exciting work is on the way.
        </div>
      </div>

      @endforelse
    </div>

    {{-- Pagination --}}
    @if($projects->hasPages())
    <div style="display:flex;justify-content:center;gap:0.5rem;margin-top:3rem;">
      {{ $projects->links() }}
    </div>
    @endif

  </div>
</section>

@push('scripts')
<script>
  // Simple featured filter
  function filterProjects(type) {
    const cards = document.querySelectorAll('.project-card');
    const btnAll = document.getElementById('filter-all');
    const btnFeatured = document.getElementById('filter-featured');

    if (type === 'featured') {
      cards.forEach(c => {
        c.style.display = c.classList.contains('featured-project') ? 'flex' : 'none';
      });
      btnFeatured.style.background = 'var(--blue)';
      btnFeatured.style.color = '#fff';
      btnFeatured.style.borderColor = 'var(--blue)';
      btnAll.style.background = 'transparent';
      btnAll.style.color = 'var(--muted)';
      btnAll.style.borderColor = 'var(--border)';
    } else {
      cards.forEach(c => c.style.display = 'flex');
      btnAll.style.background = 'var(--blue)';
      btnAll.style.color = '#fff';
      btnAll.style.borderColor = 'var(--blue)';
      btnFeatured.style.background = 'transparent';
      btnFeatured.style.color = 'var(--muted)';
      btnFeatured.style.borderColor = 'var(--border)';
    }
  }
</script>
@endpush

@endsection