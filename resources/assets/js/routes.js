import VueRouter from 'vue-router';

let routes = [
    {path: '/',component: require('./views/Dashboard')},
    {path: '/profile',component: require('./views/Timeline')},
    {path: '/about',component: require('./views/About')},
    {path: '/friends',component: require('./views/Friends')},
    {path: '/friends/requests',component: require('./views/FriendRequests')},
];

export default new VueRouter({
    routes
});