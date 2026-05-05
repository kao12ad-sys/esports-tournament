<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="description" content="National Esports Tournament Admin" />
    <title><?= esc($title ?? 'Admin Login') ?></title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?= base_url('templates/source/assets/plugins/iconic/css/material-design-iconic-font.min.css') ?>">
    <link href="<?= base_url('templates/source/assets/plugins/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('templates/source/assets/css/theme/theme_style.css') ?>" rel="stylesheet" id="rt_style_components" type="text/css" />
    <link rel="stylesheet" href="<?= base_url('templates/source/assets/css/pages/login.css') ?>">
    <link rel="shortcut icon" href="<?= base_url('templates/source/assets/img/favicon.ico') ?>" />
    <link href="<?= base_url('templates/source/assets/css/setting-panel.css') ?>" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="main">
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="<?= base_url('templates/source/assets/img/pages/signin.jpg') ?>" alt="admin login"></figure>
                        <a href="<?= site_url('/') ?>" class="signup-image-link">กลับหน้าเว็บไซต์</a>
                    </div>
                    <div class="signin-form">
                        <h2 class="form-title">Admin Login</h2>
                        <?php if (session('error')): ?>
                            <div class="alert alert-danger"><?= esc(session('error')) ?></div>
                        <?php endif ?>
                        <?php if (session('success')): ?>
                            <div class="alert alert-success"><?= esc(session('success')) ?></div>
                        <?php endif ?>
                        <form class="register-form" id="login-form" method="post" action="<?= site_url('adminz/login') ?>">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <input name="login" type="text" placeholder="Admin Username or Email" class="form-control input-height" value="<?= esc(old('login')) ?>" required />
                            </div>
                            <div class="form-group">
                                <input name="password" type="password" placeholder="Password" class="form-control input-height" minlength="8" required />
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                            </div>
                            <div class="form-group form-button">
                                <button class="btn btn-round btn-primary" name="signin" id="signin" type="submit">Login</button>
                            </div>
                        </form>
                        <p class="mt-3">admin หรือ admin@example.test / Password@123</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="<?= base_url('templates/source/assets/plugins/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('templates/source/assets/plugins/bootstrap/js/bootstrap.min.js') ?>"></script>
</body>
</html>
