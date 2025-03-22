<template lang="">
<div>
    <div v-if="posts">
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Preview</th>
                    <th scope="col">Content</th>
                    <th scope="col"></th>
                    <!-- <th scope="col"></th> -->
                </tr>
            </thead>
            <tbody>
                <template v-for="post in posts">
                    <tr>
                        <th scope="row">{{ post.id }}</th>
                        <td><a class="text-light" href="#" @click.prevent="this.$router.push({name: 'post.edit', params: { id: post.id }})">{{ post.title}}</a></td>
                        <td><img :src="post.images[0].preview_url"></td>
                        <td>{{ post.content }}</td>
                        <td><a href="#" @click.prevent="this.$router.push({name: 'post.edit', params: { id: post.id }})" class="btn btn-light">Edit</a></td>
                        <!-- <td><a href="#" @click.prevent="deletePerson(person.id)" class="btn btn-secondary">Delete</a></td> -->
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</div>
</template>

<script>
import axios from 'axios';

export default {
    name: "Create",

    data() {
        return {
            posts: null
        }
    },

    mounted() {
        this.getPosts()
    },

    methods: {
        getPosts() {
            axios.get('/api/posts')
                .then(res => {
                    this.posts = res.data.data
                    // console.log(this.posts); 
                    
                })
        }
    }
}
</script>

<style lang="">
    
</style>
