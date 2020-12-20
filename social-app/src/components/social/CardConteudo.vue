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
                    <i class="material-icons">favorite_border</i>
                    &af;
                    <i class="material-icons">comment</i>
                    &af;
                    <i class="material-icons">send</i>
                </p>
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
        'perfil',
        'nome',
        'data'
    ],
    data() {
        return {}
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
