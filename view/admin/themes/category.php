<?php $v->layout("themes/_theme", ["title" => "Admin | Categoria"]); ?>


<div class="module">
    <div class="module-head">
        <h3>Categoria</h3>
    </div>
    <div class="module-body">


        <div class="login_form_callback">
            <?= message(); ?>
        </div>
        <br />

        <form class="form-horizontal row-fluid" action="<?= $router->route("category.store"); ?>" method="post">
            <input type="hidden" name="id" id="id">
            <div class="control-group">
                <label class="control-label" for="basicinput">Nome</label>
                <div class="controls">
                    <input type="text" placeholder="Digite o nome da categoria" name="category" class="span8 tip" required id="category">
                </div>
            </div>

            <div class="control-group">
                <div class="controls">
                    <button type="submit" class="btn">Salvar</button>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="module">
    <div class="module-head">
        <h3>Manage Categories</h3>
    </div>
    <div class="module-body table">
        <table class="datatable-1 table table-bordered table-striped display" width="100%">
            <thead>
                <tr>
                    <th>Categoria</th>
                    <th>Data cadastro</th>
                    <th>Última Atualização</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($categories) :
                    foreach ($categories as $category) :
                ?>
                        <tr>
                            <td><?= $category->name; ?></td>
                            <td><?= $category->created_at; ?></td>
                            <td><?= $category->updated_at; ?></td>
                            <td>
                                <a href="#" data-action="<?= $router->route("category.edit"); ?>" data-id="<?= $category->id ?>"><i class="icon-edit"></i></a>
                                <a href="#" data-action="<?= $router->route("category.remove"); ?>" data-id="<?= $category->id ?>"><i class="icon-remove-sign"></i></a>
                            </td>
                        </tr>
                <?php
                    endforeach;
                endif;
                ?>
        </table>
    </div>
</div>
<?php $v->start("js") ?>
<script src="<?= asset("js/form.js") ?>"></script>
<script>
    $(function() {
        $("[data-action]").click(function(event) {
            event.preventDefault();

            var data = $(this).data();
            var parent = $(this).parent().parent();

            $.post(data.action, data, function(su) {

                if (su.message) {
                    // var view = '<div class="message ' + su.message.type + '">' + su.message.message + '</div>';
                    // $(".login_form_callback").html(view);
                    // $(".message").effect("bounce");

                    // console.log(view);
                    alert(su.message.message);
                    return;
                }

                if (su.delete) {
                    parent.fadeOut();
                }

                if (su.edit) {

                    $("#category").val(su.category.name);
                    $("#id").val(su.category.id);

                }
            }, "json");
        });

    });
</script>
<?php $v->end() ?>