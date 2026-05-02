;(function () {
  try {
    if (!window.localStorage) return;

    var ACTIVE_KEY = "smart_active_template";
    var DEFAULT_THEME = "light";
    var DEFAULT_DIR = "ltr";

    var activeStr = localStorage.getItem(ACTIVE_KEY);
    var active = null;
    if (activeStr) {
      try {
        active = JSON.parse(activeStr);
      } catch (e) {
        active = null;
      }
    }

    var theme = (active && active.theme) || DEFAULT_THEME;
    var direction = (active && active.direction) || DEFAULT_DIR;

    var html = document.documentElement;
    html.setAttribute("dir", direction === "rtl" ? "rtl" : "ltr");

    var applied = false;
    function applyBodyClasses() {
      if (applied) return;
      var body = document.body;
      if (!body) return;

      var removeClasses = [
        "header-white",
        "header-dark",
        "header-blue",
        "header-indigo",
        "header-red",
        "header-cyan",
        "header-green",
        "white-sidebar-color",
        "dark-sidebar-color",
        "blue-sidebar-color",
        "indigo-sidebar-color",
        "green-sidebar-color",
        "red-sidebar-color",
        "cyan-sidebar-color",
        "logo-white",
        "logo-dark",
        "logo-blue",
        "logo-indigo",
        "logo-red",
        "logo-cyan",
        "logo-green",
        "rtl",
        "sidemenu-container-reversed",
        "dark-theme",
      ];

      for (var i = 0; i < removeClasses.length; i++) {
        body.classList.remove(removeClasses[i]);
      }

      if (direction === "rtl") {
        body.classList.add("rtl", "sidemenu-container-reversed");
      }

      if (theme === "dark") {
        body.classList.add(
          "dark-theme",
          "header-dark",
          "dark-sidebar-color",
          "logo-dark",
        );
      } else {
        body.classList.add(
          "header-white",
          "white-sidebar-color",
          "logo-white",
        );
      }

      applied = true;
    }

    if (document.readyState === "loading") {
      var interval = setInterval(function () {
        if (document.body) {
          applyBodyClasses();
          clearInterval(interval);
        }
      }, 0);
      document.addEventListener("DOMContentLoaded", function () {
        applyBodyClasses();
        clearInterval(interval);
      });
    } else {
      applyBodyClasses();
    }
  } catch (e) {}
})();
