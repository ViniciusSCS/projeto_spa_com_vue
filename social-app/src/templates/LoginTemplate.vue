<template>
    <span>
        <header>
            <nav-bar cor="green darken-1" logo="Sistema SPA" url="http://engenheirocompvinicius.com.br"/>
        </header>

        <main>
            <div class="container">
                <div class="row">
                    <grid tamanho="6">

                    </grid>

                    <grid tamanho="6">
                        <slot/>
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
export default {
    name: "LoginTemplate"
}
</script>

<style scoped>

</style>
