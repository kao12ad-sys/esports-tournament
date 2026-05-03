<?= $this->extend('layouts/member') ?>
<?= $this->section('content') ?>
<div class="member-card">
    <h5>การแข่งขันที่เข้าร่วม</h5>
    <div class="table-responsive">
        <table class="table member-table">
            <thead><tr><th>รายการ</th><th>สถานะ</th><th>หมายเหตุ</th></tr></thead>
            <tbody><?php foreach ($registrations as $r): ?><tr><td><?= esc($r['tournament_name']) ?></td><td><span class="status-pill"><?= esc($r['status']) ?></span></td><td><?= esc($r['note'] ?: '-') ?></td></tr><?php endforeach ?></tbody>
        </table>
    </div>
</div>
<div class="member-card">
    <h5>ตารางแข่งขัน</h5>
    <div class="table-responsive">
        <table class="table member-table">
            <thead><tr><th>รอบ</th><th>เวลา</th><th>สถานที่</th><th>สถานะ</th></tr></thead>
            <tbody><?php foreach ($schedules as $s): ?><tr><td><?= esc($s['round_name'] ?: '-') ?></td><td><?= esc($s['scheduled_at'] ?: '-') ?></td><td><?= esc($s['venue'] ?: '-') ?></td><td><?= esc($s['status']) ?></td></tr><?php endforeach ?></tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
