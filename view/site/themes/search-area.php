<?php $v->layout("themes/_theme"); ?>
<main>
    <div class="container--">
        <?php $v->insert("themes/sidemenu"); ?>
        <div class="content">
            <h2 class="title"><?= $search; ?></h2>

            <div class="cols--">

                <?php
                if ($products) :
                    foreach ($products as $product) :  ?>
                        <div class="col--">
                            <div class="product--wrapper">
                                <div class="single-products">
                                    <div class="productinfo">
                                        <a href="<?= $router->route("web.productDetail", ["id" => $product->id]); ?>">
                                            <img src="<?= url("/{$product->image1}"); ?>" alt="" />
                                        </a>
                                        <hr>
                                        <h2><?= $product->price; ?></h2>
                                        <p><?= $product->product; ?> </p>
                                        <div>
                                            <button href="#" class="add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                        </div>
                                    </div>

                                    <div class="product-overlay">
                                        <div class="overlay-content">
                                            <h2>R$ <?= $product->price; ?></h2>
                                            <p><?= $product->product; ?></p>
                                            <button href="#" class="add-to-cart">
                                                <i class="fa fa-shopping-cart"></i>
                                                Add to cart
                                            </button>
                                        </div>
                                    </div>

                                </div>

                                <div class="choose">
                                    <ul>
                                        <li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                        <li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                    </ul>
                                </div>
                            </div>

                        </div>

                    <?php endforeach;
                else : ?>

                    <div class="msg-send-email">
                        <h1 class="display-4">Olá!</h1>
                        <p class="lead">Não encontramos nenhum resultado para sua busca</p>
                    </div>

                <?php endif; ?>
            </div>
        </div>
    </div>
</main>