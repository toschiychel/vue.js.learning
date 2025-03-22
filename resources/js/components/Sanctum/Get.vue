<template lang="">
    <div>
        This page is only for authenticated users
    </div>
</template>
<script>
import axios from 'axios';

export default {
    name: "Get",

    methods: {
        getData() {
            axios.get('/api/sanctum/get')
            .then( res => {
                // console.log(res);
                
            })
            .catch( err => {
                // console.log(err.response);
                
            })
        }
    },

    mounted() {
        this.getData()
    }
}
</script>
<style lang="">
    
</style>