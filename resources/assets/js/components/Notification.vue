<template>
	<li class="dropdown notification danger">
		<a @click.prevent='marksAsRead' style='cursor:pointer' class="dropdown-toggle" data-toggle="dropdown">
			<div class="icon"><i class="fa fa-bell" aria-hidden="true"></i></div>
			<div class="title">System Notifications</div>
			<div class="count" v-if='unreads.length > 0'>{{ unreads.length }}</div>
		</a>
		<div class="dropdown-menu">
			<ul>
				<notification-item></notification-item>
				  
				<li class="dropdown-footer">
				    <a href="#">View All <i class="fa fa-angle-right" aria-hidden="true"></i></a>
				</li>
			</ul>
		</div>
	</li>
</template>

<script>
	import NotificationItem from '../components/NotificationItem';
	export default {
		components: {
			NotificationItem
		},

		props:['unreads', 'userid'],

		data() {
			return {
				unreadNotifications: this.unreads
			}
		},
		
		mounted() {
			Echo.private(`App.User.${this.userid}`)
			    .notification((notification) => {
			    console.log(notification);
			});
		}
	}
	
</script>