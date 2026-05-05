<?= $this->extend('layouts/member') ?>
<?= $this->section('content') ?>
<?php
    $canEdit = session('role') === 'team_manager';
    $team = $team ?? ['name' => '', 'tag' => '', 'description' => '', 'contact_channel' => ''];
    $roleLabels = [
        'team_manager' => 'ผู้จัดการทีม',
        'coach' => 'ผู้ฝึกสอน',
        'amateur_athlete' => 'นักกีฬาทั่วไป',
        'pro_athlete' => 'นักกีฬาอาชีพ',
    ];
?>

<div class="row">
    <div class="col-lg-8">
        <form class="member-card" method="post" action="<?= site_url('member/team') ?>">
            <?= csrf_field() ?>
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <div class="member-label">Team Management</div>
                    <h4><?= $canEdit ? 'จัดการข้อมูลทีม' : 'ข้อมูลทีม' ?></h4>
                </div>
                <span class="status-pill"><?= $canEdit ? 'แก้ไขได้' : 'อ่านอย่างเดียว' ?></span>
            </div>

            <?php if (! $canEdit && empty($team['name'])): ?>
                <div class="empty-state">คุณยังไม่มีทีม กรุณาติดต่อ admin หรือผู้จัดการทีมเพื่อกำหนดทีม</div>
            <?php endif ?>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="member-label">ชื่อทีม</div>
                    <input class="form-control" name="name" value="<?= esc(old('name', $team['name'] ?? '')) ?>" <?= $canEdit ? '' : 'readonly' ?> required>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="member-label">ตัวย่อทีม</div>
                    <input class="form-control" name="tag" value="<?= esc(old('tag', $team['tag'] ?? '')) ?>" <?= $canEdit ? '' : 'readonly' ?> maxlength="30">
                </div>
                <div class="col-md-12 mb-3">
                    <div class="member-label">คำอธิบาย</div>
                    <textarea class="form-control" name="description" rows="5" <?= $canEdit ? '' : 'readonly' ?>><?= esc(old('description', $team['description'] ?? '')) ?></textarea>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="member-label">ช่องทางติดต่อทีม</div>
                    <input class="form-control" name="contact_channel" value="<?= esc(old('contact_channel', $team['contact_channel'] ?? '')) ?>" <?= $canEdit ? '' : 'readonly' ?> maxlength="190">
                </div>
            </div>

            <?php if ($canEdit): ?>
                <button class="btn default-btn" type="submit"><i class="fa fa-save"></i> บันทึกข้อมูลทีม</button>
            <?php endif ?>
        </form>
    </div>
    <div class="col-lg-4">
        <div class="member-card">
            <h5>สิทธิ์ผู้จัดการทีม</h5>
            <p class="text-muted mb-3">บัญชี role `team_manager` สามารถสร้างทีมเมื่อยังไม่มีทีม และแก้ไขชื่อทีม ตัวย่อ คำอธิบาย และช่องทางติดต่อทีมได้</p>
            <div class="member-label">บัญชีตัวอย่าง</div>
            <strong>manager@example.test</strong>
            <p class="text-muted mb-0">Password@123</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="member-card">
            <h5>รายชื่อสมาชิกทีม</h5>
            <div class="table-responsive">
                <table class="table member-table">
                    <thead><tr><th>ชื่อผู้ใช้</th><th>บทบาท</th><th>สถานะ</th><th></th></tr></thead>
                    <tbody>
                    <?php if ($members === []): ?>
                        <tr><td colspan="3"><div class="empty-state">ยังไม่มีสมาชิกทีม</div></td></tr>
                    <?php endif ?>
                    <?php foreach ($members as $member): ?>
                        <tr>
                            <td><?= esc($member['username']) ?></td>
                            <td><?= esc($roleLabels[$member['role']] ?? $member['role']) ?></td>
                            <td><span class="status-pill"><?= esc($member['status']) ?></span></td>
                            <td class="text-end">
                                <a href="<?= site_url('profiles/' . $member['id']) ?>" class="btn btn-light btn-sm">
                                    <i class="fa fa-eye"></i> ดูโปรไฟล์
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="member-card">
            <h5>ประวัติการย้ายทีม</h5>
            <div class="table-responsive">
                <table class="table member-table">
                    <thead><tr><th>สมาชิก</th><th>ทีม</th><th>ช่วงเวลา</th></tr></thead>
                    <tbody>
                    <?php if ($histories === []): ?>
                        <tr><td colspan="3"><div class="empty-state">ยังไม่มีประวัติทีม</div></td></tr>
                    <?php endif ?>
                    <?php foreach ($histories as $history): ?>
                        <tr>
                            <td><?= esc($history['username']) ?></td>
                            <td><?= esc($history['team_name']) ?></td>
                            <td><?= esc($history['joined_at'] ?: '-') ?> - <?= esc($history['left_at'] ?? 'ปัจจุบัน') ?></td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
