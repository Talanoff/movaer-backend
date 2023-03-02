const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Montserrat', ...defaultTheme.fontFamily.sans],
            },
            container: {
                center: true,
                padding: {
                    DEFAULT: '0.625rem',
                    md: '1.15rem'
                }
            }
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
