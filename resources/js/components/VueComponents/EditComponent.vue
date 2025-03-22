<template>
<tr :class="this.$parent.isEdit(person.id) ? '' : 'd-none'">
    <th scope="row">{{ person.id }}</th>
    <td><input type="text" v-model="name" class="form-control"></td>
    <td><input type="age" v-model="age" class="form-control"></td>
    <td><input type="text" v-model="job" class="form-control"></td>
    <td><a href="#" class="btn btn-success" @click.prevent="updatePerson(person.id)">Update</a></td>
    <td><a href="#" class="btn btn-danger" @click.prevent="this.$parent.deletePerson(person.id)">Delete</a></td>
</tr>
</template>

<script>
export default {
    name: "EditComponent",

    data() {
        return {
            name: null,
            age: null,
            job: null
        }
    },

    methods: {
        updatePerson(id) {
            axios.patch(`/api/people/${id}`, {
                    name: this.name,
                    age: this.age,
                    job: this.job
                })
                .then(res => {
                    console.log(res)
                })
                .finally(res => {
                    this.$parent.editPersonId = null
                    this.$parent.getPeople()
                })
        },

        getPerson() {
            this.name = this.person.name
            this.age = this.person.age
            this.job = this.person.job
        }
    },

    computed: {

    },

    props: [
        'person'
    ],

    mounted() {
        this.getPerson()
    },

    components: {

    }
}
</script>
