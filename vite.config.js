import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

export default defineConfig({
  server: {
    host: 'localhost',
  },
  publicDir: 'public',
  build: {
    assetsDir: '',
    emptyOutDir: true,
    manifest: true,
    outDir: `public`,
    rollupOptions: {
      input: ['assets/js/main.js', 'assets/sass/styles.scss'],
    },
  },
  plugins: [
    {
      name: 'twig-reload',
      handleHotUpdate({ file, server }) {
        if (file.endsWith('.twig')) {
          server.ws.send({ type: 'full-reload', path: '*' })
        }
      },
    },
    vue(),
  ],
})
