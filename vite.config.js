import {
    defineConfig
} from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
        require('flowbite/plugin'),
        require('flowbite-typography'),
    ],
    server: {
        cors: true,
    },
    content: [
    "./resources/views/welcome.blade.php",
    "./node_modules/flowbite/**/*.js"
  ],
});