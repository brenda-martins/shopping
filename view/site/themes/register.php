<?php $v->layout("themes/_theme", ["title" => "| Cadastre-se"]); ?>



<main>
    <div class="container">
        <div id="form_register">
            <form action="<?= $router->route("auth.register"); ?>" method="post">
                <h1 class="h3 mb-3 font-weight-normal">Olá, complete seus dados para continuar</h1>

                <div class="login_form_callback">
                    <?= message(); ?>
                </div>

                <div class="form-inline">
                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" class="input-control" name="name" require>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="input-control" name="email" require>
                    </div>
                </div>
                <div class="form-inline">
                    <div class="form-group">
                        <label>Telefone</label>
                        <input type="text" class="input-control" name="contact" require>
                    </div>

                    <div class="form-group">
                        <label>Senha</label>
                        <input type="password" class="input-control" name="password" require>
                    </div>
                </div>
                <button type="submit">Continuar</button>
            </form>
        </div>
    </div>

</main>

<!-- <div class="row form_register">

        <div class="col-md-8 order-md-1">
           
            <form >
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="contact">Telefone</label>
                        <input type="text" class="form-control" id="contact" name="contact" required>

                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password">Senha</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                </div>
                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Cadastrar</button>
                <div class="custom-control custom-checkbox" style="margin-top: 4%; float: right;">
                    <a href="<?= $router->route("web.login"); ?> ">Já tem uma conta?</a>
                </div>
            </form>
        </div>
    </div> -->

<?php $v->start("js"); ?>
<script src="<?= asset("js/form.js"); ?>"></script>
<?php $v->end(); ?>