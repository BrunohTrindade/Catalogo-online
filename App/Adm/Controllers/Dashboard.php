<?php

namespace Adm\Controllers;

use Core\ConfigView;

class Dashboard
{
  private array $data;

  public function Index()
  {$_SESSION['token'] = "token";
    $_SESSION['id'] = "12345";
    $this->data = [];
    $loadView = new ConfigView("adm/Views/home/home", $this->data);
    $loadView->loadViewAdm();
  }
}
