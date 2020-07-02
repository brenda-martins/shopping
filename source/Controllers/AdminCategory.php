<?php

namespace Source\Controllers;

use Source\Controllers\Controller;
use Source\Models\Category;

/**
 * Description of AdminCategory
 *
 * @author usr
 */
class AdminCategory extends Controller
{

    private $dir;
    private $category;

    public function __construct($router)
    {
        $this->dir = dirname(__DIR__, 2) . "/view/admin/";
        parent::__construct($router, $this->dir);

        $this->category = new Category();
        $this->categories = $this->category->find()->fetch(true);
    }


    public function store(): void
    {

        if ($_POST["id"]) {
            $this->update();
            return;
        }


        $name = filter_var($_POST["category"], FILTER_SANITIZE_STRING);

        $category = new Category();
        $category->name = $name;
        $category->is_active = 1;

        if (!$category->save()) {

            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => $category->fail()->getMessage()
            ]);
            return;
        }


        message("success", "Categoria salva com sucesso");
        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("admin.category")
        ]);
    }

    public function remove(array $data): void
    {

        $id = $data["id"];
        $category = (new Category())->resursiveCategories($id);

        if (!$category) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Não foi possível processar sua requisição, por favor tente novamente"
            ]);
            return;
        }

        foreach ($category as $c) {
            $c->is_active = 0;

            if (!$c->save()) {
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => $c->fail()->getMessage()
                ]);
                return;
            }
        }

        $callback["delete"] = true;
        echo json_encode($callback);
    }

    public function edit(array $data): void
    {

        $id = $data["id"];

        $category = (new Category())->findById($id);

        if (!$category) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Não foi possível processar sua requisição, por favor tente novamente"
            ]);
            return;
        }

        $callback["category"] = $category->data();
        $callback["edit"] = true;

        echo json_encode($callback);
    }


    /**
     * @param int $data
     * @return void
     */
    public function update(): void
    {

        $data = filter_var_array($_POST, FILTER_DEFAULT);
        $category = (new Category())->findById($data["id"]);

        if (!$category) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Não foi possível processar sua requisição, por favor, tente novamente"
            ]);
            return;
        }

        $category->name = $data["category"];
        if (!$category->save()) {

            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => $category->fail()->getMessage()
            ]);
            return;
        }


        message("success", "Categoria " . strtoupper($category->name) . " foi atualizada com sucesso");
        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("admin.category")
        ]);
    }
}
