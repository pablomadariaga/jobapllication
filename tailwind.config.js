const defaultTheme = require("tailwindcss/defaultTheme");

/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: "class",
    content: ["./resources/**/*.blade.php", "./resources/**/*.js"],
    theme: {
        screens: {
            "2xs": "414px",
            xs: "520px",
            sm: "640px",
            md: "768px",
            lg: "1024px",
            xl: "1280px",
            "2xl": "1536px",
        },
        extend: {
            spacing: {
                0.25: "1px",
                2.2: "0.55rem",
                3.25: "0.8rem",
                3.5: "0.875rem",
                4.5: "1.13rem",
                4.75: "1.15rem",
                5.5: "1.38rem",
                6.5: "1.63rem",
                9.5: "2.38rem",
            },
            zIndex: {
                60: "60",
                70: "70",
                80: "80",
            },
            fontFamily: {
                sans: ["Nunito", ...defaultTheme.fontFamily.sans],
            },
            fontSize: {
                "4xs": "0.5rem",
                "3xs": "0.65rem",
                "2xs": ["0.60rem", "1rem"],
                xs: ["0.75rem", "1.125rem"],
                sm: ["0.875rem", "1.25rem"],
                base: ["1rem", "1.5rem"],
                lg: ["1.125rem", "1.75rem"],
                xl: ["1.25rem", "1.75rem"],
                "2xl": ["1.5rem", "2rem"],
            },
            height: {
                110: "460px",
                120: "680px",
                140: "860px",
                "9/12":"75%",
            },
            width: {
                110: "460px",
                120: "680px",
                140: "860px"
            },
            maxWidth: {
                72: "18rem",
                75: "18.75rem",
            },
            transitionProperty: {
                'width': 'width',
            }
        },
    },
    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
    ],
};
