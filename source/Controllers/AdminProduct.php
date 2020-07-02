<?php

namespace source\Controllers;

use Source\Controllers\Controller;
use Source\Models\Category;
use Source\Models\Subcategory;
use Source\Models\Product;

/**
 * Description of AdminProduct
 *
 * @author usr
 */
class AdminProduct extends Controller
{

    private $dir;

    public function __construct($router)
    {
        // new Seguranca();
        $this->dir = dirname(__DIR__, 2) . "/view/admin/";
        parent::__construct($router, $this->dir);
    }


    function getFloat($str)
    {
        if (strstr($str, ",")) {
            $str = str_replace(".", "", $str);
            $str = str_replace(",", ".", $str);
        }

        if (preg_match("#([0-9\.]+)#", $str, $match)) {
            return floatval($match[0]);
        } else {
            return floatval($str);
        }
    }


    /**
     * @param array $data
     * @return void
     */
    public function store(array $data): void
    {

        $upload = new \CoffeeCode\Uploader\Image("storage", "images");
        $files = $_FILES;

        $file1 = $files["product_image1"];
        $file2 = $files["product_image2"];
        $file3 = $files["product_image3"];


        if (empty($file1["type"]) || !in_array($file1["type"], $upload::isAllowed())) {

            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "A imagem 1 não é um formato válido"
            ]);

            return;
        }

        if (empty($file2["type"]) || !in_array($file2["type"], $upload::isAllowed())) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "A imagem 2 não é um formato válido"
            ]);

            return;
        }

        if (empty($file3["type"]) || !in_array($file3["type"], $upload::isAllowed())) {

            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "A imagem 3 não é um formato válido"
            ]);

            return;
        }

        $uploaded1 = $upload->upload($file1, pathinfo($file1["name"], PATHINFO_FILENAME), 850);
        $uploaded2 = $upload->upload($file2, pathinfo($file2["name"], PATHINFO_FILENAME), 550);
        $uploaded3 = $upload->upload($file3, pathinfo($file3["name"], PATHINFO_FILENAME), 550);

        $data = filter_var_array($data, FILTER_DEFAULT);

        $product = new Product();
        $product->category = $data["category"];
        $product->name = $data["product_name"];
        $product->price = $this->getFloat($data["product_price"]);
        $product->productDescription = $data["product_description"];
        $product->image1 = $uploaded1;
        $product->image2 = $uploaded2;
        $product->image3 = $uploaded3;
        $product->shippingCharge = $data["product_shippingcharge"];
        $product->productAvailability = $data["product_availability"];

        if (!$product->save()) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => $product->fail()->getMessage()
            ]);

            return;
        }

        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("product.manager")
        ]);
    }

    public function manage()
    {
        $products = (new Product())->findAll();
        echo $this->view->render("themes/manage-products", [
            "products" => $products
        ]);
    }

    /**
     * @param array $data
     * @return void
     */
    public function edit(array $data): void
    {
        $id = filter_var($data["id"], FILTER_VALIDATE_INT);

        $product = (new Product())->findById($id);
        if (!$product) {
            $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Não foi possível processar sua requisição, por favor tente novamente"
            ]);
            return;
        }

        $callback["edit"] = true;
        $callback["product"] = $product->data();

        echo json_encode($callback);
    }

    /**
     * @param array $data
     * @return void
     */
    public function update(array $data): void
    {
        $data = filter_var_array($data, FILTER_DEFAULT);

        $product = (new Product())->findById($data["product_id"]);

        $product->name = $data["product_name"];
        $product->price = $data["product_price"];
        $product->priceBeforeDiscount = $data["productpricebd"];
        $product->productDescription = $data["product_description"];
        $product->shippingCharge = $data["product_shippingcharge"];
        $product->productAvailability = $data["product_availability"];

        if (!$product->save()) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => $product->fail()->getMessage()
            ]);
            return;
        }

        message("success", "Produto " . strtoupper($product->name) . " modificado com sucesso");
        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("product.manager")
        ]);
    }

    /**
     * @param array $data
     * @return void
     */
    public function delete(array $data): void
    {

        $id = filter_var($data["id"], FILTER_VALIDATE_INT);
        $product = (new Product())->findById($id);

        if (!$product) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Não foi possível processar sua requisição, por favor, tente novamente"
            ]);
            return;
        }

        if (!$product->destroy()) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => $product->fail()->getMessage()
            ]);

            return;
        }

        $callback["delete"] = true;
        echo json_encode($callback);
    }
}
