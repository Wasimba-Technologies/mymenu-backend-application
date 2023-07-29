/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

//import _ from 'lodash';
//window._ = _;


import Swal from 'sweetalert2'
window.swal = Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', swal.stopTimer)
        toast.addEventListener('mouseleave', swal.resumeTimer)
    }
});
window.Toast = Toast
/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;
window.axios.defaults.withCredentials = true;
//window.axios.defaults.headers.common["Content-Type"] = "multipart/form-data";
window.axios.interceptors.response.use(
    response => response,
    error => {
        console.log(error)
        if (error.response?.status === 401 || error.response?.status === 403 || error.response?.status === 419) {
            if (localStorage.getItem('access_token')) {
                if (error.response.data.message.includes("not verified")){
                    location.assign('/verify-otp')
                }else{
                    localStorage.removeItem('access_token')
                    location.assign('/login')
                }
            }
        }

        return Promise.reject(error)
    }
)

window.axios.interceptors.request.use(
    (config) => {
        const token = localStorage.getItem("access_token");
        const tenant_id = localStorage.getItem("X-Tenant-ID");
        if (token) {
            config.headers["Authorization"] = "Bearer " + token;
        }
        if (tenant_id){
            config.headers["X-TENANT-ID"] = tenant_id
        }
        config.headers['Accept'] = "application/json"
        return config;
    },
    (error) => {
        Promise.reject(error);
    }
);

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
import {inject} from "vue";

window.Pusher = Pusher;
//Pusher.logToConsole = true;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    wsHost: window.location.hostname,
    wsPort: 6001,
    disableStats: true,
    forceTLS: false,
    auth: {
        headers: {
            Authorization: 'Bearer ' + localStorage.getItem("access_token")
        },
    },
});

