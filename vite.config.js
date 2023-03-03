import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  server: {
    host: 'laura-broekaert.test',
    hmr: 'laura-broekaert.test',
    https: {
      key: 'C:/laragon/etc/ssl/laragon.key',
      cert: 'C:/laragon/etc/ssl/laragon.crt',
    },
  },
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',
        'resources/css/nova-tailwind-colors.css',
        'resources/js/app.js'
      ],
      refresh: true,
    }),
  ],
});
