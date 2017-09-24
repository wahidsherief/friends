<template>
	<li>
		<a>
			{{ notification.data.post.firstname }} {{ notification.data.post.lastname }}  sent a friend request to you.
		</a>
	</li>
</template>

<script>
	export default {
		props: ['notification']
	}
</script>