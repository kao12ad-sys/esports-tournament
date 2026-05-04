<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<?php
    $icons = [
        'การแข่งขันทั้งหมด' => 'fas fa-award',
        'ทีมทั้งหมด' => 'fas fa-users',
        'สมาชิกทั้งหมด' => 'fas fa-user-circle',
        'ผู้สมัครแข่งขัน' => 'fas fa-clipboard-list',
        'ตารางแข่งขัน' => 'fas fa-calendar-alt',
        'รออนุมัติ' => 'fas fa-clock',
    ];
    $colors = ['bg-primary', 'bg-success', 'bg-purple', 'bg-warning', 'bg-danger', 'bg-info'];
    $i = 0;
?>
<style>
    body,
    .page-content-white,
    .page-container,
    .page-content {
        background: #0b1020 !important;
        color: #f5f7fb;
    }

    .page-header.navbar,
    .page-logo,
    .page-footer {
        background: #101624 !important;
        border-color: #263149 !important;
    }

    .logo-default,
    .page-title,
    .page-footer-inner,
    .username,
    .fullscreen-btn,
    .menu-toggler {
        color: #f5f7fb !important;
    }

    .sidemenu-container,
    .sidebar-container,
    .left-sidemenu,
    .sidebar-user-panel {
        background: #101624 !important;
    }

    .sidemenu .nav-link {
        color: #9aa7bd !important;
        border: 1px solid transparent;
    }

    .sidemenu .nav-link:hover,
    .sidemenu .nav-item.active > .nav-link {
        background: rgba(0, 229, 255, .08) !important;
        border-color: rgba(0, 229, 255, .25);
        color: #00e5ff !important;
    }

    .sidemenu .nav-link svg,
    .sidemenu .nav-link i {
        color: inherit !important;
    }

    .sidebar-user-details .user-name {
        color: #f5f7fb;
    }

    .sidebar-user-details .user-role,
    .page-breadcrumb,
    .page-breadcrumb a,
    .page-breadcrumb li {
        color: #9aa7bd !important;
    }

    .page-bar {
        background: transparent;
        border-bottom: 1px solid #263149;
        margin-bottom: 22px;
    }

    .card-box {
        background: #161d2f !important;
        border: 1px solid #263149 !important;
        box-shadow: 0 18px 48px rgba(0, 0, 0, .22) !important;
    }

    .card-head {
        border-bottom-color: #263149 !important;
    }

    .card-head header,
    .card-box strong {
        color: #f5f7fb !important;
    }

    .table {
        color: #d8dfef;
    }

    .table thead th {
        background: #101624 !important;
        color: #9aa7bd !important;
        border-color: #263149 !important;
    }

    .table td {
        border-color: #263149 !important;
    }

    .table-hover tbody tr:hover,
    .table-striped tbody tr:nth-of-type(odd) {
        background: rgba(255, 255, 255, .035) !important;
    }

    .stat-card {
        border: 1px solid rgba(255, 255, 255, .08);
        box-shadow: 0 18px 44px rgba(0, 0, 0, .22);
    }

    .bg-primary,
    .bg-info {
        background: linear-gradient(135deg, #00a7ff, #00e5ff) !important;
    }

    .bg-success {
        background: linear-gradient(135deg, #08b982, #18d39e) !important;
    }

    .bg-purple {
        background: linear-gradient(135deg, #7c3aed, #ff2e88) !important;
    }

    .bg-warning {
        background: linear-gradient(135deg, #ffb02e, #ffc857) !important;
    }

    .bg-danger {
        background: linear-gradient(135deg, #ff2e88, #ff4d6d) !important;
    }

    .btn-primary {
        background: #00e5ff !important;
        border-color: #00e5ff !important;
        color: #06111c !important;
        font-weight: 700;
    }

    .btn-default {
        background: #263149 !important;
        border-color: #263149 !important;
        color: #f5f7fb !important;
    }

    .badge-info,
    .badge-outline-primary {
        background: rgba(0, 229, 255, .12) !important;
        border: 1px solid rgba(0, 229, 255, .3);
        color: #00e5ff !important;
    }
</style>

<div class="row">
    <?php foreach ($counts as $label => $total): ?>
        <div class="col-xl-2 col-md-4 col-sm-6 col-12">
            <div class="stat-card <?= esc($colors[$i % count($colors)]) ?>">
                <i class="<?= esc($icons[$label] ?? 'fas fa-chart-bar') ?> stat-icon"></i>
                <div class="stat-value"><?= esc($total) ?></div>
                <div class="stat-label"><?= esc($label) ?></div>
            </div>
        </div>
        <?php $i++; ?>
    <?php endforeach ?>
</div>

<div class="row">
    <div class="col-lg-6 col-md-12 d-flex">
        <div class="card card-box w-100">
            <div class="card-head">
                <header>การแข่งขันล่าสุด</header>
                <div class="pull-right">
                    <a class="btn btn-primary btn-xs" href="<?= site_url('adminz/tournaments/new') ?>">+ เพิ่มใหม่</a>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ชื่อการแข่งขัน</th>
                            <th>เกม</th>
                            <th>ประเภท</th>
                            <th>สถานะ</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($tournaments as $item): ?>
                        <tr>
                            <td><strong><?= esc($item['name']) ?></strong></td>
                            <td><?= esc($item['game_name']) ?></td>
                            <td><span class="badge badge-outline-primary"><?= esc($item['competition_type'] === 'team' ? 'ทีม' : 'เดี่ยว') ?></span></td>
                            <td>
                                <?php if ($item['status'] === 'open'): ?>
                                    <span class="badge badge-success">เปิดรับสมัคร</span>
                                <?php elseif ($item['status'] === 'closed'): ?>
                                    <span class="badge badge-danger">ปิดรับสมัคร</span>
                                <?php else: ?>
                                    <span class="badge badge-info"><?= esc($item['status']) ?></span>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-12 d-flex">
        <div class="card card-box w-100">
            <div class="card-head">
                <header>ผู้สมัครล่าสุด</header>
                <div class="pull-right">
                    <a class="btn btn-default btn-xs" href="<?= site_url('adminz/registrations') ?>">ดูทั้งหมด</a>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>การแข่งขัน</th>
                            <th>ทีม/ผู้สมัคร</th>
                            <th>สถานะ</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($registrations as $item): ?>
                        <tr>
                            <td><?= esc($item['tournament_name']) ?></td>
                            <td><?= esc($item['team_name'] ?: ($item['player_name'] ?? '-')) ?></td>
                            <td>
                                <?php if ($item['status'] === 'approved'): ?>
                                    <span class="badge badge-success">อนุมัติแล้ว</span>
                                <?php elseif ($item['status'] === 'pending'): ?>
                                    <span class="badge badge-warning">รอตรวจสอบ</span>
                                <?php else: ?>
                                    <span class="badge badge-danger">ปฏิเสธ</span>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card card-box">
            <div class="card-head">
                <header>ตารางแข่งขันถัดไป</header>
                <div class="pull-right">
                    <a class="btn btn-primary btn-xs" href="<?= site_url('adminz/schedules') ?>">จัดการตาราง</a>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>การแข่งขัน</th>
                            <th>รอบ</th>
                            <th>คู่แข่งขัน</th>
                            <th>เวลา</th>
                            <th>สถานที่</th>
                            <th>สถานะ</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($schedules as $item): ?>
                        <tr>
                            <td><?= esc($item['tournament_name']) ?></td>
                            <td><?= esc($item['round_name'] ?: '-') ?></td>
                            <td class="text-center">
                                <span class="badge badge-info"><?= esc($item['team_a'] ?? '-') ?></span>
                                <span class="m-x-10">VS</span>
                                <span class="badge badge-info"><?= esc($item['team_b'] ?? '-') ?></span>
                            </td>
                            <td><i class="far fa-clock m-r-5"></i><?= esc($item['scheduled_at'] ?: '-') ?></td>
                            <td><i class="fas fa-map-marker-alt m-r-5"></i><?= esc($item['venue'] ?: '-') ?></td>
                            <td>
                                <span class="badge badge-outline-secondary"><?= esc($item['status']) ?></span>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
