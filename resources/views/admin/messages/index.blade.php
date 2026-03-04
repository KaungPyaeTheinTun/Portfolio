@extends('layouts.admin')
@section('title', 'Messages')

@section('content')

{{-- Delete Modal Component --}}
@include('components.delete-modal')

<div class="flex items-center justify-between mb-8">
  <div>
    <h1 style="font-size:1.8rem;font-weight:800;color:#fff;letter-spacing:-0.02em;">Messages</h1>
    <p style="color:var(--muted);font-size:0.85rem;margin-top:0.25rem;">Contact form submissions from visitors</p>
  </div>
  @php $unread = $messages->where('is_read', false)->count(); @endphp
  @if($unread > 0)
  <div style="background:rgba(59,130,246,0.15);border:1px solid var(--border);border-radius:6px;padding:0.6rem 1.2rem;display:flex;align-items:center;gap:0.6rem;">
    <div style="width:8px;height:8px;background:var(--blue-bright);border-radius:50%;animation:pulse 2s infinite;"></div>
    <span style="color:var(--blue-bright);font-size:0.82rem;font-weight:600;">{{ $unread }} unread</span>
  </div>
  @endif
</div>

@if(session('success'))
<div style="background:rgba(16,185,129,0.1);border:1px solid rgba(16,185,129,0.3);color:#34d399;padding:1rem 1.25rem;border-radius:6px;margin-bottom:1.5rem;font-size:0.88rem;">
  ✓ {{ session('success') }}
</div>
@endif

{{-- Table --}}
<div style="background:var(--surface);border:1px solid var(--border);border-radius:8px;overflow:hidden;">

  <div style="display:grid;grid-template-columns:2fr 2fr 3fr 1fr 1fr;gap:1rem;padding:0.85rem 1.5rem;background:rgba(59,130,246,0.05);border-bottom:1px solid var(--border);">
    <div style="font-family:'DM Mono',monospace;font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:var(--muted);">Name</div>
    <div style="font-family:'DM Mono',monospace;font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:var(--muted);">Email</div>
    <div style="font-family:'DM Mono',monospace;font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:var(--muted);">Message</div>
    <div style="font-family:'DM Mono',monospace;font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:var(--muted);">Date</div>
    <div style="font-family:'DM Mono',monospace;font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:var(--muted);">Actions</div>
  </div>

  @forelse($messages as $message)
  <div style="display:grid;grid-template-columns:2fr 2fr 3fr 1fr 1fr;gap:1rem;padding:1.1rem 1.5rem;border-bottom:1px solid var(--border);align-items:center;transition:background 0.2s;{{ !$message->is_read ? 'background:rgba(59,130,246,0.04);' : '' }}"
    onmouseover="this.style.background='rgba(255,255,255,0.02)'"
    onmouseout="this.style.background='{{ !$message->is_read ? 'rgba(59,130,246,0.04)' : 'transparent' }}'">

    {{-- Name --}}
    <div style="display:flex;align-items:center;gap:0.6rem;">
      <div style="width:6px;height:6px;border-radius:50%;flex-shrink:0;{{ !$message->is_read ? 'background:var(--blue-bright);' : '' }}"></div>
      <span style="color:#fff;font-weight:{{ !$message->is_read ? '700' : '400' }};font-size:0.9rem;">{{ $message->name }}</span>
    </div>

    {{-- Email --}}
    <div style="color:var(--muted);font-size:0.85rem;font-family:'DM Mono',monospace;">{{ $message->email }}</div>

    {{-- Preview --}}
    <div>
      @if($message->subject)
      <div style="color:var(--text);font-size:0.82rem;font-weight:600;margin-bottom:0.2rem;">{{ $message->subject }}</div>
      @endif
      <div style="color:var(--muted);font-size:0.8rem;line-height:1.5;">{{ Str::limit($message->message, 80) }}</div>
    </div>

    {{-- Date --}}
    <div style="color:var(--muted);font-size:0.75rem;font-family:'DM Mono',monospace;">
      {{ $message->created_at->format('M d') }}<br>
      <span style="font-size:0.7rem;opacity:0.6;">{{ $message->created_at->format('H:i') }}</span>
    </div>

    {{-- Actions --}}
    <div style="display:flex;gap:0.5rem;align-items:center;">

      {{-- Mark as Read --}}
      @if(!$message->is_read)
      <form action="{{ route('admin.messages.read', $message) }}" method="POST">
        @csrf @method('PATCH')
        <button type="submit" title="Mark as read"
          style="width:32px;height:32px;background:rgba(59,130,246,0.15);border:1px solid var(--border);border-radius:6px;color:var(--blue-bright);font-size:0.85rem;cursor:pointer;transition:all 0.2s;display:flex;align-items:center;justify-content:center;"
          onmouseover="this.style.background='rgba(59,130,246,0.3)'"
          onmouseout="this.style.background='rgba(59,130,246,0.15)'">✓</button>
      </form>
      @endif

      {{-- Delete — uses the shared component --}}
      <button type="button" title="Delete"
        onclick="openDeleteModal(
                '{{ route('admin.messages.destroy', $message) }}',
                '{{ addslashes($message->name) }}\'s message',
                'Subject: {{ addslashes($message->subject ?? 'No subject') }}'
              )"
        style="width:32px;height:32px;background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.2);border-radius:6px;color:#f87171;font-size:0.85rem;cursor:pointer;transition:all 0.2s;display:flex;align-items:center;justify-content:center;"
        onmouseover="this.style.background='rgba(239,68,68,0.25)'"
        onmouseout="this.style.background='rgba(239,68,68,0.1)'">
        &#x1F5D1;
      </button>

    </div>
  </div>

  {{-- Hidden data for view modal --}}
  <div id="msg-{{ $message->id }}" style="display:none"
    data-name="{{ $message->name }}"
    data-email="{{ $message->email }}"
    data-subject="{{ $message->subject }}"
    data-message="{{ $message->message }}"
    data-date="{{ $message->created_at->format('M d, Y H:i') }}">
  </div>

  @empty
  <div style="text-align:center;padding:4rem;color:var(--muted);">
    <div style="font-size:2.5rem;margin-bottom:1rem;">&#x1F4EC;</div>
    <div style="font-weight:600;color:var(--text);margin-bottom:0.4rem;">No messages yet</div>
    <div style="font-size:0.85rem;">Messages from your contact form will appear here.</div>
  </div>
  @endforelse

</div>

@if($messages->hasPages())
<div style="display:flex;justify-content:center;margin-top:2rem;">
  {{ $messages->links() }}
</div>
@endif


{{-- ── VIEW MESSAGE MODAL ── --}}
<div id="msgModal"
  style="display:none;position:fixed;inset:0;z-index:999;background:rgba(8,12,20,0.85);backdrop-filter:blur(8px);align-items:center;justify-content:center;">
  <div style="background:var(--surface);border:1px solid var(--border);border-radius:12px;width:100%;max-width:540px;margin:1.5rem;padding:2rem;position:relative;">
    <button onclick="closeMessage()"
      style="position:absolute;top:1rem;right:1rem;background:none;border:none;color:var(--muted);font-size:1.3rem;cursor:pointer;line-height:1;">&#x2715;</button>
    <div style="font-family:'DM Mono',monospace;font-size:0.65rem;letter-spacing:0.18em;text-transform:uppercase;color:var(--blue-bright);margin-bottom:1rem;">Full Message</div>
    <div style="display:flex;gap:1rem;margin-bottom:1.5rem;padding-bottom:1.5rem;border-bottom:1px solid var(--border);">
      <div style="width:44px;height:44px;background:rgba(59,130,246,0.15);border:1px solid var(--border);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;flex-shrink:0;">&#x1F464;</div>
      <div>
        <div id="modal-name" style="color:#fff;font-weight:700;font-size:1rem;"></div>
        <div id="modal-email" style="color:var(--blue-bright);font-size:0.82rem;font-family:'DM Mono',monospace;margin-top:0.15rem;"></div>
        <div id="modal-date" style="color:var(--muted);font-size:0.75rem;margin-top:0.15rem;"></div>
      </div>
    </div>
    <div id="modal-subject" style="color:var(--text);font-weight:700;font-size:0.95rem;margin-bottom:0.75rem;"></div>
    <div id="modal-message" style="color:var(--muted);font-size:0.9rem;line-height:1.8;white-space:pre-wrap;"></div>
    <div style="margin-top:1.5rem;padding-top:1.5rem;border-top:1px solid var(--border);">
      <a id="modal-reply" href="#"
        style="display:inline-flex;align-items:center;gap:0.5rem;background:var(--blue);color:#fff;padding:0.6rem 1.4rem;border-radius:4px;font-size:0.82rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;text-decoration:none;transition:background 0.2s;"
        onmouseover="this.style.background='#60a5fa'"
        onmouseout="this.style.background='var(--blue)'">
        &#x2709;&#xFE0F; Reply via Email
      </a>
    </div>
  </div>
</div>

<style>
  @keyframes pulse {

    0%,
    100% {
      opacity: 1
    }

    50% {
      opacity: 0.4
    }
  }
</style>

@push('scripts')
<script>
  function openMessage(id) {
    const d = document.getElementById('msg-' + id).dataset;
    document.getElementById('modal-name').textContent = d.name;
    document.getElementById('modal-email').textContent = d.email;
    document.getElementById('modal-date').textContent = d.date;
    document.getElementById('modal-subject').textContent = d.subject || '';
    document.getElementById('modal-message').textContent = d.message;
    document.getElementById('modal-reply').href = 'mailto:' + d.email + '?subject=Re: ' + (d.subject || 'Your message');
    document.getElementById('msgModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
  }

  function closeMessage() {
    document.getElementById('msgModal').style.display = 'none';
    document.body.style.overflow = '';
  }
  document.getElementById('msgModal').addEventListener('click', function(e) {
    if (e.target === this) closeMessage();
  });
</script>
@endpush

@endsection