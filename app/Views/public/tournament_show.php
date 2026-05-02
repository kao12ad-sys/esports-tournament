<?= $this->extend('layouts/public') ?>
<?= $this->section('content') ?>
<section class="hero">
    <h1><?= esc($tournament['name']) ?></h1>
    <p class="muted"><?= esc($tournament['game_name']) ?> · <?= esc($tournament['competition_type'] === 'team' ? 'ประเภททีม' : 'ประเภทเดี่ยว') ?> · <?= esc($tournament['division'] ?? '-') ?></p>
</section>
<section class="panel">
    <h4>เกณฑ์การรับสมัคร</h4><p><?= nl2br(esc($tournament['application_criteria'] ?? '-')) ?></p>
    <h4>กฏกติกาและรูปแบบการแข่งขัน</h4><p><?= nl2br(esc(($tournament['rules'] ?? '-') . "\n" . ($tournament['format'] ?? ''))) ?></p>
    <h4>สถานที่การแข่งขัน</h4><p><?= esc($tournament['venue'] ?? '-') ?></p>
</section>
<?= $this->endSection() ?>
