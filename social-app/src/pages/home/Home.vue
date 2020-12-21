<template>
    <site>
        <span slot="menuEsquerdo">
            <grid tamanho="4">
                <img src="http://engenheirocompvinicius.com.br/assets/img/vscs.png" alt=""
                     class="circle responsive-img">
            </grid>
            <grid tamanho="8">
                <span class="black-text">
                    <h5>Vinícius Sarmento</h5>
                    Engenheiro de Computação | Desenvolvedor WEB
                </span>
            </grid>
        </span>

        <span slot="principal">

            <publicar-conteudo/>

            <card-conteudo perfil="http://engenheirocompvinicius.com.br/assets/img/vscs.png"
                           nome="Vinícius Sarmento"
                           data="19/12/2020 00:10">

                <card-detalhe url_imagem="https://www.torredevigilancia.com/wp-content/uploads/2019/10/coringa-55.jpg"
                              texto="Melhor filme de 2020!!"
                              titulo="Card Title"/>

            </card-conteudo>


            <card-conteudo perfil="http://engenheirocompvinicius.com.br/assets/img/vscs.png"
                           nome="Vinícius Sarmento"
                           data="18/12/2020 23:58">

                <card-detalhe url_imagem="https://s1.1zoom.me/b6742/381/Sky_Night_Moon_Clouds_542827_1920x1080.jpg"
                              texto="Noite top!!"
                              titulo="Card Title"/>

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
        return {}
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
