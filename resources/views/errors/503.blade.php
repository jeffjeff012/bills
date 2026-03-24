@extends('errors::minimal')

@section('title', __('System Under Maintenance'))

@section('code', '503')

@section('message')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Source+Sans+3:wght@300;400;500&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background-color: #0d1117;
        color: #c9d1d9;
        font-family: 'Source Sans 3', sans-serif;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .error-wrapper {
        max-width: 680px;
        width: 100%;
        padding: 3rem 2rem;
        text-align: center;
        animation: fadeIn 0.8s ease both;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .seal {
        width: 72px;
        height: 72px;
        margin: 0 auto 2rem;
        border: 2px solid #30363d;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #161b22;
        box-shadow: 0 0 0 6px #0d1117, 0 0 0 8px #21262d;
    }

    .seal svg {
        width: 36px;
        height: 36px;
        fill: #8b949e;
    }

    .error-code {
        font-family: 'Playfair Display', serif;
        font-size: 5rem;
        font-weight: 700;
        color: #e6edf3;
        letter-spacing: -2px;
        line-height: 1;
        margin-bottom: 0.25rem;
    }

    .divider {
        width: 60px;
        height: 2px;
        background: linear-gradient(90deg, transparent, #58a6ff, transparent);
        margin: 1.25rem auto;
    }

    .error-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        font-weight: 600;
        color: #e6edf3;
        margin-bottom: 1rem;
        letter-spacing: 0.01em;
    }

    .error-body {
        font-size: 0.975rem;
        font-weight: 300;
        color: #8b949e;
        line-height: 1.75;
        margin-bottom: 2rem;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: #161b22;
        border: 1px solid #30363d;
        border-radius: 6px;
        padding: 0.5rem 1.1rem;
        font-size: 0.82rem;
        font-weight: 500;
        color: #8b949e;
        letter-spacing: 0.05em;
        text-transform: uppercase;
    }

    .status-dot {
        width: 7px;
        height: 7px;
        background: #f0883e;
        border-radius: 50%;
        animation: pulse 1.8s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50%       { opacity: 0.3; }
    }

    .footer-note {
        margin-top: 2.5rem;
        font-size: 0.78rem;
        color: #484f58;
        letter-spacing: 0.03em;
    }
</style>

<div class="error-wrapper">

    <div class="seal">
        <!-- Gavel / legislative icon -->
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M1 21h12v2H1zM5.245 8.07l2.83-2.827 14.14 14.142-2.828 2.828zM12.317 1l5.657 5.656-2.83 2.83-5.656-5.657zM3.825 9.485l5.657 5.657-2.828 2.828-5.657-5.657z"/>
        </svg>
    </div>

    <div class="error-code">503</div>

    <div class="divider"></div>

    <h1 class="error-title">Bills Management System — Temporarily Unavailable</h1>

    <p class="error-body">
        The <strong style="color:#c9d1d9; font-weight:500;">Bills Management System</strong> is currently undergoing scheduled maintenance.<br>
        Legislative records, ordinance filings, and bill tracking services will resume shortly.<br>
        We apologize for any inconvenience to your legislative workflow.
    </p>

    <div class="status-badge">
        <span class="status-dot"></span>
        Maintenance in Progress
    </div>

    <p class="footer-note">
        Bills Management System &mdash; Legislative Records & Ordinance Tracking
    </p>

</div>
@endsection