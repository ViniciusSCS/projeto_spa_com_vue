<template>
    <login-template>

        <span slot="menuEsquerdo">
            <ul>
                  <img src="https://cutt.ly/NhCtr6a" class="displayed responsive-img">
            </ul>
        </span>

        <span slot="principal">
            <acesso/>
        </span>

    </login-template>
</template>

<script>
import Acesso from "@/templates/Acesso";
import Cadastro from "@/templates/Cadastro";
import Grid from "@/components/layouts/Grid";
import LoginTemplate from "@/templates/LoginTemplate";
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
