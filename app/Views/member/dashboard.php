<?= $this->extend('layouts/member') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-4">
        <div class="member-stat"><div class="value"><?= esc(count($members)) ?></div><div class="label">สมาชิกในทีม</div></div>
    </div>
    <div class="col-md-4">
        <div class="member-stat"><div class="value"><?= esc($registrations) ?></div><div class="label">รายการที่สมัคร</div></div>
    </div>
    <div class="col-md-4">
        <div class="member-stat"><div class="value"><?= esc(count($schedules)) ?></div><div class="label">ตารางแข่งล่าสุด</div></div>
    </div>
</div>
<div class="member-card">
    <h4><?= esc($team['name'] ?? 'ยังไม่มีทีม') ?></h4>
    <p>Role: <span class="status-pill"><?= esc(session('role')) ?></span></p>
    <p><?= esc($team['description'] ?? 'ยังไม่มีข้อมูลทีม') ?></p>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="member-card">
            <h5>สมาชิกทีม</h5>
            <div class="table-responsive"><table class="table member-table"><tbody><?php foreach ($members as $m): ?><tr><td><?= esc($m['username']) ?></td><td><?= esc($m['role']) ?></td></tr><?php endforeach ?></tbody></table></div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="member-card">
            <h5>ตารางแข่งขันล่าสุด</h5>
            <div class="table-responsive"><table class="table member-table"><tbody><?php foreach ($schedules as $s): ?><tr><td><?= esc($s['round_name'] ?: '-') ?></td><td><?= esc($s['scheduled_at'] ?: '-') ?></td><td><?= esc($s['status']) ?></td></tr><?php endforeach ?></tbody></table></div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
