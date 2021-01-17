// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import Vuex from 'vuex'
import axios from 'axios'
import router from './router'

Vue.use(Vuex)

Vue.config.productionTip = false

Vue.prototype.$http = axios
Vue.prototype.$urlApi = 'http://localhost:8000/api/'

var store = {
    state: {
        usuario: sessionStorage.getItem('usuario') ?
            JSON.parse(sessionStorage.getItem('usuario')) : null,
        timeline: []
    },
    getters: {
        getUsuario: state => {
            return state.usuario
        },
        getToken: state => {
            return state.usuario.token
        },
        getTimeline: state => {
            return state.timeline
        }
    },
    mutations: {
        setUsuario(state, n){
            state.usuario = n
        },
        setTimeline(state, n){
            state.timeline = n
        },
    },
}

/* eslint-disable no-new */
new Vue({
    el: '#app',
    router,
    components: {App},
    template: '<App/>',
    store: new Vuex.Store(store)
})
