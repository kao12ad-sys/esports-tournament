<!doctype html>
<html class="no-js" lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="National Esports Tournament Member">
    <title><?= esc($title ?? 'Member') ?> | National Esports</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('template/html/assets/img/favicon.png') ?>">
    <link rel="stylesheet" href="<?= base_url('template/html/assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('template/html/assets/css/animate.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('template/html/assets/css/fontawesome.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('template/html/assets/css/line-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('template/html/assets/css/odometer.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('template/html/assets/css/venobox.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('template/html/assets/css/keyframe-animation.css') ?>">
    <link rel="stylesheet" href="<?= base_url('template/html/assets/css/swiper.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('template/html/assets/css/header.css') ?>">
    <link rel="stylesheet" href="<?= base_url('template/html/assets/css/blog.css') ?>">
    <link rel="stylesheet" href="<?= base_url('template/html/assets/css/shop.css') ?>">
    <link rel="stylesheet" href="<?= base_url('template/html/assets/css/elements.css') ?>">
    <link rel="stylesheet" href="<?= base_url('template/html/assets/css/main.css') ?>">
    <link rel="stylesheet" href="<?= base_url('template/html/assets/css/responsive.css') ?>">
    <style>
        body{background:#090d16;color:#d8dfef}.member-hero{padding:145px 0 42px;background:#0b101b}.member-hero h1{color:#fff;margin:0}.member-wrap{padding:42px 0 70px}.member-card{background:#111827;border:1px solid rgba(255,255,255,.1);border-radius:8px;padding:22px;margin-bottom:22px}.member-card h4,.member-card h5{color:#fff}.member-table{color:#d8dfef;margin-bottom:0}.member-table th{color:#fff;border-color:rgba(255,255,255,.12)}.member-table td{border-color:rgba(255,255,255,.08)}.form-control,.form-select{background:#0b1220;border-color:rgba(255,255,255,.16);color:#fff;margin-bottom:14px}.form-control:focus,.form-select:focus{background:#0b1220;color:#fff;border-color:#ff3d71;box-shadow:none}.form-control[readonly],textarea[readonly]{background:#141b2b;color:#9aa6bd}.member-label{color:#aeb8cd;font-size:14px;margin-bottom:6px}.status-pill{display:inline-block;border:1px solid rgba(255,255,255,.16);border-radius:999px;padding:3px 10px;color:#fff}.member-stat{background:#141c2e;border-radius:8px;padding:18px;border-left:4px solid #ff3d71}.member-stat .value{color:#fff;font-size:28px;font-weight:700}.member-stat .label{color:#aeb8cd}.alert{border-radius:6px}.header .nav-menu li a{font-size:13px}.default-btn{white-space:nowrap}
    </style>
</head>
<body>
<div class="site-preloader"><div class="spinner"></div></div>
<header class="header">
    <div class="primary-header">
        <div class="container">
            <div class="primary-header-inner">
                <div class="header-logo">
                    <a href="<?= site_url('member') ?>"><img class="logo" src="<?= base_url('template/html/assets/img/logo.png') ?>" alt="Logo"></a>
                </div>
                <div class="header-menu-wrap">
                    <ul class="nav-menu">
                        <li><a href="<?= site_url('/') ?>">หน้าแรก</a></li>
                        <li><a href="<?= site_url('member') ?>">Member</a>
                            <ul>
                                <li><a href="<?= site_url('member/profile') ?>">ข้อมูลส่วนตัว</a></li>
                                <li><a href="<?= site_url('member/team') ?>">ทีมของฉัน</a></li>
                                <li><a href="<?= site_url('member/tournaments') ?>">การแข่งขัน</a></li>
                                <li><a href="<?= site_url('member/reports') ?>">รายงาน</a></li>
                            </ul>
                        </li>
                        <li><a href="<?= site_url('tournaments') ?>">รายการแข่งขัน</a></li>
                    </ul>
                </div>
                <div class="header-right">
                    <a class="default-btn" href="<?= site_url('logout') ?>">ออกจากระบบ</a>
                    <div class="mobile-menu-icon"><div class="burger-menu"><div class="line-menu line-half first-line"></div><div class="line-menu"></div><div class="line-menu line-half last-line"></div></div></div>
                </div>
            </div>
        </div>
    </div>
</header>
<section class="member-hero">
    <div class="container">
        <p class="mb-2">เข้าสู่ระบบในชื่อ <?= esc(session('username')) ?> · <?= esc(session('role')) ?></p>
        <h1><?= esc($title ?? 'Member') ?></h1>
    </div>
</section>
<main class="member-wrap">
    <div class="container">
        <?php if (session('success')): ?><div class="alert alert-success"><?= session('success') ?></div><?php endif ?>
        <?php if (session('error')): ?><div class="alert alert-danger"><?= session('error') ?></div><?php endif ?>
        <?= $this->renderSection('content') ?>
    </div>
</main>
<footer class="footer-section">
    <div class="copyright-wrap">
        <div class="container"><p>© <span id="currentYear"></span> National Esports Tournament</p></div>
    </div>
</footer>
<div id="scrollup"><button id="scroll-top" class="scroll-to-top hover-target"><i class="las la-arrow-up"></i></button></div>
<script src="<?= base_url('template/html/assets/js/vendor/jquary-3.6.0.min.js') ?>"></script>
<script src="<?= base_url('template/html/assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js') ?>"></script>
<script src="<?= base_url('template/html/assets/js/vendor/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('template/html/assets/js/vendor/popper.min.js') ?>"></script>
<script src="<?= base_url('template/html/assets/js/vendor/odometer.min.js') ?>"></script>
<script src="<?= base_url('template/html/assets/js/vendor/waypoints.min.js') ?>"></script>
<script src="<?= base_url('template/html/assets/js/vendor/venobox.min.js') ?>"></script>
<script src="<?= base_url('template/html/assets/js/vendor/swiper.min.js') ?>"></script>
<script src="<?= base_url('template/html/assets/js/vendor/smooth-scroll.js') ?>"></script>
<script src="<?= base_url('template/html/assets/js/vendor/wow.min.js') ?>"></script>
<script src="<?= base_url('template/html/assets/js/main.js') ?>"></script>
</body>
</html>
