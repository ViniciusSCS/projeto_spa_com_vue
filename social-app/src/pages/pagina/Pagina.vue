<template>
    <site>
        <span slot="menuEsquerdo">
            <grid tamanho="4">
                <router-link :to="'/pagina/' + usuario.id + '/' + $slug(usuario.name, '_')">
                    <img :src="donoPagina.imagem" alt=""
                         class="circle responsive-img">
                </router-link>
            </grid>
            <grid tamanho="8">
                <span class="black-text">
                    <h5>{{ donoPagina.name }}</h5>
                    {{ donoPagina.description_user || '' }}
                    <button v-if="btnSeguir" @click="add_amigo(donoPagina.id)" class="btn">{{textBtnSeguir}}</button>
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
    name: 'Pagina',
    components: {Site, PublicarConteudo, Grid, CardDetalhe, CardConteudo},
    computed: {
        listaConteudos() {
            return this.$store.getters.getTimeline
        }
    },
    methods: {

        isAmigo(){
            var self = this

            self.textBtnSeguir

            for(let amigo of self.amigosLogado){
                if(amigo.id == self.donoPagina.id) {
                    self.textBtnSeguir = "Deixar de Seguir"
                    return
                }
            }
            self.textBtnSeguir
        },

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

        add_amigo(id) {
            var self = this
            self.$http.post(self.$urlApi + 'usuario/add_amigo/', {id: id},
                {"headers": {"authorization": "Bearer " + self.$store.getters.getToken}})
                .then(response => {
                    if (response.data.status) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Você está seguindo ' + self.donoPagina.name + ' com sucesso!!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        self.amigosLogado = response.data.amigos
                        self.isAmigo()
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
                            text: 'Erro ao seguir usuário!',
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
            amigos: [],
            amigosLogado: [],

            usuario: false,
            btnSeguir: false,
            textBtnSeguir: 'Seguir',
            controleScroll: false,
            urlProximaPagina: null,

            donoPagina:
                {
                    imagem: '',
                    name: ''
                },
        }
    },

    created() {
        var self = this

        var aux = self.$store.getters.getUsuario
        if (aux) {
            self.usuario = self.$store.getters.getUsuario
            self.$http.get(self.$urlApi + 'conteudo/pagina/listar/' + self.$route.params.id,
                {"headers": {"authorization": "Bearer " + self.$store.getters.getToken}})
                .then(function (response) {
                    if (response.data.status) {
                        self.$store.commit('setTimeline', response.data.conteudos.data)
                        self.urlProximaPagina = response.data.conteudos.next_page_url
                        self.donoPagina = response.data.dono
                        if (self.donoPagina.id != self.usuario.id)
                            self.btnSeguir = true

                        self.$http.get(self.$urlApi + 'usuario/amigos/' + self.donoPagina.id,
                            {"headers": {"authorization": "Bearer " + self.$store.getters.getToken}})
                            .then(function (response) {
                                if (response.data.status) {
                                    self.amigos = response.data.amigos
                                    self.amigosLogado = response.data.amigosLogado
                                    self.isAmigo();
                                } else {
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
