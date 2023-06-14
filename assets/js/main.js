import { createApp } from 'vue/dist/vue.esm-bundler.js'
import Counter from './components/Counter.vue'

const app = createApp({})

app.component('counter', Counter)
app.mount('#app')

console.log('Timber x Vite x Vue');