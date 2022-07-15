import { defineNuxtConfig } from 'nuxt'


// https://v3.nuxtjs.org/docs/directory-structure/nuxt.config
export default defineNuxtConfig({
  build: {
    transpile: ['@heroicons/vue'],
    postcss: {
      postcssOptions: {
        plugins: {
          tailwindcss: {},
          autoprefixer: {},
        },
      },
    },
  },
  css: [
    "~/assets/css/tailwind.css"
  ],
  app: {
    head: {
      style: [
        // <style type="text/css">:root { color: red }</style>
        { children: 'html { height: 100% } body { height: 100% } ', type: 'text/css' }
      ]
    }
  }
})