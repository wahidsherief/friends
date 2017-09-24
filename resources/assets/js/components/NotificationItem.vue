<template>
	<li>
		<a>
			<!-- {{ notification.post.firstname }} {{ notification.post.lastname }} posted now  -->
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