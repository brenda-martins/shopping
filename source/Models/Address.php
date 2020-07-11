<?php


namespace Source\Models;


use CoffeeCode\DataLayer\DataLayer;

class Address extends DataLayer
{


    public function __construct()
    {

        parent::__construct("adresses", ["user", "cep", "state", "city", "neighborhood", "street", "number"]);
    }
}
