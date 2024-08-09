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
            colors: {
                primary: '#007bff',
                'primary-hover': '#0062cc',
                'primary-disabled': '#58a8ff',
                secondary: '#6c757d',
                'secondary-hover': '#5a6268',
                'secondary-disabled': '#9fa4aa',
                success: '#28a745',
                'success-hover': '#218838',
                'success-disabled': '#72c585',
                danger: '#dc3545',
                'danger-hover': '#c82333',
                'danger-disabled': '#e87b85',
                warning: '#ffc107',
                'warning-hover': '#e0a800',
                'warning-disabled': '#ffd65d',
                info: '#17a2b8',
                'info-hover': '#117a8b',
                'info-disabled': '#67c2d0',
                light: '#f8f9fa',
                'light-hover': '#e2e6ea',
                'light-disabled': '#fafbfb',
                dark: '#343a40',
                'dark-hover': '#23272b',
                'dark-disabled': '#7a7e82',
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
