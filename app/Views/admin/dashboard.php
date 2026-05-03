<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<?php
    $colors = ['bg-primary', 'bg-success', 'bg-warning', 'bg-purple', 'bg-danger', 'bg-info'];
    $i = 0;
?>
<div class="row">
    <?php foreach ($counts as $label => $total): ?>
        <div class="col-xl-2 col-md-4 col-sm-6 col-12">
            <div class="admin-stat <?= esc($colors[$i % count($colors)]) ?>">
                <div class="number"><?= esc($total) ?></div>
                <div class="label"><?= esc($label) ?></div>
            </div>
        </div>
        <?php $i++; ?>
    <?php endforeach ?>
</div>

<div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="card card-box">
            <div class="card-head">
                <header>การแข่งขันล่าสุด</header>
                <a class="btn btn-primary btn-sm pull-right" href="<?= site_url('adminz/tournaments/new') ?>">เพิ่มการแข่งขัน</a>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover">
                    <thead><tr><th>ชื่อการแข่งขัน</th><th>เกม</th><th>ประเภท</th><th>สถานะ</th></tr></thead>
                    <tbody>
                    <?php foreach ($tournaments as $item): ?>
                        <tr>
                            <td><?= esc($item['name']) ?></td>
                            <td><?= esc($item['game_name']) ?></td>
                            <td><?= esc($item['competition_type'] === 'team' ? 'ทีม' : 'เดี่ยว') ?></td>
                            <td><span class="badge badge-primary"><?= esc($item['status']) ?></span></td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-12">
        <div class="card card-box">
            <div class="card-head">
                <header>ผู้สมัครล่าสุด</header>
                <a class="btn btn-primary btn-sm pull-right" href="<?= site_url('adminz/registrations') ?>">จัดการผู้สมัคร</a>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover">
                    <thead><tr><th>การแข่งขัน</th><th>ทีม/ผู้สมัคร</th><th>สถานะ</th></tr></thead>
                    <tbody>
                    <?php foreach ($registrations as $item): ?>
                        <tr>
                            <td><?= esc($item['tournament_name']) ?></td>
                            <td><?= esc($item['team_name'] ?: ($item['player_name'] ?? '-')) ?></td>
                            <td><span class="badge badge-info"><?= esc($item['status']) ?></span></td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card card-box">
            <div class="card-head">
                <header>ตารางแข่งขันถัดไป</header>
                <a class="btn btn-primary btn-sm pull-right" href="<?= site_url('adminz/schedules') ?>">จัดการตารางแข่งขัน</a>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped">
                    <thead><tr><th>การแข่งขัน</th><th>รอบ</th><th>คู่แข่งขัน</th><th>เวลา</th><th>สถานที่</th><th>สถานะ</th></tr></thead>
                    <tbody>
                    <?php foreach ($schedules as $item): ?>
                        <tr>
                            <td><?= esc($item['tournament_name']) ?></td>
                            <td><?= esc($item['round_name'] ?: '-') ?></td>
                            <td><?= esc(($item['team_a'] ?? '-') . ' vs ' . ($item['team_b'] ?? '-')) ?></td>
                            <td><?= esc($item['scheduled_at'] ?: '-') ?></td>
                            <td><?= esc($item['venue'] ?: '-') ?></td>
                            <td><span class="badge badge-secondary"><?= esc($item['status']) ?></span></td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
