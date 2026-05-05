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
