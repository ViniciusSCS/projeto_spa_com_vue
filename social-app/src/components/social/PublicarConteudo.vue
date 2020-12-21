<template>
    <div class="row">
        <grid class="input-field" tamanho="12">
            <textarea v-model="conteudo" id="conteudo" class="materialize-textarea" data-length="120"></textarea>
            <label for="conteudo">O que está acontecendo?</label>
        </grid>
        <p>
            <grid v-if="conteudo" class="btn waves-effect waves-light" tamanho="2 offset-s10">
                <i class="material-icons left">send</i> PUBLICAR
            </grid>
        </p>
    </div>
</template>

<script>
import Grid from "../layouts/Grid";

export default {

    name: 'PublicarConteudo',
    components: {Grid},
    props: [],
    data() {
        return {
            conteudo: '',
        }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
