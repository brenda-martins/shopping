<?php

namespace source\controllers;

use Source\Models\CreditCard;
use Source\Models\Address;
use Source\Controllers\Controller;
use Source\Facades\Cart;
use Source\Models\User;

class Checkout extends Controller
{

    private $user;

    public function __construct($router)
    {
        parent::__construct($router);

        if (empty($_SESSION["user"]) || !$this->user = (new User())->findbyId($_SESSION["user"]["id"])) {

            unset($_SESSION["user"]);
            $this->router->redirect("web.login");
        }
    }




    /**
     * @return \League\Plates\Engine
     */
    public function index()
    {
        echo  $this->view->render("themes/checkout");
    }


    /**
     * @param array $data
     * @return void
     */
    public function address(array $data)
    {

        $data = filter_var_array($data, FILTER_SANITIZE_STRING);

        if (in_array("", $data)) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Campos em branco. Por favor, preencha todos os campos para continuar"
            ]);

            return;
        }

        $address = new Address();
        $address->user = $this->user->id;
        $address->cep = $data["cep"];
        $address->state = $data["state"];
        $address->city = $data["city"];
        $address->neighborhood = $data["neighborhood"];
        $address->street = $data["street"];
        $address->number = $data["number"];

        // echo json_encode($address);

        if (!$address->save()) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => $address->fail()->getMessage()
            ]);

            return;
        }
        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("checkout.card")
        ]);
    }


    /**
     * @return \League\Plates\Engine
     */
    public function card()
    {
        echo $this->view->render("themes/card-form");
    }

    public function storeCard(array $data)
    {
        $data = filter_var_array($data, FILTER_SANITIZE_STRING);

        if (in_array("", $data)) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Preencha todos os campos."
            ]);
            return;
        }
        $pagarme = new \PagarMe\Client(PAGARME_API_KEY);


        $getCreditCard = $pagarme->cards()->create([
            'holder_name' => $data["holder_name"],
            'number' => $data["number"],
            'expiration_date' => $data["expiration_date"],
            'cvv' => $data["avv"]
        ]);


        if (!$getCreditCard->valid) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Cartão inválido."
            ]);
            return;
        }

        $creditCard = new CreditCard();

        $creditCard->user = $this->user->id;
        $creditCard->hash = $getCreditCard->id;
        $creditCard->brand = $getCreditCard->brand;
        $creditCard->last_digits = $getCreditCard->last_digits;

        if (!$creditCard->save()) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => $creditCard->fail()->getMessage()
            ]);

            return;
        }

        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("checkout.showFormConfirm")
        ]);

        return;
    }

    public function showFormConfirm()
    {
        echo $this->view->render("themes/confirm", [
            "products" => (new Cart())->cart()["itens"],
            "address" => (new Address())->find("user = :user_id", "user_id={$this->user->id}")->limit(1)->fetch()
        ]);
    }

    public function confirm()
    {
        $pagarme = new \PagarMe\Client(PAGARME_API_KEY);
        $cart = new Cart();
        $card = (new CreditCard())->find("user = :user_id", "user_id={$this->user->id}")->fetch();


        $transaction =  $pagarme->transactions()->create([
            'amount' => ($cart->cart()["total"] * 100),
            'card_id' => $card->hash,
            'payment_method' => 'credit_card'
        ]);


        $cart->clear();

        message("success", "Sua compra foi finalizada com sucesso!");
        $this->router->redirect("cart.index");
    }
}
