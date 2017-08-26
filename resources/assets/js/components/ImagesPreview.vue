<template>
        <div class='col-xs-3'  v-show='isVisible'>
            <div class="row img-container">
                <div class="preview-image-container">
                <img :src='src' alt='preview image' class="preview-image rounded float-left img-fluid" />
                <!-- <a @click.prevent='isVisible = false'> -->
                <a @click.prevent="removeItem">
                    <span class="fa fa-close fa-2x close"></span>
                </a>
                </div>
            </div>
        </div>
</template>

<script>
    export default {
        props: ['src', 'remove', 'index'],
        data() {
            return {
                isVisible: true
            }
        },

        methods: {
            removeItem() {
                this.remove(this.index);
            }
        }
    }
</script>