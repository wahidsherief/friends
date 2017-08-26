import VueRouter from 'vue-router';

let routes = [
    {path: '/',component: require('./views/Dashboard')},
    {path: '/profile',component: require('./views/Timeline')},
    {path: '/about',component: require('./views/About')},
];

export default new VueRouter({
    routes
});