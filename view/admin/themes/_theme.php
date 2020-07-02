<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link type="text/css" href="<?= asset("bootstrap/css/bootstrap.min.css"); ?>" rel="stylesheet">
    <link type="text/css" href="<?= asset("bootstrap/css/bootstrap-responsive.min.css"); ?>" rel="stylesheet">
    <link type="text/css" href="<?= asset("css/theme.css"); ?>" rel="stylesheet">
    <link type="text/css" href="<?= asset("images/icons/css/font-awesome.css"); ?>" rel="stylesheet">
    <link type="text/css" href="<?= asset("css/message.css"); ?>" rel="stylesheet">
</head>


<body>
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                    <i class="icon-reorder shaded"></i>
                </a>

                <a class="brand" href="index.html">
                    Área administrativa
                </a>

                <div class="nav-collapse collapse navbar-inverse-collapse">
                    <ul class="nav pull-right">
                        <li><a href="#">
                                <?= $_SESSION["user"]["name"]; ?>
                            </a></li>
                        <li class="nav-user dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?= asset("images/user.png"); ?>" class="nav-avatar" />
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Trocar senha</a></li>
                                <li class="divider"></li>
                                <li><a href="<?= $router->route("admin.logout"); ?>">Sair</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="span3">
                    <div class="sidebar">

                        <ul class="widget widget-menu unstyled">
                            <li><a href="<?= $router->route("admin.category"); ?>">
                                    <i class="menu-icon icon-tasks"></i>
                                    Categoria
                                </a>
                            </li>
                            <li><a href="<?= $router->route("admin.subcategory"); ?>">
                                    <i class="menu-icon icon-tasks"></i>
                                    Sub Categoria
                                </a>
                            </li>
                            <li>
                                <a class="collapsed" data-toggle="collapse" href="#togglePages2">
                                    <i class="menu-icon icon-paste"></i>
                                    <i class="icon-chevron-down pull-right"></i>
                                    <i class="icon-chevron-up pull-right"></i>
                                    Produto
                                </a>
                                <ul id="togglePages2" class="collapse unstyled">

                                    <li>
                                        <a href="<?= $router->route("admin.product"); ?>">
                                            <i class="icon-tasks"></i>
                                            Novo Produto
                                        </a>
                                    </li>

                                    <li>
                                        <a href="<?= $router->route("product.manager"); ?>"> <i class="menu-icon icon-table"></i>
                                            Gerenciar Produtos
                                        </a>
                                    </li>

                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="span9">
                    <div class="content">
                        <?= $v->section("content"); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="container">
            <b class="copyright">&copy; 2020 E-commerce </b> All rights reserved.
        </div>
    </div>

    <script src="<?= asset("js/jquery-1.9.1.min.js"); ?>" type="text/javascript"></script>
    <script src="<?= asset("js/jquery-ui-1.10.1.custom.min.js"); ?>" type="text/javascript"></script>
    <script src="<?= asset("bootstrap/js/bootstrap.min.js"); ?>" type="text/javascript"></script>
    <!-- <script src="<?= url("/view/admin/scripts/flot/jquery.flot.js"); ?>" type="text/javascript"></script>
    <script src="<?= url("/view/admin/scripts/datatables/jquery.dataTables.js"); ?>"></script> -->

    <?= $v->section("js"); ?>
</body>