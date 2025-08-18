import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/css/style.css ', 'resources/css/task.css', 'resources/css/tasktwo.css',
                'resources/js/app.js', 'resources/js/task.js', 'resources/js/tasktwo.js', 'resources/js/dashboard.js'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});