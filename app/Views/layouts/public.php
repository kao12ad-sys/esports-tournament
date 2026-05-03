<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'Esports Tournament') ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/frontend/html/assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/frontend/html/assets/css/style.css') ?>">
    <style>
        body{background:#080b13;color:#f5f7fb}.topbar{padding:18px 0;border-bottom:1px solid rgba(255,255,255,.1)}.wrap{max-width:1120px;margin:auto;padding:0 18px}.hero{padding:78px 0 42px}.grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:18px}.panel{background:#121827;border:1px solid rgba(255,255,255,.1);border-radius:8px;padding:20px}.btn-main{background:#ff3d71;color:white;padding:10px 16px;border-radius:6px;text-decoration:none;border:0}.muted{color:#aab3c5}
    </style>
</head>
<body>
<header class="topbar">
    <div class="wrap d-flex justify-content-between align-items-center">
        <a href="<?= site_url('/') ?>" class="text-white text-decoration-none fw-bold">National Esports</a>
        <nav class="d-flex gap-3">
            <a class="text-white" href="<?= site_url('tournaments') ?>">การแข่งขัน</a>
            <a class="text-white" href="<?= site_url('member') ?>">Member</a>
            <a class="text-white" href="<?= site_url('login') ?>">เข้าสู่ระบบ</a>
        </nav>
    </div>
</header>
<main class="wrap"><?= $this->renderSection('content') ?></main>
</body>
</html>
