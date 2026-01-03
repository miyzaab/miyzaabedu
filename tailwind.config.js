const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');

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
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                serif: ['Amiri', ...defaultTheme.fontFamily.serif],
                arabic: ['Amiri', 'serif'],
            },
            colors: {
                primary: colors.emerald,
                secondary: colors.slate,
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
