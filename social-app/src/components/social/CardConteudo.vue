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
                                <strong>{{ nome }}</strong> - <small>{{ data }}</small>
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
                        <i class="material-icons">comment</i>{{ 22 }}
                    </a>
                </p>

                <p class="right-align" v-if="exibirComentarios">
                    <input type="text" placeholder="Comentário">
                    <button class="btn waves-effect waves-light blue"><i class="material-icons">send</i></button>
                </p>
                <ul class="collection" v-if="exibirComentarios">
                    <li class="collection-item avatar">
                        <img src="https://materializecss.com/images/yuna.jpg" alt="" class="circle">
                        <span class="title">Yuna <small> - 09h45 19/01/2021</small></span>
                        <p>Comentário Show!!</p>
                    </li>
                    <li class="collection-item avatar">
                        <img src="https://materializecss.com/images/yuna.jpg" alt="" class="circle">
                        <span class="title">Yuna <small> - 09h45 19/01/2021</small></span>
                        <p>Comentário Show!!</p>
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
        'totalcurtidas',
        'curtiuconteudo',
    ],
    data() {
        return {
            exibirComentarios: false,
            totalCurtidas: this.totalcurtidas,
            curtiu: this.curtiuconteudo ? 'favorite' : 'favorite_border'
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
        }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
