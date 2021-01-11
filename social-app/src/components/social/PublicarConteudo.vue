<template>
    <div class="row">
        <grid class="input-field" tamanho="12">
            <input type="text" v-model="conteudo.titulo">
            <label for="conteudo">O que está acontecendo?</label>
            <textarea v-if="conteudo.titulo" placeholder="Conteúdo" v-model="conteudo.texto" id="conteudo" class="materialize-textarea" data-length="120"></textarea>
            <input v-if="conteudo.titulo && conteudo.texto" type="text" v-model="conteudo.link" placeholder="Link">
            <input v-if="conteudo.titulo && conteudo.texto" type="text" v-model="conteudo.imagem" placeholder="URL ou Imagem">

        </grid>
        <p>
            <grid v-if="conteudo.titulo && conteudo.texto" tamanho="3 offset-s10">
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
            conteudo: {
                link: '',
                texto: '',
                titulo: '',
                imagem: '',
            },
        }
    },
    methods: {
        publicar: function () {
            var self = this

            //Verifica se a publicação possui espaços.
            if(self.conteudo.titulo.trim() === '')
                console.log('Impossível publicar conteúdo!') //Ajustar mensagens
            else
                console.log('Conteúdo publicado.: ', self.conteudo.titulo.trim()) //Ajustar mensagens
        }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
