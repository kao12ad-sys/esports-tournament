<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="card card-box">
    <div class="card-head"><header>เพิ่มตารางแข่งขัน</header></div>
    <div class="card-body">
        <form method="post" action="<?= site_url('adminz/schedules') ?>">
            <?= csrf_field() ?>
            <div class="row">
                <div class="col-md-3"><label>การแข่งขัน</label><select class="form-select" name="tournament_id"><?php foreach ($tournaments as $t): ?><option value="<?= esc($t['id']) ?>"><?= esc($t['name']) ?></option><?php endforeach ?></select></div>
                <div class="col-md-2"><label>รอบ</label><input class="form-control" name="round_name"></div>
                <div class="col-md-2"><label>Match No.</label><input class="form-control" name="match_no"></div>
                <div class="col-md-2"><label>ทีม A</label><select class="form-select" name="team_a_id"><option value="">ทีม A</option><?php foreach ($teams as $team): ?><option value="<?= esc($team['id']) ?>"><?= esc($team['name']) ?></option><?php endforeach ?></select></div>
                <div class="col-md-2"><label>ทีม B</label><select class="form-select" name="team_b_id"><option value="">ทีม B</option><?php foreach ($teams as $team): ?><option value="<?= esc($team['id']) ?>"><?= esc($team['name']) ?></option><?php endforeach ?></select></div>
                <div class="col-md-3"><label>เวลาแข่งขัน</label><input class="form-control" type="datetime-local" name="scheduled_at"></div>
                <div class="col-md-3"><label>สถานที่</label><input class="form-control" name="venue"></div>
            </div>
            <button class="btn btn-primary">เพิ่มตาราง</button>
        </form>
    </div>
</div>
<div class="card card-box">
    <div class="card-head"><header>ตารางแข่งขัน</header></div>
    <div class="card-body table-responsive">
        <table class="table table-hover">
            <thead><tr><th>การแข่งขัน</th><th>รอบ</th><th>คู่</th><th>เวลา</th><th>ผล</th><th>สถานะ</th><th></th></tr></thead>
            <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= esc($item['tournament_name']) ?></td>
                    <td><?= esc($item['round_name'] ?: '-') ?></td>
                    <td><?= esc(($item['team_a'] ?? '-') . ' vs ' . ($item['team_b'] ?? '-')) ?></td>
                    <td><?= esc($item['scheduled_at'] ?: '-') ?></td>
                    <td><?= esc(($item['score_a'] ?? '-') . ' : ' . ($item['score_b'] ?? '-')) ?></td>
                    <td><span class="badge badge-secondary"><?= esc($item['status']) ?></span></td>
                    <td><form method="post" action="<?= site_url('adminz/schedules/' . $item['id']) ?>"><?= csrf_field() ?><input type="hidden" name="_method" value="DELETE"><button class="btn btn-sm btn-outline-danger" onclick="return confirm('ยืนยันการลบตาราง?')">ลบ</button></form></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
