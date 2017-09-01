<template>
    <section class="feed-area">
        <div class="post-section">
            <div class="card post">
                <div class="card-body">
                    <div class="friendlist">
                        <friends-top-menu></friends-top-menu>
                        <div class="top">
                            <h4>Friend Requests</h4>
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
                                            <div v-if='friend.accepted'>
                                                <p>
                                                    You are now friends with
                                                    {{ friend.firstname }} {{ friend.lastname }}
                                                </p>
                                            </div>
                                            <div v-else-if='friend.canceled'>
                                                <p>
                                                    Request Removed
                                                </p>
                                            </div>
                                            <div v-else>
                                                <button class='btn btn-xs btn-primary'
                                                        @click='acceptRequest(friend)'>
                                                        Accept
                                                </button>
                                                <button class='btn btn-xs btn-danger pull-right'
                                                        @click='cancelRequest(friend)'>
                                                        Cancel
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
    export default {
        components: {
            FriendsTopMenu
        },
        data() {
           return {
                friends: [],
           } 
        },

        created() {
            this.getFriendRequest();
        },

        methods: {
            getFriendRequest() {
                axios.get('/get_friend_requests').then(response => this.friends = response.data);
            },

            acceptRequest(friend) {
                axios.post('/accept_friend_request', {
                    id : friend.id
                }).then(response => {
                    this.$set(friend, 'accepted', response.data)
                });
            },

            cancelRequest(friend) {
                axios.post('/cancel_friend_request', {
                    id : friend.id
                }).then(response => {
                    this.$set(friend, 'canceled', response.data)
                });
            }
        }
    }
</script>