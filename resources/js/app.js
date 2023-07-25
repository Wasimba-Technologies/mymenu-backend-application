import './bootstrap';
import {createApp, inject} from "vue";
import router from "./router";
import VueSweetalert2 from "vue-sweetalert2";
import { abilitiesPlugin } from '@casl/vue';
import ability from './services/ability';
import Layout from "./layouts/Layout.vue";

const app = createApp(Layout)
app.use(router)
app.use(VueSweetalert2)
app.use(abilitiesPlugin, ability,{
    useGlobalProperties: true
})
app.mount('#app')


