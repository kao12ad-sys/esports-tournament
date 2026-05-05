<?= $this->extend('layouts/member') ?>
<?= $this->section('content') ?>
<?php
    $roleLabels = [
        'team_manager' => 'เธเธนเนเธเธฑเธ”เธเธฒเธฃเธ—เธตเธก',
        'coach' => 'เธเธนเนเธเธถเธเธชเธญเธ',
        'amateur_athlete' => 'เธเธฑเธเธเธตเธฌเธฒเธ—เธฑเนเธงเนเธ',
        'pro_athlete' => 'เธเธฑเธเธเธตเธฌเธฒเธญเธฒเธเธตเธ',
    ];
    $statusLabels = [
        'pending' => 'เธฃเธญเธ•เธฃเธงเธเธชเธญเธ',
        'approved' => 'เธญเธเธธเธกเธฑเธ•เธดเนเธฅเนเธง',
        'rejected' => 'เนเธกเนเธญเธเธธเธกเธฑเธ•เธด',
        'withdrawn' => 'เธ–เธญเธเธ•เธฑเธง',
    ];
    $roleLabel = $roleLabels[session('role')] ?? session('role');
    $displayName = $profile['display_name'] ?? session('username');
    $teamName = $team['name'] ?? 'เธขเธฑเธเนเธกเนเธกเธตเธ—เธตเธก';
    $avatar = ! empty($profile['avatar'])
        ? base_url($profile['avatar'])
        : base_url('templates/source/assets/img/dp.jpg');
    $birthDate = $profile['birth_date'] ?? null;
    $age = '-';

    if ($birthDate) {
        try {
            $age = (new DateTimeImmutable($birthDate))->diff(new DateTimeImmutable('today'))->y . ' เธเธต';
        } catch (Throwable) {
            $age = '-';
        }
    }
?>

<div class="profile-hero">
    <div class="row align-items-center">
        <div class="col-md-8 d-flex align-items-center gap-3">
            <img class="profile-avatar" src="<?= esc($avatar, 'attr') ?>" alt="member">
            <div>
                <h3><?= esc($displayName) ?></h3>
                <div><?= esc($roleLabel) ?> ยท <?= esc($teamName) ?></div>
                <div class="mt-2"><?= esc($profile['contact_channel'] ?? 'เธขเธฑเธเนเธกเนเนเธ”เนเธฃเธฐเธเธธเธเนเธญเธเธ—เธฒเธเธ•เธดเธ”เธ•เนเธญ') ?></div>
            </div>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <a class="btn default-btn" href="<?= site_url('member/profile') ?>"><i class="fa fa-user-pen"></i> เนเธเนเนเธเนเธเธฃเนเธเธฅเน</a>
            <a class="btn btn-light ms-2" href="<?= site_url('member/team') ?>"><i class="fa fa-users"></i> เธ—เธตเธกเธเธญเธเธเธฑเธ</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="member-stat bg-member-blue"><div class="value"><?= esc(count($members)) ?></div><div class="label">เธชเธกเธฒเธเธดเธเนเธเธ—เธตเธก</div><i class="fa fa-users icon"></i></div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="member-stat bg-member-purple"><div class="value"><?= esc($registrationTotal) ?></div><div class="label">เธฃเธฒเธขเธเธฒเธฃเธ—เธตเนเน€เธเนเธฒเธฃเนเธงเธก</div><i class="fa fa-trophy icon"></i></div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="member-stat bg-member-green"><div class="value"><?= esc($statusCounts['approved']) ?></div><div class="label">เธญเธเธธเธกเธฑเธ•เธดเนเธฅเนเธง</div><i class="fa fa-circle-check icon"></i></div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="member-stat bg-member-orange"><div class="value"><?= esc(count($schedules)) ?></div><div class="label">เนเธกเธ•เธเนเธ—เธตเนเน€เธเธตเนเธขเธงเธเนเธญเธ</div><i class="fa fa-calendar-days icon"></i></div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="member-card">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <div class="member-label">เธ เธฒเธเธฃเธงเธกเธชเธกเธฒเธเธดเธ</div>
                    <h4>เธเนเธญเธกเธนเธฅเธเธฒเธฃเนเธเนเธเธเธฑเธเธเธญเธเธเธธเธ“</h4>
                </div>
                <span class="status-pill"><?= esc($age) ?></span>
            </div>
            <p class="text-muted mb-4"><?= esc($profile['description'] ?? 'เน€เธเธดเนเธกเธเธณเธญเธเธดเธเธฒเธขเธ•เธฑเธงเน€เธญเธเน€เธเธทเนเธญเนเธซเนเธ—เธตเธกเนเธฅเธฐเธเธนเนเธเธฑเธ”เธเธฒเธฃเนเธเนเธเธเธฑเธเน€เธเนเธฒเนเธเธเธฃเธฐเธชเธเธเธฒเธฃเธ“เนเนเธฅเธฐเธเธ—เธเธฒเธ—เธเธญเธเธเธธเธ“เนเธ”เนเธเธฑเธ”เน€เธเธเธเธถเนเธ') ?></p>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="member-label">เธ—เธตเธกเธเธฑเธเธเธธเธเธฑเธ</div>
                    <strong><?= esc($teamName) ?></strong>
                    <p class="text-muted mb-0"><?= esc($team['description'] ?? 'เธขเธฑเธเนเธกเนเธกเธตเธเธณเธญเธเธดเธเธฒเธขเธ—เธตเธก') ?></p>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="member-label">เธเธ—เธเธฒเธ—เนเธเธฃเธฐเธเธ</div>
                    <strong><?= esc($roleLabel) ?></strong>
                    <p class="text-muted mb-0">เธชเธดเธ—เธเธดเนเธเธฒเธฃเนเธเนเธเธฒเธเน€เธเนเธเนเธเธ•เธฒเธกเธเธ—เธเธฒเธ—เธ—เธตเน admin เธเธณเธซเธเธ”</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="member-card">
            <h5>เน€เธกเธเธนเธฅเธฑเธ”</h5>
            <div class="quick-actions mt-3">
                <a class="btn default-btn" href="<?= site_url('member/tournaments') ?>"><i class="fa fa-trophy me-2"></i> เธชเธกเธฑเธเธฃเนเธเนเธเธเธฑเธ</a>
                <a class="btn btn-outline-primary" href="<?= site_url('member/profile') ?>"><i class="fa fa-user me-2"></i> เนเธเนเนเธเนเธเธฃเนเธเธฅเน</a>
                <a class="btn btn-outline-primary" href="<?= site_url('member/team') ?>"><i class="fa fa-users me-2"></i> เธ”เธนเธเนเธญเธกเธนเธฅเธ—เธตเธก</a>
                <a class="btn btn-outline-primary" href="<?= site_url('member/reports') ?>"><i class="fa fa-chart-column me-2"></i> เธ”เธนเธฃเธฒเธขเธเธฒเธ</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-7">
        <div class="member-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">เธเธฒเธฃเนเธเนเธเธเธฑเธเธ—เธตเนเน€เธเนเธฒเธฃเนเธงเธกเธฅเนเธฒเธชเธธเธ”</h5>
                <a href="<?= site_url('member/reports') ?>">เธ”เธนเธ—เธฑเนเธเธซเธกเธ”</a>
            </div>
            <div class="table-responsive">
                <table class="table member-table">
                    <thead><tr><th>เธฃเธฒเธขเธเธฒเธฃ</th><th>เน€เธเธก</th><th>เธเธฃเธฐเน€เธ เธ—</th><th>เธชเธ–เธฒเธเธฐ</th></tr></thead>
                    <tbody>
                    <?php if ($registrations === []): ?>
                        <tr><td colspan="4"><div class="empty-state">เธขเธฑเธเนเธกเนเธกเธตเธฃเธฒเธขเธเธฒเธฃเธชเธกเธฑเธเธฃเนเธเนเธเธเธฑเธ</div></td></tr>
                    <?php endif ?>
                    <?php foreach ($registrations as $item): ?>
                        <tr>
                            <td><?= esc($item['tournament_name']) ?></td>
                            <td><?= esc($item['game_name']) ?></td>
                            <td><?= esc($item['competition_type'] === 'team' ? 'เธ—เธตเธก' : 'เน€เธ”เธตเนเธขเธง') ?></td>
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
            <h5>เธเธฒเธฃเนเธเนเธเธเธฑเธเธ—เธตเนเน€เธเธดเธ”เธฃเธฑเธเธชเธกเธฑเธเธฃ</h5>
            <?php if ($openTournaments === []): ?>
                <div class="empty-state mt-3">เธขเธฑเธเนเธกเนเธกเธตเธเธฒเธฃเนเธเนเธเธเธฑเธเธ—เธตเนเน€เธเธดเธ”เธฃเธฑเธเธชเธกเธฑเธเธฃ</div>
            <?php endif ?>
            <?php foreach ($openTournaments as $tournament): ?>
                <div class="tournament-mini">
                    <div>
                        <strong><?= esc($tournament['name']) ?></strong>
                        <p class="mb-0 text-muted"><?= esc($tournament['game_name']) ?> ยท <?= esc($tournament['competition_type'] === 'team' ? 'เธ—เธตเธก' : 'เน€เธ”เธตเนเธขเธง') ?></p>
                    </div>
                    <a class="btn default-btn" href="<?= site_url('member/tournaments') ?>">เธชเธกเธฑเธเธฃ</a>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="member-card">
            <h5>เธชเธกเธฒเธเธดเธเธ—เธตเธก</h5>
            <div class="table-responsive">
                <table class="table member-table">
                    <tbody>
                    <?php if ($members === []): ?><tr><td><div class="empty-state">เธขเธฑเธเนเธกเนเธกเธตเธชเธกเธฒเธเธดเธเธ—เธตเธก</div></td></tr><?php endif ?>
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
            <h5>เธ•เธฒเธฃเธฒเธเนเธเนเธเธเธฑเธเธ—เธตเนเน€เธเธตเนเธขเธงเธเนเธญเธ</h5>
            <div class="table-responsive">
                <table class="table member-table">
                    <thead><tr><th>เธฃเธฒเธขเธเธฒเธฃ</th><th>เธเธนเนเนเธเนเธเธเธฑเธ</th><th>เน€เธงเธฅเธฒ</th><th>เธชเธ–เธฒเธเธฐ</th></tr></thead>
                    <tbody>
                    <?php if ($schedules === []): ?><tr><td colspan="4"><div class="empty-state">เธขเธฑเธเนเธกเนเธกเธตเธ•เธฒเธฃเธฒเธเนเธเนเธเธเธฑเธ</div></td></tr><?php endif ?>
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
