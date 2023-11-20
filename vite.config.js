import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import checker from 'vite-plugin-checker';
import react from '@vitejs/plugin-react';

export default defineConfig({
  plugins: [
    laravel([
      'resources/css/app.css',
      'resources/js/app.ts',
      'resources/react/src/main.tsx',
    ]),
    checker({ typescript: true }),
    react(),
  ],
});
