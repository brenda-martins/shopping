<?php $v->layout("themes/_theme", ["title" => "Admin| Subcategoria"]); ?>


<div class="module">
    <div class="module-head">
        <h3>Sub Category</h3>
    </div>
    <div class="module-body">


        <br />

        <form class="form-horizontal row-fluid" action="<?= $router->route("subcategory.store"); ?>" method="post">

            <div class="login_form_callback">
                <?= message(); ?>
            </div>
            
            <div class="control-group">
                <label class="control-label" for="basicinput">Categoria</label>
                <div class="controls">
                    <select name="category" class="span8 tip" required>
                        <option value="">Selecione uma categoria</option>
                        <?php
                        if ($categories) :
                            foreach ($categories as $category) :
                        ?>
                                <option value="<?= $category->id; ?>"><?= $category->name; ?></option>
                        <?php
                            endforeach;
                        endif;
                        ?>
                    </select>
                </div>
            </div>


            <div class="control-group">
                <label class="control-label" for="basicinput">Nome sub categoria</label>
                <div class="controls">
                    <input type="text" name="subcategory" class="span8 tip" required>
                </div>
            </div>

            <div class="control-group">
                <div class="controls">
                    <button type="submit" class="btn">Salvar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php $v->start("js") ?>
<script src="<?= asset("js/form.js"); ?>"></script>
<?php $v->end; ?>