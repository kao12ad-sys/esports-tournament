<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<?php $isEdit = ! empty($item['id']); ?>
<div class="card card-box">
    <div class="card-head"><header><?= $isEdit ? 'แก้ไขข้อมูลการแข่งขัน' : 'เพิ่มข้อมูลการแข่งขัน' ?></header></div>
    <div class="card-body">
        <form method="post" action="<?= $isEdit ? site_url('adminz/tournaments/' . $item['id']) : site_url('adminz/tournaments') ?>">
            <?= csrf_field() ?>
            <?php if ($isEdit): ?><input type="hidden" name="_method" value="PUT"><?php endif ?>
            <div class="row">
                <div class="col-md-6">
                    <label>ชื่อการแข่งขัน</label>
                    <input class="form-control" name="name" value="<?= esc(old('name', $item['name'] ?? '')) ?>" required>
                </div>
                <div class="col-md-6">
                    <label>ชื่อเกมที่แข่งขัน</label>
                    <input class="form-control" name="game_name" value="<?= esc(old('game_name', $item['game_name'] ?? '')) ?>" required>
                </div>
                <div class="col-md-4">
                    <label>ประเภทการแข่งขัน</label>
                    <select class="form-select" name="competition_type">
                        <option value="team" <?= (($item['competition_type'] ?? 'team') === 'team') ? 'selected' : '' ?>>ทีม</option>
                        <option value="solo" <?= (($item['competition_type'] ?? '') === 'solo') ? 'selected' : '' ?>>เดี่ยว</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>รุ่นการแข่งขัน</label>
                    <input class="form-control" name="division" value="<?= esc(old('division', $item['division'] ?? '')) ?>">
                </div>
                <div class="col-md-4">
                    <label>สถานะ</label>
                    <select class="form-select" name="status">
                        <?php foreach (['draft' => 'ร่าง', 'open' => 'เปิดรับสมัคร', 'closed' => 'ปิดรับสมัคร', 'running' => 'กำลังแข่งขัน', 'finished' => 'จบการแข่งขัน'] as $status => $label): ?>
                            <option value="<?= esc($status) ?>" <?= (($item['status'] ?? 'draft') === $status) ? 'selected' : '' ?>><?= esc($label) ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-12">
                    <label>เกณฑ์การรับสมัคร</label>
                    <textarea class="form-control" name="application_criteria"><?= esc(old('application_criteria', $item['application_criteria'] ?? '')) ?></textarea>
                </div>
                <div class="col-md-6">
                    <label>กฏกติกา</label>
                    <textarea class="form-control" name="rules"><?= esc(old('rules', $item['rules'] ?? '')) ?></textarea>
                </div>
                <div class="col-md-6">
                    <label>รูปแบบการแข่งขัน</label>
                    <textarea class="form-control" name="format"><?= esc(old('format', $item['format'] ?? '')) ?></textarea>
                </div>
                <div class="col-md-12">
                    <label>สถานที่การแข่งขัน</label>
                    <input class="form-control" name="venue" value="<?= esc(old('venue', $item['venue'] ?? '')) ?>">
                </div>
                <div class="col-md-6"><label>เปิดรับสมัคร</label><input class="form-control" type="datetime-local" name="registration_open_at" value="<?= esc(str_replace(' ', 'T', $item['registration_open_at'] ?? '')) ?>"></div>
                <div class="col-md-6"><label>ปิดรับสมัคร</label><input class="form-control" type="datetime-local" name="registration_close_at" value="<?= esc(str_replace(' ', 'T', $item['registration_close_at'] ?? '')) ?>"></div>
                <div class="col-md-6"><label>เริ่มแข่งขัน</label><input class="form-control" type="datetime-local" name="start_at" value="<?= esc(str_replace(' ', 'T', $item['start_at'] ?? '')) ?>"></div>
                <div class="col-md-6"><label>จบการแข่งขัน</label><input class="form-control" type="datetime-local" name="end_at" value="<?= esc(str_replace(' ', 'T', $item['end_at'] ?? '')) ?>"></div>
            </div>
            <button class="btn btn-primary">บันทึก</button>
            <a class="btn btn-default" href="<?= site_url('adminz/tournaments') ?>">กลับ</a>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
