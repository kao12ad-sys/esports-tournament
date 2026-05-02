<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<?php $isEdit = ! empty($item['id']); ?>
<form class="cardx" method="post" action="<?= $isEdit ? site_url('adminz/tournaments/' . $item['id']) : site_url('adminz/tournaments') ?>">
    <?= csrf_field() ?><?php if ($isEdit): ?><input type="hidden" name="_method" value="PUT"><?php endif ?>
    <input class="form-control" name="name" placeholder="ชื่อการแข่งขัน" value="<?= esc(old('name', $item['name'] ?? '')) ?>" required>
    <input class="form-control" name="game_name" placeholder="ชื่อเกมที่แข่งขัน" value="<?= esc(old('game_name', $item['game_name'] ?? '')) ?>" required>
    <select class="form-select" name="competition_type"><option value="team" <?= (($item['competition_type'] ?? '') === 'team') ? 'selected' : '' ?>>ทีม</option><option value="solo" <?= (($item['competition_type'] ?? '') === 'solo') ? 'selected' : '' ?>>เดี่ยว</option></select>
    <input class="form-control" name="division" placeholder="รุ่นการแข่งขัน" value="<?= esc(old('division', $item['division'] ?? '')) ?>">
    <textarea class="form-control" name="application_criteria" placeholder="เกณฑ์การรับสมัคร"><?= esc(old('application_criteria', $item['application_criteria'] ?? '')) ?></textarea>
    <textarea class="form-control" name="rules" placeholder="กฏกติกา"><?= esc(old('rules', $item['rules'] ?? '')) ?></textarea>
    <textarea class="form-control" name="format" placeholder="รูปแบบการแข่งขัน"><?= esc(old('format', $item['format'] ?? '')) ?></textarea>
    <input class="form-control" name="venue" placeholder="สถานที่การแข่งขัน" value="<?= esc(old('venue', $item['venue'] ?? '')) ?>">
    <div class="row">
        <div class="col-md-6"><input class="form-control" type="datetime-local" name="registration_open_at" value="<?= esc(str_replace(' ', 'T', $item['registration_open_at'] ?? '')) ?>"></div>
        <div class="col-md-6"><input class="form-control" type="datetime-local" name="registration_close_at" value="<?= esc(str_replace(' ', 'T', $item['registration_close_at'] ?? '')) ?>"></div>
        <div class="col-md-6"><input class="form-control" type="datetime-local" name="start_at" value="<?= esc(str_replace(' ', 'T', $item['start_at'] ?? '')) ?>"></div>
        <div class="col-md-6"><input class="form-control" type="datetime-local" name="end_at" value="<?= esc(str_replace(' ', 'T', $item['end_at'] ?? '')) ?>"></div>
    </div>
    <select class="form-select" name="status"><?php foreach (['draft','open','closed','running','finished'] as $status): ?><option value="<?= $status ?>" <?= (($item['status'] ?? 'draft') === $status) ? 'selected' : '' ?>><?= $status ?></option><?php endforeach ?></select>
    <button class="btn btn-primary">บันทึก</button>
</form>
<?= $this->endSection() ?>
