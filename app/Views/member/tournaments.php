<?= $this->extend('layouts/member') ?>
<?= $this->section('content') ?>
<?php $registered = array_column($registrations, 'status', 'tournament_id'); ?>
<div class="cardx table-responsive"><table class="table"><thead><tr><th>การแข่งขัน</th><th>เกม</th><th>ประเภท</th><th>สถานะสมัคร</th><th></th></tr></thead><tbody>
<?php foreach ($tournaments as $t): ?><tr>
    <td><?= esc($t['name']) ?></td><td><?= esc($t['game_name']) ?></td><td><?= esc($t['competition_type']) ?></td><td><?= esc($registered[$t['id']] ?? '-') ?></td>
    <td><?php if (! isset($registered[$t['id']]) && $t['status'] === 'open'): ?><form method="post" action="<?= site_url('member/tournaments/register/' . $t['id']) ?>"><?= csrf_field() ?><input class="form-control" name="note" placeholder="หมายเหตุ"><button class="btn btn-sm btn-primary">สมัคร</button></form><?php endif ?></td>
</tr><?php endforeach ?>
</tbody></table></div>
<?= $this->endSection() ?>
