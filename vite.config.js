import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue'; // Vue.js support
import laravel from 'laravel-vite-plugin'; // Laravel Vite plugin

export default defineConfig({
    plugins: [
        vue(), // Add Vue support
        laravel({
            input: [
                'resources/css/app.css', // Your CSS file
                'resources/js/app.js',   // Your main JS file
            ],
            refresh: true,  // Enables browser refresh when changes are made
        }),
    ],
});
