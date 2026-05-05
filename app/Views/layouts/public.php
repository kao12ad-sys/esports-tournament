<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'Esports Tournament') ?></title>
    <script src="<?= base_url('assets/frontend/js/theme-switch.js') ?>"></script>
    <link href="<?= base_url('templates/source/fonts/font-awesome/v6/css/all.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/frontend/html/assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/frontend/html/assets/css/style.css') ?>">
    <style {csp-style-nonce}>
        :root{--es-bg:#0b1020;--es-panel:#101624;--es-card:#161d2f;--es-line:#263149;--es-text:#f5f7fb;--es-muted:#9aa7bd;--es-accent:#00e5ff;--es-accent2:#7c3cff;--es-success:#31d0aa;--es-warning:#ffc857;--es-danger:#ff5470}
        [data-theme="light"]{--es-bg:#f1f4f9;--es-panel:#fff;--es-card:#fff;--es-line:#dae1ed;--es-text:#1e293b;--es-muted:#64748b;--es-accent:#0ea5e9;--es-accent2:#6366f1}
        html,body{background:var(--es-bg)!important;color:var(--es-text)!important;transition:background .25s,color .25s}
        body{min-height:100vh}
        .topbar{padding:18px 0;border-bottom:1px solid var(--es-line);background:var(--es-panel);box-shadow:0 2px 16px rgba(0,0,0,.12)}
        .wrap{max-width:1120px;margin:auto;padding:0 18px}
        .hero{padding:78px 0 42px}
        .grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:18px}
        .panel,.login-panel,.register-panel{background:var(--es-card)!important;border:1px solid var(--es-line)!important;border-radius:10px;padding:20px;color:var(--es-text)!important;box-shadow:0 4px 20px rgba(0,0,0,.08)}
        .btn-main,.login-submit,.register-submit,.btn-primary{background:var(--es-accent)!important;border-color:var(--es-accent)!important;color:#06111c!important;padding:10px 16px;border-radius:6px;text-decoration:none;border:0;font-weight:700}
        .muted,.text-muted,.form-subtitle{color:var(--es-muted)!important}
        a{color:var(--es-accent)}
        h1,h2,h3,h4,h5,h6,label,strong,.text-white{color:var(--es-text)!important}
        .form-control,input,select,textarea{background:var(--es-panel)!important;border:1px solid var(--es-line)!important;color:var(--es-text)!important;border-radius:6px!important}
        .form-control:focus,input:focus,select:focus,textarea:focus{border-color:var(--es-accent)!important;box-shadow:0 0 0 3px rgba(0,229,255,.12)!important;outline:none}
        .form-control::placeholder,input::placeholder{color:var(--es-muted)!important}
        #theme-switch{display:inline-flex;align-items:center;justify-content:center;width:38px;height:38px;border-radius:8px;border:1px solid var(--es-line);background:var(--es-card);color:var(--es-text);text-decoration:none}
        #theme-switch:hover{color:var(--es-accent);text-decoration:none}
        .login-shell,.register-shell{max-width:1040px;margin:56px auto 70px;display:grid;grid-template-columns:1.1fr .9fr;gap:24px;align-items:stretch}
        .login-intro,.register-intro{background:linear-gradient(135deg,#101624,#161d2f);border:1px solid var(--es-line);border-radius:10px;padding:34px;color:#fff;min-height:430px;display:flex;flex-direction:column;justify-content:space-between;overflow:hidden;position:relative}
        .login-intro:after,.register-intro:after{content:"";position:absolute;right:-80px;bottom:-90px;width:260px;height:260px;border-radius:50%;background:rgba(0,229,255,.12)}
        .login-intro h1,.register-intro h1{font-size:38px;line-height:1.15;margin-bottom:14px}
        .role-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:12px;margin-bottom:20px}
        .role-option{position:relative}.role-option input{position:absolute;opacity:0}
        .role-card{display:block;height:100%;border:1px solid var(--es-line);border-radius:10px;padding:14px;cursor:pointer;background:var(--es-panel);color:var(--es-text);transition:.18s}
        .role-card span{font-size:12px;color:var(--es-muted);line-height:1.35;display:block}
        .role-option input:checked+.role-card{border-color:var(--es-accent);background:rgba(0,229,255,.1);box-shadow:0 0 0 3px rgba(0,229,255,.1)}
        .login-examples,.register-notes{display:grid;gap:9px;margin-top:18px}
        .login-example,.register-note,.captcha-question{display:flex;justify-content:space-between;gap:10px;border:1px solid var(--es-line);border-radius:8px;padding:9px 11px;color:var(--es-muted);font-size:13px;background:var(--es-panel)}
        .captcha-box{display:flex;gap:10px;align-items:center}
        .captcha-question{min-width:112px;align-items:center;justify-content:center;font-weight:700;color:var(--es-text)}
        .alert{border-radius:8px;border:1px solid var(--es-line)}
        .alert-danger{background:rgba(255,84,112,.12);color:var(--es-danger)}
        .alert-success{background:rgba(49,208,170,.12);color:var(--es-success)}
        @media(max-width:900px){.login-shell,.register-shell{grid-template-columns:1fr;margin-top:28px}.login-intro,.register-intro{min-height:260px}.role-grid{grid-template-columns:1fr}}
        @media(max-width:640px){.captcha-box{display:block}.captcha-question{margin-bottom:10px}.topbar nav{gap:10px!important;font-size:14px}}
    </style>
</head>
<body>
<header class="topbar">
    <div class="wrap d-flex justify-content-between align-items-center">
        <a href="<?= site_url('/') ?>" class="text-white text-decoration-none fw-bold">National Esports</a>
        <nav class="d-flex gap-3 align-items-center">
            <a class="text-white" href="<?= site_url('tournaments') ?>">การแข่งขัน</a>
            <a class="text-white" href="<?= site_url('login') ?>">เข้าสู่ระบบ</a>
            <a href="#" id="theme-switch" title="Toggle Theme" aria-label="Toggle theme">
                <i class="fas fa-moon" id="theme-icon"></i>
            </a>
        </nav>
    </div>
</header>
<main class="wrap"><?= $this->renderSection('content') ?></main>
</body>
</html>
