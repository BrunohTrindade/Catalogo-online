<?php

namespace Core;

class Config
{
  protected function config(): void
  {
    //URL do Projeto
    define('URL', 'https://'.$_SERVER['HTTP_HOST'].'/catalog/');
    define('URLADM', 'https://localhost/catalog/adm/');
    define('URL_PRODUCT', URL.'App/catalog/public/images/');

    define('CONTROLLER', 'Home'); //Pagina inicial
    define('CONTROLLER_ERRO', 'Erro');

    //Credenciais Banco de Dados
    define('HOST', 'localhost');
    define('USER', 'root');
    define('PASS', 'mydb');
    define('DBNAME', 'epp');
    define('PORT', 3307);

    //Dados de contato
    define('EMAIL_ADM', 'bruno_henriquet@live.com');
    define('TELEFONE', '4333333');

    //Status
    define('ACTIVE', 1);          //Status como Ativo
    define('INACTIVE', 0);        //Status como Inativo

    define('SUCCESS', 1);         //Sucesso na execução
    define('INPUT_ERROR', 0);     //Erro de atribuiçao de valores ou campo nulo
    define('DATABASE_ERROR', -1); //Erro Banco de Dados

    define('USER_COMMON', 1);     //Usuario comum
    define('USER_ADM', 2);        //usuario administrador

    define('ITEMS_PAGE', 12);     //Define a quantidade de itens por pagina

  }
}
