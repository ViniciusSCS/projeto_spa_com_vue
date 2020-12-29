<template>
    <span>
        <header>
            <nav-bar cor="green darken-1"
                     logo="Sistema SPA"
                     url="http://engenheirocompvinicius.com.br">
                <li><router-link to="/">HOME</router-link></li>
                <li><router-link to="/login">LOGIN</router-link></li>
                <li><router-link to="/cadastro">CADASTRO</router-link></li>
            </nav-bar>
        </header>

        <main>
            <div class="container">
                <div class="row">
                    <grid tamanho="4">
                        <card-menu>
                            <div class="row valign-wrapper">
                                <slot name="menuEsquerdo"/>
                            </div>
                        </card-menu>
                    </grid>

                    <grid tamanho="8">
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
                  <li><router-link class="grey-text text-lighten-3" to="/">Home</router-link></li>
                  <li><router-link class="grey-text text-lighten-3" to="/login">Logn</router-link></li>
                  <li><router-link class="grey-text text-lighten-3" to="/cadastro">Cadastro</router-link></li>
            </ul>
        </rodape>

    </span>
</template>

<script>
import Grid from "@/components/layouts/Grid";
import NavBar from "@/components/layouts/NavBar";
import Rodape from "@/components/layouts/Rodape";
import CardMenu from "@/components/layouts/CardMenu";

export default {
    name: "Site",
    components: {CardMenu, NavBar, Grid, Rodape}
}
</script>

<style scoped>
#app {
    font-family: 'Avenir', Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    margin-top: 60px;
}
</style>
