require('./bootstrap');

import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'
import VueRouter from 'vue-router'

Vue.use(BootstrapVue)
Vue.use(VueRouter)

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import Signup from './components/SignUp.vue'
import Signin from './components/SignIn.vue'
import Myfooter from './components/Footer.vue'

const routes = [
    { path: '/', component: Signup },
    { path: '/signin', component: Signin }
]

const router = new VueRouter({
    mode: 'history', 
    routes // short for `routes: routes`
})

const app = new Vue({
    el: '#app',
    router,
    components:{
        Myfooter
    }
});
