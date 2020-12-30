<template>
    <site>
        <span slot="menuEsquerdo">
            <grid tamanho="4">
                <img :src="usuario.imagem || 'https://cutt.ly/0jeMJOa'" alt=""
                     class="circle responsive-img">
            </grid>
            <grid tamanho="8">
                <span class="black-text">
                    <h5>{{usuario.name}}</h5>
                    {{usuario.description_user || ''}}
                </span>
            </grid>
        </span>

        <span slot="principal">

            <h2>PERFIL</h2>

            <div id="login-page" class="row">
                <grid class="z-depth-6 card-panel" tamanho="12">
                    <div class="row">
                        <grid class="input-field" tamanho="12">
                            <i class="material-icons prefix">people_outline</i>
                            <input class="validate" id="nome" type="text" v-model="name">
                            <label for="nome" data-error="wrong" data-success="right">Nome</label>
                        </grid>
                    </div>

                    <div class="row">
                        <grid class="input-field" tamanho="12">
                            <i class="material-icons prefix">mail_outline</i>
                            <input class="validate" id="email" type="email" v-model="email">
                            <label for="email" data-error="wrong" data-success="right">E-mail</label>
                        </grid>
                    </div>

                    <div class="file-field input-field">
                        <div class="btn green">
                            <i class="material-icons ">add_a_photo</i>
                            <span>Imagem</span>
                            <input type="file" v-on:change="upload">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <label for="textarea1">Textarea</label>
                            <textarea id="textarea1" class="materialize-textarea" v-model="description_user"></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <grid class="input-field" tamanho="12">
                            <i class="material-icons prefix">lock_outline</i>
                            <input id="password" type="password" v-model="password">
                            <label for="password">Senha</label>
                        </grid>
                    </div>

                    <div class="row">
                        <grid class="input-field" tamanho="12">
                            <i class="material-icons prefix">lock_outline</i>
                            <input id="confirmar_senha" type="password" v-model="password_confirmation">
                            <label for="confirmar_senha">Confirme sua Senha</label>
                        </grid>
                    </div>

                    <div class="row">
                        <grid class="input-field" tamanho="12">
                            <button class="btn waves-effect waves-light col s12" v-on:click="perfil()">
                                Atualizar
                            </button>
                        </grid>
                    </div>
                </grid>
            </div>
        </span>
    </site>
</template>

<script>
import Site from "@/templates/Site";
import Grid from "@/components/layouts/Grid";


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
    name: "Perfil",
    data() {
        return {
            usuario: false,

            name: '',
            email: '',
            imagem: '',
            password: '',
            description_user: '',
            password_confirmation: '',
        }
    },
    created() {
        var self = this

        var aux = sessionStorage.getItem('usuario')
        if (aux) {
            self.usuario = JSON.parse(aux)
            self.name = self.usuario.name
            self.email = self.usuario.email
            self.imagem = self.usuario.imagem
            self.password = self.usuario.password
            self.description_user = self.usuario.description_user
            self.password_confirmation = self.usuario.password_confirmation
        }
    },
    components: {Site, Grid},
    methods: {

        upload(event){
            var self = this

            var file = event.target.files || event.dataTransfer.files;
            if(!file.length){
                return
            }

            var reader = new FileReader()

            reader.onloadend = (event) => {
                self.imagem = event.target.result
            }
            reader.readAsDataURL(file[0])
        },

        perfil() {
            var self = this

            http.put('/perfil', {
                name: self.name,
                email: self.email,
                imagem: self.imagem,
                password: self.password,
                description_user: self.description_user,
                password_confirmation: self.password_confirmation,

            }, {"headers": {"authorization": "Bearer " + self.usuario.token}})
                .then(function (response) {
                    if (response.data.token) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Atualização realizada com sucesso!!',
                            showConfirmButton: false,
                            timer: 1500,
                        })
                        self.usuario = response.data
                        sessionStorage.setItem('usuario', JSON.stringify(self.usuario))

                    } else if (response.data.status == false) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Erro ao cadastrar Usuário!',
                        })
                    } else {
                        var erros = '';
                        for (var e of Object.values(response.data)) {
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
