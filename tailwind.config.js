import forms from '@tailwindcss/forms';
import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            screens: {
                mxs: { max: '369.98px' },
                msm: { max: '639.98px' },
                mmd: { max: '767.98px' },
                mlg: { max: '1023.98px' },
                mxl: { max: '1279.98px' },
                m2xl: { max: '1535.98px' },

                xs: { min: '370px' },
                sm: { min: '640px' },
                md: { min: '768px' },
                lg: { min: '1024px' },
                xl: { min: '1280px' },
                '2xl': { min: '1536px' },
            },
        },
        container: {
            center: true,
            padding: '1rem',
            screens: {
                sm: '640px',
                md: '768px',
                lg: '1024px',
                xl: '1280px',
            },
        },
    },

    plugins: [forms],
};
