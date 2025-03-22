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
            <template v-if="person">
                <tr>
                    <th scope="row">{{ person.id }}</th>
                    <td>{{ person.name}}</td>
                    <td>{{ person.age }}</td>
                    <td>{{ person.job }}</td>
                    <td><a href="#" class="btn btn-light">Edit</a></td>
                    <td><a href="#" class="btn btn-secondary">Delete</a></td>
                </tr>
            </template>
        </tbody>
    </table>
    </div>
</template>
<script>
export default {
    name: "Show",

    data() {
        return {
            person: null
        }
    },

    methods: {
        getPerson() {
            axios.get(`/api/people/${this.$route.params.id}`)
            .then(res => {
                this.person = res.data.data
            })
        },
    },

    mounted() {
        this.getPerson()
    }
}
</script>
<style lang="">
    
</style>