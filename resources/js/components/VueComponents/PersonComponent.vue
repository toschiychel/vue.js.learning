<template>
<div class="container">
    <IndexComponent ref="index"></IndexComponent>
    <CreateComponent></CreateComponent>
</div>
</template>

<script>
import axios from 'axios';
import CreateComponent from './CreateComponent.vue';
import IndexComponent from './IndexComponent.vue';
export default {
    name: "PersonComponent",

    data() {
        return {

        }
    },

    methods: {

    },

    computed: {

    },

    mounted() {
        
    },

    components: {
        CreateComponent, IndexComponent
    }
}
</script>
