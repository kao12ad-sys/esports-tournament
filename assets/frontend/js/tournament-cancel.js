(function () {
    'use strict';

    var dataEl    = document.getElementById('esCancelData');
    var REASONS   = dataEl ? JSON.parse(dataEl.dataset.reasons) : [];
    var CSRF_NAME = dataEl ? dataEl.dataset.csrfName : 'csrf_token';
    var CSRF_HASH = dataEl ? dataEl.dataset.csrfHash : '';

    function esc(s) {
        return String(s)
            .replace(/&/g,'&amp;').replace(/</g,'&lt;')
            .replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }

    /* All styling via CSS classes defined in <style {csp-nonce}> in the view */
    function buildHtml(name) {
        var rows = REASONS.map(function (r) {
            return '<button type="button" class="es-opt" data-val="' + esc(r) + '">'
                 + '<i class="fas fa-circle-dot" aria-hidden="true"></i>'
                 + '<span>' + esc(r) + '</span></button>';
        }).join('');
        rows += '<button type="button" class="es-opt" data-val="other">'
              + '<i class="fas fa-pen" aria-hidden="true"></i>'
              + '<span>เหตุผลอื่นๆ (โปรดระบุ)</span></button>';

        return '<p id="esPN">ยกเลิก: <strong>' + esc(name) + '</strong></p>'
             + '<div id="esRL">' + rows + '</div>'
             + '<div id="esOB">'
             +   '<textarea id="esOT" rows="2" maxlength="500" placeholder="กรอกเหตุผลของคุณที่นี่..."></textarea>'
             +   '<div><span id="esCH">0</span>/500</div>'
             + '</div>'
             + '<div id="esWN">'
             +   '<i class="fas fa-triangle-exclamation" aria-hidden="true"></i>'
             +   '<span>การยกเลิกจะลบข้อมูลการสมัครออกจากระบบ และไม่สามารถกู้คืนได้</span>'
             + '</div>';
    }

    function doSubmit(url, reason, other) {
        var form = document.createElement('form');
        form.method = 'POST'; form.action = url; form.style.display = 'none';
        function f(n, v) {
            var el = document.createElement('input');
            el.type = 'hidden'; el.name = n; el.value = v;
            form.appendChild(el);
        }
        f(CSRF_NAME, CSRF_HASH);
        f('cancel_reason', reason);
        f('cancel_reason_other', other);
        document.body.appendChild(form);
        form.submit();
    }

    document.addEventListener('click', function (e) {
        var btn = e.target.closest('.btn-cancel-reg');
        if (!btn) return;

        var name = btn.dataset.name;
        var url  = btn.dataset.url;
        var selectedVal = null;

        Swal.fire({
            customClass: { popup: 'es-cancel-popup' },
            title: '<i class="fas fa-exclamation-triangle" aria-hidden="true"></i> ยกเลิกการสมัครแข่งขัน',
            html: buildHtml(name),
            showCancelButton: true,
            confirmButtonText: '<i class="fas fa-trash-can"></i>&nbsp;ยืนยัน',
            cancelButtonText:  '<i class="fas fa-arrow-left"></i>&nbsp;ย้อนกลับ',
            reverseButtons: true,
            width: 480,
            padding: '1rem 1.2rem 1.2rem',
            onOpen: function () {
                var list    = document.getElementById('esRL');
                var ob      = document.getElementById('esOB');
                var ot      = document.getElementById('esOT');
                var charCnt = document.getElementById('esCH');
                var pn      = document.getElementById('esPN');

                /* Style name paragraph — class approach */
                if (pn) {
                    pn.className = 'es-pn';
                }

                /* Option click — use class toggle only (no inline style) */
                if (list) {
                    list.addEventListener('click', function (ev) {
                        var opt = ev.target.closest('.es-opt');
                        if (!opt) return;
                        ev.preventDefault();
                        ev.stopPropagation();

                        selectedVal = opt.dataset.val;

                        /* Toggle es-selected class */
                        var allOpts = list.querySelectorAll('.es-opt');
                        [].forEach.call(allOpts, function (o) {
                            o.classList.remove('es-selected');
                        });
                        opt.classList.add('es-selected');

                        /* Show/hide textarea using class */
                        if (ob) {
                            if (selectedVal === 'other') {
                                ob.classList.add('visible');
                                if (ot) ot.focus();
                            } else {
                                ob.classList.remove('visible');
                                if (ot) { ot.value = ''; }
                                if (charCnt) charCnt.textContent = '0';
                            }
                        }
                    });
                }

                /* Character counter */
                if (ot && charCnt) {
                    ot.addEventListener('input', function () {
                        charCnt.textContent = this.value.length;
                    });
                }
            },
            preConfirm: function () {
                if (!selectedVal) {
                    Swal.showValidationMessage('กรุณาเลือกเหตุผลในการยกเลิกก่อน');
                    return false;
                }
                var ot    = document.getElementById('esOT');
                var other = ot ? ot.value.trim() : '';
                if (selectedVal === 'other' && other === '') {
                    Swal.showValidationMessage('กรุณากรอกเหตุผลของคุณด้วย');
                    if (ot) ot.focus();
                    return false;
                }
                return { reason: selectedVal, other: other };
            }
        }).then(function (result) {
            if (result.isConfirmed && result.value) {
                doSubmit(url, result.value.reason, result.value.other);
            }
        });
    });
}());
