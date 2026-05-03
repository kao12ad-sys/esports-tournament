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
        body{background:#070b13;color:#dce4f6}.header{background:#070b13}.member-hero{position:relative;padding:150px 0 54px;background:linear-gradient(180deg,rgba(8,12,23,.82),rgba(8,12,23,.96)),url("<?= base_url('template/html/assets/img/page-header-bg.jpg') ?>") center/cover no-repeat;overflow:hidden}.member-hero:after{content:"";position:absolute;left:0;right:0;bottom:0;height:1px;background:linear-gradient(90deg,transparent,rgba(255,61,113,.75),transparent)}.member-kicker{color:#ff3d71;font-weight:700;text-transform:uppercase;font-size:13px;margin-bottom:8px}.member-hero h1{color:#fff;margin:0;font-size:42px}.member-hero p{color:#aeb8cd}.member-wrap{padding:0 0 76px}.member-player-details{margin-top:-28px}.member-grid{display:grid;gap:22px}.member-card{position:relative;background:linear-gradient(180deg,#111827,#0d1423);border:1px solid rgba(255,255,255,.09);border-radius:8px;padding:24px;margin-bottom:22px;box-shadow:0 18px 42px rgba(0,0,0,.22)}.member-card:before{content:"";position:absolute;left:0;right:0;top:0;height:3px;background:linear-gradient(90deg,#ff3d71,#45d3ff);border-radius:8px 8px 0 0}.member-card h4,.member-card h5{color:#fff}.member-card p{color:#b8c2d8}.member-player-card{position:relative;z-index:3;background:linear-gradient(180deg,#121b2e,#0d1423);border:1px solid rgba(255,255,255,.1);border-radius:8px;margin-bottom:58px;box-shadow:0 24px 60px rgba(0,0,0,.3)}.member-player-card .team-details-wrap{padding:26px 28px}.member-player-card .player-team span{display:block;color:#7f8ba5;font-size:13px;font-weight:800;letter-spacing:0;text-transform:uppercase;margin-top:4px}.member-player-card .player-info li h4{color:#fff}.member-player-card .social-list a{display:grid;place-items:center;width:38px;height:38px;border-radius:50%;background:#101a2c;color:#fff;border:1px solid rgba(255,255,255,.12)}.member-about-panel{padding:0 0 42px}.member-about-panel .section-heading h2{color:#fff}.member-about-panel .section-heading p{color:#b8c2d8}.member-profile-art{position:relative;border-radius:8px;overflow:hidden;box-shadow:0 24px 70px rgba(0,0,0,.35)}.member-profile-art:after{content:"";position:absolute;inset:0;border:1px solid rgba(255,255,255,.1);border-radius:8px}.member-profile-art img{width:100%;display:block}.member-contact-strip{display:inline-flex;align-items:center;gap:9px;color:#fff;background:#101a2c;border:1px solid rgba(255,255,255,.12);border-radius:999px;padding:9px 16px;margin:6px 0 22px}.member-contact-strip i{color:#ff3d71;font-size:22px}.member-action-row{display:flex;gap:12px;flex-wrap:wrap}.member-action-row .default-btn{display:inline-flex;align-items:center;gap:7px}.member-action-row .default-btn.alt{background:#101a2c;border:1px solid rgba(255,255,255,.12)}.member-stat{position:relative;min-height:132px;background:linear-gradient(135deg,#141d31,#0d1423);border:1px solid rgba(255,255,255,.08);border-radius:8px;padding:22px;overflow:hidden;margin-bottom:22px}.member-stat:after{content:"";position:absolute;right:-34px;top:-38px;width:116px;height:116px;border-radius:50%;background:rgba(255,61,113,.13)}.member-stat .value{color:#fff;font-size:34px;font-weight:800;line-height:1}.member-stat .label{color:#aeb8cd;margin-top:10px}.member-stat .icon{position:absolute;right:18px;bottom:14px;color:#ff3d71;font-size:30px;opacity:.9}.member-label{color:#7f8ba5;font-size:13px;text-transform:uppercase;font-weight:700;margin-bottom:6px}.status-pill{display:inline-flex;align-items:center;border:1px solid rgba(255,255,255,.14);border-radius:999px;padding:5px 12px;color:#fff;background:#121b2d;font-size:13px}.status-pill.approved{border-color:rgba(0,214,143,.5);color:#64f0c4}.status-pill.pending{border-color:rgba(255,193,7,.5);color:#ffd86b}.status-pill.rejected{border-color:rgba(255,61,113,.5);color:#ff91ad}.member-table{color:#d8dfef;margin-bottom:0}.member-table thead th{color:#fff;border-color:rgba(255,255,255,.12);font-size:13px;text-transform:uppercase}.member-table td{border-color:rgba(255,255,255,.08)}.member-table tbody tr:hover{background:rgba(255,255,255,.035)}.member-gameplay{padding:28px 0 34px}.member-gameplay .section-heading h2{color:#fff}.member-gameplay .section-heading p{color:#b8c2d8}.member-gameplay .gameplay-card{border-radius:8px;overflow:hidden;background:#0d1423;border:1px solid rgba(255,255,255,.08);box-shadow:0 18px 44px rgba(0,0,0,.22)}.member-card-link{color:#fff;font-weight:800;border-bottom:1px solid rgba(255,255,255,.25)}.quick-actions{display:grid;gap:12px}.quick-actions .default-btn{display:block;text-align:center;width:100%;padding:13px 14px}.form-control,.form-select{background:#0b1220;border-color:rgba(255,255,255,.16);color:#fff;margin-bottom:14px}.form-control:focus,.form-select:focus{background:#0b1220;color:#fff;border-color:#ff3d71;box-shadow:none}.alert{border-radius:6px}.empty-state{border:1px dashed rgba(255,255,255,.16);border-radius:8px;padding:18px;color:#aeb8cd}.tournament-mini{display:flex;justify-content:space-between;gap:18px;align-items:center;padding:16px 0;border-bottom:1px solid rgba(255,255,255,.08)}.tournament-mini:last-child{border-bottom:0}.header .nav-menu li a{font-size:13px}.default-btn{white-space:nowrap;border:0}.copyright-wrap p{margin:0}.mobile-menu-icon{min-width:32px}@media(max-width:991px){.member-player-card .team-details-wrap{gap:22px}.member-player-card .player-info{width:100%}}@media(max-width:767px){.member-hero{padding-top:128px}.member-hero h1{font-size:30px}.member-player-details{margin-top:-16px}.member-player-card .team-details-wrap{padding:22px 18px}.member-player-card .player-info{grid-template-columns:1fr}.tournament-mini{align-items:flex-start;flex-direction:column}.quick-actions .default-btn{text-align:center}}
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
        <div class="member-kicker">National Esports Member</div>
        <h1><?= esc($title ?? 'Member') ?></h1>
        <p class="mt-2 mb-0">เข้าสู่ระบบในชื่อ <?= esc(session('username')) ?> · <?= esc(session('role')) ?></p>
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
