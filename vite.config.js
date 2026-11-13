import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            fonts: [
                bunny('Press Start 2P', {
                    weights: [400],
                    optimizedFallbacks: false,
                }),
                bunny('Silkscreen', {
                    weights: [400, 700],
                    optimizedFallbacks: false,
                }),
                bunny('Space Mono', {
                    weights: [400, 700],
                    styles: ['normal', 'italic'],
                    optimizedFallbacks: false,
                }),
            ],
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
