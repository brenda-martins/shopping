<?php

namespace Source\Controllers;

use League\Plates\Engine;
use CoffeeCode\Router\Router;

/**
 * Description of Controller
 *
 * @author Brenda Martins
 */
abstract class Controller
{

    /** @var Engine */
    protected $view;


    /** @var Router  */
    protected $router;

    public function __construct($router, $dir = null, $globals = [])
    {
        $dir = $dir ?? dirname(__DIR__, 2) . "/view/site/";
        $this->view = Engine::create($dir, "php");
        $this->router = $router;

        $this->view->addData(["router" => $this->router]);

        if ($globals) {
            $this->view->addData($globals);
        }
    }

    public function ajaxResponse(string $param, array $values): string
    {
        return json_encode([$param => $values]);
    }
}
