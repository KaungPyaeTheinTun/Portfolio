@extends('layouts.app')
@section('title', 'Skills — KaungPyaeTheinTun')

@section('content')
<section id="skills" style="padding-top:9rem">
  <div class="container">
    <div class="section-label reveal">002 &mdash; Technical Skills</div>
    <h2 class="section-title reveal">What I <em>excel</em> at</h2>

    <div class="skills-grid">

      {{-- Frontend --}}
      <div class="skill-card reveal">
        <div class="skill-cat">Frontend</div>
        @foreach([
          ['HTML5 / CSS3', 95],
          ['Bootstrap',      90],
          ['Tailwind CSS',    92],
          ['Vue.js',          50],
          ['React.js',          50],
        ] as [$name, $pct])
        <div class="skill-item">
          <div class="skill-name">{{ $name }} <span class="skill-pct">{{ $pct }}%</span></div>
          <div class="skill-bar-bg"><div class="skill-bar" data-w="{{ $pct }}"></div></div>
        </div>
        @endforeach
      </div>

      {{-- Backend --}}
      <div class="skill-card reveal" style="transition-delay:0.1s">
        <div class="skill-cat">Backend</div>
        @foreach([
          ['Laravel / PHP',   92],
          ['C#',         40],
          ['ASP.NET',60],
        ] as [$name, $pct])
        <div class="skill-item">
          <div class="skill-name">{{ $name }} <span class="skill-pct">{{ $pct }}%</span></div>
          <div class="skill-bar-bg"><div class="skill-bar" data-w="{{ $pct }}"></div></div>
        </div>
        @endforeach
      </div>

      {{-- Database --}}
      <div class="skill-card reveal" style="transition-delay:0.2s">
        <div class="skill-cat">Database</div>
        @foreach([
          ['MySQL',      90],
          ['MSSQL', 85],
          ['Redis',      50],
        ] as [$name, $pct])
        <div class="skill-item">
          <div class="skill-name">{{ $name }} <span class="skill-pct">{{ $pct }}%</span></div>
          <div class="skill-bar-bg"><div class="skill-bar" data-w="{{ $pct }}"></div></div>
        </div>
        @endforeach
      </div>

      {{-- DevOps --}}
      <div class="skill-card reveal" style="transition-delay:0.1s">
        <div class="skill-cat">DevOps &amp; Cloud</div>
        @foreach([
          ['Docker',    78],
          ['DigitalOcean',       50],
          ['CI/CD Pipelines', 50],
          ['Nginx',       60],
        ] as [$name, $pct])
        <div class="skill-item">
          <div class="skill-name">{{ $name }} <span class="skill-pct">{{ $pct }}%</span></div>
          <div class="skill-bar-bg"><div class="skill-bar" data-w="{{ $pct }}"></div></div>
        </div>
        @endforeach
      </div>

      {{-- Tools --}}
      <div class="skill-card reveal" style="transition-delay:0.2s">
        <div class="skill-cat">Tools</div>
        @foreach([
          ['Git / GitHub',  95],
          ['VS Code',       90],
          ['Figma',         75],
          ['Postman',       78],
        ] as [$name, $pct])
        <div class="skill-item">
          <div class="skill-name">{{ $name }} <span class="skill-pct">{{ $pct }}%</span></div>
          <div class="skill-bar-bg"><div class="skill-bar" data-w="{{ $pct }}"></div></div>
        </div>
        @endforeach
      </div>

    </div>
  </div>
</section>
@endsection