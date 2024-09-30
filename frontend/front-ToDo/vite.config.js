import { fileURLToPath, URL } from 'node:url';
import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import vueDevTools from 'vite-plugin-vue-devtools';

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [
    vue(),
    vueDevTools(),
  ],
  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./src', import.meta.url)),
    },
  },
  server: {
    host: '0.0.0.0', // Escuta em todas as interfaces de rede
    port: 5173, // Opcional, caso deseje garantir a porta
    proxy: {
      '/api': {
        target: 'http://127.0.0.1:8000', // URL da sua API Laravel
        changeOrigin: true,
        rewrite: (path) => path.replace(/^\/api/, ''), // Remove /api do início do caminho
      },
    },
  },
});
