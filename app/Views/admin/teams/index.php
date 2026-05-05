<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<?php $canDelete = session('role') !== 'staff'; ?>

<div class="card card-box">
    <div class="card-head"><header>เพิ่มทีมใหม่</header></div>
    <div class="card-body">
        <form method="post" action="<?= site_url('adminz/teams') ?>">
            <?= csrf_field() ?>
            <div class="row">
                <div class="col-md-4">
                    <label>ชื่อทีม</label>
                    <input class="form-control" name="name" placeholder="ชื่อทีมเต็ม" required>
                </div>
                <div class="col-md-2">
                    <label>ตัวย่อ (Tag)</label>
                    <input class="form-control" name="tag" placeholder="เช่น MG">
                </div>
                <div class="col-md-4">
                    <label>ช่องทางติดต่อ</label>
                    <input class="form-control" name="contact_channel" placeholder="เบอร์โทร / Line / Facebook">
                </div>
                <div class="col-md-2">
                    <label>สถานะ</label>
                    <select class="form-select" name="status">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <label>รายละเอียดทีม / ประวัติ</label>
                    <textarea class="form-control" name="description" rows="3"></textarea>
                </div>
            </div>
            <div class="m-t-10">
                <button class="btn btn-primary">บันทึกข้อมูลทีม</button>
            </div>
        </form>
    </div>
</div>

<div class="card card-box">
    <div class="card-head"><header>รายการทีมทั้งหมด</header></div>
    <div class="card-body table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ชื่อทีม</th>
                    <th>ตัวย่อ</th>
                    <th>ช่องทางติดต่อ</th>
                    <th>สถานะ</th>
                    <th>การจัดการ</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= esc($item['id']) ?></td>
                    <td><strong><?= esc($item['name']) ?></strong></td>
                    <td><span class="badge badge-info"><?= esc($item['tag'] ?: '-') ?></span></td>
                    <td><?= esc($item['contact_channel'] ?: '-') ?></td>
                    <td>
                        <?php if ($item['status'] === 'active'): ?>
                            <span class="badge badge-success">Active</span>
                        <?php else: ?>
                            <span class="badge badge-danger">Inactive</span>
                        <?php endif ?>
                    </td>
                    <td>
                        <button class="btn btn-xs btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#team-edit-<?= esc($item['id'], 'attr') ?>">
                            <i class="fa fa-pen"></i>
                        </button>
                        <?php if ($canDelete): ?>
                            <form class="d-inline" method="post" action="<?= site_url('adminz/teams/' . $item['id']) ?>">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-xs btn-danger" onclick="return confirm('ยืนยันการลบทีม?')"><i class="fa fa-trash"></i></button>
                            </form>
                        <?php endif ?>
                    </td>
                </tr>
                <tr class="collapse" id="team-edit-<?= esc($item['id'], 'attr') ?>">
                    <td colspan="6">
                        <form method="post" action="<?= site_url('adminz/teams/' . $item['id']) ?>">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="PUT">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>ชื่อทีม</label>
                                    <input class="form-control" name="name" value="<?= esc($item['name'], 'attr') ?>" required>
                                </div>
                                <div class="col-md-2">
                                    <label>ตัวย่อ (Tag)</label>
                                    <input class="form-control" name="tag" value="<?= esc($item['tag'] ?? '', 'attr') ?>">
                                </div>
                                <div class="col-md-4">
                                    <label>ช่องทางติดต่อ</label>
                                    <input class="form-control" name="contact_channel" value="<?= esc($item['contact_channel'] ?? '', 'attr') ?>">
                                </div>
                                <div class="col-md-2">
                                    <label>สถานะ</label>
                                    <select class="form-select" name="status">
                                        <option value="active" <?= ($item['status'] ?? '') === 'active' ? 'selected' : '' ?>>Active</option>
                                        <option value="inactive" <?= ($item['status'] ?? '') === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label>รายละเอียดทีม / ประวัติ</label>
                                    <textarea class="form-control" name="description" rows="3"><?= esc($item['description'] ?? '') ?></textarea>
                                </div>
                            </div>
                            <div class="m-t-10">
                                <button class="btn btn-primary">บันทึกการแก้ไข</button>
                                <button class="btn btn-default" type="button" data-bs-toggle="collapse" data-bs-target="#team-edit-<?= esc($item['id'], 'attr') ?>">ยกเลิก</button>
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
