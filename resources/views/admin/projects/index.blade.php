@extends('layouts.admin')
@section('title', 'Projects')

@section('content')

<style>
/* Modal Styles */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.8);
    backdrop-filter: blur(4px);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 1000;
}

.modal-overlay.active {
    display: flex;
}

.modal {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 8px;
    padding: 2rem;
    max-width: 400px;
    width: 90%;
    position: relative;
    animation: modalAppear 0.3s ease;
}

@keyframes modalAppear {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.modal-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.modal-icon {
    width: 48px;
    height: 48px;
    background: rgba(239, 68, 68, 0.1);
    border: 1px solid rgba(239, 68, 68, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #f87171;
    font-size: 1.5rem;
}

.modal-title {
    color: #fff;
    font-size: 1.2rem;
    font-weight: 700;
}

.modal-content {
    color: var(--muted);
    font-size: 0.95rem;
    line-height: 1.6;
    margin-bottom: 2rem;
}

.modal-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
}

.modal-btn {
    padding: 0.7rem 1.4rem;
    border-radius: 6px;
    font-size: 0.82rem;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    cursor: pointer;
    transition: all 0.2s;
    border: none;
}

.modal-btn-cancel {
    background: rgba(255, 255, 255, 0.1);
    color: var(--muted);
    border: 1px solid var(--border);
}

.modal-btn-cancel:hover {
    background: rgba(255, 255, 255, 0.15);
    color: #fff;
}

.modal-btn-delete {
    background: rgba(239, 68, 68, 0.9);
    color: #fff;
    border: 1px solid rgba(239, 68, 68, 0.3);
}

.modal-btn-delete:hover {
    background: rgb(239, 68, 68);
    box-shadow: 0 0 24px rgba(239, 68, 68, 0.4);
}

.project-name {
    font-weight: 700;
    color: #f87171;
}
</style>

{{-- Delete Modal --}}
<div id="deleteModal" class="modal-overlay">
    <div class="modal">
        <div class="modal-header">
            <div class="modal-icon">⚠️</div>
            <div class="modal-title">Delete Project</div>
        </div>
        <div class="modal-content">
            Are you sure you want to delete <span id="deleteProjectName" class="project-name"></span>? 
            This action cannot be undone.
        </div>
        <div class="modal-actions">
            <button onclick="closeDeleteModal()" class="modal-btn modal-btn-cancel">Cancel</button>
            <form id="deleteForm" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="modal-btn modal-btn-delete">Delete Project</button>
            </form>
        </div>
    </div>
</div>

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:2rem;">
  <div>
    <h1 style="font-size:1.8rem;font-weight:800;color:#fff;letter-spacing:-0.02em;">Projects</h1>
    <p style="color:var(--muted);font-size:0.85rem;margin-top:0.25rem;">
      Manage your portfolio projects — {{ $projects->total() }} total
    </p>
  </div>
  <a href="{{ route('admin.projects.create') }}"
     style="display:inline-flex;align-items:center;gap:0.5rem;background:var(--blue);color:#fff;padding:0.7rem 1.4rem;border-radius:6px;font-size:0.82rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;text-decoration:none;transition:background 0.2s,box-shadow 0.2s;"
     onmouseover="this.style.background='#60a5fa';this.style.boxShadow='0 0 24px rgba(59,130,246,0.4)'"
     onmouseout="this.style.background='var(--blue)';this.style.boxShadow='none'">
    &#x2795; Add Project
  </a>
</div>


{{-- Projects Table --}}
<div style="background:var(--surface);border:1px solid var(--border);border-radius:8px;overflow:hidden;">

  {{-- Table Header --}}
  <div style="display:grid;grid-template-columns:60px 2fr 3fr 2fr 80px 1fr;gap:1rem;padding:0.85rem 1.5rem;background:rgba(59,130,246,0.05);border-bottom:1px solid var(--border);">
    <div style="font-family:'DM Mono',monospace;font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:var(--muted);">#</div>
    <div style="font-family:'DM Mono',monospace;font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:var(--muted);">Title</div>
    <div style="font-family:'DM Mono',monospace;font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:var(--muted);">Technologies</div>
    <div style="font-family:'DM Mono',monospace;font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:var(--muted);">Links</div>
    <div style="font-family:'DM Mono',monospace;font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:var(--muted);">Featured</div>
    <div style="font-family:'DM Mono',monospace;font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:var(--muted);">Actions</div>
  </div>

  {{-- Rows --}}
  @forelse($projects as $project)
  <div style="display:grid;grid-template-columns:60px 2fr 3fr 2fr 80px 1fr;gap:1rem;padding:1.1rem 1.5rem;border-bottom:1px solid var(--border);align-items:center;transition:background 0.2s;"
       onmouseover="this.style.background='rgba(255,255,255,0.02)'"
       onmouseout="this.style.background='transparent'">

    {{-- Thumbnail --}}
    <div style="width:48px;height:48px;border-radius:6px;overflow:hidden;background:linear-gradient(135deg,#1e3a5f,#0d2640);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;font-size:1.3rem;flex-shrink:0;">
      @if($project->screenshot)
        <img src="{{ $project->screenshot_url }}" alt="{{ $project->title }}"
             style="width:100%;height:100%;object-fit:cover;">
      @else
        &#x1F5A5;&#xFE0F;
      @endif
    </div>

    {{-- Title --}}
    <div>
      <div style="color:#fff;font-weight:700;font-size:0.92rem;">{{ $project->title }}</div>
      <div style="color:var(--muted);font-size:0.75rem;margin-top:0.2rem;line-height:1.4;">
        {{ Str::limit($project->description, 60) }}
      </div>
    </div>

    {{-- Technologies --}}
    <div style="display:flex;flex-wrap:wrap;gap:0.3rem;">
      @foreach($project->technologies_array as $tech)
        <span style="font-family:'DM Mono',monospace;font-size:0.6rem;color:#60a5fa;background:rgba(59,130,246,0.12);border:1px solid rgba(59,130,246,0.2);padding:0.15rem 0.5rem;border-radius:2px;">
          {{ trim($tech) }}
        </span>
      @endforeach
    </div>

    {{-- Links --}}
    <div style="display:flex;flex-direction:column;gap:0.3rem;">
      @if($project->github_link)
        <a href="{{ $project->github_link }}" target="_blank"
           style="font-family:'DM Mono',monospace;font-size:0.72rem;color:var(--muted);text-decoration:none;display:flex;align-items:center;gap:0.3rem;transition:color 0.2s;"
           onmouseover="this.style.color='#fff'"
           onmouseout="this.style.color='var(--muted)'">
          &#x1F419; GitHub
        </a>
      @endif
      @if($project->live_demo)
        <a href="{{ $project->live_demo }}" target="_blank"
           style="font-family:'DM Mono',monospace;font-size:0.72rem;color:var(--muted);text-decoration:none;display:flex;align-items:center;gap:0.3rem;transition:color 0.2s;"
           onmouseover="this.style.color='#60a5fa'"
           onmouseout="this.style.color='var(--muted)'">
          &#x1F310; Live
        </a>
      @endif
      @if(!$project->github_link && !$project->live_demo)
        <span style="color:var(--muted);font-size:0.72rem;font-family:'DM Mono',monospace;">—</span>
      @endif
    </div>

    {{-- Featured Badge --}}
    <div>
      @if($project->is_featured)
        <span style="background:rgba(59,130,246,0.15);border:1px solid rgba(59,130,246,0.3);color:#60a5fa;font-size:0.65rem;font-family:'DM Mono',monospace;letter-spacing:0.1em;text-transform:uppercase;padding:0.25rem 0.6rem;border-radius:99px;">
          &#x2605; Yes
        </span>
      @else
        <span style="color:var(--muted);font-size:0.72rem;font-family:'DM Mono',monospace;">No</span>
      @endif
    </div>

    {{-- Actions --}}
    <div style="display:flex;gap:0.5rem;align-items:center;">

      {{-- Edit --}}
      <a href="{{ route('admin.projects.edit', $project) }}"
         title="Edit"
         style="width:34px;height:34px;background:rgba(59,130,246,0.1);border:1px solid var(--border);border-radius:6px;color:#60a5fa;font-size:0.9rem;text-decoration:none;display:flex;align-items:center;justify-content:center;transition:all 0.2s;"
         onmouseover="this.style.background='rgba(59,130,246,0.25)';this.style.borderColor='var(--blue)'"
         onmouseout="this.style.background='rgba(59,130,246,0.1)';this.style.borderColor='var(--border)'">
        &#x270F;&#xFE0F;
      </a>

      {{-- Toggle Featured --}}
      <form action="{{ route('admin.projects.update', $project) }}" method="POST">
        @csrf @method('PUT')
        <input type="hidden" name="title"        value="{{ $project->title }}">
        <input type="hidden" name="description"  value="{{ $project->description }}">
        <input type="hidden" name="technologies" value="{{ $project->technologies }}">
        <input type="hidden" name="github_link"  value="{{ $project->github_link }}">
        <input type="hidden" name="live_demo"    value="{{ $project->live_demo }}">
        <input type="hidden" name="sort_order"   value="{{ $project->sort_order }}">
        <input type="hidden" name="is_featured"  value="{{ $project->is_featured ? 0 : 1 }}">
        <button type="submit"
                title="{{ $project->is_featured ? 'Unfeature' : 'Feature' }}"
                style="width:34px;height:34px;background:rgba(245,158,11,0.1);border:1px solid rgba(245,158,11,0.2);border-radius:6px;color:#fbbf24;font-size:0.9rem;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all 0.2s;"
                onmouseover="this.style.background='rgba(245,158,11,0.25)'"
                onmouseout="this.style.background='rgba(245,158,11,0.1)'">
          &#x2605;
        </button>
      </form>

      {{-- Delete --}}
      <button type="button"
              onclick="openDeleteModal('{{ route('admin.projects.destroy', $project) }}', '{{ addslashes($project->title) }}')"
              title="Delete"
              style="width:34px;height:34px;background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.2);border-radius:6px;color:#f87171;font-size:0.9rem;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all 0.2s;"
              onmouseover="this.style.background='rgba(239,68,68,0.3)'"
              onmouseout="this.style.background='rgba(239,68,68,0.1)'">
        &#x1F5D1;
      </button>

    </div>
  </div>
  @empty
  <div style="text-align:center;padding:5rem 2rem;color:var(--muted);">
    <div style="font-size:3rem;margin-bottom:1rem;">&#x1F4C2;</div>
    <div style="color:var(--text);font-weight:700;font-size:1.1rem;margin-bottom:0.5rem;">No projects yet</div>
    <div style="font-size:0.85rem;margin-bottom:1.5rem;">Add your first project to get started.</div>
    <a href="{{ route('admin.projects.create') }}"
       style="display:inline-flex;align-items:center;gap:0.5rem;background:var(--blue);color:#fff;padding:0.7rem 1.4rem;border-radius:6px;font-size:0.82rem;font-weight:700;text-decoration:none;">
      &#x2795; Add Your First Project
    </a>
  </div>
  @endforelse

</div>

{{-- Pagination --}}
@if($projects->hasPages())
  <div style="display:flex;justify-content:center;margin-top:2rem;">
    {{ $projects->links() }}
  </div>
@endif

<script>
function openDeleteModal(deleteUrl, projectName) {
    document.getElementById('deleteForm').action = deleteUrl;
    document.getElementById('deleteProjectName').textContent = projectName;
    document.getElementById('deleteModal').classList.add('active');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.remove('active');
}

// Close modal when clicking outside
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeDeleteModal();
    }
});
</script>

@endsection