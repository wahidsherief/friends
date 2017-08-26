<template>
	<section>
		<profile-header></profile-header>
        <br>
        <div class="col-xs-12 card" style="padding-top:20px; margin-bottom:20px">
            <div style="padding-top:30px" class="col-xs-11 col-xs-offset-1 col-md-10 col-md-offset-2">
                <div class="tab-content row">
                	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </div>
            </div>
        </div>
	</section>
</template>

<script>
    import ProfileHeader from '../components/ProfileHeader';
    export default {
        components: {ProfileHeader},
        data() {
            return {
                userInfo: [],
            }
        },

        created() {
            this.getUserInfo()
        },

        methods: {
            getUserInfo() {
                axios.get('/get_user_info').then(response => this.userInfo = response.data);
            }
        }
    }
</script>