<template lang="">
<div class="w-25">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Адрес электронной почты</label>
        <input v-model="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text text-light">Мы никогда никому не передадим вашу электронную почту.</div>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Пароль</label>
        <input v-model="password" type="password" class="form-control" id="exampleInputPassword1">
    </div>
    <button type="submit" @click.prevent="login()" class="btn btn-primary">Войти</button>
</div>
</template>

<script>
import axios from 'axios';

export default {
    name: "Login",

    data() {
        return {
            email: '',
            password: ''
        }
    },

    methods: {
        login() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/login', {email: this.email, password: this.password
                    })
                    .then(res => {
                        // console.log(res);
                        localStorage.setItem('authenticated', true)
                        this.$router.push({name: 'sanctum.personal'})
                        
                    })
            });

        }
    }
}
</script>

<style lang="">
    
</style>
