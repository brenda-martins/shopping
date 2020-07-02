<?php $v->layout("themes/_theme", ["title" => "Admin | Produto"]) ?>


<div class="module">
    <div class="module-head">
        <h3>Novo Produto</h3>
    </div>
    <div class="module-body">

        <form id="uploadForm" class="form-horizontal row-fluid" method="post" enctype="multipart/form-data" action="<?= $router->route("product.store"); ?>">

            <div class="login_form_callback">
                <?= message(); ?>
            </div>
            <div class="control-group">
                <label class="control-label" for="basicinput">Categoria</label>
                <div class="controls">
                    <select name="category" id="category" class="span8 tip" require>
                        <option value="">Selecione uma categoria</option>
                        <?php
                        if ($categories) :
                            foreach ($categories as $category) :
                        ?>
                                <option value="<?= $category->id ?>"><?= $category->name ?></option>
                        <?php
                            endforeach;
                        endif;
                        ?>
                    </select>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="basicinput">Nome produto</label>
                <div class="controls">
                    <input type="text" name="product_name" class="span8 tip" require>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Preço</label>
                <div class="controls">
                    <input type="text" name="product_price" class="span8 tip" require>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Descrição</label>
                <div class="controls">
                    <textarea name="product_description" rows="6" class="span8 tip" require>
                    </textarea>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="basicinput">Taxa de envio do produto</label>
                <div class="controls">
                    <input type="text" name="product_shippingcharge" class="span8 tip" require>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Disponibilidade do produto</label>
                <div class="controls">
                    <select name="product_availability" id="productAvailability" class="span8 tip" require>
                        <option value="">Selecione</option>
                        <option value="Em estoque">Em estoque</option>
                        <option value="Fora do estoque">Fora do estoque</option>
                    </select>
                </div>
            </div>



            <div class="control-group">
                <label class="control-label" for="basicinput">Imagem 1</label>
                <div class="controls">
                    <input type="file" name="product_image1" class="span8 tip" require>
                </div>
            </div>


            <div class="control-group">
                <label class="control-label">Imagem 2</label>
                <div class="controls">
                    <input type="file" name="product_image2" class="span8 tip" require>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Imagem 3</label>
                <div class="controls">
                    <input type="file" name="product_image3" class="span8 tip" require>
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

<?php $v->start("js"); ?>
<script>
    $("#uploadForm").on('submit', (function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?= $router->route("product.store"); ?>",
            type: "POST",
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {

                if (data.message) {
                    var view = '<div class="message ' + data.message.type + '">' + data.message.message + '</div>';
                    $(".login_form_callback").html(view);
                    $(".message").effect("bounce");
                    return;
                }

                if (data.redirect) {
                    window.location.href = data.redirect.url;
                }
            }
        });
    }));
</script>
<?php $v->end; ?>