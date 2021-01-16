<template>
    <span>
        <div class="card-image">
            <img :src="url_imagem">
        </div>
        <div class="card-content">
            <p>{{ texto }}</p>
            <p>
                <a :href="link">{{ link }}</a>

            </p>
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
        'link',
        'texto',
    ],
    data() {
        return {}
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
