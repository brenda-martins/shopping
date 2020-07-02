<?php

namespace source\Models;

use PDO;

/**
 * Description of Conexao
 *
 * @author Brenda Martins
 */
class Conexao
{
    private static $instance;

    public static function getCon()
    {
        if (!isset(self::$instance)) :
            self::$instance = new PDO('mysql:host=localhost;dbname=shop', DATA_LAYER_CONFIG["username"],  DATA_LAYER_CONFIG["passwd"]);
        endif;

        return self::$instance;
    }
}
