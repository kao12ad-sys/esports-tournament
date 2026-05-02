<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<form class="cardx" method="post" action="<?= site_url('adminz/' . $route) ?>">
    <?= csrf_field() ?>
    <div class="row">
        <div class="col-md-3"><input class="form-control" name="name" placeholder="ชื่อทีม" required></div>
        <div class="col-md-2"><input class="form-control" name="tag" placeholder="ตัวย่อ"></div>
        <div class="col-md-4"><input class="form-control" name="contact_channel" placeholder="ช่องทางติดต่อ"></div>
        <div class="col-md-2"><select class="form-select" name="status"><option value="active">active</option><option value="inactive">inactive</option></select></div>
        <div class="col-md-1"><button class="btn btn-primary">เพิ่ม</button></div>
    </div>
    <textarea class="form-control" name="description" placeholder="คำอธิบาย"></textarea>
</form>
<div class="cardx table-responsive"><table class="table"><thead><tr><?php foreach ($fields as $label): ?><th><?= esc($label) ?></th><?php endforeach ?><th></th></tr></thead><tbody>
<?php foreach ($items as $item): ?><tr><?php foreach (array_keys($fields) as $field): ?><td><?= esc($item[$field] ?? '') ?></td><?php endforeach ?><td><form method="post" action="<?= site_url('adminz/' . $route . '/' . $item['id']) ?>"><?= csrf_field() ?><input type="hidden" name="_method" value="DELETE"><button class="btn btn-sm btn-outline-danger">ลบ</button></form></td></tr><?php endforeach ?>
</tbody></table></div>
<?= $this->endSection() ?>
