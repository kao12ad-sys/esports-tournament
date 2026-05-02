<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<form class="cardx" method="post" action="<?= site_url('adminz/schedules') ?>">
    <?= csrf_field() ?>
    <div class="row">
        <div class="col-md-3"><select class="form-select" name="tournament_id"><?php foreach ($tournaments as $t): ?><option value="<?= $t['id'] ?>"><?= esc($t['name']) ?></option><?php endforeach ?></select></div>
        <div class="col-md-2"><input class="form-control" name="round_name" placeholder="รอบ"></div>
        <div class="col-md-2"><input class="form-control" name="match_no" placeholder="Match No."></div>
        <div class="col-md-2"><select class="form-select" name="team_a_id"><option value="">ทีม A</option><?php foreach ($teams as $team): ?><option value="<?= $team['id'] ?>"><?= esc($team['name']) ?></option><?php endforeach ?></select></div>
        <div class="col-md-2"><select class="form-select" name="team_b_id"><option value="">ทีม B</option><?php foreach ($teams as $team): ?><option value="<?= $team['id'] ?>"><?= esc($team['name']) ?></option><?php endforeach ?></select></div>
        <div class="col-md-3"><input class="form-control" type="datetime-local" name="scheduled_at"></div>
        <div class="col-md-3"><input class="form-control" name="venue" placeholder="สถานที่"></div>
    </div>
    <button class="btn btn-primary">เพิ่มตาราง</button>
</form>
<div class="cardx table-responsive"><table class="table"><thead><tr><th>การแข่งขัน</th><th>รอบ</th><th>คู่</th><th>เวลา</th><th>ผล</th><th>สถานะ</th><th></th></tr></thead><tbody>
<?php foreach ($items as $item): ?><tr><td><?= esc($item['tournament_name']) ?></td><td><?= esc($item['round_name']) ?></td><td><?= esc(($item['team_a'] ?? '-') . ' vs ' . ($item['team_b'] ?? '-')) ?></td><td><?= esc($item['scheduled_at']) ?></td><td><?= esc(($item['score_a'] ?? '-') . ' : ' . ($item['score_b'] ?? '-')) ?></td><td><?= esc($item['status']) ?></td><td><form method="post" action="<?= site_url('adminz/schedules/' . $item['id']) ?>"><?= csrf_field() ?><input type="hidden" name="_method" value="DELETE"><button class="btn btn-sm btn-outline-danger">ลบ</button></form></td></tr><?php endforeach ?>
</tbody></table></div>
<?= $this->endSection() ?>
