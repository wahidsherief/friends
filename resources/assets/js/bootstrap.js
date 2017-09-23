import Vue from 'vue';
import VueRouter from 'vue-router';
import VueAutosize from 'vue-autosize';
import axios from 'axios';
import Form from './utilities/Form';
import Echo from "laravel-echo";


window.Vue = Vue;

Vue.use(VueRouter);
Vue.use(VueAutosize)

window.Pusher = require('pusher-js');
window.axios = axios;
window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest'
};


window.Form = Form;


window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '691857f3d69337b25cf9',
    cluster: 'us2',
    encrypted: false
});

