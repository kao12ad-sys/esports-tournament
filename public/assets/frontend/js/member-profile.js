/**
 * Member Profile Edit Toggle
 * External script to bypass CSP inline restrictions
 */
document.addEventListener('DOMContentLoaded', function() {
    var btnEdit = document.getElementById('btn-edit');
    var btnCancel = document.getElementById('btn-cancel');

    if (btnEdit) {
        btnEdit.addEventListener('click', function() {
            var container = document.getElementById('profile-container');
            if (container) {
                container.classList.add('is-editing');
            }

            // Remove readonly from all profile inputs
            var inputs = document.querySelectorAll('.profile-input');
            inputs.forEach(function(input) {
                input.readOnly = false;
                input.removeAttribute('readonly');
            });

            // Update title
            var title = document.getElementById('form-title');
            if (title) title.innerText = 'แก้ไขข้อมูลส่วนตัว';

            // Focus first input
            if (inputs.length > 0) inputs[0].focus();
        });
    }

    if (btnCancel) {
        btnCancel.addEventListener('click', function() {
            if (confirm('ยกเลิกการแก้ไข? ข้อมูลที่กรอกไว้จะไม่ถูกบันทึก')) {
                window.location.reload();
            }
        });
    }
});
