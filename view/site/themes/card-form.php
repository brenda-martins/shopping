<?php $v->layout("themes/_theme", ["title" => "| Cadastrar cartão"]); ?>
<main>


    <form id="checkout" method="post" action="<?= $router->route("checkout.storeCard"); ?>">
        <div class="send-to">
            <h3 style="margin-bottom:22px;">Adicione um novo cartão</h3>
            <div class="form-purchase">
                <div class="login_form_callback">
                    <?= message(); ?>
                </div>

                <div>
                    <label> Número do cartão</label>
                    <input type="text" name="number" value="4716258261697271" placeholder="somente números">
                </div>

                <div>
                    <label>Titular</label>
                    <input type="text" name="holder_name" value="Brenda Martins" placeholder="Nome completo">
                </div>

                <div class="input-inline">

                    <div class="state">
                        <label>Data de vencimento</label>
                        <input type="text" name="expiration_date" value="0222">
                    </div>

                    <div>
                        <label>Código de segurança</label>
                        <input type="text" name="cvv" value="911">
                    </div>


                </div>


            </div>
        </div>

        <div class="purchase-summary">
            <h4>Resumo da compra</h4>
            <hr>
            <ul>
                <li>Produtos <span><?= $_SESSION["cart"]["amount"]; ?></span></li>
                <li>Envio <span>Grátis</span></li>
                <li>Total <span>R$ <?= $_SESSION["cart"]["total"]; ?></span></li>
            </ul>
            <button type="submit">
                <a>Continuar</a>
            </button>
        </div>
    </form>
</main>


<?php $v->start("js") ?>
<script src="<?= asset("js/form.js"); ?>"></script>
<?php $v->end(); ?>