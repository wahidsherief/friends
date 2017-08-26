import Vue from 'vue';
import VueRouter from 'vue-router';
import VueAutosize from 'vue-autosize';
import axios from 'axios';
import Form from './utilities/Form';


window.Vue = Vue;

Vue.use(VueRouter);
Vue.use(VueAutosize)

window.axios = axios;
window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest'
};

window.Form = Form;