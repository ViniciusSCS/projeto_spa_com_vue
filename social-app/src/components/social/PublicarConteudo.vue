<template>
    <div class="row">
        <grid class="input-field" tamanho="12">
            <label for="conteudo">O que está acontecendo?</label>
            <textarea v-model="conteudo.texto" id="conteudo" class="materialize-textarea" data-length="120"></textarea>
            <input v-if="conteudo.texto" type="text" v-model="conteudo.link" placeholder="Link">
            <input v-if="conteudo.texto" type="text" v-model="conteudo.imagem" placeholder="URL ou Imagem">

        </grid>

        <grid v-if="conteudo.texto" tamanho="3 offset-s9">
            <button class="btn waves-effect waves-light left right-align" @click="publicar()">
                <i class="material-icons left">send</i> PUBLICAR
            </button>
        </grid>
    </div>
</template>

<script>
import Grid from "../layouts/Grid";

export default {

    name: 'PublicarConteudo',
    components: {Grid},
    props: [
        'usuario',
    ],
    data() {
        return {
            conteudo: {
                link: '',
                texto: '',
                imagem: '',
                user_id: this.usuario
            },
        }
    },
    methods: {
        publicar() {
            var self = this

            //Verifica se a publicação possui espaços.
            if (self.conteudo.texto.trim() === '') {
                console.log('Impossível publicar conteúdo!') //Ajustar mensagens
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Impossível publicar conteúdo!',
                })
            } else {
                self.$http.post(self.$urlApi + 'conteudo/adicionar', {
                    link: self.conteudo.link,
                    texto: self.conteudo.texto,
                    imagem: self.conteudo.imagem,
                    usuario: self.usuario
                }, {"headers": {"authorization": "Bearer " + self.usuario.token}})
                    .then(function (response) {
                        if (response.data.status) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Conteúdo publicado com sucesso!!',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            self.conteudo.link = ''
                            self.conteudo.texto = ''
                            self.conteudo.imagem = ''
                        } else if (response.data.status == false && response.data.validacao) {
                            var erros = '';
                            for (var e of Object.values(response.data.erros)) {
                                erros += e + ' ';
                            }
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Erro: ' + erros,
                            })

                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Erro ao publicar conteúdo!',
                            })
                        }
                    })
                    .catch(function (error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'ERRO, tente novamente mais tarde!',
                        })
                    });
            }
        }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
