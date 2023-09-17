import { createWebHashHistory, createRouter } from "vue-router";

import home from './pages/home.vue';
import login from './pages/login.vue';
import register from './pages/register.vue';
import dashboard from './pages/dashboard.vue';
import adminLayout from './layouts/adminLayout.vue';
import hostel from './pages/hostel/index.vue';



const routes=[

    {
        path:"/admin",
        name:'Admin',
        component:adminLayout,
        redirect:'/',
        meta:{requiresAuth:true},
        children:[
            {
                path:"/dashboard",
                name:'Dashboard',
                component:dashboard,
               
            },
            {
                path:"/home",
                name:'Home',
                component:home
            },
            {
                path:"/hostel",
                name:'Hostel',
                component:hostel
            },

        ]
    },
    // {
    //     path:"/home",
    //     name:'Home',
    //     component:home
    // },
    {
        path:"/",
        name:'Login',
        component:login,
        meta:{requiresAuth:false}
    },
    {
        path:"/register",
        name:'Register',
        component:register,
        meta:{requiresAuth:false}
    },
    // {
    //     path:"/dashboard",
    //     name:'Dashboard',
    //     component:dashboard,
    //     meta:{
    //         requiresAuth:true,
    //         layout:'default'
    //     }
    // },






];

const router = createRouter({
    history:createWebHashHistory(),
    routes
});

router.beforeEach((to,from)=>{
    if(to.meta.requiresAuth && !localStorage.getItem('token')){
        return {name:'Login'}
    }
    if(to.meta.requiresAuth == false && localStorage.getItem('token')){
        return {name:'Dashboard'}
    }
})

export default router;