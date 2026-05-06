<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<?php $canDelete = session('role') !== 'staff'; ?>

<div class="row">
    <div class="col-md-12 admin-team-section" id="team-list">
        <div class="card card-box">
            <div class="card-head">
                <header>รายชื่อทีมทั้งหมด</header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-bordered table-hover table-checkable order-column full-width">
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
                            <td>
                                <strong><?= esc($item['name']) ?></strong>
                                <?php if (! empty($item['description'])): ?>
                                    <div class="text-muted small"><?= esc(mb_strimwidth($item['description'], 0, 80, '...')) ?></div>
                                <?php endif ?>
                            </td>
                            <td><span class="badge badge-info"><?= esc($item['tag'] ?: '-') ?></span></td>
                            <td><?= esc($item['contact_channel'] ?: '-') ?></td>
                            <td>
                                <?php if ($item['status'] === 'active'): ?>
                                    <span class="label label-sm label-success">Active</span>
                                <?php else: ?>
                                    <span class="label label-sm label-danger">Inactive</span>
                                <?php endif ?>
                            </td>
                            <td>
                                <button class="btn btn-xs btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#team-edit-<?= esc($item['id'], 'attr') ?>">
                                    <i class="fa fa-pencil"></i>
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
                                        <div class="col-lg-4 p-t-20">
                                            <label>ชื่อทีม</label>
                                            <input class="form-control" name="name" value="<?= esc($item['name'], 'attr') ?>" required>
                                        </div>
                                        <div class="col-lg-2 p-t-20">
                                            <label>ตัวย่อ</label>
                                            <input class="form-control" name="tag" value="<?= esc($item['tag'] ?? '', 'attr') ?>">
                                        </div>
                                        <div class="col-lg-4 p-t-20">
                                            <label>ช่องทางติดต่อ</label>
                                            <input class="form-control" name="contact_channel" value="<?= esc($item['contact_channel'] ?? '', 'attr') ?>">
                                        </div>
                                        <div class="col-lg-2 p-t-20">
                                            <label>สถานะ</label>
                                            <select class="form-select" name="status">
                                                <option value="active" <?= ($item['status'] ?? '') === 'active' ? 'selected' : '' ?>>Active</option>
                                                <option value="inactive" <?= ($item['status'] ?? '') === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-12 p-t-20">
                                            <label>รายละเอียดทีม / ประวัติ</label>
                                            <textarea class="form-control" name="description" rows="3"><?= esc($item['description'] ?? '') ?></textarea>
                                        </div>
                                        <div class="col-lg-12 p-t-20">
                                            <button class="btn btn-primary">บันทึกการแก้ไข</button>
                                            <button class="btn btn-default" type="button" data-bs-toggle="collapse" data-bs-target="#team-edit-<?= esc($item['id'], 'attr') ?>">ยกเลิก</button>
                                        </div>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row admin-team-section" id="team-create" style="display:none">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="card-head">
                <header>เพิ่มรายชื่อทีม</header>
                <button class="mdl-button mdl-js-button mdl-button--icon pull-right" type="button">
                    <i class="material-icons">more_vert</i>
                </button>
            </div>
            <form method="post" action="<?= site_url('adminz/teams') ?>">
                <?= csrf_field() ?>
                <div class="card-body row">
                    <div class="col-lg-6 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <input class="mdl-textfield__input" type="text" name="name" id="teamName" required>
                            <label class="mdl-textfield__label" for="teamName">ชื่อทีม</label>
                        </div>
                    </div>
                    <div class="col-lg-6 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <input class="mdl-textfield__input" type="text" name="tag" id="teamTag">
                            <label class="mdl-textfield__label" for="teamTag">ตัวย่อทีม (Tag)</label>
                        </div>
                    </div>
                    <div class="col-lg-6 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <input class="mdl-textfield__input" type="text" name="contact_channel" id="teamContact">
                            <label class="mdl-textfield__label" for="teamContact">ช่องทางติดต่อ</label>
                        </div>
                    </div>
                    <div class="col-lg-6 p-t-20">
                        <label>สถานะ</label>
                        <select class="form-select" name="status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="col-lg-12 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield txt-full-width">
                            <textarea class="mdl-textfield__input" rows="4" name="description" id="teamDescription"></textarea>
                            <label class="mdl-textfield__label" for="teamDescription">รายละเอียดทีม / ประวัติ</label>
                        </div>
                    </div>
                    <div class="col-lg-12 p-t-20 text-center">
                        <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-circle btn-primary" type="submit">Submit</button>
                        <a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-circle btn-danger" href="#team-list">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
