<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<?php $colors = ['bg-primary', 'bg-success', 'bg-warning', 'bg-purple', 'bg-danger']; $i = 0; ?>
<div class="row">
    <?php foreach ($summary as $label => $total): ?>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="admin-stat <?= esc($colors[$i % count($colors)]) ?>">
                <div class="number"><?= esc($total) ?></div>
                <div class="label"><?= esc($label) ?></div>
            </div>
        </div>
        <?php $i++; ?>
    <?php endforeach ?>
</div>
<div class="card card-box">
    <div class="card-head"><header>สถานะการสมัครแข่งขัน</header></div>
    <div class="card-body">
        <?php foreach ($registrations as $row): ?>
            <p><strong><?= esc($row['status']) ?></strong>: <?= esc($row['total']) ?> รายการ</p>
        <?php endforeach ?>
    </div>
</div>
<?= $this->endSection() ?>
