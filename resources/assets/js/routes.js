import VueRouter from 'vue-router';

let routes = [
    {path: '/',component: require('./views/Dashboard')},
    {path: '/profile',component: require('./views/Timeline')},
    {path: '/about',component: require('./views/About')},
    {path: '/search_friend',component: require('./views/SearchFriends')},
    {path: '/requests',component: require('./views/FriendRequests')},
    {path: '/friends',component: require('./views/FriendList')},
];

export default new VueRouter({
    routes
});