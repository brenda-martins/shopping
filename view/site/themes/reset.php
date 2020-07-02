<?php $v->layout("themes/_theme", ["title" => "Reset sua senha"]); ?>

<main>
    <div class="container">
        <div id="form-reset">
            <form method="post" action="<?= $router->route("auth.reset"); ?>" autocomplete="off">

                <h1 class="h3 mb-3 font-weight-normal">Olá, digite sua nova senha e confirme-a para continuar</h1>

                <div class="login_form_callback">
                    <?= message(); ?>
                </div>
                <div class="form-group">
                    <label for="">Nova senha</label>
                    <input type="password" name="password" class="input-control">
                </div>

                <div class="form-group">
                    <label for="">Confirmação</label>
                    <input type="password" name="password_re" class="input-control">
                </div>
                <button type="submit">Continuar</button>
            </form>
        </div>
    </div>
</main>

<?php $v->start("js"); ?>
<script src="<?= asset("site", "js/form.js"); ?>"></script>
<?php $v->end(); ?>