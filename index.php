<?php

session_start(); //Iicia a Sessão
ob_start(); // Buffer de saida

require './vendor/autoload.php';

$url = new Core\ConfigController();
$url->loadPage();
?>