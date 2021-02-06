<template>
    <span>
        <header>
                <nav-bar cor="green darken-1"
                         url="#">
                    <li v-if="usuario"><router-link to="/perfil">{{ usuario.name }}</router-link></li>
                    <li v-if="usuario"><a v-on:click="sair()">Sair</a></li>
                </nav-bar>
        </header>
        <main>
            <div class="container">
                <div class="row">
                    <grid tamanho="8">
                        <card-menu>
                            <slot name="menuEsquerdo"/>
                        </card-menu>
                    </grid>

                    <grid tamanho="4">
                        <slot name="principal"/>
                    </grid>
                </div>
            </div>
        </main>

        <rodape cor="green darken-1"
                titulo="Component Footer"
                descricao="Sistema de estudo relacionado ao curso da Udemy"
                copyrigth="© Estudo Udemy 2020">
            <ul>
                  <li v-if="!usuario"><router-link class="grey-text text-lighten-3" to="/login">Login</router-link></li>
                  <li v-if="!usuario"><router-link class="grey-text text-lighten-3"
                                                   to="/cadastro">Cadastro</router-link></li>
            </ul>
        </rodape>
    </span>

</template>

<script>
import Site from "./Site";
import Grid from "../components/layouts/Grid";
import Rodape from "../components/layouts/Rodape";
import NavBar from "../components/layouts/NavBar";
import CardMenu from "../components/layouts/CardMenu";

export default {
    name: "LoginTemplate",
    data() {
        return {
            usuario: false,
        }
    },
    components: {NavBar, Grid, Rodape, Site, CardMenu},
    created() {
        var self = this

        var aux = self.$store.getters.getUsuario
        if (aux) {
            self.$store.getters.getUsuario
            self.$router.push('/')
        }
    },
    methods: {}
}
</script>

<style scoped>

</style>
