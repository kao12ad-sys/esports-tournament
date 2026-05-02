<?= $this->extend('layouts/member') ?>
<?= $this->section('content') ?>
<?php if ($team): ?>
<form class="cardx" method="post" action="<?= site_url('member/team') ?>">
    <?= csrf_field() ?>
    <input class="form-control" name="name" value="<?= esc($team['name']) ?>" <?= session('role') !== 'team_manager' ? 'readonly' : '' ?>>
    <input class="form-control" name="tag" value="<?= esc($team['tag']) ?>" <?= session('role') !== 'team_manager' ? 'readonly' : '' ?>>
    <textarea class="form-control" name="description" <?= session('role') !== 'team_manager' ? 'readonly' : '' ?>><?= esc($team['description']) ?></textarea>
    <input class="form-control" name="contact_channel" value="<?= esc($team['contact_channel']) ?>" <?= session('role') !== 'team_manager' ? 'readonly' : '' ?>>
    <?php if (session('role') === 'team_manager'): ?><button class="btn btn-primary">บันทึกข้อมูลทีม</button><?php endif ?>
</form>
<?php endif ?>
<div class="cardx"><h5>รายชื่อสมาชิกทีม</h5><table class="table"><tbody><?php foreach ($members as $m): ?><tr><td><?= esc($m['username']) ?></td><td><?= esc($m['role']) ?></td></tr><?php endforeach ?></tbody></table></div>
<div class="cardx"><h5>ประวัติการย้ายทีม</h5><table class="table"><tbody><?php foreach ($histories as $h): ?><tr><td><?= esc($h['username']) ?></td><td><?= esc($h['team_name']) ?></td><td><?= esc($h['joined_at']) ?> - <?= esc($h['left_at'] ?? 'ปัจจุบัน') ?></td></tr><?php endforeach ?></tbody></table></div>
<?= $this->endSection() ?>
