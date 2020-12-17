<template>

    <div class="card">
        <div class="card-content">
            <div class="row valign-wrapper">
                <grid tamanho="1">
                    <img src="https://materializecss.com/images/yuna.jpg" alt=""
                         class="circle responsive-img">
                    <!-- notice the "circle" class -->
                </grid>
                <grid tamanho="11">
                    <span class="black-text">
                        <strong>Maria Cidadã</strong> - <small>17/12/2020 17:15</small>
                    </span>
                </grid>
            </div>

            <div class="card-image">
                <img src="https://materializecss.com/images/sample-1.jpg">
                <span class="card-title">Card Title</span>
            </div>
            <div class="card-content">
                <p>I am a very simple card. I am good at containing small bits of information.
                    I am convenient because I require little markup to use effectively.</p>
            </div>
        </div>
        <div class="card-action">
            <p>
                <i class="material-icons">favorite_border</i>
                <i class="material-icons">comment</i>
            </p>
        </div>
    </div>


</template>

<script>
import Grid from "../layouts/Grid";
export default {
    name: 'CardConteudo',
    components: {Grid},
    props: [],
    data() {
        return {}
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
