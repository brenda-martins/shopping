<?php

namespace Source\Controllers;

use Source\Controllers\Controller;
use Source\helper\Seguranca;
use Source\Facades\UserFacade;
use Source\Models\User;
use Source\Models\Category;

/**
 * Description of Admin
 *
 * @author usr
 */
class Admin extends Controller
{

    private $dir;

    protected $user;

    public function __construct($router)
    {
        // new Seguranca();
        $this->dir = dirname(__DIR__, 2) . "/view/admin/";
        parent::__construct($router, $this->dir);

        if (empty($_SESSION["admin"]) || !$this->user =  (new User())->findById($_SESSION["admin"])) {
            unset($_SESSION["admin"]);

            message("error", "Acesso negado. Entre com suas credenciais para ter acesso");
            $this->router->redirect("web.login");
        }
    }

    public function index(): void
    {
        echo $this->view->render("themes/home", ["title" => "| Area administrativa"]);
    }


    /**
     * @return void
     */
    public function category(): void
    {
        $categories = (new Category())->find("parent is null AND is_active = :active", "active=1")->fetch(true);

        echo $this->view->render("themes/category", [
            "categories" => $categories
        ]);
    }

    /**
     * @return void
     */
    public function subcategory(): void
    {
        $categories = (new Category())->find("is_active = 1")->fetch(true);

        echo $this->view->render("themes/subcategory", [
            "categories" => $categories
        ]);
    }

    /**
     * @return void
     */
    public function product(): void
    {
        $categories = (new Category())->find("is_active = 1")->fetch(true);
        echo $this->view->render("themes/insert-product", [
            "categories" => $categories
        ]);
    }

    /**
     * @return void
     */
    public function logout(): void
    {
        // unset($_SESSION["admin"]);
        (new UserFacade())->logout();
        $this->router->redirect("web.login");
    }
}
