@extends('layouts.app')
@section('title', 'About — KaungPyaeTheinTun')

@section('content')
<section id="about" style="padding-top:9rem">
  <div class="container">
    <div class="section-label reveal">001 &mdash; About Me</div>
    <h2 class="section-title reveal">I build things that <em>matter</em></h2>
    <div class="about-grid">

      {{-- Profile Image --}}
      <div class="about-img-wrap reveal">
        <div class="about-img-inner float-anim">
          @if(file_exists(public_path('images/p.jpeg')))
          <img src="{{ asset('images/p.jpeg') }}" alt="KaungPyaeTheinTun">
          @else
          <span style="font-size:5rem;position:relative;z-index:1">&#x1F468;&#x200D;&#x1F4BB;</span>
          @endif
          <div style="position:absolute;bottom:0;left:0;right:0;padding:1.5rem;z-index:2;">
            <div style="height:2px;background:linear-gradient(90deg,var(--blue),transparent);margin-bottom:0.5rem;border-radius:1px;"></div>
            <div style="font-family:'DM Mono',monospace;font-size:0.65rem;color:var(--blue-bright);letter-spacing:0.15em;">AVAILABLE FOR PROJECTS</div>
          </div>
        </div>
        <div class="about-img-corner tl"></div>
        <div class="about-img-corner br"></div>
        <div class="about-badge">
          <span class="num">2+</span>
          Years of<br>Excellence
        </div>
      </div>

      {{-- Bio Text --}}
      <div class="about-text reveal" style="transition-delay:0.15s">
        <p>Hi, I&rsquo;m <strong>KaungPyaeTheinTun</strong> &mdash; a full-stack developer who obsesses over performance, scalability, and developer experience. I&rsquo;ve shipped production systems for startups and Fortune 500 companies alike.</p>
        <p>My approach is pragmatic: I choose the right tool for the job, write code that&rsquo;s a joy to maintain, and always keep the end-user at the center of every decision.</p>
        <p>When I&rsquo;m not shipping features, I&rsquo;m <strong>contributing to open source</strong>, writing technical deep-dives, or mentoring junior engineers through code review.</p>

        {{-- Tech Tags --}}
        <div class="about-tags">
          @foreach(['DigitalOcean','Docker','MySQL','Redis','Nginx','Laravel','PHP','ASP.NET','Vue.js','React.js'] as $tech)
          <span class="tag">{{ $tech }}</span>
          @endforeach
        </div>

        {{-- Experience Timeline --}}
        <div style="margin-top:2.5rem;">
          <div style="font-family:'DM Mono',monospace;font-size:0.7rem;letter-spacing:0.18em;color:var(--blue-bright);text-transform:uppercase;margin-bottom:1.5rem;">Experience</div>
          @foreach([
          ['2026–Present', 'Senior Full Stack Developer', 'ITVisionHub Company Limited'],
          ['2024–2025', 'Junior Web Developer', 'ITVisionHub Company Limited'],
          ] as $exp)
          <div style="display:flex;gap:1.5rem;margin-bottom:1.2rem;padding-bottom:1.2rem;border-bottom:1px solid var(--border);">
            <div style="font-family:'DM Mono',monospace;font-size:0.72rem;color:var(--blue-bright);white-space:nowrap;padding-top:0.15rem;">{{ $exp[0] }}</div>
            <div>
              <div style="color:#fff;font-weight:700;font-size:0.9rem;">{{ $exp[1] }}</div>
              <div style="color:var(--muted);font-size:0.8rem;margin-top:0.2rem;">{{ $exp[2] }}</div>
            </div>
          </div>
          @endforeach
        </div>

        <div style="margin-top:2rem;">
          <!-- <a href="{{ asset('files/resume.pdf') }}" download class="btn-primary">Download CV &darr;</a> -->
          <span class="btn-primary" style="opacity:0.4;cursor:not-allowed;" title="CV coming soon">
            CV Coming Soon
          </span>
        </div>
      </div>

    </div>
  </div>
</section>
@endsection