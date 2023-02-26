import {createRouter, createWebHistory} from "vue-router";
import Welcome from "../pages/welcome/Welcome.vue";
import Login from "../pages/auth/Login.vue";
import Register from "../pages/auth/Register.vue";
import NotFound from "../components/NotFound.vue";
import useAuth from "../composables/auth";
import DashboardLayout from "../pages/dashboard/DashboardLayout.vue";
import DashboardIndex from "../pages/dashboard/DashboardIndex.vue";
import LiveOrders from "../pages/orders/LiveOrders.vue";



const {logout} = useAuth()
const auth = (to, from, next) => {
    if (!localStorage.getItem('access_token')) {
        next()
        return
    }
    next('/login')
    return
}

const logoutAndRedirect = async (to, from, next) => {
    await logout()
    next('/login')
}

const routes =[
    {
        path : '/:pathMatch(.*)*',
        name : 'notFound',
        component : NotFound
    },
    {
        path : '',
        name : 'welcome',
        component : Welcome
    },
    {
        path : '/login',
        name : 'login',
        component : Login
    },
    {
        path : '/logout',
        name : 'logout',
        beforeEnter: logoutAndRedirect
    },
    {
        path : '/register',
        name : 'register',
        component : Register
    },
    {
        component: DashboardLayout,
        beforeEnter: auth,
        children: [
            {
                path : '/dashboard',
                name : 'dashboard',
                component : DashboardIndex
            },
            {
                path : '/live-orders',
                name : 'orders.live',
                component : LiveOrders,
                meta: { title: 'Live Orders' }
            },
        ]
    }
]

export default createRouter({
    history: createWebHistory(),
    routes
})
