<template>
	<li>
		<a>
			{{ notification.data.user.firstname }} sent a friend request to you.
		</a>
	</li>
</template>

<script>
	export default {
		props: ['notification']
	}
</script>