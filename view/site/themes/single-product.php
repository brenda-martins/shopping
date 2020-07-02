<?php $v->layout("themes/_theme", ["title" => "| Produto"]); ?>

<main id="single-product">
    <?php $v->insert('themes/sidemenu') ?>

    <div class="content">
        <div class="product-details">
            <div class="product-images">
                <div class="view-product">
                    <img src="<?= url("/{$product->image1}"); ?>" alt="" />
                    <h3>ZOOM</h3>
                </div>
                <div id="similar-product">

                    <div class="carousel-inner">
                        <div class="item">
                            <a href=""><img src="<?= url("/{$product->image1}"); ?>" alt=""></a>
                            <a href=""><img src="<?= url("/{$product->image2}"); ?>" alt=""></a>
                            <a href=""><img src="<?= url("/{$product->image3}"); ?>" alt=""></a>
                        </div>
                    </div>

                    <!-- Controls -->
                    <a class="left item-control" href="#similar-product" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right item-control" href="#similar-product" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
            <div class="product-information">
                <h2><?= $product->product ?></h2>
                <span>
                    <span>R$ <?= $product->price ?></span>
                    <label>Quantidade:</label>
                    <input type="text" />
                    <button type="button" class="cart">
                        <i class="fa fa-shopping-cart"></i>
                        Add to cart
                    </button>
                </span>
                <p><b>Disponibilidade:</b> <?= $product->productAvailability; ?></p>
                <p><b>Categoria:</b> <?= $product->category; ?></p>
                <a href=""><img src="images/product-details/share.png" class="share img-responsive" alt="" /></a>

                <button id="btn-comprar">Comprar</button>
            </div>


        </div>
    </div>

</main>