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

<div class="profile-hero">
    <div class="row align-items-center">
        <div class="col-md-8 d-flex align-items-center gap-3">
            <img class="profile-avatar" src="<?= base_url('templates/source/assets/img/dp.jpg') ?>" alt="member">
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
