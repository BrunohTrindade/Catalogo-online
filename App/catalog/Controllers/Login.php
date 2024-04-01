<?php

namespace Catalog\Controllers;

use Catalog\Models\LoginModel;
use Core\ConfigView;

class Login
{
  private $data;
  private array | null $dataForm;

  public function index(){

    if(isset($_SESSION['type']))
      header("Location: home");

    $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $this->data['nome'] = filter_input(INPUT_POST, 'nome');
    
    if(!empty($this->dataForm['login']))
    {
      unset($this->dataForm['login']); 

     $model = new LoginModel();
     $result =  $model->index($this->dataForm['nome'], $this->dataForm['password']);
     $_SESSION['msg'] = $result;
    }
    
    $loadPage = new  ConfigView("Catalog/Views/login/login", $this->data);
    $loadPage->loadViewCatalog();
  }


}
