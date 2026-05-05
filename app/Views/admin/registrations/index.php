<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="card card-box">
    <div class="card-head"><header>จัดการข้อมูลผู้สมัครแข่งขัน</header></div>
    <div class="card-body table-responsive">
        <table class="table table-hover table-checkable">
            <thead>
                <tr>
                    <th>การแข่งขัน</th>
                    <th>ทีม/ผู้สมัคร</th>
                    <th>นักกีฬาที่ส่งแข่ง</th>
                    <th>สถานะปัจจุบัน</th>
                    <th>จัดการสถานะ / หมายเหตุ</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><strong><?= esc($item['tournament_name']) ?></strong></td>
                    <td><?= esc($item['team_name'] ?: ($item['player_name'] ?? '-')) ?></td>
                    <td><?= esc($item['athlete_names'] ?: '-') ?></td>
                    <td>
                        <?php if ($item['status'] === 'approved'): ?>
                            <span class="badge badge-success">อนุมัติแล้ว</span>
                        <?php elseif ($item['status'] === 'pending'): ?>
                            <span class="badge badge-warning">รอตรวจสอบ</span>
                        <?php elseif ($item['status'] === 'rejected'): ?>
                            <span class="badge badge-danger">ปฏิเสธ</span>
                        <?php else: ?>
                            <span class="badge badge-secondary"><?= esc($item['status']) ?></span>
                        <?php endif ?>
                    </td>
                    <td>
                        <form method="post" action="<?= site_url('adminz/registrations/' . $item['id']) ?>" class="row g-2">
                            <?= csrf_field() ?><input type="hidden" name="_method" value="PUT">
                            <div class="col-md-4">
                                <select name="status" class="form-select form-select-sm">
                                    <option value="pending" <?= $item['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                                    <option value="approved" <?= $item['status'] === 'approved' ? 'selected' : '' ?>>Approved</option>
                                    <option value="rejected" <?= $item['status'] === 'rejected' ? 'selected' : '' ?>>Rejected</option>
                                    <option value="withdrawn" <?= $item['status'] === 'withdrawn' ? 'selected' : '' ?>>Withdrawn</option>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <input class="form-control form-control-sm" name="note" value="<?= esc($item['note']) ?>" placeholder="หมายเหตุถึงผู้สมัคร">
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-xs btn-primary w-100"><i class="fa fa-save"></i> บันทึก</button>
                            </div>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
