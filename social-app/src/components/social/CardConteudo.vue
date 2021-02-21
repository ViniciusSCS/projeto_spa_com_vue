<template>
    <div class="row">
        <div class="card">
            <div class="card-content">
                <div class="row valign-wrapper">
                    <grid tamanho="1">
                        <img :src="perfil"
                             :alt="nome"
                             class="circle responsive-img">
                        <!-- notice the "circle" class -->
                    </grid>
                    <grid tamanho="11">
                        <span class="black-text">
                            <router-link :to="'/pagina/'+usuario">
                                <strong>{{ nome }}</strong>
                            </router-link>
                             - <small>{{ data }}</small>
                        </span>
                    </grid>
                </div>

                <slot/>

            </div>
            <div class="card-action">
                <p>
                    <a style="cursor: pointer" @click="curtida(id)">
                        <i class="material-icons">{{ curtiu }}</i>{{ totalCurtidas }}
                    </a>

                    <a style="cursor: pointer" @click="abreComentario(id)">
                        <i class="material-icons">comment</i>{{ listaComentarios.length }}
                    </a>
                </p>

                <p class="right-align" v-if="exibirComentarios">
                    <input type="text" placeholder="Comentário" v-model="textoComentario">
                    <button v-if="textoComentario" class="btn waves-effect waves-light blue"
                            @click="enviarComentario(id)">
                        <i class="material-icons">send</i>
                    </button>
                </p>
                <ul class="collection" v-if="exibirComentarios">
                    <li class="collection-item avatar" v-for="item in comentarios" :key="item.id">
                        <img :src="item.user.imagem" alt="" class="circle">
                        <span class="title">
                            {{ item.user.name }}<small> - {{ item.data }}</small>
                        </span>
                        <p>{{ item.texto }}</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
import Grid from "../layouts/Grid";

export default {
    name: 'CardConteudo',
    components: {Grid},
    props: [
        'id',
        'nome',
        'data',
        'perfil',
        'usuario',
        'totalcurtidas',
        'curtiuconteudo',
        'comentarios',
    ],
    data() {
        return {
            textoComentario: '',
            exibirComentarios: false,
            totalCurtidas: this.totalcurtidas,
            listaComentarios: this.comentarios || [],
            curtiu: this.curtiuconteudo ? 'favorite' : 'favorite_border',
        }
    },
    methods: {
        curtida(id) {
            var self = this

            self.$http.put(self.$urlApi + 'conteudo/curtir/' + id, {},
                {"headers": {"authorization": "Bearer " + self.$store.getters.getToken}})
                .then(response => {
                    if (response.status) {
                        self.totalCurtidas = response.data.curtidas
                        self.$store.commit('setTimeline', response.data.lista.conteudos.data)
                        if (self.curtiu == 'favorite_border') {
                            self.curtiu = 'favorite'
                        } else {
                            self.curtiu = 'favorite_border'
                        }
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
                            text: 'Erro ao curtir conteúdo!',
                        })
                    }
                })
                .catch(function (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'ERRO, tente novamente mais tarde!',
                    })
                })

        },

        abreComentario(id) {
            var self = this
            self.exibirComentarios = !self.exibirComentarios
        },

        enviarComentario(id) {
            var self = this

            if (self.textoComentario.trim() === '') {

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Impossível comentar!',
                })
            } else {
                self.$http.put(self.$urlApi + 'conteudo/comentar/' + id, {texto: self.textoComentario},
                    {"headers": {"authorization": "Bearer " + self.$store.getters.getToken}})
                    .then(response => {
                        if (response.status) {

                            self.$store.commit('setTimeline', response.data.lista.conteudos.data)
                            self.textoComentario = ''

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
                                text: 'Erro ao comentar nesse conteúdo!',
                            })
                        }
                    })
                    .catch(function (error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'ERRO, tente novamente mais tarde!',
                        })
                    })

            }
        }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
