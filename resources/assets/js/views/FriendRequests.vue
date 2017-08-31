<template>
    <section class="feed-area">
        <div class="post-section">
            <div class="card post">
                <div class="card-body">
                    <div class="friendlist">
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
                                    <div class="col-sm-8">
                                        <h4><a href="#">{{ friend.firstname }} {{ friend.lastname }}</a></h4>
                                        <p><a href="#">4 mutual friends</a></p>
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
    export default {
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

            // addFriend(friend) {
            //     axios.post('/add_friend', {
            //         id : friend.id
            //     }).then(response => {
            //         this.$set(friend, 'requestSent', response.data)
            //     });
            // }
        }
    }
</script>