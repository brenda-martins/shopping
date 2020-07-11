<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $title; ?></title>


    <link href="<?= asset("css/style.css"); ?>" rel="stylesheet">
    <link href="<?= asset("css/message.css"); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?= asset("css/responsive.css"); ?>" media="screen and (max-width: 768px)" />
    <link href="<?= asset("css/load.css"); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <div class="ajax_load">
        <div class="ajax_load_box">
            <div class="ajax_load_box_circle"></div>
            <div class="ajax_load_box_title">Aguarde, carrengando...</div>
        </div>
    </div>


    <header>
        <div class="container">

            <a href="<?= $router->route("web.index"); ?>">
                <img class="logo_img" src="<?= asset("images/logo_ecommerce.png"); ?>" alt="Loja Virtual">
            </a>
            <div class="menu-section">
                <div class="menu-toggle">
                    <div class="one"></div>
                    <div class="two"></div>
                    <div class="three"></div>
                </div>

                <form action="<?= $router->route("web.search"); ?>" method="post">
                    <input type="text" name="input_search">
                    <button>
                        <i class="fa fa-search fa-lg"></i>
                    </button>
                </form>

                <nav>
                    <ul>


                        <?php if (isset($_SESSION["admin"])) : ?>
                            <li>
                                <a href="<?= $router->route("admin.index"); ?>">Área Administrativa</a>
                            </li>

                        <?php endif; ?>


                        <?php if (empty($_SESSION["user"])) : ?>
                            <li>
                                <a href="<?= $router->route("web.login"); ?>">Entrar</a>
                            </li>

                            <li>
                                <a href="<?= $router->route("web.register"); ?>">Cadastrar</a>
                            </li>


                        <?php else : ?>

                            <li>
                                <a href="<?= $router->route("cart.index"); ?>">Carrinho</a>
                            </li>
                            <li>
                                <a href="<?= $router->route("web.logout"); ?>">Sair</a>
                            </li>

                        <?php endif; ?>



                    </ul>
                </nav>


            </div>
        </div>

    </header>


    <?= $v->section("content"); ?>



    <footer class="my-5 pt-5 text-muted text-center text-small">

    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <script src="<?= asset("js/responsive-menu.js"); ?>"></script>
    <?= $v->section("js"); ?>


</body>

</html>