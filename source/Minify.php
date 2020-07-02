<?php

/**
 * CSS
 */
$minCSS = new \MatthiasMullie\Minify\CSS();
$minCSS->add(dirname(__DIR__, 1) . "/view/site/assets/css/style.css");
$minCSS->add(dirname(__DIR__, 1) . "/view/site/assets/css/carrousel.css");
$minCSS->add(dirname(__DIR__, 1) . "/view/site/assets/css/message.css");
$minCSS->add(dirname(__DIR__, 1) . "/view/site/assets/css/load.css");
$minCSS->minify(dirname(__DIR__, 1) . "/views/assets/style.min.css");


/**
 * JS
 */

// $minJS = new MatthiasMullie\Minify\JS();
// $minJS->add(dirname(__DIR__, 1) . "/views/assets/js/jquery.js");
// $minJS->add(dirname(__DIR__, 1) . "/views/assets/js/jquery-ui.js");
// $minJS->minify(dirname(__DIR__, 1) . "/views/assets/scripts.min.js");
