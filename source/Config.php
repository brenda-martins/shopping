<?php
/*
 * SITE CONFIG
 */
define("SITE", [
    "name" => "Loja Virtual",
    "desc" => "Sistema de ecommerce com PHP",
    "domain" => "ecommerce.com",
    "locale" => "pt_BR",
    "root" => "http://localhost/PHP/shopping"
]);


/**
 * CONFIG DATABASE
 */
define("DATA_LAYER_CONFIG", [
    "driver" => "mysql",
    "host" => "localhost",
    "port" => "3306",
    "dbname" => "shop",
    "username" => "brenda",
    "passwd" => "35183278",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);



/*
 *  MAIL CONNECT
 */
define("MAIL", [
    "host" => "smtp.gmail.com",
    "port" => "587",
    "user" => "",
    "passwd" => "",
    "from_name" => "",
    "from_email" => ""
]);


/*
 * SITE MINIFY
 */
// if ($_SERVER["SERVER_NAME"] == "localhost") {
//     require __DIR__ . "/Minify.php";
// }
