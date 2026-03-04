<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>New Message — Portfolio</title>
  <style>
    body { margin:0; padding:40px 24px; font-family:'Segoe UI',Arial,sans-serif; font-size:15px; color:#1a1a1a; background:#ffffff; }
    .wrapper { max-width:560px; margin:0 auto; }
    .logo { font-size:1.3rem; font-weight:800; color:#1a1a1a; margin-bottom:32px; }
    .logo span { color:#3b82f6; }
    h2 { font-size:1.1rem; font-weight:700; color:#1a1a1a; margin:0 0 24px; }
    .divider { border:none; border-top:1px solid #e5e7eb; margin:24px 0; }
    .field { margin-bottom:16px; }
    .label { font-size:0.72rem; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; color:#6b7280; margin-bottom:4px; }
    .value { font-size:0.95rem; color:#1a1a1a; }
    .message { font-size:0.95rem; color:#374151; line-height:1.8; white-space:pre-line; border-left:3px solid #3b82f6; padding-left:16px; margin-top:4px; }
    .reply-btn { display:inline-block; margin-top:28px; background:#3b82f6; color:white; text-decoration:none; padding:10px 24px; border-radius:5px; font-size:0.85rem; font-weight:600; }
    .footer { margin-top:40px; padding-top:20px; border-top:1px solid #e5e7eb; font-size:0.75rem; color:#9ca3af; }
  </style>
</head>
<body>
<div class="wrapper">

  <div class="logo">Kaung<span>.</span></div>

  <h2>New message from your portfolio</h2>

  <div class="field">
    <div class="label">Name</div>
    <div class="value">{{ $data['name'] }}</div>
  </div>

  <div class="field">
    <div class="label">Email</div>
    <div class="value">{{ $data['email'] }}</div>
  </div>

  @if(!empty($data['subject']))
  <div class="field">
    <div class="label">Subject</div>
    <div class="value">{{ $data['subject'] }}</div>
  </div>
  @endif

  <hr class="divider">

  <div class="field">
    <div class="label">Message</div>
    <div class="message">{{ $data['message'] }}</div>
  </div>

  <a href="mailto:{{ $data['email'] }}?subject=Re: {{ $data['subject'] ?? 'Your message' }}"
     class="reply-btn">Reply to {{ explode(' ', $data['name'])[0] }}</a>

  <div class="footer">
    This email was sent from your portfolio contact form &mdash; {{ now()->format('M d, Y h:i A') }}
  </div>

</div>
</body>
</html>