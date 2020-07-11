<?php $v->layout("themes/_theme", ["title" => "Confirmar compra"]); ?>



<main>
    <form id="checkout" method="post" action="<?= $router->route("checkout.confirm") ?>">
        <div class="send-to">
            <div class="form-purchase">
                <h4>Detalhes do envio</h4>
                <div class="hero-address">
                    <h5><?= $address->street . ", " . $address->number; ?></h5>
                    <span><?= $address->city . ", " . $address->state . " - " . $address->cep; ?></span>
                </div>

                <?php foreach ($products as $p) : ?>
                    <div class="products-simple">
                        <div>
                            <img src="<?= url("/{$p["image"]}"); ?>" alt="">
                        </div>
                        <div>
                            <span><?= $p["product"]; ?></span>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="purchase-summary">
            <h4>Resumo da compra</h4>
            <hr>
            <ul>
                <li>Produtos <span><?= $_SESSION["cart"]["amount"]; ?></span></li>
                <li>Envio <span>Grátis</span></li>
                <li>Você pagará: <span>R$ <?= $_SESSION["cart"]["total"]; ?></span></li>
            </ul>
            <button type="submit">
                <a>Confirmar</a>
            </button>
        </div>
    </form>
</main>