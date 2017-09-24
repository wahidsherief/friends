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
                            <h4>Friend's List</h4>
                        </div>
                        <hr>
                        <br>
                        <div class="friend" v-for="(friend, index) in friends">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="col-sm-2">
                                        <img src="https://www.infrascan.net/demo/assets/img/avatar5.png" class="img-circle" width="60px">
                                    </div>
                                    <div class="col-sm-8">
                                        <h4><a href="#">{{ friend.firstname }} {{ friend.lastname }}</a></h4>
                                        <p>
                                            <a v-if="friend.mutualFriendCount == 1">
                                                {{ friend.mutualFriendCount }} mutual friend
                                            </a>
                                            <a v-else-if="friend.mutualFriendCount > 1">
                                                {{ friend.mutualFriendCount }} mutual friends
                                            </a>
                                            <span v-else >
                                                No friends in common
                                            </span>
                                        </p>
                                    </div>

                   
                                    <div class="col-sm-2">
                                        <div v-if="friend.requestSent">
                                            <button class='btn btn-xs disabled'>Request sent</button>
                                        </div>
                                        <div v-else>
                                            <button class='btn btn-xs btn-primary' @click="addFriend(friend)">Add friend</button>
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
            this.getAllFriend();
            this.getNavInfo();
        },

        methods: {
            getNavInfo() {
                axios.get('get_nav_info').then(response => {
                    this.username = response.data.username;
                    this.profile_pic = response.data.profile_pic;
                })
            },
            
            getAllFriend() {
                axios.get('/get_friend').then(response => this.friends = response.data);
            },

            addFriend(friend) {
                axios.post('/add_friend', {
                    id : friend.id
                }).then(response => {
                    this.$set(friend, 'requestSent', response.data)
                });
            }
        }
    }
</script>