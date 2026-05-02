/**
 *  Document   : theme-color.js
 *  Author     : redstar
 *  Description: Core script to handle the entire theme and core functions
 *
 * **/

(function () {
  if (!window.SmartConfig) {
    var script = document.createElement("script");
    script.src = "assets/js/config.js";
    script.onload = function () {
      initThemeColor();
    };
    document.head.appendChild(script);
  } else {
    initThemeColor();
  }

  function initThemeColor() {
    jQuery(document).ready(function () {
      function ensureLoader() {
        var $loader = jQuery("#pageLoader");
        if ($loader.length === 0) {
          $loader = jQuery('<div id="pageLoader" class="page-loader"><div class="spinner"></div></div>');
          jQuery("body").append($loader);
        }
        return $loader;
      }
      function showLoader() {
        ensureLoader().addClass("show");
      }
      function hideLoader() {
        jQuery("#pageLoader").removeClass("show");
      }
      function applyStoredConfig() {
        if (!window.SmartConfig) return;

        var $body = jQuery("body");
        var $html = jQuery("html");

        if (window.SmartConfig.theme === "dark") {
          $body.addClass("dark-theme");
        } else {
          $body.removeClass("dark-theme");
        }

        if (window.SmartConfig.direction === "rtl") {
          $html.attr("dir", "rtl");
          $body.addClass("rtl");
          $body.addClass("sidemenu-container-reversed");

          if (jQuery('link[data-theme-link="material-rtl"]').length === 0) {
            jQuery("head").append(
              '<link rel="stylesheet" href="assets/plugins/material/material.rtl.min.css" data-theme-link="material-rtl">',
            );
          }
          if (jQuery('link[data-theme-link="rtl-extra"]').length === 0) {
            jQuery("head").append(
              '<link rel="stylesheet" href="assets/css/theme/rtl/rtl.css" data-theme-link="rtl-extra">',
            );
          }
        } else {
          $html.attr("dir", "ltr");
          $body.removeClass("rtl");
          $body.removeClass("sidemenu-container-reversed");
        }

        var headerClasses = [
          "header-white",
          "header-dark",
          "header-blue",
          "header-indigo",
          "header-red",
          "header-cyan",
          "header-green",
        ];
        $body.removeClass(headerClasses.join(" "));
        $body.addClass(window.SmartConfig.headerColor || "header-white");

        var sidebarClasses = [
          "white-sidebar-color",
          "dark-sidebar-color",
          "blue-sidebar-color",
          "indigo-sidebar-color",
          "green-sidebar-color",
          "red-sidebar-color",
          "cyan-sidebar-color",
        ];
        $body.removeClass(sidebarClasses.join(" "));
        $body.addClass(window.SmartConfig.sidebarColor || "white-sidebar-color");

        var logoClasses = [
          "logo-white",
          "logo-dark",
          "logo-blue",
          "logo-indigo",
          "logo-red",
          "logo-cyan",
          "logo-green",
        ];
        $body.removeClass(logoClasses.join(" "));
        $body.addClass(window.SmartConfig.logoColor || "logo-white");
      }

  applyStoredConfig();

  function syncLogoWithHeader() {
    var $body = jQuery("body");
    var headerClass = "";
    var headerClasses = [
      "header-white",
      "header-dark",
      "header-blue",
      "header-indigo",
      "header-red",
      "header-cyan",
      "header-green",
    ];
    for (var i = 0; i < headerClasses.length; i++) {
      if ($body.hasClass(headerClasses[i])) {
        headerClass = headerClasses[i];
        break;
      }
    }
    if (!headerClass) {
      return;
    }
    var logoClass = headerClass.replace("header-", "logo-");
    $body
      .removeClass(
        "logo-white logo-dark logo-blue logo-indigo logo-red logo-cyan logo-green",
      )
      .addClass(logoClass);
    if (window.SmartConfig) {
      window.SmartConfig.logoColor = logoClass;
      window.SmartConfig.headerColor = headerClass;
      if (window.ThemeStorage) {
        window.ThemeStorage.saveConfig();
      }
    }
  }
  // Sidebar color
  jQuery(document).on("click", ".sidebar-theme a", function (e) {
    e.preventDefault();
    var theme = jQuery(this).attr("data-theme");
    var sidebar_color = theme + "-sidebar-color";
    jQuery("body").removeClass(
      "white-sidebar-color dark-sidebar-color blue-sidebar-color indigo-sidebar-color green-sidebar-color red-sidebar-color cyan-sidebar-color",
    );
    jQuery("body").addClass(sidebar_color);

    if (window.SmartConfig) {
      window.SmartConfig.sidebarColor = sidebar_color;
      if (window.ThemeStorage) {
        window.ThemeStorage.saveConfig();
      }
    }

    jQuery(".sidebar-theme .color-dot").removeClass("active");
    jQuery(this).addClass("active");
  });

  // Header color
  jQuery(document).on("click", ".header-theme a", function (e) {
    e.preventDefault();
    var theme = jQuery(this).attr("data-theme");
    jQuery("body").removeClass(
      "header-white header-dark header-blue header-indigo header-red header-cyan header-green",
    );
    jQuery("body").addClass(theme);
    // keep logo color in sync with header color
    syncLogoWithHeader();

    if (window.SmartConfig) {
      window.SmartConfig.headerColor = theme;
      if (window.ThemeStorage) {
        window.ThemeStorage.saveConfig();
      }
    }

    jQuery(".header-theme .color-dot").removeClass("active");
    jQuery(this).addClass("active");
  });

  // Theme Mode Toggle (Light/Dark)
  jQuery(document).on("change", "input[name='themeMode']", function () {
    var theme = jQuery(this).val();

    if (!window.SmartConfig) {
      window.SmartConfig = {};
    }

    var direction = window.SmartConfig.direction || "ltr";

    showLoader();
    if (theme === "dark") {
      jQuery("body").addClass("dark-theme");
      
      jQuery("body").removeClass("header-white header-dark header-blue header-indigo header-red header-cyan header-green");
      jQuery("body").addClass("header-dark");
      
      jQuery("body").removeClass("white-sidebar-color dark-sidebar-color blue-sidebar-color indigo-sidebar-color green-sidebar-color red-sidebar-color cyan-sidebar-color");
      jQuery("body").addClass("dark-sidebar-color");
      
      jQuery("body").removeClass("logo-white logo-dark logo-blue logo-indigo logo-red logo-cyan logo-green");
      jQuery("body").addClass("logo-dark");

      window.SmartConfig.theme = "dark";
      window.SmartConfig.direction = direction;
      window.SmartConfig.headerColor = "header-dark";
      window.SmartConfig.logoColor = "logo-dark";
      window.SmartConfig.sidebarColor = "dark-sidebar-color";
    } else {
      jQuery("body").removeClass("dark-theme");
      
      jQuery("body").removeClass("header-white header-dark header-blue header-indigo header-red header-cyan header-green");
      jQuery("body").addClass("header-white");
      
      jQuery("body").removeClass("white-sidebar-color dark-sidebar-color blue-sidebar-color indigo-sidebar-color green-sidebar-color red-sidebar-color cyan-sidebar-color");
      jQuery("body").addClass("white-sidebar-color");
      
      jQuery("body").removeClass("logo-white logo-dark logo-blue logo-indigo logo-red logo-cyan logo-green");
      jQuery("body").addClass("logo-white");

      window.SmartConfig.theme = "light";
      window.SmartConfig.direction = direction;
      window.SmartConfig.headerColor = "header-white";
      window.SmartConfig.logoColor = "logo-white";
      window.SmartConfig.sidebarColor = "white-sidebar-color";
    }

    if (window.ThemeStorage) {
      window.ThemeStorage.saveConfig();
    }

    jQuery(document).trigger("themeChanged", [theme]);
    setTimeout(hideLoader, 200);
  });

  // Layout Direction Toggle (LTR/RTL)
  jQuery(document).on("change", "input[name='layoutDir']", function () {
    var direction = jQuery(this).val();

    // Initialize SmartConfig if not exists
    if (!window.SmartConfig) {
      window.SmartConfig = {};
    }

    // Get current theme
    var currentTheme = window.SmartConfig.theme || "light";

    // Update direction in config
    window.SmartConfig.direction = direction;

    // Apply RTL/LTR using classes
    showLoader();
    if (direction === "rtl") {
      jQuery("html").attr("dir", "rtl");
      jQuery("body").addClass("rtl");
      jQuery("body").addClass("sidemenu-container-reversed");

      // Add RTL CSS if not exists
      if (jQuery('link[data-theme-link="material-rtl"]').length === 0) {
        jQuery("head").append(
          '<link rel="stylesheet" href="assets/plugins/material/material.rtl.min.css" data-theme-link="material-rtl">',
        );
      }
      if (jQuery('link[data-theme-link="rtl-extra"]').length === 0) {
        jQuery("head").append(
          '<link rel="stylesheet" href="assets/css/theme/rtl/rtl.css" data-theme-link="rtl-extra">',
        );
      }
    } else {
      jQuery("html").attr("dir", "ltr");
      jQuery("body").removeClass("rtl");
      jQuery("body").removeClass("sidemenu-container-reversed");

      jQuery('link[data-theme-link="material-rtl"]').remove();
      jQuery('link[data-theme-link="rtl-extra"]').remove();
    }

    if (window.ThemeStorage) {
      window.ThemeStorage.saveConfig();
    }

    // Trigger custom event
    jQuery(document).trigger("directionChanged", [direction]);
    setTimeout(hideLoader, 200);
  });

  jQuery(document).on("click", "a", function (e) {
    var $a = jQuery(this);
    var href = $a.attr("href") || "";
    var target = $a.attr("target") || "";
    if (
      href &&
      href.indexOf("javascript:") !== 0 &&
      href.indexOf("mailto:") !== 0 &&
      href.charAt(0) !== "#" &&
      /\.html(\?|#|$)/i.test(href) &&
      !target
    ) {
      e.preventDefault();
      showLoader();
      setTimeout(function () {
        window.location.href = href;
      }, 150);
    }
  });

  // Initial sync on load and when theme changes via other modules
  syncLogoWithHeader();
  jQuery(document).on("themeChanged", function () {
    syncLogoWithHeader();
  });
  });
  }
})();
