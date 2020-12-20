<template>
    <footer :class="'page-footer ' + cor">
        <div class="container">
            <div class="row">
                <grid tamanho="12 l6">
                    <h5 class="white-text">{{ titulo }}</h5>
                    <p class="grey-text text-lighten-4">{{ descricao }}</p>
                </grid>
                <grid tamanho="12 l4 offset-l2">
                    <h5 class="white-text">Links</h5>
                    <ul>
                        <slot/>
                    </ul>
                </grid>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                {{ copyrigth }}
            </div>
        </div>
    </footer>
</template>

<script>
import Grid from "./Grid";
export default {
    name: 'Rodape',
    components: {Grid},
    props: [
        'cor',
        'url',
        'logo',
        'titulo',
        'copyrigth',
        'descricao',
    ],
    data() {
        return {}
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
