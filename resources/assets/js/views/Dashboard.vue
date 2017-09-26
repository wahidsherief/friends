<template>
    <div>
        <navigation-section :userid='userid'
                            :username='username'
                            :profilepic='profile_pic'
                            :unreads='unreads'>
        </navigation-section>

        <div class="app-area">
            <div class="col-xs-12 col-md-12">
                <div class="row">
                    <div class="col-xs-12">
                        <section class='feed-area'>

                            <status-input @completed='addRecentPost'></status-input>

                            <div class="post-section" v-for="(post,index) in posts">
                                <div class="card post" :style="{ background: post.color }">
                                    <div class="card-body">
                                        <div class="media social-post">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img src="images/profile.png" />
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="media-heading">
                                                    <h4 class="title">
                                                        {{ post.firstname }} {{ post.lastname }}
                                                        <span class='feelingText' v-if="post.mood != null">is feeling -- {{ post.mood }}</span>
                                                    </h4>
                                                    <h5 class="timeing">{{ postedOn(post) }}</h5>
                                                </div>
                                                <div class="media-content">{{post.body}}</div>
                                                <div class="media-content" v-if="post.images !=  null" >
                                                    <div class='row img-container'>
                                                        <div v-for='src in post.images'>
                                                            <div class="col-xs-3">
                                                                <div class="row">
                                                                    <div class="post-image">
                                                                        <img :src='src' alt='image' class="rounded float-left img-fluid full-image" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="media-action">
                                                    <button @click="react(post,index)" class="btn btn-link">
                                                        <i class="fa fa-thumbs-up fa-custom"></i> 
                                                        <span v-if='post.reacts > 0'> &nbsp;{{ post.reacts }} Reactions </span>
                                                        <span v-else><strong>Like</strong></span>
                                                    </button>
                                                    <button @click="getComments(post, index)" class="btn btn-link"><i class="fa fa-comments fa-custom"></i>
                                                    &nbsp;
                                                    <span v-if='post.total_comments > 0'> &nbsp;{{ post.total_comments }} Comments </span>
                                                    <span v-else><strong>Comment</strong></span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div v-if='post.toggleComments'>
                                    <div class="card comment" v-for='comment in post.comments'>
                                        <div class="card-body">
                                            <div class="media social-post">
                                                <div class="col-xs-1">
                                                    <div class="media-left">
                                                        <a href="#">
                                                            <img src="images/profile.png" />
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-xs-8">
                                                    <div class="media-body">
                                                        <div class="media-heading">
                                                            <p>
                                                                <span class="comment-title">
                                                                    {{comment.user.firstname}}
                                                                    {{comment.user.lastname}}
                                                                </span>
                                                                <span>&nbsp; {{comment.comment}}</span>
                                                            </p>
                                                        </div>
                                                        <div class="row media-content" v-if="comment.comment_image != ''">
                                                            <div class="col-xs-3">
                                                                <img :src="comment.comment_image" class="full-image img-responsive">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-3">
                                                    <div class="pull-right">
                                                        <span class="text-muted" style="font-size: 10px">{{ postedOn(comment) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- v-if="index == selectedPostIndex" -->
                                    <comment-input  :post="post" :index="index" @completed='getCommentsByInsert(post, index)'>
                                    </comment-input>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';
    import NavigationSection from '../components/NavigationSection';
    import StatusInput from '../components/StatusInput';
    import CommentInput from '../components/CommentInput';

    export default {
        props:['userid', 'unreads'],
        
        components: {   
            NavigationSection,
            StatusInput, 
            CommentInput
        },

        data() {
            return {
                posts: [],
                username: '',
                profile_pic: ''
            }
        },

        created() {
            this.getAllPosts();
            this.getNavInfo();
        },

        mounted() {
            var newUnreadNotifications;
            window.Echo.private('App.User.' + this.userid)
            .notification((notification) => {
                var type_string = notification.type.split("\\");
                var type = type_string[2];
                if(type == 'CommentsUpdate'){
                    if (notification.post.id != this.userid) {
                        let post = notification.post.post;
                        let index = notification.post.index;
                        this.getCommentsByInsert(post, index);
                    };  
                }
            });
        },

        ready() {
            this.getAllPosts();
        },

        methods: {
            getAllPosts() {
                axios.get('/posts')
                    .then(response => {
                        this.posts = response.data;
                    });

                    setTimeout(this.getAllPosts, 500000);
            },

            postedOn(post) {
                return moment(post.created_at).fromNow();
            },

            getNavInfo() {
                axios.get('get_nav_info').then(response => {
                    this.username = response.data.username;
                    this.profile_pic = response.data.profile_pic;
                })
            },

            getComments(post, index){
                axios.post('getcomments', {id: post.id})
                    .then(response => {
                        this.$set(this.posts, index, Object.assign({}, post, { comments: response.data, total_comments:  response.data.length}));
                    });
                    post.toggleComments =! post.toggleComments;
            },

            getCommentsByInsert(post, index){
                axios.post('getcomments', {id: post.id})
                    .then(response => {
                        this.$set(this.posts, index, Object.assign({}, post, 
                            { comments: response.data, total_comments:  response.data.length }));
                    });
            },

            addRecentPost(post) {
                this.posts.unshift(post);
                window.scrollTo(0, 0);
            },

            react(post, index) {
                axios.post('react', {
                    id: post.id
                }).then(response => {
                    this.$set(this.posts, index, Object.assign({}, post, { reacts: response.data }));
                });
            }
        }
    }
</script>