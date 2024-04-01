<?php

namespace Catalog\Models;

use Catalog\Models\Helpers\Read;
use Catalog\Util\Util;

class LoginModel
{

  private array $data;

  public function index($email, $senha)
  {
  
    $loadData = new Read();
    $loadData->fullRead("SELECT id, email, pass, name, type FROM user  WHERE email = :email", "email=$email");

    $result = $loadData->getResult();

    if (isset($result[0]['pass'])) {
      if (password_verify($senha, $result[0]['pass'])) {
        $_SESSION['name'] = $result[0]['name']; 
        $_SESSION['type'] = $result[0]['type'];
        $_SESSION['email'] = $result[0]['email'];
        $_SESSION['id'] = $result[0]['id'];
        header("Location: home");
      } else {
        return -1; // user not found
      }
    }else{
      return -2;// password incorrect 
    }
  }
}
