/** @type {import("tailwindcss").Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  corePlugins: {
    container: false,
  },
  theme: {
    container: ({ theme }) => ({
      center: true,
      padding: theme("spacing.20"),
    }),
    boxShadow: {
      DEFAULT: "0px 3px 6px rgba(0, 0, 0, 0.16)",
      lg: "0px 6px 12px rgba(0, 0, 0, 0.32)",
    },
    borderRadius: {
      none: "0px",
      sm: "0.938rem",
      DEFAULT: "1.875rem",
      lg: "2.5rem",
      full: "9999px",
    },
    colors: {
      transparent: "transparent",
      current: "currentColor",
      primary: {
        light: "#FFB976",
        DEFAULT: "#FF9F43",
        dark: "#FF8510",
      },
      success: {
        light: "#60C6A3",
        DEFAULT: "#40B38B",
        dark: "#338D6E",
      },
      danger: {
        light: "#FF8569",
        DEFAULT: "#FF5C36",
        dark: "#FF3303",
      },
      white: "#f8fafc",
      black: "#0f172a",
      gray: {
        light: "#f1f5f9",
        DEFAULT: "#d4d4d4",
        dark: "#737373",
      },
    },
    spacing: {
      0: "0rem",
      1: "0.063rem",
      2: "0.125rem",
      3: "0.188rem",
      4: "0.25rem",
      5: "0.313rem",
      10: "0.625rem",
      15: "0.938rem",
      20: "1.25rem",
      25: "1.563rem",
      30: "1.875rem",
      35: "2.188rem",
      40: "2.5rem",
      45: "2.813rem",
      50: "3.125rem",
      55: "3.438rem",
      60: "3.75rem",
      65: "4.063rem",
      70: "4.375rem",
      75: "4.688rem",
      80: "5rem",
      85: "5.313rem",
      90: "5.625rem",
      95: "5.938rem",
      100: "6.25rem",
    },
    fontFamily: {
      'sans': ['Inter', 'sans-serif'],
    },
    fontSize: {
      sm: "0.875rem",
      base: "1rem",
      lg: "1.125rem",
      h4: "1.25rem",
      h3: "1.5rem",
      h2: "1.875rem",
      h1: "2.4rem",
    },
    aspectRatio: {
      none: 0,
      square: "1 / 1",
      "1/1": "1 / 1",
      "16/9": "16 / 9",
      "4/3": "4 / 3",
      '9/16': "9 / 16",
      '3/4': "3 / 4",
    },
    transitionDuration: {
      DEFAULT: '300ms',
    },
    extend: {
      screens: {
        "betterhover": { "raw": "(hover: hover)" },
      },
      spacing: {
        gap: "1.25rem",
      },
    },
  },
  plugins: [
    require('tailwindcss-rfs'),
    require('tailwind-bootstrap-grid')({
      containerMaxWidths: { sm: '540px', md: '720px', lg: '960px', xl: '1140px' },
    }),
  ],
}
