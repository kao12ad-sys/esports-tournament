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
        body{background:#f4f6f9}.app{display:grid;grid-template-columns:280px 1fr;min-height:100vh}.side{background:#111827;color:white;padding:22px}.side a{display:block;color:#dbe4f0;padding:9px 0;text-decoration:none}.side a:hover{color:#fff}.content{padding:28px}.cardx{background:white;border:1px solid #e5e7eb;border-radius:8px;padding:20px;margin-bottom:18px}.table td,.table th{vertical-align:middle}.form-control,.form-select{margin-bottom:10px}
    </style>
</head>
<body>
<div class="app">
    <aside class="side">
        <h5>Adminz</h5>
        <a href="<?= site_url('adminz') ?>">Dashboard</a>
        <a href="<?= site_url('adminz/tournaments') ?>">จัดการข้อมูลการแข่งขัน</a>
        <a href="<?= site_url('adminz/tournaments/new') ?>">เพิ่มการแข่งขัน</a>
        <a href="<?= site_url('tournaments') ?>">แสดงข้อมูลการแข่งขัน</a>
        <a href="<?= site_url('adminz/people?role=team_manager') ?>">จัดการข้อมูลผู้จัดการทีม</a>
        <a href="<?= site_url('adminz/people?role=athletes') ?>">จัดการข้อมูลนักกีฬา</a>
        <a href="<?= site_url('adminz/people?role=amateur_athlete') ?>">จัดการข้อมูลนักกีฬาทั่วไป</a>
        <a href="<?= site_url('adminz/teams') ?>">จัดการข้อมูลทีม</a>
        <a href="<?= site_url('adminz/registrations') ?>">จัดการข้อมูลผู้สมัครแข่งขัน</a>
        <a href="<?= site_url('adminz/schedules') ?>">จัดการข้อมูลตารางแข่งขัน</a>
        <a href="<?= site_url('adminz/reports') ?>">ออกรายงาน</a>
        <a href="<?= site_url('adminz/logout') ?>">ออกจากระบบ</a>
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
