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
                'resources/css/login.css',
                'resources/css/overview.css',
                'resources/css/products.css',
                'resources/css/transactions.css',
                'resources/css/categories.css',
                'resources/css/users.css',
                'resources/css/suppliers.css',
                'resources/css/inventory-logs.css',
                'resources/css/daily-closing.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
