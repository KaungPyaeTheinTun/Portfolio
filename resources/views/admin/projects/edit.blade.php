@extends('layouts.admin')
@section('title', 'Edit Project')

@section('content')

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:2rem;">
  <div>
    <h1 style="font-size:1.8rem;font-weight:800;color:#fff;letter-spacing:-0.02em;">Edit Project</h1>
    <p style="color:var(--muted);font-size:0.85rem;margin-top:0.25rem;">
      Editing: <span style="color:var(--blue-bright);">{{ $project->title }}</span>
    </p>
  </div>
  <a href="{{ route('admin.projects.index') }}"
     style="display:inline-flex;align-items:center;gap:0.5rem;color:var(--muted);font-size:0.82rem;text-decoration:none;border:1px solid var(--border);padding:0.5rem 1rem;border-radius:6px;transition:all 0.2s;"
     onmouseover="this.style.color='#fff';this.style.borderColor='var(--blue)'"
     onmouseout="this.style.color='var(--muted)';this.style.borderColor='var(--border)'">
    &#x2190; Back to Projects
  </a>
</div>

<form action="{{ route('admin.projects.update', ['project' => $project->id]) }}" method="POST" enctype="multipart/form-data">@csrf
@method('PUT')

<div style="display:grid;grid-template-columns:2fr 1fr;gap:1.5rem;align-items:start;">

  <!-- ── LEFT COLUMN ── -->
  <div style="display:flex;flex-direction:column;gap:1.5rem;">

    <!-- Main Info -->
    <div style="background:var(--surface);border:1px solid var(--border);border-radius:8px;padding:1.75rem;">
      <div style="font-family:'DM Mono',monospace;font-size:0.65rem;letter-spacing:0.18em;text-transform:uppercase;color:var(--blue-bright);margin-bottom:1.5rem;">
        Project Info
      </div>

      <!-- Title -->
      <div style="margin-bottom:1.25rem;">
        <label style="display:block;font-size:0.72rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:var(--muted);margin-bottom:0.5rem;">
          Project Title <span style="color:#f87171;">*</span>
        </label>
        <input type="text" name="title" value="{{ old('title', $project->title) }}" required
               placeholder="e.g. Bus Ticket Booking System"
               style="width:100%;background:var(--dark);border:1px solid {{ $errors->has('title') ? '#ef4444' : 'var(--border)' }};border-radius:6px;padding:0.85rem 1rem;color:var(--text);font-family:'Syne',sans-serif;font-size:0.9rem;outline:none;transition:border-color 0.2s,box-shadow 0.2s;"
               onfocus="this.style.borderColor='var(--blue)';this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.12)'"
               onblur="this.style.borderColor='{{ $errors->has('title') ? '#ef4444' : 'var(--border)' }}';this.style.boxShadow='none'">
        @error('title')
          <div style="color:#f87171;font-size:0.72rem;margin-top:0.4rem;">{{ $message }}</div>
        @enderror
      </div>

      <!-- Description -->
      <div style="margin-bottom:1.25rem;">
        <label style="display:block;font-size:0.72rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:var(--muted);margin-bottom:0.5rem;">
          Description <span style="color:#f87171;">*</span>
        </label>
        <textarea name="description" rows="5" required
                  placeholder="Describe what this project does..."
                  style="width:100%;background:var(--dark);border:1px solid {{ $errors->has('description') ? '#ef4444' : 'var(--border)' }};border-radius:6px;padding:0.85rem 1rem;color:var(--text);font-family:'Syne',sans-serif;font-size:0.9rem;outline:none;resize:vertical;transition:border-color 0.2s,box-shadow 0.2s;"
                  onfocus="this.style.borderColor='var(--blue)';this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.12)'"
                  onblur="this.style.borderColor='var(--border)';this.style.boxShadow='none'">{{ old('description', $project->description) }}</textarea>
        @error('description')
          <div style="color:#f87171;font-size:0.72rem;margin-top:0.4rem;">{{ $message }}</div>
        @enderror
      </div>

      <!-- Technologies -->
      <div>
        <label style="display:block;font-size:0.72rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:var(--muted);margin-bottom:0.5rem;">
          Technologies <span style="color:#f87171;">*</span>
          <span style="color:var(--muted);font-weight:400;text-transform:none;letter-spacing:0;"> — comma separated</span>
        </label>
        <input type="text" name="technologies"
               value="{{ old('technologies', $project->technologies) }}" required
               placeholder="Laravel, MySQL, Bootstrap, jQuery"
               style="width:100%;background:var(--dark);border:1px solid {{ $errors->has('technologies') ? '#ef4444' : 'var(--border)' }};border-radius:6px;padding:0.85rem 1rem;color:var(--text);font-family:'DM Mono',monospace;font-size:0.85rem;outline:none;transition:border-color 0.2s,box-shadow 0.2s;"
               onfocus="this.style.borderColor='var(--blue)';this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.12)'"
               onblur="this.style.borderColor='var(--border)';this.style.boxShadow='none'"
               oninput="previewTags(this.value)">
        @error('technologies')
          <div style="color:#f87171;font-size:0.72rem;margin-top:0.4rem;">{{ $message }}</div>
        @enderror
        <!-- Live Tag Preview -->
        <div id="tag-preview" style="display:flex;flex-wrap:wrap;gap:0.4rem;margin-top:0.75rem;min-height:1rem;"></div>
      </div>
    </div>

    <!-- Links -->
    <div style="background:var(--surface);border:1px solid var(--border);border-radius:8px;padding:1.75rem;">
      <div style="font-family:'DM Mono',monospace;font-size:0.65rem;letter-spacing:0.18em;text-transform:uppercase;color:var(--blue-bright);margin-bottom:1.5rem;">
        Project Links
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">

        <!-- GitHub -->
        <div>
          <label style="display:block;font-size:0.72rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:var(--muted);margin-bottom:0.5rem;">GitHub URL</label>
          <div style="position:relative;">
            <span style="position:absolute;left:0.85rem;top:50%;transform:translateY(-50%);font-size:0.9rem;">&#x1F419;</span>
            <input type="url" name="github_link"
                   value="{{ old('github_link', $project->github_link) }}"
                   placeholder="https://github.com/..."
                   style="width:100%;background:var(--dark);border:1px solid var(--border);border-radius:6px;padding:0.85rem 1rem 0.85rem 2.4rem;color:var(--text);font-family:'DM Mono',monospace;font-size:0.82rem;outline:none;transition:border-color 0.2s,box-shadow 0.2s;"
                   onfocus="this.style.borderColor='var(--blue)';this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.12)'"
                   onblur="this.style.borderColor='var(--border)';this.style.boxShadow='none'">
          </div>
          @error('github_link')
            <div style="color:#f87171;font-size:0.72rem;margin-top:0.4rem;">{{ $message }}</div>
          @enderror
        </div>

        <!-- Live Demo -->
        <div>
          <label style="display:block;font-size:0.72rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:var(--muted);margin-bottom:0.5rem;">Live Demo URL</label>
          <div style="position:relative;">
            <span style="position:absolute;left:0.85rem;top:50%;transform:translateY(-50%);font-size:0.9rem;">&#x1F310;</span>
            <input type="url" name="live_demo"
                   value="{{ old('live_demo', $project->live_demo) }}"
                   placeholder="https://yourdemo.com"
                   style="width:100%;background:var(--dark);border:1px solid var(--border);border-radius:6px;padding:0.85rem 1rem 0.85rem 2.4rem;color:var(--text);font-family:'DM Mono',monospace;font-size:0.82rem;outline:none;transition:border-color 0.2s,box-shadow 0.2s;"
                   onfocus="this.style.borderColor='var(--blue)';this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.12)'"
                   onblur="this.style.borderColor='var(--border)';this.style.boxShadow='none'">
          </div>
          @error('live_demo')
            <div style="color:#f87171;font-size:0.72rem;margin-top:0.4rem;">{{ $message }}</div>
          @enderror
        </div>

      </div>
    </div>

  </div>

  <!-- ── RIGHT COLUMN ── -->
  <div style="display:flex;flex-direction:column;gap:1.5rem;">

    <!-- Screenshot -->
    <div style="background:var(--surface);border:1px solid var(--border);border-radius:8px;padding:1.75rem;">
      <div style="font-family:'DM Mono',monospace;font-size:0.65rem;letter-spacing:0.18em;text-transform:uppercase;color:var(--blue-bright);margin-bottom:1.5rem;">
        Screenshot
      </div>

      <!-- Current Screenshot Preview -->
      @if($project->screenshot)
      <div id="current-screenshot" style="margin-bottom:1rem;">
        <div style="font-size:0.72rem;color:var(--muted);margin-bottom:0.5rem;font-family:'DM Mono',monospace;">Current image:</div>
        <div style="position:relative;border-radius:6px;overflow:hidden;border:1px solid var(--border);">
          <img src="{{ $project->screenshot_url }}"
               alt="{{ $project->title }}"
               style="width:100%;height:160px;object-fit:cover;display:block;">
          <!-- Remove current screenshot button -->
          <button type="button" onclick="removeScreenshot()"
            style="position:absolute;top:0.5rem;right:0.5rem;width:28px;height:28px;background:rgba(239,68,68,0.9);border:none;border-radius:50%;color:#fff;font-size:0.8rem;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:background 0.2s;"
            onmouseover="this.style.background='#ef4444'"
            onmouseout="this.style.background='rgba(239,68,68,0.9)'"
            title="Remove screenshot">
            &#x2715;
          </button>
        </div>
        <input type="hidden" name="remove_screenshot" id="remove_screenshot" value="0">
      </div>
      @endif

      <!-- Upload new screenshot -->
      <div id="drop-zone"
           style="border:2px dashed var(--border);border-radius:8px;padding:1.5rem;text-align:center;cursor:pointer;transition:border-color 0.2s,background 0.2s;"
           onmouseover="this.style.borderColor='var(--blue)';this.style.background='rgba(59,130,246,0.04)'"
           onmouseout="this.style.borderColor='var(--border)';this.style.background='transparent'"
           onclick="document.getElementById('screenshot').click()">
        <div id="drop-preview" style="display:none;margin-bottom:0.75rem;">
          <img id="preview-img" src="" alt="New preview"
               style="width:100%;max-height:140px;object-fit:cover;border-radius:6px;border:1px solid var(--border);">
        </div>
        <div id="drop-placeholder">
          <div style="font-size:1.5rem;margin-bottom:0.5rem;">&#x1F4E4;</div>
          <div style="color:var(--text);font-size:0.82rem;font-weight:600;margin-bottom:0.2rem;">
            {{ $project->screenshot ? 'Upload new screenshot' : 'Click to upload screenshot' }}
          </div>
          <div style="color:var(--muted);font-size:0.72rem;">JPEG, PNG, WebP — max 2MB</div>
        </div>
        <div id="drop-filename" style="display:none;color:var(--blue-bright);font-family:'DM Mono',monospace;font-size:0.75rem;margin-top:0.5rem;"></div>
      </div>
      <input type="file" name="screenshot" id="screenshot" accept="image/*"
             style="display:none;" onchange="previewImage(this)">
      @error('screenshot')
        <div style="color:#f87171;font-size:0.72rem;margin-top:0.5rem;">{{ $message }}</div>
      @enderror
    </div>

    <!-- Meta Info -->
    <div style="background:var(--surface);border:1px solid var(--border);border-radius:8px;padding:1.25rem 1.5rem;">
      <div style="font-family:'DM Mono',monospace;font-size:0.65rem;letter-spacing:0.18em;text-transform:uppercase;color:var(--muted);margin-bottom:1rem;">
        Project Meta
      </div>
      <div style="display:flex;flex-direction:column;gap:0.6rem;">
        <div style="display:flex;justify-content:space-between;align-items:center;">
          <span style="color:var(--muted);font-size:0.78rem;">ID</span>
          <span style="color:var(--text);font-family:'DM Mono',monospace;font-size:0.78rem;">#{{ $project->id }}</span>
        </div>
        <div style="display:flex;justify-content:space-between;align-items:center;">
          <span style="color:var(--muted);font-size:0.78rem;">Created</span>
          <span style="color:var(--text);font-family:'DM Mono',monospace;font-size:0.78rem;">{{ $project->created_at->format('M d, Y') }}</span>
        </div>
        <div style="display:flex;justify-content:space-between;align-items:center;">
          <span style="color:var(--muted);font-size:0.78rem;">Updated</span>
          <span style="color:var(--text);font-family:'DM Mono',monospace;font-size:0.78rem;">{{ $project->updated_at->format('M d, Y') }}</span>
        </div>
      </div>
    </div>

    <!-- Save Button -->
    <button type="submit"
            style="width:100%;padding:1rem;background:var(--blue);color:#fff;border:none;border-radius:8px;font-family:'Syne',sans-serif;font-size:0.9rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;cursor:pointer;transition:background 0.3s,box-shadow 0.3s,transform 0.2s;"
            onmouseover="this.style.background='#60a5fa';this.style.boxShadow='0 0 32px rgba(59,130,246,0.4)';this.style.transform='translateY(-1px)'"
            onmouseout="this.style.background='var(--blue)';this.style.boxShadow='none';this.style.transform='none'">
      &#x2713; Save Changes
    </button>

</form>
    <!-- Delete Button -->
    <form action="{{ route('admin.projects.destroy', $project) }}" method="POST"
          onsubmit="return confirm('Delete \'{{ addslashes($project->title) }}\'?\nThis cannot be undone.')">
      @csrf @method('DELETE')
      <button type="submit"
              style="width:100%;padding:0.85rem;background:transparent;color:#f87171;border:1px solid rgba(239,68,68,0.3);border-radius:8px;font-family:'Syne',sans-serif;font-size:0.82rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;cursor:pointer;transition:all 0.2s;"
              onmouseover="this.style.background='rgba(239,68,68,0.1)';this.style.borderColor='#ef4444'"
              onmouseout="this.style.background='transparent';this.style.borderColor='rgba(239,68,68,0.3)'">
        &#x1F5D1; Delete Project
      </button>
    </form>

  </div>
</div>


@push('scripts')
<script>
  // Live technology tag preview
  function previewTags(val) {
    const container = document.getElementById('tag-preview');
    container.innerHTML = '';
    if (!val.trim()) return;
    val.split(',').forEach(function(t) {
      t = t.trim();
      if (!t) return;
      const span = document.createElement('span');
      span.textContent = t;
      span.style.cssText = "font-family:'DM Mono',monospace;font-size:0.65rem;color:#60a5fa;background:rgba(59,130,246,0.12);border:1px solid rgba(59,130,246,0.25);padding:0.2rem 0.6rem;border-radius:2px;";
      container.appendChild(span);
    });
  }

  // New screenshot preview
  function previewImage(input) {
    if (!input.files || !input.files[0]) return;
    const reader = new FileReader();
    reader.onload = function(e) {
      document.getElementById('preview-img').src = e.target.result;
      document.getElementById('drop-preview').style.display    = 'block';
      document.getElementById('drop-placeholder').style.display = 'none';
      document.getElementById('drop-filename').style.display   = 'block';
      document.getElementById('drop-filename').textContent     = input.files[0].name;
    };
    reader.readAsDataURL(input.files[0]);
  }

  // Remove existing screenshot
  function removeScreenshot() {
    const el = document.getElementById('current-screenshot');
    if (el) el.style.display = 'none';
    const rm = document.getElementById('remove_screenshot');
    if (rm) rm.value = '1';
  }

  // Featured toggle knob
  const cb   = document.getElementById('is_featured');
  const knob = document.getElementById('toggle-knob');
  function updateKnob() {
    knob.style.transform  = cb.checked ? 'translateX(18px)' : 'translateX(0)';
    cb.style.background   = cb.checked ? 'var(--blue)' : 'var(--border)';
  }
  cb.addEventListener('change', updateKnob);
  updateKnob();

  // Init tag preview with current value
  const techInput = document.querySelector('input[name="technologies"]');
  if (techInput && techInput.value) previewTags(techInput.value);
</script>
@endpush

@endsection