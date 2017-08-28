<template>
    <div class="card">
        <center style='padding:20px'>
            <div class="card-body app-heading" style="display: inline;">
                <div class="profile-picture">
                    <label for="file-input">
                        <img v-if='previewImage' class="profile-img" :src='src[0]' />
                        <img v-if='mainImage' class="profile-img" :src='this.userInfo.profile_pic' />
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
                src: [],
                mainImage: true,
                previewImage: false,
            }
        },

        created() {
            this.getUserInfo();
        },

        methods: {
            getUserInfo() {
                axios.get('/get_user_info').then(response => this.userInfo = response.data);
            },

            onChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                var reader = new FileReader();
                reader.onload = (event) => {
                    this.mainImage = false;
                    this.previewImage = true;
                    this.$set(this.src, 0, event.target.result);

                    axios.post('update_profile_pic', {
                        image: this.src, 
                    })
                };
                reader.readAsDataURL(files[0]);
            }
        }
    }
</script>