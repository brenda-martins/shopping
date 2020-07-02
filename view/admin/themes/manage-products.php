<?php $v->layout("themes/_theme", ["title" => "| Gerenciar produtos"]); ?>
<div class="module">
    <div class="module-head">
        <h3>Gerenciar produtos</h3>
    </div>
    <div class="module-body table" style="padding: 3%; box-sizing: border-box;">

        <div class="login_form_callback">
            <?= message(); ?>
        </div>
        <table class="datatable-1 table table-bordered table-striped	 
               display" width="100%">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Categoria </th>
                    <th>Preço</th>
                    <th>Data cadastro</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>

                <?php
                if ($products) :
                    foreach ($products as $product) :
                ?>

                        <tr>
                            <td><?= $product->name; ?></td>
                            <td><?= $product->category; ?></td>
                            <td><?= $product->price; ?></td>
                            <td> <?= $product->created_at; ?></td>
                            <td>
                                <a data-action="<?= $router->route("product.edit"); ?>" data-id="<?= $product->id ?>" href="#" id="update-product">
                                    <i class="icon-edit"></i>
                                </a>
                                <a href="#" data-action="<?= $router->route("product.delete"); ?>" data-id="<?= $product->id ?>">
                                    <i class="icon-remove-sign">

                                    </i>
                                </a>
                            </td>
                        </tr>
                <?php
                    endforeach;
                endif;
                ?>

        </table>
    </div>
</div>


<div class="modal fade" id="modalUpdateCategoria" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="login_form_callback">
                <?= message(); ?>
            </div>

            <div class="modal-body">
                <form class="form-horizontal row-fluid" method="post" action="<?= $router->route("product.update"); ?>">
                    <input type="hidden" name="product_id" id="product_id">
                    <div class="control-group">
                        <label class="control-label">Nome produto</label>
                        <div class="controls">
                            <input type="text" name="product_name" class="span8 tip" required id="product_name">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Preço</label>
                        <div class="controls">
                            <input type="text" name="product_price" class="span8 tip" required id="product_price">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Descrição</label>
                        <div class="controls">
                            <textarea name="product_description" rows="6" class="span8 tip" required id="product_description">
                            </textarea>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="basicinput">Taxa de envio do produto</label>
                        <div class="controls">
                            <input type="text" name="product_shippingcharge" class="span8 tip" id="product_shippingcharge">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Disponibilidade do produto</label>
                        <div class="controls">
                            <select name="product_availability" id="productAvailability" class="span8 tip" required id="product_availability">
                                <option value="">Selecione</option>
                                <option value="Em estoque">Em estoque</option>
                                <option value="Fora do estoque">Fora do estoque</option>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" class="btn">Cadastrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<?php $v->start("js"); ?>
<script>
    $(function() {

        $("[data-action]").click(function(e) {
            e.preventDefault();

            var data = $(this).data();
            var div = $(this).parent().parent();

            $.post(data.action, data, function(data) {

                if (data.message) {
                    alert(message.message);
                    return;
                }

                if (data.edit) {
                    $("#product_name").val(data.product.name);
                    $("#productpricebd").val(data.product.priceBeforeDiscount);
                    $("#product_price").val(data.product.price);
                    $("#product_description").val(data.product.productDescription);
                    $("#product_shippingcharge").val(data.product.shippingCharge);
                    $("#product_availability").val(data.product.productAvailability);
                    $("#product_id").val(data.product.id);

                    $('#modalUpdateCategoria').modal('show');
                    return;
                }

                if (data.delete) {
                    div.fadeOut();
                    return;
                }
            }, "json");
        });
    });
</script>
<script src="<?= asset("js/form.js"); ?>"></script>
<?php $v->end(); ?>