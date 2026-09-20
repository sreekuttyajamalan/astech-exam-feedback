import { createApp } from 'vue'
import App from './App.vue'
import router from './router'


import './assets/styles/variables.css'
import './assets/styles/main.css'
import './assets/styles/components.css'
import './assets/styles/pages.css'

createApp(App)
  .use(router)
  .mount('#app')