<?php

/**
 * 
 * @param string $param
 * @return string
 */
function site(string $param = null): string {
    if ($param && !empty(SITE[$param])) {
        return SITE[$param];
    }

    return SITE["root"];
}

/**
 * 
 * @param string $path
 * @param boolean $time
 * @return string
 * 
 */
function asset(string $path, $time = true): string {
    
    $file = SITE["root"] . "/view/assets/{$path}";
    $fileOnDir = dirname(__DIR__, 2). "/view/assets/{$path}";
    if($time && file_exists($fileOnDir)){
        $file .= "?time" . filemtime($fileOnDir);
    }
    return $file;
}

function message(string $type = null, string $message = null) {
    if ($type && $message) {
        $_SESSION["message"] = [
            "type" => $type,
            "message" => $message
        ];
        return null;
    }

    //Verifica se $_SESSION["flash"] está vazia e se não estiver atribui ele a variável $flash
    if (!empty($_SESSION["message"]) && $message = $_SESSION["message"]) {
        unset($_SESSION["message"]);

        return "<div class=\"message {$message["type"]} \"> {$message["message"]} </div>";
    }

    return null;
}

function url(string $uri = null): string
{
    if ($uri) {
        return site() . "{$uri}";
    }

    return site();
}