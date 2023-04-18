const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

    theme: {
        extend: {
            fontFamily: {
                'poppins': ['Poppins', 'sans-serif']
            },
            spacing:{
                68: '17rem',
                'left-column': '62%',
                'right-column': '37%',
            },
            height: {
                '30': '7.5rem',
            },
            fontSize: {
                xxs: ['0.625rem', {lineHeight: '1rem'}],
                label: ['1.75rem', {lineHeight: '2,15rem'}],
            },
            padding: {
                '1/3': '33.33333%',
                '2/3': '66.66667%',
            },
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('tailwindcss-debug-screens')
    ],
};
