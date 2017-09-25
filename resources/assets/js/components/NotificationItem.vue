<template>
	<li>
		<a v-if="notification.data.post.notification_type == 'accept_request'">
			{{ notification.data.post.firstname }} {{ notification.data.post.lastname }} 
			accepted your friend request
		</a>

		<a v-if="notification.data.post.notification_type == 'comment'">
			{{ notification.data.post.firstname }} {{ notification.data.post.lastname }} 
			commented on your post
		</a>

		<a v-if="notification.data.post.notification_type == 'reacts'">
			{{ notification.data.post.firstname }} {{ notification.data.post.lastname }} 
			reacted on your post
		</a>

		<a v-else>
			{{ notification.data.post.firstname }} {{ notification.data.post.lastname }} xxx
		</a>
	</li>
</template>

<script>
	export default {
		props: ['notification'],
	

		created() {
			console.log(this.notification);
		}
	}
</script>