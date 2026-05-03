<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>
<section class="hero" style="max-width:760px">
    <h1>สมัครสมาชิกนักกีฬา</h1>
    <p class="muted">บัญชีผู้จัดการทีมและผู้ฝึกสอนต้องให้ผู้ดูแลระบบเป็นผู้สร้างหรือกำหนดสิทธิ์เท่านั้น</p>
    <?php if (session('error')): ?><div class="alert alert-danger"><?= session('error') ?></div><?php endif ?>
    <form method="post" action="<?= site_url('register') ?>" class="panel">
        <?= csrf_field() ?>
        <div class="row">
            <div class="col-md-6">
                <label>ชื่อผู้ใช้</label>
                <input class="form-control mb-3" name="username" value="<?= esc(old('username')) ?>" required minlength="3" maxlength="80">
            </div>
            <div class="col-md-6">
                <label>อีเมล</label>
                <input class="form-control mb-3" type="email" name="email" value="<?= esc(old('email')) ?>" required>
            </div>
            <div class="col-md-6">
                <label>รหัสผ่าน</label>
                <input class="form-control mb-3" type="password" name="password" required minlength="8">
            </div>
            <div class="col-md-6">
                <label>ยืนยันรหัสผ่าน</label>
                <input class="form-control mb-3" type="password" name="password_confirm" required minlength="8">
            </div>
            <div class="col-md-6">
                <label>ประเภทสมาชิก</label>
                <select class="form-control mb-3" name="role" required>
                    <?php foreach ($roles as $value => $label): ?>
                        <option value="<?= esc($value) ?>" <?= old('role') === $value ? 'selected' : '' ?>><?= esc($label) ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="col-md-6">
                <label>ทีมที่สังกัด</label>
                <select class="form-control mb-3" name="team_id">
                    <option value="">ยังไม่สังกัดทีม</option>
                    <?php foreach ($teams as $team): ?>
                        <option value="<?= esc($team['id']) ?>" <?= (string) old('team_id') === (string) $team['id'] ? 'selected' : '' ?>>
                            <?= esc($team['name']) ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="col-md-6">
                <label>ชื่อแสดงผล / นามแฝง</label>
                <input class="form-control mb-3" name="display_name" value="<?= esc(old('display_name')) ?>">
            </div>
            <div class="col-md-6">
                <label>วันเกิด</label>
                <input class="form-control mb-3" type="date" name="birth_date" value="<?= esc(old('birth_date')) ?>">
            </div>
            <div class="col-md-12">
                <label>ช่องทางการติดต่อ</label>
                <input class="form-control mb-3" name="contact_channel" value="<?= esc(old('contact_channel')) ?>" placeholder="เช่น Line, Discord, เบอร์โทร หรืออีเมล">
            </div>
            <div class="col-md-12">
                <label>คำอธิบายตัวเอง</label>
                <textarea class="form-control mb-3" name="bio"><?= esc(old('bio')) ?></textarea>
            </div>
        </div>

        <button class="btn-main" type="submit">สร้างบัญชีนักกีฬา</button>
        <a class="ms-3" href="<?= site_url('login') ?>">มีบัญชีแล้ว เข้าสู่ระบบ</a>
    </form>
</section>
<?= $this->endSection() ?>
