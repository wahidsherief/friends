<template>
	<form @submit.prevent='onSubmit'>
		<div class="media-comment">
	        <input type="text" v-model='form.comment' class="form-control" placeholder="comment...">
	    </div>
	    <button type='submit'>submit</button>
    </form>
</template>

<script>
	export default {
		data() {
			return {
                form: new Form({comment: ''})
			}
		},

		methods: {
            onSubmit() {
                this.form
                	.post('/comments')
                	.then(post => this.$emit('completed', comment));
            }
		}
	}
</script>