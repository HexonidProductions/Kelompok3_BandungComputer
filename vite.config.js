import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/home.css',
                'resources/css/about.css',
                'resources/css/contact.css',
                'resources/css/produk.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
