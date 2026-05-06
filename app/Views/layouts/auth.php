<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="description" content="National Esports Tournament Auth" />
    <title><?= esc($title ?? 'Authentication') ?> | National Esports</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('templates/source/fonts/simple-line-icons/simple-line-icons.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('templates/source/fonts/font-awesome/v6/css/all.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('templates/source/assets/plugins/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('templates/source/assets/css/theme/theme_style.css') ?>" rel="stylesheet" id="rt_style_components" type="text/css" />
    <link href="<?= base_url('templates/source/assets/css/theme/style.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('templates/source/assets/css/responsive.css') ?>" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="<?= base_url('templates/source/assets/img/favicon.ico') ?>" />
    <style>
        :root {
            --es-bg: #0b1020;
            --es-panel: #101624;
            --es-card: #161d2f;
            --es-line: #263149;
            --es-text: #f5f7fb;
            --es-muted: #9aa7bd;
            --es-accent: #00e5ff;
            --es-accent-2: #7c3cff;
            --es-success: #31d0aa;
            --es-warning: #ffc857;
            --es-danger: #ff5470;
        }

        body {
            background: var(--es-bg) !important;
            color: var(--es-text) !important;
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        .auth-container {
            width: 100%;
            max-width: 500px;
            margin: auto;
        }

        .auth-card {
            background: var(--es-card) !important;
            border: 1px solid var(--es-line) !important;
            border-radius: 12px !important;
            box-shadow: 0 24px 64px rgba(0, 0, 0, .35) !important;
            padding: 40px;
            position: relative;
            overflow: hidden;
        }

        .auth-card:before {
            content: "";
            position: absolute;
            top: -50px;
            right: -50px;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: rgba(0, 229, 255, 0.05);
            z-index: 0;
        }

        .auth-content {
            position: relative;
            z-index: 1;
        }

        .auth-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .auth-logo {
            margin-bottom: 20px;
            display: inline-block;
        }

        .auth-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--es-text);
            margin-bottom: 8px;
        }

        .auth-subtitle {
            color: var(--es-muted);
            font-size: 14px;
        }

        .form-label {
            color: var(--es-text);
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .form-control {
            background: #0f1729 !important;
            border: 1px solid var(--es-line) !important;
            color: var(--es-text) !important;
            border-radius: 8px !important;
            padding: 12px 15px !important;
            height: auto !important;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--es-accent) !important;
            box-shadow: 0 0 0 3px rgba(0, 229, 255, 0.1) !important;
            outline: none;
        }

        .btn-primary {
            background: var(--es-accent) !important;
            border-color: var(--es-accent) !important;
            color: #06111c !important;
            font-weight: 700 !important;
            padding: 12px 20px !important;
            border-radius: 8px !important;
            width: 100%;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 229, 255, 0.25);
            opacity: 0.9;
        }

        .auth-footer {
            margin-top: 25px;
            text-align: center;
            font-size: 14px;
            color: var(--es-muted);
        }

        .auth-footer a {
            color: var(--es-accent);
            text-decoration: none;
            font-weight: 600;
        }

        .auth-footer a:hover {
            text-decoration: underline;
        }

        .alert {
            border-radius: 8px;
            border: 1px solid transparent;
            padding: 12px 16px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-danger {
            background: rgba(255, 84, 112, 0.1);
            border-color: rgba(255, 84, 112, 0.2);
            color: var(--es-danger);
        }

        .alert-success {
            background: rgba(49, 208, 170, 0.1);
            border-color: rgba(49, 208, 170, 0.2);
            color: var(--es-success);
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-content">
                <div class="auth-header">
                    <a href="<?= site_url('/') ?>" class="auth-logo">
                        <img src="<?= base_url('templates/source/assets/img/logo.png') ?>" alt="logo" height="45">
                    </a>
                    <h1 class="auth-title"><?= esc($title ?? 'Welcome') ?></h1>
                    <p class="auth-subtitle"><?= $subtitle ?? 'เข้าสู่ระบบเพื่อจัดการแข่งขันของคุณ' ?></p>
                </div>

                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>

    <script src="<?= base_url('templates/source/assets/plugins/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('templates/source/assets/plugins/bootstrap/js/bootstrap.min.js') ?>"></script>
</body>
</html>
