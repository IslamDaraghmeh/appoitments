// sidebar-behavior.js

document.addEventListener("DOMContentLoaded", function () {
  const sidebar = document.getElementById("sidebar");
  const overlay = document.getElementById("overlay");
  const sidebarToggle = document.getElementById("sidebarToggle");

  if (window.innerWidth <= 991.98) {
    sidebar?.classList.remove("show");
    overlay?.classList.remove("show");
    document.body.classList.remove("sidebar-open");
  }

  sidebarToggle?.addEventListener("click", function () {
    sidebar?.classList.toggle("show");
    overlay?.classList.toggle("show");
    document.body.classList.toggle("sidebar-open");
  });

  overlay?.addEventListener("click", function () {
    sidebar?.classList.remove("show");
    overlay?.classList.remove("show");
    document.body.classList.remove("sidebar-open");
  });

  document.querySelectorAll(".sidebar a").forEach((link) => {
    link.addEventListener("click", function () {
      if (window.innerWidth <= 991.98) {
        sidebar?.classList.remove("show");
        overlay?.classList.remove("show");
        document.body.classList.remove("sidebar-open");
      }
    });
  });

  // Handle modal loading
  $(document).on("click", ".showModalButton", function () {
    $("#modalHeader").text($(this).attr("title"));
    $("#modal").modal("show").find("#modalContent").load($(this).attr("value"));
  });
});
