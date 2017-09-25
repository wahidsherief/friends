<template>
	<div class='card comment-section'>
		<form @submit.prevent='onSubmit'>
			<div class="row">
				<div class="col-xs-1">
					<img src="http://placehold.it/100x100" style="width:50px; height: 50px" alt="Cinque Terre">
				</div>
				<div class="col-xs-11">
					<div class="media-comment">
				        <textarea v-autosize  v-model='comment' style="height: 50px;resize:none; overflow:hidden" class="form-control" placeholder="Add your comment" type="text"></textarea>
				    </div>
			    </div>
		    </div>
		    <div class="row">
		    	<div class="col-xs-1"></div>
			    <div class='col-xs-11'>
			    	<div class="uploadBox">
	                    <div class="uploadBoxMain">
	                        <div class="form-group">
	                            <div class='col-xs-3' v-show='isCommentImagePreview'>
						            <div class="row img-container">
						                <div class="preview-image-container">
						                <img :src='src[0]' alt='preview image' class="preview-image rounded float-left img-fluid" />
						                <a @click.prevent="removeImage">
						                    <span class="fa fa-close fa-2x close"></span>
						                </a>
						                </div>
						            </div>
						        </div>
	                        </div>
	                    </div>
	                </div>
			    </div>
		    </div>
		    <div class="row">
		    	<div class="col-xs-1"></div>
			    <div class='col-xs-10'>
			    	<!-- <i class="fa fa-camera btn btn-link pull-right" style="font-size: 18px"></i> -->
			    	<div v-show='isImageUploadButtonShow' class="file pull-right btn btn-xs btn-danger upload-button-div">Upload
	                    <input class='upload-input' @change="onChange"  type="file" name="file"/>
	                </div>
			    </div>
			    <div class="col-xs-1">
			    	<button type='submit' class="pull-right btn btn-xs btn-primary">Post</button>
			    </div>
		    </div>
	    </form>
    </div>
</template>

<script>
	export default {
		props: ['post', 'index'],

		data() {
			return {
                comment: '',
                src: [],
                isCommentImagePreview: false,
                isImageUploadButtonShow: true
			}
		},

		methods: {
            onSubmit() {
                axios.post('comments', {
                	comment: this.comment, 
                	post: this.post, 
                	index: this.index, 
                	image: this.src, 
                })
                .then(post => this.$emit('completed'));

                this.comment = '';
                this.isCommentImagePreview = false;
                this.isImageUploadButtonShow = true;
            },

            onChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                    var reader = new FileReader();
                    reader.onload = (event) => {
                        this.$set(this.src, 0, event.target.result);
                    };
                    reader.readAsDataURL(files[0]);
                    this.isCommentImagePreview = true;
                    this.isImageUploadButtonShow = false;
            },

            removeImage() {
            	this.isCommentImagePreview = false;
            	this.isImageUploadButtonShow = true;
                this.$delete(this.src, 0);
            },
		}
	}
</script>