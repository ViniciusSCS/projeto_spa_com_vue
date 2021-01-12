<template>
    <div class="row">
        <grid class="input-field" tamanho="12">
            <label for="conteudo">O que está acontecendo?</label>
            <textarea v-model="conteudo.texto" id="conteudo" class="materialize-textarea" data-length="120"></textarea>
            <input v-if="conteudo.texto" type="text" v-model="conteudo.link" placeholder="Link">
            <input v-if="conteudo.texto" type="text" v-model="conteudo.imagem" placeholder="URL ou Imagem">

        </grid>

        <grid v-if="conteudo.texto" tamanho="3 offset-s9">
            <button class="btn waves-effect waves-light left right-align" @click="publicar">
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
            },
        }
    },
    methods: {
        publicar() {
            var self = this

            //Verifica se a publicação possui espaços.
            if (self.conteudo.texto.trim() === '')
                console.log('Impossível publicar conteúdo!') //Ajustar mensagens
            else {
                self.$http.post(self.$urlApi + "conteudo/adicionar", {
                    link: self.conteudo.link,
                    texto: self.conteudo.texto,
                    imagem: self.conteudo.imagem,
                }, {"headers": {"authorization": "Bearer " + self.usuario.token}})
                    .then(response => {
                        if (response.data.status) {
                            console.log('Entra', response.data);
                            Swal.fire({
                                title: 'Deseja mesmo publicar conteúdo?',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                cancelButtonText: 'Não, mudei de Ideia!',
                                confirmButtonText: 'Sim, Publicar!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'success',
                                        title: 'Conteúdo publicado com sucesso!!',
                                        showConfirmButton: false,
                                        timer: 1500,
                                    })
                                    self.conteudo = response.data.conteudo
                                    sessionStorage.setItem('usuario', JSON.stringify(self.data.usuario))
                                }
                            })

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
                    });
            }
        }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
