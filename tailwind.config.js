const defaultTheme = require("tailwindcss/defaultTheme");
const colors = require("tailwindcss/colors");

module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                transparent: "transparent",
                current: "currentColor",
                black: colors.black,
                white: colors.white,
                gray: colors.gray,
                emerald: colors.emerald,
                indigo: colors.indigo,
                yellow: colors.yellow,
                "dark": "#808189",
                "dark-black": "#010414",
                "link": "#2029F3",
                "success": "#0FBA68",
                "hover-success": "#0da75c",
                "brand-primary": "#2029F3",
                "brand-secondary": "#0FBA68",
                "brand-tertiary": "#EAD621",
            },
            spacing: {
                75: "24.5rem",
            },
            maxWidth: {
                "xss": "16rem",
            },
            opacity: {
                7: "0.08",
            },
            borderRadius: {
                4: "0.25rem",
            },
        },
    },
    plugins: [require("@tailwindcss/forms")],
};
