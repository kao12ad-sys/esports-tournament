<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>
<section class="hero"><h1>รายการแข่งขัน</h1></section>
<section class="grid">
    <?php foreach ($tournaments as $item): ?>
        <article class="panel">
            <h4><?= esc($item['name']) ?></h4>
            <p><?= esc($item['game_name']) ?> · <?= esc($item['division'] ?? '-') ?> · <?= esc($item['status']) ?></p>
            <a class="btn-main" href="<?= site_url('tournaments/' . $item['id']) ?>">ดูรายละเอียด</a>
        </article>
    <?php endforeach ?>
</section>
<?= $this->endSection() ?>
