import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                "blue-primary": "#1FA1E9",
                "blue-sky": "#41C9E2",
                "blue-light": "#ACE2E1",
                "blue-lighter": "#F3FAFB",
                "blue-dark": "#177AAF",
            },
            screens: {
                'xs': '400px'
            }
        },
    },

    plugins: [forms, typography],
};
