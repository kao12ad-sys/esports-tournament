<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="cardx"><a class="btn btn-primary" href="<?= site_url('adminz/tournaments/new') ?>">เพิ่มการแข่งขัน</a></div>
<div class="cardx table-responsive">
<table class="table">
    <thead><tr><th>ชื่อการแข่งขัน</th><th>เกม</th><th>ประเภท</th><th>รุ่น</th><th>สถานะ</th><th></th></tr></thead>
    <tbody>
    <?php foreach ($items as $item): ?>
        <tr>
            <td><?= esc($item['name']) ?></td><td><?= esc($item['game_name']) ?></td><td><?= esc($item['competition_type']) ?></td><td><?= esc($item['division']) ?></td><td><?= esc($item['status']) ?></td>
            <td>
                <a class="btn btn-sm btn-outline-primary" href="<?= site_url('adminz/tournaments/' . $item['id'] . '/edit') ?>">แก้ไข</a>
                <form class="d-inline" method="post" action="<?= site_url('adminz/tournaments/' . $item['id']) ?>"><?= csrf_field() ?><input type="hidden" name="_method" value="DELETE"><button class="btn btn-sm btn-outline-danger">ลบ</button></form>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
</div>
<?= $this->endSection() ?>
