<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="description" content="National Esports Tournament Registration" />
    <title><?= esc($title ?? 'สมัครสมาชิกนักกีฬา') ?> | National Esports</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?= base_url('templates/source/assets/plugins/iconic/css/material-design-iconic-font.min.css') ?>">
    <link href="<?= base_url('templates/source/assets/plugins/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('templates/source/assets/css/theme/theme_style.css') ?>" rel="stylesheet" id="rt_style_components" type="text/css" />
    <link rel="stylesheet" href="<?= base_url('templates/source/assets/css/pages/login.css') ?>">
    <link rel="shortcut icon" href="<?= base_url('templates/source/assets/img/favicon.ico') ?>" />
    <link href="<?= base_url('templates/source/assets/css/setting-panel.css') ?>" rel="stylesheet" type="text/css" />
    <style>
        body{background:#f8f8f8}.main{padding:34px 0}.signup-content{align-items:flex-start}.signup-form{width:680px;margin-right:46px}.signup-image{margin-top:40px}.signup-image img{border-radius:10px}.form-title{margin-bottom:12px}.form-subtitle{color:#6b7280;margin-bottom:18px}.input-height{height:44px}.form-group{margin-bottom:13px}.form-control,.form-select{border:1px solid #e5e7eb;border-radius:6px;box-shadow:none}.form-control:focus,.form-select:focus{border-color:#188ae2;box-shadow:0 0 0 3px rgba(24,138,226,.1)}textarea.form-control{min-height:86px}.role-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:10px;margin-bottom:14px}.role-option{margin:0;display:block}.role-option input{position:absolute;opacity:0}.role-card{display:block;border:1px solid #e5e7eb;border-radius:8px;padding:12px;background:#fff;cursor:pointer;transition:.18s}.role-card strong{display:block;color:#222;margin-bottom:3px}.role-card span{font-size:12px;color:#7b8794}.role-option input:checked+.role-card{border-color:#188ae2;background:#f4f9ff;box-shadow:0 0 0 3px rgba(24,138,226,.12)}.alert{border-radius:8px;padding:10px 12px;margin-bottom:14px}.register-note{background:#f8fafc;border:1px solid #edf1f5;border-radius:8px;padding:12px;color:#6b7280;font-size:13px;margin-bottom:15px}.btn-round{border-radius:24px;padding:8px 24px}.signup-image-link+.signup-image-link{margin-top:8px}@media(max-width:991px){.signup-form{width:100%;margin-right:0}.signup-content{display:block}.signup-image{margin-top:24px}.role-grid{grid-template-columns:1fr}.main{padding:20px 0}}
    </style>
</head>
<body>
    <div class="main">
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <p class="form-subtitle">สมัครบัญชีนักกีฬาเข้าสู่ระบบการแข่งขันระดับประเทศ</p>
                        <div class="register-note">บัญชี Manager, Coach และ Staff ต้องให้ admin เป็นผู้สร้างหรือกำหนดสิทธิ์เท่านั้น</div>

                        <?php if (session('error')): ?><div class="alert alert-danger"><?= session('error') ?></div><?php endif ?>
                        <?php if (session('success')): ?><div class="alert alert-success"><?= session('success') ?></div><?php endif ?>

                        <form method="post" action="<?= site_url('register') ?>" class="register-form" id="register-form">
                            <?= csrf_field() ?>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group"><input class="form-control input-height" name="username" placeholder="Username" value="<?= esc(old('username')) ?>" required minlength="3" maxlength="80"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group"><input class="form-control input-height" type="email" name="email" placeholder="Email" value="<?= esc(old('email')) ?>" required></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group"><input class="form-control input-height" type="password" name="password" placeholder="Password" required minlength="8"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group"><input class="form-control input-height" type="password" name="password_confirm" placeholder="Repeat Password" required minlength="8"></div>
                                </div>
                            </div>

                            <div class="role-grid">
                                <?php foreach ($roles as $value => $label): ?>
                                    <label class="role-option">
                                        <input type="radio" name="role" value="<?= esc($value, 'attr') ?>" <?= old('role', 'amateur_athlete') === $value ? 'checked' : '' ?>>
                                        <span class="role-card">
                                            <strong><?= esc($label) ?></strong>
                                            <span><?= $value === 'pro_athlete' ? 'นักกีฬาอาชีพ' : 'นักกีฬาทั่วไป' ?></span>
                                        </span>
                                    </label>
                                <?php endforeach ?>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="form-select input-height" name="team_id">
                                            <option value="">ยังไม่สังกัดทีม</option>
                                            <?php foreach ($teams as $team): ?>
                                                <option value="<?= esc($team['id']) ?>" <?= (string) old('team_id') === (string) $team['id'] ? 'selected' : '' ?>><?= esc($team['name']) ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group"><input class="form-control input-height" name="display_name" placeholder="Display name / Alias" value="<?= esc(old('display_name')) ?>"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group"><input class="form-control input-height" type="date" name="birth_date" value="<?= esc(old('birth_date')) ?>"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group"><input class="form-control input-height" name="contact_channel" value="<?= esc(old('contact_channel')) ?>" placeholder="Line, Discord, Phone, Email"></div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group"><textarea class="form-control" name="bio" placeholder="คำอธิบายตัวเอง"><?= esc(old('bio')) ?></textarea></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" required />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>ยืนยันว่าข้อมูลถูกต้องและยอมรับเงื่อนไขการสมัคร</label>
                            </div>
                            <div class="form-group form-button">
                                <button class="btn btn-round btn-primary" name="signup" id="register" type="submit">Register</button>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="<?= base_url('templates/source/assets/img/pages/signup.jpg') ?>" alt="sign up image"></figure>
                        <a href="<?= site_url('login') ?>" class="signup-image-link">มีบัญชีแล้ว เข้าสู่ระบบ</a>
                        <a href="<?= site_url('/') ?>" class="signup-image-link">กลับหน้าเว็บไซต์</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="<?= base_url('templates/source/assets/plugins/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('templates/source/assets/plugins/bootstrap/js/bootstrap.min.js') ?>"></script>
</body>
</html>
