<template>
    <div class="card">
        <center style='padding:20px'>
            <div class="card-body app-heading" style="display: inline;">
                <div class="profile-picture">
                    <label for="file-input">
                        <img class="profile-img" :src=userInfo.profile_pic />
                    </label>
                    <input id="file-input" @change="onChange" type="file" />
                </div>
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
            },

            onChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                var reader = new FileReader();
                var x = [];
                reader.onload = (event) => {
                    this.userInfo.profile_pic = event.target.result;
                    x[0] = this.userInfo.profile_pic;
                };
                reader.readAsDataURL(files[0]);
            }
        }
    }
</script>