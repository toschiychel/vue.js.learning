<template>
<div class="container">
    <form>
        <div class="mb-3">
            <input type="text" v-model="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="name">
        </div>
        <div class="mb-3">
            <input type="number" v-model="age" class="form-control" id="exampleInputPassword1" placeholder="age">
        </div>
        <div class="mb-3">
            <input type="text" v-model="job" class="form-control" id="exampleInputPassword1" placeholder="job">
        </div>
        <button @click.prevent="addPerson()" type="submit" class="btn btn-primary">Отправить</button>
    </form>
</div>
</template>

<script>
import axios from 'axios';

export default {
    name: "CreateComponent",


    data() {
        return {
            name: null,
            age: null,
            job: null
        }
    },
    
    methods: {
        addPerson() {
            axios.post('/api/people', {name: this.name, age: this.age, job: this.job})
            .then( res => {
                this.name = null
                this.job = null
                this.age = null
                this.$parent.$refs.index.getPeople()
            })
        }
    },
    
    mounted() {
        
    }
}
</script>
