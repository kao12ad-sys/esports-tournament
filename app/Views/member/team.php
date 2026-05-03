<?= $this->extend('layouts/member') ?>
<?= $this->section('content') ?>
<?php if ($team): ?>
<form class="member-card" method="post" action="<?= site_url('member/team') ?>">
    <?= csrf_field() ?>
    <h4>ข้อมูลทีม</h4>
    <div class="row">
        <div class="col-md-6"><div class="member-label">ชื่อทีม</div><input class="form-control" name="name" value="<?= esc($team['name']) ?>" <?= session('role') !== 'team_manager' ? 'readonly' : '' ?>></div>
        <div class="col-md-6"><div class="member-label">ตัวย่อทีม</div><input class="form-control" name="tag" value="<?= esc($team['tag']) ?>" <?= session('role') !== 'team_manager' ? 'readonly' : '' ?>></div>
        <div class="col-md-12"><div class="member-label">คำอธิบาย</div><textarea class="form-control" name="description" <?= session('role') !== 'team_manager' ? 'readonly' : '' ?>><?= esc($team['description']) ?></textarea></div>
        <div class="col-md-12"><div class="member-label">ช่องทางติดต่อทีม</div><input class="form-control" name="contact_channel" value="<?= esc($team['contact_channel']) ?>" <?= session('role') !== 'team_manager' ? 'readonly' : '' ?>></div>
    </div>
    <?php if (session('role') === 'team_manager'): ?><button class="default-btn">บันทึกข้อมูลทีม</button><?php endif ?>
</form>
<?php endif ?>
<div class="row">
    <div class="col-lg-6"><div class="member-card"><h5>รายชื่อสมาชิกทีม</h5><div class="table-responsive"><table class="table member-table"><tbody><?php foreach ($members as $m): ?><tr><td><?= esc($m['username']) ?></td><td><?= esc($m['role']) ?></td></tr><?php endforeach ?></tbody></table></div></div></div>
    <div class="col-lg-6"><div class="member-card"><h5>ประวัติการย้ายทีม</h5><div class="table-responsive"><table class="table member-table"><tbody><?php foreach ($histories as $h): ?><tr><td><?= esc($h['username']) ?></td><td><?= esc($h['team_name']) ?></td><td><?= esc($h['joined_at']) ?> - <?= esc($h['left_at'] ?? 'ปัจจุบัน') ?></td></tr><?php endforeach ?></tbody></table></div></div></div>
</div>
<?= $this->endSection() ?>
