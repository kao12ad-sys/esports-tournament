<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="cardx table-responsive"><table class="table"><thead><tr><th>การแข่งขัน</th><th>ทีม/ผู้สมัคร</th><th>สถานะ</th><th>หมายเหตุ</th><th></th></tr></thead><tbody>
<?php foreach ($items as $item): ?><tr>
    <td><?= esc($item['tournament_name']) ?></td>
    <td><?= esc($item['team_name'] ?: $item['player_name']) ?></td>
    <td><?= esc($item['status']) ?></td>
    <td><?= esc($item['note']) ?></td>
    <td><form method="post" action="<?= site_url('adminz/registrations/' . $item['id']) ?>"><?= csrf_field() ?><input type="hidden" name="_method" value="PUT"><select name="status" class="form-select"><option>pending</option><option>approved</option><option>rejected</option><option>withdrawn</option></select><input class="form-control" name="note" placeholder="หมายเหตุ"><button class="btn btn-sm btn-primary">บันทึก</button></form></td>
</tr><?php endforeach ?>
</tbody></table></div>
<?= $this->endSection() ?>
