<template lang="">
<div class="mb-3">
    <input type="text" v-model="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="title">
</div>
<div ref="dropzone" class=" btn p-5 bg-light text-center text-dark w-25 mb-3">
    Upload
</div>
<div class="mb-3">
    <vue-editor useCustomImageHandler @image-added="handleImageAdded" v-model="content" />
</div>
<div>
    <button class="btn btn-light" @click.prevent="store()">Create</button>
</div>
</template>

<script>
import axios from 'axios';
import Dropzone from 'dropzone';
import {
    VueEditor
} from "vue3-editor";

export default {
    name: "Create",

    data() {
        return {
            dropzone: null,
            title: '',
            content: null
        }
    },

    mounted() {
        this.dropzone = new Dropzone(this.$refs.dropzone, {
            url: "/api/posts",
            autoProcessQueue: false,
            addRemoveLinks: true
        })
    },

    methods: {
        store() {
            const data = new FormData()
            const files = this.dropzone.getAcceptedFiles()
            files.forEach(file => {
                data.append('images[]', file)
                this.dropzone.removeFile(file)
            });
            data.append('title', this.title)
            data.append('content', this.content)
            this.title = ''
            this.content = ''
            axios.post('/api/posts', data)
                .then(res => {

                })
        },

        handleImageAdded(file, Editor, cursorLocation, resetUploader) {
            const formData = new FormData();
            formData.append("image", file);

            axios.post('/api/posts/images', formData)
                .then(result => {
                    const url = result.data.url; // Get url from response
                    Editor.insertEmbed(cursorLocation, "image", url);
                    resetUploader();
                })
                .catch(err => {
                    console.log(err);
                });
        }
    },

    components: {
        VueEditor
    },
}
</script>

<style lang="">
    
</style>
