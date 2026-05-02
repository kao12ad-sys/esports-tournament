<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>
<section class="hero" style="max-width:520px">
    <h1>เข้าสู่ระบบ</h1>
    <?php if (session('error')): ?><div class="alert alert-danger"><?= session('error') ?></div><?php endif ?>
    <?php if (session('success')): ?><div class="alert alert-success"><?= session('success') ?></div><?php endif ?>
    <form method="post" action="<?= site_url('login') ?>" class="panel">
        <?= csrf_field() ?>
        <label>อีเมล</label>
        <input class="form-control mb-3" type="email" name="email" value="<?= old('email') ?>" required>
        <label>รหัสผ่าน</label>
        <input class="form-control mb-3" type="password" name="password" required minlength="8">
        <button class="btn-main" type="submit">เข้าสู่ระบบ</button>
        <p class="muted mt-3">ทดสอบ: admin@example.test / Password@123</p>
    </form>
</section>
<?= $this->endSection() ?>
