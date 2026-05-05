<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>
<section class="register-shell">
    <div class="register-intro">
        <div>
            <div class="muted mb-2">National Esports Tournament Platform</div>
            <h1>สร้างบัญชี Member สำหรับนักกีฬา</h1>
            <p class="muted">กรอกข้อมูลที่จำเป็นเท่านั้น ระบบจะสร้างบัญชี member ปกติ และ role ระดับ manager หรือ coach จะต้องให้ admin กำหนดภายหลัง</p>
        </div>
        <div class="register-notes">
            <div class="register-note"><span>Username</span><strong>ใช้เข้าสู่โปรไฟล์</strong></div>
            <div class="register-note"><span>Email</span><strong>ใช้สำหรับ login</strong></div>
            <div class="register-note"><span>Bot check</span><strong>ยืนยันว่าไม่ใช่ bot</strong></div>
        </div>
    </div>

    <form method="post" action="<?= site_url('register') ?>" class="register-panel">
        <?= csrf_field() ?>
        <h3 class="mb-2">Sign up</h3>
        <p class="form-subtitle">สมัครบัญชี Member สำหรับนักกีฬา</p>

        <?php if (session('error')): ?><div class="alert alert-danger"><?= session('error') ?></div><?php endif ?>
        <?php if (session('success')): ?><div class="alert alert-success"><?= session('success') ?></div><?php endif ?>

        <label>Username</label>
        <input class="form-control mb-3" name="username" placeholder="Username" value="<?= esc(old('username')) ?>" required minlength="3" maxlength="80" autocomplete="username">

        <label>Email</label>
        <input class="form-control mb-3" type="email" name="email" placeholder="Email" value="<?= esc(old('email')) ?>" required autocomplete="email">

        <label>Password</label>
        <input class="form-control mb-3" type="password" name="password" placeholder="Password" required minlength="8" autocomplete="new-password">

        <label>Repeat Password</label>
        <input class="form-control mb-3" type="password" name="password_confirm" placeholder="Repeat Password" required minlength="8" autocomplete="new-password">

        <label>ยืนยันตัวตนด้วย bot</label>
        <div class="captcha-box mb-3">
            <div class="captcha-question"><?= esc($botQuestion ?? '') ?></div>
            <input class="form-control" type="number" name="bot_answer" placeholder="Answer" required>
        </div>

        <button class="register-submit w-100" type="submit">Register</button>
        <p class="muted mt-3 mb-0">มีบัญชีแล้ว? <a href="<?= site_url('login') ?>">เข้าสู่ระบบ</a></p>
    </form>
</section>
<?= $this->endSection() ?>
