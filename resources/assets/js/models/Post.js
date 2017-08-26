class Post {
	// then = posts => this.posts = posts
	static all(then) {
		return axios.get('/posts')
					.then(({data}) => then(data));
	}
}

export default Post;