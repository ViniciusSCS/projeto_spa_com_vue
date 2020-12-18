<template>
    <span>
        <div class="card-image">
            <img :src="url_imagem">
            <span class="card-title">{{ titulo }}</span>
        </div>
        <div class="card-content">
            <p>{{ texto }}</p>
        </div>
    </span>

</template>

<script>
import Grid from "../layouts/Grid";

export default {
    name: 'CardDetalhe',
    components: {Grid},
    props: [
        'url_imagem',
        'titulo',
        'texto'
    ],
    data() {
        return {}
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
