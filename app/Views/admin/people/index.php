<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<?php $canDelete = session('role') !== 'staff'; ?>
<div class="card card-box">
    <div class="card-head"><header>เพิ่มสมาชิกโดยผู้ดูแลระบบ</header></div>
    <div class="card-body">
        <form method="post" action="<?= site_url('adminz/people') ?>">
            <?= csrf_field() ?>
            <div class="row">
                <div class="col-md-3"><label>ชื่อผู้ใช้/นามแฝง</label><input class="form-control" name="username" required></div>
                <div class="col-md-3"><label>อีเมล</label><input class="form-control" type="email" name="email" required></div>
                <div class="col-md-3"><label>รหัสผ่าน</label><input class="form-control" type="password" name="password" minlength="8" required></div>
                <div class="col-md-3">
                    <label>Role</label>
                    <select class="form-select" name="role">
                        <option value="staff" <?= ($selectedRole ?? '') === 'staff' ? 'selected' : '' ?>>Staff</option>
                        <option value="team_manager" <?= ($selectedRole ?? '') === 'team_manager' ? 'selected' : '' ?>>ผู้จัดการทีม</option>
                        <option value="coach" <?= ($selectedRole ?? '') === 'coach' ? 'selected' : '' ?>>ผู้ฝึกสอน</option>
                        <option value="amateur_athlete" <?= ($selectedRole ?? '') === 'amateur_athlete' ? 'selected' : '' ?>>นักกีฬาทั่วไป</option>
                        <option value="pro_athlete" <?= ($selectedRole ?? '') === 'pro_athlete' ? 'selected' : '' ?>>นักกีฬาอาชีพ</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>ทีม</label>
                    <select class="form-select" name="team_id">
                        <option value="">ไม่สังกัดทีม</option>
                        <?php foreach ($teams as $team): ?><option value="<?= esc($team['id']) ?>"><?= esc($team['name']) ?></option><?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-3"><label>ชื่อแสดงผล</label><input class="form-control" name="display_name"></div>
                <div class="col-md-3"><label>วันเกิด</label><input class="form-control" type="date" name="birth_date"></div>
                <div class="col-md-3"><label>ช่องทางติดต่อ</label><input class="form-control" name="contact_channel"></div>
            </div>
            <p class="admin-note">หมายเหตุ: Role ผู้จัดการทีมและผู้ฝึกสอนสร้างได้เฉพาะจากหน้านี้โดย admin เท่านั้น</p>
            <button class="btn btn-primary">เพิ่มสมาชิก</button>
        </form>
    </div>
</div>

<div class="card card-box">
    <div class="card-head"><header><?= esc($title) ?></header></div>
    <div class="card-body table-responsive">
        <table class="table table-hover">
            <thead><tr><th>ชื่อ</th><th>อีเมล</th><th>Role</th><th>ทีม</th><th>วันเกิด</th><th>ติดต่อ</th><th></th></tr></thead>
            <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= esc($item['display_name'] ?: $item['username']) ?></td>
                    <td><?= esc($item['email']) ?></td>
                    <td><span class="badge badge-info"><?= esc($item['role']) ?></span></td>
                    <td><?= esc($item['team_name'] ?? '-') ?></td>
                    <td><?= esc($item['birth_date'] ?? '-') ?></td>
                    <td><?= esc($item['contact_channel'] ?? '-') ?></td>
                    <td>
                        <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#person-edit-<?= esc($item['id'], 'attr') ?>">เธเนเนเธ</button>
                        <?php if ($canDelete): ?><form class="d-inline" method="post" action="<?= site_url('adminz/people/' . $item['id']) ?>">
                            <?= csrf_field() ?><input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-sm btn-outline-danger" onclick="return confirm('ยืนยันการลบสมาชิก?')">ลบ</button>
                        </form><?php endif ?>
                    </td>
                </tr>
                <tr class="collapse" id="person-edit-<?= esc($item['id'], 'attr') ?>">
                    <td colspan="7">
                        <form method="post" action="<?= site_url('adminz/people/' . $item['id']) ?>">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="selected_role" value="<?= esc($selectedRole ?? '', 'attr') ?>">
                            <div class="row">
                                <div class="col-md-3"><label>เธเธทเนเธญเธเธนเนเนเธเน/เธเธฒเธกเนเธเธ</label><input class="form-control" name="username" value="<?= esc($item['username'], 'attr') ?>" required></div>
                                <div class="col-md-3"><label>เธญเธตเน€เธกเธฅ</label><input class="form-control" type="email" name="email" value="<?= esc($item['email'], 'attr') ?>" required></div>
                                <div class="col-md-3"><label>เธฃเธซเธฑเธชเธเนเธฒเธเนเธซเธกเน</label><input class="form-control" type="password" name="password" minlength="8" placeholder="เว้นว่างถ้าไม่เปลี่ยน"></div>
                                <div class="col-md-3">
                                    <label>Role</label>
                                    <select class="form-select" name="role">
                                        <?php foreach (['staff' => 'Staff', 'team_manager' => 'เธเธนเนเธเธฑเธ”เธเธฒเธฃเธ—เธตเธก', 'coach' => 'เธเธนเนเธเธถเธเธชเธญเธ', 'amateur_athlete' => 'เธเธฑเธเธเธตเธฌเธฒเธ—เธฑเนเธงเนเธ', 'pro_athlete' => 'เธเธฑเธเธเธตเธฌเธฒเธญเธฒเธเธตเธ'] as $value => $label): ?>
                                            <option value="<?= esc($value, 'attr') ?>" <?= ($item['role'] ?? '') === $value ? 'selected' : '' ?>><?= esc($label) ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>เธ—เธตเธก</label>
                                    <select class="form-select" name="team_id">
                                        <option value="">เนเธกเนเธชเธฑเธเธเธฑเธ”เธ—เธตเธก</option>
                                        <?php foreach ($teams as $team): ?><option value="<?= esc($team['id'], 'attr') ?>" <?= (string) ($item['team_id'] ?? '') === (string) $team['id'] ? 'selected' : '' ?>><?= esc($team['name']) ?></option><?php endforeach ?>
                                    </select>
                                </div>
                                <div class="col-md-3"><label>เธเธทเนเธญเนเธชเธ”เธเธเธฅ</label><input class="form-control" name="display_name" value="<?= esc($item['display_name'] ?: $item['username'], 'attr') ?>"></div>
                                <div class="col-md-3"><label>เธงเธฑเธเน€เธเธดเธ”</label><input class="form-control" type="date" name="birth_date" value="<?= esc($item['birth_date'] ?? '', 'attr') ?>"></div>
                                <div class="col-md-3"><label>เธเนเธญเธเธ—เธฒเธเธ•เธดเธ”เธ•เนเธญ</label><input class="form-control" name="contact_channel" value="<?= esc($item['contact_channel'] ?? '', 'attr') ?>"></div>
                                <div class="col-md-3">
                                    <label>เธชเธ–เธฒเธเธฐ</label>
                                    <select class="form-select" name="status">
                                        <option value="active" <?= ($item['status'] ?? '') === 'active' ? 'selected' : '' ?>>Active</option>
                                        <option value="suspended" <?= ($item['status'] ?? '') === 'suspended' ? 'selected' : '' ?>>Suspended</option>
                                    </select>
                                </div>
                            </div>
                            <div class="m-t-10">
                                <button class="btn btn-primary">เธเธฑเธเธ—เธถเธเธเธฒเธฃเนเธเนเนเธ</button>
                                <button class="btn btn-default" type="button" data-bs-toggle="collapse" data-bs-target="#person-edit-<?= esc($item['id'], 'attr') ?>">เธขเธเน€เธฅเธดเธ</button>
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
