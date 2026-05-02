<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'Admin') ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/backend/assets/css/plugins.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/backend/assets/css/material_style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/backend/assets/css/responsive.css') ?>">
    <style>
        body{background:#f4f6f9}.app{display:grid;grid-template-columns:250px 1fr;min-height:100vh}.side{background:#111827;color:white;padding:22px}.side a{display:block;color:#dbe4f0;padding:10px 0;text-decoration:none}.content{padding:28px}.cardx{background:white;border:1px solid #e5e7eb;border-radius:8px;padding:20px;margin-bottom:18px}.table td,.table th{vertical-align:middle}.form-control,.form-select{margin-bottom:10px}
    </style>
</head>
<body>
<div class="app">
    <aside class="side">
        <h5>Adminz</h5>
        <a href="<?= site_url('adminz') ?>">Dashboard</a>
        <a href="<?= site_url('adminz/tournaments') ?>">การแข่งขัน</a>
        <a href="<?= site_url('adminz/teams') ?>">ทีม</a>
        <a href="<?= site_url('adminz/people') ?>">ผู้จัดการ/นักกีฬา</a>
        <a href="<?= site_url('adminz/registrations') ?>">ผู้สมัคร</a>
        <a href="<?= site_url('adminz/schedules') ?>">ตารางแข่งขัน</a>
        <a href="<?= site_url('adminz/reports') ?>">รายงาน</a>
        <a href="<?= site_url('logout') ?>">ออกจากระบบ</a>
    </aside>
    <main class="content">
        <h3><?= esc($title ?? '') ?></h3>
        <?php if (session('success')): ?><div class="alert alert-success"><?= session('success') ?></div><?php endif ?>
        <?php if (session('error')): ?><div class="alert alert-danger"><?= session('error') ?></div><?php endif ?>
        <?= $this->renderSection('content') ?>
    </main>
</div>
</body>
</html>
