<?php

namespace source\Facades;

use Source\Models\Product;

/**
 * Description of Cart
 *
 * @author usr
 */
class Cart
{

    public function __construct()
    {
        if (!session_id()) {
            session_start();
        }

        $_SESSION["cart"] = (!empty($_SESSION["cart"]) ? $_SESSION["cart"] : []);
    }

    public function cart(): array
    {
        return $_SESSION["cart"];
    }

    public function add(Product $product): Cart
    {
        $_SESSION["cart"]["total"] = ($_SESSION["cart"]["total"] ?? 0);
        $_SESSION["cart"]["total"] += $product->price;

        $_SESSION["cart"]["amount"] = ($_SESSION["cart"]["amount"] ?? 0);
        $_SESSION["cart"]["amount"] += 1;

        if (empty($_SESSION["cart"]["itens"][$product->id])) {
            $_SESSION["cart"]["itens"][$product->id] = [
                "id" => $product->id,
                "product" => $product->name,
                "price" => $product->price,
                "total" => $product->price,
                "amount" => 1,
                "image" => $product->image1
            ];

            return $this;
        }

        $_SESSION["cart"]["itens"][$product->id]["amount"] += 1;
        $_SESSION["cart"]["itens"][$product->id]["total"] += $product->price;

        return $this;
    }

    public function less(Product $product): Cart
    {
        if (!empty($_SESSION["cart"]["itens"][$product->id])) {
            $_SESSION["cart"]["total"] -= $product->price;
            $_SESSION["cart"]["amount"] -= 1;

            if ($_SESSION["cart"]["itens"][$product->id]["amount"] > 1) {
                $_SESSION["cart"]["itens"][$product->id]["amount"] -= 1;
                $_SESSION["cart"]["itens"][$product->id]["price"] -= $product->price;
                $_SESSION["cart"]["itens"][$product->id]["total"] -= $product->price;
                return $this;
            }

            unset($_SESSION["cart"]["itens"][$product->id]);
            return $this;
        }

        return $this;
    }

    public function remove(Product $product): Cart
    {
        unset($_SESSION["cart"]["itens"][$product->id]);
        return $this;
    }

    public function clear(): Cart
    {
        $_SESSION["cart"] = [];
        return $this;
    }
}
