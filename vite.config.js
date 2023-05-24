import { defineConfig } from 'vite';

export default defineConfig({
    root: "js-src",
    assetsInclude: ["./assets/**/*.*"],
    build: {
        emptyOutDir: true,
        outDir: "../js",
        manifest: true,
        rollupOptions: {
            input: {
                main: 'js-src/main.js' // Hier ersetzt du "meineAnwendung.js" durch den Namen deiner Hauptdatei.
            }
        }
    }
})
