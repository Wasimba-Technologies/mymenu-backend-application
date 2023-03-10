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
import QRBuilder from "../pages/qr_builder/QRBuilder.vue";
import TableIndex from "../pages/tables/TableIndex.vue";
import TableCreate from "../pages/tables/TableCreate.vue";
import OrderIndex from "../pages/orders/OrderIndex.vue";
import RestaurantIndex from "../pages/restaurants/RestaurantIndex.vue";
import SettingsIndex from "../pages/settings/SettingsIndex.vue";
import PlanIndex from "../pages/plans/PlanIndex.vue";
import MenuItemBrowser from "../pages/menu_items/MenuItemBrowser.vue";
import OrderDetails from "../pages/orders/OrderDetails.vue";



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
        path : '/browse/:id',
        name : 'browse',
        component : MenuItemBrowser
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
            {
                path : '/tables',
                name : 'tables.index',
                component : TableIndex,
                meta: { title: 'Create Table' }
            },
            {
                path : '/tables/create',
                name : 'tables.create',
                component : TableCreate,
                meta: { title: 'Create Tables' }
            },
            {
                path : '/qr-builder',
                name : 'qr-builder',
                component : QRBuilder,
                meta: { title: 'Create QR Codes By table' }
            },
            {
                path : '/live-orders',
                name : 'orders.live',
                component : LiveOrders,
                meta: { title: 'Live Orders' }
            },
            {
                path : '/orders',
                name : 'orders.index',
                component : OrderIndex,
                meta: { title: 'List of orders' }
            },
            {
                path : '/live-orders',
                name : 'orders.live',
                component : LiveOrders,
                meta: { title: 'Live Orders' }
            },
            {
                path : '/orders/:id/details',
                name : 'orders.details',
                component : OrderDetails,
                meta: { title: 'Order Details' }
            },
            {
                path : '/restaurants',
                name : 'restaurants.index',
                component : RestaurantIndex,
                meta: { title: 'List of orders' }
            },
            {
                path : '/plans',
                name : 'plans.index',
                component : PlanIndex,
                meta: { title: 'Plans' }
            },
            {
                path : '/settings',
                name : 'settings',
                component : SettingsIndex,
                meta: { title: 'Settings' }
            },
        ]
    }
]

export default createRouter({
    history: createWebHistory(),
    routes
})
