<?php
    $selectedRole = old('login_role', 'member');
    $roles = [
        'staff' => ['label' => 'Staff', 'hint' => 'เจ้าหน้าที่ เพิ่ม/แก้ไขได้ ไม่มีสิทธิ์ลบ'],
        'member' => ['label' => 'Member', 'hint' => 'นักกีฬาทั่วไปหรือนักกีฬาอาชีพ'],
        'manager' => ['label' => 'Manager', 'hint' => 'ผู้จัดการทีม แก้ไขรายละเอียดทีมได้'],
        'coach' => ['label' => 'Coach', 'hint' => 'ผู้ฝึกสอน ตรวจสอบทีมและสมัครแข่งขันได้'],
    ];
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="description" content="National Esports Tournament Login" />
    <title><?= esc($title ?? 'เข้าสู่ระบบ') ?> | National Esports</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?= base_url('templates/source/assets/plugins/iconic/css/material-design-iconic-font.min.css') ?>">
    <link href="<?= base_url('templates/source/assets/plugins/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('templates/source/assets/css/theme/theme_style.css') ?>" rel="stylesheet" id="rt_style_components" type="text/css" />
    <link rel="stylesheet" href="<?= base_url('templates/source/assets/css/pages/login.css') ?>">
    <link rel="shortcut icon" href="<?= base_url('templates/source/assets/img/favicon.ico') ?>" />
    <link href="<?= base_url('templates/source/assets/css/setting-panel.css') ?>" rel="stylesheet" type="text/css" />
    <style>
        body{background:#f8f8f8}.main{padding:58px 0}.signin-content{align-items:flex-start}.signin-image{margin-top:12px}.signin-image figure{margin-bottom:18px}.signin-image img{border-radius:10px}.signin-form{min-width:390px}.form-title{margin-bottom:18px}.role-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:10px;margin:0 0 18px}.role-option{margin:0;display:block}.role-option input{position:absolute;opacity:0}.role-card{display:block;height:100%;border:1px solid #e5e7eb;border-radius:8px;padding:11px 12px;cursor:pointer;background:#fff;transition:.18s}.role-card strong{display:block;color:#222;font-size:14px;margin-bottom:3px}.role-card span{display:block;color:#7b8794;font-size:11px;line-height:1.35}.role-option input:checked+.role-card{border-color:#188ae2;box-shadow:0 0 0 3px rgba(24,138,226,.12);background:#f4f9ff}.alert{border-radius:8px;padding:10px 12px;margin-bottom:14px}.input-height{height:44px}.login-meta{display:grid;gap:7px;margin-top:14px}.login-meta-row{display:flex;justify-content:space-between;gap:12px;font-size:12px;color:#6b7280;background:#f8fafc;border:1px solid #edf1f5;border-radius:7px;padding:7px 9px}.signup-image-link{font-size:13px}.form-button{margin-top:12px}.btn-round{border-radius:24px;padding:8px 24px}.back-home{display:inline-block;margin-top:10px;color:#555}@media(max-width:991px){.signin-form{min-width:0}.role-grid{grid-template-columns:1fr}.main{padding:24px 0}}
    </style>
</head>
<body>
    <div class="main">
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="<?= base_url('templates/source/assets/img/pages/signin.jpg') ?>" alt="login image"></figure>
                        <a href="<?= site_url('register') ?>" class="signup-image-link">สมัครสมาชิกนักกีฬา</a>
                        <a href="<?= site_url('/') ?>" class="back-home">กลับหน้าเว็บไซต์</a>
                        <div class="login-meta">
                            <div class="login-meta-row"><span>Staff</span><strong>staff@example.test</strong></div>
                            <div class="login-meta-row"><span>Manager</span><strong>manager@example.test</strong></div>
                            <div class="login-meta-row"><span>Coach</span><strong>coach@example.test</strong></div>
                            <div class="login-meta-row"><span>Member</span><strong>player@example.test</strong></div>
                        </div>
                    </div>
                    <div class="signin-form">
                        <h2 class="form-title">Login</h2>
                        <p class="text-muted">เลือกประเภทผู้ใช้งานให้ตรงกับ role ของบัญชี</p>

                        <?php if (session('error')): ?><div class="alert alert-danger"><?= session('error') ?></div><?php endif ?>
                        <?php if (session('success')): ?><div class="alert alert-success"><?= session('success') ?></div><?php endif ?>

                        <form class="register-form" id="login-form" method="post" action="<?= site_url('login') ?>">
                            <?= csrf_field() ?>
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

                            <div class="form-group">
                                <input name="email" type="email" placeholder="Email" class="form-control input-height" value="<?= esc(old('email')) ?>" required autocomplete="email" />
                            </div>
                            <div class="form-group">
                                <input name="password" type="password" placeholder="Password" class="form-control input-height" required minlength="8" autocomplete="current-password" />
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                            </div>
                            <div class="form-group form-button">
                                <button class="btn btn-round btn-primary" name="signin" id="signin" type="submit">Login</button>
                            </div>
                            <p class="text-muted">รหัสผ่านตัวอย่าง: <strong>Password@123</strong></p>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="<?= base_url('templates/source/assets/plugins/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('templates/source/assets/plugins/bootstrap/js/bootstrap.min.js') ?>"></script>
</body>
</html>
