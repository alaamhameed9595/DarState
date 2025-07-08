import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import * as path from 'node:path'; // ✅ use `node:path` for native modules in ESM
import { fileURLToPath } from 'node:url'; // ✅ required in ESM mode

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/js'),
        },
    },
});
