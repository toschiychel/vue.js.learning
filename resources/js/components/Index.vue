<template>
<div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navigation</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Переключатель навигации">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'person.index' }">Users</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'person.create' }">Add User</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'post.index' }">Posts</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'post.create' }">New Post</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link v-if="authenticated" class="nav-link" :to="{ name: 'sanctum.get' }">Get</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link v-if="!authenticated" class="nav-link" :to="{ name: 'sanctum.login' }">Login</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link v-if="!authenticated" class="nav-link" :to="{ name: 'sanctum.registration' }">Registration</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link v-if="authenticated" class="nav-link" :to="{ name: 'sanctum.personal' }">Personal</router-link>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" v-if="authenticated" href="#" @click.prevent="logout()">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <router-view :key="$route.fullPath"></router-view>
</div>
</template>

<script>
export default {
    name: "Index",

    data() {
        return {
            authenticated: null
        }
    },

    methods: {
        logout() {
            axios.post('/logout')
                .then(res => {
                    localStorage.removeItem('authenticated')
                    this.$router.push({
                        name: 'sanctum.login'
                    })
                })
        },

        isAuthenticated() {
            this.authenticated = localStorage.getItem('authenticated')
        }
    },

    mounted() {
        this.isAuthenticated()
    },

    updated() {
        this.isAuthenticated()
    }
}
</script>
