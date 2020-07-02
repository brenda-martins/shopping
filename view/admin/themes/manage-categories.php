<?php $v->layout("themes/_theme", ["title" => "Admin | Categoria"]); ?>

<div class="module">
    <div class="module-head">
        <h3>Categorias</h3>

    </div>
    <div class="module-body table">

        <div class="login_form_callback">
            <?= message(); ?>
        </div>


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