import { createApp } from 'vue'
import Cookies from './components/Cookies.vue'

const app = createApp({})
app.component('cookies-consent', Cookies)
// ... rest of your app configuration ...

app.mount('#app') 