<?= $this->extend('layouts/member') ?>
<?= $this->section('content') ?>
<form class="cardx" method="post" action="<?= site_url('member/profile') ?>">
    <?= csrf_field() ?>
    <label>ชื่อผู้ใช้หรือนามแฝง</label><input class="form-control" name="display_name" value="<?= esc($profile['display_name'] ?? '') ?>">
    <label>คำอธิบาย</label><textarea class="form-control" name="bio"><?= esc($profile['bio'] ?? '') ?></textarea>
    <label>วันเกิด</label><input class="form-control" type="date" name="birth_date" value="<?= esc($profile['birth_date'] ?? '') ?>">
    <label>ช่องทางการติดต่อ</label><input class="form-control" name="contact_channel" value="<?= esc($profile['contact_channel'] ?? '') ?>">
    <button class="btn btn-primary mt-2">บันทึก</button>
</form>
<?= $this->endSection() ?>
