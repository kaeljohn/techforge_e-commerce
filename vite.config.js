import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/liquidglass.css',
                'resources/js/HomePage/Homepage.js'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
