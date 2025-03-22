<template lang="">
<div>
    <div class="w-25">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Имя</label>
            <input v-model="name" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Адрес электронной почты</label>
            <input v-model="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text text-light">Мы никогда никому не передадим вашу электронную почту.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Пароль</label>
            <input v-model="password" type="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Подтвердите пароль</label>
            <input v-model="password_confirmation" type="password" class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" @click.prevent="register()" class="btn btn-primary">Зарегистрироваться</button>
    </div>
</div>
</template>

<script>
import axios from 'axios';

export default {
    name: "Registration",

    data() {
        return {
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
        }
    },

    methods: {
        register() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/register', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                })
                .then( res => {
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
