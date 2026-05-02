(function () {
  var DEFAULT_TEMPLATE_KEY = "ltr-light";

  window.SmartConfig = {
    theme: "light",
    direction: "rtl",
    headerColor: "header-white",
    logoColor: "logo-white",
    sidebarColor: "white-sidebar-color",
  };

  var templateConfigs = {
    "ltr-light": {
      theme: "light", // Theme Mode: "light" or "dark"
      direction: "ltr", // Layout Direction: "ltr" or "rtl"
      headerColor: "header-white", // Header Color: "header-white", "header-dark", "header-blue", "header-indigo", "header-cyan", "header-green", "header-red"
      logoColor: "logo-white", // Logo/Brand Color: "logo-white", "logo-dark", "logo-blue", "logo-indigo", "logo-cyan", "logo-green", "logo-red"
      sidebarColor: "white-sidebar-color", // Sidebar Color: "white", "dark", "blue", "indigo", "cyan", "green", "red"
    },
    "ltr-dark": {
      theme: "dark",
      direction: "ltr",
      headerColor: "header-dark",
      logoColor: "logo-dark",
      sidebarColor: "dark-sidebar-color",
    },
    "rtl-light": {
      theme: "light",
      direction: "rtl",
      headerColor: "header-white",
      logoColor: "logo-white",
      sidebarColor: "white-sidebar-color",
    },
    "rtl-dark": {
      theme: "dark",
      direction: "rtl",
      headerColor: "header-dark",
      logoColor: "logo-dark",
      sidebarColor: "dark-sidebar-color",
    },
  };

  window.ThemeStorage = {
    ACTIVE_TEMPLATE_KEY: "smart_active_template",
    getTemplateKey: function (theme, direction) {
      return "smart_theme_" + direction + "_" + theme;
    },

    getActiveTemplate: function () {
      var active = sessionStorage.getItem(this.ACTIVE_TEMPLATE_KEY);
      if (active) {
        try {
          return JSON.parse(active);
        } catch (e) {
          return null;
        }
      }
      return null;
    },

    setActiveTemplate: function (theme, direction) {
      var templateData = {
        theme: theme,
        direction: direction,
      };
      sessionStorage.setItem(
        this.ACTIVE_TEMPLATE_KEY,
        JSON.stringify(templateData),
      );
    },

    getSavedConfig: function () {
      var activeTemplate = this.getActiveTemplate();
      var defaultLight = templateConfigs[DEFAULT_TEMPLATE_KEY];
      var theme = activeTemplate ? activeTemplate.theme : defaultLight.theme;
      var direction = activeTemplate
        ? activeTemplate.direction
        : defaultLight.direction;
      var key = this.getTemplateKey(theme, direction);
      var saved = sessionStorage.getItem(key);
      if (saved) {
        try {
          return JSON.parse(saved);
        } catch (e) {
          return null;
        }
      }
      return null;
    },

    saveConfig: function () {
      var theme = window.SmartConfig.theme;
      var direction = window.SmartConfig.direction;

      this.setActiveTemplate(theme, direction);

      var key = this.getTemplateKey(theme, direction);
      var configToSave = {
        theme: window.SmartConfig.theme,
        direction: window.SmartConfig.direction,
        headerColor: window.SmartConfig.headerColor,
        logoColor: window.SmartConfig.logoColor,
        sidebarColor: window.SmartConfig.sidebarColor,
      };
      sessionStorage.setItem(key, JSON.stringify(configToSave));
    },

    init: function () {
      var activeTemplate = this.getActiveTemplate();
      var defaultLight = templateConfigs[DEFAULT_TEMPLATE_KEY];
      var currentTheme, currentDirection;

      if (activeTemplate) {
        currentTheme = activeTemplate.theme;
        currentDirection = activeTemplate.direction;
      } else {
        currentTheme = defaultLight.theme;
        currentDirection = defaultLight.direction;
        this.setActiveTemplate(currentTheme, currentDirection);
      }

      var key = this.getTemplateKey(currentTheme, currentDirection);
      var savedConfig = sessionStorage.getItem(key);

      if (savedConfig) {
        try {
          var parsed = JSON.parse(savedConfig);
          window.SmartConfig.theme = parsed.theme || defaultLight.theme;
          window.SmartConfig.direction =
            parsed.direction || defaultLight.direction;
          window.SmartConfig.headerColor =
            parsed.headerColor || defaultLight.headerColor;
          window.SmartConfig.logoColor =
            parsed.logoColor || defaultLight.logoColor;
          window.SmartConfig.sidebarColor =
            parsed.sidebarColor || defaultLight.sidebarColor;
        } catch (e) {
          this.applyDefaultConfig(currentTheme, currentDirection);
        }
      } else {
        this.applyDefaultConfig(currentTheme, currentDirection);
        this.saveConfig();
      }
    },

    applyDefaultConfig: function (theme, direction) {
      var templateKey = direction + "-" + theme;
      var defaultVals =
        templateConfigs[templateKey] || templateConfigs[DEFAULT_TEMPLATE_KEY];
      window.SmartConfig.theme = defaultVals.theme;
      window.SmartConfig.direction = defaultVals.direction;
      window.SmartConfig.headerColor = defaultVals.headerColor;
      window.SmartConfig.logoColor = defaultVals.logoColor;
      window.SmartConfig.sidebarColor = defaultVals.sidebarColor;
    },

    getAllTemplateConfigs: function () {
      return templateConfigs;
    },
  };

  window.ThemeStorage.init();
})();
