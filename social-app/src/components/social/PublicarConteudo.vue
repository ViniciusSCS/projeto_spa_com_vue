<template>
    <div class="row">
        <grid class="input-field" tamanho="12">
            <textarea v-model="conteudo" id="conteudo" class="materialize-textarea" data-length="120"></textarea>
            <label for="conteudo">O que está acontecendo?</label>
        </grid>
        <p>
            <grid v-if="conteudo" tamanho="3 offset-s10">
                <button  class="btn waves-effect waves-light left" v-on:click="publicar">
                    <i class="material-icons left" >send</i> PUBLICAR
                </button>
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
    },
    methods: {
        publicar: function () {
            var self = this

            //Verifica se a publicação possui espaços.
            if(self.conteudo.trim() === '')
                console.log('Impossível publicar conteúdo!') //Ajustar mensagens
            else
                console.log('Conteúdo publicado.: ', self.conteudo.trim()) //Ajustar mensagens
        }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
