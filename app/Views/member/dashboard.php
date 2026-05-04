<?= $this->extend('layouts/member') ?>
<?= $this->section('content') ?>
<?php
    $roleLabels = [
        'team_manager' => 'ผู้จัดการทีม',
        'coach' => 'ผู้ฝึกสอน',
        'amateur_athlete' => 'นักกีฬาทั่วไป',
        'pro_athlete' => 'นักกีฬาอาชีพ',
    ];
    $statusLabels = [
        'pending' => 'รอตรวจสอบ',
        'approved' => 'อนุมัติแล้ว',
        'rejected' => 'ไม่อนุมัติ',
        'withdrawn' => 'ถอนตัว',
    ];
    $roleLabel = $roleLabels[session('role')] ?? session('role');
    $displayName = $profile['display_name'] ?? session('username');
    $teamName = $team['name'] ?? 'ยังไม่มีทีม';
    $avatar = ! empty($profile['avatar'])
        ? base_url($profile['avatar'])
        : base_url('templates/source/assets/img/dp.jpg');
    $birthDate = $profile['birth_date'] ?? null;
    $age = '-';

    if ($birthDate) {
        try {
            $age = (new DateTimeImmutable($birthDate))->diff(new DateTimeImmutable('today'))->y . ' ปี';
        } catch (Throwable) {
            $age = '-';
        }
    }
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

    .sidebar-user-details .user-name,
    .member-card h4,
    .member-card h5,
    .member-card strong {
        color: #f5f7fb !important;
    }

    .sidebar-user-details .user-role,
    .text-muted,
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

    .profile-hero {
        background:
            radial-gradient(circle at 82% 16%, rgba(255, 46, 136, .24), transparent 28%),
            linear-gradient(135deg, #101624, #161d2f) !important;
        border: 1px solid #263149;
        box-shadow: 0 20px 54px rgba(0, 0, 0, .28);
    }

    .profile-hero:after {
        background: rgba(0, 229, 255, .10) !important;
    }

    .member-card {
        background: #161d2f !important;
        border: 1px solid #263149 !important;
        box-shadow: 0 18px 48px rgba(0, 0, 0, .22) !important;
    }

    .member-label {
        color: #00e5ff !important;
    }

    .member-table {
        color: #d8dfef;
    }

    .member-table thead th {
        background: #101624 !important;
        color: #9aa7bd !important;
        border-color: #263149 !important;
    }

    .member-table td {
        border-color: #263149 !important;
    }

    .member-table tbody tr:hover {
        background: rgba(255, 255, 255, .035) !important;
    }

    .member-stat {
        border: 1px solid rgba(255, 255, 255, .08);
        box-shadow: 0 18px 44px rgba(0, 0, 0, .22);
    }

    .bg-member-blue {
        background: linear-gradient(135deg, #00a7ff, #00e5ff) !important;
    }

    .bg-member-purple {
        background: linear-gradient(135deg, #7c3aed, #ff2e88) !important;
    }

    .bg-member-green {
        background: linear-gradient(135deg, #08b982, #18d39e) !important;
    }

    .bg-member-orange {
        background: linear-gradient(135deg, #ffb02e, #ffc857) !important;
    }

    .btn.default-btn,
    .btn-primary {
        background: #00e5ff !important;
        border-color: #00e5ff !important;
        color: #06111c !important;
        font-weight: 700;
    }

    .btn-outline-primary,
    .btn-light {
        background: transparent !important;
        border-color: #263149 !important;
        color: #f5f7fb !important;
    }

    .btn-outline-primary:hover,
    .btn-light:hover {
        border-color: #00e5ff !important;
        color: #00e5ff !important;
    }

    .status-pill {
        background: rgba(0, 229, 255, .10) !important;
        border: 1px solid rgba(0, 229, 255, .28);
        color: #00e5ff !important;
    }

    .empty-state {
        background: #101624 !important;
        border-color: #263149 !important;
        color: #9aa7bd !important;
    }

    .tournament-mini {
        border-bottom-color: #263149 !important;
    }
</style>

<div class="profile-hero">
    <div class="row align-items-center">
        <div class="col-md-8 d-flex align-items-center gap-3">
            <img class="profile-avatar" src="<?= esc($avatar, 'attr') ?>" alt="member">
            <div>
                <h3><?= esc($displayName) ?></h3>
                <div><?= esc($roleLabel) ?> · <?= esc($teamName) ?></div>
                <div class="mt-2"><?= esc($profile['contact_channel'] ?? 'ยังไม่ได้ระบุช่องทางติดต่อ') ?></div>
            </div>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <a class="btn default-btn" href="<?= site_url('member/profile') ?>"><i class="fa fa-user-pen"></i> แก้ไขโปรไฟล์</a>
            <a class="btn btn-light ms-2" href="<?= site_url('member/team') ?>"><i class="fa fa-users"></i> ทีมของฉัน</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="member-stat bg-member-blue"><div class="value"><?= esc(count($members)) ?></div><div class="label">สมาชิกในทีม</div><i class="fa fa-users icon"></i></div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="member-stat bg-member-purple"><div class="value"><?= esc($registrationTotal) ?></div><div class="label">รายการที่เข้าร่วม</div><i class="fa fa-trophy icon"></i></div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="member-stat bg-member-green"><div class="value"><?= esc($statusCounts['approved']) ?></div><div class="label">อนุมัติแล้ว</div><i class="fa fa-circle-check icon"></i></div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="member-stat bg-member-orange"><div class="value"><?= esc(count($schedules)) ?></div><div class="label">แมตช์ที่เกี่ยวข้อง</div><i class="fa fa-calendar-days icon"></i></div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="member-card">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <div class="member-label">ภาพรวมสมาชิก</div>
                    <h4>ข้อมูลการแข่งขันของคุณ</h4>
                </div>
                <span class="status-pill"><?= esc($age) ?></span>
            </div>
            <p class="text-muted mb-4"><?= esc($profile['description'] ?? 'เพิ่มคำอธิบายตัวเองเพื่อให้ทีมและผู้จัดการแข่งขันเข้าใจประสบการณ์และบทบาทของคุณได้ชัดเจนขึ้น') ?></p>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="member-label">ทีมปัจจุบัน</div>
                    <strong><?= esc($teamName) ?></strong>
                    <p class="text-muted mb-0"><?= esc($team['description'] ?? 'ยังไม่มีคำอธิบายทีม') ?></p>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="member-label">บทบาทในระบบ</div>
                    <strong><?= esc($roleLabel) ?></strong>
                    <p class="text-muted mb-0">สิทธิ์การใช้งานเป็นไปตามบทบาทที่ admin กำหนด</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="member-card">
            <h5>เมนูลัด</h5>
            <div class="quick-actions mt-3">
                <a class="btn default-btn" href="<?= site_url('member/tournaments') ?>"><i class="fa fa-trophy me-2"></i> สมัครแข่งขัน</a>
                <a class="btn btn-outline-primary" href="<?= site_url('member/profile') ?>"><i class="fa fa-user me-2"></i> แก้ไขโปรไฟล์</a>
                <a class="btn btn-outline-primary" href="<?= site_url('member/team') ?>"><i class="fa fa-users me-2"></i> ดูข้อมูลทีม</a>
                <a class="btn btn-outline-primary" href="<?= site_url('member/reports') ?>"><i class="fa fa-chart-column me-2"></i> ดูรายงาน</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-7">
        <div class="member-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">การแข่งขันที่เข้าร่วมล่าสุด</h5>
                <a href="<?= site_url('member/reports') ?>">ดูทั้งหมด</a>
            </div>
            <div class="table-responsive">
                <table class="table member-table">
                    <thead><tr><th>รายการ</th><th>เกม</th><th>ประเภท</th><th>สถานะ</th></tr></thead>
                    <tbody>
                    <?php if ($registrations === []): ?>
                        <tr><td colspan="4"><div class="empty-state">ยังไม่มีรายการสมัครแข่งขัน</div></td></tr>
                    <?php endif ?>
                    <?php foreach ($registrations as $item): ?>
                        <tr>
                            <td><?= esc($item['tournament_name']) ?></td>
                            <td><?= esc($item['game_name']) ?></td>
                            <td><?= esc($item['competition_type'] === 'team' ? 'ทีม' : 'เดี่ยว') ?></td>
                            <td><span class="status-pill <?= esc($item['status']) ?>"><?= esc($statusLabels[$item['status']] ?? $item['status']) ?></span></td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="member-card">
            <h5>การแข่งขันที่เปิดรับสมัคร</h5>
            <?php if ($openTournaments === []): ?>
                <div class="empty-state mt-3">ยังไม่มีการแข่งขันที่เปิดรับสมัคร</div>
            <?php endif ?>
            <?php foreach ($openTournaments as $tournament): ?>
                <div class="tournament-mini">
                    <div>
                        <strong><?= esc($tournament['name']) ?></strong>
                        <p class="mb-0 text-muted"><?= esc($tournament['game_name']) ?> · <?= esc($tournament['competition_type'] === 'team' ? 'ทีม' : 'เดี่ยว') ?></p>
                    </div>
                    <a class="btn default-btn" href="<?= site_url('member/tournaments') ?>">สมัคร</a>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="member-card">
            <h5>สมาชิกทีม</h5>
            <div class="table-responsive">
                <table class="table member-table">
                    <tbody>
                    <?php if ($members === []): ?><tr><td><div class="empty-state">ยังไม่มีสมาชิกทีม</div></td></tr><?php endif ?>
                    <?php foreach ($members as $member): ?>
                        <tr><td><?= esc($member['username']) ?></td><td><?= esc($roleLabels[$member['role']] ?? $member['role']) ?></td></tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="member-card">
            <h5>ตารางแข่งขันที่เกี่ยวข้อง</h5>
            <div class="table-responsive">
                <table class="table member-table">
                    <thead><tr><th>รายการ</th><th>คู่แข่งขัน</th><th>เวลา</th><th>สถานะ</th></tr></thead>
                    <tbody>
                    <?php if ($schedules === []): ?><tr><td colspan="4"><div class="empty-state">ยังไม่มีตารางแข่งขัน</div></td></tr><?php endif ?>
                    <?php foreach ($schedules as $schedule): ?>
                        <tr>
                            <td><?= esc($schedule['tournament_name']) ?></td>
                            <td><?= esc(($schedule['team_a'] ?? '-') . ' vs ' . ($schedule['team_b'] ?? '-')) ?></td>
                            <td><?= esc($schedule['scheduled_at'] ?: '-') ?></td>
                            <td><?= esc($schedule['status']) ?></td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
