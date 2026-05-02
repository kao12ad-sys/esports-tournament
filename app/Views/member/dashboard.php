<?= $this->extend('layouts/member') ?>
<?= $this->section('content') ?>
<div class="cardx">
    <h4><?= esc($team['name'] ?? 'ยังไม่มีทีม') ?></h4>
    <p>Role: <?= esc(session('role')) ?> · รายการที่สมัคร: <?= esc($registrations) ?></p>
</div>
<div class="cardx"><h5>สมาชิกทีม</h5><table class="table"><tbody><?php foreach ($members as $m): ?><tr><td><?= esc($m['username']) ?></td><td><?= esc($m['role']) ?></td></tr><?php endforeach ?></tbody></table></div>
<div class="cardx"><h5>ตารางแข่งล่าสุด</h5><table class="table"><tbody><?php foreach ($schedules as $s): ?><tr><td><?= esc($s['round_name']) ?></td><td><?= esc($s['scheduled_at']) ?></td><td><?= esc($s['status']) ?></td></tr><?php endforeach ?></tbody></table></div>
<?= $this->endSection() ?>
