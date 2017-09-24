<template>
    <section class="feed-area">
        <div class="row">
            <navigation-section :userid='userid'
                            :username='username'
                            :profilepic='profile_pic'
                            :unreads='unreads'>
            </navigation-section>
        </div>
        <div class="post-section">
            <div class="card post">
                <div class="card-body">
                    <div class="friendlist">
                    	<friends-top-menu></friends-top-menu>
                        <div class="top">
                            <h4>Your Friend List</h4>
                        </div>
                        <hr>
                        <br>
                        <div class="friend" v-for="(friend, index) in friends">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="col-sm-2">
                                        <img src="https://www.infrascan.net/demo/assets/img/avatar5.png" class="img-circle" width="60px">
                                    </div>
                                    <div class="col-xs-7">
                                        <h4><a href="#">{{ friend.firstname }} {{ friend.lastname }}</a></h4>
                                        <p><a href="#">4 mutual friends</a></p>
                                    </div>

                                    <div class="col-xs-3">
                                        <div class="row">
                                            <div v-if='friend.unfriend'>
                                                <p>
                                                    You are no more connected with
                                                    {{ friend.firstname }} {{ friend.lastname }}
                                                </p>
                                            </div>
                                            <div v-else>
                                                <button class='btn btn-xs btn-primary'
                                                        @click='unfriend(friend)'>
                                                        Remove Friend
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <hr/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import FriendsTopMenu from '../components/FriendsTopMenu';
    import NavigationSection from '../components/NavigationSection';

    export default {
        props:['userid', 'unreads'],

    	components: {
            FriendsTopMenu,
            NavigationSection
        },

        data() {
           return {
                friends: [],
                username: '',
                profile_pic: ''
            }
        },

        created() {
            this.getFriendList();
            this.getNavInfo();
        },

        methods: {
            getNavInfo() {
                axios.get('get_nav_info').then(response => {
                    this.username = response.data.username;
                    this.profile_pic = response.data.profile_pic;
                })
            },

            getFriendList() {
                axios.get('/get_friendlist').then(response => this.friends = response.data);
            },

            unfriend(friend) {
                axios.post('/unfriend', {
                    id : friend.id
                }).then(response => {
                    this.$set(friend, 'unfriend', response.data)
                });
            }
        }
    }
</script>