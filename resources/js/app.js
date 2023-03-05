import './bootstrap';
import {createApp} from "vue";
import Welcome from "./pages/welcome/Welcome.vue";
import Login from "./pages/auth/Login.vue";
import Register from "./pages/auth/Register.vue";
import DashboardIndex from "./pages/dashboard/DashboardIndex.vue";
import router from "./router";
import VueSweetalert2 from "vue-sweetalert2";


const app = createApp({
    components:{
        Welcome,
        Login,
        Register,
        DashboardIndex,
    }
})
app.use(router)
app.use(VueSweetalert2)
app.mount('#app')

//createApp(Welcome).mount('#app')
