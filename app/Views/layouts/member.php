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
    <style {csp-style-nonce}>
        :root{--es-bg:#0b1020;--es-panel:#101624;--es-card:#161d2f;--es-line:#263149;--es-text:#f5f7fb;--es-muted:#9aa7bd;--es-accent:#00e5ff;--es-accent-2:#7c3cff;--es-success:#31d0aa;--es-warning:#ffc857;--es-danger:#ff5470}
        html,body,.page-wrapper,.page-container,.page-content-wrapper,.page-content{background:var(--es-bg)!important;color:var(--es-text)!important}
        body{font-family:Poppins,Arial,sans-serif}
        .page-content{min-height:calc(100vh - 117px);padding-bottom:28px}
        .page-header,.page-logo,.sidebar-container,.sidemenu-container,.left-sidemenu,.page-footer{background:var(--es-panel)!important;border-color:var(--es-line)!important}
        .page-header{box-shadow:0 12px 36px rgba(0,0,0,.22)}
        .page-logo a,.logo-default,.username,.sidebar-user-details .user-name,.page-title{color:var(--es-text)!important;font-weight:700}
        .page-title{letter-spacing:0}
        .page-bar{background:transparent!important;border:0!important;margin-bottom:20px}
        .page-breadcrumb,.page-breadcrumb a,.page-breadcrumb li,.sidebar-user-details .user-role,.text-muted{color:var(--es-muted)!important}
        .search-form-opened .form-control,.form-control,.form-select,select,textarea,input[type=text],input[type=email],input[type=password],input[type=date],input[type=datetime-local],input[type=number]{background:#0f1729!important;border:1px solid var(--es-line)!important;color:var(--es-text)!important;border-radius:6px!important}
        .search-form-opened .form-control::placeholder,.form-control::placeholder{color:#6f7f99!important}
        .card,.card-box,.member-card,.white-box,.panel,.modal-content,.dropdown-menu,.table-responsive,.empty-state{background:var(--es-card)!important;border:1px solid var(--es-line)!important;border-radius:8px!important;box-shadow:0 18px 48px rgba(0,0,0,.22)!important;color:var(--es-text)!important}
        .card-box,.member-card{margin-bottom:30px;padding:22px}
        .card-head{background:transparent!important;border-bottom:1px solid var(--es-line)!important;padding:15px 20px}
        .card-head header,.card-title,h1,h2,h3,h4,h5,h6,label,strong{color:var(--es-text)!important}
        .table,.member-table{color:var(--es-muted)!important;margin-bottom:0}
        .table thead th,.table th,.member-table thead th{background:#101827!important;border-color:var(--es-line)!important;color:var(--es-text)!important;text-transform:uppercase;font-size:12px;letter-spacing:0}
        .table td,.member-table td{background:transparent!important;border-color:var(--es-line)!important;color:var(--es-muted)!important;vertical-align:middle}
        .table-striped tbody tr:nth-of-type(odd){background:rgba(255,255,255,.025)!important}
        .table-hover tbody tr:hover{background:rgba(0,229,255,.06)!important}
        .sidemenu .nav-link{border-radius:8px;margin:2px 10px;color:var(--es-muted)!important}
        .sidemenu .nav-link i,.sidemenu .nav-link svg{color:var(--es-muted)!important;stroke:var(--es-muted)!important}
        .sidemenu .nav-link:hover,.sidemenu .nav-item.active>.nav-link{background:rgba(0,229,255,.1)!important;color:var(--es-accent)!important}
        .sidemenu .nav-link:hover i,.sidemenu .nav-link:hover svg,.sidemenu .nav-item.active>.nav-link i,.sidemenu .nav-item.active>.nav-link svg{color:var(--es-accent)!important;stroke:var(--es-accent)!important}
        .btn-primary,.btn-info,.btn-success,.btn.default-btn,.default-btn{background:var(--es-accent)!important;border-color:var(--es-accent)!important;color:#06111c!important;border-radius:6px}
        .btn-warning{background:var(--es-warning)!important;border-color:var(--es-warning)!important;color:#111827!important}
        .btn-danger{background:var(--es-danger)!important;border-color:var(--es-danger)!important;color:#fff!important}
        .btn-default,.btn-outline-primary,.btn-secondary{background:#0f1729!important;border:1px solid var(--es-line)!important;color:var(--es-text)!important}
        .member-stat{position:relative;overflow:hidden;border-radius:8px;color:#fff;padding:24px;margin-bottom:25px;min-height:128px;border:1px solid rgba(255,255,255,.12);box-shadow:0 18px 48px rgba(0,0,0,.22)}
        .member-stat:after{content:"";position:absolute;right:-32px;top:-32px;width:120px;height:120px;border-radius:50%;background:rgba(255,255,255,.13)}
        .member-stat .value{font-size:30px;font-weight:700;line-height:1;color:#fff!important}.member-stat .label{margin-top:9px;color:#d9e2f2!important}.member-stat .icon{position:absolute;right:22px;bottom:18px;font-size:38px;opacity:.35}
        .bg-member-blue{background:linear-gradient(135deg,#0e7490,#00e5ff)!important}.bg-member-purple{background:linear-gradient(135deg,#292d58,#7c3cff)!important}.bg-member-green{background:linear-gradient(135deg,#0f766e,#31d0aa)!important}.bg-member-orange{background:linear-gradient(135deg,#9a6700,#ffc857)!important}
        .member-label{color:var(--es-accent)!important;font-size:12px;text-transform:uppercase;font-weight:700;margin-bottom:6px}
        .status-pill{display:inline-flex;align-items:center;border-radius:999px;padding:5px 11px;background:rgba(0,229,255,.1)!important;border:1px solid rgba(0,229,255,.35);color:var(--es-accent)!important;font-size:12px;font-weight:600}
        .status-pill.approved{background:rgba(49,208,170,.14)!important;color:var(--es-success)!important;border-color:rgba(49,208,170,.35)}.status-pill.pending{background:rgba(255,200,87,.16)!important;color:var(--es-warning)!important;border-color:rgba(255,200,87,.35)}.status-pill.rejected{background:rgba(255,84,112,.14)!important;color:var(--es-danger)!important;border-color:rgba(255,84,112,.35)}
        .empty-state{padding:18px;color:var(--es-muted)!important}.quick-actions{display:grid;gap:10px}.quick-actions .btn{justify-content:flex-start}
        .tournament-mini{display:flex;align-items:center;justify-content:space-between;gap:16px;padding:14px 0;border-bottom:1px solid var(--es-line)}.tournament-mini:last-child{border-bottom:0}
        .profile-hero{background:linear-gradient(135deg,#101624,#161d2f)!important;color:#fff;border:1px solid var(--es-line);border-radius:8px;padding:26px;margin-bottom:25px;position:relative;overflow:hidden;box-shadow:0 18px 48px rgba(0,0,0,.24)}
        .profile-hero:after{content:"";position:absolute;right:-60px;top:-80px;width:220px;height:220px;border-radius:50%;background:rgba(0,229,255,.09)}.profile-hero h3{color:#fff;margin-bottom:6px}
        .profile-avatar{width:86px;height:86px;border-radius:50%;object-fit:cover;border:4px solid rgba(0,229,255,.35);background:#fff}
        .alert{border-radius:8px;border:1px solid var(--es-line)}
        @media(max-width:767px){.profile-hero{padding:20px}.tournament-mini{align-items:flex-start;flex-direction:column}}
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
