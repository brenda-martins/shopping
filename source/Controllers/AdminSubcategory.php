<?php

namespace Source\Controllers;

use Source\Controllers\Controller;
use Source\Models\Category;

/**
 * Description of Subcategory
 *
 * @author usr
 */
class AdminSubcategory extends Controller
{

    private $dir;

    public function __construct($router)
    {
        $this->dir = dirname(__DIR__, 2) . "/view/admin/";
        parent::__construct($router, $this->dir);
    }


    /**
     * @param array $data
     * @return void
     */
    public function store(array $data): void
    {
        $data = filter_var_array($data, FILTER_DEFAULT);

        $subcategory = new Category();
        $subcategory->name = $data["subcategory"];
        $subcategory->parent = $data["category"];
        $subcategory->is_active = 1;

        if (!$subcategory->save()) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => $subcategory->fail()->getMessage()
            ]);

            return;
        }

        echo $this->ajaxResponse("message", [
            "type" => "success",
            "message" => "Subcategoria " . strtoupper($subcategory->name) . " foi criada com sucesso"
        ]);
    }
}
