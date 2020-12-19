<template>
    <span>
        <header>
                <nav-bar cor="green darken-1"
                         logo="Sistema SPA"
                         url="http://engenheirocompvinicius.com.br"/>
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
                  <li><a class="grey-text text-lighten-3" href="#!">Home</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
            </ul>
        </rodape>
    </span>

</template>

<script>
import CardMenu from "../components/layouts/CardMenu";
import Site from "./Site";
import Rodape from "../components/layouts/Rodape";
import Grid from "../components/layouts/Grid";
import NavBar from "../components/layouts/NavBar";
export default {
    name: "LoginTemplate",
    components: {NavBar, Grid, Rodape, Site, CardMenu}
}
</script>

<style scoped>

</style>
