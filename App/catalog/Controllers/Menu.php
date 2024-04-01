<?php

namespace Catalog\Controllers;

use Catalog\Util\Util;
use Catalog\Models\MenuModel;
use Catalog\Models\OrderModel;

class Menu
{
  private array $data;

  public function index()
  {

    $loadPage = new MenuModel;
    $this->data['category'] = $loadPage->menuCategory();

    $cartItems = new OrderModel();
    $this->data['numberItemsCart'] = $cartItems->countProductsCart($_SESSION['id'] ?? 0);

    foreach($this->data['category'] as &$item) {
      $item['name_link'] = util::slugUrlName($item['name']);
    }

    return $this->data;
  }
}
