import {createRouter, createWebHistory} from "vue-router";
import NotFound from "../components/NotFound.vue";
import useAuth from "../composables/auth";
import DashboardLayout from "../pages/staff_dashboard/DashboardLayout.vue";
import DashboardIndex from "../pages/staff_dashboard/DashboardIndex.vue";
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
import OrderDetails from "../pages/orders/OrderDetails.vue";
import TableUpdate from "../pages/tables/TableUpdate.vue";
import MenuItemUpdate from "../pages/menu_items/MenuItemUpdate.vue";
import MenuUpdate from "../pages/menus/MenuUpdate.vue";
import PlanUpdate from "../pages/plans/PlanUpdate.vue";
import PlanCreate from "../pages/plans/PlanCreate.vue";
import UserUpdate from "../pages/users/UserUpdate.vue";
import UserCreate from "../pages/users/UserCreate.vue";
import UserIndex from "../pages/users/UserIndex.vue";
import SubscriptionIndex from "../pages/subscriptions/SubscriptionIndex.vue";
import SocialLoginCallBack from "../pages/auth/SocialLoginCallBack.vue";
import SubscriptionDetails from "../pages/subscriptions/SubscriptionDetails.vue";
import SubscriptionPayment from "../pages/payments/SubscriptionPayment.vue";
import VerifyOTP from "../pages/auth/VerifyOTP.vue";
import OrderPayment from "../pages/payments/OrderPayment.vue";
import MenuItemBrowser from "../pages/customer_dashboard/MenuItemBrowser.vue";
import MyOrders from "../pages/customer_dashboard/MyOrders.vue";
import OrderDetailsGuest from "../pages/customer_dashboard/OrderDetailsGuest.vue";



const {logout} = useAuth()

const auth = (to, from, next) => {
    if (localStorage.getItem('access_token')) {
        next()
        return
    }
    next('/login')
    //return
}

const logoutAndRedirect = async (to, from) => {
    await logout()
}


const routes =[
    {
        path : '/:pathMatch(.*)*',
        name : 'notFound',
        component : NotFound
    },
    {
        path : '/auth/login/google/callback',
        name : 'google.callback',
        component: SocialLoginCallBack
    },
    {
        path : '/auth/login/facebook/callback',
        name : 'facebook.callback',
        component: SocialLoginCallBack
    },
    {
        path : '/verify-otp',
        name : 'verify-otp',
        component: VerifyOTP
    },
    {
        path : '/logout',
        name : 'logout',
        beforeEnter: logoutAndRedirect
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
        component : MenuItemBrowser,
        meta: { title: 'Browse Menu' }

    },
    {
        path : '/order_details/:id/',
        name : 'order_details.guest',
        component : OrderDetailsGuest,
        meta: { title: 'Guest Order Details' }
    },
    {
        path : '/my_orders',
        name : 'my_orders',
        component : MyOrders,
        meta: { title: 'List of All Orders' }
    },
    {
        path : '/checkout',
        name : 'checkout',
        component : OrderPayment,
        meta: { title: 'Checkout' }
    },
    {
        component: DashboardLayout,
        beforeEnter: auth,
        children: [
            {
                path : '/dashboard',
                name : 'dashboard',
                component : DashboardIndex,
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
                path : '/menu/:id/update',
                name : 'menu.update',
                component : MenuUpdate,
                meta: { title: 'Update Menu' }
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
                path : '/menu-items/:id/update',
                name : 'menu_items.update',
                component : MenuItemUpdate,
                meta: { title: 'Update Menu Items' }
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
                path : '/tables/:id/update',
                name : 'tables.update',
                component : TableUpdate,
                meta: { title: 'Update Table' }
            },
            {
                path : '/qr-builder',
                name : 'qr-builder',
                component : QRBuilder,
                meta: { title: 'Create QR Codes Appearance' }
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
                meta: { title: 'List of Restaurants' }
            },
            {
                path : '/plans',
                name : 'plans.index',
                component : PlanIndex,
                meta: { title: 'Plans' }
            },
            {
                path : '/plans/create',
                name : 'plans.create',
                component : PlanCreate,
                meta: { title: 'Plans' }
            },
            {
                path : '/plans/:id/update',
                name : 'plans.update',
                component : PlanUpdate,
                meta: { title: 'Plans' }
            },
            {
                path : '/users',
                name : 'users.index',
                component : UserIndex,
                meta: { title: 'List of System Users' }
            },
            {
                path : '/users/create',
                name : 'users.create',
                component : UserCreate,
                meta: { title: 'Create System Users' }
            },
            {
                path : '/users/:id/update',
                name : 'users.update',
                component : UserUpdate,
                meta: { title: 'Update System Users' }
            },
            {
                path : '/settings',
                name : 'settings',
                component : SettingsIndex,
                meta: { title: 'Settings' }
            },
            {
                path : '/subscriptions',
                name : 'subscriptions.index',
                component : SubscriptionIndex,
                meta: { title: 'Subscriptions' }
            },
            {
                path : '/subscriptions/:id/details',
                name : 'subscriptions.details',
                component : SubscriptionDetails,
                meta: { title: 'Subscription Details' }
            },
            {
                path : '/subscriptions/:id/payment',
                name : 'subscriptions.payment',
                component : SubscriptionPayment,
                meta: { title: 'Subscription Payment' }
            },
        ]
    }
]

export default createRouter({
    history: createWebHistory(),
    routes
})
