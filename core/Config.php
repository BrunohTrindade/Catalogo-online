<?php

namespace Core;

class Config
{
  protected function config(): void
  {
    //URL do Projeto
    define('URL', 'https://'.$_SERVER['HTTP_HOST'].'/catalog/');  // Raiz
    define('URLADM', 'https://localhost/catalog/adm/');           // Dashboard adm
    define('URL_PRODUCT', URL.'App/catalog/public/images/');      // caminho das imagens
    define('PROJECT_NAME', '{{NOME DO PROJETO}}');                    // nome do projeto
    
    define('CONTROLLER', 'Home');           //Pagina inicial
    define('CONTROLLER_ERRO', 'Erro');      //Página Erro

    //Credenciais Banco de Dados
    define('HOST', 'localhost');
    define('USER', 'root');
    define('PASS', 'mydb');
    define('DBNAME', 'epp');
    define('PORT', 3307);

    //Dados de contato
    define('EMAIL', 'eppiscinas@hotmail.com');
    define('TELL_1', '999308446');
    define('NAME_TELL_1', 'Enimar');
    define('DDD_TEL', '43');
    define('TELL_2', '984473245');
    define('NAME_TELL_2', 'Sandra');
    define('ADDRESS', 'Rua Mário Vidotte, 195, Jardim planalto - Londrina PR');
    define('CNPJ', '12870679/000159');

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
