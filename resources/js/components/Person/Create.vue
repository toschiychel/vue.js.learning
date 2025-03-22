<template lang="">
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
        <button :disabled="!isDisabled" @click.prevent="store()" type="submit" class="btn btn-light">Отправить</button>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    name: "Create",

    data() {
        return {
            name: null,
            job: null,
            age: null
        }
    },

    methods: {
        store() {
            axios.post('/api/people', {name: this.name, age: this.age, job: this.job})
            .then( res => {
                this.name = null
                this.age = null
                this.job = null

                this.$router.push({ name: 'person.index' })
            })
        },
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