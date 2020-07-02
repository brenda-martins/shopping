<?php $v->layout("themes/_theme", ["title" => "| Login"]); ?>


<main class="login">
    <div class="container">
        <div id="form-login">
            <form method="post" action="<?= $router->route("auth.login"); ?>">

                <h1 class="h3 mb-3 font-weight-normal">Olá, digite seu email e sua senha para continuar</h1>

                <div class="login_form_callback">
                    <?= message(); ?>
                </div>

                <div class="form-group">
                    <input type="email" class="input-control" required autofocus id="email" name="email">
                    <label for="email">Seu endereço de email</label>
                </div>

                <div class="form-group">
                    <input type="password" id="password" class="input-control" required name="password">
                    <label for="password">Sua senha</label>
                </div>

                <div class="form--control">
                    <div>
                        <label>
                            <input type="checkbox" value="remember-me"> Remember me
                        </label>
                    </div>
                    <div class="btn-new-account">
                        <a href="<?= $router->route("web.forget") ?>">
                            Esqueceu a senha?
                        </a>
                    </div>
                </div>
                <button type="submit">Continuar</button>

                <div class="btn-new-account" style="margin-top: 4%; float: right;">
                    <a href="<?= $router->route("web.register"); ?> ">Ainda não tem uma conta?</a>
                </div>
            </form>
        </div>
    </div>
</main>


<?php $v->start("js"); ?>
<script src="<?= asset("js/form.js"); ?>"></script>
<?php $v->end(); ?>