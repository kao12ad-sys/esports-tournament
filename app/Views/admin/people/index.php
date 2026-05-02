<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<form class="cardx" method="post" action="<?= site_url('adminz/people') ?>">
    <?= csrf_field() ?>
    <div class="row">
        <div class="col-md-3"><input class="form-control" name="username" placeholder="ชื่อผู้ใช้/นามแฝง" required></div>
        <div class="col-md-3"><input class="form-control" type="email" name="email" placeholder="อีเมล" required></div>
        <div class="col-md-3"><input class="form-control" type="password" name="password" placeholder="รหัสผ่านอย่างน้อย 8 ตัว" minlength="8" required></div>
        <div class="col-md-3"><select class="form-select" name="role"><option value="team_manager">ผู้จัดการทีม</option><option value="coach">ผู้ฝึกสอน</option><option value="amateur_athlete">นักกีฬาทั่วไป</option><option value="pro_athlete">นักกีฬาอาชีพ</option></select></div>
        <div class="col-md-3"><select class="form-select" name="team_id"><option value="">ไม่สังกัดทีม</option><?php foreach ($teams as $team): ?><option value="<?= $team['id'] ?>"><?= esc($team['name']) ?></option><?php endforeach ?></select></div>
        <div class="col-md-3"><input class="form-control" name="display_name" placeholder="ชื่อแสดงผล"></div>
        <div class="col-md-3"><input class="form-control" type="date" name="birth_date"></div>
        <div class="col-md-3"><input class="form-control" name="contact_channel" placeholder="ช่องทางติดต่อ"></div>
    </div>
    <button class="btn btn-primary">เพิ่มสมาชิก</button>
</form>
<div class="cardx table-responsive"><table class="table"><thead><tr><th>ชื่อ</th><th>อีเมล</th><th>Role</th><th>ทีม</th><th>วันเกิด</th><th>ติดต่อ</th><th></th></tr></thead><tbody>
<?php foreach ($items as $item): ?><tr><td><?= esc($item['display_name'] ?: $item['username']) ?></td><td><?= esc($item['email']) ?></td><td><?= esc($item['role']) ?></td><td><?= esc($item['team_name'] ?? '-') ?></td><td><?= esc($item['birth_date'] ?? '-') ?></td><td><?= esc($item['contact_channel'] ?? '-') ?></td><td><form method="post" action="<?= site_url('adminz/people/' . $item['id']) ?>"><?= csrf_field() ?><input type="hidden" name="_method" value="DELETE"><button class="btn btn-sm btn-outline-danger">ลบ</button></form></td></tr><?php endforeach ?>
</tbody></table></div>
<?= $this->endSection() ?>
