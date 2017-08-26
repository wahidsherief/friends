<template>
    <div class="card">
        <center style='padding:20px'>
            <div class="card-body app-heading" style="display: inline;">
                <img class="profile-img" src="http://placehold.it/150x150">
                <div class="app-title">
                    <div class="title">
                        <strong><span class="highlight">{{ userInfo.firstname }} {{ userInfo.lastname }}</span></strong>
                    </div>
                    <div class="description">{{ userInfo.bio }}</div>
                    <div>
                        <router-link to='profile' exact>Timeline</router-link>
                        <router-link to='about'>About</router-link>
                    </div>
                </div>
            </div>
        </center>
    </div>
</template>

<script>
    export default {
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