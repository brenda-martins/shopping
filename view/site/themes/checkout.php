<?php $v->layout("themes/_theme", ["title" => "Shopping | Continuar compra"]); ?>


<main>
    <form id="checkout" method="post" action="<?= $router->route("checkout.address") ?>">
        <div class="send-to">
            <div class="form-purchase">
                <div class="login_form_callback">
                    <?= message(); ?>
                </div>

                <div>
                    <label> Nome</label>
                    <input type="text" name="name" value="<?= $_SESSION["user"]["name"]; ?>">
                </div>

                <div>
                    <label>CEP</label>
                    <input type="text" name="cep" id="cep" require>
                </div>

                <div class="input-inline">

                    <div class="state">
                        <label>Estado</label>
                        <input type="text" readonly id="state" name="state" require>
                    </div>

                    <div>
                        <label>Cidade</label>
                        <input type="text" readonly id="city" name="city" require>
                    </div>


                </div>

                <div>
                    <label>Bairro</label>
                    <input type="text" id="neighborhood" name="neighborhood" require>
                </div>



                <div class="input-inline">

                    <div class="state">
                        <label>Rua/Avenida</label>
                        <input type="text" id="street" name="street" require>
                    </div>

                    <div>
                        <label>Número</label>
                        <input type="text" name="number" require>
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


<?php $v->start("js"); ?>
<script src="<?= asset("js/form.js"); ?>"></script>
<script>
    $(function() {
        $("#cep").blur(function() {
            var cep = $(this).val().replace(/\D/g, '');

            if (cep != "") {
                var validacep = /^[0-9]{8}$/;

                if (validacep.test(cep)) {
                    $("#state").val("...");
                    $("#city").val("...");
                    $("#neighborhood").val("...");
                    $("#street").val("...");

                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json", function(data) {
                        if (!("erro" in data)) {
                            $("#state").val(data.uf);
                            $("#city").val(data.localidade);
                            $("#neighborhood").val(data.bairro);
                            $("#street").val(data.logradouro);
                        } else {
                            var view = '<div class="message error"> CEP não encontrado</div>';
                            $(".form_callogin_form_callbacklback").html(view);
                            $(".message").effect("bounce");
                            return;
                        }
                    });
                } else {
                    var view = '<div class="message error"> CEP não é válido</div>';
                    $(".login_form_callback").html(view);
                    $(".message").effect("bounce");
                    return;
                }
            } else {
                var view = '<div class="message alert"> CEP não é válido</div>';
                $(".login_form_callback").html(view);
                $(".message").effect("bounce");
                return;
            }
        });
    });
</script>

<?php $v->end(); ?>