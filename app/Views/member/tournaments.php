<?= $this->extend('layouts/member') ?>
<?= $this->section('content') ?>
<?php
    $registered        = array_column($registrations, null, 'tournament_id');
    $registeredStatus  = array_column($registrations, 'status', 'tournament_id');
    $canRegisterTournament = $canRegisterTournament ?? false;

    $cancelReasons = [
        'ทีมมีปัญหาภายใน ไม่สามารถเข้าร่วมได้',
        'สมาชิกในทีมไม่ครบตามจำนวนที่กำหนด',
        'ติดภารกิจสำคัญในช่วงเวลาแข่งขัน',
        'สมัครผิดรายการ ต้องการแก้ไขการสมัคร',
        'ปัญหาด้านอุปกรณ์หรือการเชื่อมต่ออินเทอร์เน็ต',
    ];
?>

<link rel="stylesheet" href="<?= base_url('templates/source/assets/plugins/sweet-alert/sweetalert2.min.css') ?>">

<style {csp-style-nonce}>
/* ===== Reason option buttons ===== */
.es-opt {
    display: flex !important;
    align-items: center !important;
    gap: 10px !important;
    width: 100% !important;
    padding: 9px 13px !important;
    margin: 0 0 5px !important;
    border: 1.5px solid rgba(100,110,140,.3) !important;
    border-radius: 8px !important;
    background: rgba(0,0,0,.03) !important;
    font-size: 13px !important;
    color: rgba(0,0,0,.6) !important;
    cursor: pointer !important;
    text-align: left !important;
    font-family: inherit !important;
    box-sizing: border-box !important;
    transition: border-color .15s, background .15s, color .15s !important;
}
.es-opt:hover {
    border-color: rgba(255,84,112,.4) !important;
    background: rgba(255,84,112,.06) !important;
}
.es-opt.es-selected {
    border-color: #ff5470 !important;
    background: rgba(255,84,112,.12) !important;
    color: #1a1a2e !important;
    font-weight: 600 !important;
}
#esRL { display: flex !important; flex-direction: column !important; }

/* ===== Other textarea ===== */
#esOT {
    width: 100% !important;
    padding: 7px 10px !important;
    margin-top: 4px !important;
    border: 1.5px solid rgba(100,110,140,.3) !important;
    border-radius: 6px !important;
    background: #fff !important;
    color: #1a1a2e !important;
    font-size: 12px !important;
    resize: none !important;
    font-family: inherit !important;
    outline: none !important;
    box-sizing: border-box !important;
    transition: border-color .15s !important;
}
#esOT:focus { border-color: #ff5470 !important; }
#esOB { display: none; margin-top: 4px !important; }
#esOB.visible { display: block !important; }

/* ===== Warning strip ===== */
#esWN {
    display: flex !important;
    align-items: flex-start !important;
    gap: 8px !important;
    margin-top: 10px !important;
    padding: 8px 12px !important;
    background: rgba(255,84,112,.08) !important;
    border: 1px solid rgba(255,84,112,.25) !important;
    border-radius: 6px !important;
    font-size: 11px !important;
    color: #d63851 !important;
    line-height: 1.5 !important;
}
#esCH { font-size: 11px; color: rgba(0,0,0,.4); }
.es-pn { font-size: 12px; color: rgba(0,0,0,.5); margin: 0 0 10px; text-align: left; }
.es-pn strong { color: #1a1a2e; }

/* ===== SweetAlert2 popup theme override ===== */
.swal2-popup.es-cancel-popup {
    background: #2a3042 !important;
    border: 1px solid #35384a !important;
    border-radius: 14px !important;
    color: #f5f7fb !important;
    font-family: Poppins, Arial, sans-serif !important;
}
[data-theme="light"] .swal2-popup.es-cancel-popup {
    background: #fff !important;
    border-color: #dae1ed !important;
    color: #1e293b !important;
}
.swal2-popup.es-cancel-popup .swal2-title {
    color: #f5f7fb !important; font-size: .95rem !important; font-weight: 700 !important;
}
[data-theme="light"] .swal2-popup.es-cancel-popup .swal2-title { color: #1e293b !important; }
.swal2-popup.es-cancel-popup .swal2-html-container { overflow: visible !important; }
.swal2-popup.es-cancel-popup .swal2-confirm {
    background: linear-gradient(135deg,#ff5470,#c0392b) !important;
    border: 0 !important; font-weight: 600 !important; border-radius: 6px !important;
}
.swal2-popup.es-cancel-popup .swal2-cancel {
    background: #35384a !important; border: 0 !important;
    color: #f5f7fb !important; border-radius: 6px !important;
}
[data-theme="light"] .swal2-popup.es-cancel-popup .swal2-cancel {
    background: #e2e8f0 !important; color: #1e293b !important;
}
.swal2-popup.es-cancel-popup .swal2-validation-message {
    background: rgba(255,84,112,.12) !important;
    color: #ff5470 !important; border-radius: 6px !important;
}

/* Light theme adjustments for popup content */
[data-theme="light"] .es-opt {
    background: rgba(255,255,255,.8) !important;
    border-color: rgba(100,110,140,.25) !important;
    color: rgba(0,0,0,.65) !important;
}
[data-theme="light"] .es-opt.es-selected {
    background: rgba(255,84,112,.1) !important;
    color: #1a1a2e !important;
}
</style>

<div class="member-card">
    <h5>สมัครและตรวจสอบการแข่งขัน</h5>
    <div class="table-responsive">
        <table class="table member-table">
            <thead><tr>
                <th>การแข่งขัน</th>
                <th>เกม</th>
                <th>ประเภท</th>
                <th>สถานะสมัคร</th>
                <th></th>
            </tr></thead>
            <tbody>
            <?php foreach ($tournaments as $t): ?>
                <?php
                    $tid       = $t['id'];
                    $status    = $registeredStatus[$tid] ?? null;
                    $isReg     = $status !== null;
                    $canCancel = $canRegisterTournament && $isReg;
                ?>
                <tr>
                    <td><a href="<?= site_url('member/tournaments/' . $tid) ?>"><?= esc($t['name']) ?></a></td>
                    <td><?= esc($t['game_name']) ?></td>
                    <td><?= esc($t['competition_type'] === 'team' ? 'ทีม' : 'เดี่ยว') ?></td>
                    <td>
                        <?php if ($status): ?>
                            <span class="status-pill <?= esc($status) ?>"><?= esc($status) ?></span>
                        <?php else: ?>
                            <span style="color:var(--es-muted); font-size:12px;">-</span>
                        <?php endif ?>
                    </td>
                    <td style="white-space:nowrap;">
                        <?php if ($canRegisterTournament && ! $isReg && $t['status'] === 'open'): ?>
                            <form method="post" action="<?= site_url('member/tournaments/register/' . $tid) ?>" style="display:inline-flex; gap:6px; align-items:center;">
                                <?= csrf_field() ?>
                                <div style="min-width:220px;">
                                    <select class="form-select" name="athlete_ids[]" multiple size="4" required style="font-size:12px;">
                                        <?php foreach (($teamAthletes ?? []) as $athlete): ?>
                                            <option value="<?= esc($athlete['id'], 'attr') ?>"><?= esc($athlete['username']) ?> (<?= esc($athlete['role']) ?>)</option>
                                        <?php endforeach ?>
                                    </select>
                                    <div class="text-muted" style="font-size:11px;">ต้องเลือก <?= esc($t['min_players'] ?? 1) ?>-<?= esc($t['max_players'] ?? ($t['min_players'] ?? 1)) ?> คน</div>
                                </div>
                                <input class="form-control" name="note" placeholder="หมายเหตุ" style="font-size:12px; padding:5px 10px; max-width:130px;">
                                <button class="btn btn-primary btn-sm" type="submit">
                                    <i class="fas fa-plus"></i> สมัคร
                                </button>
                            </form>
                        <?php elseif (! $canRegisterTournament && $t['status'] === 'open' && ! $isReg): ?>
                            <span class="text-muted" style="font-size:12px;">เฉพาะผู้จัดการทีมเท่านั้น</span>
                        <?php endif ?>

                        <?php if ($canCancel): ?>
                            <button
                                type="button"
                                class="btn btn-danger btn-sm btn-cancel-reg"
                                style="margin-top:4px;"
                                data-name="<?= esc($t['name'], 'attr') ?>"
                                data-url="<?= site_url('member/tournaments/cancel/' . $tid) ?>"
                            >
                                <i class="fas fa-xmark"></i> ยกเลิกการสมัคร
                            </button>
                        <?php endif ?>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<!-- Data bridge: pass PHP vars via data-attributes (no inline script needed) -->
<div id="esCancelData"
    style="display:none"
    data-reasons='<?= json_encode($cancelReasons, JSON_UNESCAPED_UNICODE | JSON_HEX_APOS) ?>'
    data-csrf-name="<?= esc(csrf_token(), 'attr') ?>"
    data-csrf-hash="<?= esc(csrf_hash(), 'attr') ?>"
></div>
<script src="<?= base_url('templates/source/assets/plugins/sweet-alert/sweetalert2.min.js') ?>"></script>
<script src="<?= base_url('assets/frontend/js/tournament-cancel.js') ?>?v=<?= time() ?>"></script>
<?= $this->endSection() ?>
