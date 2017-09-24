<template>
	<li class="dropdown notification">    
		<a class="dropdown-toggle" data-toggle="dropdown">
			<router-link to='friends' exact>
			    <div class="icon"><i class="fa fa-users" aria-hidden="true"></i></div>
			    <div class="title">Unread Messages</div>
			    <div class="count" v-if='unreadFriendRequestNotifications.length > 0'>
			    	{{ unreadFriendRequestNotifications.length }}
				</div>
			</router-link>    
		</a>
		<div class="dropdown-menu">
			<ul>
			  <friend-request-notification-item v-for='unread in unreads' :notification='unread'>
			  </friend-request-notification-item>
			</ul>
		</div>
	</li>
</template>

<script>
	import FriendRequestNotificationItem from '../components/FriendRequestNotificationItem';
	export default {
		props:['unreads', 'userid'],

		components: {
			FriendRequestNotificationItem
		},

		data() {
			return {
				unreadFriendRequestNotifications: this.unreads,
			}
		},


		mounted() {
			var popup = false;
			var newUnreadNotifications;
    		window.Echo.private('App.User.' + this.userid)
    			.notification((notification) => {
    				var type_string = notification.type.split("\\");
					var type = type_string[2];
					if(type == 'SendFriendRequest'){
	        			console.log(notification);
	        			popup = true;

	        			newUnreadNotifications = {
	        			data: {
	        				post:notification
	        			}
        			}
        		};
        		if (popup == true){
        			this.unreadFriendRequestNotifications.push(newUnreadNotifications);
        		}
    		});
		},

		methods: {
			marksAsRead() {
				axios.get('mark_as_read');
			}
		}
	}
	
</script>