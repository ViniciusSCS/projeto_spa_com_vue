<template>
    <span>

        <publicar-conteudo/>

        <card-conteudo perfil="http://engenheirocompvinicius.com.br/assets/img/vscs.png"
                       nome="Vinícius Sarmento"
                       data="17/12/2020 17:15">

            <card-detalhe url_imagem="https://cutt.ly/zhL51ps"
                          texto="TE AMO TIMAIS!!!"
                          titulo="Card Title"/>

        </card-conteudo>
    </span>
</template>

<script>
import Grid from "@/components/layouts/Grid";
import CardDetalhe from "@/components/social/CardDetalhe";
import CardConteudo from "@/components/social/CardConteudo";
import PublicarConteudo from "@/components/social/PublicarConteudo";

export default {
    name: 'Home',
    components: {PublicarConteudo, Grid, CardDetalhe, CardConteudo},
    data() {
        return {}
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
