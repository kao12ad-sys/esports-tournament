<?= $this->extend('layouts/member') ?>
<?= $this->section('content') ?>
<?php
    $roleLabels = [
        'team_manager' => 'ผู้จัดการทีม',
        'coach' => 'ผู้ฝึกสอน',
        'amateur_athlete' => 'นักกีฬาทั่วไป',
        'pro_athlete' => 'นักกีฬาอาชีพ',
    ];
    $roleLabel = $roleLabels[session('role')] ?? session('role');
?>

<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="member-stat"><div class="value"><?= esc(count($members)) ?></div><div class="label">สมาชิกในทีม</div></div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="member-stat"><div class="value"><?= esc($registrationTotal) ?></div><div class="label">รายการที่เข้าร่วม</div></div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="member-stat"><div class="value"><?= esc($statusCounts['approved']) ?></div><div class="label">อนุมัติแล้ว</div></div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="member-stat"><div class="value"><?= esc(count($schedules)) ?></div><div class="label">แมตช์ที่เกี่ยวข้อง</div></div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="member-card">
            <div class="d-flex flex-wrap justify-content-between align-items-start gap-3">
                <div>
                    <p class="member-label">ทีมปัจจุบัน</p>
                    <h4><?= esc($team['name'] ?? 'ยังไม่มีทีม') ?></h4>
                    <p><?= esc($team['description'] ?? 'หากยังไม่มีทีม สามารถสมัครแข่งขันเดี่ยว หรือรอผู้จัดการทีมเชิญ/ให้ admin กำหนดทีม') ?></p>
                </div>
                <span class="status-pill"><?= esc($roleLabel) ?></span>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <p class="member-label">ชื่อแสดงผล</p>
                    <p><?= esc($profile['display_name'] ?? session('username')) ?></p>
                </div>
                <div class="col-md-6">
                    <p class="member-label">ช่องทางติดต่อ</p>
                    <p><?= esc($profile['contact_channel'] ?? '-') ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="member-card">
            <h5>เมนูลัด</h5>
            <div class="d-grid gap-2">
                <a class="default-btn text-center" href="<?= site_url('member/tournaments') ?>">สมัครแข่งขัน</a>
                <a class="default-btn text-center" href="<?= site_url('member/profile') ?>">แก้ไขโปรไฟล์</a>
                <a class="default-btn text-center" href="<?= site_url('member/team') ?>">ดูข้อมูลทีม</a>
                <a class="default-btn text-center" href="<?= site_url('member/reports') ?>">ดูรายงาน</a>
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
                        <tr><td colspan="4">ยังไม่มีรายการสมัครแข่งขัน</td></tr>
                    <?php endif ?>
                    <?php foreach ($registrations as $item): ?>
                        <tr>
                            <td><?= esc($item['tournament_name']) ?></td>
                            <td><?= esc($item['game_name']) ?></td>
                            <td><?= esc($item['competition_type'] === 'team' ? 'ทีม' : 'เดี่ยว') ?></td>
                            <td><span class="status-pill"><?= esc($item['status']) ?></span></td>
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
                <p>ยังไม่มีการแข่งขันที่เปิดรับสมัคร</p>
            <?php endif ?>
            <?php foreach ($openTournaments as $tournament): ?>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <strong><?= esc($tournament['name']) ?></strong>
                        <p class="mb-0"><?= esc($tournament['game_name']) ?> · <?= esc($tournament['competition_type'] === 'team' ? 'ทีม' : 'เดี่ยว') ?></p>
                    </div>
                    <a class="default-btn" href="<?= site_url('member/tournaments') ?>">สมัคร</a>
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
                    <?php if ($members === []): ?><tr><td>ยังไม่มีสมาชิกทีม</td></tr><?php endif ?>
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
                    <?php if ($schedules === []): ?><tr><td colspan="4">ยังไม่มีตารางแข่งขัน</td></tr><?php endif ?>
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
