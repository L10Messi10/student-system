document.addEventListener("DOMContentLoaded", function () {
  // Sidebar toggle
  const sidebarCollapse = document.getElementById("sidebarCollapse");
  const sidebar = document.getElementById("sidebar");
  const content = document.querySelector(".content");

  if (sidebarCollapse) {
    sidebarCollapse.addEventListener("click", function () {
      sidebar.classList.toggle("active");
      content.classList.toggle("active");
    });
  }

  // Auto-hide alerts after 5 seconds
  const alerts = document.querySelectorAll(".alert");
  alerts.forEach(function (alert) {
    setTimeout(function () {
      alert.style.transition = "opacity 0.5s";
      alert.style.opacity = "0";
      setTimeout(function () {
        alert.remove();
      }, 500);
    }, 5000);
  });

  // Confirm delete
  const deleteButtons = document.querySelectorAll(".btn-delete");
  deleteButtons.forEach(function (button) {
    button.addEventListener("click", function (e) {
      if (!confirm("Are you sure you want to delete this student?")) {
        e.preventDefault();
      }
    });
  });
});
