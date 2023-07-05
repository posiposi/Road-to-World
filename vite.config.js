import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import checker from 'vite-plugin-checker';

export default defineConfig({
  plugins: [
    laravel([
      'resources/css/app.css',
      'resources/js/app.ts',
    ]),
    checker({ typescript: true }),
  ],
});