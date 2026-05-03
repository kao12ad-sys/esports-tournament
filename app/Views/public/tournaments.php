<?= $this->extend(session('role') === 'admin' ? 'layouts/admin' : 'layouts/public') ?>
<?= $this->section('content') ?>
<?php if (session('role') === 'admin'): ?>
    <div class="card card-box">
        <div class="card-head">
            <header>แสดงข้อมูลการแข่งขัน</header>
            <a class="btn btn-primary btn-sm pull-right" href="<?= site_url('adminz/tournaments/new') ?>">เพิ่มการแข่งขัน</a>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead><tr><th>ชื่อการแข่งขัน</th><th>เกม</th><th>ประเภท</th><th>รุ่น</th><th>สถานที่</th><th>สถานะ</th><th>รายละเอียด</th></tr></thead>
                <tbody>
                <?php foreach ($tournaments as $item): ?>
                    <tr>
                        <td><?= esc($item['name']) ?></td>
                        <td><?= esc($item['game_name']) ?></td>
                        <td><?= esc($item['competition_type'] === 'team' ? 'ทีม' : 'เดี่ยว') ?></td>
                        <td><?= esc($item['division'] ?: '-') ?></td>
                        <td><?= esc($item['venue'] ?: '-') ?></td>
                        <td><span class="badge badge-info"><?= esc($item['status']) ?></span></td>
                        <td><a class="btn btn-sm btn-outline-primary" href="<?= site_url('tournaments/' . $item['id']) ?>">ดูข้อมูล</a></td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
<?php else: ?>
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
<?php endif ?>
<?= $this->endSection() ?>
