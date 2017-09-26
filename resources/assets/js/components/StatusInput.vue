<template>
	<div class="card">
            <div class="card-header">
                <div class="col-xs-12">
                    <div class="row">
                        <form @submit.prevent='onSubmit'>
                            <div class='form-group'>  
                                <textarea v-autosize id='status' @keypress='show=true' v-model='form.body' style="height: 60px" class="form-control" placeholder="Whats in your mind??" type="text"></textarea>
                                <input type="hidden" v-model='form.color'>
                                <div v-if='hide'>
                                    <span>feeling --</span>
                                    <span>{{ form.current_mood }}</span>
                                </div>
                            </div>
                            <div class="uploadBox" v-if='isPostImagesPreview'>
                                <div class="uploadBoxMain">
                                    <div class="form-group">
                                        <!-- <div class="dropArea"> -->
                                            <!-- <input  type="file" id="items" name="items[]" 
                                            multiple @change="onChange"> -->
                                            <div class="row">
                                                <div v-for="(src,index) in form.itemsImages">
                                                    <images-preview :index='index' :remove='removeImage' :src='src'></images-preview>
                                                </div>
                                            </div>
                                        <!-- </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12" style="float:none">
                                    <div class="form-group">
                                        <button type='submit' class="pull-right btn btn-xs btn-primary">Post</button>
                                    </div>
                                    <div class="form-group">
                                        <div class="file pull-right btn btn-xs btn-danger upload-button-div">Upload
                                            <input class='upload-input' multiple @change="onChange"  type="file" name="file"/>
                                        </div>
                                    </div>
                                    <div class="dropdown pull-right">
                                        <button @click='getMoods' class="btn btn-xs btn-success dropdown-toggle" type="button" data-toggle="dropdown">Feeling
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu scrollable-menu">
                                            <li v-for='mood in moods'>
                                            <a href="#" @click='setMood(mood)'>{{ mood.mood }}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
    import ImagesPreview from '../components/ImagesPreview';

	export default {
        components: {
            ImagesPreview
        },
		data() {
			return {
                form: new Form({body: '', color: '', current_mood: '', itemsImages: []}),
                moods: '',
                hide: false,
                itemsAdded: '',
                isLoaderVisible: false,
                isPostImagesPreview: false
            }	
		},

		methods: {
            onSubmit() {
                this.isLoaderVisible = true;
                this.form
                    .post('/posts')
                    .then(post => {
                        this.isLoaderVisible = false;
                        this.$emit('completed', post);
                        this.itemsAdded = '';
                        this.form.itemsImages = [];
                        this.hide = false;
                        this.isPostImagesPreview = false;
                    });
            },

            getMoods() {
                axios.get('/getMoods').then(response => this.moods = response.data);
            },

            setMood(mood) {
                this.hide = true;
                this.form.current_mood = mood.mood;
                this.form.color = mood.color;
            },

            bytesToSize(bytes) {
                const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
                if (bytes === 0) return 'n/a';
                let i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
                if (i === 0) return bytes + ' ' + sizes[i];
                return (bytes / Math.pow(1024, i)).toFixed(2) + ' ' + sizes[i];
            },

            onChange(e) {
                this.isActive = true;
                // this.successMsg = '';
                // this.errorMsg = '';
                // this.formData = new FormData();
                let files = e.target.files || e.dataTransfer.files;
                this.itemsAdded = files.length;
                // let fileSizes = 0;
                var vm = this.form;
                for (let x in files) {
                    if (!isNaN(x)) {
                        var reader = new FileReader();
                        reader.onload = (event) => {
                            this.$set(vm.itemsImages, x, event.target.result);
                        };
                        reader.readAsDataURL(files[x]);
                        
                    }
                }
                this.isPostImagesPreview = true;
            },

            removeImage(index) {
                this.$delete(this.form.itemsImages, index);
            },
		}
	}
// </script>