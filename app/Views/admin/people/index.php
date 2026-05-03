<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
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
                        <form method="post" action="<?= site_url('adminz/people/' . $item['id']) ?>">
                            <?= csrf_field() ?><input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-sm btn-outline-danger" onclick="return confirm('ยืนยันการลบสมาชิก?')">ลบ</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
