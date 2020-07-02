<?php $v->layout("themes/_theme", ["title" => "| Home"]); ?>

<section class="hero">
    <div class="container">
        <div>
            <h2>
                Compre sem sair de casa
            </h2>
            <p>
                As melhores ofertas, pagamentos rápidos com cartões de créditos ou boleto , segurança do início ao fim
            </p>
            <a href="#" class="button">Quero saber mais!</a>
        </div>
        <div id="slider">
            <img class="selected" src="<?= asset("images/slide1.jpg"); ?>" />
            <img src="<?= asset("images/slide2.jpg"); ?>" />
            <img src="<?= asset("images/slide3.jpg"); ?>" />
            <img src="<?= asset("images/slide4.jpg"); ?>" />
        </div>
    </div>

</section>
<main class="home">
    <div class="cards">
        <?php if ($products) :
            foreach ($products as $product) : ?>
                <div class="card">

                    <a href="<?= $router->route("web.productdetail", ["id" => $product->id]); ?>" class="image">
                        <img src="<?= url("/{$product->image1}"); ?>" alt="">
                    </a>
                    <div class="content">
                        <p class="title text--medium">
                            <a href="<?= $router->route("web.productdetail", ["id" => $product->id]); ?>">
                                <?= $product->name; ?>
                            </a>
                        </p>
                        <div class="info">
                            <p class="text--medium"> R$<?= $product->price; ?></p>
                            <p class="price text--medium">
                                <a data-id="<?= $product->id; ?>" href="<?= $router->route("cart.add", ["id" => $product->id]); ?>"> Add to cart</a>
                            </p>
                        </div>
                    </div>
                </div>
        <?php
            endforeach;
        endif;
        ?>
    </div>
</main>

<?php $v->start("js") ?>
<script src="<?= asset("js/slider.js"); ?>"></script>
<script src="<?= asset("js/carrossel.js"); ?>"></script>
<script>
    $(function() {
        $("[data-action]").click(function(event) {
            var data = $(this).data();
            $.post(data.action, data, function(su) {
                
                if (su.redirect) {
                    window.location.href = su.redirect.url;
                }
            }, "json");
        });
    });
</script>
<?php $v->end() ?>