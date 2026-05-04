<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="description" content="National Esports Tournament Member" />
    <title><?= esc($title ?? 'Member') ?> | National Esports</title>
    <script src="<?= base_url('templates/source/assets/js/early-theme-init.js') ?>"></script>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('templates/source/fonts/simple-line-icons/simple-line-icons.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('templates/source/fonts/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('templates/source/fonts/font-awesome/v6/css/all.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('templates/source/fonts/material-design-icons/material-icon.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('templates/source/assets/plugins/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?= base_url('templates/source/assets/plugins/material/material.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('templates/source/assets/css/material_style.css') ?>">
    <link href="<?= base_url('templates/source/assets/css/theme/theme_style.css') ?>" rel="stylesheet" id="rt_style_components" type="text/css" />
    <link href="<?= base_url('templates/source/assets/css/plugins.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('templates/source/assets/css/theme/style.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('templates/source/assets/css/responsive.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('templates/source/assets/css/theme/theme-color.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('templates/source/assets/css/setting-panel.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('templates/source/css/dashboard1.css') ?>" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="<?= base_url('templates/source/assets/img/favicon.ico') ?>" />
    <style>
        .page-content{background:#f4f6f9;min-height:calc(100vh - 117px)}.card-box,.member-card{background:#fff;border:0;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,.05);margin-bottom:30px;padding:22px}.member-card h4,.member-card h5{font-weight:600;color:#263238}.card-head{border-bottom:1px solid #eef1f5;padding:15px 20px}.card-head header{font-size:18px;font-weight:600}.member-stat{position:relative;overflow:hidden;border-radius:12px;color:#fff;padding:24px;margin-bottom:25px;min-height:128px;box-shadow:0 8px 22px rgba(30,50,90,.12)}.member-stat:after{content:"";position:absolute;right:-32px;top:-32px;width:120px;height:120px;border-radius:50%;background:rgba(255,255,255,.16)}.member-stat .value{font-size:30px;font-weight:700;line-height:1}.member-stat .label{margin-top:9px;opacity:.92}.member-stat .icon{position:absolute;right:22px;bottom:18px;font-size:38px;opacity:.35}.member-stat:nth-child(1),.bg-member-blue{background:linear-gradient(45deg,#1e88e5,#42a5f5)}.bg-member-purple{background:linear-gradient(45deg,#6f42c1,#9c6ade)}.bg-member-green{background:linear-gradient(45deg,#16a085,#35c7a5)}.bg-member-orange{background:linear-gradient(45deg,#f39c12,#ffba4d)}.member-label{color:#78909c;font-size:12px;text-transform:uppercase;font-weight:700;margin-bottom:6px}.member-table{margin-bottom:0}.member-table thead th{background:#f8f9fa;border-top:0;color:#546e7a;font-size:12px;text-transform:uppercase}.member-table td{vertical-align:middle}.status-pill{display:inline-flex;align-items:center;border-radius:999px;padding:5px 11px;background:#eef2f7;color:#455a64;font-size:12px;font-weight:600}.status-pill.approved{background:#e6f7ef;color:#0b8f5a}.status-pill.pending{background:#fff7df;color:#9a6a00}.status-pill.rejected{background:#fdecef;color:#c62842}.empty-state{border:1px dashed #cfd8dc;border-radius:10px;padding:18px;color:#78909c;background:#fbfcfd}.quick-actions{display:grid;gap:10px}.quick-actions .btn{justify-content:flex-start}.tournament-mini{display:flex;align-items:center;justify-content:space-between;gap:16px;padding:14px 0;border-bottom:1px solid #eef1f5}.tournament-mini:last-child{border-bottom:0}.profile-hero{background:linear-gradient(135deg,#263238,#455a64);color:#fff;border-radius:12px;padding:26px;margin-bottom:25px;position:relative;overflow:hidden}.profile-hero:after{content:"";position:absolute;right:-60px;top:-80px;width:220px;height:220px;border-radius:50%;background:rgba(255,255,255,.1)}.profile-hero h3{color:#fff;margin-bottom:6px}.profile-avatar{width:86px;height:86px;border-radius:50%;object-fit:cover;border:4px solid rgba(255,255,255,.45);background:#fff}.sidemenu-container{background:#fff!important}.sidemenu .nav-link{border-radius:8px;margin:2px 10px}.sidemenu .nav-item.active>.nav-link{background:#e8f0fe;color:#1a73e8}.logo-default{font-weight:700;font-size:20px;letter-spacing:-.5px}.btn.default-btn{background:#188ae2;color:#fff;border:0;border-radius:6px;padding:9px 14px}.btn.default-btn:hover{color:#fff;background:#0f77c7}@media(max-width:767px){.profile-hero{padding:20px}.tournament-mini{align-items:flex-start;flex-direction:column}}
    </style>
</head>
<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md">
<div class="page-wrapper">
    <div class="page-header navbar navbar-fixed-top">
        <div class="page-header-inner">
            <div class="page-logo">
                <a href="<?= site_url('member') ?>">
                    <img class="logo-icon" src="<?= base_url('templates/source/assets/img/logo.png') ?>" alt="logo" height="35">
                    <span class="logo-default">MEMBER</span>
                </a>
            </div>
            <ul class="nav navbar-nav navbar-left in">
                <li><a href="#" class="menu-toggler sidebar-toggler"><i data-feather="menu"></i></a></li>
            </ul>
            <form class="search-form-opened" action="<?= site_url('member/tournaments') ?>" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="ค้นหาการแข่งขัน..." name="q">
                    <span class="input-group-btn"><button class="btn submit" type="submit"><i class="icon-magnifier"></i></button></span>
                </div>
            </form>
            <a class="menu-toggler responsive-toggler" data-bs-toggle="collapse" data-bs-target=".navbar-collapse"><span></span></a>
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <li><a class="fullscreen-btn"><i data-feather="maximize"></i></a></li>
                    <li class="dropdown dropdown-user">
                        <a class="dropdown-toggle" data-bs-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <img alt="" class="img-circle" src="<?= base_url('templates/source/assets/img/dp.jpg') ?>" />
                            <span class="username username-hide-on-mobile"><?= esc(session('username') ?? 'Member') ?></span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li><a href="<?= site_url('/') ?>"><i class="icon-globe"></i> หน้าเว็บไซต์</a></li>
                            <li><a href="<?= site_url('member/profile') ?>"><i class="icon-user"></i> โปรไฟล์</a></li>
                            <li class="divider"></li>
                            <li><a href="<?= site_url('logout') ?>"><i class="icon-logout"></i> ออกจากระบบ</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="page-container">
        <div class="sidebar-container">
            <div class="sidemenu-container navbar-collapse collapse fixed-menu">
                <div class="left-sidemenu">
                    <ul class="sidemenu page-header-fixed slimscroll-style" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top:20px">
                        <li class="sidebar-toggler-wrapper hide"><div class="sidebar-toggler"><span></span></div></li>
                        <li class="sidebar-user-panel">
                            <div class="sidebar-user">
                                <div class="sidebar-user-picture"><img alt="image" src="<?= base_url('templates/source/assets/img/dp.jpg') ?>"></div>
                                <div class="sidebar-user-details">
                                    <div class="user-name"><?= esc(session('username') ?? 'Member') ?></div>
                                    <div class="user-role"><?= esc(session('role') ?? 'member') ?></div>
                                </div>
                            </div>
                        </li>
                        <?php
                            $currentUrl = current_url();
                            $menuItems = [
                                ['url' => site_url('member'), 'icon' => 'home', 'label' => 'Dashboard'],
                                ['url' => site_url('member/profile'), 'icon' => 'user', 'label' => 'ข้อมูลส่วนตัว'],
                                ['url' => site_url('member/team'), 'icon' => 'users', 'label' => 'ทีมของฉัน'],
                                ['url' => site_url('member/tournaments'), 'icon' => 'award', 'label' => 'สมัครแข่งขัน'],
                                ['url' => site_url('member/reports'), 'icon' => 'bar-chart-2', 'label' => 'รายงาน'],
                            ];
                        ?>
                        <?php foreach ($menuItems as $item): ?>
                            <?php $active = rtrim($currentUrl, '/') === rtrim($item['url'], '/') ? 'active' : ''; ?>
                            <li class="nav-item <?= $active ?>">
                                <a href="<?= esc($item['url'], 'attr') ?>" class="nav-link">
                                    <i data-feather="<?= esc($item['icon'], 'attr') ?>"></i>
                                    <span class="title"><?= esc($item['label']) ?></span>
                                </a>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="page-content-wrapper">
            <div class="page-content">
                <div class="page-bar">
                    <div class="page-title-breadcrumb">
                        <div class="pull-left"><div class="page-title"><?= esc($title ?? 'Member') ?></div></div>
                        <ol class="breadcrumb page-breadcrumb pull-right">
                            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?= site_url('member') ?>">Member</a>&nbsp;<i class="fa fa-angle-right"></i></li>
                            <li class="active"><?= esc($title ?? 'Dashboard') ?></li>
                        </ol>
                    </div>
                </div>

                <?php if (session('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert"><?= session('success') ?><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
                <?php endif ?>
                <?php if (session('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert"><?= session('error') ?><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
                <?php endif ?>

                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>

    <div class="page-footer">
        <div class="page-footer-inner">2026 &copy; National Esports Tournament Member</div>
        <div class="scroll-to-top"><i class="icon-arrow-up"></i></div>
    </div>
</div>

<script src="<?= base_url('templates/source/assets/plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('templates/source/assets/plugins/popper/popper.js') ?>"></script>
<script src="<?= base_url('templates/source/assets/plugins/jquery-blockui/jquery.blockui.min.js') ?>"></script>
<script src="<?= base_url('templates/source/assets/plugins/jquery-slimscroll/jquery.slimscroll.js') ?>"></script>
<script src="<?= base_url('templates/source/assets/plugins/feather/feather.min.js') ?>"></script>
<script src="<?= base_url('templates/source/assets/plugins/bootstrap/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('templates/source/assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js') ?>"></script>
<script src="<?= base_url('templates/source/assets/js/app.js') ?>"></script>
<script src="<?= base_url('templates/source/assets/js/layout.js') ?>"></script>
<script src="<?= base_url('templates/source/assets/js/theme-color.js') ?>"></script>
<script src="<?= base_url('templates/source/assets/plugins/material/material.min.js') ?>"></script>
<script>if (window.feather) { feather.replace(); }</script>
</body>
</html>
