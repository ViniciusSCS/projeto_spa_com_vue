<template>
    <site>
        <span slot="menuEsquerdo">
            <grid tamanho="4">
                <img :src="usuario.imagem" alt=""
                     class="circle responsive-img">
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

        <span slot="principal">
            <publicar-conteudo/>
            <card-conteudo :perfil="usuario.imagem"
                           :nome="usuario.name"
                           data="19/12/2020 00:10">

                <card-detalhe
                    url_imagem="https://cdn.pixabay.com/photo/2017/01/29/13/20/mobile-devices-2017978_1280.png"
                    texto="Desenvolvimento Web!!"/>

            </card-conteudo>

            <card-conteudo :perfil="usuario.imagem"
                           :nome="usuario.name"
                           data="18/12/2020 23:58">

                <card-detalhe url_imagem="https://s1.1zoom.me/b6742/381/Sky_Night_Moon_Clouds_542827_1920x1080.jpg"
                              texto="Noite top!!"/>

            </card-conteudo>
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
    data() {
        return {
            usuario: false,
        }
    },
    created() {
        var self = this

        var aux = sessionStorage.getItem('usuario')
        if (aux) {
            self.usuario = JSON.parse(aux)
        } else {
            self.$router.push('/login')
        }
    },
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
