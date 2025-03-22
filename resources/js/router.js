import * as VueRouter from "vue-router";

const router = VueRouter.createRouter ({
    history: VueRouter.createWebHistory('/'),
    routes: [
        {
            path: '/people',
            component: () => import('./components/Person/Index.vue'),
            name: 'person.index'
        },
        {
            path: '/people/create',
            component: () => import('./components/Person/Create.vue'),
            name: 'person.create'
        },
        {
            path: '/people/:id/edit',
            component: () => import('./components/Person/Edit.vue'),
            name: 'person.edit'
        },
        {
            path: '/people/:id',
            component: () => import('./components/Person/Show.vue'),
            name: 'person.show'
        },
        {
            path: '/posts',
            component: () => import('./components/Post/Index.vue'),
            name: 'post.index'
        },
        {
            path: '/posts/create',
            component: () => import('./components/Post/Create.vue'),
            name: 'post.create'
        },
        {
            path: '/posts/:id/edit',
            component: () => import('./components/Post/Edit.vue'),
            name: 'post.edit'
        },
        {
            path: '/sanctum/get',
            component: () => import('./components/Sanctum/Get.vue'),
            name: 'sanctum.get'
        },
        {
            path: '/sanctum/login',
            component: () => import('./components/Sanctum/Login.vue'),
            name: 'sanctum.login'
        },
        {
            path: '/sanctum/registration',
            component: () => import('./components/Sanctum/Registration.vue'),
            name: 'sanctum.registration'
        },
        {
            path: '/sanctum/personal',
            component: () => import('./components/Sanctum/Personal.vue'),
            name: 'sanctum.personal'
        }
    ],
})

// router.beforeEach( (to, from, next) => {
//     const authenticated = localStorage.getItem('authenticated')

//     if(!authenticated) {
//         if (to.name === 'sanctum.personal' || to.name === 'sanctum.get') {
//             return next({name: 'sanctum.login'})
//         }

//         next()
//     }

//     if(authenticated) {
//         if (to.name === 'sanctum.login' || to.name === 'sanctum.registration') {
//             return next({name: 'sanctum.personal'})
//         }

//         next()
//     }
// })

export default router
