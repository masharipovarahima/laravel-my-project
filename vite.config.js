import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/app.scss',
                'resources/js/app.js',
                'resources/js/ckeditor.js' ,
            ],
            refresh: true,
        }),
    ],
});
