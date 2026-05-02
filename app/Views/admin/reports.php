<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="row"><?php foreach ($summary as $label => $total): ?><div class="col-md-3"><div class="cardx"><strong><?= esc($label) ?></strong><h2><?= esc($total) ?></h2></div></div><?php endforeach ?></div>
<div class="cardx"><h5>สถานะการสมัคร</h5><?php foreach ($registrations as $row): ?><p><?= esc($row['status']) ?>: <?= esc($row['total']) ?></p><?php endforeach ?></div>
<?= $this->endSection() ?>
