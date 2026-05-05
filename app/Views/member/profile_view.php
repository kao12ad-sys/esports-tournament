<?= $this->extend(in_array(session('role'), ['admin', 'staff'], true) ? 'layouts/admin' : 'layouts/member') ?>
<?= $this->section('content') ?>
<?php
    $roleLabels = [
        'team_manager' => 'ผู้จัดการทีม',
        'coach' => 'ผู้ฝึกสอน',
        'amateur_athlete' => 'นักกีฬาทั่วไป',
        'pro_athlete' => 'นักกีฬาอาชีพ',
    ];
    $displayName = $profile['display_name'] ?? $user['username'];
    $avatarUrl = ! empty($profile['avatar']) ? base_url($profile['avatar']) : base_url('templates/source/assets/img/dp.jpg');
?>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PROFILE SIDEBAR -->
        <div class="profile-sidebar" style="width: 300px; float: left; margin-right: 20px;">
            <div class="card">
                <div class="card-body no-padding height-9 text-center" style="padding: 20px 0 !important;">
                    <div class="profile-userpic">
                        <img src="<?= $avatarUrl ?>" class="img-responsive profile-avatar" alt="" style="width: 130px; height: 130px; margin-bottom: 15px;">
                    </div>
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name" style="font-size: 20px; font-weight: 700;"> <?= esc($displayName) ?> </div>
                        <div class="profile-usertitle-job" style="color: var(--es-accent); font-weight: 600;"> <?= esc($roleLabels[$user['role']] ?? $user['role']) ?> </div>
                    </div>
                    <div class="profile-userbuttons" style="margin-top: 15px;">
                        <?php if ($team): ?>
                            <div class="member-label">ทีม</div>
                            <span class="status-pill"><?= esc($team['name']) ?></span>
                        <?php else: ?>
                            <span class="text-muted" style="font-size: 12px;">ยังไม่มีทีม</span>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-head">
                    <header>เกี่ยวกับฉัน</header>
                </div>
                <div class="card-body no-padding height-9">
                    <div class="profile-desc" style="padding: 15px; color: var(--es-muted); line-height: 1.6;">
                        <?= nl2br(esc($profile['bio'] ?? 'ไม่มีข้อมูลแนะนำตัว')) ?>
                    </div>
                    <ul class="list-group list-group-unbordered" style="list-style: none; padding: 0 15px 15px;">
                        <li class="list-group-item" style="border: 0; border-top: 1px solid var(--es-line); padding: 10px 0; display: flex; justify-content: space-between;">
                            <b>วันเกิด</b>
                            <div class="profile-desc-item"><?= $profile['birth_date'] ? date('d/m/Y', strtotime($profile['birth_date'])) : '-' ?></div>
                        </li>
                        <li class="list-group-item" style="border: 0; border-top: 1px solid var(--es-line); padding: 10px 0; display: flex; justify-content: space-between;">
                            <b>ช่องทางติดต่อ</b>
                            <div class="profile-desc-item"><?= esc($profile['contact_channel'] ?? '-') ?></div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card">
                <div class="card-head">
                    <header>โซเชียลมีเดีย</header>
                </div>
                <div class="card-body no-padding height-9" style="padding: 15px !important;">
                    <div class="d-flex flex-wrap gap-2 justify-content-center">
                        <?php if ($profile['social_facebook'] ?? ''): ?>
                            <a href="<?= esc($profile['social_facebook']) ?>" target="_blank" class="btn btn-primary btn-sm btn-circle social-link" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <?php endif ?>
                        <?php if ($profile['social_line'] ?? ''): ?>
                            <span class="btn btn-success btn-sm btn-circle social-link" title="Line: <?= esc($profile['social_line']) ?>"><i class="fab fa-line"></i></span>
                        <?php endif ?>
                        <?php if ($profile['social_instagram'] ?? ''): ?>
                            <a href="<?= esc($profile['social_instagram']) ?>" target="_blank" class="btn btn-danger btn-sm btn-circle social-link" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <?php endif ?>
                        <?php if ($profile['social_x'] ?? ''): ?>
                            <a href="<?= esc($profile['social_x']) ?>" target="_blank" class="btn btn-dark btn-sm btn-circle social-link" title="X"><i class="fab fa-x-twitter"></i></a>
                        <?php endif ?>
                        <?php if (empty($profile['social_facebook']) && empty($profile['social_line']) && empty($profile['social_instagram']) && empty($profile['social_x'])): ?>
                            <span class="text-muted" style="font-size: 12px;">ไม่ได้ระบุโซเชียลมีเดีย</span>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- END BEGIN PROFILE SIDEBAR -->
        <!-- BEGIN PROFILE CONTENT -->
        <div class="profile-content" style="margin-left: 320px;">
            <div class="row">
                <div class="card" style="width: 100%;">
                    <div class="white-box">
                        <!-- Nav tabs -->
                        <div class="p-rl-20">
                            <ul class="nav customtab nav-tabs" role="tablist">
                                <li class="nav-item"><a href="#tab1" class="nav-link active" data-bs-toggle="tab">Biography</a></li>
                                <li class="nav-item"><a href="#tab2" class="nav-link" data-bs-toggle="tab">Activity</a></li>
                            </ul>
                        </div>
                        <!-- Tab panes -->
                        <div class="tab-content" style="padding: 20px;">
                            <div class="tab-pane active fontawesome-demo" id="tab1">
                                <div id="biography">
                                    <div class="row">
                                        <div class="col-md-4 col-6 b-r"> <strong>Full Name</strong>
                                            <br>
                                            <p class="text-muted"><?= esc($displayName) ?></p>
                                        </div>
                                        <div class="col-md-4 col-6 b-r"> <strong>Role</strong>
                                            <br>
                                            <p class="text-muted"><?= esc($roleLabels[$user['role']] ?? $user['role']) ?></p>
                                        </div>
                                        <div class="col-md-4 col-6"> <strong>Team</strong>
                                            <br>
                                            <p class="text-muted"><?= $team ? esc($team['name']) : 'อิสระ' ?></p>
                                        </div>
                                    </div>
                                    <hr style="border-color: var(--es-line);">
                                    <h4 class="font-bold">ข้อมูลแนะนำตัว</h4>
                                    <p class="m-t-30">
                                        <?= nl2br(esc($profile['bio'] ?? 'สมาชิกยังไม่ได้ระบุข้อมูลแนะนำตัว')) ?>
                                    </p>
                                    <br>
                                    <h4 class="font-bold">ระดับนักกีฬา</h4>
                                    <hr style="border-color: var(--es-line);">
                                    <p class="text-muted"><?= esc($profile['athlete_level'] ?? 'ยังไม่มีข้อมูลระดับ') ?></p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab2">
                                <div class="empty-state">ยังไม่มีกิจกรรมล่าสุด</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PROFILE CONTENT -->
    </div>
</div>

<style {csp-style-nonce}>
    .btn-circle {
        width: 35px;
        height: 35px;
        line-height: 35px;
        border-radius: 50%;
        text-align: center;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .customtab .nav-link {
        color: var(--es-muted) !important;
        border: 0 !important;
        border-bottom: 2px solid transparent !important;
        font-weight: 600;
        padding: 12px 20px;
    }
    .customtab .nav-link.active {
        color: var(--es-accent) !important;
        border-bottom-color: var(--es-accent) !important;
        background: transparent !important;
    }
    .profile-sidebar .card {
        margin-bottom: 20px;
        overflow: hidden;
    }
    .profile-sidebar .card-head {
        padding: 12px 15px;
        font-size: 14px;
        font-weight: 600;
    }
    .b-r {
        border-right: 1px solid var(--es-line);
    }
    .profile-desc-item {
        color: var(--es-text);
        font-weight: 500;
    }
    .list-group-item b {
        color: var(--es-muted);
        font-weight: 500;
    }
    #biography h4 {
        margin-top: 25px;
        margin-bottom: 15px;
        font-size: 16px;
    }
    .social-link {
        transition: transform 0.2s;
    }
    .social-link:hover {
        transform: translateY(-3px);
    }
    @media (max-width: 991px) {
        .profile-sidebar {
            width: 100% !important;
            float: none !important;
            margin-right: 0 !important;
        }
        .profile-content {
            margin-left: 0 !important;
        }
        .b-r {
            border-right: 0;
        }
    }
</style>

<?= $this->endSection() ?>
