<template>
    <site>
        <span slot="menuEsquerdo">
            <grid tamanho="4">
                <router-link :to="'/pagina/' + usuario.id + '/' + $slug(usuario.name, '_')">
                    <img :src="usuario.imagem" alt=""
                         class="circle responsive-img">
                </router-link>
            </grid>
            <grid tamanho="8">
                <span class="black-text">
                    <h5>{{ usuario.name }}</h5>
                    {{ usuario.description_user || '' }}
                </span>
            </grid>
            <span>
                <router-link to="/perfil" style="font-size: small; text-align: center">Alterar Perfil</router-link>
            </span>
        </span>

        <span slot="menuEsquerdoAmigos">
            <h2>Seguindo</h2>
            <li v-if="!amigos.length">Nenhum amigo</li>
            <li v-for="item in amigos" :key="item.id">
                <router-link :to="'/pagina/' + item.id + '/' + $slug(item.name, '_')">
                    {{item.name}}
                </router-link>
            </li>
        </span>

        <span slot="menuEsquerdoAmigos">
            <h2>Seguidores</h2>
            <li v-if="!seguidores.length">Nenhum seguidor</li>
            <li v-for="item in seguidores" :key="item.id">
                <router-link :to="'/pagina/' + item.id + '/' + $slug(item.name, '_')">
                    {{item.name}}
                </router-link>
            </li>
        </span>

        <span slot="principal">
            <publicar-conteudo/>

             <card-conteudo v-for="item in listaConteudos"
                            :key="item.id"
                            :id="item.id"
                            :data="item.data"
                            :nome="item.user.name"
                            :usuario="item.user.id"
                            :perfil="item.user.imagem"
                            :comentarios="item.comentarios"
                            :totalcurtidas="item.total_curtidas"
                            :curtiuconteudo="item.curtiu_conteudo"
             >

                <card-detalhe :url_imagem="item.imagem"
                              :texto="item.texto"
                              :link="item.link"
                              :perfil="item.perfil"
                />

            </card-conteudo>
            <div v-scroll="handleScroll"/>
        </span>
    </site>
</template>

<script>
import Site from "@/templates/Site";
import Grid from "@/components/layouts/Grid";
import CardDetalhe from "@/components/social/CardDetalhe";
import CardConteudo from "@/components/social/CardConteudo";
import PublicarConteudo from "@/components/social/PublicarConteudo";

export default {
    name: 'Home',
    components: {Site, PublicarConteudo, Grid, CardDetalhe, CardConteudo},
    computed: {
        listaConteudos() {
            return this.$store.getters.getTimeline
        }
    },
    methods: {
        handleScroll() {
            var self = this
            var tamanhoTela = document.body.clientHeight - window.scrollY

            if (self.controleScroll) {
                return;
            }
            if (window.scrollY >= tamanhoTela) {
                self.controleScroll = true
                self.carregaPagina()
            }
        },

        carregaPagina() {
            var self = this

            if (!self.urlProximaPagina) {
                return
            }

            self.$http.get(self.urlProximaPagina,
                {"headers": {"authorization": "Bearer " + self.$store.getters.getToken}})
                .then(function (response) {
                    if (response.data.status) {
                        self.$store.commit('setPaginacaoTimeline', response.data.conteudos.data)
                        self.urlProximaPagina = response.data.conteudos.next_page_url
                        self.controleScroll = false
                    }
                })
                .catch(e => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'ERRO, tente novamente mais tarde!',
                    })
                })
        },
    },

    data() {
        return {
            usuario: {
                imagem: '',
                name: ''
            },
            amigos: [],
            seguidores: [],
            urlProximaPagina: null,
            controleScroll: false,
        }
    },

    created() {
        var self = this

        var aux = self.$store.getters.getUsuario
        if (aux) {
            self.usuario = self.$store.getters.getUsuario
            self.$http.get(self.$urlApi + 'conteudo/listar',
                {"headers": {"authorization": "Bearer " + self.$store.getters.getToken}})
                .then(function (response) {
                    if (response.data.status) {
                        self.$store.commit('setTimeline', response.data.conteudos.data)
                        self.urlProximaPagina = response.data.conteudos.next_page_url

                        self.$http.get(self.$urlApi + 'usuario/amigos',
                            {"headers": {"authorization": "Bearer " + self.$store.getters.getToken}})
                            .then(function (response) {
                                if (response.data.status) {
                                    self.amigos = response.data.amigos
                                    self.seguidores = response.data.seguidores
                                }else{
                                    sweetAlert(response.data.erro)
                                }
                            })
                            .catch(e => {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'ERRO, tente novamente mais tarde!',
                                })
                            })
                    }
                })
                .catch(e => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'ERRO, tente novamente mais tarde!',
                    })
                })
        } else {
            self.$router.push('/login')
        }
    },
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
