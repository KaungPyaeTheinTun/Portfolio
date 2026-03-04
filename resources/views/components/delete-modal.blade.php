{{--
  Reusable Delete Modal Component
  Usage: @include('components.delete-modal')
  Trigger: openDeleteModal(deleteUrl, itemName, optionalSubtext)
--}}

<div id="deleteModal"
     style="display:none;position:fixed;inset:0;z-index:1000;background:rgba(8,12,20,0.88);backdrop-filter:blur(6px);align-items:center;justify-content:center;">

  <div style="background:var(--surface);border:1px solid var(--border);border-radius:12px;width:100%;max-width:420px;margin:1.5rem;position:relative;overflow:hidden;animation:modalIn 0.25s cubic-bezier(.4,0,.2,1);">

    {{-- Red top accent line --}}
    <div style="height:3px;background:linear-gradient(90deg,#ef4444,#f87171,transparent);"></div>

    <div style="padding:2rem;">

      {{-- Icon + Title --}}
      <div style="display:flex;align-items:center;gap:1rem;margin-bottom:1.25rem;">
        <div style="width:48px;height:48px;border-radius:50%;background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.25);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#f87171" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="3 6 5 6 21 6"></polyline>
            <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"></path>
            <path d="M10 11v6"></path><path d="M14 11v6"></path>
            <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"></path>
          </svg>
        </div>
        <div>
          <div style="color:#fff;font-size:1.1rem;font-weight:800;letter-spacing:-0.01em;">Delete Confirmation</div>
          <div style="color:var(--muted);font-size:0.78rem;margin-top:0.1rem;">This action cannot be undone</div>
        </div>
      </div>

      {{-- Body text --}}
      <div style="background:rgba(239,68,68,0.05);border:1px solid rgba(239,68,68,0.15);border-radius:8px;padding:1rem 1.25rem;margin-bottom:1.75rem;">
        <div style="color:var(--muted);font-size:0.88rem;line-height:1.6;">
          Are you sure you want to delete
          <span id="delete-item-name" style="color:#f87171;font-weight:700;"></span>?
        </div>
        <div id="delete-item-subtext" style="color:var(--muted);font-size:0.78rem;margin-top:0.4rem;opacity:0.7;display:none;"></div>
      </div>

      {{-- Actions --}}
      <div style="display:flex;gap:0.75rem;justify-content:flex-end;">

        {{-- Cancel --}}
        <button onclick="closeDeleteModal()"
          style="padding:0.7rem 1.4rem;background:gray;color:#fff;border:1px solid var(--border);border-radius:6px;font-family:'Syne',sans-serif;font-size:0.82rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;cursor:pointer;transition:all 0.2s;"
          onmouseover="this.style.color='#fff';this.style.borderColor='rgba(255,255,255,0.3)'"
          onmouseout="this.style.color='var(--muted)';this.style.borderColor='var(--border)'">
          Cancel
        </button>

        {{-- Confirm Delete --}}
        <form id="delete-form" method="POST" style="display:inline;">
          @csrf
          @method('DELETE')
          <button type="submit"
            style="padding:0.7rem 1.4rem;background:#ef4444;color:#fff;border:1px solid rgba(239,68,68,0.5);border-radius:6px;font-family:'Syne',sans-serif;font-size:0.82rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;cursor:pointer;transition:all 0.2s;display:flex;align-items:center;gap:0.5rem;"
            onmouseover="this.style.background='#dc2626';this.style.boxShadow='0 0 24px rgba(239,68,68,0.4)'"
            onmouseout="this.style.background='#ef4444';this.style.boxShadow='none'">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="3 6 5 6 21 6"></polyline>
              <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"></path>
              <path d="M10 11v6"></path><path d="M14 11v6"></path>
            </svg>
            Yes, Delete
          </button>
        </form>

      </div>
    </div>
  </div>
</div>

<style>
  @keyframes modalIn {
    from { opacity:0; transform:translateY(-16px) scale(0.97); }
    to   { opacity:1; transform:translateY(0)     scale(1); }
  }
</style>

<script>
  function openDeleteModal(url, name, subtext) {
    document.getElementById('delete-form').action          = url;
    document.getElementById('delete-item-name').textContent = name;

    const sub = document.getElementById('delete-item-subtext');
    if (subtext) {
      sub.textContent   = subtext;
      sub.style.display = 'block';
    } else {
      sub.style.display = 'none';
    }

    const modal = document.getElementById('deleteModal');
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
  }

  function closeDeleteModal() {
    document.getElementById('deleteModal').style.display = 'none';
    document.body.style.overflow = '';
  }

  // Click outside to close
  document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) closeDeleteModal();
  });

  // Escape key to close
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeDeleteModal();
  });
</script>