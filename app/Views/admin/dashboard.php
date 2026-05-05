<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<?php
    $icons = [
        'เธเธฒเธฃเนเธเนเธเธเธฑเธเธ—เธฑเนเธเธซเธกเธ”' => 'fas fa-award',
        'เธ—เธตเธกเธ—เธฑเนเธเธซเธกเธ”' => 'fas fa-users',
        'เธชเธกเธฒเธเธดเธเธ—เธฑเนเธเธซเธกเธ”' => 'fas fa-user-circle',
        'เธเธนเนเธชเธกเธฑเธเธฃเนเธเนเธเธเธฑเธ' => 'fas fa-clipboard-list',
        'เธ•เธฒเธฃเธฒเธเนเธเนเธเธเธฑเธ' => 'fas fa-calendar-alt',
        'เธฃเธญเธญเธเธธเธกเธฑเธ•เธด' => 'fas fa-clock',
    ];
    $colors = ['bg-primary', 'bg-success', 'bg-purple', 'bg-warning', 'bg-danger', 'bg-info'];
    $i = 0;
?>

<div class="row">
    <?php foreach ($counts as $label => $total): ?>
        <div class="col-xl-2 col-md-4 col-sm-6 col-12">
            <div class="stat-card <?= esc($colors[$i % count($colors)]) ?>">
                <i class="<?= esc($icons[$label] ?? 'fas fa-chart-bar') ?> stat-icon"></i>
                <div class="stat-value"><?= esc($total) ?></div>
                <div class="stat-label"><?= esc($label) ?></div>
            </div>
        </div>
        <?php $i++; ?>
    <?php endforeach ?>
</div>

<div class="row">
    <div class="col-lg-6 col-md-12 d-flex">
        <div class="card card-box w-100">
            <div class="card-head">
                <header>เธเธฒเธฃเนเธเนเธเธเธฑเธเธฅเนเธฒเธชเธธเธ”</header>
                <div class="pull-right">
                    <a class="btn btn-primary btn-xs" href="<?= site_url('adminz/tournaments/new') ?>">+ เน€เธเธดเนเธกเนเธซเธกเน</a>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>เธเธทเนเธญเธเธฒเธฃเนเธเนเธเธเธฑเธ</th>
                            <th>เน€เธเธก</th>
                            <th>เธเธฃเธฐเน€เธ เธ—</th>
                            <th>เธชเธ–เธฒเธเธฐ</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($tournaments as $item): ?>
                        <tr>
                            <td><strong><?= esc($item['name']) ?></strong></td>
                            <td><?= esc($item['game_name']) ?></td>
                            <td><span class="badge badge-outline-primary"><?= esc($item['competition_type'] === 'team' ? 'เธ—เธตเธก' : 'เน€เธ”เธตเนเธขเธง') ?></span></td>
                            <td>
                                <?php if ($item['status'] === 'open'): ?>
                                    <span class="badge badge-success">เน€เธเธดเธ”เธฃเธฑเธเธชเธกเธฑเธเธฃ</span>
                                <?php elseif ($item['status'] === 'closed'): ?>
                                    <span class="badge badge-danger">เธเธดเธ”เธฃเธฑเธเธชเธกเธฑเธเธฃ</span>
                                <?php else: ?>
                                    <span class="badge badge-info"><?= esc($item['status']) ?></span>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-12 d-flex">
        <div class="card card-box w-100">
            <div class="card-head">
                <header>เธเธนเนเธชเธกเธฑเธเธฃเธฅเนเธฒเธชเธธเธ”</header>
                <div class="pull-right">
                    <a class="btn btn-default btn-xs" href="<?= site_url('adminz/registrations') ?>">เธ”เธนเธ—เธฑเนเธเธซเธกเธ”</a>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>เธเธฒเธฃเนเธเนเธเธเธฑเธ</th>
                            <th>เธ—เธตเธก/เธเธนเนเธชเธกเธฑเธเธฃ</th>
                            <th>เธชเธ–เธฒเธเธฐ</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($registrations as $item): ?>
                        <tr>
                            <td><?= esc($item['tournament_name']) ?></td>
                            <td><?= esc($item['team_name'] ?: ($item['player_name'] ?? '-')) ?></td>
                            <td>
                                <?php if ($item['status'] === 'approved'): ?>
                                    <span class="badge badge-success">เธญเธเธธเธกเธฑเธ•เธดเนเธฅเนเธง</span>
                                <?php elseif ($item['status'] === 'pending'): ?>
                                    <span class="badge badge-warning">เธฃเธญเธ•เธฃเธงเธเธชเธญเธ</span>
                                <?php else: ?>
                                    <span class="badge badge-danger">เธเธเธดเน€เธชเธ</span>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card card-box">
            <div class="card-head">
                <header>เธ•เธฒเธฃเธฒเธเนเธเนเธเธเธฑเธเธ–เธฑเธ”เนเธ</header>
                <div class="pull-right">
                    <a class="btn btn-primary btn-xs" href="<?= site_url('adminz/schedules') ?>">เธเธฑเธ”เธเธฒเธฃเธ•เธฒเธฃเธฒเธ</a>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>เธเธฒเธฃเนเธเนเธเธเธฑเธ</th>
                            <th>เธฃเธญเธ</th>
                            <th>เธเธนเนเนเธเนเธเธเธฑเธ</th>
                            <th>เน€เธงเธฅเธฒ</th>
                            <th>เธชเธ–เธฒเธเธ—เธตเน</th>
                            <th>เธชเธ–เธฒเธเธฐ</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($schedules as $item): ?>
                        <tr>
                            <td><?= esc($item['tournament_name']) ?></td>
                            <td><?= esc($item['round_name'] ?: '-') ?></td>
                            <td class="text-center">
                                <span class="badge badge-info"><?= esc($item['team_a'] ?? '-') ?></span>
                                <span class="m-x-10">VS</span>
                                <span class="badge badge-info"><?= esc($item['team_b'] ?? '-') ?></span>
                            </td>
                            <td><i class="far fa-clock m-r-5"></i><?= esc($item['scheduled_at'] ?: '-') ?></td>
                            <td><i class="fas fa-map-marker-alt m-r-5"></i><?= esc($item['venue'] ?: '-') ?></td>
                            <td>
                                <span class="badge badge-outline-secondary"><?= esc($item['status']) ?></span>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
