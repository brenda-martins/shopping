<?php

namespace Source\Controllers;

use Source\Controllers\Controller;
use Source\Models\Product;
use Source\Facades\Cart;

/**
 * Description of WebCart
 *
 * @author Brenda Martins
 */
class WebCart extends Controller
{

    private $cart;

    public function __construct($router)
    {
        parent::__construct($router);
        $this->cart = new Cart();
    }

    public function index(): void
    {
        echo $this->view->render("themes/cart", [
            "products" => $this->cart->cart()["itens"]
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
