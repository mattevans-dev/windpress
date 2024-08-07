/** @type {import('tailwindcss').Config} */
const colors = require("tailwindcss/colors");
const defaultTheme = require("tailwindcss/defaultTheme");

// By default, the 2xl container feels too wide. Remove the below 2 lines if you want to keep it.
let containerScreens = Object.assign({}, defaultTheme.screens);
delete containerScreens["2xl"];

module.exports = {
  content: ["**/*.php"],
  theme: {
    spacing: {
      ...defaultTheme.spacing,
      "block-xs": defaultTheme.spacing["6"],
      "block-sm": defaultTheme.spacing["12"], // default block mobile spacing
      "block-md": defaultTheme.spacing["24"], // default tablet =< spacing
      "block-lg": defaultTheme.spacing["40"],
      "block-xl": defaultTheme.spacing["56"],
      "block-2xl": defaultTheme.spacing["80"]
    },
    colors: {
      ...colors,
      gray: colors.zinc
    },
    extend: {
      container: {
        screens: containerScreens,
        center: true,
        padding: "2rem"
      },
      typography: {
        DEFAULT: {
          css: {
            // overrides default max width of prose
            maxWidth: "none",
            fontSize: "1.25rem",
            lineHeight: "1.5em",
            // adds padding top to .prose if not a block element
            ".prose:has(>*:not(section):not(div):first-child)": {
              paddingTop: defaultTheme.spacing["16"]
            }
          }
        }
      }
    }
  },
  plugins: [require("@tailwindcss/typography"), require("tailwindcss-animate")]
};
