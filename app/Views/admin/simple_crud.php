<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="card card-box">
    <div class="card-head"><header>เพิ่มทีม</header></div>
    <div class="card-body">
        <form method="post" action="<?= site_url('adminz/' . $route) ?>">
            <?= csrf_field() ?>
            <div class="row">
                <div class="col-md-3"><label>ชื่อทีม</label><input class="form-control" name="name" required></div>
                <div class="col-md-2"><label>ตัวย่อ</label><input class="form-control" name="tag"></div>
                <div class="col-md-4"><label>ช่องทางติดต่อ</label><input class="form-control" name="contact_channel"></div>
                <div class="col-md-2"><label>สถานะ</label><select class="form-select" name="status"><option value="active">active</option><option value="inactive">inactive</option></select></div>
                <div class="col-md-12"><label>คำอธิบาย</label><textarea class="form-control" name="description"></textarea></div>
            </div>
            <button class="btn btn-primary">เพิ่มทีม</button>
        </form>
    </div>
</div>
<div class="card card-box">
    <div class="card-head"><header><?= esc($title) ?></header></div>
    <div class="card-body table-responsive">
        <table class="table table-hover">
            <thead><tr><?php foreach ($fields as $label): ?><th><?= esc($label) ?></th><?php endforeach ?><th></th></tr></thead>
            <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <?php foreach (array_keys($fields) as $field): ?><td><?= esc($item[$field] ?? '') ?></td><?php endforeach ?>
                    <td><form method="post" action="<?= site_url('adminz/' . $route . '/' . $item['id']) ?>"><?= csrf_field() ?><input type="hidden" name="_method" value="DELETE"><button class="btn btn-sm btn-outline-danger" onclick="return confirm('ยืนยันการลบทีม?')">ลบ</button></form></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
