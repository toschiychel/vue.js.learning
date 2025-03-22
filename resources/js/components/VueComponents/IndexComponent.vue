<template>
<div class="container">
    <table class="table">
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
                <ShowComponent :person="person"></ShowComponent>
                <EditComponent :person="person"></EditComponent>
            </template>
        </tbody>
    </table>
</div>
</template>

<script>
import axios from 'axios';
import EditComponent from './EditComponent.vue';
import ShowComponent from './ShowComponent.vue';
export default {
    name: "IndexComponent",

    data() {
        return {
            name: null,
            age: null,
            job: null,
            people: null,
            editPersonId: null
        }
    },

    methods: {
        getPeople() {
            axios.get('/api/people')
                .then(res => {
                    this.people = res.data
                })
        },

        changeEditPersonId(id, person) {
            this.editPersonId = id
            this.name = person.name
            this.age = person.age
            this.job = person.job
        },

        deletePerson(id) {
            axios.delete(`/api/people/${id}`)
            .then( res => {
                this.getPeople()
            })
        },
        
        isEdit(id) {
            return this.editPersonId === id
        },
    },

    computed: {

    },

    mounted() {

        this.getPeople()
    },

    components: {
        
    }
}
</script>
