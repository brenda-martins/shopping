<?php $v->layout("themes/_theme", ["title" => "Carrinho de compras"]); ?>

<main>
    <section class="container">
        <div class="login_form_callback" style="margin-top: 20px;">
            <?= message(); ?>
        </div>
        <?php if (!empty($products)) : ?>
            <div class="cart_info">
                <table>
                    <thead>
                        <tr class="cart_menu">
                            <td>Produto</td>
                            <td></td>
                            <td>Preço</td>
                            <td>Quantidade</td>
                            <td>Subtotal</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product) : ?>
                            <tr>
                                <td class="cart_product">
                                    <a href=""><img src="<?= url("/{$product["image"]}"); ?>" alt=""></a>
                                </td>
                                <td class="cart_description">
                                    <h4><a href=""><?= $product["product"]; ?></a></h4>
                                </td>
                                <td class="cart_price">
                                    <p>R$ <?= $product["price"]; ?></p>
                                </td>
                                <td class="cart_quantity">
                                    <a data-action="<?= $router->route("cart.more"); ?>" data-id="<?= $product["id"] ?>">
                                        +
                                    </a>
                                    <input type="text" readonly class="quantity_<?= $product["id"]; ?>" value="<?= $product["amount"]; ?>">
                                    <a data-action="<?= $router->route("cart.less"); ?>" data-id="<?= $product["id"] ?>"> - </a>
                                </td>
                                <td class="cart_total">
                                    <p class="total_<?= $product["id"]; ?>">R$<?= $product["total"]; ?></p>
                                </td>
                                <td class="cart_delete">
                                    <a data-action="<?= $router->route("cart.remove"); ?>" data-id="<?= $product["id"] ?>"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>




            <section id="do_action">

                <div class="total_area">
                    <ul>
                        <li>Produtos <span class="amount"><?= $amount; ?></span></li>
                        <li>Envio <span>Grátis</span></li>
                        <li>Total <span class="total">R$ <?= $total; ?></span></li>
                    </ul>
                    <div style="margin: 14px;">
                        <a class="check_out" href="<?= $router->route("checkout.index"); ?>">Continuar compra</a>
                    </div>

                </div>
            </section>

        <?php else : ?>
            <div class="cart-empty">
                <div class="message">
                    <p> Seu carrinho está vazio, adicione produtos ao seu carrinho agora mesmo ...</p>

                </div>
                <a class="link-home" href="<?= $router->route("web.index"); ?>">Ir para página principal</a>
            </div>
        <?php endif; ?>

    </section>
</main>

<?php $v->start("js") ?>
<script>
    $(function() {
        $("[data-action]").click(function(event) {
            event.preventDefault();

            var data = $(this).data();
            var parent = $(this).parent().parent();
            var formater = Intl.NumberFormat("pt-BR", {
                style: "currency",
                currency: "BRL"
            });


            $.post(data.action, data, function(cart) {

                if (cart.amount) {
                    $(".amount").html(cart.amount);
                } else {
                    $(".amount").html("cart.amount");
                }

                if (cart.total) {
                    $(".total").html(formater.format(cart.total));
                } else {
                    $(".total").html("0");
                }

                if (!jQuery.isEmptyObject(cart.itens)) {

                    if (!cart.itens.hasOwnProperty(data.id)) {
                        parent.fadeOut();
                    }


                    $.each(cart.itens, function(index, item) {
                        $(".quantity_" + item.id).val(item.amount);
                        $(".total_" + item.id).html(formater.format(item.total));
                    });


                } else {
                    parent.fadeOut();
                }

            }, "json");
        });

    });
</script>
<?php $v->end(); ?>