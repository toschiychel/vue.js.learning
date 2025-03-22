<template lang="">
<div>
    <div class="w-25">
        <div class="mb-3">
            <input type="text" v-model="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="name">
        </div>
        <div class="mb-3">
            <input type="number" v-model="age" class="form-control" id="exampleInputPassword1" placeholder="age">
        </div>
        <div class="mb-3">
            <input type="text" v-model="job" class="form-control" id="exampleInputPassword1" placeholder="job">
        </div>
        <button :disabled="!isDisabled" @click.prevent="update()" type="submit" class="btn btn-light">Update</button>
    </div>
</div>
</template>

<script>
import axios from 'axios';

export default {
    name: "Edit",

    data() {
        return {
            name: null,
            job: null,
            age: null,
            id: null
        }
    },

    methods: {
        getPerson() {
            axios.get(`/api/people/${this.$route.params.id}`)
                .then(res => {
                    this.name = res.data.data.name
                    this.age = res.data.data.age
                    this.job = res.data.data.job
                })
        },

        update() {
            axios.patch(`/api/people/${this.$route.params.id}`, {
                    name: this.name,
                    age: this.age,
                    job: this.job
                })
                .then(res => {
                    this.name = null
                    this.age = null
                    this.job = null

                    this.$router.push({
                        name: 'person.show',
                        params: {
                            id: this.$route.params.id
                        }
                    })
                })
        }
    },

    mounted() {
        this.getPerson()
    },

    computed: {
        isDisabled() {
            return this.name && this.age && this.job
        }
    }
}
</script>

<style lang="">
    
</style>
