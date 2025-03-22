<template lang="">
<div class="mb-3">
    <input type="text" v-model="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="title">
</div>
<div ref="dropzone" class=" btn p-5 bg-light text-center text-dark w-25 mb-3">
    Upload
</div>
<div class="mb-3">
    <vue-editor useCustomImageHandler @image-removed="handleImageRemoved" @image-added="handleImageAdded" v-model="content" />
</div>
<div>
    <button class="btn btn-light" @click.prevent="update()">Update</button>
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
            content: null,
            post: null,
            imagesIdsForDelete: [],
            imagesUrlsForDelete: []
        }
    },

    mounted() {
        this.dropzone = new Dropzone(this.$refs.dropzone, {
            url: "/api/posts",
            autoProcessQueue: false,
            addRemoveLinks: true
        }),

        this.dropzone.on('removedfile', (file) => {
            this.imagesIdsForDelete.push(file.id)
            
        })

        this.getPost()
    },

    methods: {
        update() {
            if (!this.title || !this.content) {
                alert("Title and content are required.");
                return;
            }
            const data = new FormData()
            const files = this.dropzone.getAcceptedFiles()
            files.forEach(file => {
                data.append('images[]', file)
                this.dropzone.removeFile(file)
            });
            data.append('title', this.title)
            data.append('content', this.content)
            this.imagesIdsForDelete.forEach( idForDelete => {
                data.append('image_ids_for_delete[]', idForDelete)
            })
            this.imagesUrlsForDelete.forEach( urlForDelete => {
                data.append('image_urls_for_delete[]', urlForDelete)
            })
            data.append('_method', 'PATCH')
            // console.log(data); 
            axios.post(`/api/posts/${this.$route.params.id}`, data)
                .then(res => {
                    this.title = '';
                    this.content = '';

                    this.dropzone.previewsContainer
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
        },

        handleImageRemoved(url) {
            this.imagesUrlsForDelete.push(url)
            
        },

        getPost() {
            axios.get(`/api/posts/${this.$route.params.id}`)
                .then(res => {
                    this.post = res.data.data
                    this.title = res.data.data.title
                    this.content = res.data.data.content
                    this.post.images.forEach(image => {
                        let file = {
                            id: image.id,
                            name: image.name,
                            size: image.size,
                        };
                        this.dropzone.displayExistingFile(file, image.preview_url);
                    })
                })
        }
    },

    components: {
        VueEditor
    },
}
</script>

<style lang="">
    
</style>
