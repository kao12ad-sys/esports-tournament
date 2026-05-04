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
            <img src="<?= esc($avatar, 'attr') ?>" alt="profile" class="profile-avatar mb-3" style="width:140px;height:140px">
            <h4><?= esc($profile['display_name'] ?? session('username')) ?></h4>
            <p class="text-muted mb-1"><?= esc(session('username')) ?></p>
            <p class="text-muted"><?= esc($profile['contact_channel'] ?? 'ยังไม่ได้ระบุช่องทางติดต่อ') ?></p>
            <?php if (! empty($profile['avatar'])): ?>
                <form method="post" action="<?= site_url('member/profile') ?>" onsubmit="return confirm('ลบรูปโปรไฟล์นี้?')">
                    <?= csrf_field() ?>
                    <input type="hidden" name="display_name" value="<?= esc($profile['display_name'] ?? session('username'), 'attr') ?>">
                    <input type="hidden" name="birth_date" value="<?= esc($profile['birth_date'] ?? '', 'attr') ?>">
                    <input type="hidden" name="contact_channel" value="<?= esc($profile['contact_channel'] ?? '', 'attr') ?>">
                    <input type="hidden" name="bio" value="<?= esc($profile['bio'] ?? '', 'attr') ?>">
                    <input type="hidden" name="delete_avatar" value="1">
                    <button class="btn btn-outline-danger" type="submit"><i class="fa fa-trash"></i> ลบรูปโปรไฟล์</button>
                </form>
            <?php endif ?>
        </div>
    </div>
    <div class="col-lg-8">
        <form class="member-card" method="post" action="<?= site_url('member/profile') ?>" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <div class="member-label">Member Profile</div>
                    <h4>แก้ไขข้อมูลส่วนตัว</h4>
                </div>
                <span class="status-pill">อัปโหลด JPG, PNG, WEBP ไม่เกิน 2MB</span>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="member-label">ชื่อผู้ใช้หรือนามแฝง</div>
                    <input class="form-control" name="display_name" value="<?= esc(old('display_name', $profile['display_name'] ?? '')) ?>" maxlength="120">
                </div>
                <div class="col-md-6 mb-3">
                    <div class="member-label">วันเกิด</div>
                    <input class="form-control" type="date" name="birth_date" value="<?= esc(old('birth_date', $profile['birth_date'] ?? '')) ?>">
                </div>
                <div class="col-md-12 mb-3">
                    <div class="member-label">ช่องทางการติดต่อ</div>
                    <input class="form-control" name="contact_channel" value="<?= esc(old('contact_channel', $profile['contact_channel'] ?? '')) ?>" maxlength="190" placeholder="เช่น Line, Discord, เบอร์โทร หรืออีเมล">
                </div>
                <div class="col-md-12 mb-3">
                    <div class="member-label">รูปโปรไฟล์</div>
                    <input class="form-control" type="file" name="avatar" accept="image/jpeg,image/png,image/webp">
                </div>
                <div class="col-md-12 mb-3">
                    <div class="member-label">คำอธิบาย</div>
                    <textarea class="form-control" name="bio" rows="5" placeholder="ประสบการณ์ เกมที่ถนัด หรือข้อมูลที่อยากให้ทีมทราบ"><?= esc(old('bio', $profile['bio'] ?? '')) ?></textarea>
                </div>
            </div>
            <button class="btn default-btn" type="submit"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
