// Total Students Card (Animated Counter)
$(function () {});
function animateCounter(elementId, target) {
  let current = 0;
  const increment = target / 50;
  const timer = setInterval(() => {
    current += increment;
    if (current >= target) {
      current = target;
      clearInterval(timer);
    }
    document.getElementById(elementId).textContent =
      Math.floor(current).toLocaleString();
  }, 30);
}

document.addEventListener("DOMContentLoaded", function () {
  animateCounter("totalStudents", 4586);
  animateCounter("totalTeachers", 156);
  animateCounter("totalCourses", 103);
  animateCounter("totalFees", 245000);
});
