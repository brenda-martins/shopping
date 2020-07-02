<?php

namespace source\controllers;

use Source\Controllers\Controller;
use Source\Models\Product;
use Source\Models\Category;
use Source\Facades\UserFacade;
use Source\Models\User;

/**
 * Description of Home
 *
 * @author usr
 */
class Web extends Controller
{

    public function __construct($router)
    {
        parent::__construct($router);
    }


    /**
     * @return void
     */
    public function index(): void
    {
        $product = new Product();
        echo $this->view->render("themes/home", [
            "products" => $product->find()->order("name")->fetch(true)
        ]);
    }

    /**
     * @param array $data
     * @return void
     */
    public function login(array $data): void
    {
        echo $this->view->render("themes/login");
    }



    /**
     * @return void
     */
    public function logout(): void
    {
        (new UserFacade())->logout();
        $this->router->redirect("web.login");
    }

    /**
     * @param array $data
     * @return void
     */
    public function register(array $data): void
    {
        echo $this->view->render("themes/register");
    }

    /**
     * @return void
     */
    public function forget(): void
    {
        echo $this->view->render("themes/forget");
    }


    public function sendemail(): void
    {

        if (empty($_SESSION["forget"]) || !$user = (new User())->findById($_SESSION["forget"])) {
            message("info", "Informe seu E-MAIL para recuperar a senha");
            $this->router->redirect("web.forget");
        }


        echo $this->view->render("themes/msg_send_email", [
            "user" => $user
        ]);
    }




    /**
     * @param array $data
     * @return void
     */

    public function reset($data): void
    {


        if (empty($_SESSION["forget"])) {
            message("info", "Informe seu E-MAIL para recuperar a senha");
            $this->router->redirect("web.forget");
        }

        $error = "Não foi possível processar a solicitação, por favor tente novamente!";


        $email = filter_var($data["email"], FILTER_VALIDATE_EMAIL);
        $forget =  filter_var($data["forget"], FILTER_DEFAULT);

        if (!$email || !$forget) {
            message("error", $error);
            $this->router->redirect("web.forget");
        }


        $user = (new User())->find("email = :email AND forget = :forget", "email={$email}&forget={$forget}")->fetch();

        if (!$user) {
            message("error", $error);
            $this->router->redirect("web.forget");
        }
        echo $this->view->render("themes/reset");
    }

    public function tree()
    {

        $categories = (new Category())->find(null, null, "id , name, parent")->fetch(true);

        foreach ($categories as $c) {
            $data[] = $c->data();
        }

        echo json_encode($data);
    }


    /**
     * @return void
     */
    public function search(): void
    {
        $search =  filter_var($_POST["input_search"], FILTER_SANITIZE_STRING);

        $products = (new Product())->search($search);

        echo $this->view->render("themes/search-area", [
            "title" => $search . " no Shopping",
            "products" => $products,
            "search" => $search
        ]);
    }


    /**
     * @param array $data
     * @return void
     */
    public function findByCategory(array $data): void
    {
        $id = $data["id"];
        $products = $this->product->findByCategory($id);
        $quantity = count($products);
        $category = $this->category->findById($id);
        echo $this->view->render("themes/search-area", [
            "products" => $products,
            "quantity" => $quantity,
            "search" => $category->name,
            "categories" => $this->categories,
            "title" => $category->name
        ]);
    }


    public function myAccount(): void
    {
        echo $this->view->render("my-account");
    }


    /**
     * @param array $data
     * @return void
     */
    public function productDetail(array $data): void
    {
        $id  = filter_var($data["id"], FILTER_VALIDATE_INT);

        $product = new Product();

        if ($id) {
            echo $this->view->render("themes/single-product", [
                "product" => $product->findProduct($id),
                "categories" => (new Category())->find()->fetch(true)
            ]);
        }
    }
}
