import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                display: ['Plus Jakarta Sans', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: '#2563EB',
                secondary: '#38BDF8',
                accent: '#06B6D4',
                success: '#22C55E',
                warning: '#F59E0B',
                danger: '#EF4444',
                background: '#F8FAFC',
                card: '#FFFFFF',
                dark: '#0F172A',
                muted: '#64748B',
                border: '#E2E8F0',
            }
        },
    },

    plugins: [forms, typography],
};
