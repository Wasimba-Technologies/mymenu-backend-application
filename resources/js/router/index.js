import {createRouter, createWebHistory} from "vue-router";
import Welcome from "../pages/welcome/Welcome.vue";
import Login from "../pages/auth/Login.vue";
import Register from "../pages/auth/Register.vue";
import NotFound from "../components/NotFound.vue";
import useAuth from "../composables/auth";
import DashboardLayout from "../pages/dashboard/DashboardLayout.vue";
import DashboardIndex from "../pages/dashboard/DashboardIndex.vue";
import LiveOrders from "../pages/orders/LiveOrders.vue";
import RestaurantCreate from "../pages/restaurants/RestaurantCreate.vue";
import MenuCreate from "../pages/menus/MenuCreate.vue";
import MenuIndex from "../pages/menus/MenuIndex.vue";
import MenuItemCreate from "../pages/menu_items/MenuItemCreate.vue";
import MenuItemIndex from "../pages/menu_items/MenuItemIndex.vue";



const {logout} = useAuth()
const auth = (to, from, next) => {
    if (localStorage.getItem('access_token')) {
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
        path : '/register-restaurant',
        name : 'restaurant.create',
        component : RestaurantCreate,
        beforeEnter: auth
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
            {
                path : '/menu',
                name : 'menu.index',
                component : MenuIndex,
                meta: { title: 'List of Menus' }
            },
            {
                path : '/menu/create',
                name : 'menu.create',
                component : MenuCreate,
                meta: { title: 'Create Menu' }
            },
            {
                path : '/menu-items',
                name : 'menu_items.index',
                component : MenuItemIndex,
                meta: { title: 'List of Menu Items' }
            },
            {
                path : '/menu-items/create',
                name : 'menu_items.create',
                component : MenuItemCreate,
                meta: { title: 'Create Menu Items' }
            },
        ]
    }
]

export default createRouter({
    history: createWebHistory(),
    routes
})
