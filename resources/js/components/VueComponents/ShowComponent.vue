<template>
<tr :class="this.$parent.isEdit(person.id) ? 'd-none' : ' ' ">
    <th scope="row">{{ person.id }}</th>
    <td>{{ person.name}}</td>
    <td>{{ person.age }}</td>
    <td>{{ person.job }}</td>
    <td><a href="#" class="btn btn-success" @click.prevent="this.$parent.changeEditPersonId(person.id, person)">Edit</a></td>
    <td><a href="#" class="btn btn-danger" @click.prevent="this.$parent.deletePerson(person.id)">Delete</a></td>
</tr>
</template>

<script>
export default {
    name: "ShowComponent",

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

    },

    computed: {

    },

    mounted() {

    },

    props: [
        'person'
    ],

    components: {

    }
}
</script>
