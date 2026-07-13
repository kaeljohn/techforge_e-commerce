import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/liquidglass.css',
                'resources/js/app.js',
                'resources/js/bootstrap.js',
                'resources/js/Category/Category.js',
                'resources/js/Common/AmbientEffects.js',
                'resources/js/Common/Preloader.js',
                'resources/js/Common/TailwindConfig.js',
                'resources/js/HomePage/Homepage.js',
                'resources/js/Pages/BuildOverview/BuildOverview.js',
                'resources/js/Pages/BuildPc/BuildPc.js',
                'resources/js/Pages/Configurator/Configurator.js',
                'resources/js/Pages/Search/Search.js'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
