<?= $this->extend('layouts/member') ?>
<?= $this->section('content') ?>
<div class="member-card">
    <div class="d-flex justify-content-between align-items-start mb-3">
        <div>
            <div class="member-label">Tournament Detail</div>
            <h3><?= esc($tournament['name']) ?></h3>
            <p class="text-muted mb-0"><?= esc($tournament['game_name']) ?> · <?= esc($tournament['competition_type'] === 'team' ? 'ทีม' : 'เดี่ยว') ?> · <?= esc($tournament['division'] ?: '-') ?></p>
        </div>
        <span class="status-pill <?= esc($tournament['status']) ?>"><?= esc($tournament['status']) ?></span>
    </div>
    <div class="row">
        <div class="col-md-3"><div class="member-label">จำนวนผู้เล่น</div><strong><?= esc($tournament['min_players'] ?? 1) ?>-<?= esc($tournament['max_players'] ?? ($tournament['min_players'] ?? 1)) ?> คน</strong></div>
        <div class="col-md-3"><div class="member-label">เปิดรับสมัคร</div><strong><?= esc($tournament['registration_open_at'] ?: '-') ?></strong></div>
        <div class="col-md-3"><div class="member-label">ปิดรับสมัคร</div><strong><?= esc($tournament['registration_close_at'] ?: '-') ?></strong></div>
        <div class="col-md-3"><div class="member-label">สถานที่</div><strong><?= esc($tournament['venue'] ?: '-') ?></strong></div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <div class="member-card">
            <h5>เกณฑ์การรับสมัคร</h5>
            <p class="text-muted"><?= nl2br(esc($tournament['application_criteria'] ?: '-')) ?></p>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="member-card">
            <h5>กฎกติกา</h5>
            <p class="text-muted"><?= nl2br(esc($tournament['rules'] ?: '-')) ?></p>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="member-card">
            <h5>รูปแบบการแข่งขัน</h5>
            <p class="text-muted"><?= nl2br(esc($tournament['format'] ?: '-')) ?></p>
        </div>
    </div>
</div>

<a class="btn default-btn" href="<?= site_url('member/tournaments') ?>">กลับไปรายการการแข่งขัน</a>
<?= $this->endSection() ?>
