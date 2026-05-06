(function () {
    'use strict';

    /* Read data passed from PHP via a hidden data-element */
    var dataEl      = document.getElementById('esCancelData');
    var REASONS     = dataEl ? JSON.parse(dataEl.dataset.reasons) : [];
    var CSRF_NAME   = dataEl ? dataEl.dataset.csrfName  : 'csrf_token';
    var CSRF_HASH   = dataEl ? dataEl.dataset.csrfHash  : '';

    function esc(s) {
        return String(s)
            .replace(/&/g,'&amp;')
            .replace(/</g,'&lt;')
            .replace(/>/g,'&gt;')
            .replace(/"/g,'&quot;');
    }

    function buildHtml(name) {
        var rows = REASONS.map(function (r) {
            return '<div class="swal2-reason-option" data-val="' + esc(r) + '">'
                 + '<i class="fas fa-circle-dot"></i><span>' + esc(r) + '</span></div>';
        }).join('');

        rows += '<div class="swal2-reason-option" data-val="other">'
              + '<i class="fas fa-pen"></i><span>เหตุผลอื่นๆ (โปรดระบุ)</span></div>';

        return '<p style="font-size:13px;color:var(--es-muted,#96a2b4);margin-bottom:14px;">'
             + 'กรุณาระบุเหตุผลในการยกเลิก<br>'
             + '<strong style="color:var(--es-text,#f5f7fb);">' + esc(name) + '</strong></p>'
             + '<div class="swal2-cancel-reasons" id="esSwalReasons">' + rows + '</div>'
             + '<div class="swal2-other-box" id="esSwalOtherBox" style="display:none;">'
             +   '<textarea id="esSwalOtherTxt" rows="3" maxlength="500"'
             +   ' placeholder="กรอกเหตุผลของคุณที่นี่..."></textarea>'
             +   '<div class="swal2-char-count"><span id="esSwalCharCnt">0</span>/500</div>'
             + '</div>'
             + '<div class="swal2-cancel-warning">'
             +   '<i class="fas fa-triangle-exclamation"></i>'
             +   '<span>การยกเลิกจะลบข้อมูลการสมัครออกจากระบบ และไม่สามารถกู้คืนได้</span>'
             + '</div>';
    }

    /* Submit via a dynamically created form (no hidden form needed in view) */
    function doSubmit(url, reason, other) {
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = url;
        form.style.display = 'none';

        function addField(n, v) {
            var el = document.createElement('input');
            el.type  = 'hidden';
            el.name  = n;
            el.value = v;
            form.appendChild(el);
        }

        addField(CSRF_NAME, CSRF_HASH);
        addField('cancel_reason',       reason);
        addField('cancel_reason_other', other);

        document.body.appendChild(form);
        form.submit();
    }

    /* Click delegation — works even if buttons are added later */
    document.addEventListener('click', function (e) {
        var btn = e.target.closest('.btn-cancel-reg');
        if (!btn) return;

        var name = btn.dataset.name;
        var url  = btn.dataset.url;
        var selectedVal = null;

        Swal.fire({
            customClass: { popup: 'es-cancel-popup' },
            title: '<i class="fas fa-exclamation-triangle" style="color:#ff5470;margin-right:8px;"></i>'
                 + 'ยกเลิกการสมัครแข่งขัน',
            html: buildHtml(name),
            showCancelButton: true,
            confirmButtonText: '<i class="fas fa-trash-can"></i>&nbsp;ยืนยันการยกเลิก',
            cancelButtonText:  '<i class="fas fa-arrow-left"></i>&nbsp;ย้อนกลับ',
            reverseButtons: true,
            width: 520,
            didOpen: function () {
                var list     = document.getElementById('esSwalReasons');
                var otherBox = document.getElementById('esSwalOtherBox');
                var textarea = document.getElementById('esSwalOtherTxt');
                var charCnt  = document.getElementById('esSwalCharCnt');

                list.addEventListener('click', function (ev) {
                    var opt = ev.target.closest('.swal2-reason-option');
                    if (!opt) return;

                    list.querySelectorAll('.swal2-reason-option').forEach(function (o) {
                        o.classList.remove('selected');
                    });
                    opt.classList.add('selected');
                    selectedVal = opt.dataset.val;

                    if (selectedVal === 'other') {
                        otherBox.style.display = 'block';
                        textarea.focus();
                    } else {
                        otherBox.style.display = 'none';
                        textarea.value = '';
                        charCnt.textContent = '0';
                    }
                });

                textarea.addEventListener('input', function () {
                    charCnt.textContent = this.value.length;
                });
            },
            preConfirm: function () {
                if (!selectedVal) {
                    Swal.showValidationMessage('กรุณาเลือกเหตุผลในการยกเลิกก่อน');
                    return false;
                }
                var txt   = document.getElementById('esSwalOtherTxt');
                var other = txt ? txt.value.trim() : '';
                if (selectedVal === 'other' && other === '') {
                    Swal.showValidationMessage('กรุณากรอกเหตุผลของคุณด้วย');
                    if (txt) txt.focus();
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
