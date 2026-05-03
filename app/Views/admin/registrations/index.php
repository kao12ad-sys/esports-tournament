<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="card card-box">
    <div class="card-head"><header>ผู้สมัครแข่งขัน</header></div>
    <div class="card-body table-responsive">
        <table class="table table-hover">
            <thead><tr><th>การแข่งขัน</th><th>ทีม/ผู้สมัคร</th><th>สถานะ</th><th>หมายเหตุ</th><th>อัปเดต</th></tr></thead>
            <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= esc($item['tournament_name']) ?></td>
                    <td><?= esc($item['team_name'] ?: ($item['player_name'] ?? '-')) ?></td>
                    <td><span class="badge badge-info"><?= esc($item['status']) ?></span></td>
                    <td><?= esc($item['note'] ?: '-') ?></td>
                    <td>
                        <form method="post" action="<?= site_url('adminz/registrations/' . $item['id']) ?>">
                            <?= csrf_field() ?><input type="hidden" name="_method" value="PUT">
                            <select name="status" class="form-select">
                                <?php foreach (['pending', 'approved', 'rejected', 'withdrawn'] as $status): ?>
                                    <option value="<?= esc($status) ?>" <?= $item['status'] === $status ? 'selected' : '' ?>><?= esc($status) ?></option>
                                <?php endforeach ?>
                            </select>
                            <input class="form-control" name="note" value="<?= esc($item['note']) ?>" placeholder="หมายเหตุ">
                            <button class="btn btn-sm btn-primary">บันทึก</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
