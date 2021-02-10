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
        timeline: [],
        titulo: 'Sistema SPA - Rede Social',
        usuario: sessionStorage.getItem('usuario') ?
            JSON.parse(sessionStorage.getItem('usuario')) : null
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
        },

        getTitulo: state => {
            return state.titulo
        },
    },
    mutations: {
        setUsuario(state, n) {
            state.usuario = n
        },

        setTimeline(state, n) {
            state.timeline = n
        },

        setPaginacaoTimeline(state, lista) {
            for (var item of lista)
                state.timeline.push(item)
        },
    },
}

Vue.directive('scroll', {
    inserted: function (el, binding) {
        let f = function (evt) {
            if (binding.value(evt, el)) {
                window.removeEventListener('scroll', f)
            }
        }
        window.addEventListener('scroll', f)
    }
})

/* eslint-disable no-new */
new Vue({
    el: '#app',
    router,
    components: {App},
    template: '<App/>',
    store: new Vuex.Store(store)
})
