<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<?php $canDelete = session('role') !== 'staff'; ?>
<div class="card card-box">
    <div class="card-head">
        <header>รายการแข่งขันทั้งหมด</header>
        <div class="pull-right">
            <a class="btn btn-primary btn-sm" href="<?= site_url('adminz/tournaments/new') ?>">+ เพิ่มการแข่งขันใหม่</a>
        </div>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-hover table-checkable order-column full-width">
            <thead>
                <tr>
                    <th>ชื่อการแข่งขัน</th>
                    <th>เกม</th>
                    <th>ประเภท</th>
                    <th>รุ่น</th>
                    <th>สถานที่</th>
                    <th>สถานะ</th>
                    <th>การจัดการ</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><strong><?= esc($item['name']) ?></strong></td>
                    <td><?= esc($item['game_name']) ?></td>
                    <td><span class="badge badge-outline-primary"><?= esc($item['competition_type'] === 'team' ? 'ทีม' : 'เดี่ยว') ?></span></td>
                    <td><?= esc($item['division'] ?: '-') ?></td>
                    <td><i class="fas fa-map-marker-alt m-r-5"></i><?= esc($item['venue'] ?: '-') ?></td>
                    <td>
                        <?php if ($item['status'] === 'open'): ?>
                            <span class="badge badge-success">เปิดรับสมัคร</span>
                        <?php elseif ($item['status'] === 'closed'): ?>
                            <span class="badge badge-danger">ปิดรับสมัคร</span>
                        <?php else: ?>
                            <span class="badge badge-info"><?= esc($item['status']) ?></span>
                        <?php endif ?>
                    </td>
                    <td>
                        <a href="<?= site_url('adminz/tournaments/' . $item['id'] . '/edit') ?>" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></a>
                        <?php if ($canDelete): ?><form class="d-inline" method="post" action="<?= site_url('adminz/tournaments/' . $item['id']) ?>">
                            <?= csrf_field() ?><input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-xs btn-danger" onclick="return confirm('ยืนยันการลบรายการนี้?')"><i class="fa fa-trash"></i></button>
                        </form><?php endif ?>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
