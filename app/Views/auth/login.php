<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>
<?php
    $selectedRole = old('login_role', 'member');
    $roles = [
        'staff' => ['label' => 'Staff', 'hint' => 'เจ้าหน้าที่จัดการข้อมูล เพิ่ม/แก้ไขได้ ไม่มีสิทธิ์ลบ'],
        'member' => ['label' => 'Member', 'hint' => 'นักกีฬาทั่วไปหรือนักกีฬาอาชีพ'],
        'manager' => ['label' => 'Manager', 'hint' => 'ผู้จัดการทีม แก้ไขรายละเอียดทีมได้'],
        'coach' => ['label' => 'Coach', 'hint' => 'ผู้ฝึกสอน ตรวจสอบทีมและสมัครแข่งขันได้'],
    ];
?>

<style>
    .login-shell{max-width:1040px;margin:56px auto 70px;display:grid;grid-template-columns:1.1fr .9fr;gap:24px;align-items:stretch}.login-intro{background:linear-gradient(135deg,#151c2f,#23314f);border:1px solid rgba(255,255,255,.12);border-radius:12px;padding:34px;color:#fff;min-height:430px;display:flex;flex-direction:column;justify-content:space-between;overflow:hidden;position:relative}.login-intro:after{content:"";position:absolute;right:-80px;bottom:-90px;width:260px;height:260px;border-radius:50%;background:rgba(255,61,113,.18)}.login-intro h1{color:#fff;font-size:38px;line-height:1.15;margin-bottom:14px}.login-intro p{color:#c7d0e3}.login-panel{background:#121827;border:1px solid rgba(255,255,255,.1);border-radius:12px;padding:28px}.role-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:12px;margin-bottom:20px}.role-option input{position:absolute;opacity:0}.role-card{display:block;height:100%;border:1px solid rgba(255,255,255,.14);border-radius:10px;padding:14px;cursor:pointer;background:#0d1322;color:#dbe4f5;transition:.18s}.role-card strong{display:block;color:#fff;margin-bottom:4px}.role-card span{font-size:12px;color:#97a4bb;line-height:1.35;display:block}.role-option input:checked+.role-card{border-color:#ff3d71;background:linear-gradient(135deg,rgba(255,61,113,.22),rgba(24,138,226,.16));box-shadow:0 0 0 3px rgba(255,61,113,.1)}.login-panel label{color:#f5f7fb;font-weight:600}.login-panel .form-control{background:#080d18;border-color:rgba(255,255,255,.18);color:#fff}.login-panel .form-control:focus{background:#080d18;color:#fff;border-color:#ff3d71;box-shadow:none}.login-submit{width:100%;border:0;border-radius:8px;background:#ff3d71;color:#fff;padding:12px 16px;font-weight:700}.login-examples{display:grid;gap:9px;margin-top:18px}.login-example{display:flex;justify-content:space-between;gap:10px;border:1px solid rgba(255,255,255,.1);border-radius:8px;padding:9px 11px;color:#c7d0e3;font-size:13px}.muted a{color:#fff}@media(max-width:900px){.login-shell{grid-template-columns:1fr;margin-top:28px}.login-intro{min-height:260px}.role-grid{grid-template-columns:1fr}}
</style>

<section class="login-shell">
    <div class="login-intro">
        <div>
            <div class="muted mb-2">National Esports Tournament Platform</div>
            <h1>เข้าสู่ระบบตามบทบาทที่ได้รับ</h1>
            <p>เลือกประเภทผู้ใช้งานก่อนเข้าสู่ระบบ เพื่อพาไปยังพื้นที่ทำงานที่ถูกต้องและจำกัดสิทธิ์ตาม role ของบัญชี</p>
        </div>
        <div class="login-examples">
            <div class="login-example"><span>Staff</span><strong>staff@example.test</strong></div>
            <div class="login-example"><span>Manager</span><strong>manager@example.test</strong></div>
            <div class="login-example"><span>Coach</span><strong>coach@example.test</strong></div>
            <div class="login-example"><span>Member</span><strong>player@example.test</strong></div>
            <p class="muted mb-0">รหัสผ่านตัวอย่างทั้งหมด: <strong>Password@123</strong></p>
        </div>
    </div>

    <form method="post" action="<?= site_url('login') ?>" class="login-panel">
        <?= csrf_field() ?>
        <h3 class="text-white mb-2">Login</h3>
        <p class="muted">กรุณาเลือกประเภทบัญชีให้ตรงกับ role ที่ admin กำหนด</p>

        <?php if (session('error')): ?><div class="alert alert-danger"><?= session('error') ?></div><?php endif ?>
        <?php if (session('success')): ?><div class="alert alert-success"><?= session('success') ?></div><?php endif ?>

        <div class="role-grid">
            <?php foreach ($roles as $value => $item): ?>
                <label class="role-option">
                    <input type="radio" name="login_role" value="<?= esc($value, 'attr') ?>" <?= $selectedRole === $value ? 'checked' : '' ?>>
                    <span class="role-card">
                        <strong><?= esc($item['label']) ?></strong>
                        <span><?= esc($item['hint']) ?></span>
                    </span>
                </label>
            <?php endforeach ?>
        </div>

        <label>อีเมล</label>
        <input class="form-control mb-3" type="email" name="email" value="<?= esc(old('email')) ?>" required autocomplete="email">

        <label>รหัสผ่าน</label>
        <input class="form-control mb-3" type="password" name="password" required minlength="8" autocomplete="current-password">

        <button class="login-submit" type="submit">เข้าสู่ระบบ</button>
        <p class="muted mt-3 mb-0">ยังไม่มีบัญชีนักกีฬา? <a href="<?= site_url('register') ?>">สมัครสมาชิก</a></p>
    </form>
</section>
<?= $this->endSection() ?>
