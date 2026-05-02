<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'Member') ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/backend/assets/css/plugins.min.css') ?>">
    <style>
        body{background:#f7f8fb}.bar{background:#101828;color:white;padding:14px 22px}.bar a{color:white;margin-right:18px}.page{max-width:1120px;margin:26px auto;padding:0 18px}.cardx{background:white;border:1px solid #e5e7eb;border-radius:8px;padding:20px;margin-bottom:18px}
    </style>
</head>
<body>
<nav class="bar">
    <strong><?= esc(session('username')) ?></strong>
    <a href="<?= site_url('member') ?>">หน้าหลัก</a>
    <a href="<?= site_url('member/profile') ?>">ข้อมูลส่วนตัว</a>
    <a href="<?= site_url('member/team') ?>">ทีม</a>
    <a href="<?= site_url('member/tournaments') ?>">การแข่งขัน</a>
    <a href="<?= site_url('member/reports') ?>">รายงาน</a>
    <a href="<?= site_url('logout') ?>">ออกจากระบบ</a>
</nav>
<main class="page">
    <h3><?= esc($title ?? '') ?></h3>
    <?php if (session('success')): ?><div class="alert alert-success"><?= session('success') ?></div><?php endif ?>
    <?php if (session('error')): ?><div class="alert alert-danger"><?= session('error') ?></div><?php endif ?>
    <?= $this->renderSection('content') ?>
</main>
</body>
</html>
