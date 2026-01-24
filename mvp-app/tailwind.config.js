import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                sakura: {
                    white: '#FFFFFF',
                    cream: '#FFF8F5',
                    lightPink: '#FFF0F5',

                    pink: {
                        DEFAULT: '#F5B8C3',
                        light: '#FFD5E0',
                        medium: '#E6A8B3',
                        soft: '#FFEEF3',
                    },

                    purple: {
                        DEFAULT: '#7B2F8A',
                        light: '#9B4FA5',
                        dark: '#5D1F6A',
                        deep: '#461852',
                    },

                    text: {
                        primary: '#5D1F6A',
                        secondary: '#7B2F8A',
                        tertiary: '#A0A0A0',
                        light: '#FFFFFF',
                        pink: '#E6A8B3',
                    },

                    border: '#F5B8C3',
                    divider: '#FFEEF3',
                    accent: '#7B2F8A',
                }
            },
            fontFamily: {
                // sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                // serif: ['Georgia', 'Hiragino Mincho ProN', 'Yu Mincho', 'serif'],
                sans: ['Noto Sans JP', ...defaultTheme.fontFamily.sans],
                serif: ['Noto Serif JP', 'Hiragino Mincho ProN', 'Yu Mincho', ...defaultTheme.fontFamily.serif],
            },
        },
    },

    plugins: [forms],
};
