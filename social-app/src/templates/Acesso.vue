<template>
    <span>
        <div class="row">
            <grid class="input-field" tamanho="12">
                <i class="material-icons prefix">mail_outline</i>
                <input class="validate" id="email" type="email">
                <label for="email" data-error="wrong" data-success="right">E-mail</label>
            </grid>
        </div>

        <div class="row">
            <grid class="input-field" tamanho="12">
                <i class="material-icons prefix">lock_outline</i>
                <input id="password" type="password">
                <label for="password">Senha</label>
            </grid>
        </div>

        <div class="row">
            <grid class="input-field login-text" tamanho="12 m12 l12">
                <label>
                    <input type="checkbox"/>
                    <span>Manter Conectado</span>
                </label>
            </grid>
        </div>

        <div class="row">
            <grid class="input-field" tamanho="12">
                <button class="btn waves-effect waves-light col s12">Login</button>
            </grid>
        </div>

        <div class="row">
            <grid class="input-field" tamanho="6 m6 l6">
                <p class="margin medium-small">
                    <router-link class="btn waves-effect waves-light blue" to="/cadastro">Registrar</router-link>
                </p>
            </grid>
        </div>
    </span>
</template>

<script>
import Grid from "../components/layouts/Grid";
export default {
    name: "Acesso",
    components: {Grid},
}
</script>

<style scoped>

</style>
