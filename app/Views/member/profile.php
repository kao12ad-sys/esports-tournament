<?= $this->extend('layouts/member') ?>
<?= $this->section('content') ?>
<form class="member-card" method="post" action="<?= site_url('member/profile') ?>">
    <?= csrf_field() ?>
    <div class="row">
        <div class="col-md-6">
            <div class="member-label">ชื่อผู้ใช้หรือนามแฝง</div>
            <input class="form-control" name="display_name" value="<?= esc($profile['display_name'] ?? '') ?>">
        </div>
        <div class="col-md-6">
            <div class="member-label">วันเกิด</div>
            <input class="form-control" type="date" name="birth_date" value="<?= esc($profile['birth_date'] ?? '') ?>">
        </div>
        <div class="col-md-12">
            <div class="member-label">ช่องทางการติดต่อ</div>
            <input class="form-control" name="contact_channel" value="<?= esc($profile['contact_channel'] ?? '') ?>">
        </div>
        <div class="col-md-12">
            <div class="member-label">คำอธิบาย</div>
            <textarea class="form-control" name="bio"><?= esc($profile['bio'] ?? '') ?></textarea>
        </div>
    </div>
    <button class="default-btn" type="submit">บันทึกข้อมูล</button>
</form>
<?= $this->endSection() ?>
