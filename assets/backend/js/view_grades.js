// Filter grades
function filterGrades() {
    alert('Filtering grades...');
    // In real application, this would fetch filtered data from server
}

// Reset filters
function resetFilters() {
    document.getElementById('filterYear').value = '';
    document.getElementById('filterSemester').value = '';
    document.getElementById('filterCourse').value = '';
    document.getElementById('filterStudent').value = '';
}

// Export grades
function exportGrades() {
    alert('Exporting grades to Excel...');
}

// Print grades
function printGrades() {
    window.print();
}

// Edit grades for a student
function editGrades(rollNo) {
    window.location.href = 'enter_grades.html?rollNo=' + rollNo;
}

// Initialize DataTable
$(document).ready(function() {
    $('#gradesViewTable').DataTable({
        "pageLength": 10,
        "order": [[1, "asc"]]
    });
});