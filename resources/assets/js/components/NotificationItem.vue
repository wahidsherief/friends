<template>
	<li>
		<a v-if="notification.data.post.notification_type == 'accept_request'">
			{{ notification.data.post.post.firstname }} {{ notification.data.post.post.lastname }} 
			accepted your friend request
		</a>

		<a v-if="notification.data.post.notification_type == 'comment'">
			{{ notification.data.post.username }} 
			commented on your post
		</a>

		<a v-if="notification.data.post.notification_type == 'reacts'">
			{{ notification.data.post.username }}
			reacted on your post
		</a>

		<!-- <a v-else>
			{{ notification.data.post.notification_type }}  xxx
		</a> -->
	</li>
</template>

<script>
	export default {
		props: ['notification'],
	

		created() {
			// console.log(this.notification);
		}
	}
</script>