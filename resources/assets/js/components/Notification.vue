<template>
	<li class="dropdown notification danger">
		<a @click.prevent='marksAsRead' style='cursor:pointer' class="dropdown-toggle" data-toggle="dropdown">
			<div class="icon"><i class="fa fa-bell" aria-hidden="true"></i></div>
			<div class="title">System Notifications</div>
			<div class="count" v-if='unreads.length > 0'>{{ unreads.length }}</div>
		</a>
		<div class="dropdown-menu">
			<ul>
			  <!-- <li class="dropdown-header">Notification</li> -->
			  <!-- <li>
			    <a href="#">
			      <span class="badge badge-danger pull-right">8</span>
			      <div class="message">
			        <div class="content">
			          <div class="title">New Order</div>
			          <div class="description">$400 total</div>
			        </div>
			      </div>
			    </a>
			  </li> -->
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

		props:['unreads', 'userID'],

		data() {
			return {
				unreadNotifications: this.unreads;
			}
		}

		mounted() {
			Echo.private(`App.User.${userID}`)
			    .notification((notification) => {
			    console.log(notification);
			});
		}
	}
	
</script>