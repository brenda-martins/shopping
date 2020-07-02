<div class="left-sidebar">
    <h2>Categorias</h2>


    <div class="panel-group category-products">
        <div class="panel panel-default">
            <nav id="tree">
            </nav>
        </div>
    </div>

    <!-- <h2>Marcas</h2>
    <div class="panel-group brands_products">
        <ul class="nav-stacked">
            <li><a href=""> <span class="pull-right">(50)</span>Acne</a></li>
            <li><a href=""> <span class="pull-right">(56)</span>Grüne Erde</a></li>
            <li><a href=""> <span class="pull-right">(27)</span>Albiro</a></li>
            <li><a href=""> <span class="pull-right">(32)</span>Ronhill</a></li>
            <li><a href=""> <span class="pull-right">(5)</span>Oddmolly</a></li>
            <li><a href=""> <span class="pull-right">(9)</span>Boudestijn</a></li>
            <li><a href=""> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
        </ul>
    </div> -->
</div>
<?php $v->start("js") ?>
<script>
    $(function() {

        // $("[data-action]").click(function(event) {
        // });


        $.ajax({
            url: '<?= $router->route("web.tree"); ?>',
            type: "post",
            dataType: "json",
            success: function(data) {

                const tree = document.querySelector("nav#tree");
                const menu = document.createElement("ul");

                const firstLevel = data.filter(item => !item.parent);
                const getFirstLis = firstLevel.map(buildTree);
                getFirstLis.forEach(li => menu.append(li));

                function buildTree(item) {

                    const li = document.createElement("li");
                    li.innerHTML = item.name;

                    const children = data.filter(child => child.parent === item.id);

                    if (children.length > 0) {

                        li.addEventListener("click", event => {
                            event.stopPropagation();
                            event.target.classList.toggle("open");
                        });

                        li.classList.add("has-children");

                        const subMenu = document.createElement("ul");
                        children.map(buildTree)
                            .forEach(li => subMenu.append(li));
                        li.append(subMenu);
                    }

                    return li;
                }

                tree.append(menu);
            }
        });


    });
</script>
<?php $v->end; ?>