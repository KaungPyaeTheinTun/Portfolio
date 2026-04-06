<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Portfolio Notification</title>
  <style>
    body { 
      margin: 0; 
      padding: 40px 16px; 
      font-family: 'Inter', -apple-system, sans-serif; 
      background-color: #f4f7f9; 
    }
    /* Main Card */
    .card { 
      max-width: 500px; 
      margin: 0 auto; 
      background: #ffffff; 
      border-radius: 16px; 
      overflow: hidden;
      box-shadow: 0 10px 25px rgba(0,0,0,0.06);
    }
    /* Top Accent Bar */
    .accent-bar {
      height: 6px;
      background: linear-gradient(90deg, #3b82f6, #8b5cf6);
    }
    .content { padding: 32px; }
    
    .header { margin-bottom: 24px; }
    .brand { 
      font-size: 12px; 
      font-weight: 800; 
      text-transform: uppercase; 
      letter-spacing: 2px; 
      color: #94a3b8;
      margin-bottom: 8px;
    }
    h2 { 
      font-size: 22px; 
      color: #1e293b; 
      margin: 0; 
      letter-spacing: -0.5px;
    }

    /* Data Rows */
    .info-grid {
      background: #f8fafc;
      border-radius: 12px;
      padding: 20px;
      margin-bottom: 24px;
    }
    .row { margin-bottom: 16px; }
    .row:last-child { margin-bottom: 0; }
    
    .label { 
      font-size: 11px; 
      font-weight: 700; 
      color: #64748b; 
      text-transform: uppercase;
      margin-bottom: 4px;
      display: block;
    }
    .value { 
      font-size: 15px; 
      color: #334155; 
      word-break: break-all;
    }

    /* Message Area */
    .message-box {
      border-top: 1px solid #f1f5f9;
      padding-top: 24px;
    }
    .message-text {
      font-size: 15px;
      line-height: 1.7;
      color: #475569;
      background: #ffffff;
      white-space: pre-line;
    }

    /* Action Button */
    .action-area {
      padding: 0 32px 32px;
      text-align: center;
    }
    .btn {
      display: block;
      background: #1e293b;
      color: #ffffff !important;
      text-decoration: none;
      padding: 14px;
      border-radius: 10px;
      font-size: 14px;
      font-weight: 600;
      transition: background 0.2s;
    }

    .footer {
      text-align: center;
      margin-top: 24px;
      font-size: 12px;
      color: #94a3b8;
    }
  </style>
</head>
<body>

  <div class="card">
    <div class="accent-bar"></div>
    
    <div class="content">
      <div class="header">
        <div class="brand">Contact System</div>
        <h2>New Inquiry</h2>
      </div>

      <div class="info-grid">
        <div class="row">
          <span class="label">From</span>
          <div class="value"><strong>{{ $data['name'] }}</strong></div>
        </div>
        <div class="row">
          <span class="label">Email Address</span>
          <div class="value">{{ $data['email'] }}</div>
        </div>
        @if(!empty($data['subject']))
        <div class="row">
          <span class="label">Subject</span>
          <div class="value">{{ $data['subject'] }}</div>
        </div>
        @endif
      </div>

      <div class="message-box">
        <span class="label">Message</span>
        <div class="message-text">{{ $data['message'] }}</div>
      </div>
    </div>

    <div class="action-area">
      <a href="mailto:{{ $data['email'] }}?subject=Re: {{ $data['subject'] ?? 'Hello' }}" class="btn">
        Open Reply Thread
      </a>
    </div>
  </div>

  <div class="footer">
    Received on {{ now()->format('l, F j') }} at {{ now()->format('H:i') }}
  </div>

</body>
</html>