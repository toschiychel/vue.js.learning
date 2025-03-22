<template lang="">
<div>
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Имя</th>
                <th scope="col">Возраст</th>
                <th scope="col">Работа</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <template v-for="person in people">
                <tr>
                    <th scope="row">{{ person.id }}</th>
                    <td><a class="text-light" href="#" @click.prevent="this.$router.push({name: 'person.edit', params: { id: person.id }})">{{ person.name}}</a></td>
                    <td>{{ person.age }}</td>
                    <td>{{ person.job }}</td>
                    <td><a href="#" @click.prevent="this.$router.push({name: 'person.edit', params: { id: person.id }})" class="btn btn-light">Edit</a></td>
                    <td><a href="#" @click.prevent="deletePerson(person.id)" class="btn btn-secondary">Delete</a></td>
                </tr>
            </template>
        </tbody>
    </table>
</div>
</template>

<script>
import axios from 'axios';

export default {
    name: "Index",

    data() {
        return {
            people: null
        }
    },

    methods: {
        getPeople() {
            axios.get('/api/people')
            .then( res => {
                this.people = res.data.data
            })
        },
        
        deletePerson(id) {
            axios.delete(`/api/people/${id}`)
            .then( res => {
                this.getPeople()
            })
        }
    },

    mounted() {
        this.getPeople()
    }
}
</script>

<style lang="">
    
</style>
