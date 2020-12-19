<template>
    <login-template>

        <span slot="menuEsquerdo">
            <ul>
                  <img src="https://cutt.ly/NhCtr6a" alt="" style="" class="displayed responsive-img">
            </ul>
        </span>

        <span slot="principal">
            <acesso/>
        </span>

    </login-template>
</template>

<script>
import LoginTemplate from "@/templates/LoginTemplate";
import Grid from "@/components/layouts/Grid";
import Acesso from "@/templates/Acesso";
import Cadastro from "@/templates/Cadastro";

export default {
    name: "Login",
    components: {Cadastro, Acesso, Grid, LoginTemplate},

}
</script>

<style scoped>
img.displayed {
    display: block;
    margin-left: auto;
    margin-right: auto
}
</style>
