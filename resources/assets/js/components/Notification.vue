<template>
	<li class="dropdown notification danger">
		<a @click.prevent='marksAsRead' style='cursor:pointer' class="dropdown-toggle" data-toggle="dropdown">
			<div class="icon"><i class="fa fa-bell" aria-hidden="true"></i></div>
			<div class="title">System Notifications</div>
			<div class="count" v-if='unreadNotifications.length > 0'>{{ unreadNotifications.length }}</div>
		</a>
		<div class="dropdown-menu">
			<ul>
				<notification-item v-for='unread in unreadNotifications' :notification='unread'></notification-item>
				<li class="dropdown-footer">
				    <a href="#">View All<i class="fa fa-angle-right" aria-hidden="true"></i></a>
				</li>
			</ul>
		</div>
	</li>
</template>

<script>
	import NotificationItem from '../components/NotificationItem';

	export default {
		props:['unreads', 'userid'],

		components: {
			NotificationItem
		},

		data() {
			return {
				unreadNotifications: this.unreads
			}
		},

		mounted() {
			var newUnreadNotifications;
    		window.Echo.private('App.User.' + this.userid)
			.notification((notification) => {
				var type_string = notification.type.split("\\");
				var type = type_string[2];
				if(type == 'Notifications'){
        			let newUnreadNotifications = {
	        			data: {
	        				post:notification.post
	        			}
    				};
    				this.unreadNotifications.unshift(newUnreadNotifications);
    			};
			});
		},

		methods: {
			marksAsRead() {
				
			}
		}
	}
	
</script>