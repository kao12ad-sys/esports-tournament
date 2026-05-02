<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="row">
    <?php foreach ($counts as $label => $total): ?>
        <div class="col-md-3"><div class="cardx"><strong><?= esc($label) ?></strong><h2><?= esc($total) ?></h2></div></div>
    <?php endforeach ?>
</div>
<?= $this->endSection() ?>
