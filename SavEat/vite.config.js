import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/5-star-rating.css',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
    server: {
        host: '127.0.0.1',
        port: 5173
    }
});
