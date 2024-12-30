import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
const colors = require('tailwindcss/colors')

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'primary-blue': '#305CDE',
                'primary-blue-light': '#4A6EE5',
                'primary-blue-dark': '#274AB3',
                'primary-blue-darker': '#1E3D9A',
                'primary-blue-lightest': '#6C84F0',
                'gray-primary': '#66676E',
                'gray-primary-light': '#8A8B91',
                'gray-primary-lighter': '#B0B1B5',
                'gray-primary-dark': '#44454A',
                'gray-primary-darker': '#252629',
                'gray-primary-lightest': '#D8D9DB',
                'star-yellow': '#FFC700'
            },
        },
    },
    plugins: [forms],
};
