import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/css/style.css ', 'resources/css/task.css', 'resources/css/tasktwo.css', 'resources/css/project.css', 'resources/css/reportsu.css', 'resources/css/dashboardthree.css', 'resoueces/css/aplikasi.css',
                'resources/js/app.js', 'resources/js/task.js', 'resources/js/tasktwo.js', 'resources/js/dashboard.js', 'resources/js/project.js', 'resources/js/reportsu.js', 'resources/js/dashboardthree.js', 'resources/js/aplikasi.js'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});