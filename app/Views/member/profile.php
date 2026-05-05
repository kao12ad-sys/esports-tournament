<?= $this->extend('layouts/member') ?>
<?= $this->section('content') ?>
<?php
    $avatar = ! empty($profile['avatar'])
        ? base_url($profile['avatar'])
        : base_url('templates/source/assets/img/dp.jpg');
?>

<div class="row">
    <div class="col-lg-4">
        <div class="member-card text-center">
            <img src="<?= esc($avatar, 'attr') ?>" alt="profile" class="profile-avatar mb-3" style="width:140px;height:140px;object-fit:cover;border-radius:50%">
            <h4><?= esc($profile['display_name'] ?? session('username')) ?></h4>
            <p class="text-muted mb-1">@<?= esc(session('username')) ?></p>
            <p class="text-muted mb-3"><?= esc($profile['contact_channel'] ?? 'ยังไม่ได้ระบุช่องทางติดต่อหลัก') ?></p>

            <div class="d-flex justify-content-center gap-2 mb-3">
                <?php if(!empty($profile['social_facebook'])): ?>
                    <a href="<?= esc($profile['social_facebook'], 'attr') ?>" target="_blank" class="btn btn-sm btn-outline-primary"><i class="fab fa-facebook"></i></a>
                <?php endif; ?>
                <?php if(!empty($profile['social_line'])): ?>
                    <a href="https://line.me/ti/p/~<?= esc($profile['social_line'], 'attr') ?>" target="_blank" class="btn btn-sm btn-outline-success"><i class="fab fa-line"></i></a>
                <?php endif; ?>
                <?php if(!empty($profile['social_instagram'])): ?>
                    <a href="https://instagram.com/<?= esc($profile['social_instagram'], 'attr') ?>" target="_blank" class="btn btn-sm btn-outline-danger"><i class="fab fa-instagram"></i></a>
                <?php endif; ?>
                <?php if(!empty($profile['social_x'])): ?>
                    <a href="https://x.com/<?= esc($profile['social_x'], 'attr') ?>" target="_blank" class="btn btn-sm btn-outline-light"><i class="fab fa-x-twitter"></i></a>
                <?php endif; ?>
            </div>

            <?php if (! empty($profile['avatar'])): ?>
                <form method="post" action="<?= site_url('member/profile') ?>" onsubmit="return confirm('ลบรูปโปรไฟล์นี้?')">
                    <?= csrf_field() ?>
                    <input type="hidden" name="display_name" value="<?= esc($profile['display_name'] ?? session('username'), 'attr') ?>">
                    <input type="hidden" name="birth_date" value="<?= esc($profile['birth_date'] ?? '', 'attr') ?>">
                    <input type="hidden" name="contact_channel" value="<?= esc($profile['contact_channel'] ?? '', 'attr') ?>">
                    <input type="hidden" name="social_facebook" value="<?= esc($profile['social_facebook'] ?? '', 'attr') ?>">
                    <input type="hidden" name="social_line" value="<?= esc($profile['social_line'] ?? '', 'attr') ?>">
                    <input type="hidden" name="social_instagram" value="<?= esc($profile['social_instagram'] ?? '', 'attr') ?>">
                    <input type="hidden" name="social_x" value="<?= esc($profile['social_x'] ?? '', 'attr') ?>">
                    <input type="hidden" name="bio" value="<?= esc($profile['bio'] ?? '', 'attr') ?>">
                    <input type="hidden" name="delete_avatar" value="1">
                    <button class="btn btn-outline-danger btn-sm" type="submit"><i class="fa fa-trash"></i> ลบรูปโปรไฟล์</button>
                </form>
            <?php endif ?>
        </div>
    </div>
    <div class="col-lg-8">
        <form class="member-card" method="post" action="<?= site_url('member/profile') ?>" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <?php if (session('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show mb-3">
                    <?= session('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif ?>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <div class="member-label">Member Profile</div>
                    <h4 class="mb-0">แก้ไขข้อมูลส่วนตัว</h4>
                </div>
                <div class="d-flex gap-2">
                    <a href="<?= site_url('member') ?>" class="btn btn-light">ยกเลิก</a>
                    <button type="submit" class="btn default-btn"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="member-label">ชื่อผู้ใช้หรือนามแฝง</div>
                    <input class="form-control" name="display_name" value="<?= esc(old('display_name', $profile['display_name'] ?? '')) ?>" maxlength="120" placeholder="ชื่อที่ต้องการแสดง">
                </div>
                <div class="col-md-6 mb-3">
                    <div class="member-label">วันเกิด</div>
                    <input class="form-control" type="date" name="birth_date" value="<?= esc(old('birth_date', $profile['birth_date'] ?? '')) ?>">
                </div>
                <div class="col-md-12 mb-3">
                    <div class="member-label">เบอร์โทรศัพท์ / การติดต่อหลัก</div>
                    <input class="form-control" name="contact_channel" value="<?= esc(old('contact_channel', $profile['contact_channel'] ?? '')) ?>" maxlength="190" placeholder="เช่น 08x-xxx-xxxx หรือ Email">
                </div>

                <!-- Social Links -->
                <div class="col-md-6 mb-3">
                    <div class="member-label"><i class="fab fa-facebook text-primary"></i> Facebook (Link Profile)</div>
                    <input class="form-control" name="social_facebook" value="<?= esc(old('social_facebook', $profile['social_facebook'] ?? '')) ?>" placeholder="https://facebook.com/yourprofile">
                </div>
                <div class="col-md-6 mb-3">
                    <div class="member-label"><i class="fab fa-line text-success"></i> Line ID</div>
                    <input class="form-control" name="social_line" value="<?= esc(old('social_line', $profile['social_line'] ?? '')) ?>" placeholder="Line ID ของคุณ">
                </div>
                <div class="col-md-6 mb-3">
                    <div class="member-label"><i class="fab fa-instagram text-danger"></i> Instagram</div>
                    <input class="form-control" name="social_instagram" value="<?= esc(old('social_instagram', $profile['social_instagram'] ?? '')) ?>" placeholder="Username IG">
                </div>
                <div class="col-md-6 mb-3">
                    <div class="member-label"><i class="fab fa-x-twitter text-light"></i> X (Twitter)</div>
                    <input class="form-control" name="social_x" value="<?= esc(old('social_x', $profile['social_x'] ?? '')) ?>" placeholder="Username X">
                </div>
                <div class="col-md-12 mb-3">
                    <div class="member-label">เปลี่ยนรูปโปรไฟล์</div>
                    <input class="form-control" type="file" name="avatar" accept="image/jpeg,image/png,image/webp">
                    <small class="text-muted">อัปโหลด JPG, PNG, WEBP ไม่เกิน 2MB</small>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="member-label">คำอธิบาย/Bio</div>
                    <textarea class="form-control" name="bio" rows="5" placeholder="ประสบการณ์ เกมที่ถนัด หรือข้อมูลที่อยากให้ทีมทราบ"><?= esc(old('bio', $profile['bio'] ?? '')) ?></textarea>
                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
