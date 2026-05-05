<?= $this->extend('layouts/member') ?>
<?= $this->section('content') ?>
<?php
    $registered = array_column($registrations, 'status', 'tournament_id');
    $canRegisterTournament = $canRegisterTournament ?? false;
?>
<div class="member-card">
    <h5>สมัครและตรวจสอบการแข่งขัน</h5>
    <div class="table-responsive">
        <table class="table member-table">
            <thead><tr><th>การแข่งขัน</th><th>เกม</th><th>ประเภท</th><th>สถานะสมัคร</th><th></th></tr></thead>
            <tbody>
            <?php foreach ($tournaments as $t): ?>
                <tr>
                    <td><?= esc($t['name']) ?></td>
                    <td><?= esc($t['game_name']) ?></td>
                    <td><?= esc($t['competition_type'] === 'team' ? 'ทีม' : 'เดี่ยว') ?></td>
                    <td><span class="status-pill"><?= esc($registered[$t['id']] ?? '-') ?></span></td>
                    <td>
                        <?php if ($canRegisterTournament && ! isset($registered[$t['id']]) && $t['status'] === 'open'): ?>
                            <form method="post" action="<?= site_url('member/tournaments/register/' . $t['id']) ?>">
                                <?= csrf_field() ?>
                                <input class="form-control" name="note" placeholder="หมายเหตุ">
                                <button class="default-btn" type="submit">สมัคร</button>
                            </form>
                        <?php elseif (! $canRegisterTournament && $t['status'] === 'open'): ?>
                            <span class="text-muted">เฉพาะผู้จัดการทีมเท่านั้น</span>
                        <?php endif ?>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
