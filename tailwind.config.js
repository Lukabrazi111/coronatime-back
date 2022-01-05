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
                dark: "#808189",
                link: "#2029F3",
                success: "#0FBA68",
                "hover-success": "#0da75c",
            },
            borderRadius: {
                4: "0.25rem",
            },
        },
    },
    plugins: [require("@tailwindcss/forms")],
};
