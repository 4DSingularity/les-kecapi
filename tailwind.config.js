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
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                // [Opsional] Tambahkan font serif jika mau, misal 'Lora' atau 'Merriweather'
                // serif: ['Lora', ...defaultTheme.fontFamily.serif],
            },
            // [TAMBAHKAN BLOK INI]
            colors: {
                'krem': '#F8F5F2',         // Latar belakang utama
                'coklat-tua': '#4A3728',   // Teks & Judul
                'coklat-muda': '#6B4F4F',  // Teks sekunder
                'terakota': '#C87941',     // Tombol Aksi & Aksen
                'terakota-hover': '#B56D3A', // Hover untuk tombol
            }
        },
    },

    plugins: [forms],
};
