<template>
    <site>
        <h2>LOGIN</h2>

        <input id="email" placeholder="E-mail" type="email" class="validate">
        <input id="senha" placeholder="Senha" type="password" class="validate">
        <button type="button" class="btn">Entrar</button>
    </site>
</template>

<script>
import Site from "../../templates/Site";
export default {
    name: "Login",
    components: {Site}
}
</script>

<style scoped>

</style>
