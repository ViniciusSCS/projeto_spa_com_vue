<template>
    <span>
        <header>
            <nav-bar cor="green darken-1" logo="Sistema SPA" url="http://engenheirocompvinicius.com.br"/>
        </header>

        <main>
            <div class="container">
                <div class="row">
                    <grid tamanho="4">
                        <card-menu>
                            <div class="row valign-wrapper">
                                <grid tamanho="4">
                                    <img src="http://engenheirocompvinicius.com.br/assets/img/vscs.png" alt=""
                                    class="circle responsive-img">
                                    <!-- notice the "circle" class -->
                                </grid>
                                <grid tamanho="8">
                                    <span class="black-text">
                                        <h5>Vinícius Sarmento</h5>
                                        Add the "circle" class to it to make it appear circular.
                                    </span>
                                </grid>
                            </div>
                        </card-menu>
                    </grid>
                    <grid tamanho="8">
                        <home/>
                    </grid>
                </div>
            </div>
        </main>

        <rodape cor="green darken-1"
                titulo="Component Footer"
                descricao="Sistema de estudo relacionado ao curso da Udemy"
                copyrigth="© Estudo Udemy 2020">
            <ul>
                  <li><a class="grey-text text-lighten-3" href="#!">Home</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
            </ul>
        </rodape>

    </span>
</template>

<script>

import Home from "@/pages/home/Home";
import Grid from "@/components/layouts/Grid";
import NavBar from "@/components/layouts/NavBar";
import Rodape from "@/components/layouts/Rodape";
import CardMenu from "@/components/layouts/CardMenu";

export default {
    name: 'App',
    components: {CardMenu, Grid, Rodape, Home, NavBar},
}
</script>

<style>
#app {
    font-family: 'Avenir', Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    margin-top: 60px;
}
</style>
