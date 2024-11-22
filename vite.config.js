import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import stylin from '@stylin/vite-plugin'
import * as path from 'path';


export default defineConfig({
    root:'public_html',
    plugins: [
        viteStaticCopy({
            targets: [
              {
                src: 'bin/example.wasm',
                dest: 'wasm-files'
              }
            ]
          }),
        laravel({
            input: [
                'resources/css/app.css',
                '/data/www/projects/laravel-crm-package/resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});

