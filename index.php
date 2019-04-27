<?php
    require 'lib/autoloader.php';
    mb_internal_encoding("UTF-8");
    date_default_timezone_set('America/Sao_Paulo');
    /*try
    {
        Db::connect('localhost', 'root', '', 'cardapio_online');
    }
     catch (Exception $e) 
     {
            die("Erro ao conectar ao banco de dados!");
     }
    */
    $router = new RouterController();
    $router->process(array($_SERVER['REQUEST_URI']));
    $router->renderView();
?>
