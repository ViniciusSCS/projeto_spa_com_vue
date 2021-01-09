<template>
    <div id="login-page" class="row">
        <grid class="z-depth-6 card-panel" tamanho="12">
            <div class="row">
                <grid class="input-field" tamanho="12">
                    <i class="material-icons prefix">mail_outline</i>
                    <label for="email" data-error="wrong" data-success="right">E-mail</label>
                    <input class="validate" id="email" type="email" v-model="email">
                </grid>
            </div>

            <div class="row">
                <grid class="input-field" tamanho="12">
                    <i class="material-icons prefix">lock_outline</i>
                    <label for="password">Senha</label>
                    <input class="validate" min="6" id="password" type="password" v-model="password">
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
                    <button class="btn waves-effect waves-light col s12" v-on:click="acessar()">Entrar</button>
                </grid>
            </div>

            <div class="row">
                <grid class="input-field" tamanho="6 m6 l6">
                    <p class="margin medium-small">
                        <router-link class="btn waves-effect waves-light blue" to="/cadastro">Criar nova conta
                        </router-link>
                    </p>
                </grid>
            </div>
        </grid>
    </div>
</template>

<script>
import Grid from "../components/layouts/Grid";

import axios from "axios"

export const http = axios.create({
    baseURL: 'http://localhost:8000/api',
    headers: {
        'Access-Control-Allow-Origin': '*',
        'Access-Control-Allow-Methods': 'GET, POST, PATCH, PUT, DELETE, OPTIONS',
        'Access-Control-Allow-Headers': '*',
    },

})


export default {
    name: "Acesso",
    components: {Grid},
    data() {
        return {
            email: '',
            password: '',
        }
    },

    methods: {
        acessar() {
            var self = this

            http.post('/login', {
                email: self.email,
                password: self.password
            })
            .then(function (response) {
                if(response.data.token){
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Usuário ' + response.data.name + ' logado com sucesso!!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    sessionStorage.setItem('usuario', JSON.stringify(response.data))
                    self.$router.push('/')
                }else if (response.data.status == false){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Nome de usuário ou senha incorretos. Por favor tente novamente!',
                    })
                }else{
                    var erros = '';
                    for (var e of Object.values(response.data)){
                        erros += e + ' ';
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Erro: ' + erros,
                    })
                }
            })
            .catch(function (error) {
                console.log('ERRO.: ', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'ERRO, tente novamente mais tarde!',
                })
            });
        },
    }
}
</script>

<style scoped>

</style>
