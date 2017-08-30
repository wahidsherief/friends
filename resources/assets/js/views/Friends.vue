<template>
    <section class="feed-area">
        <div class="post-section">
            <div class="card post">
                <div class="card-body">
                    <div class="friendlist">
                        <div class="top">
                            <h4>Friend's List</h4>
                        </div>
                        <hr>
                        <br>
                        <div class="friend"  v-for="(friend, index) in friends">
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
                                        <!-- <button v-if="friend.x == 1" class='btn btn-xs btn-default disabled'>Friend request sent
                                        </button> -->
                                        <button v-model='requestButton'
                                                @click="addFriend(friend.id, index)" class='btn btn-xs btn-primary'>Add friend
                                        </button>

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
                friends: []
           } 
        },

        created() {
            this.getAllFriend();
        },

        methods: {
            getAllFriend() {
                axios.get('/get_friend').then(response => this.friends = response.data);
            },

            addFriend(recipientID, index) {
                axios.post('/add_friend', {
                    id : recipientID
                }).then(response => {
                    this.requestButton
                    };
                });
            }
        }
    }
</script>