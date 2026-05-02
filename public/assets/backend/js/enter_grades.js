// Load students based on selected course
function loadStudents() {
    var course = document.getElementById('course').value;
    var semester = document.getElementById('semester').value;
    var assessmentType = document.getElementById('assessmentType').value;
    
    if (!course || !semester || !assessmentType) {
        alert('Please select all required fields');
        return;
    }
    
    document.getElementById('gradeEntrySection').style.display = 'flex';
    updateGradingSummary();
}

// Reset form
function resetForm() {
    document.getElementById('gradeForm').reset();
    document.getElementById('gradeEntrySection').style.display = 'none';
}

// Calculate grade based on marks
function calculateGrade(input) {
    var maxMarks = parseInt(document.getElementById('maxMarks').value) || 100;
    var marks = parseInt(input.value) || 0;
    var percentage = (marks / maxMarks) * 100;
    
    var row = input.closest('tr');
    var percentageCell = row.querySelector('.percentage');
    var gradeCell = row.querySelector('td:nth-child(6) span');
    var gpaCell = row.querySelector('.gpa');
    
    percentageCell.textContent = percentage.toFixed(1) + '%';
    
    var grade, gpa, gradeClass;
    if (percentage >= 90) {
        grade = 'A';
        gpa = 4.0;
        gradeClass = 'grade-A';
    } else if (percentage >= 80) {
        grade = 'B';
        gpa = 3.5;
        gradeClass = 'grade-B';
    } else if (percentage >= 70) {
        grade = 'C';
        gpa = 3.0;
        gradeClass = 'grade-C';
    } else if (percentage >= 60) {
        grade = 'D';
        gpa = 2.0;
        gradeClass = 'grade-D';
    } else {
        grade = 'F';
        gpa = 0.0;
        gradeClass = 'grade-F';
    }
    
    gradeCell.textContent = grade;
    gradeCell.className = 'badge ' + gradeClass;
    gpaCell.textContent = gpa.toFixed(1);
    
    updateGradingSummary();
}

// Fill all grades with a specific grade
function fillAllGrades(grade) {
    var maxMarks = parseInt(document.getElementById('maxMarks').value) || 100;
    var marks, gpa;
    
    switch(grade) {
        case 'A': marks = 92; gpa = 4.0; break;
        case 'B': marks = 85; gpa = 3.5; break;
        case 'C': marks = 75; gpa = 3.0; break;
        case 'D': marks = 65; gpa = 2.0; break;
        case 'F': marks = 50; gpa = 0.0; break;
    }
    
    var inputs = document.querySelectorAll('.marks-input');
    inputs.forEach(function(input) {
        input.value = marks;
        calculateGrade(input);
    });
}

// Update grading summary
function updateGradingSummary() {
    var rows = document.querySelectorAll('#gradesTable tbody tr');
    var countA = 0, countB = 0, countC = 0, countDF = 0;
    var total = 0, highest = 0, lowest = 100;
    
    rows.forEach(function(row) {
        var marks = parseInt(row.querySelector('.marks-input').value) || 0;
        var grade = row.querySelector('td:nth-child(6) span').textContent;
        
        total += marks;
        if (marks > highest) highest = marks;
        if (marks < lowest) lowest = marks;
        
        if (grade === 'A') countA++;
        else if (grade === 'B') countB++;
        else if (grade === 'C') countC++;
        else countDF++;
    });
    
    var average = total / rows.length;
    
    document.getElementById('countA').textContent = countA;
    document.getElementById('countB').textContent = countB;
    document.getElementById('countC').textContent = countC;
    document.getElementById('countDF').textContent = countDF;
    document.getElementById('classAverage').textContent = average.toFixed(1) + '%';
    document.getElementById('highestScore').textContent = highest;
    document.getElementById('lowestScore').textContent = lowest;
}

// Save grades (draft)
function saveGrades() {
    alert('Grades saved as draft successfully!');
}

// Submit grades
function submitGrades() {
    if (confirm('Are you sure you want to submit these grades? This action cannot be undone.')) {
        alert('Grades submitted successfully!');
    }
}

// Export grades to Excel
function exportGrades() {
    alert('Exporting grades to Excel...');
}

// Print grades
function printGrades() {
    window.print();
}

// Initialize DataTable
$(document).ready(function() {
    $('#gradesTable').DataTable({
        "pageLength": 25,
        "ordering": false
    });
});