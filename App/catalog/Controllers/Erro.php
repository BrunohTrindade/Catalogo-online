<?php

namespace Catalog\Controllers;

use Catalog\Models\HomeModel;
use Core\ConfigView;

class Erro
{
  private array $data;

  public function index()
  {
    $loadPage = new HomeModel;
    $this->data = $loadPage->index();

    $loadView = new ConfigView("Catalog/Views/erro", $this->data);
    $loadView->loadViewCatalog();  
  }
}
