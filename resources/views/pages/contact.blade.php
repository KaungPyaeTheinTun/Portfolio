@extends('layouts.app')
@section('title', 'Contact — KaungPyaeTheinTun')

@section('content')
<section id="contact" style="padding-top:9rem">
  <div class="container">
    <div class="section-label reveal">004 &mdash; Contact</div>
    <h2 class="section-title reveal">Let&rsquo;s build something <em>great</em></h2>

    <div class="contact-grid">

      {{-- Left: Contact Info --}}
      <div class="reveal">
        <div class="contact-info">
          <h3>Open to new opportunities</h3>
          <p>Whether you have a project in mind, want to discuss a role, or just want to say hi — my inbox is always open.</p>
        </div>
        <div class="contact-items">
          <a href="mailto:kaungpyaethaintun@gmail.com" class="contact-item">
            <div class="contact-icon">&#x2709;&#xFE0F;</div>
            <div>
              <div class="contact-item-label">Email</div>
              <div class="contact-item-val">kaungpyaethaintun@gmail.com</div>
            </div>
          </a>
          <a href="https://linkedin.com/in/alexmorgan" target="_blank" class="contact-item">
            <div class="contact-icon">&#x1F4BC;</div>
            <div>
              <div class="contact-item-label">LinkedIn</div>
              <div class="contact-item-val">linkedin.com/in/alexmorgan</div>
            </div>
          </a>
          <a href="https://github.com/KaungPyaeTheinTun" target="_blank" class="contact-item">
            <div class="contact-icon">&#x1F419;</div>
            <div>
              <div class="contact-item-label">GitHub</div>
              <div class="contact-item-val">github.com/KaungPyaeTheinTun</div>
            </div>
          </a>
        </div>
      </div>

      {{-- Right: Contact Form --}}
      <div class="reveal" style="transition-delay:0.15s">

        @if(session('success'))
          <div class="alert-success">&#x2713; {{ session('success') }}</div>
        @endif

        <form action="{{ route('contact.store') }}" method="POST">
          @csrf
          <div class="form-row">
            <div class="form-group">
              <label>First Name</label>
              <input type="text" name="name" value="{{ old('name') }}"
                     class="{{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="John">
              @error('name')<div class="field-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email" value="{{ old('email') }}"
                     class="{{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="john@example.com">
              @error('email')<div class="field-error">{{ $message }}</div>@enderror
            </div>
          </div>

          <div class="form-group">
            <label>Subject</label>
            <input type="text" name="subject" value="{{ old('subject') }}" placeholder="Project Inquiry">
          </div>

          <div class="form-group">
            <label>Message</label>
            <textarea name="message" class="{{ $errors->has('message') ? 'is-invalid' : '' }}"
                      placeholder="Tell me about your project...">{{ old('message') }}</textarea>
            @error('message')<div class="field-error">{{ $message }}</div>@enderror
          </div>

          <button type="submit" class="form-submit">Send Message &rarr;</button>
        </form>
      </div>

    </div>
  </div>
</section>
@endsection