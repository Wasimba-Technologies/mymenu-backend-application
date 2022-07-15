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
  ]
})