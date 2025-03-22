import {createApp} from 'vue/dist/vue.esm-bundler'
import Index from "@/components/Index.vue";
import router from "./router.js";
import './bootstrap';

const app = createApp({
    el: '#app',
    components:{
        'index': Index
    }
});

app.use(router)
app.mount('#app')

// import './bootstrap';
// import { createApp } from 'vue/dist/vue.esm-bundler';

// const app = createApp({});

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {

//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);

// });

// app.mount('#app');