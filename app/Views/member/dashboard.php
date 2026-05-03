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
    $teamTag = $team['tag'] ?? 'N/A';
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

<section class="member-player-details">
    <div class="team-details-info player-details member-player-card">
        <div class="team-details-wrap">
            <div class="player-team">
                <a href="<?= site_url('member/team') ?>"><img src="<?= base_url('template/html/assets/img/team-logo-2.png') ?>" alt="team logo"></a>
                <h3><a href="<?= site_url('member/team') ?>"><?= esc($teamName) ?></a></h3>
                <span><?= esc($teamTag) ?></span>
            </div>
            <ul class="social-list">
                <li>ติดต่อ:</li>
                <li><a href="<?= site_url('member/profile') ?>" title="Profile"><i class="las la-user-edit"></i></a></li>
                <li><a href="<?= site_url('member/tournaments') ?>" title="Tournaments"><i class="las la-trophy"></i></a></li>
                <li><a href="<?= site_url('member/reports') ?>" title="Reports"><i class="las la-chart-bar"></i></a></li>
            </ul>
            <ul class="player-info">
                <li>
                    <div><i class="las la-id-badge"></i><span>บทบาท</span></div>
                    <h4><?= esc($roleLabel) ?></h4>
                </li>
                <li>
                    <div><i class="las la-birthday-cake"></i><span>อายุ</span></div>
                    <h4><?= esc($age) ?></h4>
                </li>
                <li>
                    <div><i class="las la-trophy"></i><span>เข้าร่วม</span></div>
                    <h4><?= esc($registrationTotal) ?> รายการ</h4>
                </li>
            </ul>
        </div>
    </div>

    <section class="about-team-section member-about-panel">
        <div class="row align-items-center">
            <div class="col-lg-6 sm-padding">
                <div class="section-heading">
                    <h3>Player Profile</h3>
                    <h2><?= esc($displayName) ?> <span><?= esc($roleLabel) ?></span></h2>
                    <p><?= esc($profile['description'] ?? 'เพิ่มคำอธิบายตัวเอง เพื่อให้ทีมและผู้จัดการแข่งขันเข้าใจบทบาท ประสบการณ์ และช่องทางประสานงานของคุณได้ชัดเจนขึ้น') ?></p>
                    <div class="member-contact-strip">
                        <i class="las la-comments"></i>
                        <span><?= esc($profile['contact_channel'] ?? 'ยังไม่ได้ระบุช่องทางติดต่อ') ?></span>
                    </div>
                    <div class="member-action-row">
                        <a class="default-btn" href="<?= site_url('member/profile') ?>"><i class="las la-user-edit"></i> แก้ไขโปรไฟล์</a>
                        <a class="default-btn alt" href="<?= site_url('member/team') ?>"><i class="las la-users"></i> ทีมของฉัน</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 sm-padding">
                <div class="player-thumb member-profile-art">
                    <img src="<?= base_url('template/html/assets/img/player-thumb.jpg') ?>" alt="player">
                </div>
            </div>
        </div>
    </section>

    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="member-stat"><div class="value"><?= esc(count($members)) ?></div><div class="label">สมาชิกในทีม</div><i class="las la-users icon"></i></div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="member-stat"><div class="value"><?= esc($registrationTotal) ?></div><div class="label">รายการที่เข้าร่วม</div><i class="las la-trophy icon"></i></div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="member-stat"><div class="value"><?= esc($statusCounts['approved']) ?></div><div class="label">อนุมัติแล้ว</div><i class="las la-check-circle icon"></i></div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="member-stat"><div class="value"><?= esc(count($schedules)) ?></div><div class="label">แมตช์ที่เกี่ยวข้อง</div><i class="las la-calendar icon"></i></div>
        </div>
    </div>

    <section class="latest-gameplay member-gameplay">
        <div class="section-heading text-center mb-40">
            <h3>Member Control</h3>
            <h2>เมนูใช้งาน <span>สำหรับสมาชิก</span></h2>
            <p>จัดการโปรไฟล์ ตรวจสอบทีม สมัครแข่งขัน และติดตามผลการแข่งขันของคุณได้จากหน้าเดียว</p>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 sm-padding">
                <div class="gameplay-card">
                    <img src="<?= base_url('template/html/assets/img/post-1.jpg') ?>" alt="profile">
                    <div class="gameplay-info">
                        <ul class="post-meta"><li><i class="las la-user"></i>ข้อมูลสมาชิก</li></ul>
                        <h2>โปรไฟล์ของฉัน</h2>
                        <a class="member-card-link" href="<?= site_url('member/profile') ?>">แก้ไขข้อมูล</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 sm-padding">
                <div class="gameplay-card">
                    <img src="<?= base_url('template/html/assets/img/post-2.jpg') ?>" alt="team">
                    <div class="gameplay-info">
                        <ul class="post-meta"><li><i class="las la-users"></i><?= esc($teamName) ?></li></ul>
                        <h2>ทีมและสมาชิก</h2>
                        <a class="member-card-link" href="<?= site_url('member/team') ?>">ดูทีม</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 sm-padding">
                <div class="gameplay-card">
                    <img src="<?= base_url('template/html/assets/img/post-3.jpg') ?>" alt="tournament">
                    <div class="gameplay-info">
                        <ul class="post-meta"><li><i class="las la-trophy"></i>สมัครแข่งขัน</li></ul>
                        <h2>ทัวร์นาเมนต์</h2>
                        <a class="member-card-link" href="<?= site_url('member/tournaments') ?>">ดูรายการ</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
                    <div class="empty-state">ยังไม่มีการแข่งขันที่เปิดรับสมัคร</div>
                <?php endif ?>
                <?php foreach ($openTournaments as $tournament): ?>
                    <div class="tournament-mini">
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
</section>
<?= $this->endSection() ?>
