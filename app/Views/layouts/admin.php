<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="description" content="National Esports Tournament Admin" />
    <title><?= esc($title ?? 'Adminz') ?> | National Esports</title>
    <script src="<?= base_url('templates/source/assets/js/early-theme-init.js') ?>"></script>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('templates/source/fonts/simple-line-icons/simple-line-icons.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('templates/source/fonts/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('templates/source/fonts/font-awesome/v6/css/all.css') ?>" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('templates/source/fonts/material-design-icons/material-icon.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('templates/source/assets/plugins/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?= base_url('templates/source/assets/plugins/material/material.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('templates/source/assets/css/material_style.css') ?>">
    <link href="<?= base_url('templates/source/assets/css/pages/inbox.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('templates/source/assets/css/theme/theme_style.css') ?>" rel="stylesheet" id="rt_style_components" type="text/css" />
    <link href="<?= base_url('templates/source/assets/css/plugins.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('templates/source/assets/css/theme/style.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('templates/source/assets/css/responsive.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('templates/source/assets/css/theme/theme-color.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('templates/source/assets/css/setting-panel.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('templates/source/css/dashboard1.css') ?>" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="<?= base_url('templates/source/assets/img/favicon.ico') ?>" />
    <style>
        .card-box { border-radius: 8px; }
        .admin-stat { color: #fff; border-radius: 8px; padding: 20px; min-height: 118px; }
        .admin-stat .number { font-size: 30px; font-weight: 700; line-height: 1; }
        .admin-stat .label { opacity: .9; margin-top: 8px; }
        .table td, .table th { vertical-align: middle; }
        .form-control, .form-select { margin-bottom: 10px; }
        textarea.form-control { min-height: 92px; }
        .admin-note { color: #6c757d; }
        .page-content { min-height: calc(100vh - 126px); }
    </style>
</head>
<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md">
<div class="page-wrapper">
    <div class="page-header navbar navbar-fixed-top">
        <div class="page-header-inner">
            <div class="page-logo">
                <a href="<?= site_url('adminz') ?>">
                    <img class="logo-icon" src="<?= base_url('templates/source/assets/img/logo.png') ?>" alt="logo" height="40">
                    <span class="logo-default">Adminz</span>
                </a>
            </div>
            <ul class="nav navbar-nav navbar-left in">
                <li><a href="#" class="menu-toggler sidebar-toggler"><i data-feather="menu"></i></a></li>
            </ul>
            <form class="search-form-opened" action="<?= site_url('adminz/tournaments') ?>" method="GET">
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
                            <span class="username username-hide-on-mobile"><?= esc(session('username') ?? 'admin') ?></span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li><a href="<?= site_url('/') ?>"><i class="icon-globe"></i> หน้าเว็บไซต์</a></li>
                            <li><a href="<?= site_url('adminz/logout') ?>"><i class="icon-logout"></i> ออกจากระบบ</a></li>
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
                    <ul class="sidemenu page-header-fixed slimscroll-style" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                        <li class="sidebar-toggler-wrapper hide"><div class="sidebar-toggler"><span></span></div></li>
                        <li class="sidebar-user-panel">
                            <div class="sidebar-user">
                                <div class="sidebar-user-picture"><img alt="image" src="<?= base_url('templates/source/assets/img/dp.jpg') ?>"></div>
                                <div class="sidebar-user-details">
                                    <div class="user-name"><?= esc(session('username') ?? 'admin') ?></div>
                                    <div class="user-role">Administrator</div>
                                </div>
                            </div>
                        </li>
                        <?php
                            $menuItems = [
                                ['url' => site_url('adminz'), 'icon' => 'airplay', 'label' => 'Dashboard'],
                                ['url' => site_url('adminz/tournaments'), 'icon' => 'award', 'label' => 'จัดการข้อมูลการแข่งขัน'],
                                ['url' => site_url('adminz/tournaments/new'), 'icon' => 'plus-square', 'label' => 'เพิ่มการแข่งขัน'],
                                ['url' => site_url('tournaments'), 'icon' => 'eye', 'label' => 'แสดงข้อมูลการแข่งขัน'],
                                ['url' => site_url('adminz/people?role=team_manager'), 'icon' => 'briefcase', 'label' => 'จัดการข้อมูลผู้จัดการทีม'],
                                ['url' => site_url('adminz/people?role=athletes'), 'icon' => 'users', 'label' => 'จัดการข้อมูลนักกีฬา'],
                                ['url' => site_url('adminz/people?role=amateur_athlete'), 'icon' => 'user', 'label' => 'จัดการข้อมูลนักกีฬาทั่วไป'],
                                ['url' => site_url('adminz/teams'), 'icon' => 'shield', 'label' => 'จัดการข้อมูลทีม'],
                                ['url' => site_url('adminz/registrations'), 'icon' => 'clipboard', 'label' => 'จัดการข้อมูลผู้สมัครแข่งขัน'],
                                ['url' => site_url('adminz/schedules'), 'icon' => 'calendar', 'label' => 'จัดการข้อมูลตารางแข่งขัน'],
                                ['url' => site_url('adminz/reports'), 'icon' => 'bar-chart-2', 'label' => 'ออกรายงาน'],
                            ];
                        ?>
                        <?php foreach ($menuItems as $item): ?>
                            <li class="nav-item">
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
                        <div class="pull-left"><div class="page-title"><?= esc($title ?? 'Dashboard') ?></div></div>
                        <ol class="breadcrumb page-breadcrumb pull-right">
                            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?= site_url('adminz') ?>">Adminz</a>&nbsp;<i class="fa fa-angle-right"></i></li>
                            <li class="active"><?= esc($title ?? 'Dashboard') ?></li>
                        </ol>
                    </div>
                </div>
                <?php if (session('success')): ?><div class="alert alert-success"><?= session('success') ?></div><?php endif ?>
                <?php if (session('error')): ?><div class="alert alert-danger"><?= session('error') ?></div><?php endif ?>
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>

    <div class="page-footer">
        <div class="page-footer-inner">National Esports Tournament Admin</div>
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
<script>
    if (window.feather) {
        feather.replace();
    }
</script>
</body>
</html>
