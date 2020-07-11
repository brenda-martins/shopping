<?php

namespace Source\Controllers;

use Source\Controllers\Controller;
use Source\Models\Product;
use Source\Facades\Cart;
use Source\Models\User;

/**
 * Description of WebCart
 *
 * @author Brenda Martins
 */
class WebCart extends Controller
{

    private $cart;
    private $user;

    public function __construct($router)
    {
        parent::__construct($router);
        $this->cart = new Cart();

        if (empty($_SESSION["user"]) || !$this->user = (new User())->findById($_SESSION["user"]["id"])) {
            unset($_SESSION["user"]);

            // message("error", "")
            $this->router->redirect("web.login");
        }
    }

    public function index(): void
    {
        echo $this->view->render("themes/cart", [
            "products" => $this->cart->cart()["itens"],
            "total" => $this->cart->cart()["total"],
            "amount" => $this->cart->cart()["amount"]
        ]);
    }

    public function cart(array $data): void
    {
        echo json_encode($this->cart->cart());
    }

    public function add(array $data): void
    {
        $id = filter_var($data["id"], FILTER_VALIDATE_INT);
        $product = (new Product())->findById($id);


        $this->cart->add($product);
        $this->router->redirect("cart.index");
    }

    public function more(array $data): void
    {

        $id = filter_var($data["id"], FILTER_VALIDATE_INT);
        $product = (new Product())->findById($id);


        $this->cart->add($product);
        echo json_encode($this->cart->cart());
    }

    public function less(array $data): void
    {

        $id = filter_var($data["id"], FILTER_VALIDATE_INT);
        $product = (new Product())->findById($id);

        $this->cart->less($product);
        echo json_encode($this->cart->cart());
    }

    public function remove(array $data): void
    {
        $id = filter_var($data["id"], FILTER_VALIDATE_INT);
        $product = (new Product())->findById($id);

        $this->cart->remove($product);
        echo json_encode($this->cart->cart());
    }

    public function clear(): void
    {
        $this->cart->clear();

        echo json_encode($this->cart->cart());
    }
}
