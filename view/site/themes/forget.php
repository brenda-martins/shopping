<?php $v->layout("themes/_theme", ["title" => "| Recuperar sua senha"]); ?>

<main>
    <div class="container">
        <div id="form-forget">
            <form action="<?= $router->route("auth.forget"); ?>" method="post" autocomplete="off">
                <h1 class="h3 mb-3 font-weight-normal">Olá, digite seu email para continuar</h1>

                <div class="login_form_callback">
                    <?= message(); ?>
                </div>
                <div class="form-group">
                    <label> Digite seu email</label>
                    <input type="email" name="email" class="input-control">
                </div>
                <button type="submit">Continuar</button>
            </form>
        </div>
    </div>
</main>

<?php $v->start("js"); ?>
<script src="<?= asset("js/form.js"); ?>"></script>
<?php $v->end(); ?>