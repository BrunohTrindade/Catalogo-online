<?php

namespace Catalog\Controllers;

use Core\ConfigView;
use Catalog\Util\Util;
use Catalog\Models\HomeModel;


class Home
{
  private array|null $data;
  
  public function index()
  {
    $loadPage = new HomeModel;
    $this->data = $loadPage->index();
    if (!empty($this->data)) {
      for ($i = 0; $i < count($this->data); $i++) {
        $this->data[$i]['nome_p'] = Util::limitedWords(8, $this->data[$i]['product_name']);
        $this->data[$i]['name_link'] = Util::clearUrl($this->data[$i]['product_name']);
        $this->data[$i]['with_discount'] = Util::calculateDiscount($this->data[$i]['price'], $this->data[$i]['discount']);
      }
    }


    $loadView = new ConfigView("Catalog/Views/home", $this->data);
    $loadView->loadViewCatalog();
  }

}
