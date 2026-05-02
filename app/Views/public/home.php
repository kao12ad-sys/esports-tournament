<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>
<section class="hero">
    <p class="muted">ระบบจัดการแข่งขันระดับประเทศ</p>
    <h1>National Esports Tournament Platform</h1>
    <p class="muted">บริหารการแข่งขัน ทีม ผู้สมัคร ตารางแข่ง และรายงานบน CodeIgniter4 + MySQL</p>
    <a class="btn-main" href="<?= site_url('tournaments') ?>">ดูรายการแข่งขัน</a>
</section>
<section class="grid">
    <?php foreach ($tournaments as $item): ?>
        <article class="panel">
            <h4><?= esc($item['name']) ?></h4>
            <p><?= esc($item['game_name']) ?> · <?= esc($item['competition_type'] === 'team' ? 'ทีม' : 'เดี่ยว') ?></p>
            <p class="muted"><?= esc($item['venue'] ?? '-') ?></p>
            <a class="btn-main" href="<?= site_url('tournaments/' . $item['id']) ?>">รายละเอียด</a>
        </article>
    <?php endforeach ?>
</section>
<?= $this->endSection() ?>
