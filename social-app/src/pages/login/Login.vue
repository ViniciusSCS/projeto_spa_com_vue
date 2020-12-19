<template>
    <site>

        <!--        <input id="email" placeholder="E-mail" type="email" class="validate">-->
        <!--        <input id="senha" placeholder="Senha" type="password" class="validate">-->
        <!--        <button type="button" class="btn">Entrar</button>-->

        <div id="login-page" class="row">
            <div class="col s12 z-depth-6 card-panel">
                <form class="login-form">
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">mail_outline</i>
                            <input class="validate" id="email" type="email">
                            <label for="email" data-error="wrong" data-success="right">Email</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">lock_outline</i>
                            <input id="password" type="password">
                            <label for="password">Password</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12 m12 l12  login-text">
                            <label>
                                <input type="checkbox" />
                                <span>Remember me</span>
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <a href="#" class="btn waves-effect waves-light col s12">Login</a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s6 m6 l6">
                            <p class="margin medium-small"><a href="#">Register Now!</a></p>
                        </div>
                        <div class="input-field col s6 m6 l6">
                            <p class="margin right-align medium-small"><a href="#">Forgot password?</a></p>
                        </div>
                    </div>

                </form>
            </div>
        </div>
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
